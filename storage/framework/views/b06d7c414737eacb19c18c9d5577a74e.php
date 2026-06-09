

<?php $__env->startSection('title', 'Blog Posts - DataSphere'); ?>

<?php $__env->startSection('content'); ?>
<script src="https://cdn.tailwindcss.com?plugins=typography"></script>
<!-- Hero Section -->
<section class="bg-gradient-to-br from-brand-600 via-sphere-primary to-sphere-secondary text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">Latest Articles</h1>
        <p class="text-xl text-white/90 max-w-2xl mx-auto">
            Discover insights, tutorials, and updates from the DataSphere community
        </p>
    </div>
</section>

<!-- Main Content -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="grid lg:grid-cols-4 gap-8">
        
        <!-- Sidebar Filters -->
        <aside class="lg:col-span-1">
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-6 sticky top-24">
                <h3 class="font-bold text-lg mb-4 text-gray-900 dark:text-white">
                    <i class="bi bi-funnel me-2"></i>Filter by Category
                </h3>
                <div class="space-y-2">
                    <a href="<?php echo e(route('posts.index')); ?>" 
                       class="block px-3 py-2 rounded-lg <?php echo e(!request('category') ? 'bg-brand-50 dark:bg-brand-900/30 text-brand-600 dark:text-brand-400 font-semibold' : 'text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700'); ?>">
                        All Posts
                        <span class="float-right text-sm">(<?php echo e(\App\Models\Post::published()->count()); ?>)</span>
                    </a>
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(route('posts.index', ['category' => $category->id])); ?>" 
                       class="block px-3 py-2 rounded-lg <?php echo e(request('category') == $category->id ? 'bg-brand-50 dark:bg-brand-900/30 text-brand-600 dark:text-brand-400 font-semibold' : 'text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700'); ?>">
                        <?php echo e($category->name); ?>

                        <span class="float-right text-sm">(<?php echo e($category->posts_count); ?>)</span>
                    </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </aside>

        <!-- Posts Grid -->
        <div class="lg:col-span-3">
            <!-- Search Bar -->
            <form action="<?php echo e(route('posts.index')); ?>" method="GET" class="mb-8">
                <div class="relative">
                    <input type="text" name="search" value="<?php echo e(request('search')); ?>" 
                           placeholder="Search articles..."
                           class="w-full px-6 py-4 rounded-xl bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 text-gray-900 dark:text-white focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20">
                    <button type="submit" class="absolute right-3 top-1/2 -translate-y-1/2 p-2 bg-brand-500 text-white rounded-lg hover:bg-brand-600 transition-colors">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </form>

            <?php if($posts->count() > 0): ?>
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <article class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden hover:shadow-lg hover:-translate-y-1 transition-all">
                    <?php if($post->featured_img): ?>
                    <img src="<?php echo e(Storage::url($post->featured_img)); ?>" alt="<?php echo e($post->title); ?>" 
                         class="w-full h-48 object-cover">
                    <?php else: ?>
                    <div class="w-full h-48 bg-gradient-to-br from-brand-500 to-sphere-secondary flex items-center justify-center">
                        <i class="bi bi-image text-6xl text-white/50"></i>
                    </div>
                    <?php endif; ?>
                    
                    <div class="p-6">
                        <div class="flex items-center gap-2 mb-3">
                            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-brand-100 dark:bg-brand-900/30 text-brand-700 dark:text-brand-400">
                                <?php echo e($post->category->name); ?>

                            </span>
                        </div>
                        
                        <h3 class="font-bold text-xl mb-2 text-gray-900 dark:text-white line-clamp-2">
                            <a href="<?php echo e(route('posts.show', $post)); ?>" class="hover:text-brand-600 dark:hover:text-brand-400">
                                <?php echo e($post->title); ?>

                            </a>
                        </h3>
                        
                        <p class="text-gray-600 dark:text-gray-400 text-sm mb-4 line-clamp-3">
                            <?php echo e($post->excerpt ?: Str::limit(strip_tags($post->body), 120)); ?>

                        </p>
                        
                        <div class="flex items-center justify-between pt-4 border-t border-gray-100 dark:border-gray-700">
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 rounded-full bg-gradient-to-br from-brand-500 to-sphere-secondary flex items-center justify-center text-white text-xs font-bold">
                                    <?php echo e(strtoupper(substr($post->user->name, 0, 1))); ?>

                                </div>
                                <span class="text-sm text-gray-600 dark:text-gray-400"><?php echo e($post->user->name); ?></span>
                            </div>
                            <span class="text-xs text-gray-500 dark:text-gray-400">
                                <?php echo e($post->created_at->format('M d, Y')); ?>

                            </span>
                        </div>
                    </div>
                </article>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <!-- Pagination -->
            <div class="mt-12">
                <?php echo e($posts->links()); ?>

            </div>
            <?php else: ?>
            <div class="text-center py-16 bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700">
                <i class="bi bi-inbox text-6xl text-gray-300 dark:text-gray-600 mb-4"></i>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">No posts found</h3>
                <p class="text-gray-600 dark:text-gray-400">Check back soon for new content!</p>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Documents\TB-PWL-DATASPHERE\resources\views/posts/index.blade.php ENDPATH**/ ?>