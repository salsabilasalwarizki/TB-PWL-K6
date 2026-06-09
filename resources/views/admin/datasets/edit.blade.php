@extends('layouts.admin')
@section('title', 'Edit Dataset')
@section('page-title', 'Edit Dataset')

@section('content')
<div class="min-h-screen bg-ink-50 dark:bg-ink-950 bg-grid py-8 px-4 sm:px-6 lg:px-8 animate-slide-up">
    <div class="max-w-6xl mx-auto">
        
        <!-- Header -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6">
            <div>
                <h2 class="text-3xl font-bold text-ink-900 dark:text-white">
                    <i class="bi bi-pencil-square me-2"></i>Edit Dataset
                </h2>
                <p class="text-ink-600 dark:text-ink-400 mt-1">Update dataset information</p>
            </div>
            <a href="{{ route('admin.datasets.index') }}" class="mt-4 sm:mt-0 inline-flex items-center gap-2 px-4 py-2.5 bg-white dark:bg-ink-800 border border-ink-300 dark:border-ink-600 rounded-lg hover:bg-ink-50 dark:hover:bg-ink-700 transition-colors">
                <i class="bi bi-arrow-left"></i>
                <span>Back to List</span>
            </a>
        </div>

        <!-- Alert Info -->
        <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-xl p-4 mb-6 flex items-start gap-3">
            <div class="flex-shrink-0 w-10 h-10 rounded-lg bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center">
                <i class="bi bi-info-circle text-xl text-blue-600 dark:text-blue-400"></i>
            </div>
            <div class="flex-1">
                <h3 class="text-sm font-bold text-blue-900 dark:text-blue-200 mb-1">Important Notice</h3>
                <p class="text-sm text-blue-800 dark:text-blue-200">Changes to this dataset will be saved immediately. Make sure all information is accurate before saving.</p>
            </div>
        </div>

        <!-- Edit Form -->
        <form id="editForm" action="{{ route('admin.datasets.update', $dataset) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Basic Information -->
            <div class="bg-white dark:bg-ink-900 rounded-xl shadow-card mb-6 animate-slide-up" style="animation-delay: 0.1s;">
                <div class="p-6 border-b border-ink-200 dark:border-ink-800">
                    <h3 class="text-lg font-bold text-ink-900 dark:text-white flex items-center gap-2">
                        <i class="bi bi-info-circle text-blue-500"></i>
                        Basic Information
                    </h3>
                </div>
                <div class="p-6 space-y-5">
                    
                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-sm font-semibold text-ink-700 dark:text-ink-300 mb-2">
                            Dataset Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               id="name" 
                               name="name" 
                               value="{{ old('name', $dataset->name) }}" 
                               required
                               placeholder="Enter dataset name"
                               class="w-full px-4 py-3 rounded-lg bg-ink-50 dark:bg-ink-800/50 border border-ink-200 dark:border-ink-600 text-ink-900 dark:text-white placeholder-ink-400 focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 transition-all @error('name') border-red-500 focus:border-red-500 focus:ring-red-500/20 @enderror">
                        @error('name')
                        <p class="mt-2 text-xs text-red-500 flex items-center gap-1">
                            <i class="bi bi-exclamation-circle"></i>{{ $message }}
                        </p>
                        @enderror
                    </div>

                    <!-- Display Name -->
                    <div>
                        <label for="display_name" class="block text-sm font-semibold text-ink-700 dark:text-ink-300 mb-2">
                            Display Name
                        </label>
                        <input type="text" 
                               id="display_name" 
                               name="display_name" 
                               value="{{ old('display_name', $dataset->display_name) }}"
                               placeholder="Display name (optional)"
                               class="w-full px-4 py-3 rounded-lg bg-ink-50 dark:bg-ink-800/50 border border-ink-200 dark:border-ink-600 text-ink-900 dark:text-white placeholder-ink-400 focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 transition-all @error('display_name') border-red-500 focus:border-red-500 focus:ring-red-500/20 @enderror">
                        @error('display_name')
                        <p class="mt-2 text-xs text-red-500 flex items-center gap-1">
                            <i class="bi bi-exclamation-circle"></i>{{ $message }}
                        </p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="description" class="block text-sm font-semibold text-ink-700 dark:text-ink-300 mb-2">
                            Description <span class="text-red-500">*</span>
                        </label>
                        <textarea id="description" 
                                  name="description" 
                                  rows="4" 
                                  required
                                  placeholder="Provide a comprehensive description"
                                  class="w-full px-4 py-3 rounded-lg bg-ink-50 dark:bg-ink-800/50 border border-ink-200 dark:border-ink-600 text-ink-900 dark:text-white placeholder-ink-400 focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 transition-all resize-none @error('description') border-red-500 focus:border-red-500 focus:ring-red-500/20 @enderror">{{ old('description', $dataset->description) }}</textarea>
                        @error('description')
                        <p class="mt-2 text-xs text-red-500 flex items-center gap-1">
                            <i class="bi bi-exclamation-circle"></i>{{ $message }}
                        </p>
                        @enderror
                    </div>

                    <!-- Abstract -->
                    <div>
                        <label for="abstract" class="block text-sm font-semibold text-ink-700 dark:text-ink-300 mb-2">
                            Abstract
                        </label>
                        <textarea id="abstract" 
                                  name="abstract" 
                                  rows="3"
                                  placeholder="Brief abstract"
                                  class="w-full px-4 py-3 rounded-lg bg-ink-50 dark:bg-ink-800/50 border border-ink-200 dark:border-ink-600 text-ink-900 dark:text-white placeholder-ink-400 focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 transition-all resize-none @error('abstract') border-red-500 focus:border-red-500 focus:ring-red-500/20 @enderror">{{ old('abstract', $dataset->abstract) }}</textarea>
                        @error('abstract')
                        <p class="mt-2 text-xs text-red-500 flex items-center gap-1">
                            <i class="bi bi-exclamation-circle"></i>{{ $message }}
                        </p>
                        @enderror
                    </div>

                    <!-- Subject Area & Data Type -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label for="subject_area" class="block text-sm font-semibold text-ink-700 dark:text-ink-300 mb-2">
                                Subject Area
                            </label>
                            <input type="text" 
                                   id="subject_area" 
                                   name="subject_area" 
                                   value="{{ old('subject_area', $dataset->subject_area) }}"
                                   placeholder="e.g., Computer Science"
                                   class="w-full px-4 py-3 rounded-lg bg-ink-50 dark:bg-ink-800/50 border border-ink-200 dark:border-ink-600 text-ink-900 dark:text-white placeholder-ink-400 focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 transition-all @error('subject_area') border-red-500 focus:border-red-500 focus:ring-red-500/20 @enderror">
                            @error('subject_area')
                            <p class="mt-2 text-xs text-red-500 flex items-center gap-1">
                                <i class="bi bi-exclamation-circle"></i>{{ $message }}
                            </p>
                            @enderror
                        </div>
                        <div>
                            <label for="data_type" class="block text-sm font-semibold text-ink-700 dark:text-ink-300 mb-2">
                                Data Type
                            </label>
                            <select id="data_type" 
                                    name="data_type"
                                    class="w-full px-4 py-3 rounded-lg bg-ink-50 dark:bg-ink-800/50 border border-ink-200 dark:border-ink-600 text-ink-900 dark:text-white focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 transition-all @error('data_type') border-red-500 focus:border-red-500 focus:ring-red-500/20 @enderror">
                                <option value="">Select data type</option>
                                <option value="Multivariate" {{ old('data_type', $dataset->data_type) == 'Multivariate' ? 'selected' : '' }}>Multivariate</option>
                                <option value="Univariate" {{ old('data_type', $dataset->data_type) == 'Univariate' ? 'selected' : '' }}>Univariate</option>
                                <option value="Sequential" {{ old('data_type', $dataset->data_type) == 'Sequential' ? 'selected' : '' }}>Sequential</option>
                                <option value="Time-Series" {{ old('data_type', $dataset->data_type) == 'Time-Series' ? 'selected' : '' }}>Time-Series</option>
                                <option value="Text" {{ old('data_type', $dataset->data_type) == 'Text' ? 'selected' : '' }}>Text</option>
                                <option value="Image" {{ old('data_type', $dataset->data_type) == 'Image' ? 'selected' : '' }}>Image</option>
                                <option value="Tabular" {{ old('data_type', $dataset->data_type) == 'Tabular' ? 'selected' : '' }}>Tabular</option>
                            </select>
                            @error('data_type')
                            <p class="mt-2 text-xs text-red-500 flex items-center gap-1">
                                <i class="bi bi-exclamation-circle"></i>{{ $message }}
                            </p>
                            @enderror
                        </div>
                    </div>

                    <!-- Task Type & Domain -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label for="task_type" class="block text-sm font-semibold text-ink-700 dark:text-ink-300 mb-2">
                                Task Type
                            </label>
                            <select id="task_type" 
                                    name="task_type"
                                    class="w-full px-4 py-3 rounded-lg bg-ink-50 dark:bg-ink-800/50 border border-ink-200 dark:border-ink-600 text-ink-900 dark:text-white focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 transition-all @error('task_type') border-red-500 focus:border-red-500 focus:ring-red-500/20 @enderror">
                                <option value="">Select task type</option>
                                <option value="Classification" {{ old('task_type', $dataset->task_type) == 'Classification' ? 'selected' : '' }}>Classification</option>
                                <option value="Regression" {{ old('task_type', $dataset->task_type) == 'Regression' ? 'selected' : '' }}>Regression</option>
                                <option value="Clustering" {{ old('task_type', $dataset->task_type) == 'Clustering' ? 'selected' : '' }}>Clustering</option>
                                <option value="Causal Discovery" {{ old('task_type', $dataset->task_type) == 'Causal Discovery' ? 'selected' : '' }}>Causal Discovery</option>
                                <option value="Other" {{ old('task_type', $dataset->task_type) == 'Other' ? 'selected' : '' }}>Other</option>
                            </select>
                            @error('task_type')
                            <p class="mt-2 text-xs text-red-500 flex items-center gap-1">
                                <i class="bi bi-exclamation-circle"></i>{{ $message }}
                            </p>
                            @enderror
                        </div>
                        <div>
                            <label for="domain" class="block text-sm font-semibold text-ink-700 dark:text-ink-300 mb-2">
                                Domain
                            </label>
                            <input type="text" 
                                   id="domain" 
                                   name="domain" 
                                   value="{{ old('domain', $dataset->domain) }}"
                                   placeholder="e.g., Machine Learning"
                                   class="w-full px-4 py-3 rounded-lg bg-ink-50 dark:bg-ink-800/50 border border-ink-200 dark:border-ink-600 text-ink-900 dark:text-white placeholder-ink-400 focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 transition-all @error('domain') border-red-500 focus:border-red-500 focus:ring-red-500/20 @enderror">
                            @error('domain')
                            <p class="mt-2 text-xs text-red-500 flex items-center gap-1">
                                <i class="bi bi-exclamation-circle"></i>{{ $message }}
                            </p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Dataset Statistics -->
            <div class="bg-white dark:bg-ink-900 rounded-xl shadow-card mb-6 animate-slide-up" style="animation-delay: 0.2s;">
                <div class="p-6 border-b border-ink-200 dark:border-ink-800">
                    <h3 class="text-lg font-bold text-ink-900 dark:text-white flex items-center gap-2">
                        <i class="bi bi-bar-chart text-blue-500"></i>
                        Dataset Statistics
                    </h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                        <div>
                            <label for="num_instances" class="block text-sm font-semibold text-ink-700 dark:text-ink-300 mb-2">
                                Number of Instances
                            </label>
                            <input type="number" 
                                   id="num_instances" 
                                   name="num_instances" 
                                   value="{{ old('num_instances', $dataset->num_instances) }}"
                                   min="0"
                                   placeholder="e.g., 150"
                                   class="w-full px-4 py-3 rounded-lg bg-ink-50 dark:bg-ink-800/50 border border-ink-200 dark:border-ink-600 text-ink-900 dark:text-white placeholder-ink-400 focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 transition-all @error('num_instances') border-red-500 focus:border-red-500 focus:ring-red-500/20 @enderror">
                            @error('num_instances')
                            <p class="mt-2 text-xs text-red-500 flex items-center gap-1">
                                <i class="bi bi-exclamation-circle"></i>{{ $message }}
                            </p>
                            @enderror
                        </div>
                        <div>
                            <label for="num_features" class="block text-sm font-semibold text-ink-700 dark:text-ink-300 mb-2">
                                Number of Features
                            </label>
                            <input type="number" 
                                   id="num_features" 
                                   name="num_features" 
                                   value="{{ old('num_features', $dataset->num_features) }}"
                                   min="0"
                                   placeholder="e.g., 4"
                                   class="w-full px-4 py-3 rounded-lg bg-ink-50 dark:bg-ink-800/50 border border-ink-200 dark:border-ink-600 text-ink-900 dark:text-white placeholder-ink-400 focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 transition-all @error('num_features') border-red-500 focus:border-red-500 focus:ring-red-500/20 @enderror">
                            @error('num_features')
                            <p class="mt-2 text-xs text-red-500 flex items-center gap-1">
                                <i class="bi bi-exclamation-circle"></i>{{ $message }}
                            </p>
                            @enderror
                        </div>
                        <div>
                            <label for="num_classes" class="block text-sm font-semibold text-ink-700 dark:text-ink-300 mb-2">
                                Number of Classes
                            </label>
                            <input type="number" 
                                   id="num_classes" 
                                   name="num_classes" 
                                   value="{{ old('num_classes', $dataset->num_classes) }}"
                                   min="0"
                                   placeholder="e.g., 3"
                                   class="w-full px-4 py-3 rounded-lg bg-ink-50 dark:bg-ink-800/50 border border-ink-200 dark:border-ink-600 text-ink-900 dark:text-white placeholder-ink-400 focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 transition-all @error('num_classes') border-red-500 focus:border-red-500 focus:ring-red-500/20 @enderror">
                            @error('num_classes')
                            <p class="mt-2 text-xs text-red-500 flex items-center gap-1">
                                <i class="bi bi-exclamation-circle"></i>{{ $message }}
                            </p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Status & Visibility -->
            <div class="bg-white dark:bg-ink-900 rounded-xl shadow-card mb-6 animate-slide-up" style="animation-delay: 0.3s;">
                <div class="p-6 border-b border-ink-200 dark:border-ink-800">
                    <h3 class="text-lg font-bold text-ink-900 dark:text-white flex items-center gap-2">
                        <i class="bi bi-shield-check text-blue-500"></i>
                        Status & Visibility
                    </h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label for="status" class="block text-sm font-semibold text-ink-700 dark:text-ink-300 mb-2">
                                Status <span class="text-red-500">*</span>
                            </label>
                            <select id="status" 
                                    name="status" 
                                    required
                                    class="w-full px-4 py-3 rounded-lg bg-ink-50 dark:bg-ink-800/50 border border-ink-200 dark:border-ink-600 text-ink-900 dark:text-white focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 transition-all @error('status') border-red-500 focus:border-red-500 focus:ring-red-500/20 @enderror">
                                <option value="pending" {{ old('status', $dataset->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="approved" {{ old('status', $dataset->status) == 'approved' ? 'selected' : '' }}>Approved</option>
                                <option value="rejected" {{ old('status', $dataset->status) == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                <option value="available" {{ old('status', $dataset->status) == 'available' ? 'selected' : '' }}>Available</option>
                                <option value="deprecated" {{ old('status', $dataset->status) == 'deprecated' ? 'selected' : '' }}>Deprecated</option>
                            </select>
                            @error('status')
                            <p class="mt-2 text-xs text-red-500 flex items-center gap-1">
                                <i class="bi bi-exclamation-circle"></i>{{ $message }}
                            </p>
                            @enderror
                        </div>
                        <div>
                            <label for="has_missing_values" class="block text-sm font-semibold text-ink-700 dark:text-ink-300 mb-2">
                                Has Missing Values
                            </label>
                            <select id="has_missing_values" 
                                    name="has_missing_values"
                                    class="w-full px-4 py-3 rounded-lg bg-ink-50 dark:bg-ink-800/50 border border-ink-200 dark:border-ink-600 text-ink-900 dark:text-white focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 transition-all @error('has_missing_values') border-red-500 focus:border-red-500 focus:ring-red-500/20 @enderror">
                                <option value="0" {{ old('has_missing_values', $dataset->has_missing_values) == '0' ? 'selected' : '' }}>No</option>
                                <option value="1" {{ old('has_missing_values', $dataset->has_missing_values) == '1' ? 'selected' : '' }}>Yes</option>
                            </select>
                            @error('has_missing_values')
                            <p class="mt-2 text-xs text-red-500 flex items-center gap-1">
                                <i class="bi bi-exclamation-circle"></i>{{ $message }}
                            </p>
                            @enderror
                        </div>
                    </div>

                    <!-- Admin Notes -->
                    <div class="mt-5">
                        <label for="admin_notes" class="block text-sm font-semibold text-ink-700 dark:text-ink-300 mb-2">
                            Admin Notes
                        </label>
                        <textarea id="admin_notes" 
                                  name="admin_notes" 
                                  rows="3"
                                  placeholder="Internal notes for administrators"
                                  class="w-full px-4 py-3 rounded-lg bg-ink-50 dark:bg-ink-800/50 border border-ink-200 dark:border-ink-600 text-ink-900 dark:text-white placeholder-ink-400 focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 transition-all resize-none @error('admin_notes') border-red-500 focus:border-red-500 focus:ring-red-500/20 @enderror">{{ old('admin_notes', $dataset->admin_notes) }}</textarea>
                        @error('admin_notes')
                        <p class="mt-2 text-xs text-red-500 flex items-center gap-1">
                            <i class="bi bi-exclamation-circle"></i>{{ $message }}
                        </p>
                        @enderror
                        <p class="mt-2 text-xs text-ink-500 dark:text-ink-400">These notes are only visible to administrators</p>
                    </div>
                </div>
            </div>

            <!-- External Links -->
            <div class="bg-white dark:bg-ink-900 rounded-xl shadow-card mb-6 animate-slide-up" style="animation-delay: 0.4s;">
                <div class="p-6 border-b border-ink-200 dark:border-ink-800">
                    <h3 class="text-lg font-bold text-ink-900 dark:text-white flex items-center gap-2">
                        <i class="bi bi-link-45deg text-blue-500"></i>
                        External Links
                    </h3>
                </div>
                <div class="p-6 space-y-5">
                    <div>
                        <label for="dataset_url" class="block text-sm font-semibold text-ink-700 dark:text-ink-300 mb-2">
                            Dataset URL
                        </label>
                        <input type="url" 
                               id="dataset_url" 
                               name="dataset_url" 
                               value="{{ old('dataset_url', $dataset->dataset_url) }}"
                               placeholder="https://..."
                               class="w-full px-4 py-3 rounded-lg bg-ink-50 dark:bg-ink-800/50 border border-ink-200 dark:border-ink-600 text-ink-900 dark:text-white placeholder-ink-400 focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 transition-all @error('dataset_url') border-red-500 focus:border-red-500 focus:ring-red-500/20 @enderror">
                        @error('dataset_url')
                        <p class="mt-2 text-xs text-red-500 flex items-center gap-1">
                            <i class="bi bi-exclamation-circle"></i>{{ $message }}
                        </p>
                        @enderror
                    </div>

                    <div>
                        <label for="detail_url" class="block text-sm font-semibold text-ink-700 dark:text-ink-300 mb-2">
                            Detail URL
                        </label>
                        <input type="url" 
                               id="detail_url" 
                               name="detail_url" 
                               value="{{ old('detail_url', $dataset->detail_url) }}"
                               placeholder="https://..."
                               class="w-full px-4 py-3 rounded-lg bg-ink-50 dark:bg-ink-800/50 border border-ink-200 dark:border-ink-600 text-ink-900 dark:text-white placeholder-ink-400 focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 transition-all @error('detail_url') border-red-500 focus:border-red-500 focus:ring-red-500/20 @enderror">
                        @error('detail_url')
                        <p class="mt-2 text-xs text-red-500 flex items-center gap-1">
                            <i class="bi bi-exclamation-circle"></i>{{ $message }}
                        </p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Submit Buttons -->
            <div class="bg-white dark:bg-ink-900 rounded-xl shadow-card p-6 flex flex-col sm:flex-row justify-end gap-3 animate-slide-up" style="animation-delay: 0.5s;">
                <a href="{{ route('admin.datasets.index') }}" class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-white dark:bg-ink-800 border border-ink-300 dark:border-ink-600 rounded-lg hover:bg-ink-50 dark:hover:bg-ink-700 transition-colors">
                    <i class="bi bi-x-circle"></i>
                    <span>Cancel</span>
                </a>
                <button type="submit" 
                        id="submitBtn"
                        class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-gradient-to-r from-brand-600 to-sphere-600 hover:from-brand-700 hover:to-sphere-700 text-white rounded-lg shadow-lg hover:shadow-xl hover:shadow-brand-500/30 transition-all">
                    <i class="bi bi-check-circle"></i>
                    <span>Update Dataset</span>
                </button>
            </div>
        </form>

        <!-- Additional Info -->
        <div class="bg-white dark:bg-ink-900 rounded-xl shadow-card mt-6 p-6 animate-slide-up" style="animation-delay: 0.6s;">
            <h3 class="text-lg font-bold text-ink-900 dark:text-white mb-4">Dataset Information</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <p class="text-sm text-ink-500 dark:text-ink-400">Created</p>
                    <p class="text-sm font-semibold text-ink-900 dark:text-white">{{ $dataset->created_at?->format('M d, Y H:i') ?? 'N/A' }}</p>
                </div>
                <div>
                    <p class="text-sm text-ink-500 dark:text-ink-400">Last Updated</p>
                    <p class="text-sm font-semibold text-ink-900 dark:text-white">{{ $dataset->updated_at?->format('M d, Y H:i') ?? 'N/A' }}</p>
                </div>
                <div>
                    <p class="text-sm text-ink-500 dark:text-ink-400">Dataset ID</p>
                    <p class="text-sm font-semibold text-ink-900 dark:text-white">{{ $dataset->dataset_id }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('editForm') || document.querySelector('form');
    const btn = document.getElementById('submitBtn');
    
    if (!form || !btn) return;
    
    // Cek apakah ada validation error dari session
    const hasErrors = {{ $errors->any() ? 'true' : 'false' }};
    
    if (hasErrors) {
        // Reset button jika ada validation error
        btn.disabled = false;
        btn.innerHTML = '<i class="bi bi-check-circle"></i><span>Update Dataset</span>';
    }
    
    // Handle form submit
    form.addEventListener('submit', function(e) {
        // Disable button dan tampilkan loading
        btn.disabled = true;
        btn.innerHTML = `
            <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            <span>Updating...</span>
        `;
    });
});
</script>
@endpush
@endsection