<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['dataset', 'showStats' => false, 'showBadge' => false, 'badgeText' => '', 'badgeVariant' => 'brand']));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['dataset', 'showStats' => false, 'showBadge' => false, 'badgeText' => '', 'badgeVariant' => 'brand']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    $badgeColors = [
        'brand' => 'bg-gradient-to-r from-brand-500 to-brand-600 text-white',
        'success' => 'bg-gradient-to-r from-green-500 to-emerald-600 text-white',
        'danger' => 'bg-gradient-to-r from-red-500 to-rose-600 text-white',
        'warning' => 'bg-gradient-to-r from-amber-500 to-orange-600 text-white',
        'info' => 'bg-gradient-to-r from-cyan-500 to-blue-600 text-white',
        'purple' => 'bg-gradient-to-r from-purple-500 to-violet-600 text-white',
    ];
    $badgeClass = $badgeColors[$badgeVariant] ?? $badgeColors['brand'];
?>

<article class="group relative bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden hover:shadow-2xl hover:-translate-y-2 transition-all duration-500">
    
    <!-- Gradient Border Effect on Hover -->
    <div class="absolute inset-0 rounded-2xl bg-gradient-to-br from-brand-500 via-sphere-primary to-sphere-secondary opacity-0 group-hover:opacity-100 transition-opacity duration-500 -z-10 blur-xl"></div>
    
    <!-- Badge -->
    <?php if($showBadge && $badgeText): ?>
    <div class="absolute top-3 right-3 z-10">
        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-bold <?php echo e($badgeClass); ?> shadow-lg backdrop-blur-sm">
            <?php if($badgeVariant === 'danger'): ?>
                <i class="bi bi-fire"></i>
            <?php elseif($badgeVariant === 'success'): ?>
                <i class="bi bi-stars"></i>
            <?php else: ?>
                <i class="bi bi-bookmark-fill"></i>
            <?php endif; ?>
            <?php echo e($badgeText); ?>

        </span>
    </div>
    <?php endif; ?>
    
    <!-- Thumbnail with Overlay -->
    <div class="relative h-40 overflow-hidden bg-gradient-to-br from-brand-500 via-sphere-primary to-sphere-secondary">
        <?php if($dataset->thumbnail_url): ?>
            <img src="<?php echo e($dataset->thumbnail_url); ?>" 
                 alt="<?php echo e($dataset->display_name ?? $dataset->name); ?>" 
                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
        <?php elseif($dataset->large_image_url): ?>
            <img src="<?php echo e($dataset->large_image_url); ?>" 
                 alt="<?php echo e($dataset->display_name ?? $dataset->name); ?>" 
                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
        <?php else: ?>
            <div class="w-full h-full flex items-center justify-center">
                <i class="bi bi-database text-6xl text-white/40 group-hover:scale-110 transition-transform duration-700"></i>
            </div>
        <?php endif; ?>
        
        <!-- Gradient Overlay -->
        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent"></div>
        
        <!-- Bottom Info on Thumbnail -->
        <div class="absolute bottom-0 left-0 right-0 p-4">
            <div class="flex items-center gap-2 mb-2">
                <?php if($dataset->data_type): ?>
                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full bg-white/20 backdrop-blur-sm border border-white/30 text-white text-xs font-semibold">
                    <i class="bi bi-diagram-3 text-[10px]"></i>
                    <?php echo e($dataset->data_type); ?>

                </span>
                <?php endif; ?>
                <?php if($dataset->task_type): ?>
                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full bg-white/20 backdrop-blur-sm border border-white/30 text-white text-xs font-semibold">
                    <i class="bi bi-bullseye text-[10px]"></i>
                    <?php echo e($dataset->task_type); ?>

                </span>
                <?php endif; ?>
            </div>
        </div>
    </div>
    
    <!-- Content -->
    <div class="p-5">
        <!-- Title -->
        <h3 class="font-bold text-gray-900 dark:text-white mb-2 line-clamp-2 group-hover:text-brand-600 dark:group-hover:text-brand-400 transition-colors">
            <a href="<?php echo e(route('datasets.show', $dataset)); ?>" class="inline-block">
                <?php echo e($dataset->display_name ?? $dataset->name); ?>

            </a>
        </h3>
        
        <!-- Description -->
        <p class="text-sm text-gray-600 dark:text-gray-400 mb-4 line-clamp-2 leading-relaxed">
            <?php echo e(Str::limit($dataset->abstract ?? $dataset->description, 100)); ?>

        </p>
        
        <!-- Stats -->
        <?php if($showStats): ?>
        <div class="grid grid-cols-3 gap-2 mb-4 pb-4 border-b border-gray-100 dark:border-gray-700">
            <?php if($dataset->num_instances !== null): ?>
            <div class="text-center">
                <div class="flex items-center justify-center gap-1 text-brand-600 dark:text-brand-400 mb-0.5">
                    <i class="bi bi-table text-sm"></i>
                </div>
                <div class="text-xs font-bold text-gray-900 dark:text-white">
                    <?php echo e($dataset->num_instances >= 1000000 ? number_format($dataset->num_instances / 1000000, 1) . 'M' : ($dataset->num_instances >= 1000 ? number_format($dataset->num_instances / 1000, 1) . 'K' : number_format($dataset->num_instances))); ?>

                </div>
                <div class="text-[10px] text-gray-500 dark:text-gray-400 uppercase tracking-wider">Instances</div>
            </div>
            <?php endif; ?>
            <?php if($dataset->num_features !== null): ?>
            <div class="text-center">
                <div class="flex items-center justify-center gap-1 text-green-600 dark:text-green-400 mb-0.5">
                    <i class="bi bi-grid-3x3-gap text-sm"></i>
                </div>
                <div class="text-xs font-bold text-gray-900 dark:text-white">
                    <?php echo e($dataset->num_features >= 1000 ? number_format($dataset->num_features / 1000, 1) . 'K' : number_format($dataset->num_features)); ?>

                </div>
                <div class="text-[10px] text-gray-500 dark:text-gray-400 uppercase tracking-wider">Features</div>
            </div>
            <?php endif; ?>
            <?php if($dataset->view_count): ?>
            <div class="text-center">
                <div class="flex items-center justify-center gap-1 text-purple-600 dark:text-purple-400 mb-0.5">
                    <i class="bi bi-eye text-sm"></i>
                </div>
                <div class="text-xs font-bold text-gray-900 dark:text-white">
                    <?php echo e($dataset->view_count >= 1000 ? number_format($dataset->view_count / 1000, 1) . 'K' : number_format($dataset->view_count)); ?>

                </div>
                <div class="text-[10px] text-gray-500 dark:text-gray-400 uppercase tracking-wider">Views</div>
            </div>
            <?php endif; ?>
        </div>
        <?php endif; ?>
        
        <!-- Meta Info -->
        <div class="flex items-center justify-between text-xs text-gray-500 dark:text-gray-400 mb-4">
            <?php if($dataset->subject_area): ?>
            <span class="flex items-center gap-1 truncate">
                <i class="bi bi-folder text-brand-500"></i>
                <span class="truncate"><?php echo e(Str::limit($dataset->subject_area, 20)); ?></span>
            </span>
            <?php endif; ?>
            <?php if($dataset->donated_date): ?>
            <span class="flex items-center gap-1 flex-shrink-0">
                <i class="bi bi-calendar text-gray-400"></i>
                <?php echo e(\Carbon\Carbon::parse($dataset->donated_date)->format('M Y')); ?>

            </span>
            <?php endif; ?>
        </div>
        
        <!-- Keywords Preview -->
        <?php if($dataset->keywords && $dataset->keywords->isNotEmpty()): ?>
        <div class="flex flex-wrap gap-1 mb-4">
            <?php $__currentLoopData = $dataset->keywords->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $keyword): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <span class="px-2 py-0.5 rounded-full bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 text-[10px] font-medium">
                <?php echo e($keyword->keyword_name); ?>

            </span>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php if($dataset->keywords->count() > 3): ?>
            <span class="px-2 py-0.5 rounded-full bg-gray-100 dark:bg-gray-700 text-gray-500 dark:text-gray-400 text-[10px] font-medium">
                +<?php echo e($dataset->keywords->count() - 3); ?>

            </span>
            <?php endif; ?>
        </div>
        <?php endif; ?>
        
        <!-- Action Button -->
        <a href="<?php echo e(route('datasets.show', $dataset)); ?>" 
           class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-gray-50 dark:bg-gray-700/50 text-gray-700 dark:text-gray-200 text-sm font-semibold hover:bg-gradient-to-r hover:from-brand-600 hover:to-sphere-secondary hover:text-white transition-all duration-300 group/btn">
            <span>View Dataset</span>
            <i class="bi bi-arrow-right text-xs group-hover/btn:translate-x-1 transition-transform"></i>
        </a>
    </div>
    
    <!-- Decorative Corner Element -->
    <div class="absolute top-0 right-0 w-20 h-20 bg-gradient-to-br from-brand-500/10 to-transparent rounded-bl-full opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
</article><?php /**PATH D:\Documents\TB-PWL-DATASPHERE\resources\views/components/dataset-card-mini.blade.php ENDPATH**/ ?>