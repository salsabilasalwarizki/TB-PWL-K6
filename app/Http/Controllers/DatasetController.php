<?php

namespace App\Http\Controllers;

use App\Models\{Dataset, Keyword, SubjectArea, File};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DatasetController extends Controller
{
    /**
     * Display listing of datasets with filters
     */
    public function index(Request $request)
    {
        $query = Dataset::query();
        
        // ===== SEARCH =====
        if ($request->filled('q') || $request->filled('search')) {
            $searchTerm = $request->input('q') ?? $request->input('search');
            
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('display_name', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('description', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('abstract', 'LIKE', "%{$searchTerm}%")
                  ->orWhereHas('keywords', function($kq) use ($searchTerm) {
                      $kq->where('keyword_name', 'LIKE', "%{$searchTerm}%");
                  })
                  ->orWhereHas('subjectArea', function($sq) use ($searchTerm) {
                      $sq->where('area_name', 'LIKE', "%{$searchTerm}%");
                  });
            });
        }
        
        // ===== FILTERS =====
        
        // Data Type
        if ($request->filled('data_type')) {
            $query->where('data_type', $request->input('data_type'));
        }
        
        // Task Type
        if ($request->filled('task_type')) {
            $query->where('task_type', $request->input('task_type'));
        }
        
        // Subject Area (multiple)
        if ($request->filled('subject_area')) {
            $subjectAreas = (array) $request->input('subject_area');
            $query->whereHas('subjectArea', function($q) use ($subjectAreas) {
                $q->whereIn('area_name', $subjectAreas);
            });
        }
        
        // Keywords (multiple)
        if ($request->filled('keywords')) {
            $keywords = (array) $request->input('keywords');
            $query->whereHas('keywords', function($q) use ($keywords) {
                $q->whereIn('keyword_id', $keywords);
            });
        }
        
        // Instances Range
        if ($request->filled('instances_min')) {
            $query->where('num_instances', '>=', $request->input('instances_min'));
        }
        if ($request->filled('instances_max')) {
            $query->where('num_instances', '<=', $request->input('instances_max'));
        }
        
        // Features Range
        if ($request->filled('features_min')) {
            $query->where('num_features', '>=', $request->input('features_min'));
        }
        if ($request->filled('features_max')) {
            $query->where('num_features', '<=', $request->input('features_max'));
        }
        
        // Has Missing Values
        if ($request->filled('has_missing') && $request->input('has_missing') == '1') {
            $query->where('has_missing_values', true);
        }
        
        // ===== SORTING =====
        $sort = $request->input('sort', 'view_count');
        $order = $request->input('order', 'desc');
        
        $sortableColumns = ['name', 'created_at', 'download_count', 'citation_count', 'view_count'];
        if (!in_array($sort, $sortableColumns)) {
            $sort = 'view_count';
        }
        
        $query->orderBy($sort, $order === 'asc' ? 'asc' : 'desc');
        
        // ===== GET FILTER OPTIONS (Real-time counts) =====
        
        // Keywords with count
        $keywords = Keyword::select('keywords.*')
            ->selectRaw('(SELECT COUNT(*) FROM dataset_keyword WHERE keyword_id = keywords.keyword_id) as datasets_count')
            ->orderByDesc('datasets_count')
            ->get();
        
        // Subject Areas with count
        $subjectAreas = SubjectArea::select('subject_areas.*')
            ->selectRaw('(SELECT COUNT(*) FROM datasets WHERE subject_area_id = subject_areas.area_id) as datasets_count')
            ->orderByDesc('datasets_count')
            ->get();
        
        // Data Types with count
        $dataTypes = Dataset::select('data_type', DB::raw('COUNT(*) as count'))
            ->whereNotNull('data_type')
            ->where('data_type', '!=', '')
            ->groupBy('data_type')
            ->orderByDesc('count')
            ->get();
        
        // Task Types with count
        $taskTypes = Dataset::select('task_type', DB::raw('COUNT(*) as count'))
            ->whereNotNull('task_type')
            ->where('task_type', '!=', '')
            ->groupBy('task_type')
            ->orderByDesc('count')
            ->get();
        
        // ===== STATISTICS =====
        $stats = [
            'total' => Dataset::count(),
            'by_data_type' => $dataTypes->pluck('count', 'data_type'),
            'by_task_type' => $taskTypes->pluck('count', 'task_type'),
            'by_subject_area' => $subjectAreas->pluck('datasets_count', 'area_name'),
            'recent_downloads' => Dataset::where('created_at', '>=', now()->subMonth())
                ->select('download_count')
                ->get(),
            'new_this_month' => Dataset::whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year)
                ->count(),
            'max_instances' => Dataset::max('num_instances') ?? 100000,
            'max_features' => Dataset::max('num_features') ?? 1000,
            'data_type_counts' => $dataTypes->pluck('count', 'data_type')->toArray(),
            'task_type_counts' => $taskTypes->pluck('count', 'task_type')->toArray(),
        ];
        
        // ===== PAGINATE =====
        $perPage = $request->input('per_page', 12);
        $datasets = $query->with(['subjectArea', 'task', 'keywords', 'files'])->paginate($perPage);
        
        // ===== POPULAR & NEW DATASETS (for homepage) =====
        $popularDatasets = Dataset::with(['subjectArea', 'task', 'keywords'])
            ->orderBy('view_count', 'desc')
            ->take(4)
            ->get();
        
        $newDatasets = Dataset::with(['subjectArea', 'task', 'keywords'])
            ->orderBy('created_at', 'desc')
            ->take(4)
            ->get();
        
        // ===== SORT LABELS =====
        $sortLabels = [
            'view_count' => '# Views',
            'download_count' => '# Downloads',
            'citation_count' => '# Citations',
            'name' => 'Name',
            'created_at' => 'Date Added',
        ];
        
        // ===== AJAX REQUEST =====
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'datasets' => $datasets->map(function($dataset) {
                    return [
                        'id' => $dataset->dataset_id,
                        'name' => $dataset->display_name ?? $dataset->name,
                        'description' => Str::limit($dataset->abstract ?? $dataset->description, 150),
                        'data_type' => $dataset->data_type,
                        'task_type' => $dataset->task_type,
                        'num_instances' => $dataset->num_instances,
                        'num_features' => $dataset->num_features,
                        'view_count' => $dataset->view_count,
                        'url' => route('datasets.show', $dataset),
                    ];
                }),
                'pagination' => [
                    'total' => $datasets->total(),
                    'per_page' => $datasets->perPage(),
                    'current_page' => $datasets->currentPage(),
                    'last_page' => $datasets->lastPage(),
                    'from' => $datasets->firstItem(),
                    'to' => $datasets->lastItem(),
                ],
            ]);
        }
        
        return view('datasets.index', compact(
            'datasets',
            'stats',
            'keywords',
            'subjectAreas',
            'dataTypes',
            'taskTypes',
            'popularDatasets',
            'newDatasets',
            'sortLabels'
        ));
    }
    
    /**
     * Display specified dataset
     */
    public function show(Request $request, Dataset $dataset)
    {
        // Track view (only once per session)
        if (!$request->session()->has("viewed_dataset_{$dataset->dataset_id}")) {
            $dataset->increment('view_count');
            $request->session()->put("viewed_dataset_{$dataset->dataset_id}", true);
        }
        
        // Load relationships
        $dataset->load([
            'descriptionDetails',
            'files',
            'variables.categories',
            'keywords',
            'papers' => fn($q) => $q->orderByPivot('is_primary', 'desc'),
            'contributors' => fn($q) => $q->orderByPivot('display_order'),
            'reviews.user:id,name',
            'license',
            'doi',
            'user:id,name',
        ]);
        
        // Calculate stats
        $totalCitations = $dataset->papers->count();
        $totalViews = $dataset->view_count;
        
        return view('datasets.show', compact('dataset', 'totalCitations', 'totalViews'));
    }
    
    /**
     * Download dataset file
     */
    public function download($datasetId, $fileId)
    {
        // Find the file
        $datasetFile = DB::table('dataset_files')
            ->join('files', 'dataset_files.file_id', '=', 'files.file_id')
            ->where('dataset_files.dataset_id', $datasetId)
            ->where('files.file_id', $fileId)
            ->first();
        
        if (!$datasetFile) {
            abort(404, 'File not found');
        }
        
        // Full path
        $filePath = storage_path('app/public/' . $datasetFile->file_path);
        
        if (!file_exists($filePath)) {
            abort(404, 'File tidak ditemukan di server');
        }
        
        // Increment download count
        Dataset::where('dataset_id', $datasetId)->increment('download_count');
        
        // Log download (optional - if downloads table exists)
        try {
            DB::table('downloads')->insert([
                'dataset_id' => $datasetId,
                'file_id' => $fileId,
                'user_id' => auth()->id(),
                'downloaded_at' => now(),
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent()
            ]);
        } catch (\Exception $e) {
            // Log silently if downloads table doesn't exist
            \Log::info('Download logged: dataset ' . $datasetId);
        }
        
        return response()->download($filePath, $datasetFile->original_filename ?? 'dataset');
    }
    
    /**
     * Track dataset view (AJAX endpoint)
     */
    public function trackView(Request $request, Dataset $dataset)
    {
        $sessionKey = "viewed_dataset_{$dataset->dataset_id}";
        
        if (!$request->session()->has($sessionKey)) {
            $dataset->increment('view_count');
            $request->session()->put($sessionKey, true);
        }
        
        return response()->json([
            'success' => true, 
            'views' => $dataset->view_count
        ]);
    }
    
    /**
     * Save dataset to user's collection
     */
    public function save(Request $request, Dataset $dataset)
    {
        $request->validate([
            'action' => 'required|in:add,remove'
        ]);
        
        $user = $request->user();
        
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Please login to save datasets'
            ], 401);
        }
        
        $action = $request->input('action');
        
        try {
            if ($action === 'add') {
                $user->savedDatasets()->syncWithoutDetaching([$dataset->dataset_id]);
                $message = 'Dataset saved to your collection';
            } else {
                $user->savedDatasets()->detach($dataset->dataset_id);
                $message = 'Dataset removed from your collection';
            }
            
            return response()->json([
                'success' => true, 
                'message' => $message,
                'action' => $action
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to save dataset'
            ], 500);
        }
    }
    
    /**
     * Quick preview data for AJAX loading
     */
    public function preview(Dataset $dataset)
    {
        return response()->json([
            'id' => $dataset->dataset_id,
            'name' => $dataset->name,
            'slug' => $dataset->slug ?? null,
            'description' => Str::limit($dataset->description, 200),
            'data_type' => $dataset->data_type,
            'task_type' => $dataset->task_type,
            'num_instances' => $dataset->num_instances,
            'num_features' => $dataset->num_features,
            'view_count' => $dataset->view_count,
            'download_count' => $dataset->download_count,
            'thumbnail_url' => $dataset->thumbnail_url,
        ]);
    }
}