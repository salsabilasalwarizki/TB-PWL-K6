<div class="pb-4 border-b border-gray-100 dark:border-gray-700">
    <label class="block text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-2">
        <i class="bi bi-search me-1"></i>Search
    </label>
    <div class="relative">
        <i class="bi bi-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
        <input type="text" 
               name="q" 
               value="{{ request('q') ?? request('search') }}" 
               placeholder="Search datasets..."
               class="w-full pl-9 pr-3 py-2 rounded-xl bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 text-sm text-gray-900 dark:text-white focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 transition-all">
    </div>
</div>

<div class="pb-4 border-b border-gray-100 dark:border-gray-700">
    <button type="button" 
            class="w-full flex items-center justify-between mb-2 group" 
            onclick="toggleSection('{{ isset($isMobile) ? 'mobile-' : '' }}kwCollapse')">
        <div class="flex items-center gap-2">
            <label class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Keywords</label>
            @if(request('keywords'))
            <span class="inline-flex items-center justify-center w-5 h-5 rounded-full bg-brand-500 text-white text-[10px] font-bold">
                {{ count((array) request('keywords')) }}
            </span>
            @endif
        </div>
        <i class="bi bi-chevron-down text-gray-400 transition-transform" 
           id="{{ isset($isMobile) ? 'mobile-' : '' }}kwCollapse-icon"></i>
    </button>
    <div id="{{ isset($isMobile) ? 'mobile-' : '' }}kwCollapse" class="space-y-2">
        <input type="text" 
               class="w-full px-3 py-1.5 rounded-lg bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 text-xs text-gray-900 dark:text-white focus:outline-none focus:border-brand-500" 
               placeholder="Filter keywords..." 
               id="{{ isset($isMobile) ? 'mobileKeywordSearch' : 'keywordSearch' }}"
               oninput="filterList(this.value, '{{ isset($isMobile) ? 'mobile-' : '' }}keywordItem')">
        <div class="max-h-32 overflow-y-auto space-y-1 custom-scrollbar">
            @forelse($keywords as $keyword)
            <label class="flex items-center gap-2 p-1.5 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700/50 cursor-pointer transition-colors {{ isset($isMobile) ? 'mobile-' : '' }}keywordItem">
                <input class="w-4 h-4 rounded border-gray-300 dark:border-gray-600 text-brand-600 focus:ring-brand-500" 
                       type="checkbox" 
                       name="keywords[]" 
                       value="{{ $keyword->keyword_id }}"
                       {{ in_array($keyword->keyword_id, (array) request('keywords', [])) ? 'checked' : '' }}>
                <span class="text-xs text-gray-700 dark:text-gray-300 flex-1 truncate">{{ $keyword->keyword_name }}</span>
                <span class="px-1.5 py-0.5 rounded bg-gray-100 dark:bg-gray-700 text-[10px] font-semibold text-gray-500 dark:text-gray-400">
                    {{ $keyword->datasets_count ?? 0 }}
                </span>
            </label>
            @empty
            <div class="text-center py-4">
                <i class="bi bi-tags text-2xl text-gray-300 dark:text-gray-600"></i>
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">No keywords available</p>
            </div>
            @endforelse
        </div>
    </div>
</div>

<div class="pb-4 border-b border-gray-100 dark:border-gray-700">
    <button type="button" 
            class="w-full flex items-center justify-between mb-2" 
            onclick="toggleSection('{{ isset($isMobile) ? 'mobile-' : '' }}typeCollapse')">
        <div class="flex items-center gap-2">
            <label class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Data Type</label>
            @if(request('data_type'))
            <span class="inline-flex items-center justify-center w-5 h-5 rounded-full bg-brand-500 text-white text-[10px] font-bold">1</span>
            @endif
        </div>
        <i class="bi bi-chevron-down text-gray-400 transition-transform" 
           id="{{ isset($isMobile) ? 'mobile-' : '' }}typeCollapse-icon"></i>
    </button>
    <div id="{{ isset($isMobile) ? 'mobile-' : '' }}typeCollapse" class="space-y-1">
        {{-- All option --}}
        <label class="flex items-center gap-2 p-1.5 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700/50 cursor-pointer transition-colors">
            <input class="w-4 h-4 rounded-full border-gray-300 dark:border-gray-600 text-brand-600 focus:ring-brand-500" 
                   type="radio" 
                   name="data_type" 
                   value=""
                   {{ !request('data_type') ? 'checked' : '' }}>
            <span class="text-xs text-gray-700 dark:text-gray-300 flex-1 font-medium">All Types</span>
            <span class="px-1.5 py-0.5 rounded bg-gray-100 dark:bg-gray-700 text-[10px] font-semibold text-gray-500 dark:text-gray-400">
                {{ $stats['total'] ?? 0 }}
            </span>
        </label>
        
        @php
            $dataTypeList = isset($dataTypes) && $dataTypes->count() > 0 
                ? $dataTypes 
                : collect([
                    (object)['data_type' => 'Multivariate', 'count' => $stats['data_type_counts']['Multivariate'] ?? 0],
                    (object)['data_type' => 'Text', 'count' => $stats['data_type_counts']['Text'] ?? 0],
                    (object)['data_type' => 'Image', 'count' => $stats['data_type_counts']['Image'] ?? 0],
                    (object)['data_type' => 'Time-Series', 'count' => $stats['data_type_counts']['Time-Series'] ?? 0],
                    (object)['data_type' => 'Sequential', 'count' => $stats['data_type_counts']['Sequential'] ?? 0],
                    (object)['data_type' => 'Tabular', 'count' => $stats['data_type_counts']['Tabular'] ?? 0],
                    (object)['data_type' => 'Relational', 'count' => $stats['data_type_counts']['Relational'] ?? 0],
                    (object)['data_type' => 'Domain-Theory', 'count' => $stats['data_type_counts']['Domain-Theory'] ?? 0],
                    (object)['data_type' => 'Data-Generator', 'count' => $stats['data_type_counts']['Data-Generator'] ?? 0],
                    (object)['data_type' => 'Univariate', 'count' => $stats['data_type_counts']['Univariate'] ?? 0],
                ]);
        @endphp
        
        @foreach($dataTypeList as $type)
            @if(($type->count ?? 0) > 0)
            <label class="flex items-center gap-2 p-1.5 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700/50 cursor-pointer transition-colors">
                <input class="w-4 h-4 rounded-full border-gray-300 dark:border-gray-600 text-brand-600 focus:ring-brand-500" 
                       type="radio" 
                       name="data_type" 
                       value="{{ $type->data_type }}"
                       {{ request('data_type') == $type->data_type ? 'checked' : '' }}>
                <span class="text-xs text-gray-700 dark:text-gray-300 flex-1">{{ $type->data_type }}</span>
                <span class="px-1.5 py-0.5 rounded bg-gray-100 dark:bg-gray-700 text-[10px] font-semibold text-gray-500 dark:text-gray-400">
                    {{ $type->count ?? 0 }}
                </span>
            </label>
            @endif
        @endforeach
    </div>
</div>

<div class="pb-4 border-b border-gray-100 dark:border-gray-700">
    <button type="button" 
            class="w-full flex items-center justify-between mb-2" 
            onclick="toggleSection('{{ isset($isMobile) ? 'mobile-' : '' }}taskCollapse')">
        <div class="flex items-center gap-2">
            <label class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Task Type</label>
            @if(request('task_type'))
            <span class="inline-flex items-center justify-center w-5 h-5 rounded-full bg-brand-500 text-white text-[10px] font-bold">1</span>
            @endif
        </div>
        <i class="bi bi-chevron-down text-gray-400 transition-transform" 
           id="{{ isset($isMobile) ? 'mobile-' : '' }}taskCollapse-icon"></i>
    </button>
    <div id="{{ isset($isMobile) ? 'mobile-' : '' }}taskCollapse" class="space-y-1">
        {{-- All option --}}
        <label class="flex items-center gap-2 p-1.5 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700/50 cursor-pointer transition-colors">
            <input class="w-4 h-4 rounded-full border-gray-300 dark:border-gray-600 text-brand-600 focus:ring-brand-500" 
                   type="radio" 
                   name="task_type" 
                   value=""
                   {{ !request('task_type') ? 'checked' : '' }}>
            <span class="text-xs text-gray-700 dark:text-gray-300 flex-1 font-medium">All Tasks</span>
            <span class="px-1.5 py-0.5 rounded bg-gray-100 dark:bg-gray-700 text-[10px] font-semibold text-gray-500 dark:text-gray-400">
                {{ $stats['total'] ?? 0 }}
            </span>
        </label>
        
        @php
            $taskTypeList = isset($taskTypes) && $taskTypes->count() > 0 
                ? $taskTypes 
                : collect([
                    (object)['task_type' => 'Classification', 'count' => $stats['task_type_counts']['Classification'] ?? 0],
                    (object)['task_type' => 'Regression', 'count' => $stats['task_type_counts']['Regression'] ?? 0],
                    (object)['task_type' => 'Clustering', 'count' => $stats['task_type_counts']['Clustering'] ?? 0],
                    (object)['task_type' => 'Causal-Discovery', 'count' => $stats['task_type_counts']['Causal-Discovery'] ?? 0],
                    (object)['task_type' => 'Relational-Learning', 'count' => $stats['task_type_counts']['Relational-Learning'] ?? 0],
                    (object)['task_type' => 'Other', 'count' => $stats['task_type_counts']['Other'] ?? 0],
                ]);
        @endphp
        
        @foreach($taskTypeList as $task)
            @if(($task->count ?? 0) > 0)
            <label class="flex items-center gap-2 p-1.5 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700/50 cursor-pointer transition-colors">
                <input class="w-4 h-4 rounded-full border-gray-300 dark:border-gray-600 text-brand-600 focus:ring-brand-500" 
                       type="radio" 
                       name="task_type" 
                       value="{{ $task->task_type }}"
                       {{ request('task_type') == $task->task_type ? 'checked' : '' }}>
                <span class="text-xs text-gray-700 dark:text-gray-300 flex-1">{{ $task->task_type }}</span>
                <span class="px-1.5 py-0.5 rounded bg-gray-100 dark:bg-gray-700 text-[10px] font-semibold text-gray-500 dark:text-gray-400">
                    {{ $task->count ?? 0 }}
                </span>
            </label>
            @endif
        @endforeach
    </div>
</div>

<div class="pb-4 border-b border-gray-100 dark:border-gray-700">
    <button type="button" 
            class="w-full flex items-center justify-between mb-2" 
            onclick="toggleSection('{{ isset($isMobile) ? 'mobile-' : '' }}areaCollapse')">
        <div class="flex items-center gap-2">
            <label class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Subject Area</label>
            @if(request('subject_area'))
            <span class="inline-flex items-center justify-center w-5 h-5 rounded-full bg-brand-500 text-white text-[10px] font-bold">
                {{ count((array) request('subject_area')) }}
            </span>
            @endif
        </div>
        <i class="bi bi-chevron-down text-gray-400 transition-transform" 
           id="{{ isset($isMobile) ? 'mobile-' : '' }}areaCollapse-icon"></i>
    </button>
    <div id="{{ isset($isMobile) ? 'mobile-' : '' }}areaCollapse" class="space-y-2">
        <input type="text" 
               class="w-full px-3 py-1.5 rounded-lg bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 text-xs text-gray-900 dark:text-white focus:outline-none focus:border-brand-500" 
               placeholder="Filter areas..." 
               id="{{ isset($isMobile) ? 'mobileSubjectSearch' : 'subjectSearch' }}"
               oninput="filterList(this.value, '{{ isset($isMobile) ? 'mobile-' : '' }}subjectItem')">
        <div class="max-h-32 overflow-y-auto space-y-1 custom-scrollbar">
            @forelse($subjectAreas as $area)
                @if(($area->datasets_count ?? 0) > 0)
                <label class="flex items-center gap-2 p-1.5 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700/50 cursor-pointer transition-colors {{ isset($isMobile) ? 'mobile-' : '' }}subjectItem">
                    <input class="w-4 h-4 rounded border-gray-300 dark:border-gray-600 text-brand-600 focus:ring-brand-500" 
                           type="checkbox" 
                           name="subject_area[]" 
                           value="{{ $area->area_name }}"
                           {{ in_array($area->area_name, (array) request('subject_area', [])) ? 'checked' : '' }}>
                    <span class="text-xs text-gray-700 dark:text-gray-300 flex-1 truncate">{{ $area->area_name }}</span>
                    <span class="px-1.5 py-0.5 rounded bg-gray-100 dark:bg-gray-700 text-[10px] font-semibold text-gray-500 dark:text-gray-400">
                        {{ $area->datasets_count ?? 0 }}
                    </span>
                </label>
                @endif
            @empty
            <div class="text-center py-4">
                <i class="bi bi-folder2-open text-2xl text-gray-300 dark:text-gray-600"></i>
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">No subject areas available</p>
            </div>
            @endforelse
        </div>
    </div>
</div>

<div class="pb-4 border-b border-gray-100 dark:border-gray-700">
    <button type="button" 
            class="w-full flex items-center justify-between mb-2" 
            onclick="toggleSection('{{ isset($isMobile) ? 'mobile-' : '' }}instancesCollapse')">
        <div class="flex items-center gap-2">
            <label class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider"># Instances</label>
            @if(request('instances_min') || request('instances_max') || request('instances_range'))
            <span class="inline-flex items-center justify-center w-5 h-5 rounded-full bg-brand-500 text-white text-[10px] font-bold">✓</span>
            @endif
        </div>
        <i class="bi bi-chevron-down text-gray-400 transition-transform" 
           id="{{ isset($isMobile) ? 'mobile-' : '' }}instancesCollapse-icon"></i>
    </button>
    <div id="{{ isset($isMobile) ? 'mobile-' : '' }}instancesCollapse" class="space-y-2">
        <div class="grid grid-cols-2 gap-2">
            <div>
                <label class="text-[10px] text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1 block">Min</label>
                <input type="number" 
                       class="w-full px-2 py-1.5 rounded-lg bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 text-xs text-gray-900 dark:text-white focus:outline-none focus:border-brand-500" 
                       name="instances_min" 
                       placeholder="0" 
                       value="{{ request('instances_min') }}" 
                       min="0">
            </div>
            <div>
                <label class="text-[10px] text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1 block">Max</label>
                <input type="number" 
                       class="w-full px-2 py-1.5 rounded-lg bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 text-xs text-gray-900 dark:text-white focus:outline-none focus:border-brand-500" 
                       name="instances_max" 
                       placeholder="Max" 
                       value="{{ request('instances_max') }}" 
                       min="0">
            </div>
        </div>
        <input type="range" 
               class="w-full h-2 bg-gray-200 dark:bg-gray-700 rounded-lg appearance-none cursor-pointer accent-brand-600" 
               name="instances_range" 
               min="0" 
               max="{{ $stats['max_instances'] ?? 100000 }}"
               value="{{ request('instances_range', $stats['max_instances'] ?? 100000) }}"
               id="{{ isset($isMobile) ? 'mobile-' : '' }}instancesRange" 
               oninput="updateRangeValue('{{ isset($isMobile) ? 'mobile-' : '' }}instances', this.value)">
        <div class="flex justify-between text-[10px] text-gray-500 dark:text-gray-400">
            <span>0</span>
            <span id="{{ isset($isMobile) ? 'mobile-' : '' }}instancesValue" class="font-semibold text-brand-600 dark:text-brand-400">
                {{ number_format(request('instances_range', $stats['max_instances'] ?? 100000)) }}
            </span>
            <span>{{ number_format($stats['max_instances'] ?? 100000) }}</span>
        </div>
    </div>
</div>

<div class="pb-4 border-b border-gray-100 dark:border-gray-700">
    <button type="button" 
            class="w-full flex items-center justify-between mb-2" 
            onclick="toggleSection('{{ isset($isMobile) ? 'mobile-' : '' }}featuresCollapse')">
        <div class="flex items-center gap-2">
            <label class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider"># Features</label>
            @if(request('features_min') || request('features_max') || request('features_range'))
            <span class="inline-flex items-center justify-center w-5 h-5 rounded-full bg-brand-500 text-white text-[10px] font-bold">✓</span>
            @endif
        </div>
        <i class="bi bi-chevron-down text-gray-400 transition-transform" 
           id="{{ isset($isMobile) ? 'mobile-' : '' }}featuresCollapse-icon"></i>
    </button>
    <div id="{{ isset($isMobile) ? 'mobile-' : '' }}featuresCollapse" class="space-y-2">
        <div class="grid grid-cols-2 gap-2">
            <div>
                <label class="text-[10px] text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1 block">Min</label>
                <input type="number" 
                       class="w-full px-2 py-1.5 rounded-lg bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 text-xs text-gray-900 dark:text-white focus:outline-none focus:border-brand-500" 
                       name="features_min" 
                       placeholder="0" 
                       value="{{ request('features_min') }}" 
                       min="0">
            </div>
            <div>
                <label class="text-[10px] text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1 block">Max</label>
                <input type="number" 
                       class="w-full px-2 py-1.5 rounded-lg bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 text-xs text-gray-900 dark:text-white focus:outline-none focus:border-brand-500" 
                       name="features_max" 
                       placeholder="Max" 
                       value="{{ request('features_max') }}" 
                       min="0">
            </div>
        </div>
        <input type="range" 
               class="w-full h-2 bg-gray-200 dark:bg-gray-700 rounded-lg appearance-none cursor-pointer accent-brand-600" 
               name="features_range" 
               min="0" 
               max="{{ $stats['max_features'] ?? 1000 }}"
               value="{{ request('features_range', $stats['max_features'] ?? 1000) }}"
               id="{{ isset($isMobile) ? 'mobile-' : '' }}featuresRange" 
               oninput="updateRangeValue('{{ isset($isMobile) ? 'mobile-' : '' }}features', this.value)">
        <div class="flex justify-between text-[10px] text-gray-500 dark:text-gray-400">
            <span>0</span>
            <span id="{{ isset($isMobile) ? 'mobile-' : '' }}featuresValue" class="font-semibold text-brand-600 dark:text-brand-400">
                {{ number_format(request('features_range', $stats['max_features'] ?? 1000)) }}
            </span>
            <span>{{ number_format($stats['max_features'] ?? 1000) }}</span>
        </div>
    </div>
</div>

<div class="pb-4">
    <label class="block text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-2">
        <i class="bi bi-lightning-charge me-1"></i>Quick Filters
    </label>
    <label class="flex items-center gap-2 p-2 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700/50 cursor-pointer transition-colors">
        <input class="w-4 h-4 rounded border-gray-300 dark:border-gray-600 text-brand-600 focus:ring-brand-500" 
               type="checkbox" 
               name="has_missing" 
               value="1"
               {{ request('has_missing') ? 'checked' : '' }}>
        <span class="text-xs text-gray-700 dark:text-gray-300 flex-1">Has Missing Values</span>
        <i class="bi bi-exclamation-triangle text-amber-500 text-xs"></i>
    </label>
</div>

@if(!isset($isMobile))
<div class="space-y-2 pt-2">
    <button type="submit" 
            class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-gradient-to-r from-brand-600 to-sphere-secondary text-white font-semibold text-sm shadow-md hover:shadow-lg hover:-translate-y-0.5 transition-all">
        <i class="bi bi-funnel-fill"></i>
        <span>Apply Filters</span>
    </button>
    <a href="{{ route('datasets.index') }}" 
       class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200 font-semibold text-sm hover:bg-gray-200 dark:hover:bg-gray-600 transition-all">
        <i class="bi bi-x-circle"></i>
        <span>Clear All Filters</span>
    </a>
</div>
@endif