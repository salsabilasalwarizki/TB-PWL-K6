@extends('layouts.app')
@section('title', 'Link External Dataset - Descriptive - DataSphere ML Repository')
@section('meta_desc', 'Final step: Add descriptive information for linking your external dataset')

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
            <span class="text-brand-600 dark:text-brand-400 font-semibold">Link External Dataset</span>
        </nav>
        
        <!-- Header Card -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 overflow-hidden mb-6">
            <div class="bg-gradient-to-r from-indigo-600 to-purple-600 p-8 md:p-10">
                <div class="flex items-center gap-4">
                    <div class="w-14 h-14 rounded-xl bg-white/20 backdrop-blur-sm flex items-center justify-center">
                        <i class="bi bi-link-45deg text-3xl text-white"></i>
                    </div>
                    <div>
                        <h1 class="text-3xl md:text-4xl font-bold text-white">
                            Dataset Linking Form
                        </h1>
                        <p class="text-white/90 text-sm md:text-base mt-1">
                            Final Step: Add descriptive information
                        </p>
                    </div>
                </div>
            </div>
            
            <!-- Progress Bar (Complete) -->
            <div class="p-6 md:p-8 bg-gradient-to-r from-emerald-50 to-green-50 dark:from-gray-800 dark:to-gray-800">
                <div class="flex items-center justify-between mb-3">
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 rounded-full bg-gradient-to-br from-emerald-500 to-green-500 flex items-center justify-center text-white font-bold text-sm">
                            <i class="bi bi-check-lg"></i>
                        </div>
                        <span class="text-sm font-bold text-gray-900 dark:text-white">Descriptive Information</span>
                    </div>
                    <span class="text-xs font-semibold text-emerald-700 dark:text-emerald-400 bg-emerald-100 dark:bg-emerald-900/30 px-3 py-1 rounded-full flex items-center gap-1">
                        <i class="bi bi-check-circle-fill"></i>
                        Complete
                    </span>
                </div>
                
                <!-- Progress bar (Complete) -->
                <div class="hidden md:flex items-center gap-1 mb-3">
                    @for($i = 1; $i <= 6; $i++)
                        <div class="flex-1 h-2 rounded-full bg-gradient-to-r from-emerald-500 to-green-500"></div>
                    @endfor
                </div>
                <div class="md:hidden h-2 rounded-full bg-gray-200 dark:bg-gray-700 overflow-hidden">
                    <div class="h-full bg-gradient-to-r from-emerald-500 to-green-500" style="width: 100%"></div>
                </div>
                
                <!-- Step labels (All Complete) -->
                <div class="hidden md:grid grid-cols-6 gap-1 mt-2 text-[10px] text-emerald-700 dark:text-emerald-400 font-semibold">
                    <span class="text-center">Basic</span>
                    <span class="text-center">Paper</span>
                    <span class="text-center">Creators</span>
                    <span class="text-center">Keywords</span>
                    <span class="text-center">Variables</span>
                    <span class="text-center">Descriptive</span>
                </div>
            </div>
        </div>
        
        <!-- Form -->
        <form action="{{ route('contribute.linking.submit') }}" method="POST" id="linkingForm">
            @csrf
            
            <!-- Descriptive Questions -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 overflow-hidden mb-6">
                <div class="bg-gradient-to-r from-indigo-50 to-purple-50 dark:from-gray-800 dark:to-gray-800 border-b border-gray-200 dark:border-gray-700 p-5 md:p-6">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg bg-indigo-100 dark:bg-indigo-900/30 flex items-center justify-center">
                            <i class="bi bi-journal-text text-xl text-indigo-600 dark:text-indigo-400"></i>
                        </div>
                        <div>
                            <h2 class="text-lg font-bold text-gray-900 dark:text-white">Descriptive Questions</h2>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Provide detailed information about your dataset</p>
                        </div>
                    </div>
                </div>
                
                <div class="p-5 md:p-6 space-y-5">
                    
                    <!-- 1. Purpose -->
                    <div>
                        <label for="purpose" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            <i class="bi bi-bullseye me-1 text-indigo-500"></i>
                            For what purpose was the dataset created?
                        </label>
                        <textarea 
                            id="purpose" 
                            name="purpose" 
                            rows="3"
                            maxlength="2000"
                            oninput="updateCharCount(this, 2000)"
                            placeholder="Describe the main goal of this dataset..."
                            class="desc-textarea w-full px-4 py-3 rounded-xl bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition-all resize-none">{{ old('purpose', $data['purpose'] ?? '') }}</textarea>
                        <div class="flex justify-between mt-1.5">
                            <p class="text-xs text-gray-500 dark:text-gray-400">Describe the main purpose and motivation</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400"><span id="purposeCount">{{ strlen(old('purpose', $data['purpose'] ?? '')) }}</span>/2000</p>
                        </div>
                    </div>
                    
                    <!-- 2. Funding -->
                    <div>
                        <label for="funding" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            <i class="bi bi-cash-stack me-1 text-indigo-500"></i>
                            Who funded the creation of the dataset?
                        </label>
                        <textarea 
                            id="funding" 
                            name="funding" 
                            rows="2"
                            maxlength="1000"
                            oninput="updateCharCount(this, 1000)"
                            placeholder="e.g., National Science Foundation, Internal Grant, None"
                            class="desc-textarea w-full px-4 py-3 rounded-xl bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition-all resize-none">{{ old('funding', $data['funding'] ?? '') }}</textarea>
                        <div class="flex justify-between mt-1.5">
                            <p class="text-xs text-gray-500 dark:text-gray-400">Optional: List funding sources</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400"><span id="fundingCount">{{ strlen(old('funding', $data['funding'] ?? '')) }}</span>/1000</p>
                        </div>
                    </div>
                    
                    <!-- 3. Instances Represent -->
                    <div>
                        <label for="instances_represent" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            <i class="bi bi-grid-3x3-gap me-1 text-indigo-500"></i>
                            What do the instances in this dataset represent?
                        </label>
                        <textarea 
                            id="instances_represent" 
                            name="instances_represent" 
                            rows="2"
                            maxlength="1000"
                            oninput="updateCharCount(this, 1000)"
                            placeholder="e.g., patients, photos, transactions, sensor readings..."
                            class="desc-textarea w-full px-4 py-3 rounded-xl bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition-all resize-none">{{ old('instances_represent', $data['instances_represent'] ?? '') }}</textarea>
                        <div class="flex justify-between mt-1.5">
                            <p class="text-xs text-gray-500 dark:text-gray-400">e.g., documents, photos, people, countries</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400"><span id="instancesCount">{{ strlen(old('instances_represent', $data['instances_represent'] ?? '')) }}</span>/1000</p>
                        </div>
                    </div>
                    
                    <!-- 4. Data Splits -->
                    <div>
                        <label for="data_splits" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            <i class="bi bi-pie-chart me-1 text-indigo-500"></i>
                            Are there recommended data splits?
                        </label>
                        <textarea 
                            id="data_splits" 
                            name="data_splits" 
                            rows="2"
                            maxlength="1000"
                            oninput="updateCharCount(this, 1000)"
                            placeholder="e.g., 70% training, 30% testing"
                            class="desc-textarea w-full px-4 py-3 rounded-xl bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition-all resize-none">{{ old('data_splits', $data['data_splits'] ?? '') }}</textarea>
                        <div class="flex justify-between mt-1.5">
                            <p class="text-xs text-gray-500 dark:text-gray-400">e.g., training, validation, testing</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400"><span id="splitsCount">{{ strlen(old('data_splits', $data['data_splits'] ?? '')) }}</span>/1000</p>
                        </div>
                    </div>
                    
                    <!-- 5. Sensitive Data -->
                    <div>
                        <label for="sensitive_data" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            <i class="bi bi-shield-exclamation me-1 text-indigo-500"></i>
                            Does the dataset contain data that might be considered sensitive in any way?
                        </label>
                        <textarea 
                            id="sensitive_data" 
                            name="sensitive_data" 
                            rows="3"
                            maxlength="2000"
                            oninput="updateCharCount(this, 2000)"
                            placeholder="Describe any sensitive data..."
                            class="desc-textarea w-full px-4 py-3 rounded-xl bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition-all resize-none">{{ old('sensitive_data', $data['sensitive_data'] ?? '') }}</textarea>
                        <div class="flex justify-between mt-1.5">
                            <p class="text-xs text-gray-500 dark:text-gray-400">e.g., racial origins, sexual orientations, religious beliefs</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400"><span id="sensitiveCount">{{ strlen(old('sensitive_data', $data['sensitive_data'] ?? '')) }}</span>/2000</p>
                        </div>
                    </div>
                    
                    <!-- 6. Preprocessing -->
                    <div>
                        <label for="preprocessing" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            <i class="bi bi-gear me-1 text-indigo-500"></i>
                            Was there any data preprocessing performed?
                        </label>
                        <textarea 
                            id="preprocessing" 
                            name="preprocessing" 
                            rows="3"
                            maxlength="2000"
                            oninput="updateCharCount(this, 2000)"
                            placeholder="Describe preprocessing steps..."
                            class="desc-textarea w-full px-4 py-3 rounded-xl bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition-all resize-none">{{ old('preprocessing', $data['preprocessing'] ?? '') }}</textarea>
                        <div class="flex justify-between mt-1.5">
                            <p class="text-xs text-gray-500 dark:text-gray-400">e.g., discretization, tokenization, missing value handling</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400"><span id="preprocessingCount">{{ strlen(old('preprocessing', $data['preprocessing'] ?? '')) }}</span>/2000</p>
                        </div>
                    </div>
                    
                    <!-- 7. Additional Information -->
                    <div>
                        <label for="additional_info" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            <i class="bi bi-info-circle me-1 text-indigo-500"></i>
                            Additional Information
                        </label>
                        <textarea 
                            id="additional_info" 
                            name="additional_info" 
                            rows="3"
                            maxlength="2000"
                            oninput="updateCharCount(this, 2000)"
                            placeholder="Any other details..."
                            class="desc-textarea w-full px-4 py-3 rounded-xl bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition-all resize-none">{{ old('additional_info', $data['additional_info'] ?? '') }}</textarea>
                        <div class="flex justify-between mt-1.5">
                            <p class="text-xs text-gray-500 dark:text-gray-400">Optional: Any other relevant information</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400"><span id="additionalCount">{{ strlen(old('additional_info', $data['additional_info'] ?? '')) }}</span>/2000</p>
                        </div>
                    </div>
                    
                    <!-- 8. Citation Requests -->
                    <div>
                        <label for="citation_requests" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            <i class="bi bi-quote me-1 text-indigo-500"></i>
                            Citation Requests/Acknowledgements
                        </label>
                        <textarea 
                            id="citation_requests" 
                            name="citation_requests" 
                            rows="3"
                            maxlength="2000"
                            oninput="updateCharCount(this, 2000)"
                            placeholder="e.g., Please cite this dataset as..."
                            class="desc-textarea w-full px-4 py-3 rounded-xl bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition-all resize-none">{{ old('citation_requests', $data['citation_requests'] ?? '') }}</textarea>
                        <div class="flex justify-between mt-1.5">
                            <p class="text-xs text-gray-500 dark:text-gray-400">How should users cite this dataset?</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400"><span id="citationCount">{{ strlen(old('citation_requests', $data['citation_requests'] ?? '')) }}</span>/2000</p>
                        </div>
                        <div class="mt-2 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-3 flex items-start gap-2">
                            <i class="bi bi-info-circle text-blue-600 dark:text-blue-400 mt-0.5 flex-shrink-0"></i>
                            <p class="text-xs text-blue-800 dark:text-blue-200">
                                Datasets in the repository are publicly available under a 
                                <a href="https://creativecommons.org/licenses/by/4.0/" target="_blank" class="font-semibold underline hover:text-blue-900 dark:hover:text-blue-100">CC BY 4.0 license</a>. 
                                If you have specific citation preferences, please include them here.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Summary Box -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border-2 border-indigo-300 dark:border-indigo-700 overflow-hidden mb-6">
                <div class="bg-gradient-to-r from-indigo-100 to-purple-100 dark:from-indigo-900/40 dark:to-purple-900/40 border-b border-indigo-200 dark:border-indigo-800 p-5 md:p-6">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg bg-indigo-500 flex items-center justify-center">
                            <i class="bi bi-clipboard-check text-xl text-white"></i>
                        </div>
                        <div>
                            <h2 class="text-lg font-bold text-gray-900 dark:text-white">Summary</h2>
                            <p class="text-xs text-gray-600 dark:text-gray-400">Review your dataset information before submitting</p>
                        </div>
                    </div>
                </div>
                
                <div class="p-5 md:p-6">
                    <div class="space-y-3">
                        <div class="flex items-start gap-3 p-4 rounded-xl bg-gradient-to-br from-indigo-50 to-purple-50 dark:from-indigo-900/20 dark:to-purple-900/20 border border-indigo-200 dark:border-indigo-800">
                            <div class="flex-shrink-0 w-10 h-10 rounded-lg bg-indigo-500 flex items-center justify-center">
                                <i class="bi bi-tag text-white"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Dataset Name</p>
                                <p class="text-sm font-bold text-gray-900 dark:text-white truncate">{{ $data['name'] ?? 'N/A' }}</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start gap-3 p-4 rounded-xl bg-gradient-to-br from-indigo-50 to-purple-50 dark:from-indigo-900/20 dark:to-purple-900/20 border border-indigo-200 dark:border-indigo-800">
                            <div class="flex-shrink-0 w-10 h-10 rounded-lg bg-indigo-500 flex items-center justify-center">
                                <i class="bi bi-link-45deg text-white"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">External URL</p>
                                <a href="{{ $data['external_url'] ?? '#' }}" target="_blank" class="text-sm font-bold text-indigo-600 dark:text-indigo-400 hover:text-indigo-700 dark:hover:text-indigo-300 truncate block">
                                    {{ $data['external_url'] ?? 'N/A' }}
                                </a>
                            </div>
                        </div>
                        
                        <div class="flex items-start gap-3 p-4 rounded-xl bg-gradient-to-br from-indigo-50 to-purple-50 dark:from-indigo-900/20 dark:to-purple-900/20 border border-indigo-200 dark:border-indigo-800">
                            <div class="flex-shrink-0 w-10 h-10 rounded-lg bg-indigo-500 flex items-center justify-center">
                                <i class="bi bi-folder text-white"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Subject Area</p>
                                <p class="text-sm font-bold text-gray-900 dark:text-white truncate">{{ $data['subject_area'] ?? 'N/A' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Navigation -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 p-5 md:p-6 sticky bottom-4">
                <div class="flex flex-col sm:flex-row items-center justify-between gap-3">
                    <a href="{{ route('contribute.linking.variable-info') }}" 
                       class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200 font-semibold hover:bg-gray-200 dark:hover:bg-gray-600 transition-all">
                        <i class="bi bi-arrow-left"></i>
                        <span>Back</span>
                    </a>
                    
                    <button type="submit" 
                            id="submitBtn"
                            class="flex-1 sm:flex-none inline-flex items-center justify-center gap-2 px-8 py-3 rounded-xl bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-bold shadow-lg hover:shadow-xl hover:shadow-indigo-500/30 hover:-translate-y-0.5 transition-all">
                        <i class="bi bi-check-circle-fill"></i>
                        <span>SUBMIT</span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('linkingForm'); // Make sure your form has this ID
    const submitBtn = document.getElementById('submitBtn');

    if (form && submitBtn) {
        form.addEventListener('submit', function(e) {
            // Optional: Validate client-side before submitting
            // if (!this.checkValidity()) return;

            // Show loading state
            submitBtn.disabled = true;
            const originalContent = submitBtn.innerHTML;
            submitBtn.innerHTML = `
                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Submitting...
            `;

            // DO NOT use e.preventDefault() here if you want a standard submission.
            // The form will submit naturally, and the loading state will show briefly 
            // before the page redirects.
        });
    }
});
</script>
@endpush
@endsection