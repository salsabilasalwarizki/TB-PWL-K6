@extends('layouts.admin')
@section('title', 'Statistics')
@section('page-title', 'Platform Statistics')

@section('content')
<div class="space-y-6 animate-fade-in">
    
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h2 class="text-2xl font-bold text-ink-900 dark:text-white">Statistics Dashboard</h2>
            <p class="text-sm text-ink-500 dark:text-ink-400 mt-1">Comprehensive overview of platform metrics and analytics</p>
        </div>
        <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-2 px-4 py-2.5 text-sm font-medium text-ink-700 dark:text-ink-300 bg-white dark:bg-ink-800 border border-ink-300 dark:border-ink-600 rounded-lg hover:bg-ink-50 dark:hover:bg-ink-700 transition-all">
            <i class="bi bi-speedometer2"></i>
            <span>Dashboard</span>
        </a>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 animate-slide-up">
        <div class="bg-white dark:bg-ink-800 rounded-xl shadow-card border border-ink-200 dark:border-ink-700 p-6 hover:-translate-y-0.5 hover:shadow-elev transition-all duration-300">
            <div class="flex flex-col items-center text-center">
                <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-brand-500 to-brand-600 flex items-center justify-center mb-3">
                    <i class="bi bi-database-fill text-2xl text-white"></i>
                </div>
                <p class="text-3xl font-bold text-ink-900 dark:text-white">{{ number_format($stats['total_datasets'] ?? 0) }}</p>
                <p class="text-sm text-ink-500 dark:text-ink-400 mt-1">Total Datasets</p>
                <div class="flex items-center gap-1 mt-2 text-xs text-green-600 dark:text-green-400">
                    <i class="bi bi-arrow-up"></i>
                    <span>{{ $stats['new_this_month'] ?? 0 }} this month</span>
                </div>
            </div>
        </div>
        
        <div class="bg-white dark:bg-ink-800 rounded-xl shadow-card border border-ink-200 dark:border-ink-700 p-6 hover:-translate-y-0.5 hover:shadow-elev transition-all duration-300">
            <div class="flex flex-col items-center text-center">
                <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-green-500 to-green-600 flex items-center justify-center mb-3">
                    <i class="bi bi-people-fill text-2xl text-white"></i>
                </div>
                <p class="text-3xl font-bold text-ink-900 dark:text-white">{{ number_format($stats['total_users'] ?? 0) }}</p>
                <p class="text-sm text-ink-500 dark:text-ink-400 mt-1">Total Users</p>
                <div class="flex items-center gap-1 mt-2 text-xs text-green-600 dark:text-green-400">
                    <i class="bi bi-person-plus"></i>
                    <span>Active contributors</span>
                </div>
            </div>
        </div>
        
        <div class="bg-white dark:bg-ink-800 rounded-xl shadow-card border border-ink-200 dark:border-ink-700 p-6 hover:-translate-y-0.5 hover:shadow-elev transition-all duration-300">
            <div class="flex flex-col items-center text-center">
                <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-cyan-500 to-cyan-600 flex items-center justify-center mb-3">
                    <i class="bi bi-file-earmark-text-fill text-2xl text-white"></i>
                </div>
                <p class="text-3xl font-bold text-ink-900 dark:text-white">{{ number_format($stats['total_papers'] ?? 0) }}</p>
                <p class="text-sm text-ink-500 dark:text-ink-400 mt-1">Total Papers</p>
                <div class="flex items-center gap-1 mt-2 text-xs text-cyan-600 dark:text-cyan-400">
                    <i class="bi bi-journal-text"></i>
                    <span>Research papers</span>
                </div>
            </div>
        </div>
        
        <div class="bg-white dark:bg-ink-800 rounded-xl shadow-card border border-ink-200 dark:border-ink-700 p-6 hover:-translate-y-0.5 hover:shadow-elev transition-all duration-300">
            <div class="flex flex-col items-center text-center">
                <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-amber-500 to-amber-600 flex items-center justify-center mb-3">
                    <i class="bi bi-download text-2xl text-white"></i>
                </div>
                <p class="text-3xl font-bold text-ink-900 dark:text-white">{{ number_format($stats['total_downloads'] ?? 0) }}</p>
                <p class="text-sm text-ink-500 dark:text-ink-400 mt-1">Total Downloads</p>
                <div class="flex items-center gap-1 mt-2 text-xs text-amber-600 dark:text-amber-400">
                    <i class="bi bi-graph-up"></i>
                    <span>Dataset downloads</span>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 animate-slide-up" style="animation-delay: 0.1s;">
        <div class="bg-white dark:bg-ink-800 rounded-xl shadow-card border border-ink-200 dark:border-ink-700 p-6 hover:-translate-y-0.5 hover:shadow-elev transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-3xl font-bold text-green-600 dark:text-green-400">{{ number_format($stats['approved_datasets'] ?? 0) }}</p>
                    <p class="text-sm text-ink-500 dark:text-ink-400 mt-1">Approved Datasets</p>
                </div>
                <i class="bi bi-check-circle-fill text-3xl text-green-500 dark:text-green-400"></i>
            </div>
        </div>
        
        <div class="bg-white dark:bg-ink-800 rounded-xl shadow-card border border-ink-200 dark:border-ink-700 p-6 hover:-translate-y-0.5 hover:shadow-elev transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-3xl font-bold text-amber-600 dark:text-amber-400">{{ number_format($stats['pending_datasets'] ?? 0) }}</p>
                    <p class="text-sm text-ink-500 dark:text-ink-400 mt-1">Pending Review</p>
                </div>
                <i class="bi bi-clock-fill text-3xl text-amber-500 dark:text-amber-400"></i>
            </div>
        </div>
        
        <div class="bg-white dark:bg-ink-800 rounded-xl shadow-card border border-ink-200 dark:border-ink-700 p-6 hover:-translate-y-0.5 hover:shadow-elev transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-3xl font-bold text-red-600 dark:text-red-400">{{ number_format($stats['rejected_datasets'] ?? 0) }}</p>
                    <p class="text-sm text-ink-500 dark:text-ink-400 mt-1">Rejected Datasets</p>
                </div>
                <i class="bi bi-x-circle-fill text-3xl text-red-500 dark:text-red-400"></i>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 animate-slide-up" style="animation-delay: 0.2s;">
        <!-- Datasets by Status Chart -->
        <div class="bg-white dark:bg-ink-800 rounded-xl shadow-card border border-ink-200 dark:border-ink-700 overflow-hidden">
            <div class="px-6 py-4 border-b border-ink-200 dark:border-ink-700">
                <h3 class="text-lg font-semibold text-ink-900 dark:text-white flex items-center gap-2">
                    <i class="bi bi-pie-chart-fill text-brand-500"></i>
                    Datasets by Status
                </h3>
            </div>
            <div class="p-6">
                <canvas id="statusChart" height="300"></canvas>
            </div>
        </div>

        <div class="bg-white dark:bg-ink-800 rounded-xl shadow-card border border-ink-200 dark:border-ink-700 overflow-hidden">
            <div class="px-6 py-4 border-b border-ink-200 dark:border-ink-700">
                <h3 class="text-lg font-semibold text-ink-900 dark:text-white flex items-center gap-2">
                    <i class="bi bi-bar-chart-fill text-green-500"></i>
                    Datasets by Data Type
                </h3>
            </div>
            <div class="p-6">
                <canvas id="dataTypeChart" height="300"></canvas>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 animate-slide-up" style="animation-delay: 0.3s;">
        <!-- Datasets by Subject Area Chart -->
        <div class="bg-white dark:bg-ink-800 rounded-xl shadow-card border border-ink-200 dark:border-ink-700 overflow-hidden">
            <div class="px-6 py-4 border-b border-ink-200 dark:border-ink-700">
                <h3 class="text-lg font-semibold text-ink-900 dark:text-white flex items-center gap-2">
                    <i class="bi bi-graph-up text-cyan-500"></i>
                    Datasets by Subject Area
                </h3>
            </div>
            <div class="p-6">
                <canvas id="subjectAreaChart" height="300"></canvas>
            </div>
        </div>

        <div class="bg-white dark:bg-ink-800 rounded-xl shadow-card border border-ink-200 dark:border-ink-700 overflow-hidden">
            <div class="px-6 py-4 border-b border-ink-200 dark:border-ink-700">
                <h3 class="text-lg font-semibold text-ink-900 dark:text-white flex items-center gap-2">
                    <i class="bi bi-graph-up-arrow text-amber-500"></i>
                    Monthly Dataset Growth
                </h3>
            </div>
            <div class="p-6">
                <canvas id="monthlyGrowthChart" height="300"></canvas>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 animate-slide-up" style="animation-delay: 0.4s;">
        <!-- Top Keywords -->
        <div class="bg-white dark:bg-ink-800 rounded-xl shadow-card border border-ink-200 dark:border-ink-700 overflow-hidden">
            <div class="px-6 py-4 border-b border-ink-200 dark:border-ink-700">
                <h3 class="text-lg font-semibold text-ink-900 dark:text-white flex items-center gap-2">
                    <i class="bi bi-tags-fill text-brand-500"></i>
                    Top Keywords
                </h3>
            </div>
            <div class="p-6">
                @if(isset($stats['top_keywords']) && count($stats['top_keywords']) > 0)
                    <div class="space-y-3">
                        @foreach($stats['top_keywords']->take(10) as $index => $keyword)
                            <div class="flex items-center justify-between p-3 rounded-lg bg-ink-50 dark:bg-ink-700/50 hover:bg-ink-100 dark:hover:bg-ink-700 transition-colors">
                                <div class="flex items-center gap-3">
                                    <span class="w-8 h-8 rounded-lg bg-gradient-to-br from-brand-500 to-brand-600 flex items-center justify-center text-white text-sm font-bold">
                                        {{ $index + 1 }}
                                    </span>
                                    <span class="font-semibold text-ink-900 dark:text-white">{{ $keyword->keyword_name }}</span>
                                </div>
                                <span class="px-3 py-1 text-sm font-semibold text-brand-700 dark:text-brand-400 bg-brand-100 dark:bg-brand-900/30 rounded-full">
                                    {{ number_format($keyword->datasets_count) }} datasets
                                </span>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8">
                        <i class="bi bi-tags text-4xl text-ink-300 dark:text-ink-600 mb-2"></i>
                        <p class="text-ink-500 dark:text-ink-400">No keyword data available</p>
                    </div>
                @endif
            </div>
        </div>

        <div class="bg-white dark:bg-ink-800 rounded-xl shadow-card border border-ink-200 dark:border-ink-700 overflow-hidden">
            <div class="px-6 py-4 border-b border-ink-200 dark:border-ink-700">
                <h3 class="text-lg font-semibold text-ink-900 dark:text-white flex items-center gap-2">
                    <i class="bi bi-download text-green-500"></i>
                    Recent Downloads
                </h3>
            </div>
            <div class="p-6">
                @if(isset($stats['recent_downloads']) && count($stats['recent_downloads']) > 0)
                    <div class="space-y-3">
                        @foreach($stats['recent_downloads']->take(10) as $download)
                            <div class="flex items-center justify-between p-3 rounded-lg bg-ink-50 dark:bg-ink-700/50 hover:bg-ink-100 dark:hover:bg-ink-700 transition-colors">
                                <div class="flex-1">
                                    <p class="font-semibold text-ink-900 dark:text-white">{{ $download->name ?? 'Unknown Dataset' }}</p>
                                    <div class="flex items-center gap-1 mt-1 text-xs text-ink-500 dark:text-ink-400">
                                        <i class="bi bi-clock"></i>
                                        <span>{{ $download->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                                <span class="px-3 py-1 text-sm font-semibold text-green-700 dark:text-green-400 bg-green-100 dark:bg-green-900/30 rounded-full">
                                    {{ number_format($download->download_count ?? 0) }} downloads
                                </span>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8">
                        <i class="bi bi-download text-4xl text-ink-300 dark:text-ink-600 mb-2"></i>
                        <p class="text-ink-500 dark:text-ink-400">No download data available</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const statusCtx = document.getElementById('statusChart').getContext('2d');
    const statusData = @json($stats['datasets_by_status'] ?? []);
    
    new Chart(statusCtx, {
        type: 'pie',
        data: {
            labels: Object.keys(statusData),
            datasets: [{
                data: Object.values(statusData),
                backgroundColor: [
                    '#10b981', // approved - green
                    '#f59e0b', // pending - amber
                    '#ef4444', // rejected - red
                    '#06b6d4', // available - cyan
                    '#64748b'  // deprecated - slate
                ],
                borderWidth: 3,
                borderColor: '#ffffff'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 20,
                        font: {
                            size: 12,
                            family: 'Inter'
                        }
                    }
                }
            }
        }
    });

    const dataTypeCtx = document.getElementById('dataTypeChart').getContext('2d');
    const dataTypeData = @json($stats['data_type_counts'] ?? []);
    
    new Chart(dataTypeCtx, {
        type: 'bar',
        data: {
            labels: Object.keys(dataTypeData),
            datasets: [{
                label: 'Datasets',
                data: Object.values(dataTypeData),
                backgroundColor: 'rgba(16, 185, 129, 0.8)',
                borderColor: 'rgba(16, 185, 129, 1)',
                borderWidth: 2,
                borderRadius: 8
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1,
                        font: {
                            family: 'Inter'
                        }
                    },
                    grid: {
                        color: 'rgba(0, 0, 0, 0.05)'
                    }
                },
                x: {
                    ticks: {
                        maxRotation: 45,
                        minRotation: 45,
                        font: {
                            family: 'Inter'
                        }
                    }
                }
            }
        }
    });

    const subjectAreaCtx = document.getElementById('subjectAreaChart').getContext('2d');
    const subjectAreaData = @json($stats['by_subject_area'] ?? []);
    
    const sortedSubjectAreas = Object.entries(subjectAreaData)
        .sort(([,a], [,b]) => b - a)
        .slice(0, 10);
    
    new Chart(subjectAreaCtx, {
        type: 'bar',
        data: {
            labels: sortedSubjectAreas.map(([label]) => label),
            datasets: [{
                label: 'Datasets',
                data: sortedSubjectAreas.map(([,value]) => value),
                backgroundColor: 'rgba(6, 182, 212, 0.8)',
                borderColor: 'rgba(6, 182, 212, 1)',
                borderWidth: 2,
                borderRadius: 8
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            indexAxis: 'y',
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                x: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1,
                        font: {
                            family: 'Inter'
                        }
                    }
                }
            }
        }
    });

    const monthlyGrowthCtx = document.getElementById('monthlyGrowthChart').getContext('2d');
    const monthlyGrowthData = @json($stats['monthly_growth'] ?? []);
    
    new Chart(monthlyGrowthCtx, {
        type: 'line',
        data: {
            labels: Object.keys(monthlyGrowthData),
            datasets: [{
                label: 'Datasets Added',
                data: Object.values(monthlyGrowthData),
                backgroundColor: 'rgba(245, 158, 11, 0.2)',
                borderColor: 'rgba(245, 158, 11, 1)',
                borderWidth: 3,
                fill: true,
                tension: 0.4,
                pointBackgroundColor: 'rgba(245, 158, 11, 1)',
                pointBorderColor: '#ffffff',
                pointBorderWidth: 2,
                pointRadius: 5,
                pointHoverRadius: 7
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1,
                        font: {
                            family: 'Inter'
                        }
                    },
                    grid: {
                        color: 'rgba(0, 0, 0, 0.05)'
                    }
                },
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        font: {
                            family: 'Inter'
                        }
                    }
                }
            }
        }
    });
});
</script>
@endsection
