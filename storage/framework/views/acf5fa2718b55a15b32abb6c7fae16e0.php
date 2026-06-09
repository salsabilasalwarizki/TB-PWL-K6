

<?php $__env->startSection('title', 'Categories'); ?>
<?php $__env->startSection('page-title', 'Categories'); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-6">
    <!-- Header -->
    <div class="flex justify-between items-center">
        <div>
            <h2 class="text-2xl font-bold text-ink-900 dark:text-white">Categories</h2>
            <p class="text-sm text-ink-500 dark:text-ink-400 mt-1">Manage post categories</p>
        </div>
        <a href="<?php echo e(route('admin.categories.create')); ?>" 
           class="inline-flex items-center gap-2 px-4 py-2.5 bg-gradient-to-r from-brand-600 to-sphere-600 text-white rounded-lg hover:shadow-lg hover:shadow-brand-500/20 transition-all">
            <i class="bi bi-plus-circle"></i>
            <span>Add Category</span>
        </a>
    </div>

    <!-- Categories Grid -->
    <div class="grid gap-4">
        <?php $__empty_1 = true; $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="bg-white dark:bg-ink-800 rounded-xl shadow-card border border-ink-200 dark:border-ink-700 p-6">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-brand-500 to-sphere-500 flex items-center justify-center">
                        <i class="bi bi-tags text-white text-xl"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-lg text-ink-900 dark:text-white"><?php echo e($category->name); ?></h3>
                        <p class="text-sm text-ink-500 dark:text-ink-400"><?php echo e($category->description ?: 'No description'); ?></p>
                        <p class="text-xs text-ink-400 mt-1">
                            <?php echo e($category->posts_count); ?> <?php echo e(Str::plural('post', $category->posts_count)); ?>

                        </p>
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <span class="px-3 py-1 rounded-full text-xs font-semibold <?php echo e($category->active ? 'bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400' : 'bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-400'); ?>">
                        <?php echo e($category->active ? 'Active' : 'Inactive'); ?>

                    </span>
                    <a href="<?php echo e(route('admin.categories.edit', $category)); ?>" 
                       class="p-2 text-ink-500 hover:text-brand-600 hover:bg-brand-50 dark:hover:bg-brand-900/20 rounded-lg transition-colors">
                        <i class="bi bi-pencil"></i>
                    </a>
                    <form action="<?php echo e(route('admin.categories.destroy', $category)); ?>" method="POST" 
                          onsubmit="return confirm('Delete this category?')">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="p-2 text-ink-500 hover:text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg transition-colors">
                            <i class="bi bi-trash"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="text-center py-12 bg-white dark:bg-ink-800 rounded-xl border border-ink-200 dark:border-ink-700">
            <i class="bi bi-tags text-5xl text-ink-300 dark:text-ink-600 mb-3"></i>
            <p class="text-ink-500 dark:text-ink-400">No categories found</p>
            <a href="<?php echo e(route('admin.categories.create')); ?>" class="inline-flex items-center gap-2 mt-4 text-brand-600 hover:text-brand-700 font-medium">
                <i class="bi bi-plus-circle"></i>
                <span>Create your first category</span>
            </a>
        </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Documents\TB-PWL-DATASPHERE\resources\views/admin/categories/index.blade.php ENDPATH**/ ?>