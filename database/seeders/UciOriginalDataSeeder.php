<?php

namespace Database\Seeders;

use App\Models\{
    Dataset, DatasetDescription, File, Keyword, Person, 
    Variable, VariableCategory, Paper, Doi, License, Image
};
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
use League\Csv\Reader;
use League\Csv\Statement;

class UciOriginalDataSeeder extends Seeder
{
    protected array $validDataTypes = [
        'Multivariate', 'Text', 'Image', 'Time-Series', 'Sequential', 
        'Tabular', 'Relational', 'Domain-Theory', 'Data-Generator', 'Univariate'
    ];
    
    protected array $validTaskTypes = [
        'Classification', 'Regression', 'Clustering', 
        'Causal-Discovery', 'Relational-Learning', 'Other'
    ];
    
    protected array $validVariableTypes = [
        'Categorical', 'Integer', 'Real', 'Text', 'Binary', 'Ordinal', 'Nominal', 'DateTime'
    ];
    
    protected array $validStatuses = [
        'pending', 'approved', 'rejected', 'available', 'deprecated'
    ];

    public function run(): void
    {
        $tablePath = database_path('seeders/data/uci_table.csv');
        $databasePath = database_path('seeders/data/uci_database.csv');
        
        if (!file_exists($tablePath) || !file_exists($databasePath)) {
            $this->command->error("File CSV tidak ditemukan di:");
            $this->command->error("   - {$tablePath}");
            $this->command->error("   - {$databasePath}");
            return;
        }

        $this->command->info("Membaca file CSV...");
        
        $dbReader = Reader::createFromPath($databasePath, 'r');
        $dbReader->setHeaderOffset(0);
        $dbRecords = iterator_to_array((new Statement())->process($dbReader));
        $dbIndexed = collect($dbRecords)->keyBy(fn($r) => trim($r['Name'] ?? ''));
        
        $tableReader = Reader::createFromPath($tablePath, 'r');
        $tableReader->setHeaderOffset(0);
        $tableRecords = (new Statement())->process($tableReader);
        
        $total = iterator_count($tableRecords);
        $this->command->info("Found {$total} records to import");
        
        $imported = 0;
        $skipped = 0;
        $errors = [];

        $defaultLicense = License::firstOrCreate(
            ['license_name' => 'Creative Commons Attribution 4.0 International'],
            [
                'description' => 'This allows for the sharing and adaptation of the datasets for any purpose, provided that the appropriate credit is given.',
                'license_url' => 'https://creativecommons.org/licenses/by/4.0/',
            ]
        );

        DB::beginTransaction();
        
        try {
            foreach ($tableRecords as $index => $row) {
                try {
                    $this->importDataset($row, $dbIndexed, $defaultLicense);
                    $imported++;
                    
                    if (($index + 1) % 25 === 0) {
                        $this->command->info("Processed " . ($index + 1) . "/{$total} (Imported: {$imported}, Skipped: {$skipped})");
                    }
                    
                } catch (\Exception $e) {
                    $skipped++;
                    $name = $row['Name'] ?? 'Unknown';
                    $this->command->warn("Row " . ($index + 2) . " ({$name}) skipped: " . $e->getMessage());
                    
                    if ($this->command->getOutput()->isVerbose()) {
                        $errors[] = [
                            'row' => $index + 2,
                            'name' => $name,
                            'error' => $e->getMessage(),
                        ];
                    }
                }
            }
            
            DB::commit();
            
            $this->command->newLine();
            $this->command->info("Import completed!");
            $this->command->table(
                ['Metric', 'Value'],
                [
                    ['Total Records', $total],
                    ['Successfully Imported', $imported],
                    ['Skipped (Errors)', $skipped],
                    ['Success Rate', round(($imported / max($total, 1)) * 100, 2) . '%'],
                ]
            );
            
            if ($this->command->getOutput()->isVerbose() && !empty($errors)) {
                $this->command->warn("\nDetailed errors (first 10):");
                foreach (array_slice($errors, 0, 10) as $err) {
                    $this->command->warn("   Row {$err['row']} [{$err['name']}]: {$err['error']}");
                }
            }
            
        } catch (\Exception $e) {
            DB::rollBack();
            $this->command->error("Import failed: " . $e->getMessage());
            $this->command->error("Line: " . $e->getLine() . " | File: " . $e->getFile());
            throw $e;
        }
    }
    
    protected function importDataset(array $row, $dbIndexed, License $defaultLicense): void
    {
        $name = trim($row['Name'] ?? '');
    if (empty($name)) {
        throw new \Exception("Dataset name is required");
    }
    
    $slug = Str::slug($name);
    
    $dbRow = $dbIndexed->get($name, []);
    $rawUciId = $dbRow['Identifier string'] ?? null;
    $uciId = $this->extractShortUciId($rawUciId, $name);
    
    if ($uciId && strlen($uciId) > 50) {
        $uciId = substr($uciId, 0, 50);
    }
    
    if (Dataset::where('slug', $slug)->orWhere('uci_id', $uciId)->first()) {
        throw new \Exception("Dataset already exists: {$name}");
    }
        
        $dbRow = $dbIndexed->get($name, []);
        
        $data_type = $this->validateEnum($this->extractDataType($row), $this->validDataTypes);
        $task_type = $this->validateEnum($this->extractTaskType($row), $this->validTaskTypes);
        $subject_area = trim($row['Subject Area'] ?? $dbRow['Subject Area'] ?? 'Computer Science');
        $domain = trim($dbRow['Domain'] ?? '');
        
        $num_instances = $this->parseCount($row['Number of Instances'] ?? null);
        $num_features = $this->parseCount($row['Number of Attributes'] ?? null);
        $num_classes = $this->parseCount($row['Number of Classes'] ?? null);
        
        $donated_date = $this->parseDate($row['Year'] ?? null);
        $linked_date = $dbRow['Linked Date'] ?? null;
        
        $dataset_url = $this->validateUrl($dbRow['Datapage URL'] ?? null);
        $detail_url = $this->validateUrl($dbRow['Detail URL'] ?? null);
        $thumbnail_url = $this->validateUrl($dbRow['Thumbnail URL'] ?? null);
        $large_image_url = $this->validateUrl($dbRow['Large Image URL'] ?? null);
        
        $doi_string = trim($dbRow['Identifier string'] ?? '');
        $has_doi = !empty($doi_string) && Str::startsWith($doi_string, '10.');
        
        $doi_id = null;
        if ($has_doi) {
            $doi = Doi::firstOrCreate(
                ['doi_string' => $doi_string],
                ['resolution_url' => "https://doi.org/{$doi_string}"]
            );
            $doi_id = $doi->doi_id;
        }
        
        $dataset = Dataset::create([
            'uci_id' => $this->extractShortUciId($dbRow['Identifier string'] ?? null, $name),
    'slug' => $slug,
    'name' => $name,
    'display_name' => trim($dbRow['Display Name'] ?? $name),
            
            'description' => Str::limit(trim($dbRow['Abstract'] ?? $row['Name'] ?? ''), 2000),
            'abstract' => trim($dbRow['Abstract'] ?? ''),
            'summary' => trim($dbRow['Summary'] ?? ''),
            
            'num_instances' => $num_instances,
            'num_features' => $num_features,
            'num_classes' => $num_classes,
            'file_size_bytes' => $this->parseFileSize($dbRow['File Size'] ?? null),
            
            'data_type' => $data_type,
            'task_type' => $task_type,
            
            'subject_area' => $subject_area,
            'domain' => $domain,
            'dataset_url' => $dataset_url,
            'detail_url' => $detail_url,
            'thumbnail_url' => $thumbnail_url,
            'large_image_url' => $large_image_url,
            
            'status' => 'available', 
            'donated_date' => $donated_date,
            'linked_date' => $linked_date,
            
            'view_count' => 0,
            'download_count' => 0,
            'citation_count' => 0,
            
            'has_missing_values' => $this->parseBoolean($dbRow['Has Missing Values'] ?? 'No'),
            
            'user_id' => null, 
            'license_id' => $defaultLicense->license_id,
            'doi_id' => $doi_id,
            
            'approved_at' => now(),
            'approved_by' => null,
        ]);
        
        $this->createDatasetDescription($dataset, $row, $dbRow);
        
        $this->attachKeywords($dataset, $row, $dbRow);
        
        $this->attachContributors($dataset, $row, $dbRow);
        
        $this->createVariables($dataset, $row, $dbRow);
        
        $this->attachPapers($dataset, $row, $dbRow);
        
        $this->createPlaceholderFiles($dataset, $row, $dbRow);
        
        $this->createImages($dataset, $row, $dbRow);
    }
    
protected function createDatasetDescription(Dataset $dataset, array $row, array $dbRow): void
{
    $sanitize = fn($val) => $val === null ? null : (is_string($val) ? trim($val) : (is_array($val) || is_object($val) ? json_encode($val) : (string) $val));
    
    $description = array_filter([
        'dataset_id' => $dataset->dataset_id,
        'purpose' => $sanitize($dbRow['Purpose'] ?? $row['Default Task'] ?? null),
        'funding' => $sanitize($dbRow['Funding'] ?? null),
        'instances_represent' => $sanitize($dbRow['What do instances represent'] ?? null),
        'data_splits' => $sanitize($dbRow['Recommended data splits'] ?? null),
        'sensitive_data' => $sanitize($dbRow['Contains sensitive data'] ?? null),
        'preprocessing' => $sanitize($dbRow['Preprocessing/cleaning'] ?? null),
        'additional_info' => $sanitize($dbRow['Additional Information'] ?? null),
        'citation_requests' => $sanitize($dbRow['How to cite'] ?? null),
    ], fn($v) => $v !== null && $v !== '');
    
    if (!empty($description)) {
        DatasetDescription::create($description);
    }
}
    
    protected function attachKeywords(Dataset $dataset, array $row, array $dbRow): void
    {
        $keywords = [];
        
        if (!empty($row['Data Types'])) {
            $keywords = array_merge($keywords, 
                array_filter(array_map('trim', explode(',', $row['Data Types'])))
            );
        }
        
        if (!empty($row['Attribute Types'])) {
            $keywords = array_merge($keywords,
                array_filter(array_map('trim', explode(',', $row['Attribute Types'])))
            );
        }
        
        if (!empty($dbRow['Keywords'])) {
            $keywords = array_merge($keywords,
                array_filter(array_map('trim', explode(',', $dbRow['Keywords'])))
            );
        }
        
        if (!empty($row['Subject Area'])) {
            $keywords[] = $row['Subject Area'];
        }
        if (!empty($dbRow['Domain'])) {
            $keywords[] = $dbRow['Domain'];
        }
        
        foreach (array_unique($keywords) as $kwName) {
            $kwName = trim($kwName);
            if (empty($kwName) || strlen($kwName) < 2 || strlen($kwName) > 100) continue;
            
            $keyword = Keyword::firstOrCreate(
    ['keyword_name' => $kwName],
    [
        'slug' => Str::slug($kwName),
        'category' => 'imported',  
    ]
);
            
            $dataset->keywords()->syncWithoutDetaching([$keyword->keyword_id]);
        }
    }
    
    protected function attachContributors(Dataset $dataset, array $row, array $dbRow): void
    {
        $uci = Person::firstOrCreate(
            ['name' => 'UCI Machine Learning Repository'],
            [
                'email' => 'archive@ics.uci.edu',
                'affiliation' => 'University of California, Irvine',
                'orcid' => null,
            ]
        );
        
        $dataset->contributors()->syncWithoutDetaching([
            $uci->person_id => [
                'contribution_role' => 'donor',
                'display_order' => 0,
            ]
        ]);
        
        $contributorsRaw = $dbRow['Creators'] ?? $dbRow['Authors'] ?? '';
        if (!empty($contributorsRaw)) {
            $contributors = preg_split('/[,;|]\s*/', $contributorsRaw, -1, PREG_SPLIT_NO_EMPTY);
            
            foreach ($contributors as $index => $contribRaw) {
                $parts = explode('|', trim($contribRaw), 2);
                $name = trim($parts[0]);
                $affiliation = trim($parts[1] ?? '');
                
                if (empty($name)) continue;
                
                $person = Person::firstOrCreate(
                    ['name' => $name, 'affiliation' => $affiliation ?: null],
                    ['email' => null, 'orcid' => null]
                );
                
                $dataset->contributors()->syncWithoutDetaching([
                    $person->person_id => [
                        'contribution_role' => ($index === 0) ? 'creator' : 'contributor',
                        'display_order' => $index + 1,
                    ]
                ]);
            }
        }
    }
    
    protected function createVariables(Dataset $dataset, array $row, array $dbRow): void
    {
        $attrInfo = $dbRow['Attribute Information'] ?? $dbRow['Variable Info'] ?? $row['Attribute Types'] ?? '';
        if (empty($attrInfo)) return;
        
        $attrLines = preg_split('/[;\n\r]+/', $attrInfo, -1, PREG_SPLIT_NO_EMPTY);
        
        foreach ($attrLines as $index => $attrLine) {
            $attrLine = trim($attrLine);
            if (empty($attrLine) || str_starts_with($attrLine, '@')) continue;
            
            $parts = preg_split('/[:\t]+/', $attrLine, 4);
            if (count($parts) < 2) continue;
            
            $varName = trim($parts[0]);
            $varTypeRaw = trim($parts[1]);
            $description = trim($parts[2] ?? $parts[3] ?? '');
            
            $varType = $this->mapVariableType($varTypeRaw);
            
            $role = 'feature';
            if (stripos($varName, 'target') !== false || stripos($varName, 'class') !== false || stripos($varName, 'label') !== false) {
                $role = 'target';
            } elseif (stripos($varName, 'id') === 0) {
                $role = 'id';
            }
            
            $variable = Variable::create([
                'dataset_id' => $dataset->dataset_id,
                'variable_name' => $varName,
                'display_name' => $varName,
                'role' => $role,
                'variable_type' => $varType,
                'description' => $description,
                'unit' => null,
                'min_value' => null,
                'max_value' => null,
                'missing_count' => 0,
                'unique_count' => null,
                'display_order' => $index,
                'is_visible' => true,
            ]);
            
            if ($varType === 'Categorical' && preg_match('/\{([^}]+)\}/', $attrLine, $matches)) {
                $categories = preg_split('/,\s*/', $matches[1], -1, PREG_SPLIT_NO_EMPTY);
                foreach ($categories as $catIndex => $catValue) {
                    VariableCategory::create([
                        'variable_id' => $variable->variable_id,
                        'category_value' => trim($catValue),
                        'category_label' => trim($catValue),
                        'display_order' => $catIndex,
                    ]);
                }
            }
        }
    }
    
    protected function mapVariableType(string $raw): string
    {
        $raw = strtolower(trim($raw));
        
        return match(true) {
            str_contains($raw, 'categorical') || str_contains($raw, 'nominal') => 'Categorical',
            str_contains($raw, 'integer') || str_contains($raw, 'int') => 'Integer',
            str_contains($raw, 'real') || str_contains($raw, 'float') || str_contains($raw, 'double') => 'Real',
            str_contains($raw, 'text') || str_contains($raw, 'string') => 'Text',
            str_contains($raw, 'binary') || str_contains($raw, 'boolean') => 'Binary',
            str_contains($raw, 'ordinal') => 'Ordinal',
            str_contains($raw, 'date') || str_contains($raw, 'time') => 'DateTime',
            default => 'Other',
        };
    }
    
    protected function attachPapers(Dataset $dataset, array $row, array $dbRow): void
    {
        if (!empty($dbRow['Identifier string']) && Str::startsWith($dbRow['Identifier string'], '10.')) {
            $paper = Paper::firstOrCreate(
                ['doi' => $dbRow['Identifier string']],
                [
                    'title' => $dataset->name,
                    'authors' => 'UCI Machine Learning Repository',
                    'venue' => 'UCI Machine Learning Repository',
                    'publication_year' => $row['Year'] ?? date('Y'),
                    'url' => $dbRow['Datapage URL'] ?? null,
                    'abstract' => $dbRow['Abstract'] ?? '',
                ]
            );
            
            $dataset->papers()->syncWithoutDetaching([
                $paper->paper_id => [
                    'citation_type' => 'introductory',
                    'is_primary' => true,
                ]
            ]);
        }
        
        $citationInfo = $dbRow['How to cite'] ?? $dbRow['Citation'] ?? '';
        if (!empty($citationInfo) && stripos($citationInfo, 'http') !== false) {
            if (preg_match('/https?:\/\/[^\s]+/', $citationInfo, $matches)) {
                $url = $matches[0];
                
                $paper = Paper::firstOrCreate(
                    ['url' => $url],
                    [
                        'title' => Str::limit($citationInfo, 200),
                        'authors' => 'Various',
                        'venue' => 'External Source',
                        'publication_year' => $row['Year'] ?? null,
                    ]
                );
                
                $dataset->papers()->syncWithoutDetaching([
                    $paper->paper_id => [
                        'citation_type' => 'citing',
                        'is_primary' => false,
                    ]
                ]);
            }
        }
    }
    
    protected function createPlaceholderFiles(Dataset $dataset, array $row, array $dbRow): void
    {
        $filename = Str::slug($dataset->name) . '.csv';
        
        $file = File::firstOrCreate(
            ['filename' => $filename, 'file_path' => "datasets/{$dataset->slug}/{$filename}"],
            [
                'original_filename' => $dataset->name . '.data',
                'file_size_bytes' => $this->parseFileSize($dbRow['File Size'] ?? null),
                'file_format' => 'csv',
                'mime_type' => 'text/csv',
                'description' => 'Main dataset file (placeholder)',
                'checksum_md5' => null,
                'checksum_sha256' => null,
            ]
        );
        
        $dataset->files()->syncWithoutDetaching([
            $file->file_id => [
                'file_role' => 'data',
                'is_default' => true,
                'display_order' => 0,
            ]
        ]);
        
        if (!empty($dbRow['Attribute Information']) || !empty($dbRow['Abstract'])) {
            $docFile = File::firstOrCreate(
                ['filename' => 'README.md', 'file_path' => "datasets/{$dataset->slug}/README.md"],
                [
                    'original_filename' => 'README.md',
                    'file_size_bytes' => null,
                    'file_format' => 'md',
                    'mime_type' => 'text/markdown',
                    'description' => 'Dataset documentation',
                ]
            );
            
            $dataset->files()->syncWithoutDetaching([
                $docFile->file_id => [
                    'file_role' => 'documentation',
                    'is_default' => false,
                    'display_order' => 1,
                ]
            ]);
        }
    }
    
    protected function createImages(Dataset $dataset, array $row, array $dbRow): void
    {
        if (!empty($dbRow['Thumbnail URL'])) {
            $imageUrl = $dbRow['Thumbnail URL'];
            $pathInfo = pathinfo(parse_url($imageUrl, PHP_URL_PATH) ?? $imageUrl);
            
            $image = Image::firstOrCreate(
                ['file_path' => parse_url($imageUrl, PHP_URL_PATH) ?? $imageUrl],
                [
                    'filename' => $pathInfo['basename'] ?? 'thumbnail.jpg',
                    'original_filename' => $pathInfo['basename'] ?? 'thumbnail.jpg',
                    'file_size_bytes' => null,
                    'mime_type' => 'image/' . ($pathInfo['extension'] ?? 'jpg'),
                    'width' => null,
                    'height' => null,
                    'alt_text' => $dataset->display_name ?? $dataset->name,
                    'caption' => null,
                    'image_type' => 'thumbnail',
                ]
            );
            
            $dataset->images()->syncWithoutDetaching([
                $image->image_id => [
                    'role' => 'thumbnail',
                    'is_primary' => true,
                    'display_order' => 0,
                ]
            ]);
        }
        
        if (!empty($dbRow['Large Image URL']) && $dbRow['Large Image URL'] !== $dbRow['Thumbnail URL']) {
            $imageUrl = $dbRow['Large Image URL'];
            $pathInfo = pathinfo(parse_url($imageUrl, PHP_URL_PATH) ?? $imageUrl);
            
            $image = Image::firstOrCreate(
                ['file_path' => parse_url($imageUrl, PHP_URL_PATH) ?? $imageUrl],
                [
                    'filename' => $pathInfo['basename'] ?? 'large.jpg',
                    'original_filename' => $pathInfo['basename'] ?? 'large.jpg',
                    'file_size_bytes' => null,
                    'mime_type' => 'image/' . ($pathInfo['extension'] ?? 'jpg'),
                    'width' => null,
                    'height' => null,
                    'alt_text' => $dataset->display_name ?? $dataset->name,
                    'caption' => null,
                    'image_type' => 'large',
                ]
            );
            
            $dataset->images()->syncWithoutDetaching([
                $image->image_id => [
                    'role' => 'large',
                    'is_primary' => false,
                    'display_order' => 1,
                ]
            ]);
        }
    }
    
    protected function extractDataType(array $row): ?string
    {
        $value = $row['Data Type'] ?? $row['Data Types'] ?? $row['Type'] ?? null;
        if (empty($value)) return null;
        
        $types = array_map('trim', explode(',', $value));
        foreach ($types as $type) {
            if (in_array($type, $this->validDataTypes)) {
                return $type;
            }
        }
        
        return null;
    }
    
    protected function extractTaskType(array $row): ?string
    {
        $value = $row['Default Task'] ?? $row['Task'] ?? $row['Associated Tasks'] ?? null;
        if (empty($value) || $value === 'Other/Unknown') return null;
        
        $tasks = array_map('trim', explode(',', $value));
        foreach ($tasks as $task) {
            if (in_array($task, $this->validTaskTypes)) {
                return $task;
            }
        }
        
        return null;
    }
    
    protected function validateEnum($value, array $allowed): ?string
    {
        if (empty($value)) return null;
        $value = trim($value);
        return in_array($value, $allowed) ? $value : null;
    }
    
    protected function parseCount($value): ?int
    {
        if ($value === null || $value === '' || $value === '-' || $value === 'null') return null;
        
        $value = strtoupper(trim($value));
        
        if (preg_match('/^([\d.]+)\s*([KMB])?$/', $value, $matches)) {
            $num = (float) $matches[1];
            $suffix = $matches[2] ?? null;
            return match($suffix) {
                'K' => (int) ($num * 1000),
                'M' => (int) ($num * 1000000),
                'B' => (int) ($num * 1000000000),
                default => (int) $num,
            };
        }
        
        $cleaned = preg_replace('/[^0-9]/', '', $value);
        return $cleaned !== '' ? (int) $cleaned : null;
    }
    
    protected function parseFileSize($value): ?int
    {
        if (empty($value)) return null;
        
        $value = strtoupper(trim($value));
        $value = preg_replace('/[()]/', '', $value);
        
        $multipliers = ['B' => 1, 'KB' => 1024, 'MB' => 1048576, 'GB' => 1073741824];
        
        foreach ($multipliers as $unit => $mult) {
            if (str_contains($value, $unit)) {
                if (preg_match('/([\d.]+)/', $value, $matches)) {
                    return (int) ((float) $matches[1] * $mult);
                }
            }
        }
        
        return null;
    }
    
    protected function parseDate($value): ?string
    {
        if (empty($value)) return null;
        
        if (is_numeric($value) && strlen($value) === 4) {
            return "{$value}-01-01";
        }
        
        $formats = ['Y-m-d', 'n/j/Y', 'd/m/Y', 'F j, Y', 'Y'];
        
        foreach ($formats as $format) {
            try {
                $date = Carbon::createFromFormat($format, trim($value));
                if ($date) {
                    return $date->format('Y-m-d');
                }
            } catch (\Exception) {
                continue;
            }
        }
        
        return null;
    }
    
    protected function parseBoolean($value): bool
    {
        if (is_bool($value)) return $value;
        $lower = strtolower(trim((string) $value));
        return in_array($lower, ['1', 'true', 'yes', 'y', 'on']);
    }
    
    protected function validateUrl($value): ?string
    {
        if (empty($value)) return null;
        $value = trim($value);
        return filter_var($value, FILTER_VALIDATE_URL) ? $value : null;
    }

protected function extractShortUciId(?string $value, string $fallbackName): ?string
{
    if (empty($value)) return null;
    
    if (preg_match('/^\d{10}-\d{3,4}$/', trim($value))) {
        return trim($value);
    }
    
    if (filter_var($value, FILTER_VALIDATE_URL)) {
        $parsed = parse_url($value);
        $path = $parsed['path'] ?? '';
        $segments = explode('/', trim($path, '/'));
        $last = end($segments);
        
        if (preg_match('/^\d{10}-\d{3,4}$/', $last)) {
            return $last;
        }
    }
    
    $slug = Str::slug($fallbackName);
    $shortId = substr($slug, 0, 10) . '-' . substr(md5($fallbackName), 0, 3);
    
    return $shortId;
}
}