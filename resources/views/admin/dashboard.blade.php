@extends('layouts.admin')
@section('title', 'Admin Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div class="min-h-screen bg-ink-50 dark:bg-ink-950 bg-grid">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        <!-- Page Header -->
        <div class="mb-8 animate-slide-up">
            <h1 class="text-3xl font-bold text-ink-900 dark:text-white mb-2">
                <i class="bi bi-speedometer2 me-2"></i>Admin Dashboard
            </h1>
            <p class="text-ink-600 dark:text-ink-400">Manage datasets, users, and repository settings</p>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
            <!-- Total Datasets -->
            <div class="bg-white dark:bg-ink-900 rounded-xl shadow-card border border-ink-200 dark:border-ink-800 p-6 hover:shadow-elev hover:-translate-y-1 transition-all duration-300 animate-slide-up" style="animation-delay: 0.1s;">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center shadow-soft">
                        <i class="bi bi-database text-xl text-white"></i>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm text-ink-600 dark:text-ink-400 mb-1">Total Datasets</p>
                        <p class="text-2xl font-bold text-ink-900 dark:text-white">{{ number_format($stats['total_datasets'] ?? 0) }}</p>
                    </div>
                </div>
            </div>
            
            <!-- Pending Review -->
            <div class="bg-white dark:bg-ink-900 rounded-xl shadow-card border border-ink-200 dark:border-ink-800 p-6 hover:shadow-elev hover:-translate-y-1 transition-all duration-300 animate-slide-up" style="animation-delay: 0.2s;">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-amber-500 to-amber-600 flex items-center justify-center shadow-soft">
                        <i class="bi bi-clock-history text-xl text-white"></i>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm text-ink-600 dark:text-ink-400 mb-1">Pending Review</p>
                        <p class="text-2xl font-bold text-ink-900 dark:text-white">{{ number_format($stats['pending_datasets'] ?? 0) }}</p>
                    </div>
                </div>
                @if(($stats['pending_datasets'] ?? 0) > 0)
                <div class="mt-3 pt-3 border-t border-ink-200 dark:border-ink-800">
                    <a href="{{ route('datasets.index', ['status' => 'pending']) }}" class="text-sm text-amber-600 dark:text-amber-400 hover:text-amber-700 dark:hover:text-amber-300 hover:underline">
                        Review now <i class="bi bi-arrow-right text-xs"></i>
                    </a>
                </div>
                @endif
            </div>
            
            <!-- Approved -->
            <div class="bg-white dark:bg-ink-900 rounded-xl shadow-card border border-ink-200 dark:border-ink-800 p-6 hover:shadow-elev hover:-translate-y-1 transition-all duration-300 animate-slide-up" style="animation-delay: 0.3s;">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-green-500 to-green-600 flex items-center justify-center shadow-soft">
                        <i class="bi bi-check-circle text-xl text-white"></i>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm text-ink-600 dark:text-ink-400 mb-1">Approved</p>
                        <p class="text-2xl font-bold text-ink-900 dark:text-white">{{ number_format($stats['approved_datasets'] ?? 0) }}</p>
                    </div>
                </div>
            </div>
            
            <!-- Total Users -->
            <div class="bg-white dark:bg-ink-900 rounded-xl shadow-card border border-ink-200 dark:border-ink-800 p-6 hover:shadow-elev hover:-translate-y-1 transition-all duration-300 animate-slide-up" style="animation-delay: 0.4s;">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-cyan-500 to-cyan-600 flex items-center justify-center shadow-soft">
                        <i class="bi bi-people text-xl text-white"></i>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm text-ink-600 dark:text-ink-400 mb-1">Total Users</p>
                        <p class="text-2xl font-bold text-ink-900 dark:text-white">{{ number_format($stats['total_users'] ?? 0) }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 animate-slide-up" style="animation-delay: 0.5s;">
            
            <!-- Left Column: Pending Datasets -->
            <div class="lg:col-span-2">
                <div class="bg-white dark:bg-ink-900 rounded-xl shadow-card border border-ink-200 dark:border-ink-800 overflow-hidden">
                    <div class="px-6 py-4 border-b border-ink-200 dark:border-ink-800 flex items-center justify-between bg-gradient-to-r from-ink-50 to-ink-100 dark:from-ink-900 dark:to-ink-800">
                        <h2 class="text-lg font-semibold text-ink-900 dark:text-white">
                            <i class="bi bi-inbox me-2 text-amber-500"></i>Pending Review
                        </h2>
                        <a href="{{ route('datasets.index', ['status' => 'pending']) }}" class="text-sm text-brand-600 dark:text-brand-400 hover:text-brand-700 dark:hover:text-brand-300 hover:underline">
                            View All <i class="bi bi-arrow-right text-xs"></i>
                        </a>
                    </div>
                    
                    @if($pendingDatasets->isNotEmpty())
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-ink-50 dark:bg-ink-900/50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-ink-600 dark:text-ink-400 uppercase tracking-wider">Dataset</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-ink-600 dark:text-ink-400 uppercase tracking-wider">Submitted</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-ink-600 dark:text-ink-400 uppercase tracking-wider">Donator</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-ink-600 dark:text-ink-400 uppercase tracking-wider">Type</th>
                                    <th class="px-6 py-3 text-right text-xs font-semibold text-ink-600 dark:text-ink-400 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-ink-200 dark:divide-ink-800">
                                @foreach($pendingDatasets as $dataset)
                                <tr class="hover:bg-ink-50 dark:hover:bg-ink-900/50 transition-colors duration-200">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            @if($dataset->thumbnail_url)
                                            <img src="{{ $dataset->thumbnail_url }}" alt="" class="w-10 h-10 rounded-lg object-cover shadow-soft">
                                            @else
                                            <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center shadow-soft">
                                                <i class="bi bi-database text-blue-500"></i>
                                            </div>
                                            @endif
                                            <div>
                                                <a href="{{ route('datasets.show', $dataset) }}" class="font-semibold text-ink-900 dark:text-white hover:text-brand-600 dark:hover:text-brand-400 hover:underline">
                                                    {{ Str::limit($dataset->name, 30) }}
                                                </a>
                                                @if($dataset->subject_area)
                                                <p class="text-xs text-ink-500 dark:text-ink-400">{{ $dataset->subject_area }}</p>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-ink-600 dark:text-ink-400">
                                        {{ $dataset->donated_date?->format('M d, Y') ?? 'N/A' }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-ink-600 dark:text-ink-400">
                                        @php
                                            $donator = $dataset->contributors->firstWhere('pivot.contribution_role', 'donor') 
                                                ?? $dataset->contributors->first();
                                        @endphp
                                        {{ $donator->name ?? 'Unknown' }}
                                    </td>
                                    <td class="px-6 py-4">
                                        @if($dataset->data_type)
                                        <span class="inline-flex px-2 py-1 text-xs font-medium text-brand-700 dark:text-brand-400 bg-brand-100 dark:bg-brand-900/30 rounded-lg">
                                            {{ $dataset->data_type }}
                                        </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <div class="flex items-center justify-end gap-2">
                                            <a href="{{ route('datasets.show', $dataset) }}" class="p-2 text-ink-600 dark:text-ink-400 hover:text-brand-600 dark:hover:text-brand-400 hover:bg-ink-100 dark:hover:bg-ink-800 rounded-lg transition-all duration-200" title="View">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <form action="{{ route('admin.datasets.approve', $dataset) }}" method="POST" class="inline">
                                                @csrf
                                                <button type="submit" class="p-2 text-ink-600 dark:text-ink-400 hover:text-green-600 dark:hover:text-green-400 hover:bg-ink-100 dark:hover:bg-ink-800 rounded-lg transition-all duration-200" title="Approve" onclick="return confirm('Approve this dataset?')">
                                                    <i class="bi bi-check"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="py-12 text-center">
                        <i class="bi bi-inbox text-5xl text-ink-300 dark:text-ink-600 mb-3"></i>
                        <p class="text-ink-500 dark:text-ink-400 mb-1">No pending datasets</p>
                        <p class="text-sm text-ink-400 dark:text-ink-500">All caught up! 🎉</p>
                    </div>
                    @endif
                </div>
            </div>
            
            <!-- Right Column: Charts & Activity -->
            <div class="space-y-6">
                
                <!-- Monthly Submissions Chart -->
                <div class="bg-white dark:bg-ink-900 rounded-xl shadow-card border border-ink-200 dark:border-ink-800 overflow-hidden">
                    <div class="px-6 py-4 border-b border-ink-200 dark:border-ink-800 bg-gradient-to-r from-ink-50 to-ink-100 dark:from-ink-900 dark:to-ink-800">
                        <h2 class="text-lg font-semibold text-ink-900 dark:text-white">
                            <i class="bi bi-bar-chart me-2 text-brand-600"></i>Monthly Submissions
                        </h2>
                    </div>
                    <div class="p-6">
                        <canvas id="submissionsChart" height="200"></canvas>
                    </div>
                </div>
                
                <!-- Recent Activity -->
                <div class="bg-white dark:bg-ink-900 rounded-xl shadow-card border border-ink-200 dark:border-ink-800 overflow-hidden">
                    <div class="px-6 py-4 border-b border-ink-200 dark:border-ink-800 bg-gradient-to-r from-ink-50 to-ink-100 dark:from-ink-900 dark:to-ink-800">
                        <h2 class="text-lg font-semibold text-ink-900 dark:text-white">
                            <i class="bi bi-clock-history me-2 text-cyan-600"></i>Recent Activity
                        </h2>
                    </div>
                    <div class="divide-y divide-ink-200 dark:divide-ink-800">
                        @forelse($recentActivity as $activity)
                        <a href="{{ route('datasets.show', $activity) }}" class="block px-6 py-4 hover:bg-ink-50 dark:hover:bg-ink-900/50 transition-colors duration-200">
                            <div class="flex items-start justify-between">
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center gap-2 mb-1">
                                        <i class="bi bi-plus-circle text-green-600 dark:text-green-400"></i>
                                        <span class="font-semibold text-ink-900 dark:text-white truncate">
                                            {{ Str::limit($activity->name, 25) }}
                                        </span>
                                    </div>
                                    <p class="text-sm text-ink-500 dark:text-ink-400">
                                        Added {{ $activity->created_at?->diffForHumans() ?? 'recently' }}
                                        @if($activity->status !== 'available')
                                        • <span class="inline-flex px-2 py-0.5 text-xs font-medium rounded-lg {{ $activity->status === 'pending' ? 'bg-amber-100 dark:bg-amber-900/30 text-amber-700 dark:text-amber-400' : 'bg-ink-100 dark:bg-ink-800 text-ink-700 dark:text-ink-400' }}">
                                            {{ ucfirst($activity->status) }}
                                        </span>
                                        @endif
                                    </p>
                                </div>
                                <i class="bi bi-chevron-right text-ink-400 text-sm mt-1"></i>
                            </div>
                        </a>
                        @empty
                        <div class="py-8 text-center">
                            <i class="bi bi-clock-history text-4xl text-ink-300 dark:text-ink-600 mb-2"></i>
                            <p class="text-sm text-ink-500 dark:text-ink-400">No recent activity</p>
                        </div>
                        @endforelse
                    </div>
                </div>
                
            </div>
        </div>
        
        <!-- Quick Actions -->
        <div class="mt-8 pt-6 border-t border-ink-200 dark:border-ink-800 animate-slide-up" style="animation-delay: 0.6s;">
            <div class="flex flex-wrap gap-3 justify-center">
                <a href="{{ route('admin.users.index') }}" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-ink-700 dark:text-ink-300 bg-white dark:bg-ink-900 border border-ink-300 dark:border-ink-700 rounded-lg hover:bg-ink-50 dark:hover:bg-ink-800 hover:shadow-soft hover:-translate-y-0.5 transition-all duration-200">
                    <i class="bi bi-people"></i>Manage Users
                </a>
                <a href="{{ route('datasets.index') }}" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-ink-700 dark:text-ink-300 bg-white dark:bg-ink-900 border border-ink-300 dark:border-ink-700 rounded-lg hover:bg-ink-50 dark:hover:bg-ink-800 hover:shadow-soft hover:-translate-y-0.5 transition-all duration-200">
                    <i class="bi bi-grid"></i>Browse Datasets
                </a>
                <a href="{{ route('profile') }}" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-ink-700 dark:text-ink-300 bg-white dark:bg-ink-900 border border-ink-300 dark:border-ink-700 rounded-lg hover:bg-ink-50 dark:hover:bg-ink-800 hover:shadow-soft hover:-translate-y-0.5 transition-all duration-200">
                    <i class="bi bi-gear"></i>Settings
                </a>
                <button onclick="if(confirm('Clear cache?')) location.reload()" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-red-700 dark:text-red-400 bg-white dark:bg-ink-900 border border-red-300 dark:border-red-700 rounded-lg hover:bg-red-50 dark:hover:bg-red-900/20 hover:shadow-soft hover:-translate-y-0.5 transition-all duration-200">
                    <i class="bi bi-arrow-clockwise"></i>Refresh
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('submissionsChart');
    if (ctx) {
        const monthlyData = @json($monthlySubmissions ?? []);
        
        if (monthlyData.length > 0) {
            const labels = monthlyData.map(item => {
                const [year, month] = item.month.split('-');
                return new Date(year, month - 1).toLocaleString('default', { month: 'short', year: '2-digit' });
            });
            
            const data = monthlyData.map(item => item.count);
            
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Datasets Submitted',
                        data: data,
                        borderColor: '#3b82f6',
                        backgroundColor: 'rgba(59, 130, 246, 0.1)',
                        borderWidth: 2,
                        fill: true,
                        tension: 0.4,
                        pointBackgroundColor: '#3b82f6',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                        pointHoverRadius: 6
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            mode: 'index',
                            intersect: false,
                            backgroundColor: 'rgba(0,0,0,0.8)',
                            padding: 12,
                            titleFont: { size: 13 },
                            bodyFont: { size: 12 }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1,
                                precision: 0
                            },
                            grid: {
                                color: 'rgba(0,0,0,0.05)'
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    },
                    interaction: {
                        mode: 'nearest',
                        axis: 'x',
                        intersect: false
                    }
                }
            });
        } else {
            ctx.parentElement.innerHTML = '<p class="text-ink-500 dark:text-ink-400 text-center py-8">No submission data available</p>';
        }
    }
});
</script>
@endpush