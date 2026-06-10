<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dataset;
use App\Models\User;
use App\Models\Paper;
use App\Models\Download;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index()
    {
        
        $stats = [
            'total_datasets' => Dataset::count(),
            'pending_datasets' => Dataset::where('status', 'pending')->count(),
            'approved_datasets' => Dataset::where('status', 'approved')->count(),
            'rejected_datasets' => Dataset::where('status', 'rejected')->count(),
            'total_users' => User::count(),
        ];

        $pendingDatasets = Dataset::with(['files']) 
            ->where('status', 'pending')
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get()
            ->map(function($dataset) {
        
                $donor = DB::table('dataset_contributors')
                    ->join('people', 'dataset_contributors.person_id', '=', 'people.person_id')
                    ->where('dataset_contributors.dataset_id', $dataset->dataset_id)
                    ->where('dataset_contributors.contribution_role', 'donor')
                    ->select('people.*')
                    ->first();
                

                if (!$donor) {
                    $donor = DB::table('dataset_contributors')
                        ->join('people', 'dataset_contributors.person_id', '=', 'people.person_id')
                        ->where('dataset_contributors.dataset_id', $dataset->dataset_id)
                        ->select('people.*')
                        ->first();
                }
                

                $dataset->donor = $donor;
                
                return $dataset;
            });


        $recentActivity = Dataset::orderBy('created_at', 'desc')
            ->take(5)
            ->get()
            ->map(function($dataset) {

                $contributor = DB::table('dataset_contributors')
                    ->join('people', 'dataset_contributors.person_id', '=', 'people.person_id')
                    ->where('dataset_contributors.dataset_id', $dataset->dataset_id)
                    ->select('people.*')
                    ->first();
                

                $dataset->contributor = $contributor;
                
                return $dataset;
            });


        $monthlySubmissions = Dataset::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(*) as count')
            ->where('created_at', '>=', now()->subMonths(6))
            ->groupBy('month')
            ->orderBy('month', 'asc') 
            ->get();
        
        $stats['monthly_growth'] = $monthlySubmissions->pluck('count', 'month')->toArray();

        
        $stats['data_type_counts'] = Dataset::select('data_type', DB::raw('COUNT(*) as count'))
            ->whereNotNull('data_type')
            ->where('data_type', '!=', '')
            ->groupBy('data_type')
            ->pluck('count', 'data_type')
            ->toArray();
        
        
        $stats['subject_area_counts'] = Dataset::select('subject_area', DB::raw('COUNT(*) as count'))
            ->whereNotNull('subject_area')
            ->where('subject_area', '!=', '')
            ->groupBy('subject_area')
            ->pluck('count', 'subject_area')
            ->toArray();

        
        return view('admin.dashboard', compact(
            'stats', 
            'pendingDatasets', 
            'recentActivity', 
            'monthlySubmissions'
        ));
    }

    
    public function getStats()
    {
        $stats = [
            'total_datasets' => Dataset::count(),
            'pending_datasets' => Dataset::where('status', 'pending')->count(),
            'approved_datasets' => Dataset::where('status', 'approved')->count(),
            'rejected_datasets' => Dataset::where('status', 'rejected')->count(),
            'total_users' => User::count(),
        ];

        return response()->json($stats);
    }
}