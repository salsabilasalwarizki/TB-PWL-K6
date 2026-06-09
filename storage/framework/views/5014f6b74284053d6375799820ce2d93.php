

<?php $__env->startSection('title', 'Edit Post'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-4xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Edit Post</h1>
        <a href="<?php echo e(route('admin.posts.index')); ?>" class="text-gray-600 hover:text-gray-900">
            ← Back to Posts
        </a>
    </div>

    <form action="<?php echo e(route('admin.posts.update', $post)); ?>" method="POST" enctype="multipart/form-data" 
          class="bg-white rounded-lg shadow p-6">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <!-- Title -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Title *</label>
            <input type="text" name="title" value="<?php echo e(old('title', $post->title)); ?>" required
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
        </div>

        <!-- Category -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Category *</label>
            <select name="category_id" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                <option value="">Select Category</option>
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($category->id); ?>" 
                        <?php echo e(old('category_id', $post->category_id) == $category->id ? 'selected' : ''); ?>>
                    <?php echo e($category->name); ?>

                </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <!-- Excerpt -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Excerpt</label>
            <textarea name="excerpt" rows="2"
                      class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"><?php echo e(old('excerpt', $post->excerpt)); ?></textarea>
        </div>

        <!-- Body (Rich Editor) -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Content *</label>
            <textarea name="body" id="editor" rows="10" required
                      class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"><?php echo e(old('body', $post->body)); ?></textarea>
        </div>

        <!-- Featured Image -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Featured Image</label>
            <?php if($post->featured_img): ?>
            <div class="mb-2">
                <img src="<?php echo e(Storage::url($post->featured_img)); ?>" alt="" class="w-32 h-32 object-cover rounded">
            </div>
            <?php endif; ?>
            <input type="file" name="featured_img" accept="image/*"
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
        </div>

        <!-- Status -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Status *</label>
            <select name="status" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                <option value="draft" <?php echo e(old('status', $post->status) == 'draft' ? 'selected' : ''); ?>>Draft</option>
                <option value="published" <?php echo e(old('status', $post->status) == 'published' ? 'selected' : ''); ?>>Published</option>
                <option value="archived" <?php echo e(old('status', $post->status) == 'archived' ? 'selected' : ''); ?>>Archived</option>
            </select>
        </div>

        <!-- Published At -->
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">Published At</label>
            <input type="datetime-local" name="published_at" 
                   value="<?php echo e(old('published_at', $post->published_at?->format('Y-m-d\TH:i'))); ?>"
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
        </div>

        <!-- Buttons -->
        <div class="flex gap-3">
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">
                Update Post
            </button>
            <a href="<?php echo e(route('admin.posts.index')); ?>" 
               class="bg-gray-200 text-gray-800 px-6 py-2 rounded-lg hover:bg-gray-300">
                Cancel
            </a>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
tinymce.init({
    selector: '#editor',
    plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
    toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
    height: 400,
    menubar: false,
});
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Documents\TB-PWL-DATASPHERE\resources\views/admin/posts/edit.blade.php ENDPATH**/ ?>