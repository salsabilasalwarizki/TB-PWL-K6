


<div class="pb-4 border-b border-gray-100 dark:border-gray-700">
    <label class="block text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-2">
        <i class="bi bi-search me-1"></i>Search
    </label>
    <div class="relative">
        <i class="bi bi-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
        <input type="text" 
               name="search"
               value="<?php echo e(request('search') ?? request('q')); ?>" 
               placeholder="Search datasets..."
               class="w-full pl-9 pr-3 py-2 rounded-xl bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 text-sm text-gray-900 dark:text-white focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 transition-all">
    </div>
</div>




<div class="pb-4 border-b border-gray-100 dark:border-gray-700">
    <button type="button" 
            class="w-full flex items-center justify-between mb-2 group" 
            onclick="toggleSection('<?php echo e(isset($isMobile) ? 'mobile-' : ''); ?>kwCollapse')">
        <div class="flex items-center gap-2">
            <label class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Keywords</label>
            <?php $selectedKeywords = (array) request('keywords', []); ?>
            <?php if(count($selectedKeywords) > 0): ?>
            <span class="inline-flex items-center justify-center w-5 h-5 rounded-full bg-brand-500 text-white text-[10px] font-bold">
                <?php echo e(count($selectedKeywords)); ?>

            </span>
            <?php endif; ?>
        </div>
        <i class="bi bi-chevron-down text-gray-400 transition-transform" 
           id="<?php echo e(isset($isMobile) ? 'mobile-' : ''); ?>kwCollapse-icon"></i>
    </button>
    <div id="<?php echo e(isset($isMobile) ? 'mobile-' : ''); ?>kwCollapse" class="space-y-2">
        <input type="text" 
               class="w-full px-3 py-1.5 rounded-lg bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 text-xs text-gray-900 dark:text-white focus:outline-none focus:border-brand-500" 
               placeholder="Filter keywords..." 
               id="<?php echo e(isset($isMobile) ? 'mobileKeywordSearch' : 'keywordSearch'); ?>"
               oninput="filterList(this.value, '<?php echo e(isset($isMobile) ? 'mobile-' : ''); ?>keywordItem')">
        <div class="max-h-32 overflow-y-auto space-y-1 custom-scrollbar">
            <?php $__empty_1 = true; $__currentLoopData = $keywords ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $keyword): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <label class="flex items-center gap-2 p-1.5 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700/50 cursor-pointer transition-colors <?php echo e(isset($isMobile) ? 'mobile-' : ''); ?>keywordItem">
                <input class="w-4 h-4 rounded border-gray-300 dark:border-gray-600 text-brand-600 focus:ring-brand-500" 
                       type="checkbox" 
                       name="keywords[]" 
                       value="<?php echo e($keyword->keyword_id); ?>"
                       <?php echo e(in_array($keyword->keyword_id, $selectedKeywords) ? 'checked' : ''); ?>>
                <span class="text-xs text-gray-700 dark:text-gray-300 flex-1 truncate"><?php echo e($keyword->keyword_name); ?></span>
                <span class="px-1.5 py-0.5 rounded bg-gray-100 dark:bg-gray-700 text-[10px] font-semibold text-gray-500 dark:text-gray-400">
                    <?php echo e($keyword->datasets_count ?? 0); ?>

                </span>
            </label>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="text-center py-4">
                <i class="bi bi-tags text-2xl text-gray-300 dark:text-gray-600"></i>
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">No keywords available</p>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>




<div class="pb-4 border-b border-gray-100 dark:border-gray-700">
    <button type="button" 
            class="w-full flex items-center justify-between mb-2" 
            onclick="toggleSection('<?php echo e(isset($isMobile) ? 'mobile-' : ''); ?>typeCollapse')">
        <div class="flex items-center gap-2">
            <label class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Data Type</label>
            <?php if(request('data_type')): ?>
            <span class="inline-flex items-center justify-center w-5 h-5 rounded-full bg-brand-500 text-white text-[10px] font-bold">1</span>
            <?php endif; ?>
        </div>
        <i class="bi bi-chevron-down text-gray-400 transition-transform" 
           id="<?php echo e(isset($isMobile) ? 'mobile-' : ''); ?>typeCollapse-icon"></i>
    </button>
    <div id="<?php echo e(isset($isMobile) ? 'mobile-' : ''); ?>typeCollapse" class="space-y-1">
        <?php
            $dataTypeList = ($dataTypes ?? collect())->filter(fn($t) => ($t->count ?? 0) > 0);
        ?>
        
        <?php if($dataTypeList->isEmpty()): ?>
            <div class="text-center py-4">
                <p class="text-xs text-gray-500 dark:text-gray-400">No data types available</p>
            </div>
        <?php else: ?>
            <?php $__currentLoopData = $dataTypeList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <label class="flex items-center gap-2 p-1.5 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700/50 cursor-pointer transition-colors">
                <input class="w-4 h-4 rounded-full border-gray-300 dark:border-gray-600 text-brand-600 focus:ring-brand-500" 
                       type="radio" 
                       name="data_type" 
                       value="<?php echo e($type->data_type); ?>"
                       <?php echo e(request('data_type') == $type->data_type ? 'checked' : ''); ?>>
                <span class="text-xs text-gray-700 dark:text-gray-300 flex-1"><?php echo e($type->data_type); ?></span>
                <span class="px-1.5 py-0.5 rounded bg-gray-100 dark:bg-gray-700 text-[10px] font-semibold text-gray-500 dark:text-gray-400">
                    <?php echo e($type->count ?? 0); ?>

                </span>
            </label>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
    </div>
</div>




<div class="pb-4 border-b border-gray-100 dark:border-gray-700">
    <button type="button" 
            class="w-full flex items-center justify-between mb-2" 
            onclick="toggleSection('<?php echo e(isset($isMobile) ? 'mobile-' : ''); ?>taskCollapse')">
        <div class="flex items-center gap-2">
            <label class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Task Type</label>
            <?php if(request('task_type')): ?>
            <span class="inline-flex items-center justify-center w-5 h-5 rounded-full bg-brand-500 text-white text-[10px] font-bold">1</span>
            <?php endif; ?>
        </div>
        <i class="bi bi-chevron-down text-gray-400 transition-transform" 
           id="<?php echo e(isset($isMobile) ? 'mobile-' : ''); ?>taskCollapse-icon"></i>
    </button>
    <div id="<?php echo e(isset($isMobile) ? 'mobile-' : ''); ?>taskCollapse" class="space-y-1">
        <?php
            $taskTypeList = ($taskTypes ?? collect())->filter(fn($t) => ($t->count ?? 0) > 0);
        ?>
        
        <?php if($taskTypeList->isEmpty()): ?>
            <div class="text-center py-4">
                <p class="text-xs text-gray-500 dark:text-gray-400">No task types available</p>
            </div>
        <?php else: ?>
            <?php $__currentLoopData = $taskTypeList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <label class="flex items-center gap-2 p-1.5 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700/50 cursor-pointer transition-colors">
                <input class="w-4 h-4 rounded-full border-gray-300 dark:border-gray-600 text-brand-600 focus:ring-brand-500" 
                       type="radio" 
                       name="task_type" 
                       value="<?php echo e($task->task_type); ?>"
                       <?php echo e(request('task_type') == $task->task_type ? 'checked' : ''); ?>>
                <span class="text-xs text-gray-700 dark:text-gray-300 flex-1"><?php echo e($task->task_type); ?></span>
                <span class="px-1.5 py-0.5 rounded bg-gray-100 dark:bg-gray-700 text-[10px] font-semibold text-gray-500 dark:text-gray-400">
                    <?php echo e($task->count ?? 0); ?>

                </span>
            </label>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
    </div>
</div>




<div class="pb-4 border-b border-gray-100 dark:border-gray-700">
    <button type="button" 
            class="w-full flex items-center justify-between mb-2" 
            onclick="toggleSection('<?php echo e(isset($isMobile) ? 'mobile-' : ''); ?>areaCollapse')">
        <div class="flex items-center gap-2">
            <label class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Subject Area</label>
            <?php $selectedAreas = (array) request('subject_area', []); ?>
            <?php if(count($selectedAreas) > 0): ?>
            <span class="inline-flex items-center justify-center w-5 h-5 rounded-full bg-brand-500 text-white text-[10px] font-bold">
                <?php echo e(count($selectedAreas)); ?>

            </span>
            <?php endif; ?>
        </div>
        <i class="bi bi-chevron-down text-gray-400 transition-transform" 
           id="<?php echo e(isset($isMobile) ? 'mobile-' : ''); ?>areaCollapse-icon"></i>
    </button>
    <div id="<?php echo e(isset($isMobile) ? 'mobile-' : ''); ?>areaCollapse" class="space-y-2">
        <input type="text" 
               class="w-full px-3 py-1.5 rounded-lg bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 text-xs text-gray-900 dark:text-white focus:outline-none focus:border-brand-500" 
               placeholder="Filter areas..." 
               id="<?php echo e(isset($isMobile) ? 'mobileSubjectSearch' : 'subjectSearch'); ?>"
               oninput="filterList(this.value, '<?php echo e(isset($isMobile) ? 'mobile-' : ''); ?>subjectItem')">
        <div class="max-h-32 overflow-y-auto space-y-1 custom-scrollbar">
            <?php $__empty_1 = true; $__currentLoopData = $subjectAreas ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $area): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <?php if(($area->datasets_count ?? 0) > 0): ?>
                <label class="flex items-center gap-2 p-1.5 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700/50 cursor-pointer transition-colors <?php echo e(isset($isMobile) ? 'mobile-' : ''); ?>subjectItem">
                    <input class="w-4 h-4 rounded border-gray-300 dark:border-gray-600 text-brand-600 focus:ring-brand-500" 
                           type="checkbox" 
                           name="subject_area[]" 
                           value="<?php echo e($area->area_name); ?>"
                           <?php echo e(in_array($area->area_name, $selectedAreas) ? 'checked' : ''); ?>>
                    <span class="text-xs text-gray-700 dark:text-gray-300 flex-1 truncate"><?php echo e($area->area_name); ?></span>
                    <span class="px-1.5 py-0.5 rounded bg-gray-100 dark:bg-gray-700 text-[10px] font-semibold text-gray-500 dark:text-gray-400">
                        <?php echo e($area->datasets_count ?? 0); ?>

                    </span>
                </label>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="text-center py-4">
                <i class="bi bi-folder2-open text-2xl text-gray-300 dark:text-gray-600"></i>
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">No subject areas available</p>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>




<div class="pb-4 border-b border-gray-100 dark:border-gray-700">
    <button type="button" 
            class="w-full flex items-center justify-between mb-2" 
            onclick="toggleSection('<?php echo e(isset($isMobile) ? 'mobile-' : ''); ?>instancesCollapse')">
        <div class="flex items-center gap-2">
            <label class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider"># Instances</label>
            <?php if(request('instances_min') || request('instances_max')): ?>
            <span class="inline-flex items-center justify-center w-5 h-5 rounded-full bg-brand-500 text-white text-[10px] font-bold">✓</span>
            <?php endif; ?>
        </div>
        <i class="bi bi-chevron-down text-gray-400 transition-transform" 
           id="<?php echo e(isset($isMobile) ? 'mobile-' : ''); ?>instancesCollapse-icon"></i>
    </button>
    <div id="<?php echo e(isset($isMobile) ? 'mobile-' : ''); ?>instancesCollapse" class="space-y-2">
        <div class="grid grid-cols-2 gap-2">
            <div>
                <label class="text-[10px] text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1 block">Min</label>
                <input type="number" 
                       class="w-full px-2 py-1.5 rounded-lg bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 text-xs text-gray-900 dark:text-white focus:outline-none focus:border-brand-500" 
                       name="instances_min" 
                       placeholder="0" 
                       value="<?php echo e(request('instances_min')); ?>" 
                       min="0">
            </div>
            <div>
                <label class="text-[10px] text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1 block">Max</label>
                <input type="number" 
                       class="w-full px-2 py-1.5 rounded-lg bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 text-xs text-gray-900 dark:text-white focus:outline-none focus:border-brand-500" 
                       name="instances_max" 
                       placeholder="Max" 
                       value="<?php echo e(request('instances_max')); ?>" 
                       min="0">
            </div>
        </div>
    </div>
</div>




<div class="pb-4 border-b border-gray-100 dark:border-gray-700">
    <button type="button" 
            class="w-full flex items-center justify-between mb-2" 
            onclick="toggleSection('<?php echo e(isset($isMobile) ? 'mobile-' : ''); ?>featuresCollapse')">
        <div class="flex items-center gap-2">
            <label class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider"># Features</label>
            <?php if(request('features_min') || request('features_max')): ?>
            <span class="inline-flex items-center justify-center w-5 h-5 rounded-full bg-brand-500 text-white text-[10px] font-bold">✓</span>
            <?php endif; ?>
        </div>
        <i class="bi bi-chevron-down text-gray-400 transition-transform" 
           id="<?php echo e(isset($isMobile) ? 'mobile-' : ''); ?>featuresCollapse-icon"></i>
    </button>
    <div id="<?php echo e(isset($isMobile) ? 'mobile-' : ''); ?>featuresCollapse" class="space-y-2">
        <div class="grid grid-cols-2 gap-2">
            <div>
                <label class="text-[10px] text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1 block">Min</label>
                <input type="number" 
                       class="w-full px-2 py-1.5 rounded-lg bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 text-xs text-gray-900 dark:text-white focus:outline-none focus:border-brand-500" 
                       name="features_min" 
                       placeholder="0" 
                       value="<?php echo e(request('features_min')); ?>" 
                       min="0">
            </div>
            <div>
                <label class="text-[10px] text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1 block">Max</label>
                <input type="number" 
                       class="w-full px-2 py-1.5 rounded-lg bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 text-xs text-gray-900 dark:text-white focus:outline-none focus:border-brand-500" 
                       name="features_max" 
                       placeholder="Max" 
                       value="<?php echo e(request('features_max')); ?>" 
                       min="0">
            </div>
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
               <?php echo e(request('has_missing') ? 'checked' : ''); ?>>
        <span class="text-xs text-gray-700 dark:text-gray-300 flex-1">Has Missing Values</span>
        <i class="bi bi-exclamation-triangle text-amber-500 text-xs"></i>
    </label>
</div>




<div class="space-y-2 pt-2">
    <button type="submit" 
            class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-gradient-to-r from-brand-600 to-sphere-secondary text-white font-semibold text-sm shadow-md hover:shadow-lg hover:-translate-y-0.5 transition-all">
        <i class="bi bi-funnel-fill"></i>
        <span>Apply Filters</span>
    </button>
    <a href="<?php echo e(route('datasets.index')); ?>" 
       class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200 font-semibold text-sm hover:bg-gray-200 dark:hover:bg-gray-600 transition-all">
        <i class="bi bi-x-circle"></i>
        <span>Clear All Filters</span>
    </a>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
// Toggle collapse section
function toggleSection(id) {
    const section = document.getElementById(id);
    const icon = document.getElementById(id + '-icon');
    
    if (section) {
        if (section.classList.contains('hidden')) {
            section.classList.remove('hidden');
            if (icon) icon.style.transform = 'rotate(0deg)';
        } else {
            section.classList.add('hidden');
            if (icon) icon.style.transform = 'rotate(-90deg)';
        }
    }
}

// Filter list items (keywords, subject areas)
function filterList(query, itemClass) {
    const items = document.querySelectorAll('.' + itemClass);
    const lowerQuery = query.toLowerCase();
    
    items.forEach(item => {
        const text = item.textContent.toLowerCase();
        if (text.includes(lowerQuery)) {
            item.style.display = 'flex';
        } else {
            item.style.display = 'none';
        }
    });
}

// Auto-submit form saat radio berubah
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    if (!form) return;
    
    // Auto-submit saat radio berubah
    form.querySelectorAll('input[type="radio"]').forEach(radio => {
        radio.addEventListener('change', function() {
            form.submit();
        });
    });
    
    // Debounce untuk search input
    let searchTimeout;
    const searchInput = form.querySelector('input[name="search"]');
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                form.submit();
            }, 500);
        });
    }
});
</script>
<?php $__env->stopPush(); ?><?php /**PATH D:\Documents\TB-PWL-K6\resources\views/partials/filter-form.blade.php ENDPATH**/ ?>