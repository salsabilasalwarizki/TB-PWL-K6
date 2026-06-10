<?php

namespace App\Http\Controllers;

use App\Models\{Dataset, Paper, User, Keyword, Post, Category};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function whoWeAre()
    {
        return view('about.who-we-are');
    }

    public function citation()
    {
        return view('about.citation');
    }

    public function contact()
    {
        return view('about.contact');
    }

    public function index()
    {
        $stats = Cache::remember('home_stats', 300, function () {
            return [
                
                'total' => Dataset::where('status', 'approved')->orWhere('status', 'available')->count(),
                
                
                'by_data_type' => Dataset::whereIn('status', ['approved', 'available'])
                    ->whereNotNull('data_type')
                    ->selectRaw('data_type, COUNT(*) as count')
                    ->groupBy('data_type')
                    ->pluck('count', 'data_type')
                    ->sortDesc(),
                
                
                'by_task_type' => Dataset::whereIn('status', ['approved', 'available'])
                    ->whereNotNull('task_type')
                    ->selectRaw('task_type, COUNT(*) as count')
                    ->groupBy('task_type')
                    ->pluck('count', 'task_type')
                    ->sortDesc(),
                
                
                'by_subject_area' => Dataset::whereIn('status', ['approved', 'available'])
                    ->whereNotNull('subject_area')
                    ->selectRaw('subject_area, COUNT(*) as count')
                    ->groupBy('subject_area')
                    ->pluck('count', 'subject_area')
                    ->sortDesc(),
                
                
                'recent_downloads' => Dataset::whereIn('status', ['approved', 'available'])
                    ->orderBy('download_count', 'desc')
                    ->take(10)
                    ->get(['dataset_id', 'name', 'download_count']),
                
                
                'total_downloads' => Dataset::whereIn('status', ['approved', 'available'])->sum('download_count'),
                
                
                'total_views' => Dataset::whereIn('status', ['approved', 'available'])->sum('view_count'),
                
                
                'total_citations' => Dataset::whereIn('status', ['approved', 'available'])->sum('citation_count'),
                
                
                'monthly_growth' => Dataset::whereIn('status', ['approved', 'available'])
                    ->where('created_at', '>=', now()->subMonths(6))
                    ->selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(*) as count')
                    ->groupBy('month')
                    ->orderBy('month')
                    ->pluck('count', 'month'),
                
                
                'top_keywords' => Keyword::withCount(['datasets' => function($q) {
                        $q->whereIn('status', ['approved', 'available']);
                    }])
                    ->orderBy('datasets_count', 'desc')
                    ->take(10)
                    ->get(),
                
                
                'new_this_month' => Dataset::whereIn('status', ['approved', 'available'])
                    ->whereMonth('created_at', now()->month)
                    ->count(),
                
                
                'total_posts' => Post::where('status', 'published')
                    ->whereNotNull('published_at')
                    ->count(),
                
                
                'total_categories' => Category::where('active', 1)->count(),
            ];
        });
        
        
        $popularDatasets = Cache::remember('popular_datasets', 300, function () {
            $datasets = Dataset::whereIn('status', ['approved', 'available'])
                ->with('keywords')
                ->orderBy('view_count', 'desc')
                ->take(4)
                ->get();
            
            
            foreach ($datasets as $dataset) {
                $dataset->default_file = $dataset->files()
                    ->wherePivot('is_default', true)
                    ->first();
            }
            
            return $datasets;
        });

        
        $newDatasets = Cache::remember('new_datasets', 300, function () {
            $datasets = Dataset::whereIn('status', ['approved', 'available'])
                ->with('keywords')
                ->orderBy('created_at', 'desc')
                ->take(4)
                ->get();
            
            foreach ($datasets as $dataset) {
                $dataset->default_file = $dataset->files()
                    ->wherePivot('is_default', true)
                    ->first();
            }
            
            return $datasets;
        });
        
        
        $latestPosts = Cache::remember('latest_posts', 300, function () {
            return Post::with(['user', 'category'])
                ->where('status', 'published')
                ->whereNotNull('published_at')
                ->orderBy('published_at', 'desc')
                ->take(6)
                ->get();
        });
        
        
        $categories = Cache::remember('home_categories', 300, function () {
            return Category::where('active', 1)
                ->withCount(['posts' => function($query) {
                    $query->where('status', 'published')
                          ->whereNotNull('published_at');
                }])
                ->having('posts_count', '>', 0)
                ->orderBy('posts_count', 'desc')
                ->take(12)
                ->get();
        });
        
        return view('home', compact(
            'stats', 
            'popularDatasets', 
            'newDatasets',
            'latestPosts',
            'categories'
        ));
    }
}