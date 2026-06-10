@extends('layouts.admin')

@section('title', 'Manage Posts')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-900">Posts</h1>
    <a href="{{ route('admin.posts.create') }}" 
       class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
        <i class="bi bi-plus-circle"></i> Create New Post
    </a>
</div>

<div class="bg-white rounded-lg shadow p-4 mb-6">
    <form action="{{ route('admin.posts.index') }}" method="GET" class="flex gap-4">
        <input type="text" name="search" placeholder="Search posts..." 
               value="{{ request('search') }}"
               class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        <select name="status" class="px-4 py-2 border border-gray-300 rounded-lg">
            <option value="">All Status</option>
            <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
            <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Published</option>
            <option value="archived" {{ request('status') == 'archived' ? 'selected' : '' }}>Archived</option>
        </select>
        <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded-lg hover:bg-gray-900">
            Filter
        </button>
    </form>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Image</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Title</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Category</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Author</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Views</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse($posts as $post)
            <tr>
                <td class="px-6 py-4">
                    @if($post->featured_img)
                    <img src="{{ Storage::url($post->featured_img) }}" alt="" class="w-16 h-16 object-cover rounded">
                    @else
                    <div class="w-16 h-16 bg-gray-200 rounded flex items-center justify-center">
                        <i class="bi bi-image text-gray-400"></i>
                    </div>
                    @endif
                </td>
                <td class="px-6 py-4">
                    <div class="font-semibold text-gray-900">{{ $post->title }}</div>
                    <div class="text-sm text-gray-500">{{ $post->created_at->format('M d, Y') }}</div>
                </td>
                <td class="px-6 py-4">
                    <span class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800">
                        {{ $post->category->name }}
                    </span>
                </td>
                <td class="px-6 py-4 text-sm text-gray-900">
                    {{ $post->user->name }}
                </td>
                <td class="px-6 py-4">
                    <span class="px-2 py-1 text-xs rounded-full 
                        {{ $post->status === 'published' ? 'bg-green-100 text-green-800' : '' }}
                        {{ $post->status === 'draft' ? 'bg-yellow-100 text-yellow-800' : '' }}
                        {{ $post->status === 'archived' ? 'bg-gray-100 text-gray-800' : '' }}">
                        {{ ucfirst($post->status) }}
                    </span>
                </td>
                <td class="px-6 py-4 text-sm text-gray-900">
                    {{ $post->view_count }}
                </td>
                <td class="px-6 py-4">
                    <div class="flex gap-2">
                        <a href="{{ route('admin.posts.edit', $post) }}" 
                           class="text-blue-600 hover:text-blue-900">
                            Edit
                        </a>
                        <form action="{{ route('admin.posts.destroy', $post) }}" method="POST" 
                              onsubmit="return confirm('Are you sure?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900">
                                Delete
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                    No posts found
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-6">
    {{ $posts->links() }}
</div>
@endsection
