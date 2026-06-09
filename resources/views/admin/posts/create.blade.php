@extends('layouts.admin')

@section('title', 'Create Post')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Create New Post</h1>
        <a href="{{ route('admin.posts.index') }}" class="text-gray-600 hover:text-gray-900">
            ← Back to Posts
        </a>
    </div>

    <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data" 
          class="bg-white rounded-lg shadow p-6">
        @csrf

        <!-- Title -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Title *</label>
            <input type="text" name="title" value="{{ old('title') }}" required
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            @error('title')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Category -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Category *</label>
            <select name="category_id" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                <option value="">Select Category</option>
                @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
                @endforeach
            </select>
            @error('category_id')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Excerpt -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Excerpt</label>
            <textarea name="excerpt" rows="2"
                      class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">{{ old('excerpt') }}</textarea>
        </div>

        <!-- Body (Rich Editor) -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Content *</label>
            <textarea name="body" id="editor" rows="10" required
                      class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">{{ old('body') }}</textarea>
            @error('body')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Featured Image -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Featured Image</label>
            <input type="file" name="featured_img" accept="image/*"
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
            @error('featured_img')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Status -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Status *</label>
            <select name="status" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published</option>
                <option value="archived" {{ old('status') == 'archived' ? 'selected' : '' }}>Archived</option>
            </select>
        </div>

        <!-- Published At -->
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">Published At</label>
            <input type="datetime-local" name="published_at" value="{{ old('published_at') }}"
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
        </div>

        <!-- Buttons -->
        <div class="flex gap-3">
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">
                Create Post
            </button>
            <a href="{{ route('admin.posts.index') }}" 
               class="bg-gray-200 text-gray-800 px-6 py-2 rounded-lg hover:bg-gray-300">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
tinymce.init({
    selector: '#editor',
    plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
    toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
    height: 400,
    menubar: false,
});
</script>
@endpush