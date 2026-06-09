

<div class="variable-item bg-gradient-to-br from-violet-50/50 to-purple-50/50 dark:from-gray-700/30 dark:to-gray-700/30 border-2 border-violet-200 dark:border-violet-800/50 rounded-2xl p-5 md:p-6 transition-all hover:shadow-lg" data-index="<?php echo e($index); ?>">
    
    <!-- Header -->
    <div class="flex items-center justify-between mb-5 pb-4 border-b border-violet-200 dark:border-violet-800/50">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-violet-500 to-purple-500 flex items-center justify-center text-white font-bold text-sm shadow-md">
                <span class="var-number"><?php echo e($index + 1); ?></span>
            </div>
            <div>
                <h6 class="text-sm font-bold text-gray-900 dark:text-white">Variable <?php echo e($index + 1); ?></h6>
                <p class="text-xs text-gray-500 dark:text-gray-400">Define column properties</p>
            </div>
        </div>
        <?php if($canRemove): ?>
        <button type="button" 
                class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-red-50 dark:bg-red-900/20 text-red-600 dark:text-red-400 text-xs font-semibold hover:bg-red-100 dark:hover:bg-red-900/40 transition-colors"
                onclick="removeVariable(<?php echo e($index); ?>)">
            <i class="bi bi-trash"></i>
            <span class="hidden sm:inline">Remove</span>
        </button>
        <?php endif; ?>
    </div>
    
    <!-- Grid Layout -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        
        <!-- Variable Name -->
        <div>
            <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1.5">
                <i class="bi bi-code-square me-1 text-violet-500"></i>Variable Name <span class="text-red-500">*</span>
            </label>
            <input type="text" 
                   class="w-full px-3 py-2.5 rounded-lg bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 text-sm text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:border-violet-500 focus:ring-2 focus:ring-violet-500/20 transition-all <?php $__errorArgs = ['variables.'.$index.'.variable_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 focus:border-red-500 focus:ring-red-500/20 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                   name="variables[<?php echo e($index); ?>][variable_name]" 
                   value="<?php echo e($var['variable_name'] ?? ''); ?>" 
                   required 
                   maxlength="100" 
                   placeholder="column_name">
            <?php $__errorArgs = ['variables.'.$index.'.variable_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <p class="mt-1 text-xs text-red-500 flex items-center gap-1">
                <i class="bi bi-exclamation-circle"></i><?php echo e($message); ?>

            </p>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        
        <!-- Display Name -->
        <div>
            <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1.5">
                <i class="bi bi-person-badge me-1 text-violet-500"></i>Display Name
            </label>
            <input type="text" 
                   class="w-full px-3 py-2.5 rounded-lg bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 text-sm text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:border-violet-500 focus:ring-2 focus:ring-violet-500/20 transition-all" 
                   name="variables[<?php echo e($index); ?>][display_name]" 
                   value="<?php echo e($var['display_name'] ?? ''); ?>" 
                   maxlength="100" 
                   placeholder="Human readable name">
        </div>
        
        <!-- Role -->
        <div>
            <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1.5">
                <i class="bi bi-bullseye me-1 text-violet-500"></i>Role <span class="text-red-500">*</span>
            </label>
            <select class="w-full px-3 py-2.5 rounded-lg bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 text-sm text-gray-900 dark:text-white focus:outline-none focus:border-violet-500 focus:ring-2 focus:ring-violet-500/20 transition-all appearance-none cursor-pointer <?php $__errorArgs = ['variables.'.$index.'.role'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                    name="variables[<?php echo e($index); ?>][role]" 
                    required>
                <option value="feature" <?php echo e(($var['role'] ?? 'feature') == 'feature' ? 'selected' : ''); ?>>Feature (Input)</option>
                <option value="target" <?php echo e(($var['role'] ?? '') == 'target' ? 'selected' : ''); ?>>Target (Output)</option>
                <option value="id" <?php echo e(($var['role'] ?? '') == 'id' ? 'selected' : ''); ?>>ID (Identifier)</option>
                <option value="metadata" <?php echo e(($var['role'] ?? '') == 'metadata' ? 'selected' : ''); ?>>Metadata</option>
                <option value="other" <?php echo e(($var['role'] ?? '') == 'other' ? 'selected' : ''); ?>>Other</option>
            </select>
            <?php $__errorArgs = ['variables.'.$index.'.role'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <p class="mt-1 text-xs text-red-500 flex items-center gap-1">
                <i class="bi bi-exclamation-circle"></i><?php echo e($message); ?>

            </p>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        
        <!-- Variable Type -->
        <div>
            <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1.5">
                <i class="bi bi-diagram-2 me-1 text-violet-500"></i>Type <span class="text-red-500">*</span>
            </label>
            <select class="var-type-select w-full px-3 py-2.5 rounded-lg bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 text-sm text-gray-900 dark:text-white focus:outline-none focus:border-violet-500 focus:ring-2 focus:ring-violet-500/20 transition-all appearance-none cursor-pointer <?php $__errorArgs = ['variables.'.$index.'.variable_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                    name="variables[<?php echo e($index); ?>][variable_type]" 
                    required 
                    onchange="toggleCategoriesField(this)">
                <?php $__currentLoopData = ['Categorical', 'Integer', 'Real', 'Text', 'Binary', 'Ordinal', 'Nominal', 'DateTime']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vtype): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($vtype); ?>" <?php echo e(($var['variable_type'] ?? 'Real') == $vtype ? 'selected' : ''); ?>><?php echo e($vtype); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <?php $__errorArgs = ['variables.'.$index.'.variable_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <p class="mt-1 text-xs text-red-500 flex items-center gap-1">
                <i class="bi bi-exclamation-circle"></i><?php echo e($message); ?>

            </p>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        
        <!-- Unit -->
        <div>
            <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1.5">
                <i class="bi bi-rulers me-1 text-violet-500"></i>Unit
            </label>
            <input type="text" 
                   class="w-full px-3 py-2.5 rounded-lg bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 text-sm text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:border-violet-500 focus:ring-2 focus:ring-violet-500/20 transition-all" 
                   name="variables[<?php echo e($index); ?>][unit]" 
                   value="<?php echo e($var['unit'] ?? ''); ?>" 
                   maxlength="50" 
                   placeholder="e.g., kg, °C, meters">
        </div>
        
        <!-- Min Value -->
        <div>
            <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1.5">
                <i class="bi bi-arrow-down-left me-1 text-violet-500"></i>Min Value
            </label>
            <input type="number" 
                   step="any" 
                   class="w-full px-3 py-2.5 rounded-lg bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 text-sm text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:border-violet-500 focus:ring-2 focus:ring-violet-500/20 transition-all" 
                   name="variables[<?php echo e($index); ?>][min_value]" 
                   value="<?php echo e($var['min_value'] ?? ''); ?>" 
                   placeholder="Minimum">
        </div>
        
        <!-- Max Value -->
        <div>
            <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1.5">
                <i class="bi bi-arrow-up-right me-1 text-violet-500"></i>Max Value
            </label>
            <input type="number" 
                   step="any" 
                   class="w-full px-3 py-2.5 rounded-lg bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 text-sm text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:border-violet-500 focus:ring-2 focus:ring-violet-500/20 transition-all" 
                   name="variables[<?php echo e($index); ?>][max_value]" 
                   value="<?php echo e($var['max_value'] ?? ''); ?>" 
                   placeholder="Maximum">
        </div>
        
        <!-- Description -->
        <div class="lg:col-span-2">
            <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1.5">
                <i class="bi bi-card-text me-1 text-violet-500"></i>Description
            </label>
            <input type="text" 
                   class="w-full px-3 py-2.5 rounded-lg bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 text-sm text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:border-violet-500 focus:ring-2 focus:ring-violet-500/20 transition-all" 
                   name="variables[<?php echo e($index); ?>][description]" 
                   value="<?php echo e($var['description'] ?? ''); ?>" 
                   maxlength="500" 
                   placeholder="Brief description of this variable">
        </div>
    </div>
    
    <!-- Categories Field (for Categorical type) -->
    <div class="categories-row mt-4 pt-4 border-t border-violet-200 dark:border-violet-800/50 <?php echo e(($var['variable_type'] ?? '') == 'Categorical' ? '' : 'hidden'); ?>" data-index="<?php echo e($index); ?>">
        <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1.5">
            <i class="bi bi-tags me-1 text-violet-500"></i>Categories <span class="text-xs font-normal text-gray-500">(comma-separated)</span>
        </label>
        <input type="text" 
               class="w-full px-3 py-2.5 rounded-lg bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 text-sm text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:border-violet-500 focus:ring-2 focus:ring-violet-500/20 transition-all" 
               name="variables[<?php echo e($index); ?>][categories]" 
               value="<?php echo e($var['categories'] ?? ''); ?>" 
               placeholder="e.g., low, medium, high">
        <p class="mt-1.5 text-xs text-gray-500 dark:text-gray-400 flex items-center gap-1">
            <i class="bi bi-info-circle"></i>
            Enter category values separated by commas
        </p>
    </div>
</div><?php /**PATH D:\Documents\TB-PWL-DATASPHERE\resources\views/contribute/partials/variable-item.blade.php ENDPATH**/ ?>