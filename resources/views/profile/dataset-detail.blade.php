@extends('layouts.app')
@section('title', $dataset->name)
@section('meta_desc', Str::limit($dataset->description ?? $dataset->abstract, 160))

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
                <a href="{{ route('profile.datasets') }}" class="hover:text-white transition-colors">My Datasets</a>
                <i class="bi bi-chevron-right text-xs"></i>
                <span class="text-white truncate max-w-xs">{{ Str::limit($dataset->name, 40) }}</span>
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
                        @if($dataset->is_public ?? false)
                        <span class="px-2.5 py-1 rounded-full bg-white/15 backdrop-blur-sm border border-white/20 text-xs font-semibold">
                            <i class="bi bi-globe me-1"></i>Public
                        </span>
                        @else
                        <span class="px-2.5 py-1 rounded-full bg-white/15 backdrop-blur-sm border border-white/20 text-xs font-semibold">
                            <i class="bi bi-lock me-1"></i>Private
                        </span>
                        @endif
                    </div>
                    
                    <h1 class="text-2xl md:text-3xl lg:text-4xl font-bold mb-2 leading-tight">
                        {{ $dataset->name }}
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
                    </div>
                </div>
                
                <!-- Actions -->
                <div class="flex gap-2 flex-shrink-0">
                    <a href="{{ route('contribute.edit.metadata', $dataset) }}" 
                       class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-white text-brand-700 font-semibold shadow-md hover:shadow-lg hover:-translate-y-0.5 transition-all">
                        <i class="bi bi-pencil"></i>
                        <span class="hidden sm:inline">Edit</span>
                    </a>
                    <button onclick="toggleVisibility()" id="visibilityBtn"
                            class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-white/15 backdrop-blur-sm border border-white/30 text-white font-semibold hover:bg-white/25 transition-all">
                        <i class="bi bi-{{ ($dataset->is_public ?? false) ? 'globe' : 'lock' }}"></i>
                        <span class="hidden sm:inline">{{ ($dataset->is_public ?? false) ? 'Public' : 'Private' }}</span>
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== MAIN CONTENT ===== -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid lg:grid-cols-[1fr_320px] gap-6">
            
            <!-- ===== LEFT: MAIN CONTENT ===== -->
            <div class="space-y-6 min-w-0">
                
                <!-- Description -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-6">
                    <div class="flex items-center gap-2 mb-3">
                        <div class="w-8 h-8 rounded-lg bg-brand-50 dark:bg-brand-900/30 flex items-center justify-center">
                            <i class="bi bi-file-text text-brand-600 dark:text-brand-400"></i>
                        </div>
                        <h2 class="text-lg font-bold text-gray-900 dark:text-white">Description</h2>
                    </div>
                    <p class="text-gray-700 dark:text-gray-300 leading-relaxed">
                        {{ $dataset->description ?? $dataset->abstract ?? 'No description available.' }}
                    </p>
                </div>

                <!-- Characteristics Grid -->
                <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                    @php
                        $characteristics = [
                            ['label' => 'Instances', 'value' => $dataset->num_instances, 'icon' => 'bi-table', 'color' => 'brand'],
                            ['label' => 'Features', 'value' => $dataset->num_features, 'icon' => 'bi-grid-3x3-gap', 'color' => 'green'],
                            ['label' => 'Classes', 'value' => $dataset->num_classes, 'icon' => 'bi-diagram-3', 'color' => 'purple'],
                            ['label' => 'Feature Type', 'value' => $dataset->feature_type, 'icon' => 'bi-layers', 'color' => 'cyan', 'isText' => true],
                            ['label' => 'Data Type', 'value' => $dataset->data_type, 'icon' => 'bi-diagram-3', 'color' => 'amber', 'isText' => true],
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
                        <div class="p-4 rounded-xl bg-gray-50 dark:bg-gray-700/30 border border-gray-100 dark:border-gray-700">
                            <h4 class="text-sm font-semibold text-gray-900 dark:text-white mb-1">Has Missing Values?</h4>
                            <p class="text-sm text-gray-600 dark:text-gray-400">{{ $dataset->has_missing_values ? 'Yes' : 'No' }}</p>
                        </div>
                        @if(!empty($descriptiveInfo))
                            @if($descriptiveInfo['purpose'] ?? null)
                            <div class="p-4 rounded-xl bg-gray-50 dark:bg-gray-700/30 border border-gray-100 dark:border-gray-700">
                                <h4 class="text-sm font-semibold text-gray-900 dark:text-white mb-1">Purpose</h4>
                                <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">{{ $descriptiveInfo['purpose'] }}</p>
                            </div>
                            @endif
                            @if($descriptiveInfo['instances_represent'] ?? null)
                            <div class="p-4 rounded-xl bg-gray-50 dark:bg-gray-700/30 border border-gray-100 dark:border-gray-700">
                                <h4 class="text-sm font-semibold text-gray-900 dark:text-white mb-1">Instances Represent</h4>
                                <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">{{ $descriptiveInfo['instances_represent'] }}</p>
                            </div>
                            @endif
                        @endif
                    </div>
                </div>

                <!-- Collapsible: Introductory Papers -->
                @if($dataset->papers->isNotEmpty())
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
                    <button type="button" onclick="toggleSection('paperSection')" class="w-full p-5 flex items-center justify-between hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-amber-50 dark:bg-amber-900/30 flex items-center justify-center">
                                <i class="bi bi-journal-text text-xl text-amber-600 dark:text-amber-400"></i>
                            </div>
                            <div class="text-left">
                                <h3 class="text-lg font-bold text-gray-900 dark:text-white">Introductory Papers</h3>
                                <p class="text-xs text-gray-500 dark:text-gray-400">{{ $dataset->papers->count() }} papers</p>
                            </div>
                        </div>
                        <i class="bi bi-chevron-down text-gray-400 transition-transform" id="paperSection-icon"></i>
                    </button>
                    <div id="paperSection" class="px-5 pb-5 space-y-3">
                        @foreach($dataset->papers as $paper)
                        <div class="p-4 rounded-xl bg-gray-50 dark:bg-gray-700/30 border border-gray-100 dark:border-gray-700">
                            @if($paper->paper_url ?? $paper->url)
                            <a href="{{ $paper->paper_url ?? $paper->url }}" target="_blank" class="font-semibold text-gray-900 dark:text-white hover:text-brand-600 dark:hover:text-brand-400 transition-colors">
                                {{ $paper->title }}
                            </a>
                            @else
                            <h4 class="font-semibold text-gray-900 dark:text-white">{{ $paper->title }}</h4>
                            @endif
                            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">By {{ $paper->authors }}</p>
                            <p class="text-xs text-gray-500 dark:text-gray-500 mt-1">
                                Published in {{ $paper->venue ?? 'N/A' }}, {{ $paper->publication_year }}
                            </p>
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
                                        <p class="font-semibold text-sm text-gray-900 dark:text-white truncate">{{ $file->original_filename }}</p>
                                        <div class="flex items-center gap-2 mt-0.5">
                                            <span class="px-1.5 py-0.5 rounded bg-gray-200 dark:bg-gray-600 text-xs font-semibold text-gray-700 dark:text-gray-300">{{ strtoupper($file->file_format) }}</span>
                                            <span class="text-xs text-gray-500 dark:text-gray-400">{{ $file->file_size }}</span>
                                        </div>
                                    </div>
                                </div>
                                <a href="{{ route('datasets.download', [$dataset, $file]) }}" 
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

                <!-- Collapsible: Variables -->
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
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                                    @foreach($dataset->variables as $var)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors">
                                        <td class="px-4 py-3 font-semibold text-gray-900 dark:text-white">{{ $var->variable_name }}</td>
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
                                        <td class="px-4 py-3 text-gray-600 dark:text-gray-400">{{ $var->type }}</td>
                                        <td class="px-4 py-3 text-gray-600 dark:text-gray-400 max-w-xs truncate">{{ $var->description ?? '-' }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @endif

            </div>

            <!-- ===== RIGHT: SIDEBAR ===== -->
            <aside class="space-y-4 lg:sticky lg:top-24 lg:self-start">
                
                <!-- Action Buttons -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-5">
                    @php
                        $totalSize = $dataset->files->sum('file_size_bytes');
                    @endphp
                    @if($dataset->files->isNotEmpty() && $dataset->files->first())
                    <a href="{{ route('datasets.download', [$dataset, $dataset->files->first()]) }}" 
                       class="w-full inline-flex items-center justify-center gap-2 px-4 py-3 rounded-xl bg-gradient-to-r from-brand-600 to-sphere-secondary text-white font-semibold shadow-md hover:shadow-lg hover:-translate-y-0.5 transition-all mb-3"
                       download>
                        <i class="bi bi-download"></i>
                        <span>Download</span>
                        @if($totalSize)
                            <span class="text-xs opacity-90">({{ number_format($totalSize / 1024, 1) }} KB)</span>
                        @endif
                    </a>
                    @endif
                    
                    <button onclick="showCitation()" class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-amber-50 dark:bg-amber-900/30 text-amber-600 dark:text-amber-400 font-semibold hover:bg-amber-100 dark:hover:bg-amber-900/50 transition-colors mb-3">
                        <i class="bi bi-quote"></i>
                        <span>Cite this Dataset</span>
                    </button>
                    
                    <div class="pt-4 border-t border-gray-100 dark:border-gray-700 space-y-2">
                        <div class="flex items-center justify-between text-sm">
                            <span class="flex items-center gap-2 text-gray-600 dark:text-gray-400"><i class="bi bi-chat-quote"></i>Citations</span>
                            <span class="font-bold text-gray-900 dark:text-white">{{ number_format($totalCitations ?? 0) }}</span>
                        </div>
                        <div class="flex items-center justify-between text-sm" data-view-count>
                            <span class="flex items-center gap-2 text-gray-600 dark:text-gray-400"><i class="bi bi-eye"></i>Views</span>
                            <span class="font-bold text-gray-900 dark:text-white">{{ number_format($totalViews ?? 0) }}</span>
                        </div>
                    </div>
                </div>

                <!-- DOI -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-5">
                    <h3 class="text-sm font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-3 flex items-center gap-2">
                        <i class="bi bi-upc-scan"></i>DOI
                    </h3>
                    @if($dataset->doi)
                    <a href="{{ $dataset->doi->resolution_url }}" 
                       target="_blank" 
                       class="text-sm text-brand-600 dark:text-brand-400 hover:underline break-all">
                        {{ $dataset->doi->doi_string }}
                    </a>
                    @else
                    <p class="text-sm text-gray-500 dark:text-gray-400">Not assigned</p>
                    @endif
                </div>

                <!-- License -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-5">
                    <h3 class="text-sm font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-3 flex items-center gap-2">
                        <i class="bi bi-shield-check"></i>License
                    </h3>
                    <p class="text-sm text-gray-700 dark:text-gray-300 leading-relaxed mb-2">
                        This dataset is licensed under a 
                        <a href="https://creativecommons.org/licenses/by/4.0/" target="_blank" class="text-brand-600 dark:text-brand-400 hover:underline font-semibold">
                            Creative Commons Attribution 4.0 International
                        </a> (CC BY 4.0) license.
                    </p>
                    <p class="text-xs text-gray-500 dark:text-gray-400">
                        Allows sharing and adaptation with appropriate credit.
                    </p>
                </div>

                <!-- Creators -->
                @if($dataset->creators && $dataset->creators->isNotEmpty())
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-5">
                    <h3 class="text-sm font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-3 flex items-center gap-2">
                        <i class="bi bi-person-badge"></i>Creators ({{ $dataset->creators->count() }})
                    </h3>
                    <div class="space-y-3">
                        @foreach($dataset->creators as $creator)
                        <div class="flex items-start gap-2">
                            <div class="w-8 h-8 rounded-full bg-gradient-to-br from-brand-500 to-sphere-secondary flex items-center justify-center text-white text-xs font-bold flex-shrink-0">
                                {{ strtoupper(substr($creator->name, 0, 1)) }}
                            </div>
                            <div class="min-w-0 flex-1">
                                <p class="font-semibold text-sm text-gray-900 dark:text-white truncate">{{ $creator->name }}</p>
                                @if($creator->pivot->contribution_role)
                                <span class="inline-block px-2 py-0.5 rounded bg-gray-100 dark:bg-gray-700 text-xs text-gray-600 dark:text-gray-400 mt-0.5">{{ ucfirst($creator->pivot->contribution_role) }}</span>
                                @endif
                                @if($creator->affiliation)
                                <p class="text-xs text-gray-500 dark:text-gray-400 truncate mt-0.5">{{ $creator->affiliation }}</p>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Submission Status -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-5">
                    <h3 class="text-sm font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-3 flex items-center gap-2">
                        <i class="bi bi-check2-circle"></i>Submission Status
                    </h3>
                    @php
                        $status = $dataset->status ?? 'pending';
                        $statusStyles = [
                            'approved' => 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400 border-green-200 dark:border-green-800',
                            'pending' => 'bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400 border-amber-200 dark:border-amber-800',
                            'rejected' => 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400 border-red-200 dark:border-red-800',
                            'available' => 'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400 border-blue-200 dark:border-blue-800',
                        ][$status] ?? 'bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-300 border-gray-200 dark:border-gray-600';
                        
                        $statusIcon = [
                            'approved' => 'check-circle-fill',
                            'pending' => 'clock-history',
                            'rejected' => 'x-circle-fill',
                            'available' => 'check-circle-fill',
                        ][$status] ?? 'question-circle-fill';
                    @endphp
                    <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full border text-sm font-semibold {{ $statusStyles }}">
                        <i class="bi bi-{{ $statusIcon }}"></i>
                        {{ strtoupper($status) }}
                    </div>
                    @if($dataset->admin_notes)
                    <div class="mt-3 p-3 rounded-xl bg-amber-50 dark:bg-amber-900/20 border border-amber-200 dark:border-amber-800">
                        <p class="text-xs font-semibold text-amber-900 dark:text-amber-200 mb-1">
                            <i class="bi bi-chat-left-text me-1"></i>Admin Notes:
                        </p>
                        <p class="text-xs text-amber-800 dark:text-amber-300 leading-relaxed">{{ $dataset->admin_notes }}</p>
                    </div>
                    @endif
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

// ===== Visibility Toggle =====
function toggleVisibility() {
    const btn = document.getElementById('visibilityBtn');
    const isCurrentlyPublic = btn.querySelector('i').classList.contains('bi-globe');
    const newIsPublic = !isCurrentlyPublic;
    
    fetch('{{ route("profile.dataset.update-visibility", $dataset) }}', {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ is_public: newIsPublic })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const icon = btn.querySelector('i');
            const text = btn.querySelector('span');
            if (newIsPublic) {
                icon.classList.remove('bi-lock');
                icon.classList.add('bi-globe');
                if (text) text.textContent = 'Public';
            } else {
                icon.classList.remove('bi-globe');
                icon.classList.add('bi-lock');
                if (text) text.textContent = 'Private';
            }
            
            // Show success notification
            const notif = document.createElement('div');
            notif.className = 'fixed top-20 right-4 z-50 bg-green-500 text-white px-4 py-3 rounded-xl shadow-lg flex items-center gap-2';
            notif.innerHTML = '<i class="bi bi-check-circle"></i><span>Visibility updated!</span>';
            document.body.appendChild(notif);
            setTimeout(() => notif.remove(), 2000);
        }
    })
    .catch(err => console.error('Error:', err));
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

// Close modal on Escape
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeCitationModal();
    }
});
</script>
@endpush