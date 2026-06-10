@extends('layouts.app')

@section('title', $post->title . ' - DataSphere')

@section('content')
<script src="https://cdn.tailwindcss.com?plugins=typography"></script>
<article class="bg-white dark:bg-gray-800">
    @if($post->featured_img)
    <div class="w-full h-96 overflow-hidden">
        <img src="{{ Storage::url($post->featured_img) }}" alt="{{ $post->title }}" 
             class="w-full h-full object-cover">
    </div>
    @endif

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <header class="mb-8">
            <div class="flex items-center gap-3 mb-4">
                <span class="px-3 py-1 rounded-full text-sm font-semibold bg-brand-100 dark:bg-brand-900/30 text-brand-700 dark:text-brand-400">
                    {{ $post->category->name }}
                </span>
                <span class="text-sm text-gray-500 dark:text-gray-400">
                    <i class="bi bi-calendar me-1"></i>{{ $post->created_at->format('F d, Y') }}
                </span>
                <span class="text-sm text-gray-500 dark:text-gray-400">
                    <i class="bi bi-eye me-1"></i>{{ $post->view_count }} views
                </span>
            </div>
            
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 dark:text-white mb-4">
                {{ $post->title }}
            </h1>
            
            @if($post->excerpt)
            <p class="text-xl text-gray-600 dark:text-gray-400 mb-6">
                {{ $post->excerpt }}
            </p>
            @endif
            
            <div class="flex items-center gap-3 pt-6 border-t border-gray-200 dark:border-gray-700">
                <div class="w-12 h-12 rounded-full bg-gradient-to-br from-brand-500 to-sphere-secondary flex items-center justify-center text-white font-bold">
                    {{ strtoupper(substr($post->user->name, 0, 1)) }}
                </div>
                <div>
                    <p class="font-semibold text-gray-900 dark:text-white">{{ $post->user->name }}</p>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Author</p>
                </div>
            </div>
        </header>

        <div class="prose prose-lg dark:prose-invert max-w-none mb-12">
            {!! $post->body !!}
        </div>

        @if($relatedPosts->count() > 0)
        <div class="border-t border-gray-200 dark:border-gray-700 pt-12">
            <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Related Articles</h3>
            <div class="grid md:grid-cols-3 gap-6">
                @foreach($relatedPosts as $related)
                <a href="{{ route('posts.show', $related) }}" 
                   class="block bg-gray-50 dark:bg-gray-700/50 rounded-xl overflow-hidden hover:shadow-lg transition-shadow">
                    @if($related->featured_img)
                    <img src="{{ Storage::url($related->featured_img) }}" alt="{{ $related->title }}" 
                         class="w-full h-40 object-cover">
                    @else
                    <div class="w-full h-40 bg-gradient-to-br from-brand-500 to-sphere-secondary flex items-center justify-center">
                        <i class="bi bi-image text-4xl text-white/50"></i>
                    </div>
                    @endif
                    <div class="p-4">
                        <h4 class="font-bold text-gray-900 dark:text-white mb-2 line-clamp-2">
                            {{ $related->title }}
                        </h4>
                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            {{ $related->created_at->format('M d, Y') }}
                        </p>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</article>
@endsection