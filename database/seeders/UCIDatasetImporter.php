<?php

namespace Database\Seeders;

use App\Models\{Dataset, Task, SubjectArea, License, Creator, Keyword};
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UCIDatasetImporter extends Seeder
{
    public function run(): void
    {
        echo "Starting UCI Dataset Import...\n";
       
        $csvTable = $this->readCSV(database_path('seeders/data/UCI table.csv'));
        $csvDatabase = $this->readCSV(database_path('seeders/data/UCI database.csv'));
        
        echo "Loaded " . count($csvTable) . " datasets from UCI table.csv\n";
        echo "Loaded " . count($csvDatabase) . " datasets from UCI database.csv\n";
       
        $dbIndexed = collect($csvDatabase)->keyBy('Name');
       
        $defaultLicense = License::firstOrCreate(
            ['license_name' => 'CC BY 4.0'],
            ['license_url' => 'https://creativecommons.org/licenses/by/4.0/']
        );
        
        $count = 0;
        $failed = 0;
        
        foreach ($csvTable as $index => $row) {
            try {
                echo "\n[" . ($index + 1) . "/" . count($csvTable) . "] Processing: " . $row['Name'] . "\n";
             
                $dbData = $dbIndexed->get($row['Name'], []);
             
                $taskId = null;
                if (!empty($row['Default Task'])) {
                    $taskName = $row['Default Task'];
                    $task = Task::firstOrCreate(['task_name' => $taskName]);
                    $taskId = $task->task_id;
                    echo "Task: {$taskName}\n";
                }
              
                $subjectAreaId = null;
                $characteristics = $row['Data Types'] ?? null;
            
                if (Str::contains(strtolower($characteristics ?? ''), 'text')) {
                    $subjectArea = SubjectArea::firstOrCreate(['area_name' => 'Computer Science']);
                    $subjectAreaId = $subjectArea->area_id;
                } elseif (Str::contains(strtolower($characteristics ?? ''), 'image')) {
                    $subjectArea = SubjectArea::firstOrCreate(['area_name' => 'Computer Science']);
                    $subjectAreaId = $subjectArea->area_id;
                } elseif (Str::contains(strtolower($characteristics ?? ''), 'bio')) {
                    $subjectArea = SubjectArea::firstOrCreate(['area_name' => 'Biology']);
                    $subjectAreaId = $subjectArea->area_id;
                } else {
                    $subjectArea = SubjectArea::firstOrCreate(['area_name' => 'Computer Science']);
                    $subjectAreaId = $subjectArea->area_id;
                }
            
                $year = !empty($row['Year']) ? (int)$row['Year'] : date('Y');
              
                $dataset = Dataset::create([
                    'name' => $row['Name'],
                    'description' => $dbData['Abstract'] ?? $row['Name'],
                    'donated_date' => now(),
                    'last_updated' => now(),
                    'characteristics' => $characteristics,
                    'feature_type' => $row['Attribute Types'] ?? null,
                    'num_instances' => !empty($row['Number of Instances']) ? (int)$row['Number of Instances'] : null,
                    'num_features' => !empty($row['Number of Attributes']) ? (int)$row['Number of Attributes'] : null,
                    'has_missing_values' => false,
                    'task_id' => $taskId,
                    'subject_area_id' => $subjectAreaId,
                    'license_id' => $defaultLicense->license_id,
                    'view_count' => 0,
                    'download_count' => 0,
                    'citation_count' => 0,
                    'additional_info' => json_encode([
                        'sample_size' => $row['Sample size'] ?? null,
                        'identifier' => $dbData['Identifier string'] ?? null,
                        'datapage_url' => $dbData['Datapage URL'] ?? null,
                        'year' => $year,
                    ]),
                ]);
                
                echo "Dataset created: {$dataset->name}\n";
            
                $creator = Creator::firstOrCreate(
                    ['name' => 'UCI Machine Learning Repository'],
                    ['email' => 'archive@ics.uci.edu']
                );
                $dataset->creators()->attach($creator->creator_id, ['contribution_role' => 'Donor']);
                echo "Creator attached\n";
            
                if (!empty($characteristics)) {
                    $chars = explode(',', $characteristics);
                    foreach ($chars as $char) {
                        $char = trim($char);
                        if (!empty($char)) {
                            $keyword = Keyword::firstOrCreate(['keyword_name' => $char]);
                            $dataset->keywords()->attach($keyword->keyword_id);
                        }
                    }
                    echo "Keywords added\n";
                }
                
                $count++;
                
            } catch (\Exception $e) {
                echo "Error: " . $e->getMessage() . "\n";
                $failed++;
            }
        }
        
        echo "\nImport completed!\n";
        echo "Success: {$count} datasets\n";
        echo "Failed: {$failed} datasets\n";
    }
    
    private function readCSV($filePath)
    {
        $data = [];
        if (($handle = fopen($filePath, "r")) !== FALSE) {
            $headers = fgetcsv($handle);
            while (($row = fgetcsv($handle)) !== FALSE) {
                $data[] = array_combine($headers, $row);
            }
            fclose($handle);
        }
        return $data;
    }
}