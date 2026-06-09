@extends('layouts.app')
@section('title', $dataset->display_name ?? $dataset->name)
@section('meta_desc', Str::limit($dataset->abstract ?? $dataset->description, 160))

@section('content')
<div class="relative">
    
    <!-- ===== HERO SECTION ===== -->
    <section class="relative overflow-hidden bg-gradient-to-br from-brand-600 via-sphere-primary to-sphere-secondary text-white">
        <div class="absolute inset-0">
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_20%_80%,rgba(255,255,255,0.1)_0%,transparent_50%)]"></div>
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_80%_20%,rgba(255,255,255,0.08)_0%,transparent_50%)]"></div>
        </div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 lg:py-14">
            <!-- Breadcrumb -->
            <nav class="flex items-center gap-2 text-sm text-white/70 mb-4">
                <a href="{{ route('home') }}" class="hover:text-white transition-colors">Home</a>
                <i class="bi bi-chevron-right text-xs"></i>
                <a href="{{ route('datasets.index') }}" class="hover:text-white transition-colors">Datasets</a>
                <i class="bi bi-chevron-right text-xs"></i>
                <span class="text-white truncate max-w-xs">{{ Str::limit($dataset->display_name ?? $dataset->name, 40) }}</span>
            </nav>
            
            <div class="flex flex-col md:flex-row items-start md:items-center gap-6">
                <!-- Thumbnail -->
                <div class="flex-shrink-0">
                    <div class="w-24 h-24 md:w-28 md:h-28 rounded-2xl overflow-hidden bg-white/10 backdrop-blur-md border-2 border-white/20 flex items-center justify-center shadow-2xl">
                        @if($dataset->thumbnail_url)
                            <img src="{{ $dataset->thumbnail_url }}" alt="{{ $dataset->name }}" class="w-full h-full object-cover">
                        @elseif($dataset->large_image_url)
                            <img src="{{ $dataset->large_image_url }}" alt="{{ $dataset->name }}" class="w-full h-full object-cover">
                        @else
                            <i class="bi bi-database text-5xl text-white/80"></i>
                        @endif
                    </div>
                </div>
                
                <!-- Info -->
                <div class="flex-1 min-w-0">
                    <div class="flex flex-wrap items-center gap-2 mb-2">
                        @if($dataset->data_type)
                        <span class="px-2.5 py-1 rounded-full bg-white/15 backdrop-blur-sm border border-white/20 text-xs font-semibold">
                            {{ $dataset->data_type }}
                        </span>
                        @endif
                        @if($dataset->task_type)
                        <span class="px-2.5 py-1 rounded-full bg-white/15 backdrop-blur-sm border border-white/20 text-xs font-semibold">
                            {{ $dataset->task_type }}
                        </span>
                        @endif
                        @php
                            $statusColors = [
                                'pending' => 'bg-amber-500/20 border-amber-300/30 text-amber-100',
                                'approved' => 'bg-green-500/20 border-green-300/30 text-green-100',
                                'rejected' => 'bg-red-500/20 border-red-300/30 text-red-100',
                                'available' => 'bg-blue-500/20 border-blue-300/30 text-blue-100',
                                'deprecated' => 'bg-gray-500/20 border-gray-300/30 text-gray-100',
                            ][$dataset->status] ?? 'bg-gray-500/20 border-gray-300/30 text-gray-100';
                        @endphp
                        <span class="px-2.5 py-1 rounded-full border text-xs font-semibold {{ $statusColors }}">
                            {{ ucfirst($dataset->status) }}
                        </span>
                    </div>
                    
                    <h1 class="text-2xl md:text-3xl lg:text-4xl font-bold mb-2 leading-tight">
                        {{ $dataset->display_name ?? $dataset->name }}
                    </h1>
                    
                    <div class="flex flex-wrap items-center gap-4 text-sm text-white/80">
                        @if($dataset->donated_date)
                        <span class="flex items-center gap-1.5">
                            <i class="bi bi-calendar"></i>
                            Donated {{ \Carbon\Carbon::parse($dataset->donated_date)->format('M d, Y') }}
                        </span>
                        @endif
                        @if($dataset->subject_area)
                        <span class="flex items-center gap-1.5">
                            <i class="bi bi-folder"></i>
                            {{ $dataset->subject_area }}
                        </span>
                        @endif
                        @if($dataset->license)
                        <span class="flex items-center gap-1.5">
                            <i class="bi bi-shield-check"></i>
                            {{ $dataset->license->license_name }}
                        </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== MAIN CONTENT ===== -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid lg:grid-cols-[1fr_320px] gap-6">
            
            <!-- ===== LEFT: MAIN CONTENT ===== -->
            <div class="space-y-6 min-w-0">
                
                <!-- Abstract -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-6">
                    <div class="flex items-center gap-2 mb-3">
                        <div class="w-8 h-8 rounded-lg bg-brand-50 dark:bg-brand-900/30 flex items-center justify-center">
                            <i class="bi bi-file-text text-brand-600 dark:text-brand-400"></i>
                        </div>
                        <h2 class="text-lg font-bold text-gray-900 dark:text-white">Abstract</h2>
                    </div>
                    <p class="text-gray-700 dark:text-gray-300 leading-relaxed">
                        {{ $dataset->abstract ?? $dataset->description ?? 'No description available.' }}
                    </p>
                    @if($dataset->summary)
                    <div class="mt-4 pt-4 border-t border-gray-100 dark:border-gray-700">
                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            <span class="font-semibold text-gray-900 dark:text-white">Summary:</span>
                            {{ $dataset->summary }}
                        </p>
                    </div>
                    @endif
                </div>

                <!-- Characteristics Grid -->
                <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                    @php
                        $characteristics = [
                            ['label' => 'Instances', 'value' => $dataset->num_instances, 'icon' => 'bi-table', 'color' => 'brand'],
                            ['label' => 'Features', 'value' => $dataset->num_features, 'icon' => 'bi-grid-3x3-gap', 'color' => 'green'],
                            ['label' => 'Classes', 'value' => $dataset->num_classes, 'icon' => 'bi-diagram-3', 'color' => 'purple'],
                            ['label' => 'Domain', 'value' => $dataset->domain, 'icon' => 'bi-globe', 'color' => 'cyan', 'isText' => true],
                            ['label' => 'Data Type', 'value' => $dataset->data_type, 'icon' => 'bi-layers', 'color' => 'amber', 'isText' => true],
                            ['label' => 'Missing Values', 'value' => $dataset->has_missing_values ? 'Yes' : 'No', 'icon' => 'bi-question-circle', 'color' => $dataset->has_missing_values ? 'red' : 'green', 'isText' => true],
                        ];
                    @endphp
                    @foreach($characteristics as $char)
                        @if($char['value'] !== null && $char['value'] !== '')
                        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-4 hover:shadow-md hover:-translate-y-0.5 transition-all">
                            <div class="flex items-center gap-2 mb-2">
                                <div class="w-8 h-8 rounded-lg bg-{{ $char['color'] }}-50 dark:bg-{{ $char['color'] }}-900/30 flex items-center justify-center">
                                    <i class="bi {{ $char['icon'] }} text-{{ $char['color'] }}-600 dark:text-{{ $char['color'] }}-400"></i>
                                </div>
                                <span class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">{{ $char['label'] }}</span>
                            </div>
                            <div class="text-xl font-bold text-gray-900 dark:text-white">
                                @if(isset($char['isText']))
                                    {{ $char['value'] }}
                                @else
                                    {{ number_format($char['value']) }}
                                @endif
                            </div>
                        </div>
                        @endif
                    @endforeach
                </div>

                <!-- Collapsible: Dataset Information -->
                @if($dataset->descriptionDetails)
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
                    <button type="button" onclick="toggleSection('datasetInfoSection')" class="w-full p-5 flex items-center justify-between hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-brand-50 dark:bg-brand-900/30 flex items-center justify-center">
                                <i class="bi bi-info-circle text-xl text-brand-600 dark:text-brand-400"></i>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white">Dataset Information</h3>
                        </div>
                        <i class="bi bi-chevron-down text-gray-400 transition-transform" id="datasetInfoSection-icon"></i>
                    </button>
                    <div id="datasetInfoSection" class="px-5 pb-5 space-y-4">
                        @php
                            $infoFields = [
                                ['label' => 'What do the instances represent?', 'value' => $dataset->descriptionDetails->instances_represent],
                                ['label' => 'Purpose', 'value' => $dataset->descriptionDetails->purpose],
                                ['label' => 'Funding', 'value' => $dataset->descriptionDetails->funding],
                                ['label' => 'Recommended Data Splits', 'value' => $dataset->descriptionDetails->data_splits],
                                ['label' => 'Sensitive Data', 'value' => $dataset->descriptionDetails->sensitive_data],
                                ['label' => 'Additional Information', 'value' => $dataset->descriptionDetails->additional_info],
                            ];
                        @endphp
                        @foreach($infoFields as $field)
                            @if($field['value'])
                            <div class="p-4 rounded-xl bg-gray-50 dark:bg-gray-700/30 border border-gray-100 dark:border-gray-700">
                                <h4 class="text-sm font-semibold text-gray-900 dark:text-white mb-1">{{ $field['label'] }}</h4>
                                <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">{{ $field['value'] }}</p>
                            </div>
                            @endif
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Collapsible: Variables Table -->
                @if($dataset->variables->isNotEmpty())
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
                    <button type="button" onclick="toggleSection('variablesSection')" class="w-full p-5 flex items-center justify-between hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-purple-50 dark:bg-purple-900/30 flex items-center justify-center">
                                <i class="bi bi-list-columns text-xl text-purple-600 dark:text-purple-400"></i>
                            </div>
                            <div class="text-left">
                                <h3 class="text-lg font-bold text-gray-900 dark:text-white">Variables</h3>
                                <p class="text-xs text-gray-500 dark:text-gray-400">{{ $dataset->variables->count() }} variables total</p>
                            </div>
                        </div>
                        <i class="bi bi-chevron-down text-gray-400 transition-transform" id="variablesSection-icon"></i>
                    </button>
                    <div id="variablesSection" class="px-5 pb-5">
                        <div class="overflow-x-auto rounded-xl border border-gray-100 dark:border-gray-700">
                            <table class="w-full text-sm">
                                <thead class="bg-gray-50 dark:bg-gray-700/50">
                                    <tr>
                                        <th class="px-4 py-3 text-left text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Name</th>
                                        <th class="px-4 py-3 text-left text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Role</th>
                                        <th class="px-4 py-3 text-left text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Type</th>
                                        <th class="px-4 py-3 text-left text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Description</th>
                                        <th class="px-4 py-3 text-left text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Missing</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                                    @foreach($dataset->variables as $var)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors">
                                        <td class="px-4 py-3 font-semibold text-gray-900 dark:text-white">{{ $var->display_name ?? $var->variable_name }}</td>
                                        <td class="px-4 py-3">
                                            @php
                                                $roleColors = [
                                                    'feature' => 'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400',
                                                    'target' => 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400',
                                                    'id' => 'bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-300',
                                                ][$var->role] ?? 'bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-300';
                                            @endphp
                                            <span class="px-2 py-0.5 rounded-full text-xs font-semibold {{ $roleColors }}">{{ ucfirst($var->role) }}</span>
                                        </td>
                                        <td class="px-4 py-3 text-gray-600 dark:text-gray-400">{{ $var->variable_type }}</td>
                                        <td class="px-4 py-3 text-gray-600 dark:text-gray-400 max-w-xs truncate">{{ $var->description ?? '-' }}</td>
                                        <td class="px-4 py-3">
                                            @if($var->missing_count > 0)
                                                <span class="text-red-600 dark:text-red-400 font-semibold">{{ $var->missing_count }}</span>
                                            @else
                                                <span class="text-green-600 dark:text-green-400">No</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @if($var->variable_type === 'Categorical' && $var->categories->isNotEmpty())
                                    <tr class="bg-gray-50 dark:bg-gray-700/20">
                                        <td colspan="5" class="px-4 py-2">
                                            <div class="flex flex-wrap gap-1">
                                                <span class="text-xs text-gray-500 dark:text-gray-400 mr-2">Categories:</span>
                                                @foreach($var->categories as $cat)
                                                <span class="px-2 py-0.5 rounded bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 text-xs text-gray-700 dark:text-gray-300">
                                                    {{ $cat->category_label ?? $cat->category_value }}
                                                </span>
                                                @endforeach
                                            </div>
                                        </td>
                                    </tr>
                                    @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Collapsible: Introductory Paper -->
                @php
                    $introductoryPapers = $dataset->papers->where('pivot.citation_type', 'introductory')->take(1);
                @endphp
                @if($introductoryPapers->isNotEmpty())
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
                    <button type="button" onclick="toggleSection('paperSection')" class="w-full p-5 flex items-center justify-between hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-amber-50 dark:bg-amber-900/30 flex items-center justify-center">
                                <i class="bi bi-journal-text text-xl text-amber-600 dark:text-amber-400"></i>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white">Introductory Paper</h3>
                        </div>
                        <i class="bi bi-chevron-down text-gray-400 transition-transform" id="paperSection-icon"></i>
                    </button>
                    <div id="paperSection" class="px-5 pb-5">
                        @foreach($introductoryPapers as $paper)
                        <div class="p-4 rounded-xl bg-gray-50 dark:bg-gray-700/30 border border-gray-100 dark:border-gray-700">
                            @if($paper->url)
                            <a href="{{ $paper->url }}" target="_blank" class="font-semibold text-gray-900 dark:text-white hover:text-brand-600 dark:hover:text-brand-400 transition-colors">
                                {{ $paper->title }}
                            </a>
                            @else
                            <h4 class="font-semibold text-gray-900 dark:text-white">{{ $paper->title }}</h4>
                            @endif
                            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">By {{ $paper->authors }}</p>
                            <p class="text-xs text-gray-500 dark:text-gray-500 mt-1">
                                Published in {{ $paper->venue ?? 'N/A' }}, {{ $paper->publication_year }}
                            </p>
                            @if($paper->abstract)
                            <p class="text-sm text-gray-600 dark:text-gray-400 mt-3 leading-relaxed">{{ Str::limit($paper->abstract, 300) }}</p>
                            @endif
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Collapsible: Dataset Files -->
                @if($dataset->files->isNotEmpty())
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
                    <button type="button" onclick="toggleSection('filesSection')" class="w-full p-5 flex items-center justify-between hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-green-50 dark:bg-green-900/30 flex items-center justify-center">
                                <i class="bi bi-files text-xl text-green-600 dark:text-green-400"></i>
                            </div>
                            <div class="text-left">
                                <h3 class="text-lg font-bold text-gray-900 dark:text-white">Dataset Files</h3>
                                <p class="text-xs text-gray-500 dark:text-gray-400">{{ $dataset->files->count() }} files available</p>
                            </div>
                        </div>
                        <i class="bi bi-chevron-down text-gray-400 transition-transform" id="filesSection-icon"></i>
                    </button>
                    <div id="filesSection" class="px-5 pb-5">
                        <div class="space-y-2">
                            @foreach($dataset->files as $file)
                            <div class="flex items-center justify-between p-3 rounded-xl bg-gray-50 dark:bg-gray-700/30 border border-gray-100 dark:border-gray-700 hover:border-brand-300 dark:hover:border-brand-700 transition-colors">
                                <div class="flex items-center gap-3 min-w-0">
                                    <div class="w-10 h-10 rounded-lg bg-brand-50 dark:bg-brand-900/30 flex items-center justify-center flex-shrink-0">
                                        <i class="bi bi-file-earmark-text text-brand-600 dark:text-brand-400"></i>
                                    </div>
                                    <div class="min-w-0">
                                        <p class="font-semibold text-sm text-gray-900 dark:text-white truncate">{{ $file->original_filename ?? $file->filename }}</p>
                                        <div class="flex items-center gap-2 mt-0.5">
                                            <span class="px-1.5 py-0.5 rounded bg-gray-200 dark:bg-gray-600 text-xs font-semibold text-gray-700 dark:text-gray-300">{{ strtoupper($file->file_format) }}</span>
                                            <span class="text-xs text-gray-500 dark:text-gray-400">
                                                {{ $file->file_size_bytes ? number_format($file->file_size_bytes / 1024, 2) . ' KB' : 'N/A' }}
                                            </span>
                                            <span class="text-xs text-gray-500 dark:text-gray-400">• {{ ucfirst($file->pivot->file_role ?? 'data') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <a href="{{ asset('storage/' . $file->file_path) }}" 
                                   class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg bg-brand-50 dark:bg-brand-900/30 text-brand-600 dark:text-brand-400 text-xs font-semibold hover:bg-brand-100 dark:hover:bg-brand-900/50 transition-colors flex-shrink-0 ml-2"
                                   download>
                                    <i class="bi bi-download"></i>
                                    <span class="hidden sm:inline">Download</span>
                                </a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif

                <!-- Papers Citing this Dataset -->
                @php
                    $citingPapers = $dataset->papers->where(function($paper) {
                        return $paper->pivot->citation_type === 'citing' || $paper->pivot->citation_type === null;
                    })->sortByDesc('publication_year');
                    $papersPerPage = request('per_page', 5);
                    $currentPage = request('page', 1);
                    $totalPapers = $citingPapers->count();
                    $startIndex = ($currentPage - 1) * $papersPerPage;
                    $endIndex = min($startIndex + $papersPerPage, $totalPapers);
                    $paginatedPapers = $citingPapers->slice($startIndex, $papersPerPage);
                    $totalPages = ceil($totalPapers / $papersPerPage);
                @endphp
                
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
                    <div class="p-5 border-b border-gray-100 dark:border-gray-700 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-cyan-50 dark:bg-cyan-900/30 flex items-center justify-center">
                                <i class="bi bi-journal-arrow-up text-xl text-cyan-600 dark:text-cyan-400"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-gray-900 dark:text-white">Papers Citing this Dataset</h3>
                                <p class="text-xs text-gray-500 dark:text-gray-400">{{ $totalPapers }} papers found</p>
                            </div>
                        </div>
                        <select id="sortByYear" onchange="sortPapers()" class="px-3 py-1.5 rounded-lg bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 text-sm text-gray-700 dark:text-gray-200 focus:outline-none focus:border-brand-500">
                            <option value="year_desc" {{ request('sort') === 'year_desc' || !request('sort') ? 'selected' : '' }}>Year (Newest)</option>
                            <option value="year_asc" {{ request('sort') === 'year_asc' ? 'selected' : '' }}>Year (Oldest)</option>
                            <option value="title_asc" {{ request('sort') === 'title_asc' ? 'selected' : '' }}>Title (A-Z)</option>
                            <option value="title_desc" {{ request('sort') === 'title_desc' ? 'selected' : '' }}>Title (Z-A)</option>
                        </select>
                    </div>
                    
                    <div class="p-5">
                        @if($paginatedPapers->isNotEmpty())
                        <div class="space-y-3">
                            @foreach($paginatedPapers as $paper)
                            <div class="p-4 rounded-xl bg-gray-50 dark:bg-gray-700/30 border border-gray-100 dark:border-gray-700 hover:border-brand-300 dark:hover:border-brand-700 transition-colors">
                                @if($paper->url)
                                <a href="{{ $paper->url }}" target="_blank" class="font-semibold text-gray-900 dark:text-white hover:text-brand-600 dark:hover:text-brand-400 transition-colors">
                                    {{ $paper->title }}
                                </a>
                                @else
                                <h4 class="font-semibold text-gray-900 dark:text-white">{{ $paper->title }}</h4>
                                @endif
                                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">By {{ $paper->authors }}</p>
                                <div class="flex flex-wrap items-center gap-3 mt-2 text-xs text-gray-500 dark:text-gray-400">
                                    <span><i class="bi bi-journal me-1"></i>{{ $paper->venue ?? 'ArXiv' }}</span>
                                    <span><i class="bi bi-calendar me-1"></i>{{ $paper->publication_year }}</span>
                                    @if($paper->doi)
                                    <span class="text-brand-600 dark:text-brand-400"><i class="bi bi-upc-scan me-1"></i>{{ $paper->doi }}</span>
                                    @endif
                                </div>
                                @if($paper->abstract)
                                <p class="text-sm text-gray-600 dark:text-gray-400 mt-2 leading-relaxed">{{ Str::limit($paper->abstract, 200) }}</p>
                                @endif
                            </div>
                            @endforeach
                        </div>
                        
                        <!-- Pagination -->
                        @if($totalPages > 1 || $totalPapers > 5)
                        <div class="mt-5 pt-5 border-t border-gray-100 dark:border-gray-700 flex flex-col sm:flex-row items-center justify-between gap-3">
                            <div class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-400">
                                <span>Rows per page:</span>
                                <select onchange="changePageSize(this.value)" class="px-2 py-1 rounded-lg bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 text-sm text-gray-700 dark:text-gray-200 focus:outline-none focus:border-brand-500">
                                    <option value="5" {{ $papersPerPage == 5 ? 'selected' : '' }}>5</option>
                                    <option value="10" {{ $papersPerPage == 10 ? 'selected' : '' }}>10</option>
                                    <option value="20" {{ $papersPerPage == 20 ? 'selected' : '' }}>20</option>
                                    <option value="50" {{ $papersPerPage == 50 ? 'selected' : '' }}>50</option>
                                </select>
                                <span class="ml-2">{{ $totalPapers > 0 ? $startIndex + 1 : 0 }}-{{ $endIndex }} of {{ $totalPapers }}</span>
                            </div>
                            
                            @if($totalPages > 1)
                            <nav class="flex items-center gap-1">
                                @if($currentPage > 1)
                                <a href="?page={{ $currentPage - 1 }}&per_page={{ $papersPerPage }}&sort={{ request('sort', 'year_desc') }}" 
                                   class="w-8 h-8 rounded-lg flex items-center justify-center text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                                    <i class="bi bi-chevron-left"></i>
                                </a>
                                @endif
                                
                                @for($i = 1; $i <= $totalPages; $i++)
                                    @if($i == 1 || $i == $totalPages || ($i >= $currentPage - 1 && $i <= $currentPage + 1))
                                        <a href="?page={{ $i }}&per_page={{ $papersPerPage }}&sort={{ request('sort', 'year_desc') }}" 
                                           class="w-8 h-8 rounded-lg flex items-center justify-center text-sm font-semibold transition-colors {{ $i == $currentPage ? 'bg-brand-600 text-white' : 'text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                                            {{ $i }}
                                        </a>
                                    @elseif($i == $currentPage - 2 || $i == $currentPage + 2)
                                        <span class="w-8 h-8 flex items-center justify-center text-gray-400">…</span>
                                    @endif
                                @endfor
                                
                                @if($currentPage < $totalPages)
                                <a href="?page={{ $currentPage + 1 }}&per_page={{ $papersPerPage }}&sort={{ request('sort', 'year_desc') }}" 
                                   class="w-8 h-8 rounded-lg flex items-center justify-center text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                                    <i class="bi bi-chevron-right"></i>
                                </a>
                                @endif
                            </nav>
                            @endif
                        </div>
                        @endif
                        @else
                        <div class="text-center py-8">
                            <div class="w-16 h-16 mx-auto mb-3 rounded-full bg-gray-100 dark:bg-gray-700 flex items-center justify-center">
                                <i class="bi bi-journal-x text-3xl text-gray-400"></i>
                            </div>
                            <p class="text-gray-500 dark:text-gray-400">No papers citing this dataset yet.</p>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Related Papers -->
                @php
                    $relatedPapers = $dataset->papers->where('pivot.citation_type', 'related');
                @endphp
                @if($relatedPapers->isNotEmpty())
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
                    <div class="p-5 border-b border-gray-100 dark:border-gray-700 flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-indigo-50 dark:bg-indigo-900/30 flex items-center justify-center">
                            <i class="bi bi-link-45deg text-xl text-indigo-600 dark:text-indigo-400"></i>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white">Related Papers</h3>
                    </div>
                    <div class="p-5 space-y-2">
                        @foreach($relatedPapers->take(3) as $paper)
                        <div class="p-3 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors">
                            <h4 class="font-semibold text-gray-900 dark:text-white text-sm">{{ $paper->title }}</h4>
                            <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">By {{ $paper->authors }}</p>
                            <p class="text-xs text-gray-500 dark:text-gray-500 mt-0.5">{{ $paper->venue ?? 'N/A' }}, {{ $paper->publication_year }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Reviews -->
                @if($dataset->reviews->isNotEmpty())
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
                    <div class="p-5 border-b border-gray-100 dark:border-gray-700 flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-yellow-50 dark:bg-yellow-900/30 flex items-center justify-center">
                            <i class="bi bi-chat-quote text-xl text-yellow-600 dark:text-yellow-400"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white">User Reviews</h3>
                            <p class="text-xs text-gray-500 dark:text-gray-400">{{ $dataset->reviews->count() }} reviews</p>
                        </div>
                    </div>
                    <div class="p-5 space-y-4">
                        @foreach($dataset->reviews->take(5) as $review)
                        <div class="pb-4 border-b border-gray-100 dark:border-gray-700 last:border-0 last:pb-0">
                            <div class="flex items-start justify-between gap-3 mb-2">
                                <h4 class="font-semibold text-gray-900 dark:text-white">{{ $review->title ?? 'Untitled Review' }}</h4>
                                <div class="flex items-center gap-1 text-yellow-500 flex-shrink-0">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="bi bi-star{{ $i <= $review->rating ? '-fill' : '' }}"></i>
                                    @endfor
                                    <span class="text-xs text-gray-500 dark:text-gray-400 ml-1">({{ number_format($review->rating, 1) }})</span>
                                </div>
                            </div>
                            <p class="text-sm text-gray-700 dark:text-gray-300 mb-2">{{ $review->content }}</p>
                            @if($review->pros)
                            <p class="text-xs text-green-600 dark:text-green-400 mb-1"><i class="bi bi-plus-circle me-1"></i><strong>Pros:</strong> {{ $review->pros }}</p>
                            @endif
                            @if($review->cons)
                            <p class="text-xs text-red-600 dark:text-red-400 mb-2"><i class="bi bi-dash-circle me-1"></i><strong>Cons:</strong> {{ $review->cons }}</p>
                            @endif
                            <div class="flex items-center gap-2 text-xs text-gray-500 dark:text-gray-400">
                                <i class="bi bi-person-circle"></i>
                                <span>{{ $review->user->name ?? 'Anonymous' }}</span>
                                <span>•</span>
                                <span>{{ $review->created_at->format('M d, Y') }}</span>
                                @if($review->is_verified)
                                <span class="px-2 py-0.5 rounded-full bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400 text-xs font-semibold">Verified</span>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

            </div>

            <!-- ===== RIGHT: SIDEBAR ===== -->
            <aside class="space-y-4 lg:sticky lg:top-24 lg:self-start">
                
                <!-- Action Buttons -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-5">
                    @php
                        $defaultFile = $dataset->files->where('pivot.is_default', 1)->first() ?? $dataset->files->first();
                    @endphp
                    @if($defaultFile)
                    <a href="{{ asset('storage/' . $defaultFile->file_path) }}" 
                       class="w-full inline-flex items-center justify-center gap-2 px-4 py-3 rounded-xl bg-gradient-to-r from-brand-600 to-sphere-secondary text-white font-semibold shadow-md hover:shadow-lg hover:-translate-y-0.5 transition-all mb-3"
                       download>
                        <i class="bi bi-download"></i>
                        <span>Download Dataset</span>
                    </a>
                    @endif
                    
                    <div class="grid grid-cols-2 gap-2 mb-4">
                        <button onclick="importInPython()" class="inline-flex items-center justify-center gap-1 px-3 py-2 rounded-xl bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200 text-sm font-semibold hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors">
                            <i class="bi bi-code-slash"></i>
                            <span>Python</span>
                        </button>
                        <button onclick="showCitation()" class="inline-flex items-center justify-center gap-1 px-3 py-2 rounded-xl bg-amber-50 dark:bg-amber-900/30 text-amber-600 dark:text-amber-400 text-sm font-semibold hover:bg-amber-100 dark:hover:bg-amber-900/50 transition-colors">
                            <i class="bi bi-quote"></i>
                            <span>Cite</span>
                        </button>
                    </div>
                    
                    <div class="pt-4 border-t border-gray-100 dark:border-gray-700 space-y-2">
                        <div class="flex items-center justify-between text-sm">
                            <span class="flex items-center gap-2 text-gray-600 dark:text-gray-400"><i class="bi bi-chat-quote"></i>Citations</span>
                            <span class="font-bold text-gray-900 dark:text-white">{{ number_format($dataset->citation_count ?? 0) }}</span>
                        </div>
                        <div class="flex items-center justify-between text-sm" data-view-count>
                            <span class="flex items-center gap-2 text-gray-600 dark:text-gray-400"><i class="bi bi-eye"></i>Views</span>
                            <span class="font-bold text-gray-900 dark:text-white">{{ number_format($dataset->view_count ?? 0) }}</span>
                        </div>
                        <div class="flex items-center justify-between text-sm">
                            <span class="flex items-center gap-2 text-gray-600 dark:text-gray-400"><i class="bi bi-cloud-download"></i>Downloads</span>
                            <span class="font-bold text-gray-900 dark:text-white">{{ number_format($dataset->download_count ?? 0) }}</span>
                        </div>
                    </div>
                </div>

                <!-- Keywords -->
                @if($dataset->keywords->isNotEmpty())
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-5">
                    <h3 class="text-sm font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-3 flex items-center gap-2">
                        <i class="bi bi-tags"></i>Keywords
                    </h3>
                    <div class="flex flex-wrap gap-1.5">
                        @foreach($dataset->keywords as $keyword)
                        <a href="{{ route('datasets.index', ['keyword' => $keyword->slug]) }}" 
                           class="px-2.5 py-1 rounded-lg bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 text-xs font-medium hover:bg-brand-100 dark:hover:bg-brand-900/30 hover:text-brand-600 dark:hover:text-brand-400 transition-colors">
                            {{ $keyword->keyword_name }}
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Creators -->
                @php
                    $creators = $dataset->contributors->where('pivot.contribution_role', 'creator');
                    $otherContributors = $dataset->contributors->whereNotIn('pivot.contribution_role', ['creator']);
                @endphp
                @if($creators->isNotEmpty())
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-5">
                    <h3 class="text-sm font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-3 flex items-center gap-2">
                        <i class="bi bi-person-badge"></i>Creators
                    </h3>
                    <div class="space-y-3">
                        @foreach($creators as $creator)
                        <div class="flex items-start gap-2">
                            <div class="w-8 h-8 rounded-full bg-gradient-to-br from-brand-500 to-sphere-secondary flex items-center justify-center text-white text-xs font-bold flex-shrink-0">
                                {{ strtoupper(substr($creator->name, 0, 1)) }}
                            </div>
                            <div class="min-w-0 flex-1">
                                <p class="font-semibold text-sm text-gray-900 dark:text-white truncate">{{ $creator->name }}</p>
                                @if($creator->affiliation)
                                <p class="text-xs text-gray-500 dark:text-gray-400 truncate">{{ $creator->affiliation }}</p>
                                @endif
                                @if($creator->orcid)
                                <a href="https://orcid.org/{{ $creator->orcid }}" target="_blank" class="text-xs text-brand-600 dark:text-brand-400 hover:underline">
                                    <i class="bi bi-orcid"></i> ORCID
                                </a>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                @if($otherContributors->isNotEmpty())
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-5">
                    <h3 class="text-sm font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-3 flex items-center gap-2">
                        <i class="bi bi-people"></i>Contributors
                    </h3>
                    <div class="space-y-2">
                        @foreach($otherContributors as $contributor)
                        <div class="flex items-center gap-2">
                            <div class="w-7 h-7 rounded-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center text-gray-600 dark:text-gray-300 text-xs font-bold flex-shrink-0">
                                {{ strtoupper(substr($contributor->name, 0, 1)) }}
                            </div>
                            <div class="min-w-0 flex-1">
                                <p class="font-medium text-sm text-gray-900 dark:text-white truncate">{{ $contributor->name }}</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">{{ ucfirst($contributor->pivot->contribution_role) }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- DOI -->
                @if($dataset->doi)
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-5">
                    <h3 class="text-sm font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-3 flex items-center gap-2">
                        <i class="bi bi-upc-scan"></i>DOI
                    </h3>
                    <a href="{{ $dataset->doi->resolution_url ?? 'https://doi.org/' . $dataset->doi->doi_string }}" 
                       target="_blank" 
                       class="text-sm text-brand-600 dark:text-brand-400 hover:underline break-all">
                        {{ $dataset->doi->doi_string }}
                    </a>
                </div>
                @endif

                <!-- Dataset Details -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-5">
                    <h3 class="text-sm font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-3 flex items-center gap-2">
                        <i class="bi bi-info-circle"></i>Details
                    </h3>
                    <div class="space-y-2.5 text-sm">
                        @if($dataset->uci_id)
                        <div class="flex justify-between gap-2">
                            <span class="text-gray-500 dark:text-gray-400 flex-shrink-0">UCI ID</span>
                            <span class="font-semibold text-gray-900 dark:text-white text-right truncate">{{ $dataset->uci_id }}</span>
                        </div>
                        @endif
                        <div class="flex justify-between gap-2">
                            <span class="text-gray-500 dark:text-gray-400 flex-shrink-0">Added</span>
                            <span class="font-semibold text-gray-900 dark:text-white text-right">{{ $dataset->created_at->format('M d, Y') }}</span>
                        </div>
                        <div class="flex justify-between gap-2">
                            <span class="text-gray-500 dark:text-gray-400 flex-shrink-0">Updated</span>
                            <span class="font-semibold text-gray-900 dark:text-white text-right">{{ $dataset->updated_at->format('M d, Y') }}</span>
                        </div>
                        @if($dataset->approved_at)
                        <div class="flex justify-between gap-2">
                            <span class="text-gray-500 dark:text-gray-400 flex-shrink-0">Approved</span>
                            <span class="font-semibold text-gray-900 dark:text-white text-right">{{ $dataset->approved_at->format('M d, Y') }}</span>
                        </div>
                        @endif
                        @if($dataset->dataset_url)
                        <div class="pt-2 border-t border-gray-100 dark:border-gray-700">
                            <a href="{{ $dataset->dataset_url }}" target="_blank" class="inline-flex items-center gap-1 text-xs text-brand-600 dark:text-brand-400 hover:underline">
                                <i class="bi bi-box-arrow-up-right"></i>View Original Source
                            </a>
                        </div>
                        @endif
                    </div>
                </div>

            </aside>
        </div>
    </div>
</div>

<!-- Citation Modal -->
<div id="citationModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:p-0">
        <div class="fixed inset-0 bg-gray-900 bg-opacity-60 transition-opacity" onclick="closeCitationModal()"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
        <div class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full">
            <div class="px-6 pt-6 pb-4">
                <div class="flex items-start justify-between mb-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-amber-50 dark:bg-amber-900/30 flex items-center justify-center">
                            <i class="bi bi-quote text-xl text-amber-600 dark:text-amber-400"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white">Cite this Dataset</h3>
                    </div>
                    <button onclick="closeCitationModal()" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 transition-colors">
                        <i class="bi bi-x-lg text-xl"></i>
                    </button>
                </div>
                
                <div class="space-y-4">
                    <div>
                        <h6 class="text-sm font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-2">BibTeX</h6>
                        <pre class="bg-gray-50 dark:bg-gray-700/50 p-4 rounded-xl text-xs text-gray-900 dark:text-gray-100 overflow-auto max-h-48" id="bibtexCode"><code>@dataset{{ $dataset->dataset_id }},
  title = { {{ $dataset->name }} },
@if($dataset->user)  author = { {{ $dataset->user->name }} },
@endif  year = { {{ $dataset->created_at->year }} },
@if($dataset->doi)  doi = { {{ $dataset->doi->doi_string }} },
@endif  url = { {{ route('datasets.show', $dataset) }} }
}</code></pre>
                        <button id="copyBtn" class="mt-3 inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200 text-sm font-semibold hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors" 
                                onclick="copyCitation()">
                            <i class="bi bi-clipboard"></i><span>Copy BibTeX</span>
                        </button>
                    </div>
                    
                    <div>
                        <h6 class="text-sm font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-2">APA Style</h6>
                        <p class="bg-gray-50 dark:bg-gray-700/50 p-4 rounded-xl text-sm text-gray-900 dark:text-gray-100" id="apaCitation">
                            @if($dataset->user){{ $dataset->user->name }}@else{{ $dataset->name }}@endif. 
                            ({{ $dataset->created_at->year }}). 
                            <em>{{ $dataset->name }}</em>. 
                            @if($dataset->doi)https://doi.org/{{ $dataset->doi->doi_string }}@endif
                        </p>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 dark:bg-gray-700/50 px-6 py-4 flex justify-end">
                <button type="button" class="px-6 py-2.5 rounded-xl bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-200 font-semibold hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors" onclick="closeCitationModal()">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    pre code {
        white-space: pre-wrap;
        word-break: break-word;
    }
</style>
@endpush

@push('scripts')
<script>
// ===== Toggle Collapsible Sections =====
function toggleSection(id) {
    const section = document.getElementById(id);
    const icon = document.getElementById(id + '-icon');
    if (!section) return;
    
    section.classList.toggle('hidden');
    if (icon) icon.style.transform = section.classList.contains('hidden') ? 'rotate(0deg)' : 'rotate(180deg)';
}

// ===== Citation Modal =====
function showCitation() {
    document.getElementById('citationModal').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeCitationModal() {
    document.getElementById('citationModal').classList.add('hidden');
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
function importInPython() {
    @php $defaultFile = $dataset->files->where('pivot.is_default', 1)->first() ?? $dataset->files->first(); @endphp
    const code = `# Import the dataset
import pandas as pd

# Load the dataset
df = pd.read_csv('{{ asset('storage/' . ($defaultFile->file_path ?? '')) }}')

# Display basic information
print(df.info())
print(df.describe())`;
    
    navigator.clipboard.writeText(code).then(() => {
        const notif = document.createElement('div');
        notif.className = 'fixed top-20 right-4 z-50 bg-green-500 text-white px-4 py-3 rounded-xl shadow-lg flex items-center gap-2';
        notif.innerHTML = '<i class="bi bi-check-circle"></i><span>Python code copied!</span>';
        document.body.appendChild(notif);
        setTimeout(() => notif.remove(), 2000);
    });
}

// ===== Sort Papers =====
function sortPapers() {
    const sortBy = document.getElementById('sortByYear').value;
    const urlParams = new URLSearchParams(window.location.search);
    urlParams.set('sort', sortBy);
    urlParams.set('page', '1');
    window.location.search = urlParams.toString();
}

// ===== Change Page Size =====
function changePageSize(size) {
    const urlParams = new URLSearchParams(window.location.search);
    urlParams.set('per_page', size);
    urlParams.set('page', '1');
    window.location.search = urlParams.toString();
}

// ===== Track View =====
document.addEventListener('DOMContentLoaded', function() {
    const datasetId = {{ $dataset->dataset_id }};
    const trackUrl = "{{ route('datasets.track-view', $dataset) }}";
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content 
        || document.querySelector('[name="_token"]')?.value;
    
    if (trackUrl && csrfToken) {
        fetch(trackUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            },
            body: JSON.stringify({})
        })
        .then(response => response.json())
        .then(data => {
            const viewCountEl = document.querySelector('[data-view-count] span:last-child');
            if (viewCountEl && data.views) {
                viewCountEl.textContent = new Intl.NumberFormat().format(data.views);
            }
        })
        .catch(err => console.warn('Tracking error:', err));
    }
});

// ===== Close modal on Escape =====
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeCitationModal();
    }
});
</script>
@endpush