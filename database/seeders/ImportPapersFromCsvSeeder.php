<?php

namespace Database\Seeders;

use App\Models\Dataset;
use App\Models\Paper;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use League\Csv\Reader;
use League\Csv\Statement;

class ImportPapersFromCsvSeeder extends Seeder
{
    protected string $csvFolderPath;
    
    public function __construct()
    {
        $this->csvFolderPath = database_path('data/papers');
    }
    
    public function run(): void
    {
        if (!is_dir($this->csvFolderPath)) {
            $this->command->error("Folder tidak ditemukan: {$this->csvFolderPath}");
            return;
        }
        
        $this->command->info("Scanning folder: {$this->csvFolderPath}");
        
        $files = glob($this->csvFolderPath . '/*.csv');
        $total = count($files);
        
        if ($total === 0) {
            $this->command->error("Tidak ada file CSV ditemukan di {$this->csvFolderPath}");
            return;
        }
        
        $this->command->info("Ditemukan {$total} file CSV");
        
        $imported = 0;
        $skipped = 0;
        $errors = 0;
        
        DB::beginTransaction();
        
        try {
            foreach ($files as $index => $file) {
                try {
                    $filename = pathinfo($file, PATHINFO_FILENAME);
                    $this->command->info("📄 [" . ($index + 1) . "/{$total}] Processing: {$filename}");
                    
                    if (filesize($file) === 0) {
                        $this->command->warn("  ⏭️ Skipped (File Kosong): {$filename}");
                        $skipped++;
                        continue;
                    }

                    $result = $this->importPaperFromCsv($file, $filename);
                    
                    if ($result === 'created') {
                        $imported++;
                    } elseif ($result === 'skipped') {
                        $skipped++;
                    }
                    
                } catch (\Exception $e) {
                    $errors++;
                    $this->command->error(" Error: " . $e->getMessage());
                }
            }
            
            DB::commit();
            
            $this->command->newLine();
            $this->command->info("Import selesai!");
            $this->command->table(
                ['Metric', 'Value'],
                [
                    ['Total Files', $total],
                    ['Papers Imported', $imported],
                    ['Skipped (Empty/Exists)', $skipped],
                    ['Errors', $errors],
                ]
            );
            
        } catch (\Exception $e) {
            DB::rollBack();
            $this->command->error("Import gagal: " . $e->getMessage());
            throw $e;
        }
    }
    
    protected function importPaperFromCsv(string $filePath, string $datasetName): string
    {
        $csv = Reader::createFromPath($filePath, 'r');
        $csv->setDelimiter(',');
        $csv->setEnclosure('"');
        
        $csv->setHeaderOffset(0);
        $records = iterator_to_array((new Statement())->process($csv));
        
        if (empty($records)) {
            $csv->setHeaderOffset(-1);
            $records = iterator_to_array((new Statement())->process($csv));
        }
        
        if (empty($records)) {
            throw new \Exception("File CSV kosong atau tidak memiliki data.");
        }
        
        $row = $records[0];
        
        if (array_key_exists(0, $row)) {
            $data = [
                'title' => $row[0] ?? null,
                'authors' => $row[1] ?? null,
                'venue' => $row[2] ?? null,
                'year' => $row[3] ?? null,
                'doi' => $row[4] ?? null,
                'url' => $row[5] ?? null,
                'abstract' => $row[6] ?? null,
            ];
        } else {
            $data = array_change_key_case($row, CASE_LOWER);
        }
        
        $paperData = [
            'title' => $this->clean($data['title'] ?? $data['paper_title'] ?? null),
            'authors' => $this->clean($data['authors'] ?? $data['author'] ?? null),
            'venue' => $this->clean($data['venue'] ?? $data['journal'] ?? null),
            'year' => $this->parseYear($data['year'] ?? $data['publication_year'] ?? null),
            'doi' => $this->clean($data['doi'] ?? null),
            'url' => $this->clean($data['url'] ?? null),
            'abstract' => $this->clean($data['abstract'] ?? $data['description'] ?? null),
        ];
        
        if (empty($paperData['title'])) {
            $paperData['title'] = ucwords(str_replace(['-', '_', '+'], ' ', $datasetName));
        }
        
        if (empty($paperData['title'])) {
            throw new \Exception("Paper title is required");
        }
        
        $dataset = $this->findDataset($datasetName);
        if (!$dataset) {
            $this->command->warn("  ⚠️ Dataset tidak ditemukan: {$datasetName}. Paper dibuat tanpa link.");
        }
        
        $paper = Paper::firstOrCreate(
            ['title' => $paperData['title'], 'doi' => $paperData['doi']],
            [
                'authors' => $paperData['authors'],
                'venue' => $paperData['venue'],
                'publication_year' => $paperData['year'],
                'url' => $paperData['url'],
                'abstract' => $paperData['abstract'],
                'bibtex' => $this->generateBibtex($paperData),
            ]
        );
        
        if ($dataset) {
            $linked = DB::table('dataset_papers')->updateOrInsert(
                ['dataset_id' => $dataset->dataset_id, 'paper_id' => $paper->paper_id],
                ['citation_type' => 'citing', 'is_primary' => false, 'updated_at' => now()]
            );
            if (!$linked) return 'skipped';
        }
        
        return 'created';
    }
    
    protected function findDataset(string $name): ?Dataset
    {
        $slug = Str::slug($name);
        return Dataset::where('slug', $slug)->first()
            ?? Dataset::whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($name) . '%'])->first();
    }
    
    protected function clean(?string $val): ?string
    {
        if (empty($val) || in_array(strtolower(trim($val)), ['null', 'n/a', '-', ''])) return null;
        return trim(preg_replace('/\s+/', ' ', html_entity_decode($val, ENT_QUOTES | ENT_HTML5, 'UTF-8')));
    }
    
    protected function parseYear($val): ?int
    {
        if (empty($val)) return null;
        if (preg_match('/\b(19|20)\d{2}\b/', (string)$val, $m)) return (int)$m[0];
        return is_numeric($val) && strlen($val) === 4 ? (int)$val : null;
    }
    
    protected function generateBibtex(array $d): ?string
    {
        if (empty($d['title'])) return null;
        
        $key = substr(Str::slug($d['title'], '-'), 0, 50);
        $year = $d['year'] ?? date('Y');
        $authors = $d['authors'] ?? 'Unknown';
        $title = str_replace(['{', '}', '&'], ['\\{', '\\}', '\\&'], $d['title']);
        $venue = $d['venue'] ?? 'Unknown';
        $doi = $d['doi'] ?? '';
        $url = $d['url'] ?? '';
        
        return "@article{$key},\n" .
               "  title = {{$title}},\n" .
               "  author = {{$authors}},\n" .
               "  year = {{$year}},\n" .
               "  journal = {{$venue}},\n" .
               "  doi = {{$doi}},\n" .
               "  url = {{$url}}\n" .
               "}\n";
    }
}