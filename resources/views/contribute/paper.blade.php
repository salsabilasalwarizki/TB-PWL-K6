@extends('layouts.app')
@section('title', 'Dataset Donation - Paper - DataSphere ML Repository')
@section('meta_desc', 'Step 2: Add introductory paper for your dataset donation')

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
                        <i class="bi bi-journal-text text-3xl text-white"></i>
                    </div>
                    <div>
                        <h1 class="text-3xl md:text-4xl font-bold text-white">
                            Dataset Donation Form
                        </h1>
                        <p class="text-white/90 text-sm md:text-base mt-1">
                            Step 2 of 7 — Introductory Paper
                        </p>
                    </div>
                </div>
            </div>
            
            <!-- Modern Progress Bar -->
            <div class="p-6 md:p-8 bg-gradient-to-r from-amber-50 to-orange-50 dark:from-gray-800 dark:to-gray-800">
                <div class="flex items-center justify-between mb-3">
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 rounded-full bg-gradient-to-br from-amber-500 to-orange-500 flex items-center justify-center text-white font-bold text-sm">
                            2
                        </div>
                        <span class="text-sm font-bold text-gray-900 dark:text-white">Introductory Paper</span>
                    </div>
                    <span class="text-xs font-semibold text-amber-700 dark:text-amber-400 bg-amber-100 dark:bg-amber-900/30 px-3 py-1 rounded-full">
                        Page 2 / 7
                    </span>
                </div>
                
                <!-- Step indicators -->
                <div class="hidden md:flex items-center gap-1 mb-3">
                    @for($i = 1; $i <= 7; $i++)
                        <div class="flex-1 h-2 rounded-full {{ $i <= 2 ? 'bg-gradient-to-r from-amber-500 to-orange-500' : 'bg-gray-200 dark:bg-gray-700' }}"></div>
                    @endfor
                </div>
                <div class="md:hidden h-2 rounded-full bg-gray-200 dark:bg-gray-700 overflow-hidden">
                    <div class="h-full bg-gradient-to-r from-amber-500 to-orange-500" style="width: 28.5%"></div>
                </div>
                
                <!-- Step labels -->
                <div class="hidden md:grid grid-cols-7 gap-1 mt-2 text-[10px] text-gray-500 dark:text-gray-400">
                    <span class="text-center font-semibold text-amber-700 dark:text-amber-400">Basic</span>
                    <span class="text-center font-semibold text-amber-700 dark:text-amber-400">Paper</span>
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
        
        <form action="{{ route('contribute.paper.store') }}" method="POST" id="paperForm">
            @csrf
            
            <!-- ============================================ -->
            <!-- SECTION 1: Auto-fill Paper -->
            <!-- ============================================ -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 overflow-hidden mb-6">
                <div class="bg-gradient-to-r from-cyan-50 to-blue-50 dark:from-gray-800 dark:to-gray-800 border-b border-gray-200 dark:border-gray-700 p-5 md:p-6">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg bg-cyan-100 dark:bg-cyan-900/30 flex items-center justify-center">
                            <i class="bi bi-magic text-xl text-cyan-600 dark:text-cyan-400"></i>
                        </div>
                        <div>
                            <h2 class="text-lg font-bold text-gray-900 dark:text-white">Auto-fill Paper Details</h2>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Quick lookup using DOI, arXiv, or PubMed ID</p>
                        </div>
                    </div>
                </div>
                
                <div class="p-5 md:p-6">
                    <!-- Info Box -->
                    <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-xl p-4 flex items-start gap-3 mb-5">
                        <div class="flex-shrink-0 w-8 h-8 rounded-lg bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center">
                            <i class="bi bi-lightbulb text-lg text-blue-600 dark:text-blue-400"></i>
                        </div>
                        <div class="flex-1 text-sm text-blue-800 dark:text-blue-200">
                            <strong class="font-semibold">Pro Tip:</strong> Enter a DOI, arXiv ID, or PubMed ID and click "Find" to automatically fill in the paper details.
                        </div>
                    </div>
                    
                    <!-- Auto-fill Form -->
                    <div class="grid grid-cols-1 md:grid-cols-12 gap-3">
                        <!-- ID Type -->
                        <div class="md:col-span-4">
                            <label for="paper_id_type" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                <i class="bi bi-tag me-1 text-cyan-500"></i>ID Type
                            </label>
                            <select class="w-full px-4 py-3 rounded-xl bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-white focus:outline-none focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500/20 transition-all appearance-none cursor-pointer" 
                                    id="paper_id_type" 
                                    name="paper_id_type">
                                <option value="None" {{ old('paper_id_type', session('donation_wizard.paper.paper_id_type', 'None')) == 'None' ? 'selected' : '' }}>None</option>
                                <option value="DOI" {{ old('paper_id_type', session('donation_wizard.paper.paper_id_type', '')) == 'DOI' ? 'selected' : '' }}>DOI</option>
                                <option value="arXiv" {{ old('paper_id_type', session('donation_wizard.paper.paper_id_type', '')) == 'arXiv' ? 'selected' : '' }}>arXiv</option>
                                <option value="PubMed" {{ old('paper_id_type', session('donation_wizard.paper.paper_id_type', '')) == 'PubMed' ? 'selected' : '' }}>PubMed</option>
                            </select>
                        </div>
                        
                        <!-- Paper ID -->
                        <div class="md:col-span-5">
                            <label for="paper_id" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                <i class="bi bi-upc-scan me-1 text-cyan-500"></i>Paper ID
                            </label>
                            <input type="text" 
                                   class="w-full px-4 py-3 rounded-xl bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500/20 transition-all" 
                                   id="paper_id" 
                                   name="paper_id" 
                                   value="{{ old('paper_id', session('donation_wizard.paper.paper_id', '')) }}"
                                   placeholder="e.g., 10.1000/xyz123">
                        </div>
                        
                        <!-- Find Button -->
                        <div class="md:col-span-3 flex items-end">
                            <button type="button" 
                                    id="btnFindPaper" 
                                    disabled
                                    class="w-full inline-flex items-center justify-center gap-2 px-4 py-3 rounded-xl bg-gray-100 dark:bg-gray-700 text-gray-400 dark:text-gray-500 font-semibold text-sm cursor-not-allowed transition-all">
                                <i class="bi bi-search"></i>
                                <span>Find</span>
                            </button>
                        </div>
                    </div>
                    
                    <!-- Find Result Message -->
                    <div id="findResult" class="hidden mt-4"></div>
                </div>
            </div>
            
            <!-- ============================================ -->
            <!-- SECTION 2: Manual Paper Entry -->
            <!-- ============================================ -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 overflow-hidden mb-6">
                <div class="bg-gradient-to-r from-brand-50 to-sphere-secondary/10 dark:from-gray-800 dark:to-gray-800 border-b border-gray-200 dark:border-gray-700 p-5 md:p-6">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg bg-brand-100 dark:bg-brand-900/30 flex items-center justify-center">
                            <i class="bi bi-journal-text text-xl text-brand-600 dark:text-brand-400"></i>
                        </div>
                        <div>
                            <h2 class="text-lg font-bold text-gray-900 dark:text-white">Paper Information</h2>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Details about the introductory paper (optional)</p>
                        </div>
                    </div>
                </div>
                
                <div class="p-5 md:p-6 space-y-5">
                    <!-- Paper Title -->
                    <div>
                        <label for="title" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            <i class="bi bi-card-heading me-1 text-brand-500"></i>Paper Title <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               id="title" 
                               name="title" 
                               value="{{ old('title', session('donation_wizard.paper.title', '')) }}" 
                               required 
                               maxlength="500"
                               placeholder="Enter the full paper title"
                               class="w-full px-4 py-3 rounded-xl bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 transition-all @error('title') border-red-500 focus:border-red-500 focus:ring-red-500/20 @enderror">
                        @error('title')
                        <p class="mt-2 text-xs text-red-500 flex items-center gap-1">
                            <i class="bi bi-exclamation-circle"></i>{{ $message }}
                        </p>
                        @enderror
                    </div>
                    
                    <!-- Authors -->
                    <div>
                        <label for="authors" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            <i class="bi bi-people me-1 text-brand-500"></i>Authors <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               id="authors" 
                               name="authors" 
                               value="{{ old('authors', session('donation_wizard.paper.authors', '')) }}" 
                               required 
                               maxlength="500"
                               placeholder="e.g., J. Smith, A. Johnson, K. Lee"
                               class="w-full px-4 py-3 rounded-xl bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 transition-all @error('authors') border-red-500 @enderror">
                        <p class="mt-2 text-xs text-gray-500 dark:text-gray-400 flex items-center gap-1">
                            <i class="bi bi-info-circle"></i>
                            Separate multiple authors with commas
                        </p>
                        @error('authors')
                        <p class="mt-2 text-xs text-red-500 flex items-center gap-1">
                            <i class="bi bi-exclamation-circle"></i>{{ $message }}
                        </p>
                        @enderror
                    </div>
                    
                    <!-- Venue, Year, URL -->
                    <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
                        <!-- Venue -->
                        <div class="md:col-span-6">
                            <label for="venue" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                <i class="bi bi-building me-1 text-brand-500"></i>Venue / Journal <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   id="venue" 
                                   name="venue" 
                                   value="{{ old('venue', session('donation_wizard.paper.venue', '')) }}" 
                                   required 
                                   maxlength="255"
                                   placeholder="e.g., NeurIPS 2024, JMLR"
                                   class="w-full px-4 py-3 rounded-xl bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 transition-all @error('venue') border-red-500 @enderror">
                            @error('venue')
                            <p class="mt-2 text-xs text-red-500 flex items-center gap-1">
                                <i class="bi bi-exclamation-circle"></i>{{ $message }}
                            </p>
                            @enderror
                        </div>
                        
                        <!-- Year -->
                        <div class="md:col-span-3">
                            <label for="year" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                <i class="bi bi-calendar-event me-1 text-brand-500"></i>Year <span class="text-red-500">*</span>
                            </label>
                            <input type="number" 
                                   id="year" 
                                   name="year" 
                                   value="{{ old('year', session('donation_wizard.paper.year', date('Y'))) }}" 
                                   required 
                                   min="1900" 
                                   max="{{ date('Y') }}"
                                   placeholder="e.g., 2024"
                                   class="w-full px-4 py-3 rounded-xl bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 transition-all @error('year') border-red-500 @enderror">
                            @error('year')
                            <p class="mt-2 text-xs text-red-500 flex items-center gap-1">
                                <i class="bi bi-exclamation-circle"></i>{{ $message }}
                            </p>
                            @enderror
                        </div>
                        
                        <!-- URL -->
                        <div class="md:col-span-3">
                            <label for="url" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                <i class="bi bi-link-45deg me-1 text-brand-500"></i>URL
                            </label>
                            <input type="url" 
                                   id="url" 
                                   name="url" 
                                   value="{{ old('url', session('donation_wizard.paper.url', '')) }}" 
                                   maxlength="500"
                                   placeholder="https://..."
                                   class="w-full px-4 py-3 rounded-xl bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 transition-all @error('url') border-red-500 @enderror">
                            @error('url')
                            <p class="mt-2 text-xs text-red-500 flex items-center gap-1">
                                <i class="bi bi-exclamation-circle"></i>{{ $message }}
                            </p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- ============================================ -->
            <!-- Navigation -->
            <!-- ============================================ -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 p-5 md:p-6 sticky bottom-4">
                <div class="flex flex-col sm:flex-row items-center justify-between gap-3">
                    <a href="{{ route('contribute.metadata') }}" 
                       class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200 font-semibold hover:bg-gray-200 dark:hover:bg-gray-600 transition-all">
                        <i class="bi bi-arrow-left"></i>
                        <span>Back</span>
                    </a>
                    
                    <div class="flex items-center gap-3 w-full sm:w-auto">
                        <span class="text-xs text-gray-500 dark:text-gray-400 hidden sm:inline">
                            Step 2 of 7
                        </span>
                        <button type="submit" 
                                id="nextBtn"
                                class="flex-1 sm:flex-none inline-flex items-center justify-center gap-2 px-8 py-3 rounded-xl bg-gradient-to-r from-brand-600 to-sphere-secondary text-white font-bold shadow-lg hover:shadow-xl hover:shadow-brand-500/30 hover:-translate-y-0.5 transition-all">
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
    // Enable/disable Find button based on input
    const paperType = document.getElementById('paper_id_type');
    const paperId = document.getElementById('paper_id');
    const btnFind = document.getElementById('btnFindPaper');
    const findResult = document.getElementById('findResult');
    
    function updateFindButton() {
        if (paperType.value !== 'None' && paperId.value.trim()) {
            btnFind.disabled = false;
            btnFind.className = 'w-full inline-flex items-center justify-center gap-2 px-4 py-3 rounded-xl bg-gradient-to-r from-cyan-600 to-blue-600 text-white font-semibold text-sm shadow-md hover:shadow-lg hover:shadow-cyan-500/30 hover:-translate-y-0.5 transition-all cursor-pointer';
        } else {
            btnFind.disabled = true;
            btnFind.className = 'w-full inline-flex items-center justify-center gap-2 px-4 py-3 rounded-xl bg-gray-100 dark:bg-gray-700 text-gray-400 dark:text-gray-500 font-semibold text-sm cursor-not-allowed transition-all';
        }
    }
    
    paperType.addEventListener('change', updateFindButton);
    paperId.addEventListener('input', updateFindButton);
    updateFindButton();
    
    // Find paper (mock implementation)
    btnFind.addEventListener('click', function() {
        const type = paperType.value;
        const id = paperId.value.trim();
        
        if (!id) {
            showFindResult('error', 'Please enter a Paper ID');
            return;
        }
        
        // Show loading
        const originalHTML = btnFind.innerHTML;
        btnFind.disabled = true;
        btnFind.className = 'w-full inline-flex items-center justify-center gap-2 px-4 py-3 rounded-xl bg-gradient-to-r from-cyan-600 to-blue-600 text-white font-semibold text-sm cursor-not-allowed transition-all';
        btnFind.innerHTML = `
            <svg class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            <span>Searching...</span>
        `;
        
        // Mock API call
        setTimeout(() => {
            btnFind.disabled = false;
            btnFind.innerHTML = originalHTML;
            updateFindButton();
            
            showFindResult('info', 'Auto-fill feature requires API integration. Please enter paper details manually for now.');
        }, 1500);
    });
    
    function showFindResult(type, message) {
        const colors = {
            'success': 'bg-green-50 dark:bg-green-900/20 border-green-200 dark:border-green-800 text-green-800 dark:text-green-200',
            'error': 'bg-red-50 dark:bg-red-900/20 border-red-200 dark:border-red-800 text-red-800 dark:text-red-200',
            'info': 'bg-blue-50 dark:bg-blue-900/20 border-blue-200 dark:border-blue-800 text-blue-800 dark:text-blue-200'
        };
        
        const icons = {
            'success': 'bi-check-circle-fill text-green-500',
            'error': 'bi-exclamation-circle-fill text-red-500',
            'info': 'bi-info-circle-fill text-blue-500'
        };
        
        findResult.className = `${colors[type]} border rounded-xl p-4 flex items-start gap-3`;
        findResult.innerHTML = `
            <i class="bi ${icons[type]} text-xl mt-0.5 flex-shrink-0"></i>
            <p class="text-sm flex-1">${message}</p>
            <button type="button" onclick="document.getElementById('findResult').classList.add('hidden')" class="flex-shrink-0 opacity-60 hover:opacity-100">
                <i class="bi bi-x-lg"></i>
            </button>
        `;
        findResult.classList.remove('hidden');
    }
    
    // Form validation
    document.getElementById('paperForm').addEventListener('submit', function(e) {
        const title = document.getElementById('title').value.trim();
        const authors = document.getElementById('authors').value.trim();
        const venue = document.getElementById('venue').value.trim();
        const year = document.getElementById('year').value;
        
        // If all fields are empty, allow submission (paper is optional)
        if (!title && !authors && !venue && !year) {
            return true;
        }
        
        // If any field is filled, validate required fields
        if (!title || !authors || !venue || !year) {
            e.preventDefault();
            showFindResult('error', 'Please fill in all required fields marked with *');
            window.scrollTo({ top: 0, behavior: 'smooth' });
            return false;
        }
        
        // Show loading state
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