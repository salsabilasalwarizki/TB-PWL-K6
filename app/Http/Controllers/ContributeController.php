<?php

namespace App\Http\Controllers;

use App\Models\{Dataset, Person, Variable, File, Task, SubjectArea, License, Doi, Keyword, Paper, Image, VariableCategory};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;

class ContributeController extends Controller
{

    public function policy()
    {
        return view('contribute.policy');
    }

    public function linkingPolicy()
    {
        return view('linking.policy');
    }

    public function fetchUrlMetadata(Request $request)
    {
        $request->validate([
            'url' => 'required|url|max:500',
        ]);

        $url = $request->input('url');
        $metadata = [
            'title' => '',
            'description' => '',
            'num_instances' => null,
            'num_features' => null,
        ];

        try {
            $response = Http::timeout(15)
                ->withHeaders([
                    'User-Agent' => 'Mozilla/5.0 (compatible; DataSphereBot/1.0)',
                ])
                ->get($url);

            if ($response->successful()) {
                $html = $response->body();
                
                
                if (preg_match('/<title[^>]*>(.*?)<\/title>/si', $html, $matches)) {
                    $metadata['title'] = trim(strip_tags($matches[1]));
                }
                
                
                if (preg_match('/<meta[^>]+name=["\']description["\'][^>]+content=["\'](.*?)["\']/si', $html, $matches)) {
                    $metadata['description'] = trim(strip_tags($matches[1]));
                } elseif (preg_match('/<meta[^>]+property=["\']og:description["\'][^>]+content=["\'](.*?)["\']/si', $html, $matches)) {
                    $metadata['description'] = trim(strip_tags($matches[1]));
                }

                
                if (preg_match('/(\d+)\s*(instances?|rows?|samples?)/i', $html, $matches)) {
                    $metadata['num_instances'] = (int)$matches[1];
                }

                
                if (preg_match('/(\d+)\s*(features?|attributes?|columns?)/i', $html, $matches)) {
                    $metadata['num_features'] = (int)$matches[1];
                }

                Log::info('URL metadata fetched successfully', ['url' => $url, 'metadata' => $metadata]);
            }

            return response()->json([
                'success' => true,
                'data' => $metadata,
            ]);

        } catch (\Exception $e) {
            Log::error('Failed to fetch URL metadata', ['url' => $url, 'error' => $e->getMessage()]);
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch metadata: ' . $e->getMessage(),
                'data' => $metadata,
            ], 500);
        }
    }

    public function createMetadata()
    {
        $tasks = Task::all();
        $subjectAreas = SubjectArea::all();
        $oldData = Session::get('contribute_data', []);
        
        return view('contribute.metadata', compact('tasks', 'subjectAreas', 'oldData'));
    }

    public function storeMetadata(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'abstract' => 'required|string|max:1000',
            'num_instances' => 'required|integer|min:0',
            'num_features' => 'nullable|integer|min:0',
            'doi' => 'nullable|string|max:255',
            'characteristics' => 'required|array|min:1',
            'characteristics.*' => 'string|in:Tabular,Sequential,Multivariate,Time-Series,Text,Image,Spatiotemporal,Other',
            'subject_area' => 'required|string',
            'associated_tasks' => 'required|array|min:1',
            'associated_tasks.*' => 'string|in:Classification,Regression,Clustering,Other',
            'feature_types' => 'nullable|array',
            'feature_types.*' => 'string|in:Real,Categorical,Integer',
        ]);

        Session::put('contribute_data', array_merge([
            'paper' => [], 'creators' => [], 'files' => [], 
            'keywords' => [], 'variables' => [], 'variable_info' => null, 'class_labels' => null,
        ], [
            'name' => $validated['name'],
            'description' => $validated['abstract'],
            'num_instances' => $validated['num_instances'],
            'num_features' => $validated['num_features'] ?? null,
            'doi' => $validated['doi'] ?? null,
            'characteristics' => $validated['characteristics'],
            'subject_area' => $validated['subject_area'],
            'associated_tasks' => $validated['associated_tasks'],
            'feature_types' => $validated['feature_types'] ?? [],
        ]));

        return redirect()->route('contribute.paper');
    }

    public function createPaper()
    {
        if (!Session::has('contribute_data')) {
            return redirect()->route('contribute.metadata')->with('error', 'Please fill metadata first.');
        }
        $oldPaper = Session::get('contribute_data.paper', []);
        return view('contribute.paper', compact('oldPaper'));
    }

    public function storePaper(Request $request)
    {
        $validated = $request->validate([
            'paper_id_type' => 'nullable|string|in:DOI,arXiv,PubMed,None',
            'paper_id' => 'nullable|string|max:255',
            'title' => 'required|string|max:500',
            'authors' => 'required|string|max:1000',
            'venue' => 'required|string|max:255',
            'year' => 'required|integer|min:1900|max:' . date('Y'),
            'url' => 'nullable|url|max:500',
        ]);

        $data = Session::get('contribute_data', []);
        $data['paper'] = $validated;
        Session::put('contribute_data', $data);

        return redirect()->route('contribute.creators');
    }

    public function createCreators()
    {
        if (!Session::has('contribute_data')) {
            return redirect()->route('contribute.metadata')->with('error', 'Please fill metadata first.');
        }
        $creatorsData = Session::get('contribute_data.creators', []);
        return view('contribute.creators', compact('creatorsData'));
    }

    public function storeCreators(Request $request)
    {
        $validated = $request->validate([
            'creators' => 'nullable|array',
            'creators.*.name' => 'required_with:creators|string|max:255',
            'creators.*.affiliation' => 'nullable|string|max:255',
            'creators.*.email' => 'nullable|email|max:255',
            'creators.*.orcid' => 'nullable|regex:/^\d{4}-\d{4}-\d{4}-\d{4}$/|max:20',
            'creators.*.contribution_role' => 'nullable|string|in:Creator,Donor,Analyst,Data Collector,Other',
        ]);

        $data = Session::get('contribute_data', []);
        $data['creators'] = $validated['creators'] ?? [];
        Session::put('contribute_data', $data);

        return redirect()->route('contribute.files');
    }

    public function createFiles()
    {
        if (!Session::has('contribute_data')) {
            return redirect()->route('contribute.metadata')->with('error', 'Please fill metadata first.');
        }
        return view('contribute.files');
    }

    public function storeFiles(Request $request)
    {
        $isTabular = $request->input('file_format') === 'tabular';
        
        if ($isTabular) {
            $request->validate([
                'file_format' => 'required|in:tabular,other',
                'tabular_file' => 'required|file|max:51200',
                'has_header' => 'nullable|in:0,1',
                'has_missing' => 'nullable|in:0,1',
            ]);
        } else {
            $request->validate([
                'file_format' => 'required|in:tabular,other',
                'dataset_file' => 'required|file|max:51200',
            ]);
        }
        
        $files = [];
        
        if ($isTabular) {
            $f = $request->file('tabular_file');
            $tempName = 'tmp_' . uniqid() . '_' . Str::slug($f->getClientOriginalName());
            $path = $f->storeAs('temp/donation', $tempName, 'local');
            
            $files[] = [
                'name' => $f->getClientOriginalName(),
                'extension' => $f->getClientOriginalExtension(),
                'size' => $f->getSize(),
                'mime' => $f->getMimeType(),
                'temp_path' => $path,
                'is_primary' => true,
                'role' => 'data',
            ];
            
            if ($request->hasFile('other_file')) {
                $otherFile = $request->file('other_file');
                $tempName2 = 'tmp_' . uniqid() . '_' . Str::slug($otherFile->getClientOriginalName());
                $path2 = $otherFile->storeAs('temp/donation', $tempName2, 'local');
                
                $files[] = [
                    'name' => $otherFile->getClientOriginalName(),
                    'extension' => $otherFile->getClientOriginalExtension(),
                    'size' => $otherFile->getSize(),
                    'mime' => $otherFile->getMimeType(),
                    'temp_path' => $path2,
                    'is_primary' => false,
                    'role' => 'other',
                ];
            }
            
            if ($request->hasFile('test_file')) {
                $testFile = $request->file('test_file');
                $tempName3 = 'tmp_' . uniqid() . '_' . Str::slug($testFile->getClientOriginalName());
                $path3 = $testFile->storeAs('temp/donation', $tempName3, 'local');
                
                $files[] = [
                    'name' => $testFile->getClientOriginalName(),
                    'extension' => $testFile->getClientOriginalExtension(),
                    'size' => $testFile->getSize(),
                    'mime' => $testFile->getMimeType(),
                    'temp_path' => $path3,
                    'is_primary' => false,
                    'role' => 'test',
                ];
            }
        } else {
            $f = $request->file('dataset_file');
            $tempName = 'tmp_' . uniqid() . '_' . Str::slug($f->getClientOriginalName());
            $path = $f->storeAs('temp/donation', $tempName, 'local');
            
            $files[] = [
                'name' => $f->getClientOriginalName(),
                'extension' => $f->getClientOriginalExtension(),
                'size' => $f->getSize(),
                'mime' => $f->getMimeType(),
                'temp_path' => $path,
                'is_primary' => true,
                'role' => 'data',
            ];
            
            if ($request->hasFile('test_file_other')) {
                $testFile = $request->file('test_file_other');
                $tempName2 = 'tmp_' . uniqid() . '_' . Str::slug($testFile->getClientOriginalName());
                $path2 = $testFile->storeAs('temp/donation', $tempName2, 'local');
                
                $files[] = [
                    'name' => $testFile->getClientOriginalName(),
                    'extension' => $testFile->getClientOriginalExtension(),
                    'size' => $testFile->getSize(),
                    'mime' => $testFile->getMimeType(),
                    'temp_path' => $path2,
                    'is_primary' => false,
                    'role' => 'test',
                ];
            }
        }
        
        $data = session('contribute_data', []);
        $data['files'] = $files;
        $data['has_header'] = $request->input('has_header', '0');
        $data['has_missing'] = $request->input('has_missing', '0');
        session(['contribute_data' => $data]);
        session()->save();
        
        return redirect()->route('contribute.keywords');
    }


    public function createKeywords()
    {
        if (!Session::has('contribute_data')) {
            return redirect()->route('contribute.metadata')->with('error', 'Please fill metadata first.');
        }
        
        $keywordsData = Session::get('contribute_data.keywords', []);
        $allKeywords = array_unique(array_merge(
            Keyword::pluck('keyword_name')->toArray(),
            ['Classification', 'Regression', 'Clustering', 'Machine Learning']
        ));
        sort($allKeywords);
        
        return view('contribute.keywords', compact('keywordsData', 'allKeywords'));
    }

    public function storeKeywords(Request $request)
    {
        $validated = $request->validate(['keywords' => 'nullable|string|max:1000']);
        
        $keywords = [];
        if (!empty($validated['keywords'])) {
            $keywords = array_map(fn($k) => Str::title(trim($k)), 
                array_filter(json_decode($validated['keywords'], true) ?? []));
        }
        
        $data = Session::get('contribute_data', []);
        $data['keywords'] = $keywords;
        Session::put('contribute_data', $data);
        
        return redirect()->route('contribute.variable-info');
    }

    public function createVariableInfo()
    {
        if (!Session::has('contribute_data')) {
            return redirect()->route('contribute.metadata')->with('error', 'Please fill metadata first.');
        }
        $variables = Session::get('contribute_data.variables', []);
        return view('contribute.variable-info', compact('variables'));
    }

    public function storeVariableInfo(Request $request)
    {
        $data = session('contribute_data', []);
        $data['variables'] = $request->input('variables', []);
        session(['contribute_data' => $data]);
        session()->save();
        
        return redirect()->route('contribute.descriptive');
    }

    public function createDescriptive()
    {
        if (!Session::has('contribute_data')) {
            return redirect()->route('contribute.metadata')->with('error', 'Please fill metadata first.');
        }
        $data = Session::get('contribute_data');
        return view('contribute.descriptive', compact('data'));
    }

    public function submitDonation(Request $request)
    {
        set_time_limit(300);
        ini_set('memory_limit', '512M');
        
        $data = Session::get('contribute_data');
        
        if (!$data || empty($data['name'])) {
            return redirect()->route('contribute.policy')
                ->with('error', 'Session expired. Please start over.');
        }

        $validated = $request->validate([
            'purpose' => 'required|string|max:5000',
            'funding' => 'nullable|string|max:1000',
            'instances_represent' => 'required|string|max:1000',
            'data_splits' => 'nullable|string|max:1000',
            'sensitive_data' => 'nullable|string|max:2000',
            'preprocessing' => 'nullable|string|max:5000',
            'additional_info' => 'nullable|string|max:10000',
            'citation_requests' => 'nullable|string|max:2000',
        ]);
        
        try {
            DB::beginTransaction();
            Log::info('=== SUBMIT DONATION: Start ===', ['user_id' => Auth::id(), 'dataset' => $data['name']]);

            
            $task = Task::where('task_name', $data['associated_tasks'][0] ?? 'Other')->first();
            if (!$task) $task = Task::firstOrCreate(['task_name' => 'Other']);
            
            $subjectArea = SubjectArea::where('area_name', $data['subject_area'] ?? 'Other')->first();
            if (!$subjectArea) $subjectArea = SubjectArea::firstOrCreate(['area_name' => $data['subject_area'] ?? 'Other']);
            
            $license = License::where('license_name', 'CC BY 4.0')->first();
            if (!$license) $license = License::firstOrCreate(['license_name' => 'CC BY 4.0']);

            
            $dataset = Dataset::create([
                'user_id' => Auth::id(),
                'name' => $data['name'],
                'slug' => Str::slug($data['name']) . '-' . time(),
                'description' => $data['description'] ?? '',
                'abstract' => $data['description'] ?? '',
                'num_instances' => $data['num_instances'] ?? null,
                'num_features' => $data['num_features'] ?? null,
                'data_type' => !empty($data['characteristics']) ? implode(', ', $data['characteristics']) : null,
                'task_type' => !empty($data['associated_tasks']) ? implode(', ', $data['associated_tasks']) : null,
                'subject_area' => $data['subject_area'] ?? null,
                'has_missing_values' => ($data['has_missing'] ?? '0') === '1',
                'task_id' => $task->task_id,
                'subject_area_id' => $subjectArea->area_id,
                'license_id' => $license->license_id,
                'view_count' => 0,
                'download_count' => 0,
                'citation_count' => 0,
                'status' => 'pending',
                'donated_date' => now()->format('Y-m-d'),
            ]);
            Log::info('Dataset created', ['id' => $dataset->dataset_id]);

            
            DB::table('dataset_descriptions')->insert([
                'dataset_id' => $dataset->dataset_id,
                'purpose' => $validated['purpose'] ?? null,
                'funding' => $validated['funding'] ?? null,
                'instances_represent' => $validated['instances_represent'] ?? null,
                'data_splits' => $validated['data_splits'] ?? null,
                'sensitive_data' => $validated['sensitive_data'] ?? null,
                'preprocessing' => $validated['preprocessing'] ?? null,
                'additional_info' => $validated['additional_info'] ?? null,
                'citation_requests' => $validated['citation_requests'] ?? null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            
            if (!empty($data['doi'])) {
                $doi = Doi::firstOrCreate(
                    ['doi_string' => $data['doi']],
                    ['resolution_url' => "https://doi.org/{$data['doi']}"]
                );
                $dataset->update(['doi_id' => $doi->doi_id]);
            }

           
            if (!empty($data['paper']['title'])) {
                $paper = Paper::create([
                    'title' => $data['paper']['title'],
                    'authors' => $data['paper']['authors'],
                    'doi' => $data['paper']['paper_id_type'] !== 'None' ? $data['paper']['paper_id'] : null,
                    'venue' => $data['paper']['venue'],
                    'publication_year' => $data['paper']['year'],
                    'url' => $data['paper']['url'],
                ]);
                
                DB::table('dataset_papers')->insert([
                    'dataset_id' => $dataset->dataset_id,
                    'paper_id' => $paper->paper_id,
                    'citation_type' => 'introductory',
                    'is_primary' => true,
                    'created_at' => now(),
                ]);
            }

            
            $user = Auth::user();
            $creators = $data['creators'] ?? [];
            
            if (is_array($creators) && count($creators) > 0) {
                foreach ($creators as $i => $c) {
                    if (empty($c['name'])) continue;
                    
                    $person = Person::firstOrCreate(
                        ['name' => $c['name']],
                        [
                            'affiliation' => $c['affiliation'] ?? null,
                            'email' => $c['email'] ?? null,
                            'orcid' => $c['orcid'] ?? null,
                        ]
                    );
                    
                    DB::table('dataset_contributors')->insert([
                        'dataset_id' => $dataset->dataset_id,
                        'person_id' => $person->person_id,
                        'contribution_role' => strtolower($c['contribution_role'] ?? 'creator'),
                        'display_order' => $i + 1,
                        'created_at' => now(),
                    ]);
                }
            } else {
                $person = Person::firstOrCreate(
                    ['name' => $user->name],
                    ['affiliation' => null, 'email' => $user->email]
                );
                DB::table('dataset_contributors')->insert([
                    'dataset_id' => $dataset->dataset_id,
                    'person_id' => $person->person_id,
                    'contribution_role' => 'donor',
                    'display_order' => 1,
                    'created_at' => now(),
                ]);
            }

            
            if (!empty($data['keywords']) && is_array($data['keywords'])) {
                foreach ($data['keywords'] as $kw) {
                    if (empty($kw)) continue;
                    
                    $keyword = Keyword::firstOrCreate(
                        ['keyword_name' => $kw],
                        ['slug' => Str::slug($kw)]
                    );
                    
                    DB::table('dataset_keywords')->insert([
                        'dataset_id' => $dataset->dataset_id,
                        'keyword_id' => $keyword->keyword_id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }

            
            if (!empty($data['variables']) && is_array($data['variables'])) {
                foreach ($data['variables'] as $i => $var) {
                    if (empty($var['name'])) continue;
                    
                    $variable = Variable::create([
                        'dataset_id' => $dataset->dataset_id,
                        'variable_name' => $var['name'],
                        'display_name' => $var['display_name'] ?? null,
                        'role' => strtolower($var['role'] ?? 'feature'),
                        'variable_type' => $var['type'] ?? 'Continuous',
                        'description' => $var['description'] ?? null,
                        'unit' => $var['units'] ?? null,
                        'min_value' => isset($var['min']) ? (float)$var['min'] : null,
                        'max_value' => isset($var['max']) ? (float)$var['max'] : null,
                        'display_order' => $i + 1,
                        'is_visible' => true,
                    ]);

                    
                    if (($var['type'] ?? '') === 'Categorical' && !empty($var['categories'])) {
                        $categories = explode(',', $var['categories']);
                        foreach ($categories as $catIndex => $catValue) {
                            $catValue = trim($catValue);
                            if (!empty($catValue)) {
                                VariableCategory::create([
                                    'variable_id' => $variable->variable_id,
                                    'category_value' => $catValue,
                                    'display_order' => $catIndex + 1,
                                ]);
                            }
                        }
                    }
                }
            }

            
            if (!empty($data['files']) && is_array($data['files'])) {
                $uploadPath = "datasets/{$dataset->slug}";
                Storage::disk('public')->makeDirectory($uploadPath);

                foreach ($data['files'] as $i => $fileMeta) {
                    if (!isset($fileMeta['temp_path'])) continue;
                    
                    if (Storage::disk('local')->exists($fileMeta['temp_path'])) {
                        $content = Storage::disk('local')->get($fileMeta['temp_path']);
                        $finalName = basename($fileMeta['temp_path']);
                        $finalPath = "{$uploadPath}/{$finalName}";
                        
                        Storage::disk('public')->put($finalPath, $content);

                        $file = File::create([
                            'filename' => $finalName,
                            'original_filename' => $fileMeta['name'],
                            'file_path' => $finalPath,
                            'file_size_bytes' => $fileMeta['size'],
                            'mime_type' => $fileMeta['mime'],
                            'file_format' => strtoupper($fileMeta['extension']),
                            'description' => $fileMeta['role'] === 'data' ? 'Main dataset file' : ucfirst($fileMeta['role']) . ' file',
                        ]);
                        
                        DB::table('dataset_files')->insert([
                            'dataset_id' => $dataset->dataset_id,
                            'file_id' => $file->file_id,
                            'file_role' => $fileMeta['role'],
                            'is_default' => $fileMeta['is_primary'] ?? ($i === 0),
                            'display_order' => $i,
                            'created_at' => now(),
                        ]);
                        
                        Storage::disk('local')->delete($fileMeta['temp_path']);
                    }
                }
            }

            DB::commit();
            Session::forget('contribute_data');
            
            if (Storage::disk('local')->directoryExists('temp/donation')) {
                Storage::disk('local')->deleteDirectory('temp/donation');
            }
            
            Log::info('=== SUBMIT DONATION: SUCCESS ===', ['dataset_id' => $dataset->dataset_id]);
            
            return redirect()->route('profile.datasets')
                ->with('success', '🎉 Dataset "' . $dataset->name . '" berhasil disubmit! Menunggu review.');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('SUBMIT DONATION FAILED: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'user_id' => Auth::id(),
                'file' => $e->getFile() . ':' . $e->getLine(),
            ]);
            
            return redirect()->back()
                ->with('error', 'Gagal submit: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function createExternalLink() 
    { 
        return view('linking.metadata'); 
    }
    
    public function submitExternalLink(Request $request) 
    {
        return redirect()->route('profile.datasets')
            ->with('success', 'External link submitted!');
    }
    
    public function createLinkingMetadata() 
    { 
        return view('linking.metadata'); 
    }
    
    public function storeLinkingMetadata(Request $request) 
    {
        $validated = $request->validate([
            'external_url' => 'required|url|max:500',
            'name' => 'required|string|max:255',
            'abstract' => 'required|string|max:1000',
            'num_instances' => 'required|integer|min:0',
            'num_features' => 'nullable|integer|min:0',
            'doi' => 'nullable|string|max:255',
            'characteristics' => 'required|array|min:1',
            'subject_area' => 'required|string',
            'associated_tasks' => 'required|array|min:1',
            'feature_types' => 'nullable|array',
        ]);
        
        Session::put('linking_data', array_merge([
            'paper' => [], 'creators' => [], 'keywords' => [], 
            'variable_info' => null, 'class_labels' => null,
        ], [
            'external_url' => $validated['external_url'],
            'name' => $validated['name'],
            'description' => $validated['abstract'],
            'num_instances' => $validated['num_instances'],
            'num_features' => $validated['num_features'] ?? null,
            'doi' => $validated['doi'] ?? null,
            'characteristics' => $validated['characteristics'],
            'subject_area' => $validated['subject_area'],
            'associated_tasks' => $validated['associated_tasks'],
            'feature_types' => $validated['feature_types'] ?? [],
        ]));
        
        return redirect()->route('contribute.linking.paper');
    }
    
    public function createLinkingPaper() 
    {
        if (!Session::has('linking_data')) {
            return redirect()->route('contribute.linking.metadata')
                ->with('error', 'Fill metadata first.');
        }
        $oldPaper = Session::get('linking_data.paper', []);
        return view('linking.paper', compact('oldPaper'));
    }
    
    public function storeLinkingPaper(Request $request) 
    {
        $validated = $request->validate([
            'paper_id_type' => 'nullable|string',
            'paper_id' => 'nullable|string|max:255',
            'title' => 'required|string|max:500',
            'authors' => 'required|string|max:1000',
            'venue' => 'required|string|max:255',
            'year' => 'required|integer|min:1900|max:' . date('Y'),
            'url' => 'nullable|url|max:500',
        ]);
        
        $data = Session::get('linking_data', []);
        $data['paper'] = $validated;
        Session::put('linking_data', $data);
        
        return redirect()->route('contribute.linking.creators');
    }
    
    public function createLinkingCreators() 
    {
        if (!Session::has('linking_data')) {
            return redirect()->route('contribute.linking.metadata')
                ->with('error', 'Fill metadata first.');
        }
        return view('linking.creators');
    }
    
    public function storeLinkingCreators(Request $request) 
    {
        $validated = $request->validate([
            'creators' => 'nullable|array',
            'creators.*.first_name' => 'required_with:creators|string|max:255',
            'creators.*.last_name' => 'required_with:creators|string|max:255',
            'creators.*.email' => 'nullable|email|max:255',
            'creators.*.institution' => 'nullable|string|max:255',
            'creators.*.institution_address' => 'nullable|string|max:500',
        ]);
        
        $data = Session::get('linking_data', []);
        if (!empty($validated['creators'])) {
            $cleanCreators = array_filter($validated['creators'], 
                fn($c) => !empty($c['first_name']) || !empty($c['last_name']));
            $data['creators'] = array_values($cleanCreators);
        } else {
            $data['creators'] = [];
        }
        
        Session::put('linking_data', $data);
        return redirect()->route('contribute.linking.keywords');
    }
    
    public function createLinkingKeywords() 
    {
        $allKeywords = array_unique(array_merge(
            Keyword::pluck('keyword_name')->toArray(),
            ['Classification', 'Regression', 'Clustering', 'Machine Learning']
        ));
        $keywordsData = Session::get('linking_data.keywords', []);
        
        return view('linking.keywords', compact('allKeywords', 'keywordsData'));
    }
    
    public function storeLinkingKeywords(Request $request) 
    {
        $validated = $request->validate(['keywords' => 'nullable|string']);
        $data = Session::get('linking_data', []);
        $data['keywords'] = !empty($validated['keywords']) 
            ? json_decode($validated['keywords'], true) 
            : [];
        Session::put('linking_data', $data);
        
        return redirect()->route('contribute.linking.variable-info');
    }
    
    public function createLinkingVariableInfo() 
    {
        if (!Session::has('linking_data')) {
            return redirect()->route('contribute.linking.metadata')
                ->with('error', 'Fill metadata first.');
        }
        $data = Session::get('linking_data');
        return view('linking.variable-info', compact('data'));
    }
    
    public function storeLinkingVariableInfo(Request $request) 
    {
        $validated = $request->validate([
            'class_labels' => 'nullable|string|max:5000',
            'variable_info' => 'nullable|string|max:10000',
        ]);
        
        $data = Session::get('linking_data');
        $data['class_labels'] = $validated['class_labels'] ?? null;
        $data['variable_info'] = $validated['variable_info'] ?? null;
        Session::put('linking_data', $data);
        
        return redirect()->route('contribute.linking.descriptive');
    }
    
    public function createLinkingDescriptive() 
    {
        $data = Session::get('linking_data', []);
        if (empty($data)) {
            Log::error('Session linking_data KOSONG!');
            return redirect()->route('contribute.linking.metadata')
                ->with('error', 'Session expired.');
        }
        return view('linking.descriptive', compact('data'));
    }
    
    public function submitLinking(Request $request) 
    {
        set_time_limit(300);
        ini_set('memory_limit', '512M');
        
        Log::info('🚀 SUBMIT LINKING: Start', ['user_id' => auth()->id()]);
        
        $validated = $request->validate([
            'purpose' => 'nullable|string|max:5000',
            'funding' => 'nullable|string|max:1000',
            'instances_represent' => 'nullable|string|max:1000',
            'data_splits' => 'nullable|string|max:1000',
            'sensitive_data' => 'nullable|string|max:2000',
            'preprocessing' => 'nullable|string|max:5000',
            'additional_info' => 'nullable|string|max:10000',
            'citation_requests' => 'nullable|string|max:2000',
        ]);
        
        $data = Session::get('linking_data', []);
        
        if (empty($data) || empty($data['name'])) {
            Log::warning('⚠️ Session linking_data kosong');
            return redirect()->back()
                ->with('error', '⚠️ Sesi habis. Silakan mulai dari awal.');
        }
        
        try {
            DB::beginTransaction();
            
            
            $task = Task::where('task_name', $data['associated_tasks'][0] ?? 'Other')->first();
            if (!$task) $task = Task::firstOrCreate(['task_name' => 'Other']);
            
            $subjectArea = SubjectArea::where('area_name', $data['subject_area'] ?? 'Other')->first();
            if (!$subjectArea) $subjectArea = SubjectArea::firstOrCreate(['area_name' => $data['subject_area'] ?? 'Other']);
            
            $license = License::where('license_name', 'CC BY 4.0')->first();
            if (!$license) $license = License::firstOrCreate(['license_name' => 'CC BY 4.0']);
            
            
            $dataset = Dataset::create([
                'user_id' => auth()->id(),
                'name' => $data['name'],
                'slug' => Str::slug($data['name']) . '-' . time(),
                'description' => $data['description'] ?? ($data['abstract'] ?? ''),
                'abstract' => $data['description'] ?? ($data['abstract'] ?? ''),
                'dataset_url' => $data['external_url'] ?? null,
                'linked_date' => now()->format('Y-m-d'),
                'status' => 'pending',
                'donated_date' => now()->format('Y-m-d'),
                'num_instances' => $data['num_instances'] ?? null,
                'num_features' => $data['num_features'] ?? null,
                'view_count' => 0,
                'download_count' => 0,
                'citation_count' => 0,
                'has_missing_values' => false,
                'subject_area' => $data['subject_area'] ?? null,
                'data_type' => !empty($data['characteristics']) ? implode(', ', $data['characteristics']) : null,
                'task_type' => !empty($data['associated_tasks']) ? implode(', ', $data['associated_tasks']) : null,
                'task_id' => $task->task_id,
                'subject_area_id' => $subjectArea->area_id,
                'license_id' => $license->license_id,
            ]);
            
            Log::info('✅ Dataset created', ['dataset_id' => $dataset->dataset_id]);
            
            
            DB::table('dataset_descriptions')->insert([
                'dataset_id' => $dataset->dataset_id,
                'purpose' => $validated['purpose'] ?? null,
                'funding' => $validated['funding'] ?? null,
                'instances_represent' => $validated['instances_represent'] ?? null,
                'data_splits' => $validated['data_splits'] ?? null,
                'sensitive_data' => $validated['sensitive_data'] ?? null,
                'preprocessing' => $validated['preprocessing'] ?? null,
                'additional_info' => $validated['additional_info'] ?? null,
                'citation_requests' => $validated['citation_requests'] ?? null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            
            
            if (!empty($data['doi'])) {
                $doi = Doi::firstOrCreate(
                    ['doi_string' => $data['doi']],
                    ['resolution_url' => "https://doi.org/{$data['doi']}"]
                );
                $dataset->update(['doi_id' => $doi->doi_id]);
            }
            
           
            if (!empty($data['paper']['title'])) {
                $paper = Paper::create([
                    'title' => $data['paper']['title'],
                    'authors' => $data['paper']['authors'],
                    'doi' => $data['paper']['paper_id_type'] !== 'None' ? $data['paper']['paper_id'] : null,
                    'venue' => $data['paper']['venue'],
                    'publication_year' => $data['paper']['year'],
                    'url' => $data['paper']['url'],
                ]);
                
                DB::table('dataset_papers')->insert([
                    'dataset_id' => $dataset->dataset_id,
                    'paper_id' => $paper->paper_id,
                    'citation_type' => 'introductory',
                    'is_primary' => true,
                    'created_at' => now(),
                ]);
            }
            
           
            $user = auth()->user();
            $creators = $data['creators'] ?? [];
            
            if (is_array($creators) && count($creators) > 0) {
                foreach ($creators as $i => $c) {
                    $fullName = trim(($c['first_name'] ?? '') . ' ' . ($c['last_name'] ?? ''));
                    if (empty($fullName)) continue;
                    
                    $person = Person::firstOrCreate(
                        ['name' => $fullName],
                        [
                            'affiliation' => $c['institution'] ?? null,
                            'email' => $c['email'] ?? null,
                        ]
                    );
                    
                    DB::table('dataset_contributors')->insert([
                        'dataset_id' => $dataset->dataset_id,
                        'person_id' => $person->person_id,
                        'contribution_role' => 'creator',
                        'display_order' => $i + 1,
                        'created_at' => now(),
                    ]);
                }
            } else {
                $person = Person::firstOrCreate(
                    ['name' => $user->name],
                    ['affiliation' => null, 'email' => $user->email]
                );
                DB::table('dataset_contributors')->insert([
                    'dataset_id' => $dataset->dataset_id,
                    'person_id' => $person->person_id,
                    'contribution_role' => 'donor',
                    'display_order' => 1,
                    'created_at' => now(),
                ]);
            }
            
           
            if (!empty($data['keywords']) && is_array($data['keywords'])) {
                foreach ($data['keywords'] as $kw) {
                    if (empty($kw)) continue;
                    
                    $keyword = Keyword::firstOrCreate(
                        ['keyword_name' => $kw],
                        ['slug' => Str::slug($kw)]
                    );
                    
                    DB::table('dataset_keywords')->insert([
                        'dataset_id' => $dataset->dataset_id,
                        'keyword_id' => $keyword->keyword_id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
            
            
            if (!empty($data['variable_info'])) {
                $dataset->update(['add_var_information' => $data['variable_info']]);
            }
            
            DB::commit();
            Session::forget('linking_data');
            
            Log::info('🏁 SUBMIT LINKING: SUCCESS', ['dataset_id' => $dataset->dataset_id]);
            
            return redirect()->route('profile.datasets')
                ->with('success', '✅ Berhasil submit! Dataset "' . $dataset->name . '" berhasil di-link! Menunggu review.');
                
        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();
            Log::error('❌ Validation Error', $e->errors());
            return redirect()->back()
                ->withErrors($e->errors())
                ->withInput();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('❌ SUBMIT LINKING FAILED: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'user_id' => auth()->id(),
                'file' => $e->getFile() . ':' . $e->getLine(),
            ]);
            return redirect()->back()
                ->with('error', '❌ Gagal: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function editMetadata(Dataset $dataset)
    {
        if ($dataset->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }
        
        if (!in_array($dataset->status, ['approved', 'available'])) {
            return redirect()->route('profile.edits')
                ->with('error', 'Only approved datasets can be edited.');
        }
        
        return view('contribute.edit.metadata', compact('dataset'));
    }

    public function updateMetadata(Request $request, Dataset $dataset)
    {
        if ($dataset->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'abstract' => 'required|string|max:2000',
            'description' => 'nullable|string',
            'subject_area' => 'nullable|string|max:100',
            'data_type' => 'nullable|string|max:50',
            'task_type' => 'nullable|string|max:50',
            'num_instances' => 'nullable|integer|min:0',
            'num_features' => 'nullable|integer|min:0',
        ]);
        
        $dataset->update($validated);
        
        if ($dataset->status === 'approved') {
            $dataset->update(['status' => 'pending']);
            
            return redirect()->route('profile.edits')
                ->with('success', 'Edit submitted for review. Changes will be live after admin approval.');
        }
        
        return redirect()->route('profile.edits')
            ->with('success', 'Dataset updated successfully.');
    }

    protected function formatFileSize($bytes)
    {
        if (!is_numeric($bytes) || $bytes <= 0) return '0 B';
        $units = ['B', 'KB', 'MB', 'GB'];
        $i = 0;
        while ($bytes >= 1024 && $i < count($units) - 1) {
            $bytes /= 1024;
            $i++;
        }
        return round($bytes, 2) . ' ' . $units[$i];
    }
}