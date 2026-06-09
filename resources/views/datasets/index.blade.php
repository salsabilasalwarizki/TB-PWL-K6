@extends('layouts.app')
@section('title', 'Browse Datasets - DataSphere')
@section('meta_desc', 'Explore our curated collection of machine learning datasets')

@section('content')
<div class="relative">
    
    <!-- ===== HERO SECTION ===== -->
    <section class="relative overflow-hidden bg-gradient-to-br from-brand-600 via-sphere-primary to-sphere-secondary text-white">
        <div class="absolute inset-0">
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_20%_80%,rgba(255,255,255,0.1)_0%,transparent_50%)]"></div>
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_80%_20%,rgba(255,255,255,0.08)_0%,transparent_50%)]"></div>
        </div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 lg:py-14">
            <div class="flex flex-col md:flex-row items-center justify-between gap-6">
                <div class="text-center md:text-left">
                    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/10 backdrop-blur-sm border border-white/20 mb-3">
                        <i class="bi bi-grid-3x3-gap-fill text-yellow-300"></i>
                        <span class="text-sm font-semibold">Dataset Library</span>
                    </div>
                    <h1 class="text-3xl md:text-4xl font-bold mb-2">Browse Datasets</h1>
                    <p class="text-white/80 text-sm md:text-base max-w-xl">
                        Discover <strong class="text-white">{{ number_format($datasets->total() ?? 0) }}</strong> curated datasets for your machine learning projects
                    </p>
                </div>
                <a href="{{ route('contribute.policy') }}" 
                   class="inline-flex items-center gap-2 px-6 py-3 rounded-full bg-white text-brand-700 font-semibold shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition-all">
                    <i class="bi bi-plus-circle"></i>
                    <span>Contribute Dataset</span>
                </a>
            </div>
        </div>
    </section>

    <!-- ===== MAIN CONTENT ===== -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid lg:grid-cols-[280px_1fr] gap-6">
            
            <!-- ===== DESKTOP FILTERS SIDEBAR ===== -->
            <aside class="hidden lg:block lg:sticky lg:top-24 lg:self-start">
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
                    <div class="p-4 border-b border-gray-100 dark:border-gray-700 flex items-center justify-between">
                        <h3 class="text-sm font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider flex items-center gap-2">
                            <i class="bi bi-funnel-fill"></i>Filters
                        </h3>
                        <button type="button" onclick="clearAllFilters()" class="text-xs text-brand-600 dark:text-brand-400 hover:underline font-semibold">
                            Clear All
                        </button>
                    </div>
                    
                    <div class="p-4 space-y-4 max-h-[calc(100vh-160px)] overflow-y-auto custom-scrollbar">
                        @include('partials.filter-form')
                    </div>
                </div>
            </aside>

            <!-- ===== MAIN CONTENT AREA ===== -->
            <div class="space-y-4 md:space-y-6">
                
                <!-- Mobile Filter Toggle -->
                <div class="lg:hidden flex items-center gap-2">
                    <button onclick="openMobileFilter()" class="flex-1 inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 text-sm font-semibold text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                        <i class="bi bi-funnel-fill text-brand-600 dark:text-brand-400"></i>
                        <span>Filters</span>
                        @if(request()->except('page', 'view', 'sort', 'order'))
                        <span class="inline-flex items-center justify-center w-5 h-5 rounded-full bg-brand-600 text-white text-xs font-bold">
                            {{ count(request()->except('page', 'view', 'sort', 'order')) }}
                        </span>
                        @endif
                    </button>
                    <button id="mobileSortBtn" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 text-sm font-semibold text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                        <i class="bi bi-sort-down text-brand-600 dark:text-brand-400"></i>
                        <span class="hidden sm:inline">Sort</span>
                    </button>
                </div>
                
                <!-- Mobile Sort Dropdown -->
                <div id="mobileSortDropdown" class="hidden lg:hidden bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-100 dark:border-gray-700 p-2">
                    <a href="{{ request()->fullUrlWithQuery(['sort' => 'view_count', 'order' => 'desc']) }}" 
                       class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700/50 {{ request('sort') == 'view_count' ? 'bg-brand-50 dark:bg-brand-900/20 text-brand-600 dark:text-brand-400' : '' }}">
                        <i class="bi bi-eye"></i><span>Most Viewed</span>
                    </a>
                    <a href="{{ request()->fullUrlWithQuery(['sort' => 'download_count', 'order' => 'desc']) }}" 
                       class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700/50 {{ request('sort') == 'download_count' ? 'bg-brand-50 dark:bg-brand-900/20 text-brand-600 dark:text-brand-400' : '' }}">
                        <i class="bi bi-cloud-download"></i><span>Most Downloaded</span>
                    </a>
                    <a href="{{ request()->fullUrlWithQuery(['sort' => 'citation_count', 'order' => 'desc']) }}" 
                       class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700/50 {{ request('sort') == 'citation_count' ? 'bg-brand-50 dark:bg-brand-900/20 text-brand-600 dark:text-brand-400' : '' }}">
                        <i class="bi bi-chat-quote"></i><span>Most Cited</span>
                    </a>
                    <div class="h-px bg-gray-100 dark:bg-gray-700 my-1"></div>
                    <a href="{{ request()->fullUrlWithQuery(['sort' => 'name', 'order' => 'asc']) }}" 
                       class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700/50 {{ request('sort') == 'name' ? 'bg-brand-50 dark:bg-brand-900/20 text-brand-600 dark:text-brand-400' : '' }}">
                        <i class="bi bi-sort-alpha-down"></i><span>Name A-Z</span>
                    </a>
                    <a href="{{ request()->fullUrlWithQuery(['sort' => 'created_at', 'order' => 'desc']) }}" 
                       class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700/50 {{ request('sort') == 'created_at' ? 'bg-brand-50 dark:bg-brand-900/20 text-brand-600 dark:text-brand-400' : '' }}">
                        <i class="bi bi-clock"></i><span>Newest First</span>
                    </a>
                </div>
                
                <!-- Search Results Alert -->
                @if(request('q'))
                <div class="bg-brand-50 dark:bg-brand-900/20 border border-brand-200 dark:border-brand-800 rounded-xl md:rounded-2xl p-3 md:p-4 flex items-center justify-between">
                    <div class="flex items-center gap-2 md:gap-3 min-w-0">
                        <i class="bi bi-search text-brand-600 dark:text-brand-400 text-lg md:text-xl flex-shrink-0"></i>
                        <div class="min-w-0">
                            <p class="text-xs md:text-sm font-semibold text-brand-900 dark:text-brand-200 truncate">
                                Search: "{{ request('q') }}"
                            </p>
                            <p class="text-xs text-brand-700 dark:text-brand-300">{{ $datasets->total() }} found</p>
                        </div>
                    </div>
                    <a href="{{ route('datasets.index') }}" class="inline-flex items-center gap-1 px-2 md:px-3 py-1 md:py-1.5 rounded-lg bg-brand-100 dark:bg-brand-900/30 text-brand-700 dark:text-brand-300 text-xs font-semibold hover:bg-brand-200 dark:hover:bg-brand-900/50 transition-colors flex-shrink-0 ml-2">
                        <i class="bi bi-x-circle"></i>
                        <span class="hidden sm:inline">Clear</span>
                    </a>
                </div>
                @endif
                
                <!-- Desktop Toolbar -->
                <div class="hidden lg:block bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-4">
                    <div class="flex flex-wrap items-center justify-between gap-4">
                        
                        <!-- Sort Dropdown -->
                        <div class="relative">
                            <button id="sortBtn" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 text-sm font-semibold text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                                <i class="bi bi-sort-down"></i>
                                <span>Sort: {{ $sortLabels[request('sort', 'view_count')] ?? '# Views' }}</span>
                                <i class="bi bi-chevron-down text-xs"></i>
                            </button>
                            <div id="sortDropdown" class="hidden absolute top-full left-0 mt-2 w-56 bg-white dark:bg-gray-800 rounded-xl shadow-xl border border-gray-100 dark:border-gray-700 py-2 z-20">
                                <a href="{{ request()->fullUrlWithQuery(['sort' => 'view_count', 'order' => 'desc']) }}" 
                                   class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700/50 {{ request('sort') == 'view_count' ? 'bg-brand-50 dark:bg-brand-900/20 text-brand-600 dark:text-brand-400' : '' }}">
                                    <i class="bi bi-eye"></i><span>Most Viewed</span>
                                </a>
                                <a href="{{ request()->fullUrlWithQuery(['sort' => 'download_count', 'order' => 'desc']) }}" 
                                   class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700/50 {{ request('sort') == 'download_count' ? 'bg-brand-50 dark:bg-brand-900/20 text-brand-600 dark:text-brand-400' : '' }}">
                                    <i class="bi bi-cloud-download"></i><span>Most Downloaded</span>
                                </a>
                                <a href="{{ request()->fullUrlWithQuery(['sort' => 'citation_count', 'order' => 'desc']) }}" 
                                   class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700/50 {{ request('sort') == 'citation_count' ? 'bg-brand-50 dark:bg-brand-900/20 text-brand-600 dark:text-brand-400' : '' }}">
                                    <i class="bi bi-chat-quote"></i><span>Most Cited</span>
                                </a>
                                <div class="h-px bg-gray-100 dark:bg-gray-700 my-1"></div>
                                <a href="{{ request()->fullUrlWithQuery(['sort' => 'name', 'order' => 'asc']) }}" 
                                   class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700/50 {{ request('sort') == 'name' ? 'bg-brand-50 dark:bg-brand-900/20 text-brand-600 dark:text-brand-400' : '' }}">
                                    <i class="bi bi-sort-alpha-down"></i><span>Name A-Z</span>
                                </a>
                                <a href="{{ request()->fullUrlWithQuery(['sort' => 'created_at', 'order' => 'desc']) }}" 
                                   class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700/50 {{ request('sort') == 'created_at' ? 'bg-brand-50 dark:bg-brand-900/20 text-brand-600 dark:text-brand-400' : '' }}">
                                    <i class="bi bi-clock"></i><span>Newest First</span>
                                </a>
                            </div>
                        </div>
                        
                        <!-- View Toggle & Expand -->
                        <div class="flex items-center gap-2">
                            <div class="flex rounded-xl border border-gray-200 dark:border-gray-600 overflow-hidden">
                                <button type="button" id="listViewBtn" class="px-3 py-2 text-sm transition-colors {{ request('view') != 'grid' ? 'bg-brand-600 text-white' : 'bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600' }}">
                                    <i class="bi bi-list-ul"></i>
                                </button>
                                <button type="button" id="gridViewBtn" class="px-3 py-2 text-sm transition-colors {{ request('view') == 'grid' ? 'bg-brand-600 text-white' : 'bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600' }}">
                                    <i class="bi bi-grid-3x3-gap"></i>
                                </button>
                            </div>
                            <button id="expandAllBtn" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-brand-50 dark:bg-brand-900/30 text-brand-600 dark:text-brand-400 text-sm font-semibold hover:bg-brand-100 dark:hover:bg-brand-900/50 transition-colors">
                                <i class="bi bi-arrows-expand" id="expandIcon"></i>
                                <span class="hidden sm:inline" id="expandText">Expand All</span>
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Active Filters -->
                @if(request()->except('page', 'view', 'sort', 'order'))
                <div class="bg-white dark:bg-gray-800 rounded-xl md:rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-3 md:p-4">
                    <div class="flex flex-wrap items-center gap-2">
                        <span class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Active:</span>
                        @foreach(request()->except('page', 'view', 'sort', 'order') as $key => $value)
                            @if(is_array($value))
                                @foreach($value as $v)
                                <span class="inline-flex items-center gap-1 px-2 md:px-3 py-1 rounded-full bg-brand-50 dark:bg-brand-900/20 border border-brand-200 dark:border-brand-800 text-xs font-semibold text-brand-700 dark:text-brand-300">
                                    <span class="hidden sm:inline">{{ ucwords(str_replace('_', ' ', $key)) }}:</span>
                                    <span class="truncate max-w-[100px]">{{ $v }}</span>
                                    <a href="{{ request()->fullUrlWithQuery([$key => array_filter(request($key, []), fn($x) => $x != $v)]) }}" 
                                       class="text-brand-500 hover:text-brand-700 dark:hover:text-brand-200 ml-1">&times;</a>
                                </span>
                                @endforeach
                            @elseif($value)
                            <span class="inline-flex items-center gap-1 px-2 md:px-3 py-1 rounded-full bg-brand-50 dark:bg-brand-900/20 border border-brand-200 dark:border-brand-800 text-xs font-semibold text-brand-700 dark:text-brand-300">
                                <span class="hidden sm:inline">{{ ucwords(str_replace('_', ' ', $key)) }}:</span>
                                <span class="truncate max-w-[100px]">{{ $value }}</span>
                                <a href="{{ request()->fullUrlWithQuery([$key => null]) }}" 
                                   class="text-brand-500 hover:text-brand-700 dark:hover:text-brand-200 ml-1">&times;</a>
                            </span>
                            @endif
                        @endforeach
                        <a href="{{ route('datasets.index') }}" class="text-xs text-red-500 hover:text-red-700 font-semibold ml-auto">
                            Clear All
                        </a>
                    </div>
                </div>
                @endif
                
                <!-- Datasets Grid/List -->
                <div class="{{ request('view') == 'grid' ? 'grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-3 md:gap-4' : 'space-y-3 md:space-y-4' }}" id="datasetsContainer">
                    @forelse($datasets as $index => $dataset)
                    <article class="bg-white dark:bg-gray-800 rounded-xl md:rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden hover:shadow-xl hover:-translate-y-1 transition-all duration-300 dataset-card" 
                             data-dataset-id="{{ $dataset->dataset_id }}"
                             style="animation-delay: {{ min($index * 0.05, 0.5) }}s">
                        <div class="p-3 md:p-4">
                            <div class="flex gap-2 md:gap-3">
                                <!-- Thumbnail -->
                                <div class="flex-shrink-0">
                                    <div class="w-16 h-16 md:w-20 md:h-20 rounded-lg md:rounded-xl overflow-hidden bg-gradient-to-br from-brand-500 to-sphere-secondary flex items-center justify-center shadow-sm">
                                        @if($dataset->thumbnail_url)
                                            <img src="{{ $dataset->thumbnail_url }}" alt="{{ $dataset->display_name ?? $dataset->name }}" class="w-full h-full object-cover">
                                        @elseif($dataset->large_image_url)
                                            <img src="{{ $dataset->large_image_url }}" alt="{{ $dataset->display_name ?? $dataset->name }}" class="w-full h-full object-cover">
                                        @else
                                            <i class="bi bi-database text-xl md:text-2xl text-white"></i>
                                        @endif
                                    </div>
                                </div>
                                
                                <!-- Content -->
                                <div class="flex-1 min-w-0">
                                    <!-- Title -->
                                    <h6 class="font-semibold text-gray-900 dark:text-white mb-1 line-clamp-1 text-sm md:text-base">
                                        <a href="{{ route('datasets.show', $dataset) }}" class="hover:text-brand-600 dark:hover:text-brand-400 transition-colors">
                                            {{ $dataset->display_name ?? $dataset->name }}
                                        </a>
                                    </h6>
                                    
                                    <!-- Badges -->
                                    <div class="flex flex-wrap gap-1 mb-2">
                                        @if($dataset->data_type)
                                        <span class="px-1.5 md:px-2 py-0.5 rounded-full bg-blue-50 dark:bg-blue-900/20 text-blue-700 dark:text-blue-400 text-[10px] md:text-xs font-semibold">{{ $dataset->data_type }}</span>
                                        @endif
                                        @if($dataset->task_type)
                                        <span class="px-1.5 md:px-2 py-0.5 rounded-full bg-green-50 dark:bg-green-900/20 text-green-700 dark:text-green-400 text-[10px] md:text-xs font-semibold">{{ $dataset->task_type }}</span>
                                        @endif
                                        @if($dataset->status !== 'available')
                                        <span class="px-1.5 md:px-2 py-0.5 rounded-full bg-{{ $dataset->status === 'pending' ? 'amber' : 'red' }}-50 dark:bg-{{ $dataset->status === 'pending' ? 'amber' : 'red' }}-900/20 text-{{ $dataset->status === 'pending' ? 'amber' : 'red' }}-700 dark:text-{{ $dataset->status === 'pending' ? 'amber' : 'red' }}-400 text-[10px] md:text-xs font-semibold">
                                            {{ ucfirst($dataset->status) }}
                                        </span>
                                        @endif
                                    </div>
                                    
                                    <!-- Description -->
                                    <p class="text-xs text-gray-600 dark:text-gray-400 mb-2 line-clamp-2 hidden md:block">
                                        {{ Str::limit($dataset->abstract ?? $dataset->description, request('view') == 'grid' ? 60 : 120) }}
                                    </p>
                                    
                                    <!-- Stats -->
                                    <div class="flex flex-wrap gap-2 md:gap-3 text-[10px] md:text-xs text-gray-500 dark:text-gray-400 mb-2 md:mb-3">
                                        @if($dataset->num_instances !== null)
                                        <span class="flex items-center gap-1" title="Instances">
                                            <i class="bi bi-table"></i>
                                            {{ $dataset->num_instances >= 1000000 ? number_format($dataset->num_instances / 1000000, 1) . 'M' : ($dataset->num_instances >= 1000 ? number_format($dataset->num_instances / 1000, 1) . 'K' : number_format($dataset->num_instances)) }}
                                        </span>
                                        @endif
                                        @if($dataset->num_features !== null)
                                        <span class="flex items-center gap-1" title="Features">
                                            <i class="bi bi-grid-3x3-gap"></i>
                                            {{ $dataset->num_features >= 1000 ? number_format($dataset->num_features / 1000, 1) . 'K' : number_format($dataset->num_features) }}
                                        </span>
                                        @endif
                                        @if($dataset->view_count)
                                        <span class="flex items-center gap-1" title="Views">
                                            <i class="bi bi-eye"></i>
                                            {{ number_format($dataset->view_count) }}
                                        </span>
                                        @endif
                                    </div>
                                    
                                    <!-- Actions -->
                                    <div class="flex gap-1.5 md:gap-2">
                                        <a href="{{ route('datasets.show', $dataset) }}" 
                                           class="flex-1 inline-flex items-center justify-center gap-1 px-2 md:px-3 py-1.5 rounded-lg bg-brand-50 dark:bg-brand-900/30 text-brand-600 dark:text-brand-400 text-[11px] md:text-xs font-semibold hover:bg-brand-100 dark:hover:bg-brand-900/50 transition-colors">
                                            <i class="bi bi-eye"></i>
                                            <span>View</span>
                                        </a>
                                        @php $defaultFile = $dataset->files->where('pivot.is_default', 1)->first() ?? $dataset->files->first(); @endphp
                                        @if($defaultFile)
                                        <a href="{{ asset('storage/' . $defaultFile->file_path) }}" 
                                           class="w-7 h-7 md:w-8 md:h-8 rounded-lg bg-green-50 dark:bg-green-900/30 text-green-600 dark:text-green-400 flex items-center justify-center hover:bg-green-100 dark:hover:bg-green-900/50 transition-colors"
                                           download title="Download">
                                            <i class="bi bi-download text-xs md:text-sm"></i>
                                        </a>
                                        @endif
                                        <button class="w-7 h-7 md:w-8 md:h-8 rounded-lg bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400 flex items-center justify-center hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors toggle-detail-btn" 
                                                data-target="details-{{ $dataset->dataset_id }}"
                                                title="Toggle Details">
                                            <i class="bi bi-chevron-down text-xs md:text-sm toggle-icon" id="toggle-icon-{{ $dataset->dataset_id }}"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Expanded Details -->
                            <div class="hidden mt-3 md:mt-4 pt-3 md:pt-4 border-t border-gray-100 dark:border-gray-700" id="details-{{ $dataset->dataset_id }}">
                                <div class="grid md:grid-cols-2 gap-3 md:gap-4">
                                    @if($dataset->variables->isNotEmpty())
                                    <div>
                                        <h6 class="text-[10px] md:text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-2 flex items-center gap-1">
                                            <i class="bi bi-list-columns"></i>Variables
                                        </h6>
                                        <div class="space-y-1">
                                            @foreach($dataset->variables->take(4) as $var)
                                            <div class="flex items-center justify-between text-[11px] md:text-xs">
                                                <span class="text-gray-700 dark:text-gray-300 truncate mr-2">{{ $var->display_name ?? $var->variable_name }}</span>
                                                <span class="px-1.5 md:px-2 py-0.5 rounded bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400 flex-shrink-0 text-[10px] md:text-xs">{{ $var->variable_type }}</span>
                                            </div>
                                            @endforeach
                                        </div>
                                        @if($dataset->variables->count() > 4)
                                        <p class="text-[10px] md:text-xs text-gray-500 dark:text-gray-400 mt-1">+{{ $dataset->variables->count() - 4 }} more</p>
                                        @endif
                                    </div>
                                    @endif
                                    
                                    <div>
                                        @if($dataset->descriptionDetails && $dataset->descriptionDetails->purpose)
                                        <h6 class="text-[10px] md:text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-2 flex items-center gap-1">
                                            <i class="bi bi-info-circle"></i>Info
                                        </h6>
                                        <p class="text-[11px] md:text-xs text-gray-600 dark:text-gray-400 mb-2"><strong>Purpose:</strong> {{ Str::limit($dataset->descriptionDetails->purpose, 80) }}</p>
                                        @endif
                                        
                                        @if($dataset->keywords->isNotEmpty())
                                        <h6 class="text-[10px] md:text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-2 flex items-center gap-1">
                                            <i class="bi bi-tags"></i>Keywords
                                        </h6>
                                        <div class="flex flex-wrap gap-1">
                                            @foreach($dataset->keywords->take(5) as $keyword)
                                            <a href="{{ route('datasets.index', ['keywords[]' => $keyword->keyword_id]) }}" 
                                               class="px-1.5 md:px-2 py-0.5 rounded bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 text-[10px] md:text-xs hover:bg-brand-100 dark:hover:bg-brand-900/30 hover:text-brand-600 dark:hover:text-brand-400 transition-colors">
                                                {{ $keyword->keyword_name }}
                                            </a>
                                            @endforeach
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                
                                <!-- Quick Actions -->
                                <div class="flex gap-1.5 md:gap-2 mt-3 md:mt-4 pt-3 md:pt-4 border-t border-gray-100 dark:border-gray-700">
                                    <button class="flex-1 inline-flex items-center justify-center gap-1 px-2 md:px-3 py-1.5 rounded-lg bg-brand-50 dark:bg-brand-900/30 text-brand-600 dark:text-brand-400 text-[11px] md:text-xs font-semibold hover:bg-brand-100 dark:hover:bg-brand-900/50 transition-colors" 
                                            onclick="importInPython({{ $dataset->dataset_id }})">
                                        <i class="bi bi-code-slash"></i><span>Python</span>
                                    </button>
                                    <button class="flex-1 inline-flex items-center justify-center gap-1 px-2 md:px-3 py-1.5 rounded-lg bg-amber-50 dark:bg-amber-900/30 text-amber-600 dark:text-amber-400 text-[11px] md:text-xs font-semibold hover:bg-amber-100 dark:hover:bg-amber-900/50 transition-colors" 
                                            onclick="showCitation({{ $dataset->dataset_id }}, '{{ addslashes($dataset->name) }}')">
                                        <i class="bi bi-quote"></i><span>Cite</span>
                                    </button>
                                    @if(auth()->check())
                                    <button class="flex-1 inline-flex items-center justify-center gap-1 px-2 md:px-3 py-1.5 rounded-lg bg-cyan-50 dark:bg-cyan-900/30 text-cyan-600 dark:text-cyan-400 text-[11px] md:text-xs font-semibold hover:bg-cyan-100 dark:hover:bg-cyan-900/50 transition-colors" 
                                            onclick="addToCollection({{ $dataset->dataset_id }})">
                                        <i class="bi bi-bookmark"></i><span>Save</span>
                                    </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </article>
                    @empty
                    <div class="col-span-full bg-white dark:bg-gray-800 rounded-xl md:rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-8 md:p-12 text-center">
                        <div class="w-20 h-20 md:w-24 md:h-24 mx-auto mb-4 md:mb-6 rounded-full bg-gradient-to-br from-brand-50 to-sphere-secondary/10 dark:from-brand-900/30 dark:to-sphere-secondary/20 flex items-center justify-center">
                            <i class="bi bi-search text-4xl md:text-5xl text-brand-500 dark:text-brand-400"></i>
                        </div>
                        <h3 class="text-xl md:text-2xl font-bold text-gray-900 dark:text-white mb-2 md:mb-3">No datasets found</h3>
                        <p class="text-sm md:text-base text-gray-500 dark:text-gray-400 mb-6 md:mb-8 max-w-md mx-auto">Try adjusting your filters or search terms</p>
                        <a href="{{ route('datasets.index') }}" 
                           class="inline-flex items-center gap-2 px-5 md:px-6 py-2.5 md:py-3 rounded-full bg-gradient-to-r from-brand-600 to-sphere-secondary text-white font-semibold shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition-all text-sm md:text-base">
                            <i class="bi bi-x-circle"></i><span>Clear All Filters</span>
                        </a>
                    </div>
                    @endforelse
                </div>
                
                <!-- Pagination Section -->
                @if($datasets->hasPages())
                <div class="mt-4 md:mt-6 bg-white dark:bg-gray-800 rounded-xl md:rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-3 md:p-4">
                    <div class="flex flex-col md:flex-row items-center justify-between gap-3 md:gap-4">
                        
                        <!-- Results Info -->
                        <div class="text-xs md:text-sm text-gray-600 dark:text-gray-400 text-center md:text-left">
                            <span class="font-semibold text-gray-900 dark:text-white">{{ $datasets->firstItem() ?? 0 }}</span>
                            <span class="mx-1">-</span>
                            <span class="font-semibold text-gray-900 dark:text-white">{{ $datasets->lastItem() ?? 0 }}</span>
                            <span class="mx-1">of</span>
                            <span class="font-semibold text-gray-900 dark:text-white">{{ number_format($datasets->total()) }}</span>
                        </div>

                        <!-- Pagination Controls -->
                        <div class="flex items-center gap-0.5 md:gap-1 flex-wrap justify-center">
                            @if ($datasets->onFirstPage())
                                <button disabled class="w-8 h-8 md:w-9 md:h-9 rounded-lg text-gray-400 cursor-not-allowed flex items-center justify-center">
                                    <i class="bi bi-chevron-left text-sm"></i>
                                </button>
                            @else
                                <a href="{{ $datasets->previousPageUrl() }}" 
                                   class="w-8 h-8 md:w-9 md:h-9 rounded-lg text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors flex items-center justify-center">
                                    <i class="bi bi-chevron-left text-sm"></i>
                                </a>
                            @endif

                            @php
                                $currentPage = $datasets->currentPage();
                                $lastPage = $datasets->lastPage();
                                $start = max(1, $currentPage - 2);
                                $end = min($lastPage, $currentPage + 2);
                            @endphp

                            @if($start > 1)
                                <a href="{{ $datasets->url(1) }}" class="w-8 h-8 md:w-9 md:h-9 rounded-lg text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors flex items-center justify-center text-xs md:text-sm">1</a>
                                @if($start > 2)
                                    <span class="w-8 h-8 md:w-9 md:h-9 flex items-center justify-center text-gray-400 text-xs">...</span>
                                @endif
                            @endif

                            @for ($page = $start; $page <= $end; $page++)
                                @if ($page == $currentPage)
                                    <span class="w-8 h-8 md:w-9 md:h-9 rounded-lg bg-brand-600 text-white font-semibold flex items-center justify-center text-xs md:text-sm">
                                        {{ $page }}
                                    </span>
                                @else
                                    <a href="{{ $datasets->url($page) }}" class="w-8 h-8 md:w-9 md:h-9 rounded-lg text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors flex items-center justify-center text-xs md:text-sm">
                                        {{ $page }}
                                    </a>
                                @endif
                            @endfor

                            @if($end < $lastPage)
                                @if($end < $lastPage - 1)
                                    <span class="w-8 h-8 md:w-9 md:h-9 flex items-center justify-center text-gray-400 text-xs">...</span>
                                @endif
                                <a href="{{ $datasets->url($lastPage) }}" class="w-8 h-8 md:w-9 md:h-9 rounded-lg text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors flex items-center justify-center text-xs md:text-sm">{{ $lastPage }}</a>
                            @endif

                            @if ($datasets->hasMorePages())
                                <a href="{{ $datasets->nextPageUrl() }}" 
                                   class="w-8 h-8 md:w-9 md:h-9 rounded-lg text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors flex items-center justify-center">
                                    <i class="bi bi-chevron-right text-sm"></i>
                                </a>
                            @else
                                <button disabled class="w-8 h-8 md:w-9 md:h-9 rounded-lg text-gray-400 cursor-not-allowed flex items-center justify-center">
                                    <i class="bi bi-chevron-right text-sm"></i>
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
                @endif
                
            </div>
        </div>
    </div>
</div>

<!-- ===== MOBILE FILTER DRAWER ===== -->
<div id="mobileFilterDrawer" class="fixed inset-0 z-[60] hidden lg:hidden">
    <!-- Backdrop -->
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm transition-opacity" onclick="closeMobileFilter()" id="mobileFilterBackdrop"></div>
    
    <!-- Drawer Panel -->
    <div class="mobile-panel absolute right-0 top-0 h-full w-full max-w-sm bg-white dark:bg-gray-900 shadow-2xl translate-x-full flex flex-col" id="mobileFilterPanel">
        <!-- Header -->
        <div class="flex items-center justify-between p-4 border-b border-gray-200 dark:border-gray-700 flex-shrink-0">
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-brand-500 to-sphere-secondary flex items-center justify-center">
                    <i class="bi bi-funnel-fill text-white text-sm"></i>
                </div>
                <span class="font-display font-bold text-lg gradient-text">Filters</span>
            </div>
            <button onclick="closeMobileFilter()" class="w-10 h-10 rounded-full hover:bg-gray-100 dark:hover:bg-gray-800 flex items-center justify-center transition-colors">
                <i class="bi bi-x-lg text-gray-600 dark:text-gray-300 text-xl"></i>
            </button>
        </div>
        
        <!-- Filter Content -->
        <div class="flex-1 overflow-y-auto p-4 space-y-4 custom-scrollbar">
            <form method="GET" action="{{ route('datasets.index') }}" id="mobileFilterForm">
                @include('partials.filter-form', ['isMobile' => true])
            </form>
        </div>
        
        <!-- Footer Actions -->
        <div class="p-4 border-t border-gray-200 dark:border-gray-700 flex-shrink-0 bg-gray-50 dark:bg-gray-800/50 space-y-2">
            <a href="{{ route('datasets.index') }}" class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200 font-semibold text-sm hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors">
                <i class="bi bi-x-circle"></i>
                <span>Clear All Filters</span>
            </a>
            <button type="submit" form="mobileFilterForm" class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-gradient-to-r from-brand-600 to-sphere-secondary text-white font-semibold text-sm shadow-md hover:shadow-lg transition-all">
                <i class="bi bi-funnel"></i>
                <span>Apply Filters</span>
            </button>
        </div>
    </div>
</div>

<!-- Citation Modal -->
<div id="citationModal" class="fixed inset-0 z-[70] hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:p-0">
        <div class="fixed inset-0 bg-gray-900 bg-opacity-60 transition-opacity" onclick="closeCitationModal()"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
        <div class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full">
            <div class="px-4 md:px-6 pt-5 md:pt-6 pb-4">
                <div class="flex items-start justify-between mb-4">
                    <h3 class="text-lg md:text-xl font-bold text-gray-900 dark:text-white">Cite Dataset</h3>
                    <button onclick="closeCitationModal()" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 transition-colors">
                        <i class="bi bi-x-lg text-xl"></i>
                    </button>
                </div>
                
                <div class="space-y-4">
                    <div>
                        <h6 class="text-xs md:text-sm font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-2">BibTeX</h6>
                        <pre class="bg-gray-50 dark:bg-gray-700/50 p-3 md:p-4 rounded-xl text-[10px] md:text-xs text-gray-900 dark:text-gray-100 overflow-auto max-h-48" id="bibtexCode"><code>@dataset{placeholder,
  title = {Dataset Name},
  author = {Dataset Contributors},
  year = {2026},
  url = {https://example.com/dataset},
  note = {Accessed: {{ date('Y-m-d') }}}
}</code></pre>
                        <button id="copyBtn" class="mt-3 inline-flex items-center gap-2 px-3 md:px-4 py-2 rounded-xl bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200 text-xs md:text-sm font-semibold hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors" 
                                onclick="copyCitation()">
                            <i class="bi bi-clipboard"></i><span>Copy BibTeX</span>
                        </button>
                    </div>
                    
                    <div>
                        <h6 class="text-xs md:text-sm font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-2">APA Style</h6>
                        <p class="bg-gray-50 dark:bg-gray-700/50 p-3 md:p-4 rounded-xl text-xs md:text-sm text-gray-900 dark:text-gray-100" id="apaCitation">
                            Dataset Contributors. (2026). <em>Dataset Name</em>. https://example.com/dataset
                        </p>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 dark:bg-gray-700/50 px-4 md:px-6 py-3 md:py-4 flex justify-end">
                <button type="button" class="px-4 md:px-6 py-2 md:py-2.5 rounded-xl bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-200 font-semibold hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors text-sm" onclick="closeCitationModal()">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .custom-scrollbar::-webkit-scrollbar { width: 4px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: rgba(99, 102, 241, 0.3); border-radius: 2px; }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: rgba(99, 102, 241, 0.5); }
    
    .line-clamp-1 { display: -webkit-box; -webkit-line-clamp: 1; -webkit-box-orient: vertical; overflow: hidden; }
    .line-clamp-2 { display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
    
    .toggle-icon { transition: transform 0.3s ease; }
    .toggle-icon.rotated { transform: rotate(180deg); }
    
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .dataset-card { animation: fadeInUp 0.4s ease forwards; }
    
    .mobile-panel { transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
    
    input[type="range"]::-webkit-slider-thumb {
        -webkit-appearance: none;
        appearance: none;
        width: 16px;
        height: 16px;
        border-radius: 50%;
        background: #6366f1;
        cursor: pointer;
        box-shadow: 0 2px 6px rgba(99, 102, 241, 0.4);
    }
    
    input[type="range"]::-moz-range-thumb {
        width: 16px;
        height: 16px;
        border-radius: 50%;
        background: #6366f1;
        cursor: pointer;
        border: none;
        box-shadow: 0 2px 6px rgba(99, 102, 241, 0.4);
    }
</style>
@endpush

@push('scripts')
<script>
// ===== MOBILE FILTER DRAWER =====
function openMobileFilter() {
    const drawer = document.getElementById('mobileFilterDrawer');
    const panel = document.getElementById('mobileFilterPanel');
    const backdrop = document.getElementById('mobileFilterBackdrop');
    
    drawer.classList.remove('hidden');
    requestAnimationFrame(() => {
        panel.classList.remove('translate-x-full');
        backdrop.classList.add('opacity-100');
    });
    document.body.style.overflow = 'hidden';
}

function closeMobileFilter() {
    const drawer = document.getElementById('mobileFilterDrawer');
    const panel = document.getElementById('mobileFilterPanel');
    const backdrop = document.getElementById('mobileFilterBackdrop');
    
    panel.classList.add('translate-x-full');
    backdrop.classList.remove('opacity-100');
    setTimeout(() => {
        drawer.classList.add('hidden');
        document.body.style.overflow = '';
    }, 300);
}

function clearAllFilters() {
    if (confirm('Clear all filters?')) {
        window.location.href = '{{ route("datasets.index") }}';
    }
}

// ===== Range Sliders =====
function updateRangeValue(type, value) {
    const el = document.getElementById(type + 'Value');
    if (el) el.textContent = parseInt(value).toLocaleString();
}

document.addEventListener('DOMContentLoaded', function() {
    ['instances', 'features'].forEach(type => {
        const range = document.getElementById(type + 'Range');
        const display = document.getElementById(type + 'Value');
        if (range && display) {
            display.textContent = parseInt(range.value).toLocaleString();
        }
    });
});

// ===== Toggle Sections =====
function toggleSection(id) {
    const section = document.getElementById(id);
    const icon = document.getElementById(id + '-icon');
    if (!section) return;
    
    section.classList.toggle('hidden');
    if (icon) icon.style.transform = section.classList.contains('hidden') ? 'rotate(0deg)' : 'rotate(180deg)';
}

// ===== Card Toggle (Individual) =====
function toggleCard(datasetId) {
    const details = document.getElementById('details-' + datasetId);
    const icon = document.getElementById('toggle-icon-' + datasetId);
    if (!details) return;
    
    details.classList.toggle('hidden');
    if (icon) icon.classList.toggle('rotated');
    
    updateExpandAllState();
}

// ===== Attach toggle to all buttons =====
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.toggle-detail-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const targetId = this.dataset.target;
            const datasetId = targetId.replace('details-', '');
            toggleCard(datasetId);
        });
    });
});

// ===== Update Expand All button state =====
function updateExpandAllState() {
    const allDetails = document.querySelectorAll('[id^="details-"]');
    const visibleCount = Array.from(allDetails).filter(d => !d.classList.contains('hidden')).length;
    const expandIcon = document.getElementById('expandIcon');
    const expandText = document.getElementById('expandText');
    
    if (expandIcon && expandText) {
        if (visibleCount === allDetails.length && allDetails.length > 0) {
            expandIcon.classList.remove('bi-arrows-expand');
            expandIcon.classList.add('bi-arrows-collapse');
            expandText.textContent = 'Collapse All';
        } else {
            expandIcon.classList.remove('bi-arrows-collapse');
            expandIcon.classList.add('bi-arrows-expand');
            expandText.textContent = 'Expand All';
        }
    }
}

// ===== Expand/Collapse All =====
document.addEventListener('DOMContentLoaded', function() {
    const expandAllBtn = document.getElementById('expandAllBtn');
    if (expandAllBtn) {
        expandAllBtn.addEventListener('click', function() {
            const allDetails = document.querySelectorAll('[id^="details-"]');
            const allIcons = document.querySelectorAll('[id^="toggle-icon-"]');
            const visibleCount = Array.from(allDetails).filter(d => !d.classList.contains('hidden')).length;
            
            const shouldExpand = visibleCount < allDetails.length;
            
            allDetails.forEach(detail => {
                if (shouldExpand) {
                    detail.classList.remove('hidden');
                } else {
                    detail.classList.add('hidden');
                }
            });
            
            allIcons.forEach(icon => {
                if (shouldExpand) {
                    icon.classList.add('rotated');
                } else {
                    icon.classList.remove('rotated');
                }
            });
            
            updateExpandAllState();
        });
    }
});

// ===== View Mode =====
document.addEventListener('DOMContentLoaded', function() {
    const listBtn = document.getElementById('listViewBtn');
    const gridBtn = document.getElementById('gridViewBtn');
    
    if (listBtn) {
        listBtn.addEventListener('click', function() {
            const url = new URL(window.location);
            url.searchParams.set('view', 'list');
            window.location.href = url.toString();
        });
    }
    
    if (gridBtn) {
        gridBtn.addEventListener('click', function() {
            const url = new URL(window.location);
            url.searchParams.set('view', 'grid');
            window.location.href = url.toString();
        });
    }
});

// ===== Sort Dropdown (Desktop) =====
document.addEventListener('DOMContentLoaded', function() {
    const sortBtn = document.getElementById('sortBtn');
    const sortDropdown = document.getElementById('sortDropdown');
    
    if (sortBtn && sortDropdown) {
        sortBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            sortDropdown.classList.toggle('hidden');
        });
        
        document.addEventListener('click', function(e) {
            if (!sortDropdown.contains(e.target) && !sortBtn.contains(e.target)) {
                sortDropdown.classList.add('hidden');
            }
        });
    }
    
    // Mobile Sort Dropdown
    const mobileSortBtn = document.getElementById('mobileSortBtn');
    const mobileSortDropdown = document.getElementById('mobileSortDropdown');
    
    if (mobileSortBtn && mobileSortDropdown) {
        mobileSortBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            mobileSortDropdown.classList.toggle('hidden');
        });
        
        document.addEventListener('click', function(e) {
            if (!mobileSortDropdown.contains(e.target) && !mobileSortBtn.contains(e.target)) {
                mobileSortDropdown.classList.add('hidden');
            }
        });
    }
});

// ===== Live Search Filters =====
function setupLiveSearch(inputId, itemClass) {
    const input = document.getElementById(inputId);
    if (!input) return;
    
    input.addEventListener('input', function() {
        const filter = this.value.toLowerCase();
        document.querySelectorAll('.' + itemClass).forEach(item => {
            const text = item.textContent.toLowerCase();
            item.style.display = text.includes(filter) ? '' : 'none';
        });
    });
}

document.addEventListener('DOMContentLoaded', function() {
    setupLiveSearch('keywordSearch', 'keyword-item');
    setupLiveSearch('subjectSearch', 'subject-item');
    
    // Also setup for mobile versions
    setupLiveSearch('mobileKeywordSearch', 'mobile-keyword-item');
    setupLiveSearch('mobileSubjectSearch', 'mobile-subject-item');
});

// ===== Citation Modal =====
function showCitation(datasetId, datasetName) {
    const modal = document.getElementById('citationModal');
    const year = new Date().getFullYear();
    const url = window.location.origin + '/datasets/' + datasetId;
    
    const bibtex = `@dataset{ds${datasetId},
  title = {${datasetName}},
  author = {Dataset Contributors},
  year = {${year}},
  url = {${url}},
  note = {Accessed: ${new Date().toLocaleDateString()}}
}`;
    
    const apa = `Dataset Contributors. (${year}). ${datasetName}. ${url}`;
    
    document.getElementById('bibtexCode').innerHTML = `<code>${bibtex}</code>`;
    document.getElementById('apaCitation').innerHTML = `Dataset Contributors. (${year}). <em>${datasetName}</em>. ${url}`;
    
    modal.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeCitationModal() {
    const modal = document.getElementById('citationModal');
    modal.classList.add('hidden');
    document.body.style.overflow = '';
}

function copyCitation() {
    const text = document.getElementById('bibtexCode').textContent;
    const btn = document.getElementById('copyBtn');
    
    navigator.clipboard.writeText(text).then(() => {
        const original = btn.innerHTML;
        btn.innerHTML = '<i class="bi bi-check-circle"></i><span>Copied!</span>';
        btn.classList.remove('bg-gray-100', 'dark:bg-gray-700');
        btn.classList.add('bg-green-500', 'text-white');
        setTimeout(() => {
            btn.innerHTML = original;
            btn.classList.remove('bg-green-500', 'text-white');
            btn.classList.add('bg-gray-100', 'dark:bg-gray-700');
        }, 2000);
    });
}

// ===== Python Import =====
function importInPython(datasetId) {
    const code = `# Import dataset ${datasetId}
import pandas as pd
import requests

url = '${window.location.origin}/datasets/${datasetId}/download'
response = requests.get(url)

with open('dataset.csv', 'wb') as f:
    f.write(response.content)

df = pd.read_csv('dataset.csv')
print(f"Loaded {len(df)} rows, {len(df.columns)} columns")
print(df.head())`;
    
    navigator.clipboard.writeText(code).then(() => {
        alert('✓ Python code copied to clipboard!');
    });
}

// ===== Save to Collection =====
function addToCollection(datasetId) {
    fetch(`/datasets/${datasetId}/save`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
        },
        body: JSON.stringify({ action: 'add' })
    })
    .then(r => r.json())
    .then(data => {
        alert(data.success ? '✓ ' + data.message : data.message);
    })
    .catch(() => {
        window.location.href = "{{ route('login') }}?redirect=" + encodeURIComponent(window.location.href);
    });
}

// ===== Close modal on Escape =====
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeCitationModal();
        closeMobileFilter();
    }
});
// ===== Filter List (untuk search keywords/subject area) =====
function filterList(query, itemClass) {
    const filter = query.toLowerCase();
    document.querySelectorAll('.' + itemClass).forEach(item => {
        const text = item.textContent.toLowerCase();
        if (text.includes(filter)) {
            item.style.display = '';
        } else {
            item.style.display = 'none';
        }
    });
}
</script>
@endpush