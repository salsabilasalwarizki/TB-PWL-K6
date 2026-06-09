@extends('layouts.admin')

@section('title', 'Create Category')
@section('page-title', 'Create Category')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-ink-900 dark:text-white">Create Category</h2>
        <a href="{{ route('admin.categories.index') }}" class="text-ink-500 hover:text-ink-700">
            <i class="bi bi-arrow-left"></i> Back
        </a>
    </div>

    <form action="{{ route('admin.categories.store') }}" method="POST" class="bg-white dark:bg-ink-800 rounded-xl shadow-card border border-ink-200 dark:border-ink-700 p-6">
        @csrf
        
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-semibold text-ink-700 dark:text-ink-300 mb-2">
                    Name <span class="text-red-500">*</span>
                </label>
                <input type="text" name="name" value="{{ old('name') }}" required
                       class="w-full px-4 py-2.5 rounded-lg bg-ink-50 dark:bg-ink-700/50 border border-ink-200 dark:border-ink-600 text-ink-900 dark:text-white focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20">
                @error('name')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-ink-700 dark:text-ink-300 mb-2">
                    Description
                </label>
                <textarea name="description" rows="3"
                          class="w-full px-4 py-2.5 rounded-lg bg-ink-50 dark:bg-ink-700/50 border border-ink-200 dark:border-ink-600 text-ink-900 dark:text-white focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20">{{ old('description') }}</textarea>
            </div>

            <div class="flex items-center gap-2">
                <input type="checkbox" name="active" id="active" value="1" {{ old('active', true) ? 'checked' : '' }}
                       class="w-4 h-4 rounded border-ink-300 text-brand-600 focus:ring-brand-500">
                <label for="active" class="text-sm font-medium text-ink-700 dark:text-ink-300">Active</label>
            </div>
        </div>

        <div class="flex gap-3 mt-6">
            <button type="submit" class="px-6 py-2.5 bg-gradient-to-r from-brand-600 to-sphere-600 text-white rounded-lg hover:shadow-lg transition-all">
                Create Category
            </button>
            <a href="{{ route('admin.categories.index') }}" class="px-6 py-2.5 bg-gray-100 dark:bg-ink-700 text-ink-700 dark:text-ink-300 rounded-lg hover:bg-gray-200 dark:hover:bg-ink-600 transition-colors">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection