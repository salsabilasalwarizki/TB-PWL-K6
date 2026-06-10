@extends('layouts.app')
@section('title', 'Final Submission - DataSphere ML Repository')
@section('meta_desc', 'Step 7: Final review and submit your dataset')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 via-brand-50/30 to-sphere-secondary/10 dark:from-gray-900 dark:via-gray-900 dark:to-gray-900 py-8 md:py-12 px-4 sm:px-6 lg:px-8">
    
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-20 left-10 w-72 h-72 bg-brand-500/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-20 right-10 w-96 h-96 bg-sphere-secondary/10 rounded-full blur-3xl"></div>
    </div>
    
    <div class="relative max-w-4xl mx-auto">
       
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
            <div class="bg-gradient-to-r from-emerald-600 via-green-600 to-teal-600 p-8 md:p-10">
                <div class="flex items-center gap-4 mb-4">
                    <div class="w-14 h-14 rounded-xl bg-white/20 backdrop-blur-sm flex items-center justify-center">
                        <i class="bi bi-check2-circle text-3xl text-white"></i>
                    </div>
                    <div>
                        <h1 class="text-3xl md:text-4xl font-bold text-white">
                            Dataset Donation Form
                        </h1>
                        <p class="text-white/90 text-sm md:text-base mt-1">
                            Step 7 of 7 — Final Submission
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="p-6 md:p-8 bg-gradient-to-r from-emerald-50 to-green-50 dark:from-gray-800 dark:to-gray-800">
                <div class="flex items-center justify-between mb-3">
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 rounded-full bg-gradient-to-br from-emerald-500 to-green-500 flex items-center justify-center text-white font-bold text-sm shadow-md">
                            <i class="bi bi-check-lg"></i>
                        </div>
                        <span class="text-sm font-bold text-gray-900 dark:text-white">Final Submission</span>
                    </div>
                    <span class="text-xs font-semibold text-emerald-700 dark:text-emerald-400 bg-emerald-100 dark:bg-emerald-900/30 px-3 py-1 rounded-full flex items-center gap-1">
                        <i class="bi bi-check-circle-fill"></i>
                        Complete
                    </span>
                </div>
              
                <div class="hidden md:flex items-center gap-1 mb-3">
                    @for($i = 1; $i <= 7; $i++)
                        <div class="flex-1 h-2 rounded-full bg-gradient-to-r from-emerald-500 to-green-500"></div>
                    @endfor
                </div>
                <div class="md:hidden h-2 rounded-full bg-gray-200 dark:bg-gray-700 overflow-hidden">
                    <div class="h-full bg-gradient-to-r from-emerald-500 to-green-500" style="width: 100%"></div>
                </div>
                
                <div class="hidden md:grid grid-cols-7 gap-1 mt-2 text-[10px] text-emerald-700 dark:text-emerald-400 font-semibold">
                    <span class="text-center">Basic</span>
                    <span class="text-center">Paper</span>
                    <span class="text-center">Creators</span>
                    <span class="text-center">Files</span>
                    <span class="text-center">Keywords</span>
                    <span class="text-center">Variables</span>
                    <span class="text-center">Submit</span>
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
                    Form tidak bisa disubmit:
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
        
        <form action="{{ route('contribute.submit') }}" method="POST" enctype="multipart/form-data" id="donationForm">
            @csrf
            
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 overflow-hidden mb-6">
                <div class="bg-gradient-to-r from-emerald-50 to-green-50 dark:from-gray-800 dark:to-gray-800 border-b border-gray-200 dark:border-gray-700 p-5 md:p-6">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg bg-emerald-100 dark:bg-emerald-900/30 flex items-center justify-center">
                            <i class="bi bi-journal-text text-xl text-emerald-600 dark:text-emerald-400"></i>
                        </div>
                        <div>
                            <h2 class="text-lg font-bold text-gray-900 dark:text-white">Descriptive Questions</h2>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Provide detailed information about your dataset</p>
                        </div>
                    </div>
                </div>
                
                <div class="p-5 md:p-6 space-y-5">
                   
                    <div>
                        <label for="purpose" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            <i class="bi bi-bullseye me-1 text-emerald-500"></i>
                            For what purpose was the dataset created? <span class="text-red-500">*</span>
                        </label>
                        <textarea 
                            id="purpose" 
                            name="purpose" 
                            rows="3"
                            required
                            maxlength="2000"
                            placeholder="e.g., This dataset was created for research on machine learning algorithms for classification tasks..."
                            class="desc-textarea w-full px-4 py-3 rounded-xl bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 transition-all resize-none @error('purpose') border-red-500 @enderror">{{ old('purpose', $data['descriptive']['purpose'] ?? '') }}</textarea>
                        <div class="flex justify-between mt-1.5">
                            <p class="text-xs text-gray-500 dark:text-gray-400">Describe the main purpose and motivation</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400 char-counter">0 / 2000</p>
                        </div>
                        @error('purpose')
                        <p class="mt-1 text-xs text-red-500 flex items-center gap-1"><i class="bi bi-exclamation-circle"></i>{{ $message }}</p>
                        @enderror
                    </div>
                  
                    <div>
                        <label for="funding" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            <i class="bi bi-cash-stack me-1 text-emerald-500"></i>
                            Who funded the creation of the dataset?
                        </label>
                        <textarea 
                            id="funding" 
                            name="funding" 
                            rows="2"
                            maxlength="1000"
                            placeholder="e.g., National Science Foundation (NSF), Google Research, etc."
                            class="desc-textarea w-full px-4 py-3 rounded-xl bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 transition-all resize-none">{{ old('funding', $data['descriptive']['funding'] ?? '') }}</textarea>
                        <div class="flex justify-between mt-1.5">
                            <p class="text-xs text-gray-500 dark:text-gray-400">Optional: List funding sources</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400 char-counter">0 / 1000</p>
                        </div>
                    </div>
                    
                    <div>
                        <label for="instances_represent" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            <i class="bi bi-grid-3x3-gap me-1 text-emerald-500"></i>
                            What do the instances in this dataset represent? <span class="text-red-500">*</span>
                        </label>
                        <textarea 
                            id="instances_represent" 
                            name="instances_represent" 
                            rows="2"
                            required
                            maxlength="1000"
                            placeholder="e.g., documents, photos, people, countries, patients, transactions..."
                            class="desc-textarea w-full px-4 py-3 rounded-xl bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 transition-all resize-none @error('instances_represent') border-red-500 @enderror">{{ old('instances_represent', $data['descriptive']['instances_represent'] ?? '') }}</textarea>
                        <div class="flex justify-between mt-1.5">
                            <p class="text-xs text-gray-500 dark:text-gray-400">e.g., documents, photos, people, countries</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400 char-counter">0 / 1000</p>
                        </div>
                        @error('instances_represent')
                        <p class="mt-1 text-xs text-red-500 flex items-center gap-1"><i class="bi bi-exclamation-circle"></i>{{ $message }}</p>
                        @enderror
                    </div>
                   
                    <div>
                        <label for="data_splits" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            <i class="bi bi-pie-chart me-1 text-emerald-500"></i>
                            Are there recommended data splits?
                        </label>
                        <textarea 
                            id="data_splits" 
                            name="data_splits" 
                            rows="2"
                            maxlength="1000"
                            placeholder="e.g., 70% training, 15% validation, 15% testing"
                            class="desc-textarea w-full px-4 py-3 rounded-xl bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 transition-all resize-none">{{ old('data_splits', $data['descriptive']['data_splits'] ?? '') }}</textarea>
                        <div class="flex justify-between mt-1.5">
                            <p class="text-xs text-gray-500 dark:text-gray-400">e.g., training, validation, testing</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400 char-counter">0 / 1000</p>
                        </div>
                    </div>
                   
                    <div>
                        <label for="sensitive_data" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            <i class="bi bi-shield-exclamation me-1 text-emerald-500"></i>
                            Does the dataset contain sensitive data?
                        </label>
                        <textarea 
                            id="sensitive_data" 
                            name="sensitive_data" 
                            rows="3"
                            maxlength="1500"
                            placeholder="Describe any sensitive data present, or state 'None' if not applicable"
                            class="desc-textarea w-full px-4 py-3 rounded-xl bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 transition-all resize-none">{{ old('sensitive_data', $data['descriptive']['sensitive_data'] ?? 'None') }}</textarea>
                        <div class="flex justify-between mt-1.5">
                            <p class="text-xs text-gray-500 dark:text-gray-400">e.g., racial origins, sexual orientations, religious beliefs</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400 char-counter">0 / 1500</p>
                        </div>
                    </div>
                   
                    <div>
                        <label for="preprocessing" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            <i class="bi bi-gear me-1 text-emerald-500"></i>
                            Was there any data preprocessing performed?
                        </label>
                        <textarea 
                            id="preprocessing" 
                            name="preprocessing" 
                            rows="3"
                            maxlength="2000"
                            placeholder="Describe any preprocessing steps..."
                            class="desc-textarea w-full px-4 py-3 rounded-xl bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 transition-all resize-none">{{ old('preprocessing', $data['descriptive']['preprocessing'] ?? '') }}</textarea>
                        <div class="flex justify-between mt-1.5">
                            <p class="text-xs text-gray-500 dark:text-gray-400">e.g., discretization, tokenization, missing value handling</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400 char-counter">0 / 2000</p>
                        </div>
                    </div>
                   
                    <div>
                        <label for="additional_info" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            <i class="bi bi-info-circle me-1 text-emerald-500"></i>
                            Additional Information
                        </label>
                        <textarea 
                            id="additional_info" 
                            name="additional_info" 
                            rows="3"
                            maxlength="2000"
                            placeholder="Please provide any additional information about your dataset."
                            class="desc-textarea w-full px-4 py-3 rounded-xl bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 transition-all resize-none">{{ old('additional_info', $data['descriptive']['additional_info'] ?? '') }}</textarea>
                        <div class="flex justify-between mt-1.5">
                            <p class="text-xs text-gray-500 dark:text-gray-400">Optional: Any other relevant information</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400 char-counter">0 / 2000</p>
                        </div>
                    </div>
                   
                    <div>
                        <label for="citation_requests" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            <i class="bi bi-quote me-1 text-emerald-500"></i>
                            Citation Requests / Acknowledgements
                        </label>
                        <textarea 
                            id="citation_requests" 
                            name="citation_requests" 
                            rows="3"
                            maxlength="2000"
                            placeholder="e.g., Please cite this paper when using this dataset: Author et al., 'Title', Journal, Year"
                            class="desc-textarea w-full px-4 py-3 rounded-xl bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 transition-all resize-none">{{ old('citation_requests', $data['descriptive']['citation_requests'] ?? '') }}</textarea>
                        <div class="mt-2 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-3 flex items-start gap-2">
                            <i class="bi bi-info-circle text-blue-600 dark:text-blue-400 mt-0.5 flex-shrink-0"></i>
                            <p class="text-xs text-blue-800 dark:text-blue-200">
                                Datasets in the repository are publicly available under a 
                                <a href="https://creativecommons.org/licenses/by/4.0/" target="_blank" class="font-semibold underline hover:text-blue-900 dark:hover:text-blue-100">CC BY 4.0 license</a>. 
                                If you have specific citation preferences, please include them here.
                            </p>
                        </div>
                        <div class="flex justify-between mt-1.5">
                            <p class="text-xs text-gray-500 dark:text-gray-400">How should users cite this dataset?</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400 char-counter">0 / 2000</p>
                        </div>
                    </div>
                </div>
            </div>
           
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border-2 border-emerald-300 dark:border-emerald-700 overflow-hidden mb-6">
                <div class="bg-gradient-to-r from-emerald-100 to-green-100 dark:from-emerald-900/40 dark:to-green-900/40 border-b border-emerald-200 dark:border-emerald-800 p-5 md:p-6">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg bg-emerald-500 flex items-center justify-center shadow-md">
                            <i class="bi bi-clipboard-check text-xl text-white"></i>
                        </div>
                        <div>
                            <h2 class="text-lg font-bold text-gray-900 dark:text-white">Submission Summary</h2>
                            <p class="text-xs text-gray-600 dark:text-gray-400">Review your dataset information before submitting</p>
                        </div>
                    </div>
                </div>
                
                <div class="p-5 md:p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                        <div class="flex items-center gap-3 p-4 rounded-xl bg-gradient-to-br from-emerald-50 to-green-50 dark:from-emerald-900/20 dark:to-green-900/20 border border-emerald-200 dark:border-emerald-800">
                            <div class="flex-shrink-0 w-10 h-10 rounded-lg bg-emerald-500 flex items-center justify-center">
                                <i class="bi bi-tag text-white"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Dataset Name</p>
                                <p class="text-sm font-bold text-gray-900 dark:text-white truncate">{{ $data['name'] ?? 'Not provided' }}</p>
                            </div>
                        </div>
            
                        <div class="flex items-center gap-3 p-4 rounded-xl bg-gradient-to-br from-blue-50 to-cyan-50 dark:from-blue-900/20 dark:to-cyan-900/20 border border-blue-200 dark:border-blue-800">
                            <div class="flex-shrink-0 w-10 h-10 rounded-lg bg-blue-500 flex items-center justify-center">
                                <i class="bi bi-table text-white"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Instances</p>
                                <p class="text-sm font-bold text-gray-900 dark:text-white">{{ $data['num_instances'] ?? 'Not provided' }}</p>
                            </div>
                        </div>
                       
                        <div class="flex items-center gap-3 p-4 rounded-xl bg-gradient-to-br from-purple-50 to-violet-50 dark:from-purple-900/20 dark:to-violet-900/20 border border-purple-200 dark:border-purple-800">
                            <div class="flex-shrink-0 w-10 h-10 rounded-lg bg-purple-500 flex items-center justify-center">
                                <i class="bi bi-grid-3x3-gap text-white"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Features</p>
                                <p class="text-sm font-bold text-gray-900 dark:text-white">{{ $data['num_features'] ?? 'Not provided' }}</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center gap-3 p-4 rounded-xl bg-gradient-to-br from-amber-50 to-orange-50 dark:from-amber-900/20 dark:to-orange-900/20 border border-amber-200 dark:border-amber-800">
                            <div class="flex-shrink-0 w-10 h-10 rounded-lg bg-amber-500 flex items-center justify-center">
                                <i class="bi bi-folder text-white"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Subject Area</p>
                                <p class="text-sm font-bold text-gray-900 dark:text-white truncate">{{ $data['subject_area'] ?? 'Not provided' }}</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center gap-3 p-4 rounded-xl bg-gradient-to-br from-rose-50 to-pink-50 dark:from-rose-900/20 dark:to-pink-900/20 border border-rose-200 dark:border-rose-800">
                            <div class="flex-shrink-0 w-10 h-10 rounded-lg bg-rose-500 flex items-center justify-center">
                                <i class="bi bi-bullseye text-white"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Tasks</p>
                                <p class="text-sm font-bold text-gray-900 dark:text-white truncate">
                                    {{ !empty($data['associated_tasks']) ? implode(', ', $data['associated_tasks']) : 'Not provided' }}
                                </p>
                            </div>
                        </div>
                        
                        <div class="flex items-center gap-3 p-4 rounded-xl bg-gradient-to-br from-teal-50 to-cyan-50 dark:from-teal-900/20 dark:to-cyan-900/20 border border-teal-200 dark:border-teal-800">
                            <div class="flex-shrink-0 w-10 h-10 rounded-lg bg-teal-500 flex items-center justify-center">
                                <i class="bi bi-file-earmark text-white"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Files</p>
                                <p class="text-sm font-bold text-gray-900 dark:text-white">{{ count($data['files'] ?? []) }} file(s)</p>
                            </div>
                        </div>
                      
                        <div class="md:col-span-2 flex items-center gap-3 p-4 rounded-xl bg-gradient-to-br from-indigo-50 to-blue-50 dark:from-indigo-900/20 dark:to-blue-900/20 border border-indigo-200 dark:border-indigo-800">
                            <div class="flex-shrink-0 w-10 h-10 rounded-lg bg-indigo-500 flex items-center justify-center">
                                <i class="bi bi-tags text-white"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Keywords</p>
                                <p class="text-sm font-bold text-gray-900 dark:text-white">
                                    {{ !empty($data['keywords']) ? count($data['keywords']) . ' keyword(s)' : 'None' }}
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-5 bg-amber-50 dark:bg-amber-900/20 border border-amber-200 dark:border-amber-800 rounded-xl p-4 flex items-start gap-3">
                        <div class="flex-shrink-0 w-8 h-8 rounded-lg bg-amber-100 dark:bg-amber-900/30 flex items-center justify-center">
                            <i class="bi bi-exclamation-triangle text-lg text-amber-600 dark:text-amber-400"></i>
                        </div>
                        <div class="flex-1 text-sm text-amber-800 dark:text-amber-200">
                            <strong class="font-semibold">Before submitting:</strong> Please review all information carefully. Once submitted, your dataset will be reviewed by our team before being published.
                        </div>
                    </div>
                </div>
            </div>
           
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 p-5 md:p-6 sticky bottom-4">
                <div class="flex flex-col sm:flex-row items-center justify-between gap-3">
                    <a href="{{ route('contribute.variable-info') }}" 
                       class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200 font-semibold hover:bg-gray-200 dark:hover:bg-gray-600 transition-all">
                        <i class="bi bi-arrow-left"></i>
                        <span>Back</span>
                    </a>
                    
                    <button type="button" 
                            id="submitBtn"
                            class="flex-1 sm:flex-none inline-flex items-center justify-center gap-2 px-8 py-3 rounded-xl bg-gradient-to-r from-emerald-600 via-green-600 to-teal-600 text-white font-bold shadow-lg hover:shadow-xl hover:shadow-emerald-500/30 hover:-translate-y-0.5 transition-all">
                        <i class="bi bi-check-circle-fill"></i>
                        <span>SUBMIT DATASET</span>
                    </button>
                </div>
            </div>
            
        </form>
        
    </div>
</div>

<div id="confirmModal" class="fixed inset-0 z-[100] hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:p-0">
        <div class="fixed inset-0 bg-gray-900 bg-opacity-60 backdrop-blur-sm transition-opacity" onclick="closeConfirmModal()"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
        
        <div class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="px-6 pt-6 pb-4">
                <div class="flex items-start gap-4">
                    <div class="flex-shrink-0 w-12 h-12 rounded-full bg-gradient-to-br from-emerald-500 to-green-500 flex items-center justify-center shadow-lg">
                        <i class="bi bi-question-circle text-2xl text-white"></i>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">
                            Confirm Submission
                        </h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
                            Are you sure you want to submit this dataset?
                        </p>
                        
                        <div class="bg-gray-50 dark:bg-gray-700/50 rounded-xl p-4">
                            <p class="text-xs font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                By submitting, you confirm that:
                            </p>
                            <ul class="space-y-2">
                                <li class="flex items-start gap-2 text-xs text-gray-600 dark:text-gray-400">
                                    <i class="bi bi-check-circle-fill text-emerald-500 mt-0.5 flex-shrink-0"></i>
                                    <span>You have the right to share this dataset publicly</span>
                                </li>
                                <li class="flex items-start gap-2 text-xs text-gray-600 dark:text-gray-400">
                                    <i class="bi bi-check-circle-fill text-emerald-500 mt-0.5 flex-shrink-0"></i>
                                    <span>The dataset does not contain sensitive personal information</span>
                                </li>
                                <li class="flex items-start gap-2 text-xs text-gray-600 dark:text-gray-400">
                                    <i class="bi bi-check-circle-fill text-emerald-500 mt-0.5 flex-shrink-0"></i>
                                    <span>All information provided is accurate</span>
                                </li>
                                <li class="flex items-start gap-2 text-xs text-gray-600 dark:text-gray-400">
                                    <i class="bi bi-check-circle-fill text-emerald-500 mt-0.5 flex-shrink-0"></i>
                                    <span>You agree to the CC BY 4.0 license terms</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 dark:bg-gray-700/50 px-6 py-4 flex flex-col sm:flex-row gap-2 justify-end">
                <button type="button" 
                        onclick="closeConfirmModal()"
                        class="px-5 py-2.5 rounded-xl bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-200 font-semibold hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">
                    Cancel
                </button>
                <button type="button" 
                        id="confirmSubmitBtn"
                        class="px-5 py-2.5 rounded-xl bg-gradient-to-r from-emerald-600 to-green-600 text-white font-semibold shadow-md hover:shadow-lg transition-all inline-flex items-center justify-center gap-2">
                    <i class="bi bi-check-circle-fill"></i>
                    <span>Yes, Submit</span>
                </button>
            </div>
        </div>
    </div>
</div>

<div id="successModal" class="fixed inset-0 z-[100] hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:p-0">
        <div class="fixed inset-0 bg-gray-900 bg-opacity-60 backdrop-blur-sm"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
        <div class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-md sm:w-full">
            <div class="px-6 pt-8 pb-6 text-center">
                <div class="relative w-24 h-24 mx-auto mb-6">
                    <div class="absolute inset-0 rounded-full bg-gradient-to-br from-emerald-400 to-green-500 animate-ping opacity-20"></div>
                    <div class="relative w-24 h-24 rounded-full bg-gradient-to-br from-emerald-500 to-green-500 flex items-center justify-center shadow-2xl">
                        <i class="bi bi-check-lg text-5xl text-white"></i>
                    </div>
                </div>
                
                <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">
                    Successfully Uploaded!
                </h3>
                <p class="text-sm text-gray-600 dark:text-gray-400 mb-6">
                    Your dataset has been submitted and is pending review by our team.
                </p>
               
                <div class="bg-emerald-50 dark:bg-emerald-900/20 border border-emerald-200 dark:border-emerald-800 rounded-xl p-4 mb-6 text-left">
                    <div class="flex items-start gap-2">
                        <i class="bi bi-info-circle text-emerald-600 dark:text-emerald-400 mt-0.5 flex-shrink-0"></i>
                        <div class="text-xs text-emerald-800 dark:text-emerald-200">
                            <strong class="font-semibold">What's next?</strong> Our team will review your submission. You'll receive an email notification once it's approved.
                        </div>
                    </div>
                </div>
                
                <div class="flex flex-col sm:flex-row gap-2">
                    <a href="{{ route('profile.datasets') }}" 
                       class="flex-1 px-5 py-3 rounded-xl bg-gradient-to-r from-brand-600 to-sphere-secondary text-white font-semibold shadow-md hover:shadow-lg transition-all inline-flex items-center justify-center gap-2">
                        <i class="bi bi-folder2-open"></i>
                        <span>View My Datasets</span>
                    </a>
                    <a href="{{ route('home') }}" 
                       class="flex-1 px-5 py-3 rounded-xl bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200 font-semibold hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors inline-flex items-center justify-center gap-2">
                        <i class="bi bi-house"></i>
                        <span>Go Home</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="loadingOverlay" class="fixed inset-0 z-[200] hidden items-center justify-center bg-white/95 dark:bg-gray-900/95 backdrop-blur-sm">
    <div class="text-center">
        <div class="relative w-20 h-20 mx-auto mb-6">
            <div class="absolute inset-0 rounded-full border-4 border-emerald-200 dark:border-emerald-900"></div>
            <div class="absolute inset-0 rounded-full border-4 border-emerald-500 border-t-transparent animate-spin"></div>
            <div class="absolute inset-0 flex items-center justify-center">
                <i class="bi bi-cloud-arrow-up text-2xl text-emerald-500"></i>
            </div>
        </div>
        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">
            Submitting your dataset...
        </h3>
        <p class="text-sm text-gray-500 dark:text-gray-400">
            Please wait while we process your submission.
        </p>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('donationForm');
        const submitBtn = document.getElementById('submitBtn');
        const confirmModal = document.getElementById('confirmModal');
        const successModal = document.getElementById('successModal');
        const loadingOverlay = document.getElementById('loadingOverlay');
        const confirmSubmitBtn = document.getElementById('confirmSubmitBtn');
        
        document.querySelectorAll('.desc-textarea').forEach(textarea => {
            const counter = textarea.parentElement.querySelector('.char-counter');
            if (counter) {
                function updateCount() {
                    const count = textarea.value.length;
                    const max = textarea.maxLength || 2000;
                    counter.textContent = `${count} / ${max}`;
                    
                    if (count > max * 0.9) {
                        counter.classList.add('text-amber-600', 'font-semibold');
                    } else {
                        counter.classList.remove('text-amber-600', 'font-semibold');
                    }
                }
                textarea.addEventListener('input', updateCount);
                updateCount();
            }
        });
       
        submitBtn.addEventListener('click', function(e) {
            e.preventDefault();
            
            const requiredFields = form.querySelectorAll('[required]');
            let isValid = true;
            let firstInvalid = null;
            
            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    isValid = false;
                    field.classList.add('border-red-500', 'focus:border-red-500', 'focus:ring-red-500/20');
                    if (!firstInvalid) firstInvalid = field;
                } else {
                    field.classList.remove('border-red-500', 'focus:border-red-500', 'focus:ring-red-500/20');
                }
            });
            
            if (!isValid) {
                if (firstInvalid) {
                    firstInvalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    firstInvalid.focus();
                }
                showNotification('Please fill in all required fields marked with *', 'warning');
                return;
            }
            
            confirmModal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        });
        
        confirmSubmitBtn.addEventListener('click', function() {
            closeConfirmModal();
            
            loadingOverlay.classList.remove('hidden');
            loadingOverlay.classList.add('flex');
            submitBtn.disabled = true;
            
            form.submit();
        });
        
        @if(session('success'))
            setTimeout(function() {
                successModal.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            }, 500);
        @endif
        
        @if(session('error'))
            loadingOverlay.classList.add('hidden');
            loadingOverlay.classList.remove('flex');
            submitBtn.disabled = false;
            showNotification('Error: {{ session('error') }}', 'error');
        @endif
        
        const inputs = form.querySelectorAll('.desc-textarea');
        inputs.forEach(input => {
            const saved = localStorage.getItem('descriptive_' + input.id);
            if (saved && !input.value) {
                input.value = saved;
            }
            
            input.addEventListener('input', function() {
                localStorage.setItem('descriptive_' + this.id, this.value);
            });
        });
        
        form.addEventListener('submit', function() {
            inputs.forEach(input => {
                localStorage.removeItem('descriptive_' + input.id);
            });
        });
        
        inputs.forEach(input => {
            input.addEventListener('input', function() {
                this.classList.remove('border-red-500', 'focus:border-red-500', 'focus:ring-red-500/20');
            });
        });
    });
    
    function closeConfirmModal() {
        document.getElementById('confirmModal').classList.add('hidden');
        document.body.style.overflow = '';
    }
    
    function showNotification(message, type = 'info') {
        const notification = document.createElement('div');
        
        const colors = {
            'success': 'bg-green-50 dark:bg-green-900/30 border-green-200 dark:border-green-800 text-green-800 dark:text-green-200',
            'warning': 'bg-amber-50 dark:bg-amber-900/30 border-amber-200 dark:border-amber-800 text-amber-800 dark:text-amber-200',
            'error': 'bg-red-50 dark:bg-red-900/30 border-red-200 dark:border-red-800 text-red-800 dark:text-red-200'
        };
        
        const icons = {
            'success': 'bi-check-circle-fill text-green-500',
            'warning': 'bi-exclamation-triangle-fill text-amber-500',
            'error': 'bi-x-circle-fill text-red-500'
        };
        
        notification.className = `fixed top-20 right-4 z-[300] ${colors[type]} border rounded-xl p-4 flex items-start gap-3 shadow-lg min-w-[300px] animate-fadeIn`;
        notification.innerHTML = `
            <i class="bi ${icons[type]} text-xl mt-0.5 flex-shrink-0"></i>
            <p class="text-sm font-medium flex-1">${message}</p>
            <button onclick="this.parentElement.remove()" class="flex-shrink-0 opacity-60 hover:opacity-100">
                <i class="bi bi-x-lg"></i>
            </button>
        `;
        
        document.body.appendChild(notification);
        
        setTimeout(() => {
            notification.style.transition = 'all 0.3s ease';
            notification.style.opacity = '0';
            notification.style.transform = 'translateX(100%)';
            setTimeout(() => notification.remove(), 300);
        }, 4000);
    }
</script>
@endpush

<style>
    @keyframes fadeIn {
        from { opacity: 0; transform: translateX(20px); }
        to { opacity: 1; transform: translateX(0); }
    }
    .animate-fadeIn {
        animation: fadeIn 0.3s ease-out;
    }
</style>
@endsection