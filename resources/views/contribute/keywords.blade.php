@extends('layouts.app')
@section('title', 'Dataset Donation - Keywords - DataSphere ML Repository')
@section('meta_desc', 'Step 5: Add keywords for your dataset donation')

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
                        <i class="bi bi-tags-fill text-3xl text-white"></i>
                    </div>
                    <div>
                        <h1 class="text-3xl md:text-4xl font-bold text-white">
                            Dataset Donation Form
                        </h1>
                        <p class="text-white/90 text-sm md:text-base mt-1">
                            Step 5 of 7 — Keywords & Tags
                        </p>
                    </div>
                </div>
            </div>
            
            <!-- Modern Progress Bar -->
            <div class="p-6 md:p-8 bg-gradient-to-r from-amber-50 to-orange-50 dark:from-gray-800 dark:to-gray-800">
                <div class="flex items-center justify-between mb-3">
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 rounded-full bg-gradient-to-br from-amber-500 to-orange-500 flex items-center justify-center text-white font-bold text-sm">
                            5
                        </div>
                        <span class="text-sm font-bold text-gray-900 dark:text-white">Keywords</span>
                    </div>
                    <span class="text-xs font-semibold text-amber-700 dark:text-amber-400 bg-amber-100 dark:bg-amber-900/30 px-3 py-1 rounded-full">
                        Page 5 / 7
                    </span>
                </div>
                
                <!-- Step indicators -->
                <div class="hidden md:flex items-center gap-1 mb-3">
                    @for($i = 1; $i <= 7; $i++)
                        <div class="flex-1 h-2 rounded-full {{ $i <= 5 ? 'bg-gradient-to-r from-amber-500 to-orange-500' : 'bg-gray-200 dark:bg-gray-700' }}"></div>
                    @endfor
                </div>
                <div class="md:hidden h-2 rounded-full bg-gray-200 dark:bg-gray-700 overflow-hidden">
                    <div class="h-full bg-gradient-to-r from-amber-500 to-orange-500" style="width: 71%"></div>
                </div>
                
                <!-- Step labels -->
                <div class="hidden md:grid grid-cols-7 gap-1 mt-2 text-[10px] text-gray-500 dark:text-gray-400">
                    <span class="text-center font-semibold text-amber-700 dark:text-amber-400">Basic</span>
                    <span class="text-center font-semibold text-amber-700 dark:text-amber-400">Paper</span>
                    <span class="text-center font-semibold text-amber-700 dark:text-amber-400">Creators</span>
                    <span class="text-center font-semibold text-amber-700 dark:text-amber-400">Files</span>
                    <span class="text-center font-semibold text-amber-700 dark:text-amber-400">Keywords</span>
                    <span class="text-center">Variables</span>
                    <span class="text-center">Descriptive</span>
                </div>
            </div>
        </div>
        
        <form action="{{ route('contribute.keywords.store') }}" method="POST" id="keywordsForm">
            @csrf
            
            <!-- ============================================ -->
            <!-- SECTION 1: Add Keywords -->
            <!-- ============================================ -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 overflow-hidden mb-6">
                <div class="bg-gradient-to-r from-amber-50 to-orange-50 dark:from-gray-800 dark:to-gray-800 border-b border-gray-200 dark:border-gray-700 p-5 md:p-6">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg bg-amber-100 dark:bg-amber-900/30 flex items-center justify-center">
                            <i class="bi bi-plus-circle text-xl text-amber-600 dark:text-amber-400"></i>
                        </div>
                        <div class="flex-1">
                            <h2 class="text-lg font-bold text-gray-900 dark:text-white">Add Keywords</h2>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Search existing keywords or create new ones</p>
                        </div>
                        <span class="text-xs font-semibold text-amber-700 dark:text-amber-400 bg-amber-100 dark:bg-amber-900/30 px-3 py-1 rounded-full">
                            <span id="keywordCount">0</span> Keyword(s)
                        </span>
                    </div>
                </div>
                
                <div class="p-5 md:p-6 space-y-5">
                    
                    <!-- Info Alert -->
                    <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-xl p-4 flex items-start gap-3">
                        <div class="flex-shrink-0 w-8 h-8 rounded-lg bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center">
                            <i class="bi bi-info-circle text-lg text-blue-600 dark:text-blue-400"></i>
                        </div>
                        <div class="flex-1 text-sm text-blue-800 dark:text-blue-200">
                            <strong class="font-semibold">Tip:</strong> Keywords help users discover your dataset. Add relevant terms that describe your dataset's content, domain, and applications.
                        </div>
                    </div>
                    
                    <!-- Keyword Input -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            <i class="bi bi-search me-1 text-amber-500"></i>Search or Add Keywords
                        </label>
                        <div class="relative">
                            <input type="text" 
                                   id="keyword_input"
                                   placeholder="Type a keyword and press Enter..."
                                   autocomplete="off"
                                   class="w-full px-4 py-3 pr-12 rounded-xl bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:border-amber-500 focus:ring-2 focus:ring-amber-500/20 transition-all">
                            <div class="absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none">
                                <kbd class="hidden sm:inline-flex items-center gap-1 px-2 py-1 rounded-md bg-gray-100 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-xs font-mono text-gray-600 dark:text-gray-400">
                                    <span>↵</span>
                                    <span class="text-[10px]">Enter</span>
                                </kbd>
                            </div>
                        </div>
                        
                        <!-- Suggestions Dropdown -->
                        <div id="keyword_suggestions" class="hidden mt-2 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl shadow-lg overflow-hidden">
                            <div class="px-4 py-2 bg-gradient-to-r from-amber-50 to-orange-50 dark:from-gray-800 dark:to-gray-800 border-b border-gray-200 dark:border-gray-700">
                                <p class="text-xs font-semibold text-gray-700 dark:text-gray-300">
                                    <i class="bi bi-lightbulb text-amber-500 me-1"></i>Suggested keywords:
                                </p>
                            </div>
                            <div id="suggestions_list" class="p-2 max-h-48 overflow-y-auto">
                                <!-- Dynamic suggestions -->
                            </div>
                        </div>
                    </div>
                    
                    <!-- Selected Keywords -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">
                            <i class="bi bi-check-circle me-1 text-amber-500"></i>Selected Keywords
                        </label>
                        <div id="keywords_container" class="min-h-[100px] p-4 rounded-xl bg-gradient-to-br from-amber-50/50 to-orange-50/50 dark:from-gray-700/30 dark:to-gray-700/30 border-2 border-dashed border-amber-200 dark:border-amber-800/50">
                            @php
                                $keywords = old('keywords', $keywordsData ?? []);
                            @endphp
                            
                            @forelse($keywords as $index => $keyword)
                                <span class="keyword-tag inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-gradient-to-r from-amber-500 to-orange-500 text-white text-sm font-semibold shadow-md hover:shadow-lg transition-all animate-fadeIn">
                                    <i class="bi bi-tag-fill text-xs"></i>
                                    <span>{{ $keyword }}</span>
                                    <button type="button" 
                                            onclick="removeKeyword('{{ $keyword }}', {{ $index }})"
                                            class="w-5 h-5 rounded-full bg-white/20 hover:bg-white/30 flex items-center justify-center transition-colors">
                                        <i class="bi bi-x text-xs"></i>
                                    </button>
                                </span>
                            @empty
                                <div id="empty_keywords" class="text-center py-8">
                                    <div class="w-16 h-16 mx-auto mb-3 rounded-2xl bg-gradient-to-br from-amber-100 to-orange-100 dark:from-amber-900/30 dark:to-orange-900/30 flex items-center justify-center">
                                        <i class="bi bi-tags text-3xl text-amber-500 dark:text-amber-400"></i>
                                    </div>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">No keywords added yet</p>
                                    <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">Start typing above or click popular keywords below</p>
                                </div>
                            @endforelse
                        </div>
                        <input type="hidden" name="keywords" id="keywords_input" value="{{ json_encode($keywords) }}">
                    </div>
                </div>
            </div>
            
            <!-- ============================================ -->
            <!-- SECTION 2: Popular Keywords -->
            <!-- ============================================ -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 overflow-hidden mb-6">
                <div class="bg-gradient-to-r from-orange-50 to-red-50 dark:from-gray-800 dark:to-gray-800 border-b border-gray-200 dark:border-gray-700 p-5 md:p-6">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg bg-orange-100 dark:bg-orange-900/30 flex items-center justify-center">
                            <i class="bi bi-fire text-xl text-orange-600 dark:text-orange-400"></i>
                        </div>
                        <div>
                            <h2 class="text-lg font-bold text-gray-900 dark:text-white">Popular Keywords</h2>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Click to quickly add trending keywords</p>
                        </div>
                    </div>
                </div>
                
                <div class="p-5 md:p-6">
                    <div class="flex flex-wrap gap-2" id="popular_keywords">
                        @php
                            $popularKeywords = [
                                'Classification', 'Regression', 'Clustering', 'Machine Learning',
                                'Deep Learning', 'Neural Networks', 'Data Mining', 'Pattern Recognition',
                                'Natural Language Processing', 'Computer Vision', 'Time Series',
                                'Image Processing', 'Text Mining', 'Supervised Learning',
                                'Unsupervised Learning', 'Reinforcement Learning', 'Feature Extraction',
                                'Dimensionality Reduction', 'Ensemble Methods', 'Cross Validation'
                            ];
                        @endphp
                        
                        @foreach($popularKeywords as $keyword)
                            <button type="button"
                                    onclick="addKeyword('{{ $keyword }}')"
                                    data-keyword="{{ $keyword }}"
                                    class="popular-keyword inline-flex items-center gap-1.5 px-4 py-2 rounded-full bg-white dark:bg-gray-700 border-2 border-orange-200 dark:border-orange-800 text-orange-700 dark:text-orange-400 text-sm font-semibold hover:border-orange-500 hover:bg-orange-50 dark:hover:bg-orange-900/20 hover:shadow-md hover:-translate-y-0.5 transition-all">
                                <i class="bi bi-plus-circle text-xs"></i>
                                <span>{{ $keyword }}</span>
                            </button>
                        @endforeach
                    </div>
                </div>
            </div>
            
            <!-- ============================================ -->
            <!-- Navigation -->
            <!-- ============================================ -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 p-5 md:p-6 sticky bottom-4">
                <div class="flex flex-col sm:flex-row items-center justify-between gap-3">
                    <a href="{{ route('contribute.files') }}" 
                       class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200 font-semibold hover:bg-gray-200 dark:hover:bg-gray-600 transition-all">
                        <i class="bi bi-arrow-left"></i>
                        <span>Back</span>
                    </a>
                    
                    <div class="flex items-center gap-3 w-full sm:w-auto">
                        <span class="text-xs text-gray-500 dark:text-gray-400 hidden sm:inline">
                            Step 5 of 7
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

<!-- Notification Container -->
<div id="notification_container" class="fixed top-20 right-4 z-50 space-y-2"></div>

<style>
    @keyframes fadeIn {
        from { opacity: 0; transform: scale(0.8); }
        to { opacity: 1; transform: scale(1); }
    }
    .animate-fadeIn {
        animation: fadeIn 0.3s ease-out;
    }
    
    .keyword-tag {
        margin: 0.25rem;
    }
</style>

@push('scripts')
<script>
    let keywords = @json($keywordsData ?? old('keywords', []));
    const allKeywords = @json($allKeywords ?? []);
    
    // Initialize
    document.addEventListener('DOMContentLoaded', function() {
        updateKeywordsDisplay();
        updateKeywordCount();
        
        // Input handler
        const input = document.getElementById('keyword_input');
        input.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                const keyword = this.value.trim();
                if (keyword) {
                    addKeyword(keyword);
                    this.value = '';
                    hideSuggestions();
                }
            }
        });
        
        // Show suggestions on input
        input.addEventListener('input', function() {
            const value = this.value.trim().toLowerCase();
            if (value.length > 0) {
                showSuggestions(value);
            } else {
                hideSuggestions();
            }
        });
        
        // Hide suggestions when clicking outside
        document.addEventListener('click', function(e) {
            if (!e.target.closest('#keyword_input') && !e.target.closest('#keyword_suggestions')) {
                hideSuggestions();
            }
        });
        
        // Mark already added keywords in popular section
        keywords.forEach(kw => {
            const btn = document.querySelector(`.popular-keyword[data-keyword="${kw}"]`);
            if (btn) {
                btn.classList.add('opacity-50', 'cursor-not-allowed', 'pointer-events-none');
                btn.innerHTML = `<i class="bi bi-check-circle text-xs"></i><span>${kw}</span>`;
            }
        });
    });
    
    // Add keyword
    function addKeyword(keyword) {
        const normalizedKeyword = keyword.trim();
        
        // Check if already exists
        if (keywords.includes(normalizedKeyword)) {
            showNotification('Keyword already added!', 'warning');
            return;
        }
        
        keywords.push(normalizedKeyword);
        updateKeywordsDisplay();
        updateHiddenInput();
        updateKeywordCount();
        
        // Mark as added in popular keywords
        const btn = document.querySelector(`.popular-keyword[data-keyword="${normalizedKeyword}"]`);
        if (btn) {
            btn.classList.add('opacity-50', 'cursor-not-allowed', 'pointer-events-none');
            btn.innerHTML = `<i class="bi bi-check-circle text-xs"></i><span>${normalizedKeyword}</span>`;
        }
        
        showNotification(`Keyword "${normalizedKeyword}" added`, 'success');
    }
    
    // Remove keyword
    function removeKeyword(keyword, index) {
        keywords.splice(index, 1);
        updateKeywordsDisplay();
        updateHiddenInput();
        updateKeywordCount();
        
        // Unmark in popular keywords
        const btn = document.querySelector(`.popular-keyword[data-keyword="${keyword}"]`);
        if (btn) {
            btn.classList.remove('opacity-50', 'cursor-not-allowed', 'pointer-events-none');
            btn.innerHTML = `<i class="bi bi-plus-circle text-xs"></i><span>${keyword}</span>`;
        }
        
        showNotification(`Keyword "${keyword}" removed`, 'info');
    }
    
    // Update display
    function updateKeywordsDisplay() {
        const container = document.getElementById('keywords_container');
        
        if (keywords.length === 0) {
            container.innerHTML = `
                <div id="empty_keywords" class="text-center py-8">
                    <div class="w-16 h-16 mx-auto mb-3 rounded-2xl bg-gradient-to-br from-amber-100 to-orange-100 dark:from-amber-900/30 dark:to-orange-900/30 flex items-center justify-center">
                        <i class="bi bi-tags text-3xl text-amber-500 dark:text-amber-400"></i>
                    </div>
                    <p class="text-sm text-gray-500 dark:text-gray-400">No keywords added yet</p>
                    <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">Start typing above or click popular keywords below</p>
                </div>
            `;
        } else {
            container.innerHTML = keywords.map((keyword, index) => `
                <span class="keyword-tag inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-gradient-to-r from-amber-500 to-orange-500 text-white text-sm font-semibold shadow-md hover:shadow-lg transition-all animate-fadeIn">
                    <i class="bi bi-tag-fill text-xs"></i>
                    <span>${keyword}</span>
                    <button type="button" 
                            onclick="removeKeyword('${keyword}', ${index})"
                            class="w-5 h-5 rounded-full bg-white/20 hover:bg-white/30 flex items-center justify-center transition-colors">
                        <i class="bi bi-x text-xs"></i>
                    </button>
                </span>
            `).join('');
        }
    }
    
    // Update keyword count
    function updateKeywordCount() {
        document.getElementById('keywordCount').textContent = keywords.length;
    }
    
    // Update hidden input for form submission
    function updateHiddenInput() {
        document.getElementById('keywords_input').value = JSON.stringify(keywords);
    }
    
    // Show suggestions
    function showSuggestions(query) {
        const suggestionsDiv = document.getElementById('keyword_suggestions');
        const suggestionsList = document.getElementById('suggestions_list');
        
        // Filter keywords that match query and are not already added
        const filtered = allKeywords.filter(kw => 
            kw.toLowerCase().includes(query) && !keywords.includes(kw)
        ).slice(0, 8);
        
        if (filtered.length > 0) {
            suggestionsList.innerHTML = filtered.map(kw => `
                <button type="button"
                        onclick="addKeyword('${kw}')"
                        class="w-full text-left px-3 py-2 rounded-lg hover:bg-amber-50 dark:hover:bg-amber-900/20 transition-colors flex items-center gap-2 group">
                    <i class="bi bi-plus-circle text-amber-500 group-hover:text-amber-600"></i>
                    <span class="text-sm text-gray-700 dark:text-gray-300 group-hover:text-amber-700 dark:group-hover:text-amber-400 font-medium">${kw}</span>
                </button>
            `).join('');
            
            suggestionsDiv.classList.remove('hidden');
        } else {
            hideSuggestions();
        }
    }
    
    // Hide suggestions
    function hideSuggestions() {
        document.getElementById('keyword_suggestions').classList.add('hidden');
    }
    
    // Show notification
    function showNotification(message, type = 'info') {
        const container = document.getElementById('notification_container');
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
        
        notification.className = `${colors[type]} border rounded-xl p-4 flex items-start gap-3 shadow-lg animate-fadeIn min-w-[300px]`;
        notification.innerHTML = `
            <i class="bi ${icons[type]} text-xl mt-0.5 flex-shrink-0"></i>
            <p class="text-sm font-medium flex-1">${message}</p>
            <button onclick="this.parentElement.remove()" class="flex-shrink-0 opacity-60 hover:opacity-100 transition-opacity">
                <i class="bi bi-x-lg"></i>
            </button>
        `;
        
        container.appendChild(notification);
        
        setTimeout(() => {
            notification.style.transition = 'all 0.3s ease';
            notification.style.opacity = '0';
            notification.style.transform = 'translateX(100%)';
            setTimeout(() => notification.remove(), 300);
        }, 3000);
    }
    
    // Form validation
    document.getElementById('keywordsForm').addEventListener('submit', function(e) {
        // Keywords are optional, so no validation needed
        // But show loading state
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