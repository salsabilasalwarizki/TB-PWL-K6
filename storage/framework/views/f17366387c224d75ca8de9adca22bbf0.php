

<?php $__env->startSection('title', 'Create Category'); ?>
<?php $__env->startSection('page-title', 'Create Category'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-2xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-ink-900 dark:text-white">Create Category</h2>
        <a href="<?php echo e(route('admin.categories.index')); ?>" class="text-ink-500 hover:text-ink-700">
            <i class="bi bi-arrow-left"></i> Back
        </a>
    </div>

    <form action="<?php echo e(route('admin.categories.store')); ?>" method="POST" class="bg-white dark:bg-ink-800 rounded-xl shadow-card border border-ink-200 dark:border-ink-700 p-6">
        <?php echo csrf_field(); ?>
        
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-semibold text-ink-700 dark:text-ink-300 mb-2">
                    Name <span class="text-red-500">*</span>
                </label>
                <input type="text" name="name" value="<?php echo e(old('name')); ?>" required
                       class="w-full px-4 py-2.5 rounded-lg bg-ink-50 dark:bg-ink-700/50 border border-ink-200 dark:border-ink-600 text-ink-900 dark:text-white focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20">
                <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div>
                <label class="block text-sm font-semibold text-ink-700 dark:text-ink-300 mb-2">
                    Description
                </label>
                <textarea name="description" rows="3"
                          class="w-full px-4 py-2.5 rounded-lg bg-ink-50 dark:bg-ink-700/50 border border-ink-200 dark:border-ink-600 text-ink-900 dark:text-white focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20"><?php echo e(old('description')); ?></textarea>
            </div>

            <div class="flex items-center gap-2">
                <input type="checkbox" name="active" id="active" value="1" <?php echo e(old('active', true) ? 'checked' : ''); ?>

                       class="w-4 h-4 rounded border-ink-300 text-brand-600 focus:ring-brand-500">
                <label for="active" class="text-sm font-medium text-ink-700 dark:text-ink-300">Active</label>
            </div>
        </div>

        <div class="flex gap-3 mt-6">
            <button type="submit" class="px-6 py-2.5 bg-gradient-to-r from-brand-600 to-sphere-600 text-white rounded-lg hover:shadow-lg transition-all">
                Create Category
            </button>
            <a href="<?php echo e(route('admin.categories.index')); ?>" class="px-6 py-2.5 bg-gray-100 dark:bg-ink-700 text-ink-700 dark:text-ink-300 rounded-lg hover:bg-gray-200 dark:hover:bg-ink-600 transition-colors">
                Cancel
            </a>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Documents\TB-PWL-DATASPHERE\resources\views/admin/categories/create.blade.php ENDPATH**/ ?>