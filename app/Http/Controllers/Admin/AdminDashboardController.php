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
                
                // Tambahkan donor sebagai property dinamis
                $dataset->donor = $donor;
                
                return $dataset;
            });

        // 3. AKTIVITAS TERAKHIR (Timeline di Kanan)
        // Mengambil 5 dataset terbaru (apapun statusnya) untuk feed aktivitas
        $recentActivity = Dataset::orderBy('created_at', 'desc')
            ->take(5)
            ->get()
            ->map(function($dataset) {
                // Ambil contributor pertama jika ada
                $contributor = DB::table('dataset_contributors')
                    ->join('people', 'dataset_contributors.person_id', '=', 'people.person_id')
                    ->where('dataset_contributors.dataset_id', $dataset->dataset_id)
                    ->select('people.*')
                    ->first();
                
                // Tambahkan contributor sebagai property dinamis
                $dataset->contributor = $contributor;
                
                return $dataset;
            });

        // 4. DATA CHART (Grafik Bulanan)
        // Mengambil jumlah dataset per bulan (6 bulan terakhir)
        $monthlySubmissions = Dataset::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(*) as count')
            ->where('created_at', '>=', now()->subMonths(6))
            ->groupBy('month')
            ->orderBy('month', 'asc') // Ascending agar grafik berjalan dari kiri ke kanan
            ->get();

        // 5. STATISTIK TAMBAHAN (Opsional untuk chart yang lebih lengkap)
        $stats['monthly_growth'] = $monthlySubmissions->pluck('count', 'month')->toArray();
        
        // Statistik by data type untuk chart
        $stats['data_type_counts'] = Dataset::select('data_type', DB::raw('COUNT(*) as count'))
            ->whereNotNull('data_type')
            ->where('data_type', '!=', '')
            ->groupBy('data_type')
            ->pluck('count', 'data_type')
            ->toArray();
        
        // Statistik by subject area untuk chart
        $stats['subject_area_counts'] = Dataset::select('subject_area', DB::raw('COUNT(*) as count'))
            ->whereNotNull('subject_area')
            ->where('subject_area', '!=', '')
            ->groupBy('subject_area')
            ->pluck('count', 'subject_area')
            ->toArray();

        // Return View
        return view('admin.dashboard', compact(
            'stats', 
            'pendingDatasets', 
            'recentActivity', 
            'monthlySubmissions'
        ));
    }

    /**
     * Metode tambahan untuk Update Statistik Real-time (Opsional)
     */
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