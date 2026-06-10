@extends('layouts.app')
@section('title', 'Donate a Dataset - DataSphere ML Repository')
@section('meta_desc', 'Contribute your dataset to the DataSphere Machine Learning Repository')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 via-brand-50/30 to-sphere-secondary/10 dark:from-gray-900 dark:via-gray-900 dark:to-gray-900 py-8 md:py-12 px-4 sm:px-6 lg:px-8">
    
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-20 left-10 w-72 h-72 bg-brand-500/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-20 right-10 w-96 h-96 bg-sphere-secondary/10 rounded-full blur-3xl"></div>
    </div>
    
    <div class="relative max-w-5xl mx-auto">
        
        <nav class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-400 mb-6">
            <a href="{{ route('home') }}" class="hover:text-brand-600 dark:hover:text-brand-400 transition-colors">Home</a>
            <i class="bi bi-chevron-right text-xs"></i>
            <a href="{{ route('profile') }}" class="hover:text-brand-600 dark:hover:text-brand-400 transition-colors">Profile</a>
            <i class="bi bi-chevron-right text-xs"></i>
            <a href="{{ route('profile.datasets') }}" class="hover:text-brand-600 dark:hover:text-brand-400 transition-colors">My Datasets</a>
            <i class="bi bi-chevron-right text-xs"></i>
            <span class="text-brand-600 dark:text-brand-400 font-semibold">Donate Dataset</span>
        </nav>
        
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 overflow-hidden mb-6">
            <div class="bg-gradient-to-r from-brand-600 to-sphere-secondary p-8 md:p-10">
                <div class="flex items-center gap-4 mb-4">
                    <div class="w-14 h-14 rounded-xl bg-white/20 backdrop-blur-sm flex items-center justify-center">
                        <i class="bi bi-cloud-arrow-up text-3xl text-white"></i>
                    </div>
                    <div>
                        <h1 class="text-3xl md:text-4xl font-bold text-white">
                            Donate a Dataset
                        </h1>
                        <p class="text-white/90 text-sm md:text-base mt-1">
                            Fill in the details below to contribute your dataset to the repository
                        </p>
                    </div>
                </div>
            </div>
        </div>
       
        @if($errors->any())
        <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-2xl p-5 mb-6 flex items-start gap-3">
            <div class="flex-shrink-0 w-10 h-10 rounded-lg bg-red-100 dark:bg-red-900/30 flex items-center justify-center">
                <i class="bi bi-exclamation-triangle-fill text-xl text-red-600 dark:text-red-400"></i>
            </div>
            <div class="flex-1">
                <h3 class="text-sm font-bold text-red-900 dark:text-red-200 mb-2">
                    Please fix the following errors:
                </h3>
                <ul class="space-y-1">
                    @foreach($errors->all() as $error)
                    <li class="text-sm text-red-700 dark:text-red-300 flex items-start gap-2">
                        <i class="bi bi-x-circle mt-0.5 flex-shrink-0"></i>
                        <span>{{ $error }}</span>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endif
        
        <form action="{{ route('contribute.store') }}" method="POST" enctype="multipart/form-data" id="donateForm">
            @csrf
           
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 overflow-hidden mb-6">
                <div class="bg-gradient-to-r from-brand-50 to-sphere-secondary/10 dark:from-gray-800 dark:to-gray-800 border-b border-gray-200 dark:border-gray-700 p-5 md:p-6">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg bg-brand-100 dark:bg-brand-900/30 flex items-center justify-center">
                            <i class="bi bi-info-circle text-xl text-brand-600 dark:text-brand-400"></i>
                        </div>
                        <div>
                            <h2 class="text-lg font-bold text-gray-900 dark:text-white">Dataset Information</h2>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Basic details about your dataset</p>
                        </div>
                    </div>
                </div>
                
                <div class="p-5 md:p-6 space-y-5">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            <i class="bi bi-tag me-1 text-brand-500"></i>Dataset Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               name="name" 
                               value="{{ old('name') }}" 
                               required 
                               placeholder="e.g., Iris Flower Dataset"
                               class="w-full px-4 py-3 rounded-xl bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 transition-all @error('name') border-red-500 focus:border-red-500 focus:ring-red-500/20 @enderror">
                        @error('name')
                        <p class="mt-2 text-xs text-red-500 flex items-center gap-1">
                            <i class="bi bi-exclamation-circle"></i>{{ $message }}
                        </p>
                        @enderror
                    </div>
                    
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            <i class="bi bi-card-text me-1 text-brand-500"></i>Description <span class="text-red-500">*</span>
                        </label>
                        <textarea name="description" 
                                  rows="5" 
                                  required 
                                  placeholder="Provide a detailed description of your dataset, including its purpose, collection method, and potential applications..."
                                  class="w-full px-4 py-3 rounded-xl bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 transition-all resize-none @error('description') border-red-500 focus:border-red-500 focus:ring-red-500/20 @enderror">{{ old('description') }}</textarea>
                        <div class="flex justify-between mt-2">
                            @error('description')
                            <p class="text-xs text-red-500 flex items-center gap-1">
                                <i class="bi bi-exclamation-circle"></i>{{ $message }}
                            </p>
                            @else
                            <p class="text-xs text-gray-500 dark:text-gray-400">Be as detailed as possible</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 overflow-hidden mb-6">
                <div class="bg-gradient-to-r from-purple-50 to-sphere-secondary/10 dark:from-gray-800 dark:to-gray-800 border-b border-gray-200 dark:border-gray-700 p-5 md:p-6">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg bg-purple-100 dark:bg-purple-900/30 flex items-center justify-center">
                            <i class="bi bi-sliders text-xl text-purple-600 dark:text-purple-400"></i>
                        </div>
                        <div>
                            <h2 class="text-lg font-bold text-gray-900 dark:text-white">Dataset Properties</h2>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Technical characteristics of your dataset</p>
                        </div>
                    </div>
                </div>
                
                <div class="p-5 md:p-6 space-y-5">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                <i class="bi bi-bullseye me-1 text-purple-500"></i>Task Type <span class="text-red-500">*</span>
                            </label>
                            <select name="task_id" required 
                                    class="w-full px-4 py-3 rounded-xl bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-white focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 transition-all appearance-none cursor-pointer @error('task_id') border-red-500 @enderror">
                                <option value="">Select Task Type</option>
                                @foreach($tasks as $task)
                                <option value="{{ $task->task_id }}" {{ old('task_id') == $task->task_id ? 'selected' : '' }}>
                                    {{ $task->task_name }}
                                </option>
                                @endforeach
                            </select>
                            @error('task_id')
                            <p class="mt-2 text-xs text-red-500 flex items-center gap-1">
                                <i class="bi bi-exclamation-circle"></i>{{ $message }}
                            </p>
                            @enderror
                        </div>
                        
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                <i class="bi bi-folder me-1 text-purple-500"></i>Subject Area <span class="text-red-500">*</span>
                            </label>
                            <select name="subject_area_id" required 
                                    class="w-full px-4 py-3 rounded-xl bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-white focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 transition-all appearance-none cursor-pointer @error('subject_area_id') border-red-500 @enderror">
                                <option value="">Select Subject Area</option>
                                @foreach($subjectAreas as $area)
                                <option value="{{ $area->area_id }}" {{ old('subject_area_id') == $area->area_id ? 'selected' : '' }}>
                                    {{ $area->area_name }}
                                </option>
                                @endforeach
                            </select>
                            @error('subject_area_id')
                            <p class="mt-2 text-xs text-red-500 flex items-center gap-1">
                                <i class="bi bi-exclamation-circle"></i>{{ $message }}
                            </p>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                <i class="bi bi-diagram-3 me-1 text-purple-500"></i>Characteristics <span class="text-red-500">*</span>
                            </label>
                            <select name="characteristics" required 
                                    class="w-full px-4 py-3 rounded-xl bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-white focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 transition-all appearance-none cursor-pointer @error('characteristics') border-red-500 @enderror">
                                <option value="">Select Characteristics</option>
                                <option value="Multivariate" {{ old('characteristics') == 'Multivariate' ? 'selected' : '' }}>Multivariate</option>
                                <option value="Univariate" {{ old('characteristics') == 'Univariate' ? 'selected' : '' }}>Univariate</option>
                                <option value="Sequential" {{ old('characteristics') == 'Sequential' ? 'selected' : '' }}>Sequential</option>
                                <option value="Time-Series" {{ old('characteristics') == 'Time-Series' ? 'selected' : '' }}>Time-Series</option>
                                <option value="Spatial" {{ old('characteristics') == 'Spatial' ? 'selected' : '' }}>Spatial</option>
                                <option value="Text" {{ old('characteristics') == 'Text' ? 'selected' : '' }}>Text</option>
                                <option value="Domain-Theory" {{ old('characteristics') == 'Domain-Theory' ? 'selected' : '' }}>Domain-Theory</option>
                            </select>
                            @error('characteristics')
                            <p class="mt-2 text-xs text-red-500 flex items-center gap-1">
                                <i class="bi bi-exclamation-circle"></i>{{ $message }}
                            </p>
                            @enderror
                        </div>
                        
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                <i class="bi bi-layers me-1 text-purple-500"></i>Feature Type <span class="text-red-500">*</span>
                            </label>
                            <select name="feature_type" required 
                                    class="w-full px-4 py-3 rounded-xl bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-white focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 transition-all appearance-none cursor-pointer @error('feature_type') border-red-500 @enderror">
                                <option value="">Select Feature Type</option>
                                <option value="Continuous" {{ old('feature_type') == 'Continuous' ? 'selected' : '' }}>Continuous</option>
                                <option value="Categorical" {{ old('feature_type') == 'Categorical' ? 'selected' : '' }}>Categorical</option>
                                <option value="Integer" {{ old('feature_type') == 'Integer' ? 'selected' : '' }}>Integer</option>
                                <option value="Mixed" {{ old('feature_type') == 'Mixed' ? 'selected' : '' }}>Mixed</option>
                                <option value="Real" {{ old('feature_type') == 'Real' ? 'selected' : '' }}>Real</option>
                            </select>
                            @error('feature_type')
                            <p class="mt-2 text-xs text-red-500 flex items-center gap-1">
                                <i class="bi bi-exclamation-circle"></i>{{ $message }}
                            </p>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                <i class="bi bi-table me-1 text-purple-500"></i># Instances <span class="text-red-500">*</span>
                            </label>
                            <input type="number" 
                                   name="num_instances" 
                                   value="{{ old('num_instances') }}" 
                                   required 
                                   min="0"
                                   placeholder="e.g., 150"
                                   class="w-full px-4 py-3 rounded-xl bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 transition-all @error('num_instances') border-red-500 @enderror">
                            @error('num_instances')
                            <p class="mt-2 text-xs text-red-500 flex items-center gap-1">
                                <i class="bi bi-exclamation-circle"></i>{{ $message }}
                            </p>
                            @enderror
                        </div>
                        
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                <i class="bi bi-grid-3x3-gap me-1 text-purple-500"></i># Features <span class="text-red-500">*</span>
                            </label>
                            <input type="number" 
                                   name="num_features" 
                                   value="{{ old('num_features') }}" 
                                   required 
                                   min="0"
                                   placeholder="e.g., 4"
                                   class="w-full px-4 py-3 rounded-xl bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 transition-all @error('num_features') border-red-500 @enderror">
                            @error('num_features')
                            <p class="mt-2 text-xs text-red-500 flex items-center gap-1">
                                <i class="bi bi-exclamation-circle"></i>{{ $message }}
                            </p>
                            @enderror
                        </div>
                        
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                <i class="bi bi-question-circle me-1 text-purple-500"></i>Missing Values?
                            </label>
                            <select name="has_missing_values" 
                                    class="w-full px-4 py-3 rounded-xl bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-white focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 transition-all appearance-none cursor-pointer">
                                <option value="0" {{ old('has_missing_values', '0') == '0' ? 'selected' : '' }}>No</option>
                                <option value="1" {{ old('has_missing_values') == '1' ? 'selected' : '' }}>Yes</option>
                            </select>
                        </div>
                    </div>
                   
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            <i class="bi bi-shield-check me-1 text-purple-500"></i>License <span class="text-red-500">*</span>
                        </label>
                        <select name="license_id" required 
                                class="w-full px-4 py-3 rounded-xl bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-white focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 transition-all appearance-none cursor-pointer @error('license_id') border-red-500 @enderror">
                            <option value="">Select License</option>
                            @foreach($licenses as $license)
                            <option value="{{ $license->license_id }}" {{ old('license_id') == $license->license_id ? 'selected' : '' }}>
                                {{ $license->license_name }}
                            </option>
                            @endforeach
                        </select>
                        @error('license_id')
                        <p class="mt-2 text-xs text-red-500 flex items-center gap-1">
                            <i class="bi bi-exclamation-circle"></i>{{ $message }}
                        </p>
                        @enderror
                    </div>
                   
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">
                            <i class="bi bi-tags me-1 text-purple-500"></i>Keywords
                        </label>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mb-3">Select all keywords that apply to your dataset</p>
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-2">
                            @foreach($keywords as $keyword)
                            <label class="flex items-center gap-2 p-3 rounded-xl bg-gray-50 dark:bg-gray-700/30 border border-gray-200 dark:border-gray-700 hover:border-brand-500 hover:bg-brand-50 dark:hover:bg-brand-900/20 cursor-pointer transition-all group">
                                <input class="w-4 h-4 rounded border-gray-300 dark:border-gray-600 text-brand-600 focus:ring-brand-500" 
                                       type="checkbox" 
                                       name="keywords[]" 
                                       value="{{ $keyword->keyword_id }}" 
                                       id="kw_{{ $keyword->keyword_id }}"
                                       {{ in_array($keyword->keyword_id, old('keywords', [])) ? 'checked' : '' }}>
                                <span class="text-sm text-gray-700 dark:text-gray-300 group-hover:text-brand-600 dark:group-hover:text-brand-400 transition-colors">
                                    {{ $keyword->keyword_name }}
                                </span>
                            </label>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
           
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 overflow-hidden mb-6">
                <div class="bg-gradient-to-r from-green-50 to-emerald-50 dark:from-gray-800 dark:to-gray-800 border-b border-gray-200 dark:border-gray-700 p-5 md:p-6">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg bg-green-100 dark:bg-green-900/30 flex items-center justify-center">
                            <i class="bi bi-upload text-xl text-green-600 dark:text-green-400"></i>
                        </div>
                        <div>
                            <h2 class="text-lg font-bold text-gray-900 dark:text-white">Upload Dataset Files</h2>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Upload your dataset files in supported formats</p>
                        </div>
                    </div>
                </div>
                
                <div class="p-5 md:p-6 space-y-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            <i class="bi bi-file-earmark-zip me-1 text-green-500"></i>Data Files <span class="text-red-500">*</span>
                        </label>
                        
                        <div id="dropZone" class="relative border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-xl p-8 text-center hover:border-brand-500 hover:bg-brand-50/50 dark:hover:bg-brand-900/10 transition-all cursor-pointer">
                            <input type="file" 
                                   name="data_files[]" 
                                   id="fileInput"
                                   class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" 
                                   multiple 
                                   accept=".csv,.txt,.arff,.json,.zip"
                                   required>
                            
                            <div id="dropContent">
                                <div class="w-16 h-16 mx-auto mb-4 rounded-2xl bg-gradient-to-br from-green-100 to-emerald-100 dark:from-green-900/30 dark:to-emerald-900/30 flex items-center justify-center">
                                    <i class="bi bi-cloud-arrow-up text-3xl text-green-600 dark:text-green-400"></i>
                                </div>
                                <p class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">
                                    Drop files here or click to browse
                                </p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                    Supported: CSV, ARFF, TXT, JSON, ZIP • Max 50MB per file
                                </p>
                            </div>
                        </div>
                        
                        <div id="fileList" class="mt-3 space-y-2 hidden"></div>
                    </div>
                   
                    <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-xl p-4 flex items-start gap-3">
                        <div class="flex-shrink-0 w-8 h-8 rounded-lg bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center">
                            <i class="bi bi-info-circle text-lg text-blue-600 dark:text-blue-400"></i>
                        </div>
                        <div class="flex-1 text-sm text-blue-800 dark:text-blue-200">
                            <strong class="font-semibold">Note:</strong> Variables (columns) will be automatically extracted from the first uploaded CSV file.
                        </div>
                    </div>
                </div>
            </div>
          
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 p-5 md:p-6 sticky bottom-4">
                <div class="flex flex-col sm:flex-row items-center justify-between gap-3">
                    <a href="{{ route('profile.datasets') }}" 
                       class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200 font-semibold hover:bg-gray-200 dark:hover:bg-gray-600 transition-all">
                        <i class="bi bi-arrow-left"></i>
                        <span>Cancel</span>
                    </a>
                    
                    <button type="submit" 
                            id="submitBtn"
                            class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-8 py-3 rounded-xl bg-gradient-to-r from-brand-600 to-sphere-secondary text-white font-bold shadow-lg hover:shadow-xl hover:shadow-brand-500/30 hover:-translate-y-0.5 transition-all">
                        <i class="bi bi-check-circle-fill"></i>
                        <span>Submit Dataset</span>
                    </button>
                </div>
            </div>
            
        </form>
        
    </div>
</div>

@push('scripts')
<script>
    const fileInput = document.getElementById('fileInput');
    const fileList = document.getElementById('fileList');
    const dropZone = document.getElementById('dropZone');
    const dropContent = document.getElementById('dropContent');
    
    function formatFileSize(bytes) {
        if (bytes === 0) return '0 Bytes';
        const k = 1024;
        const sizes = ['Bytes', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return Math.round(bytes / Math.pow(k, i) * 100) / 100 + ' ' + sizes[i];
    }
    
    function getFileIcon(filename) {
        const ext = filename.split('.').pop().toLowerCase();
        const icons = {
            'csv': 'bi-filetype-csv text-green-600',
            'txt': 'bi-filetype-txt text-gray-600',
            'arff': 'bi-file-earmark-code text-purple-600',
            'json': 'bi-filetype-json text-yellow-600',
            'zip': 'bi-file-earmark-zip text-blue-600'
        };
        return icons[ext] || 'bi-file-earmark text-gray-600';
    }
    
    function renderFileList(files) {
        if (files.length === 0) {
            fileList.classList.add('hidden');
            fileList.innerHTML = '';
            return;
        }
        
        fileList.classList.remove('hidden');
        fileList.innerHTML = files.map((file, index) => `
            <div class="flex items-center gap-3 p-3 rounded-xl bg-gray-50 dark:bg-gray-700/30 border border-gray-200 dark:border-gray-700">
                <div class="flex-shrink-0 w-10 h-10 rounded-lg bg-white dark:bg-gray-800 flex items-center justify-center">
                    <i class="bi ${getFileIcon(file.name)} text-xl"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-semibold text-gray-900 dark:text-white truncate">${file.name}</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400">${formatFileSize(file.size)}</p>
                </div>
                <button type="button" onclick="removeFile(${index})" class="flex-shrink-0 w-8 h-8 rounded-lg bg-red-50 dark:bg-red-900/20 text-red-600 dark:text-red-400 flex items-center justify-center hover:bg-red-100 dark:hover:bg-red-900/40 transition-colors">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>
        `).join('');
    }
    
    function removeFile(index) {
        const dt = new DataTransfer();
        for (let i = 0; i < fileInput.files.length; i++) {
            if (i !== index) dt.items.add(fileInput.files[i]);
        }
        fileInput.files = dt.files;
        renderFileList(fileInput.files);
    }
    
    fileInput.addEventListener('change', function(e) {
        renderFileList(e.target.files);
    });
    
    ['dragenter', 'dragover'].forEach(eventName => {
        dropZone.addEventListener(eventName, (e) => {
            e.preventDefault();
            dropZone.classList.add('border-brand-500', 'bg-brand-50/50', 'dark:bg-brand-900/10');
        });
    });
    
    ['dragleave', 'drop'].forEach(eventName => {
        dropZone.addEventListener(eventName, (e) => {
            e.preventDefault();
            dropZone.classList.remove('border-brand-500', 'bg-brand-50/50', 'dark:bg-brand-900/10');
        });
    });
    
    document.getElementById('donateForm').addEventListener('submit', function(e) {
        const btn = document.getElementById('submitBtn');
        btn.disabled = true;
        btn.innerHTML = `
            <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            <span>Submitting...</span>
        `;
    });
</script>
@endpush
@endsection