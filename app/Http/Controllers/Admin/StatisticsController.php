<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dataset;
use App\Models\User;
use App\Models\Paper;
use App\Models\Keyword;
use Illuminate\Http\Request;
use Carbon\Carbon;

class StatisticsController extends Controller
{
    public function index()
    {
        
        $stats = [
            'total_datasets' => Dataset::count(),
            'total_users' => User::count(),
            'total_papers' => Paper::count(),
            'total_keywords' => Keyword::count(),
            'pending_datasets' => Dataset::where('status', 'pending')->count(),
            'approved_datasets' => Dataset::where('status', 'approved')->count(),
            'rejected_datasets' => Dataset::where('status', 'rejected')->count(),
        ];

        
        $monthlyDatasets = Dataset::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(*) as count')
            ->groupBy('month')
            ->orderBy('month')
            ->limit(12)
            ->get();

        
        $monthlyUsers = User::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(*) as count')
            ->groupBy('month')
            ->orderBy('month')
            ->limit(12)
            ->get();

        
        $datasetsByStatus = Dataset::selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->get();

        
        $topContributors = User::withCount('datasets')
            ->orderBy('datasets_count', 'desc')
            ->limit(5)
            ->get();

        
        $recentDatasets = Dataset::with('user')
            ->latest()
            ->limit(10)
            ->get();

        return view('admin.statistics', compact(
            'stats',
            'monthlyDatasets',
            'monthlyUsers',
            'datasetsByStatus',
            'topContributors',
            'recentDatasets'
        ));
    }
}