@extends('layouts.app')
@section('title', 'My Datasets - DataSphere Machine Learning Repository')

@section('content')
<div class="relative">
    
    <!-- ===== DATASETS HERO ===== -->
    <section class="relative overflow-hidden bg-gradient-to-br from-brand-600 via-sphere-primary to-sphere-secondary text-white">
        <div class="absolute inset-0">
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_20%_80%,rgba(255,255,255,0.1)_0%,transparent_50%)]"></div>
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_80%_20%,rgba(255,255,255,0.08)_0%,transparent_50%)]"></div>
        </div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-16">
            <div class="flex flex-col md:flex-row items-center justify-between gap-6">
                
                <div class="text-center md:text-left">
                    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/10 backdrop-blur-sm border border-white/20 mb-4">
                        <i class="bi bi-grid-3x3-gap-fill text-yellow-300"></i>
                        <span class="text-sm font-semibold">My Contributions</span>
                    </div>
                    
                    <h1 class="text-3xl md:text-4xl font-bold mb-2">
                        My Datasets
                    </h1>
                    <p class="text-white/80 text-sm md:text-base max-w-xl">
                        Manage and track all your donated datasets. Monitor their status and engagement.
                    </p>
                </div>
                
                <a href="{{ route('contribute.policy') }}" 
                   class="inline-flex items-center gap-2 px-6 py-3 rounded-full bg-white text-brand-700 font-semibold shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition-all">
                    <i class="bi bi-plus-circle"></i>
                    <span>Donate New Dataset</span>
                </a>
                
            </div>
        </div>
    </section>

    <!-- ===== MAIN CONTENT ===== -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid lg:grid-cols-[280px_1fr] gap-6">
            
            <!-- ===== SIDEBAR NAVIGATION ===== -->
            <aside class="lg:sticky lg:top-24 lg:self-start">
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
                    <div class="p-4 border-b border-gray-100 dark:border-gray-700">
                        <h3 class="text-sm font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Navigation</h3>
                    </div>
                    <nav class="p-2">
                        <a href="{{ route('profile') }}" 
                           class="flex items-center gap-3 px-4 py-3 rounded-xl mb-1 transition-all text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700/50">
                            <i class="bi bi-person-fill text-lg"></i>
                            <span class="font-semibold text-sm">Profile</span>
                        </a>
                        <a href="{{ route('profile.datasets') }}" 
                           class="flex items-center gap-3 px-4 py-3 rounded-xl mb-1 transition-all bg-gradient-to-r from-brand-500 to-sphere-secondary text-white shadow-md">
                            <i class="bi bi-grid-3x3-gap-fill text-lg"></i>
                            <span class="font-semibold text-sm">My Datasets</span>
                            <i class="bi bi-chevron-right ml-auto"></i>
                        </a>
                        <a href="{{ route('profile.edits') }}" 
                           class="flex items-center gap-3 px-4 py-3 rounded-xl mb-1 transition-all text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700/50">
                            <i class="bi bi-pencil-fill text-lg"></i>
                            <span class="font-semibold text-sm">Edits</span>
                        </a>
                    </nav>
                    
                    <!-- Quick Stats -->
                    <div class="p-4 border-t border-gray-100 dark:border-gray-700">
                        <h3 class="text-sm font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-3">Quick Stats</h3>
                        <div class="space-y-2">
                            <div class="flex items-center justify-between p-2 rounded-lg bg-gray-50 dark:bg-gray-700/30">
                                <span class="text-xs text-gray-600 dark:text-gray-400">Total</span>
                                <span class="text-sm font-bold text-gray-900 dark:text-white">{{ $datasets->total() }}</span>
                            </div>
                            <div class="flex items-center justify-between p-2 rounded-lg bg-green-50 dark:bg-green-900/20">
                                <span class="text-xs text-green-700 dark:text-green-400">Approved</span>
                                <span class="text-sm font-bold text-green-700 dark:text-green-400">
                                    {{ $datasets->where('status', 'approved')->count() }}
                                </span>
                            </div>
                            <div class="flex items-center justify-between p-2 rounded-lg bg-amber-50 dark:bg-amber-900/20">
                                <span class="text-xs text-amber-700 dark:text-amber-400">Pending</span>
                                <span class="text-sm font-bold text-amber-700 dark:text-amber-400">
                                    {{ $datasets->where('status', 'pending')->count() }}
                                </span>
                            </div>
                            <div class="flex items-center justify-between p-2 rounded-lg bg-red-50 dark:bg-red-900/20">
                                <span class="text-xs text-red-700 dark:text-red-400">Rejected</span>
                                <span class="text-sm font-bold text-red-700 dark:text-red-400">
                                    {{ $datasets->where('status', 'rejected')->count() }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </aside>

            <!-- ===== MAIN CONTENT AREA ===== -->
            <div class="space-y-6">
                
                <!-- Flash Messages -->
                @if(session('success'))
                <div class="bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-800 text-green-800 dark:text-green-200 px-4 py-3 rounded-xl flex items-start gap-3">
                    <i class="bi bi-check-circle-fill text-green-500 text-xl mt-0.5"></i>
                    <div class="flex-1 text-sm font-medium">{{ session('success') }}</div>
                    <button onclick="this.parentElement.remove()" class="text-green-500 hover:text-green-700">
                        <i class="bi bi-x-lg"></i>
                    </button>
                </div>
                @endif

                @if($datasets->isEmpty())
                    <!-- ===== EMPTY STATE ===== -->
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
                        <div class="p-12 text-center">
                            <div class="w-24 h-24 mx-auto mb-6 rounded-full bg-gradient-to-br from-brand-50 to-sphere-secondary/10 dark:from-brand-900/30 dark:to-sphere-secondary/20 flex items-center justify-center">
                                <i class="bi bi-database text-5xl text-brand-500 dark:text-brand-400"></i>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-3">No datasets yet</h3>
                            <p class="text-gray-500 dark:text-gray-400 mb-8 max-w-md mx-auto">
                                You haven't donated any datasets yet. Start contributing to the DataSphere Machine Learning Repository and help advance research!
                            </p>
                            <a href="{{ route('contribute.policy') }}" 
                               class="inline-flex items-center gap-2 px-6 py-3 rounded-full bg-gradient-to-r from-brand-600 to-sphere-secondary text-white font-semibold shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition-all">
                                <i class="bi bi-cloud-arrow-up"></i>
                                <span>Donate Your First Dataset</span>
                            </a>
                            <div class="mt-6 inline-flex items-center gap-2 px-4 py-2 rounded-full bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600">
                                <i class="bi bi-info-circle text-gray-400"></i>
                                <small class="text-gray-600 dark:text-gray-400">Your datasets will appear here after submission</small>
                            </div>
                        </div>
                    </div>
                @else
                    <!-- ===== FILTERS & SORTING ===== -->
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
                        <div class="p-6 border-b border-gray-100 dark:border-gray-700">
                            <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-brand-50 dark:bg-brand-900/30 flex items-center justify-center">
                                        <i class="bi bi-funnel text-xl text-brand-600 dark:text-brand-400"></i>
                                    </div>
                                    <div>
                                        <h2 class="text-lg font-bold text-gray-900 dark:text-white">Filters & Sorting</h2>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">Customize your view</p>
                                    </div>
                                </div>
                                
                                <!-- Sort Button -->
                                <button class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-brand-50 dark:bg-brand-900/30 text-brand-600 dark:text-brand-400 font-semibold text-sm hover:bg-brand-100 dark:hover:bg-brand-900/50 transition-colors" type="button" data-bs-toggle="collapse" data-bs-target="#sortOptions">
                                    <i class="bi bi-sort-down"></i>
                                    <span>SORT BY DATE DONATED, DESC</span>
                                    <i class="bi bi-chevron-down text-xs"></i>
                                </button>
                            </div>
                            
                            <!-- Status Filters -->
                            <div class="mt-4 pt-4 border-t border-gray-100 dark:border-gray-700">
                                <div class="flex items-center gap-2 mb-3">
                                    <i class="bi bi-funnel-fill text-gray-400"></i>
                                    <span class="text-sm font-semibold text-gray-700 dark:text-gray-300">Filter by Status</span>
                                </div>
                                <div class="flex flex-wrap gap-3">
                                    <label class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 cursor-pointer hover:bg-green-100 dark:hover:bg-green-900/30 transition-colors">
                                        <input class="form-check-input" type="checkbox" id="filterApproved" checked>
                                        <span class="text-sm font-semibold text-green-700 dark:text-green-400">APPROVED</span>
                                    </label>
                                    <label class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-amber-50 dark:bg-amber-900/20 border border-amber-200 dark:border-amber-800 cursor-pointer hover:bg-amber-100 dark:hover:bg-amber-900/30 transition-colors">
                                        <input class="form-check-input" type="checkbox" id="filterPending" checked>
                                        <span class="text-sm font-semibold text-amber-700 dark:text-amber-400">PENDING</span>
                                    </label>
                                    <label class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 cursor-pointer hover:bg-red-100 dark:hover:bg-red-900/30 transition-colors">
                                        <input class="form-check-input" type="checkbox" id="filterRejected" checked>
                                        <span class="text-sm font-semibold text-red-700 dark:text-red-400">REJECTED</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ===== DATASETS LIST ===== -->
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
                        <div class="p-6 border-b border-gray-100 dark:border-gray-700 flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-sphere-secondary/10 dark:bg-sphere-secondary/20 flex items-center justify-center">
                                    <i class="bi bi-database text-xl text-sphere-secondary dark:text-sphere-primary"></i>
                                </div>
                                <div>
                                    <h2 class="text-lg font-bold text-gray-900 dark:text-white">All Datasets</h2>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ $datasets->total() }} total datasets</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Desktop Table View -->
                        <div class="hidden md:block">
                            <div class="overflow-x-auto">
                                <table class="w-full">
                                    <thead class="bg-gray-50 dark:bg-gray-700/50 border-b border-gray-100 dark:border-gray-700">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Dataset Name</th>
                                            <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Date Donated</th>
                                            <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Status</th>
                                            <th class="px-6 py-3 text-right text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                                        @foreach($datasets as $dataset)
                                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors">
                                            <td class="px-6 py-4">
                                                <div class="flex items-center gap-3">
                                                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-brand-500 to-sphere-secondary flex items-center justify-center flex-shrink-0">
                                                        <i class="bi bi-database text-white"></i>
                                                    </div>
                                                    <div>
                                                        <a href="{{ route('profile.dataset.show', $dataset) }}" 
                                                           class="font-semibold text-gray-900 dark:text-white hover:text-brand-600 dark:hover:text-brand-400 transition-colors">
                                                            {{ $dataset->name }}
                                                        </a>
                                                        @if($dataset->subject_area)
                                                        <div class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">
                                                            <i class="bi bi-folder me-1"></i>{{ $dataset->subject_area }}
                                                        </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="text-sm text-gray-900 dark:text-white font-medium">
                                                    {{ $dataset->donated_date?->format('M d, Y') ?? 'N/A' }}
                                                </div>
                                                <div class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">
                                                    {{ $dataset->donated_date?->diffForHumans() ?? '' }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4">
                                                @php
                                                    $status = $dataset->status ?? 'pending';
                                                    $statusStyles = [
                                                        'approved' => 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400 border-green-200 dark:border-green-800',
                                                        'pending' => 'bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400 border-amber-200 dark:border-amber-800',
                                                        'rejected' => 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400 border-red-200 dark:border-red-800'
                                                    ][$status] ?? 'bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-300 border-gray-200 dark:border-gray-600';
                                                    
                                                    $statusIcon = [
                                                        'approved' => 'check-circle-fill',
                                                        'pending' => 'clock-history',
                                                        'rejected' => 'x-circle-fill'
                                                    ][$status] ?? 'question-circle-fill';
                                                @endphp
                                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold border {{ $statusStyles }}">
                                                    <i class="bi bi-{{ $statusIcon }}"></i>
                                                    {{ strtoupper($status) }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="flex items-center justify-end gap-2">
                                                    @php
                                                        $primaryFile = $dataset->files->first();
                                                    @endphp
                                                    
                                                    <a href="{{ route('profile.dataset.show', $dataset) }}" 
                                                       class="w-9 h-9 rounded-lg bg-brand-50 dark:bg-brand-900/30 text-brand-600 dark:text-brand-400 hover:bg-brand-100 dark:hover:bg-brand-900/50 flex items-center justify-center transition-colors"
                                                       title="View Details">
                                                        <i class="bi bi-eye"></i>
                                                    </a>
                                                    
                                                    @if($primaryFile)
                                                        <a href="{{ route('datasets.download', [$dataset, $primaryFile]) }}" 
                                                           class="w-9 h-9 rounded-lg bg-green-50 dark:bg-green-900/30 text-green-600 dark:text-green-400 hover:bg-green-100 dark:hover:bg-green-900/50 flex items-center justify-center transition-colors"
                                                           title="Download">
                                                            <i class="bi bi-download"></i>
                                                        </a>
                                                    @else
                                                        <button class="w-9 h-9 rounded-lg bg-gray-100 dark:bg-gray-700 text-gray-400 dark:text-gray-500 flex items-center justify-center cursor-not-allowed"
                                                                title="No files (External Link)" disabled>
                                                            <i class="bi bi-download"></i>
                                                        </button>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                        <!-- Mobile Card View -->
                        <div class="md:hidden divide-y divide-gray-100 dark:divide-gray-700">
                            @foreach($datasets as $dataset)
                            <div class="p-4 hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors">
                                <div class="flex items-start gap-3 mb-3">
                                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-brand-500 to-sphere-secondary flex items-center justify-center flex-shrink-0">
                                        <i class="bi bi-database text-white"></i>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <a href="{{ route('profile.dataset.show', $dataset) }}" 
                                           class="font-semibold text-gray-900 dark:text-white hover:text-brand-600 dark:hover:text-brand-400 transition-colors block truncate">
                                            {{ $dataset->name }}
                                        </a>
                                        <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                            <i class="bi bi-calendar me-1"></i>{{ $dataset->donated_date?->format('M d, Y') ?? 'N/A' }}
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="flex items-center justify-between">
                                    @php
                                        $status = $dataset->status ?? 'pending';
                                        $statusStyles = [
                                            'approved' => 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400',
                                            'pending' => 'bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400',
                                            'rejected' => 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400'
                                        ][$status] ?? 'bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-300';
                                        
                                        $statusIcon = [
                                            'approved' => 'check-circle-fill',
                                            'pending' => 'clock-history',
                                            'rejected' => 'x-circle-fill'
                                        ][$status] ?? 'question-circle-fill';
                                    @endphp
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold {{ $statusStyles }}">
                                        <i class="bi bi-{{ $statusIcon }}"></i>
                                        {{ strtoupper($status) }}
                                    </span>
                                    
                                    <div class="flex items-center gap-2">
                                        <a href="{{ route('profile.dataset.show', $dataset) }}" 
                                           class="w-9 h-9 rounded-lg bg-brand-50 dark:bg-brand-900/30 text-brand-600 dark:text-brand-400 flex items-center justify-center">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        
                                        @php $primaryFile = $dataset->files->first(); @endphp
                                        @if($primaryFile)
                                            <a href="{{ route('datasets.download', [$dataset, $primaryFile]) }}" 
                                               class="w-9 h-9 rounded-lg bg-green-50 dark:bg-green-900/30 text-green-600 dark:text-green-400 flex items-center justify-center">
                                                <i class="bi bi-download"></i>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        
                        <!-- Pagination -->
                        @if($datasets->hasPages())
                        <div class="p-4 border-t border-gray-100 dark:border-gray-700 bg-gray-50 dark:bg-gray-700/30">
                            <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                                <div class="flex items-center gap-3">
                                    <span class="text-sm text-gray-600 dark:text-gray-400">Rows per page:</span>
                                    <select class="px-3 py-1.5 rounded-lg bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 text-sm text-gray-900 dark:text-white focus:outline-none focus:border-brand-500" 
                                            onchange="window.location.href=this.value">
                                        <option value="{{ $datasets->url(1) }}" {{ $datasets->perPage() == 5 ? 'selected' : '' }}>5</option>
                                        <option value="{{ $datasets->url(1) }}" {{ $datasets->perPage() == 10 ? 'selected' : '' }}>10</option>
                                        <option value="{{ $datasets->url(1) }}" {{ $datasets->perPage() == 20 ? 'selected' : '' }}>20</option>
                                    </select>
                                    <span class="text-sm text-gray-600 dark:text-gray-400">
                                        {{ $datasets->firstItem() ?? 0 }} to {{ $datasets->lastItem() ?? 0 }} of {{ $datasets->total() }}
                                    </span>
                                </div>
                                <div>
                                    {{ $datasets->links() }}
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                @endif

            </div>
        </div>
    </div>
</div>
@endsection