@props(['dataset', 'showStats' => false, 'showBadge' => false, 'badgeText' => '', 'badgeVariant' => 'brand'])

@php
    $badgeColors = [
        'brand' => 'bg-gradient-to-r from-brand-500 to-brand-600 text-white',
        'success' => 'bg-gradient-to-r from-green-500 to-emerald-600 text-white',
        'danger' => 'bg-gradient-to-r from-red-500 to-rose-600 text-white',
        'warning' => 'bg-gradient-to-r from-amber-500 to-orange-600 text-white',
        'info' => 'bg-gradient-to-r from-cyan-500 to-blue-600 text-white',
        'purple' => 'bg-gradient-to-r from-purple-500 to-violet-600 text-white',
    ];
    $badgeClass = $badgeColors[$badgeVariant] ?? $badgeColors['brand'];
@endphp

<article class="group relative bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden hover:shadow-2xl hover:-translate-y-2 transition-all duration-500">
    
    <div class="absolute inset-0 rounded-2xl bg-gradient-to-br from-brand-500 via-sphere-primary to-sphere-secondary opacity-0 group-hover:opacity-100 transition-opacity duration-500 -z-10 blur-xl"></div>
    
    @if($showBadge && $badgeText)
    <div class="absolute top-3 right-3 z-10">
        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-bold {{ $badgeClass }} shadow-lg backdrop-blur-sm">
            @if($badgeVariant === 'danger')
                <i class="bi bi-fire"></i>
            @elseif($badgeVariant === 'success')
                <i class="bi bi-stars"></i>
            @else
                <i class="bi bi-bookmark-fill"></i>
            @endif
            {{ $badgeText }}
        </span>
    </div>
    @endif
    
    <div class="relative h-40 overflow-hidden bg-gradient-to-br from-brand-500 via-sphere-primary to-sphere-secondary">
        @if($dataset->thumbnail_url)
            <img src="{{ $dataset->thumbnail_url }}" 
                 alt="{{ $dataset->display_name ?? $dataset->name }}" 
                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
        @elseif($dataset->large_image_url)
            <img src="{{ $dataset->large_image_url }}" 
                 alt="{{ $dataset->display_name ?? $dataset->name }}" 
                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
        @else
            <div class="w-full h-full flex items-center justify-center">
                <i class="bi bi-database text-6xl text-white/40 group-hover:scale-110 transition-transform duration-700"></i>
            </div>
        @endif
        
        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent"></div>
        
        <div class="absolute bottom-0 left-0 right-0 p-4">
            <div class="flex items-center gap-2 mb-2">
                @if($dataset->data_type)
                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full bg-white/20 backdrop-blur-sm border border-white/30 text-white text-xs font-semibold">
                    <i class="bi bi-diagram-3 text-[10px]"></i>
                    {{ $dataset->data_type }}
                </span>
                @endif
                @if($dataset->task_type)
                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full bg-white/20 backdrop-blur-sm border border-white/30 text-white text-xs font-semibold">
                    <i class="bi bi-bullseye text-[10px]"></i>
                    {{ $dataset->task_type }}
                </span>
                @endif
            </div>
        </div>
    </div>
    
    <div class="p-5">
        <h3 class="font-bold text-gray-900 dark:text-white mb-2 line-clamp-2 group-hover:text-brand-600 dark:group-hover:text-brand-400 transition-colors">
            <a href="{{ route('datasets.show', $dataset) }}" class="inline-block">
                {{ $dataset->display_name ?? $dataset->name }}
            </a>
        </h3>
        <p class="text-sm text-gray-600 dark:text-gray-400 mb-4 line-clamp-2 leading-relaxed">
            {{ Str::limit($dataset->abstract ?? $dataset->description, 100) }}
        </p>
        
        @if($showStats)
        <div class="grid grid-cols-3 gap-2 mb-4 pb-4 border-b border-gray-100 dark:border-gray-700">
            @if($dataset->num_instances !== null)
            <div class="text-center">
                <div class="flex items-center justify-center gap-1 text-brand-600 dark:text-brand-400 mb-0.5">
                    <i class="bi bi-table text-sm"></i>
                </div>
                <div class="text-xs font-bold text-gray-900 dark:text-white">
                    {{ $dataset->num_instances >= 1000000 ? number_format($dataset->num_instances / 1000000, 1) . 'M' : ($dataset->num_instances >= 1000 ? number_format($dataset->num_instances / 1000, 1) . 'K' : number_format($dataset->num_instances)) }}
                </div>
                <div class="text-[10px] text-gray-500 dark:text-gray-400 uppercase tracking-wider">Instances</div>
            </div>
            @endif
            @if($dataset->num_features !== null)
            <div class="text-center">
                <div class="flex items-center justify-center gap-1 text-green-600 dark:text-green-400 mb-0.5">
                    <i class="bi bi-grid-3x3-gap text-sm"></i>
                </div>
                <div class="text-xs font-bold text-gray-900 dark:text-white">
                    {{ $dataset->num_features >= 1000 ? number_format($dataset->num_features / 1000, 1) . 'K' : number_format($dataset->num_features) }}
                </div>
                <div class="text-[10px] text-gray-500 dark:text-gray-400 uppercase tracking-wider">Features</div>
            </div>
            @endif
            @if($dataset->view_count)
            <div class="text-center">
                <div class="flex items-center justify-center gap-1 text-purple-600 dark:text-purple-400 mb-0.5">
                    <i class="bi bi-eye text-sm"></i>
                </div>
                <div class="text-xs font-bold text-gray-900 dark:text-white">
                    {{ $dataset->view_count >= 1000 ? number_format($dataset->view_count / 1000, 1) . 'K' : number_format($dataset->view_count) }}
                </div>
                <div class="text-[10px] text-gray-500 dark:text-gray-400 uppercase tracking-wider">Views</div>
            </div>
            @endif
        </div>
        @endif
        
        <div class="flex items-center justify-between text-xs text-gray-500 dark:text-gray-400 mb-4">
            @if($dataset->subject_area)
            <span class="flex items-center gap-1 truncate">
                <i class="bi bi-folder text-brand-500"></i>
                <span class="truncate">{{ Str::limit($dataset->subject_area, 20) }}</span>
            </span>
            @endif
            @if($dataset->donated_date)
            <span class="flex items-center gap-1 flex-shrink-0">
                <i class="bi bi-calendar text-gray-400"></i>
                {{ \Carbon\Carbon::parse($dataset->donated_date)->format('M Y') }}
            </span>
            @endif
        </div>
        
        @if($dataset->keywords && $dataset->keywords->isNotEmpty())
        <div class="flex flex-wrap gap-1 mb-4">
            @foreach($dataset->keywords->take(3) as $keyword)
            <span class="px-2 py-0.5 rounded-full bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 text-[10px] font-medium">
                {{ $keyword->keyword_name }}
            </span>
            @endforeach
            @if($dataset->keywords->count() > 3)
            <span class="px-2 py-0.5 rounded-full bg-gray-100 dark:bg-gray-700 text-gray-500 dark:text-gray-400 text-[10px] font-medium">
                +{{ $dataset->keywords->count() - 3 }}
            </span>
            @endif
        </div>
        @endif
      
        <a href="{{ route('datasets.show', $dataset) }}" 
           class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-gray-50 dark:bg-gray-700/50 text-gray-700 dark:text-gray-200 text-sm font-semibold hover:bg-gradient-to-r hover:from-brand-600 hover:to-sphere-secondary hover:text-white transition-all duration-300 group/btn">
            <span>View Dataset</span>
            <i class="bi bi-arrow-right text-xs group-hover/btn:translate-x-1 transition-transform"></i>
        </a>
    </div>
    
    <div class="absolute top-0 right-0 w-20 h-20 bg-gradient-to-br from-brand-500/10 to-transparent rounded-bl-full opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
</article>