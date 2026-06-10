@extends('layouts.app')
@section('title', 'Link External Dataset - Paper - DataSphere ML Repository')
@section('meta_desc', 'Step 2: Provide paper information for your linked external dataset')

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
            <span class="text-brand-600 dark:text-brand-400 font-semibold">Link External Dataset</span>
        </nav>
        
        
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
                            Step 2 of 6 — Paper Information
                        </p>
                    </div>
                </div>
            </div>
            
            
            <div class="p-6 md:p-8 bg-gradient-to-r from-indigo-50 to-purple-50 dark:from-gray-800 dark:to-gray-800">
                <div class="flex items-center justify-between mb-3">
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 rounded-full bg-gradient-to-br from-indigo-500 to-purple-500 flex items-center justify-center text-white font-bold text-sm">
                            2
                        </div>
                        <span class="text-sm font-bold text-gray-900 dark:text-white">Paper</span>
                    </div>
                    <span class="text-xs font-semibold text-indigo-700 dark:text-indigo-400 bg-indigo-100 dark:bg-indigo-900/30 px-3 py-1 rounded-full">
                        Page 2 / 6
                    </span>
                </div>
                
                
                <div class="hidden md:flex items-center gap-1 mb-3">
                    <div class="flex-1 h-2 rounded-full bg-gradient-to-r from-indigo-500 to-purple-500"></div>
                    <div class="flex-1 h-2 rounded-full bg-gradient-to-r from-indigo-500 to-purple-500"></div>
                    @for($i = 3; $i <= 6; $i++)
                        <div class="flex-1 h-2 rounded-full bg-gray-200 dark:bg-gray-700"></div>
                    @endfor
                </div>
                <div class="md:hidden h-2 rounded-full bg-gray-200 dark:bg-gray-700 overflow-hidden">
                    <div class="h-full bg-gradient-to-r from-indigo-500 to-purple-500" style="width: 33.33%"></div>
                </div>
                
                
                <div class="hidden md:grid grid-cols-6 gap-1 mt-2 text-[10px] text-gray-500 dark:text-gray-400">
                    <span class="text-center font-semibold text-indigo-700 dark:text-indigo-400">Basic</span>
                    <span class="text-center font-semibold text-indigo-700 dark:text-indigo-400">Paper</span>
                    <span class="text-center">Creators</span>
                    <span class="text-center">Keywords</span>
                    <span class="text-center">Variables</span>
                    <span class="text-center">Review</span>
                </div>
            </div>
        </div>
        
        <form action="{{ route('contribute.linking.paper.store') }}" method="POST" id="paperForm">
            @csrf
            
            
            
            
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 overflow-hidden mb-6">
                <div class="bg-gradient-to-r from-indigo-50 to-purple-50 dark:from-gray-800 dark:to-gray-800 border-b border-gray-200 dark:border-gray-700 p-5 md:p-6">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg bg-indigo-100 dark:bg-indigo-900/30 flex items-center justify-center">
                            <i class="bi bi-journal-text text-xl text-indigo-600 dark:text-indigo-400"></i>
                        </div>
                        <div>
                            <h2 class="text-lg font-bold text-gray-900 dark:text-white">Introductory Paper</h2>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Provide paper information for your linked dataset</p>
                        </div>
                    </div>
                </div>
                
                <div class="p-5 md:p-6 space-y-5">
                    
                    
                    <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-xl p-4 flex items-start gap-3">
                        <div class="flex-shrink-0 w-8 h-8 rounded-lg bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center">
                            <i class="bi bi-info-circle text-lg text-blue-600 dark:text-blue-400"></i>
                        </div>
                        <div class="flex-1 text-sm text-blue-800 dark:text-blue-200">
                            <strong class="font-semibold">Tip:</strong> Provide a paper ID and its type to auto-fill the fields below. Supported sources include DOI, arXiv, PubMed, and more.
                        </div>
                    </div>
                    
                    
                    <div>
                        <label for="paper_id_type" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            <i class="bi bi-tag me-1 text-indigo-500"></i>Paper ID Type
                        </label>
                        <select 
                            id="paper_id_type" 
                            name="paper_id_type"
                            class="w-full px-4 py-3 rounded-xl bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-white focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition-all appearance-none cursor-pointer">
                            <option value="None" {{ old('paper_id_type', $oldPaper['paper_id_type'] ?? '') == 'None' ? 'selected' : '' }}>None</option>
                            <option value="URL" {{ old('paper_id_type', $oldPaper['paper_id_type'] ?? '') == 'URL' ? 'selected' : '' }}>URL (from semanticscholar.org, arxiv.org, aclweb.org, acm.org, or biorxiv.org)</option>
                            <option value="DOI" {{ old('paper_id_type', $oldPaper['paper_id_type'] ?? '') == 'DOI' ? 'selected' : '' }}>Digital Object Identifier (DOI)</option>
                            <option value="Semantic Scholar ID" {{ old('paper_id_type', $oldPaper['paper_id_type'] ?? '') == 'Semantic Scholar ID' ? 'selected' : '' }}>Semantic Scholar ID</option>
                            <option value="Corpus ID" {{ old('paper_id_type', $oldPaper['paper_id_type'] ?? '') == 'Corpus ID' ? 'selected' : '' }}>Corpus ID</option>
                            <option value="arXiv" {{ old('paper_id_type', $oldPaper['paper_id_type'] ?? '') == 'arXiv' ? 'selected' : '' }}>arXiv</option>
                            <option value="Microsoft Academic Graph (MAG)" {{ old('paper_id_type', $oldPaper['paper_id_type'] ?? '') == 'Microsoft Academic Graph (MAG)' ? 'selected' : '' }}>Microsoft Academic Graph (MAG)</option>
                            <option value="Association for Computational Linguistics (ACL)" {{ old('paper_id_type', $oldPaper['paper_id_type'] ?? '') == 'Association for Computational Linguistics (ACL)' ? 'selected' : '' }}>Association for Computational Linguistics (ACL)</option>
                            <option value="PubMed/Medline (PMID)" {{ old('paper_id_type', $oldPaper['paper_id_type'] ?? '') == 'PubMed/Medline (PMID)' ? 'selected' : '' }}>PubMed/Medline (PMID)</option>
                            <option value="PubMed Central (PMCID)" {{ old('paper_id_type', $oldPaper['paper_id_type'] ?? '') == 'PubMed Central (PMCID)' ? 'selected' : '' }}>PubMed Central (PMCID)</option>
                        </select>
                    </div>
                    
                    
                    <div>
                        <label for="paper_id" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            <i class="bi bi-upc-scan me-1 text-indigo-500"></i>Paper ID
                        </label>
                        <div class="flex gap-2">
                            <input 
                                type="text" 
                                id="paper_id" 
                                name="paper_id" 
                                value="{{ old('paper_id', $oldPaper['paper_id'] ?? '') }}" 
                                placeholder="e.g., 10.1145/123456.789012"
                                class="flex-1 px-4 py-3 rounded-xl bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition-all">
                            <button 
                                type="button" 
                                id="findPaperBtn"
                                class="inline-flex items-center gap-2 px-5 py-3 rounded-xl bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 text-gray-700 dark:text-gray-300 font-semibold hover:border-indigo-500 hover:text-indigo-600 dark:hover:text-indigo-400 hover:border-indigo-500 hover:bg-indigo-50 dark:hover:bg-indigo-900/20 transition-all">
                                <i class="bi bi-search"></i>
                                <span>FIND</span>
                            </button>
                        </div>
                        <p class="mt-2 text-xs text-gray-500 dark:text-gray-400 flex items-center gap-1">
                            <i class="bi bi-info-circle"></i>
                            Enter a paper ID and click FIND to auto-fill the fields below
                        </p>
                    </div>
                    
                    
                    <div class="border-t border-gray-200 dark:border-gray-700"></div>
                    
                    
                    <div>
                        <label for="title" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            <i class="bi bi-card-heading me-1 text-indigo-500"></i>Title <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            id="title" 
                            name="title" 
                            value="{{ old('title', $oldPaper['title'] ?? '') }}" 
                            required 
                            placeholder="Title of the paper"
                            class="w-full px-4 py-3 rounded-xl bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition-all @error('title') border-red-500 focus:border-red-500 focus:ring-red-500/20 @enderror">
                        @error('title')
                            <p class="mt-2 text-xs text-red-500 flex items-center gap-1">
                                <i class="bi bi-exclamation-circle"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>
                    
                    
                    <div>
                        <label for="authors" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            <i class="bi bi-people me-1 text-indigo-500"></i>Authors <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            id="authors" 
                            name="authors" 
                            value="{{ old('authors', $oldPaper['authors'] ?? '') }}" 
                            required 
                            placeholder="e.g., John Doe, Jane Smith"
                            class="w-full px-4 py-3 rounded-xl bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition-all @error('authors') border-red-500 focus:border-red-500 focus:ring-red-500/20 @enderror">
                        @error('authors')
                            <p class="mt-2 text-xs text-red-500 flex items-center gap-1">
                                <i class="bi bi-exclamation-circle"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>
                    
                    
                    <div>
                        <label for="venue" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            <i class="bi bi-building me-1 text-indigo-500"></i>Venue <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            id="venue" 
                            name="venue" 
                            value="{{ old('venue', $oldPaper['venue'] ?? '') }}" 
                            required 
                            placeholder="e.g., NeurIPS 2021, Journal of Machine Learning Research"
                            class="w-full px-4 py-3 rounded-xl bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition-all @error('venue') border-red-500 focus:border-red-500 focus:ring-red-500/20 @enderror">
                        @error('venue')
                            <p class="mt-2 text-xs text-red-500 flex items-center gap-1">
                                <i class="bi bi-exclamation-circle"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>
                    
                    
                    <div>
                        <label for="year" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            <i class="bi bi-calendar me-1 text-indigo-500"></i>Year <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="number" 
                            id="year" 
                            name="year" 
                            value="{{ old('year', $oldPaper['year'] ?? '') }}" 
                            required 
                            min="1900" 
                            max="{{ date('Y') }}" 
                            placeholder="e.g., 2023"
                            class="w-full px-4 py-3 rounded-xl bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition-all @error('year') border-red-500 focus:border-red-500 focus:ring-red-500/20 @enderror">
                        @error('year')
                            <p class="mt-2 text-xs text-red-500 flex items-center gap-1">
                                <i class="bi bi-exclamation-circle"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>
                    
                    
                    <div>
                        <label for="url" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            <i class="bi bi-link-45deg me-1 text-indigo-500"></i>URL
                        </label>
                        <input 
                            type="url" 
                            id="url" 
                            name="url" 
                            value="{{ old('url', $oldPaper['url'] ?? '') }}" 
                            placeholder="https://..."
                            class="w-full px-4 py-3 rounded-xl bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition-all">
                    </div>
                </div>
            </div>
            
            
            
            
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 p-5 md:p-6 sticky bottom-4">
                <div class="flex flex-col sm:flex-row items-center justify-between gap-3">
                    <a href="{{ route('contribute.linking.metadata') }}" 
                       class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200 font-semibold hover:bg-gray-200 dark:hover:bg-gray-600 transition-all">
                        <i class="bi bi-arrow-left"></i>
                        <span>Back</span>
                    </a>
                    
                    <div class="flex items-center gap-3 w-full sm:w-auto">
                        <span class="text-xs text-gray-500 dark:text-gray-400 hidden sm:inline">
                            Step 2 of 6
                        </span>
                        <button type="submit" 
                                id="nextBtn"
                                class="flex-1 sm:flex-none inline-flex items-center justify-center gap-2 px-8 py-3 rounded-xl bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-bold shadow-lg hover:shadow-xl hover:shadow-indigo-500/30 hover:-translate-y-0.5 transition-all">
                            <span>Next</span>
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
document.getElementById('findPaperBtn').addEventListener('click', function() {
    const paperId = document.getElementById('paper_id').value;
    const paperIdType = document.getElementById('paper_id_type').value;
    
    if (!paperId || paperIdType === 'None') {
        showNotification('Please enter a Paper ID and select a valid ID type', 'warning');
        return;
    }
    showNotification('Paper lookup functionality will be implemented here.\nID: ' + paperId + '\nType: ' + paperIdType, 'info');
});
document.getElementById('paperForm').addEventListener('submit', function(e) {
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
function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    
    const colors = {
        'success': 'bg-green-50 dark:bg-green-900/30 border-green-200 dark:border-green-800 text-green-800 dark:text-green-200',
        'warning': 'bg-amber-50 dark:bg-amber-900/30 border-amber-200 dark:border-amber-800 text-amber-800 dark:text-amber-200',
        'info': 'bg-blue-50 dark:bg-blue-900/30 border-blue-200 dark:border-blue-800 text-blue-800 dark:text-blue-200',
        'error': 'bg-red-50 dark:bg-red-900/30 border-red-200 dark:border-red-800 text-red-800 dark:text-red-200'
    };
    
    const icons = {
        'success': 'bi-check-circle-fill text-green-500',
        'warning': 'bi-exclamation-triangle-fill text-amber-500',
        'info': 'bi-info-circle-fill text-blue-500',
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