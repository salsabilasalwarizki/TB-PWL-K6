@extends('layouts.app')
@section('title', 'Donate Dataset - DataSphere ML Repository')
@section('meta_desc', 'Donate your dataset to the DataSphere Machine Learning Repository')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 via-brand-50/30 to-sphere-secondary/10 dark:from-gray-900 dark:via-gray-900 dark:to-gray-900 py-8 md:py-12 px-4 sm:px-6 lg:px-8">
    
    <!-- Background Decoration -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-20 left-10 w-72 h-72 bg-brand-500/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-20 right-10 w-96 h-96 bg-sphere-secondary/10 rounded-full blur-3xl"></div>
    </div>
    
    <div class="relative max-w-4xl mx-auto">
        
        <!-- Breadcrumb -->
        <nav class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-400 mb-6">
            <a href="{{ route('home') }}" class="hover:text-brand-600 dark:hover:text-brand-400 transition-colors">Home</a>
            <i class="bi bi-chevron-right text-xs"></i>
            <a href="{{ route('profile') }}" class="hover:text-brand-600 dark:hover:text-brand-400 transition-colors">Profile</a>
            <i class="bi bi-chevron-right text-xs"></i>
            <a href="{{ route('profile.datasets') }}" class="hover:text-brand-600 dark:hover:text-brand-400 transition-colors">My Datasets</a>
            <i class="bi bi-chevron-right text-xs"></i>
            <span class="text-brand-600 dark:text-brand-400 font-semibold">Donate Dataset</span>
        </nav>
        
        <!-- Header Card -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 overflow-hidden mb-6">
            <div class="bg-gradient-to-r from-brand-600 to-sphere-secondary p-8 md:p-10">
                <div class="flex items-center gap-4 mb-4">
                    <div class="w-14 h-14 rounded-xl bg-white/20 backdrop-blur-sm flex items-center justify-center">
                        <i class="bi bi-cloud-arrow-up text-3xl text-white"></i>
                    </div>
                    <div>
                        <h1 class="text-3xl md:text-4xl font-bold text-white">
                            Dataset Donation Form
                        </h1>
                        <p class="text-white/90 text-sm md:text-base mt-1">
                            Step 1 of 7 — Basic Information
                        </p>
                    </div>
                </div>
            </div>
            
            <!-- Description -->
            <div class="p-6 md:p-8 border-b border-gray-100 dark:border-gray-700">
                <p class="text-sm text-gray-700 dark:text-gray-300 leading-relaxed mb-2">
                    We offer users the option to upload their dataset data to our repository.
                </p>
                <p class="text-sm text-gray-700 dark:text-gray-300 leading-relaxed">
                    Users can provide tabular or non-tabular dataset data which will be made publicly available on our repository. 
                    Donators are free to edit their donated datasets, but edits must be approved before finalizing.
                </p>
            </div>
            
            <!-- Modern Progress Bar -->
            <div class="p-6 md:p-8 bg-gradient-to-r from-amber-50 to-orange-50 dark:from-gray-800 dark:to-gray-800">
                <div class="flex items-center justify-between mb-3">
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 rounded-full bg-gradient-to-br from-amber-500 to-orange-500 flex items-center justify-center text-white font-bold text-sm">
                            1
                        </div>
                        <span class="text-sm font-bold text-gray-900 dark:text-white">Basic Info</span>
                    </div>
                    <span class="text-xs font-semibold text-amber-700 dark:text-amber-400 bg-amber-100 dark:bg-amber-900/30 px-3 py-1 rounded-full">
                        Page 1 / 7
                    </span>
                </div>
                
                <!-- Step indicators -->
                <div class="hidden md:flex items-center gap-1 mb-3">
                    @for($i = 1; $i <= 7; $i++)
                        <div class="flex-1 h-2 rounded-full {{ $i === 1 ? 'bg-gradient-to-r from-amber-500 to-orange-500' : 'bg-gray-200 dark:bg-gray-700' }}"></div>
                    @endfor
                </div>
                <div class="md:hidden h-2 rounded-full bg-gray-200 dark:bg-gray-700 overflow-hidden">
                    <div class="h-full bg-gradient-to-r from-amber-500 to-orange-500" style="width: 14.28%"></div>
                </div>
                
                <!-- Step labels -->
                <div class="hidden md:grid grid-cols-7 gap-1 mt-2 text-[10px] text-gray-500 dark:text-gray-400">
                    <span class="text-center font-semibold text-amber-700 dark:text-amber-400">Basic</span>
                    <span class="text-center">Paper</span>
                    <span class="text-center">Creators</span>
                    <span class="text-center">Files</span>
                    <span class="text-center">Keywords</span>
                    <span class="text-center">Variables</span>
                    <span class="text-center">Descriptive</span>
                </div>
            </div>
        </div>
        
        <!-- Error Alert -->
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
        
        <form action="{{ route('contribute.metadata.store') }}" method="POST" enctype="multipart/form-data" id="donationForm">
            @csrf
            
            <!-- ============================================ -->
            <!-- SECTION 1: Basic Info -->
            <!-- ============================================ -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 overflow-hidden mb-6">
                <div class="bg-gradient-to-r from-brand-50 to-sphere-secondary/10 dark:from-gray-800 dark:to-gray-800 border-b border-gray-200 dark:border-gray-700 p-5 md:p-6">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg bg-brand-100 dark:bg-brand-900/30 flex items-center justify-center">
                            <i class="bi bi-info-circle text-xl text-brand-600 dark:text-brand-400"></i>
                        </div>
                        <div>
                            <h2 class="text-lg font-bold text-gray-900 dark:text-white">Basic Info</h2>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Core information about your dataset</p>
                        </div>
                    </div>
                </div>
                
                <div class="p-5 md:p-6 space-y-5">
                    <!-- Dataset Name -->
                    <div>
                        <label for="name" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            <i class="bi bi-tag me-1 text-brand-500"></i>Dataset Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               id="name" 
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
                    
                    <!-- Abstract -->
                    <div>
                        <label for="abstract" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            <i class="bi bi-card-text me-1 text-brand-500"></i>Abstract <span class="text-red-500">*</span>
                        </label>
                        <textarea id="abstract" 
                                  name="abstract" 
                                  rows="4" 
                                  required
                                  maxlength="1000"
                                  oninput="updateCharCount(this, 1000)"
                                  placeholder="Provide a detailed abstract describing your dataset, its purpose, collection method, and potential applications..."
                                  class="w-full px-4 py-3 rounded-xl bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 transition-all resize-none @error('abstract') border-red-500 focus:border-red-500 focus:ring-red-500/20 @enderror">{{ old('abstract') }}</textarea>
                        <div class="flex justify-between mt-2">
                            @error('abstract')
                            <p class="text-xs text-red-500 flex items-center gap-1">
                                <i class="bi bi-exclamation-circle"></i>{{ $message }}
                            </p>
                            @else
                            <p class="text-xs text-gray-500 dark:text-gray-400">Maximum 1000 characters</p>
                            @enderror
                            <p class="text-xs text-gray-500 dark:text-gray-400 ml-auto">
                                <span id="charCount">{{ strlen(old('abstract', '')) }}</span>/1000
                            </p>
                        </div>
                    </div>
                    
                    <!-- Numeric Stats -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="num_instances" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                <i class="bi bi-table me-1 text-brand-500"></i>Number of Instances (Rows) <span class="text-red-500">*</span>
                            </label>
                            <input type="number" 
                                   id="num_instances" 
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
                            <label for="num_features" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                <i class="bi bi-grid-3x3-gap me-1 text-brand-500"></i>Number of Features
                            </label>
                            <input type="number" 
                                   id="num_features" 
                                   name="num_features" 
                                   value="{{ old('num_features') }}" 
                                   min="0"
                                   placeholder="e.g., 4"
                                   class="w-full px-4 py-3 rounded-xl bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 transition-all @error('num_features') border-red-500 @enderror">
                            @error('num_features')
                            <p class="mt-2 text-xs text-red-500 flex items-center gap-1">
                                <i class="bi bi-exclamation-circle"></i>{{ $message }}
                            </p>
                            @enderror
                        </div>
                    </div>
                    
                    <!-- DOI -->
                    <div>
                        <label for="doi" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            <i class="bi bi-upc-scan me-1 text-brand-500"></i>Dataset DOI
                        </label>
                        <input type="text" 
                               id="doi" 
                               name="doi" 
                               value="{{ old('doi') }}"
                               placeholder="e.g., 10.24433/CO.1234567"
                               class="w-full px-4 py-3 rounded-xl bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 transition-all">
                        <p class="mt-2 text-xs text-gray-500 dark:text-gray-400 flex items-center gap-1">
                            <i class="bi bi-info-circle"></i>
                            If a DOI is not provided, one will be generated for the dataset.
                        </p>
                    </div>
                    
                    <!-- Graphics Upload -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            <i class="bi bi-image me-1 text-brand-500"></i>Graphics
                            <span class="inline-flex items-center gap-1 ml-2 text-xs font-normal text-gray-500 dark:text-gray-400" title="Upload a representative image for your dataset">
                                <i class="bi bi-info-circle"></i>
                            </span>
                        </label>
                        
                        <div id="graphicsDropZone" class="relative border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-xl p-8 text-center hover:border-brand-500 hover:bg-brand-50/50 dark:hover:bg-brand-900/10 transition-all cursor-pointer">
                            <input type="file" 
                                   id="graphics" 
                                   name="graphics" 
                                   class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" 
                                   accept="image/*">
                            
                            <div id="graphicsContent">
                                <div class="w-16 h-16 mx-auto mb-4 rounded-2xl bg-gradient-to-br from-brand-100 to-sphere-secondary/20 dark:from-brand-900/30 dark:to-sphere-secondary/30 flex items-center justify-center">
                                    <i class="bi bi-cloud-arrow-up text-3xl text-brand-600 dark:text-brand-400"></i>
                                </div>
                                <p class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">
                                    Choose a file or drag and drop here
                                </p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                    PNG, JPG, GIF up to 5MB
                                </p>
                            </div>
                            
                            <!-- Preview Container -->
                            <div id="graphics-preview" class="hidden"></div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- ============================================ -->
            <!-- SECTION 2: Dataset Characteristics -->
            <!-- ============================================ -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 overflow-hidden mb-6">
                <div class="bg-gradient-to-r from-purple-50 to-sphere-secondary/10 dark:from-gray-800 dark:to-gray-800 border-b border-gray-200 dark:border-gray-700 p-5 md:p-6">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg bg-purple-100 dark:bg-purple-900/30 flex items-center justify-center">
                            <i class="bi bi-diagram-3 text-xl text-purple-600 dark:text-purple-400"></i>
                        </div>
                        <div>
                            <h2 class="text-lg font-bold text-gray-900 dark:text-white">
                                Dataset Characteristics <span class="text-red-500">*</span>
                            </h2>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Select all that apply</p>
                        </div>
                    </div>
                </div>
                
                <div class="p-5 md:p-6">
                    @php
                        $characteristics = [
                            'Tabular' => ['icon' => 'bi-table', 'desc' => 'Structured rows and columns'],
                            'Sequential' => ['icon' => 'bi-list-ol', 'desc' => 'Ordered data sequences'],
                            'Multivariate' => ['icon' => 'bi-grid-3x3', 'desc' => 'Multiple variables'],
                            'Time-Series' => ['icon' => 'bi-graph-up', 'desc' => 'Time-based measurements'],
                            'Text' => ['icon' => 'bi-file-text', 'desc' => 'Textual data'],
                            'Image' => ['icon' => 'bi-image', 'desc' => 'Image data'],
                            'Spatiotemporal' => ['icon' => 'bi-geo-alt', 'desc' => 'Spatial and temporal data'],
                            'Other' => ['icon' => 'bi-three-dots', 'desc' => 'Other type'],
                        ];
                    @endphp
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        @foreach($characteristics as $char => $meta)
                        <label class="group flex items-start gap-3 p-4 rounded-xl bg-gray-50 dark:bg-gray-700/30 border-2 border-gray-200 dark:border-gray-700 hover:border-purple-500 hover:bg-purple-50 dark:hover:bg-purple-900/10 cursor-pointer transition-all has-[:checked]:border-purple-500 has-[:checked]:bg-purple-50 dark:has-[:checked]:bg-purple-900/20">
                            <input type="checkbox" 
                                   name="characteristics[]" 
                                   value="{{ $char }}" 
                                   id="char_{{ $char }}"
                                   class="mt-0.5 w-5 h-5 rounded border-gray-300 dark:border-gray-600 text-purple-600 focus:ring-purple-500"
                                   {{ in_array($char, old('characteristics', [])) ? 'checked' : '' }}>
                            <div class="flex-1">
                                <div class="flex items-center gap-2">
                                    <i class="bi {{ $meta['icon'] }} text-purple-600 dark:text-purple-400"></i>
                                    <span class="text-sm font-semibold text-gray-900 dark:text-white group-hover:text-purple-700 dark:group-hover:text-purple-300">{{ $char }}</span>
                                </div>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">{{ $meta['desc'] }}</p>
                            </div>
                        </label>
                        @endforeach
                    </div>
                    
                    @error('characteristics')
                    <p class="mt-3 text-xs text-red-500 flex items-center gap-1">
                        <i class="bi bi-exclamation-circle"></i>{{ $message }}
                    </p>
                    @enderror
                </div>
            </div>
            
            <!-- ============================================ -->
            <!-- SECTION 3: Subject Area -->
            <!-- ============================================ -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 overflow-hidden mb-6">
                <div class="bg-gradient-to-r from-green-50 to-emerald-50 dark:from-gray-800 dark:to-gray-800 border-b border-gray-200 dark:border-gray-700 p-5 md:p-6">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg bg-green-100 dark:bg-green-900/30 flex items-center justify-center">
                            <i class="bi bi-folder-fill text-xl text-green-600 dark:text-green-400"></i>
                        </div>
                        <div>
                            <h2 class="text-lg font-bold text-gray-900 dark:text-white">
                                Subject Area <span class="text-red-500">*</span>
                            </h2>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Choose the primary domain</p>
                        </div>
                    </div>
                </div>
                
                <div class="p-5 md:p-6">
                    @php
                        $subjectAreas = [
                            'Biology' => 'bi-heart-pulse',
                            'Business' => 'bi-briefcase',
                            'Climate and Environment' => 'bi-cloud-sun',
                            'Computer Science' => 'bi-cpu',
                            'Engineering' => 'bi-gear',
                            'Games' => 'bi-controller',
                            'Health and Medicine' => 'bi-hospital',
                            'Law' => 'bi-bank',
                            'Physics and Chemistry' => 'bi-atom',
                            'Social Science' => 'bi-people',
                            'Other' => 'bi-three-dots',
                        ];
                    @endphp
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                        @foreach($subjectAreas as $area => $icon)
                        <label class="group flex items-center gap-3 p-3 rounded-xl bg-gray-50 dark:bg-gray-700/30 border-2 border-gray-200 dark:border-gray-700 hover:border-green-500 hover:bg-green-50 dark:hover:bg-green-900/10 cursor-pointer transition-all has-[:checked]:border-green-500 has-[:checked]:bg-green-50 dark:has-[:checked]:bg-green-900/20">
                            <input type="radio" 
                                   name="subject_area" 
                                   value="{{ $area }}" 
                                   id="area_{{ $loop->index }}"
                                   class="w-4 h-4 border-gray-300 dark:border-gray-600 text-green-600 focus:ring-green-500"
                                   {{ old('subject_area') == $area ? 'checked' : '' }}>
                            <i class="bi {{ $icon }} text-green-600 dark:text-green-400"></i>
                            <span class="text-sm font-medium text-gray-900 dark:text-white group-hover:text-green-700 dark:group-hover:text-green-300">{{ $area }}</span>
                        </label>
                        @endforeach
                    </div>
                    
                    @error('subject_area')
                    <p class="mt-3 text-xs text-red-500 flex items-center gap-1">
                        <i class="bi bi-exclamation-circle"></i>{{ $message }}
                    </p>
                    @enderror
                </div>
            </div>
            
            <!-- ============================================ -->
            <!-- SECTION 4: Associated Tasks -->
            <!-- ============================================ -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 overflow-hidden mb-6">
                <div class="bg-gradient-to-r from-cyan-50 to-blue-50 dark:from-gray-800 dark:to-gray-800 border-b border-gray-200 dark:border-gray-700 p-5 md:p-6">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg bg-cyan-100 dark:bg-cyan-900/30 flex items-center justify-center">
                            <i class="bi bi-bullseye text-xl text-cyan-600 dark:text-cyan-400"></i>
                        </div>
                        <div>
                            <h2 class="text-lg font-bold text-gray-900 dark:text-white">
                                Associated Tasks <span class="text-red-500">*</span>
                            </h2>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Select all applicable tasks</p>
                        </div>
                    </div>
                </div>
                
                <div class="p-5 md:p-6">
                    @php
                        $tasks = [
                            'Classification' => ['icon' => 'bi-diagram-2', 'desc' => 'Categorize data into classes'],
                            'Regression' => ['icon' => 'bi-graph-up-arrow', 'desc' => 'Predict continuous values'],
                            'Clustering' => ['icon' => 'bi-diagram-3', 'desc' => 'Group similar data points'],
                            'Other' => ['icon' => 'bi-three-dots', 'desc' => 'Other task type'],
                        ];
                    @endphp
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        @foreach($tasks as $task => $meta)
                        <label class="group flex items-start gap-3 p-4 rounded-xl bg-gray-50 dark:bg-gray-700/30 border-2 border-gray-200 dark:border-gray-700 hover:border-cyan-500 hover:bg-cyan-50 dark:hover:bg-cyan-900/10 cursor-pointer transition-all has-[:checked]:border-cyan-500 has-[:checked]:bg-cyan-50 dark:has-[:checked]:bg-cyan-900/20">
                            <input type="checkbox" 
                                   name="associated_tasks[]" 
                                   value="{{ $task }}" 
                                   id="task_{{ $task }}"
                                   class="mt-0.5 w-5 h-5 rounded border-gray-300 dark:border-gray-600 text-cyan-600 focus:ring-cyan-500"
                                   {{ in_array($task, old('associated_tasks', [])) ? 'checked' : '' }}>
                            <div class="flex-1">
                                <div class="flex items-center gap-2">
                                    <i class="bi {{ $meta['icon'] }} text-cyan-600 dark:text-cyan-400"></i>
                                    <span class="text-sm font-semibold text-gray-900 dark:text-white group-hover:text-cyan-700 dark:group-hover:text-cyan-300">{{ $task }}</span>
                                </div>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">{{ $meta['desc'] }}</p>
                            </div>
                        </label>
                        @endforeach
                    </div>
                    
                    @error('associated_tasks')
                    <p class="mt-3 text-xs text-red-500 flex items-center gap-1">
                        <i class="bi bi-exclamation-circle"></i>{{ $message }}
                    </p>
                    @enderror
                </div>
            </div>
            
            <!-- ============================================ -->
            <!-- SECTION 5: Feature Types -->
            <!-- ============================================ -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 overflow-hidden mb-6">
                <div class="bg-gradient-to-r from-amber-50 to-yellow-50 dark:from-gray-800 dark:to-gray-800 border-b border-gray-200 dark:border-gray-700 p-5 md:p-6">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg bg-amber-100 dark:bg-amber-900/30 flex items-center justify-center">
                            <i class="bi bi-layers text-xl text-amber-600 dark:text-amber-400"></i>
                        </div>
                        <div>
                            <h2 class="text-lg font-bold text-gray-900 dark:text-white">Feature Types</h2>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Select all that apply (optional)</p>
                        </div>
                    </div>
                </div>
                
                <div class="p-5 md:p-6">
                    @php
                        $featureTypes = [
                            'Real' => ['icon' => 'bi-hash', 'desc' => 'Continuous real numbers'],
                            'Categorical' => ['icon' => 'bi-tags', 'desc' => 'Discrete categories'],
                            'Integer' => ['icon' => 'bi-123', 'desc' => 'Whole numbers'],
                        ];
                    @endphp
                    
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                        @foreach($featureTypes as $ftype => $meta)
                        <label class="group flex items-start gap-3 p-4 rounded-xl bg-gray-50 dark:bg-gray-700/30 border-2 border-gray-200 dark:border-gray-700 hover:border-amber-500 hover:bg-amber-50 dark:hover:bg-amber-900/10 cursor-pointer transition-all has-[:checked]:border-amber-500 has-[:checked]:bg-amber-50 dark:has-[:checked]:bg-amber-900/20">
                            <input type="checkbox" 
                                   name="feature_types[]" 
                                   value="{{ $ftype }}" 
                                   id="ftype_{{ $ftype }}"
                                   class="mt-0.5 w-5 h-5 rounded border-gray-300 dark:border-gray-600 text-amber-600 focus:ring-amber-500"
                                   {{ in_array($ftype, old('feature_types', [])) ? 'checked' : '' }}>
                            <div class="flex-1">
                                <div class="flex items-center gap-2">
                                    <i class="bi {{ $meta['icon'] }} text-amber-600 dark:text-amber-400"></i>
                                    <span class="text-sm font-semibold text-gray-900 dark:text-white group-hover:text-amber-700 dark:group-hover:text-amber-300">{{ $ftype }}</span>
                                </div>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">{{ $meta['desc'] }}</p>
                            </div>
                        </label>
                        @endforeach
                    </div>
                </div>
            </div>
            
            <!-- ============================================ -->
            <!-- Navigation -->
            <!-- ============================================ -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 p-5 md:p-6 sticky bottom-4">
                <div class="flex flex-col sm:flex-row items-center justify-between gap-3">
                    <a href="{{ route('profile.datasets') }}" 
                       class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200 font-semibold hover:bg-gray-200 dark:hover:bg-gray-600 transition-all">
                        <i class="bi bi-arrow-left"></i>
                        <span>Cancel</span>
                    </a>
                    
                    <div class="flex items-center gap-3 w-full sm:w-auto">
                        <span class="text-xs text-gray-500 dark:text-gray-400 hidden sm:inline">
                            Step 1 of 7
                        </span>
                        <button type="submit" 
                                id="nextBtn"
                                class="flex-1 sm:flex-none inline-flex items-center justify-center gap-2 px-8 py-3 rounded-xl bg-gradient-to-r from-brand-600 to-sphere-secondary text-white font-bold shadow-lg hover:shadow-xl hover:shadow-brand-500/30 hover:-translate-y-0.5 transition-all">
                            <span>NEXT</span>
                            <i class="bi bi-arrow-right"></i>
                        </button>
                    </div>
                </div>
            </div>
            
        </form>
        
    </div>
</div>

@push('scripts')
<script>
    // Character counter for abstract
    function updateCharCount(textarea, max) {
        const count = textarea.value.length;
        document.getElementById('charCount').textContent = count;
    }
    
    // Graphics upload preview
    const graphicsInput = document.getElementById('graphics');
    const graphicsContent = document.getElementById('graphicsContent');
    const graphicsPreview = document.getElementById('graphics-preview');
    const graphicsDropZone = document.getElementById('graphicsDropZone');
    
    graphicsInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                graphicsContent.classList.add('hidden');
                graphicsPreview.classList.remove('hidden');
                graphicsPreview.innerHTML = `
                    <div class="relative inline-block">
                        <img src="${e.target.result}" alt="Preview" class="max-w-xs rounded-xl border-2 border-brand-500 shadow-lg">
                        <button type="button" onclick="removeGraphics()" class="absolute -top-2 -right-2 w-8 h-8 rounded-full bg-red-500 text-white flex items-center justify-center hover:bg-red-600 shadow-lg">
                            <i class="bi bi-x-lg"></i>
                        </button>
                        <div class="mt-2 text-xs text-gray-600 dark:text-gray-400">
                            <i class="bi bi-file-earmark-image"></i> ${file.name}
                        </div>
                    </div>
                `;
            };
            reader.readAsDataURL(file);
        }
    });
    
    function removeGraphics() {
        graphicsInput.value = '';
        graphicsContent.classList.remove('hidden');
        graphicsPreview.classList.add('hidden');
        graphicsPreview.innerHTML = '';
    }
    
    // Drag & drop visual feedback
    ['dragenter', 'dragover'].forEach(eventName => {
        graphicsDropZone.addEventListener(eventName, (e) => {
            e.preventDefault();
            graphicsDropZone.classList.add('border-brand-500', 'bg-brand-50/50', 'dark:bg-brand-900/10');
        });
    });
    
    ['dragleave', 'drop'].forEach(eventName => {
        graphicsDropZone.addEventListener(eventName, (e) => {
            e.preventDefault();
            graphicsDropZone.classList.remove('border-brand-500', 'bg-brand-50/50', 'dark:bg-brand-900/10');
        });
    });
    
    // Form submission loading state
    document.getElementById('donationForm').addEventListener('submit', function(e) {
        const btn = document.getElementById('nextBtn');
        btn.disabled = true;
        btn.innerHTML = `
            <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            <span>Processing...</span>
        `;
    });
</script>
@endpush
@endsection