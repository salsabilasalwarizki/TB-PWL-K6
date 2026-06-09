@extends('layouts.app')
@section('title', 'Link External Dataset - Keywords - DataSphere ML Repository')
@section('meta_desc', 'Step 4: Add keywords for your linked external dataset')

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
                            Step 4 of 6 — Keywords
                        </p>
                    </div>
                </div>
            </div>
            
            <!-- Progress Bar -->
            <div class="p-6 md:p-8 bg-gradient-to-r from-indigo-50 to-purple-50 dark:from-gray-800 dark:to-gray-800">
                <div class="flex items-center justify-between mb-3">
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 rounded-full bg-gradient-to-br from-indigo-500 to-purple-500 flex items-center justify-center text-white font-bold text-sm">
                            4
                        </div>
                        <span class="text-sm font-bold text-gray-900 dark:text-white">Keywords</span>
                    </div>
                    <span class="text-xs font-semibold text-indigo-700 dark:text-indigo-400 bg-indigo-100 dark:bg-indigo-900/30 px-3 py-1 rounded-full">
                        Page 4 / 6
                    </span>
                </div>
                
                <!-- Progress indicators -->
                <div class="hidden md:flex items-center gap-1 mb-3">
                    <div class="flex-1 h-2 rounded-full bg-gradient-to-r from-indigo-500 to-purple-500"></div>
                    <div class="flex-1 h-2 rounded-full bg-gradient-to-r from-indigo-500 to-purple-500"></div>
                    <div class="flex-1 h-2 rounded-full bg-gradient-to-r from-indigo-500 to-purple-500"></div>
                    <div class="flex-1 h-2 rounded-full bg-gradient-to-r from-indigo-500 to-purple-500"></div>
                    @for($i = 5; $i <= 6; $i++)
                        <div class="flex-1 h-2 rounded-full bg-gray-200 dark:bg-gray-700"></div>
                    @endfor
                </div>
                <div class="md:hidden h-2 rounded-full bg-gray-200 dark:bg-gray-700 overflow-hidden">
                    <div class="h-full bg-gradient-to-r from-indigo-500 to-purple-500" style="width: 66.67%"></div>
                </div>
                
                <!-- Step labels -->
                <div class="hidden md:grid grid-cols-6 gap-1 mt-2 text-[10px] text-gray-500 dark:text-gray-400">
                    <span class="text-center font-semibold text-indigo-700 dark:text-indigo-400">Basic</span>
                    <span class="text-center font-semibold text-indigo-700 dark:text-indigo-400">Paper</span>
                    <span class="text-center font-semibold text-indigo-700 dark:text-indigo-400">Creators</span>
                    <span class="text-center font-semibold text-indigo-700 dark:text-indigo-400">Keywords</span>
                    <span class="text-center">Variables</span>
                    <span class="text-center">Review</span>
                </div>
            </div>
        </div>
        
        <form action="{{ route('contribute.linking.keywords.store') }}" method="POST" id="keywordsForm">
            @csrf
            
            <!-- Keywords Section -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 overflow-hidden mb-6">
                <div class="bg-gradient-to-r from-amber-50 to-orange-50 dark:from-gray-800 dark:to-gray-800 border-b border-gray-200 dark:border-gray-700 p-5 md:p-6">
                    <div class="flex items-center justify-between flex-wrap gap-3">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-lg bg-amber-100 dark:bg-amber-900/30 flex items-center justify-center">
                                <i class="bi bi-tags text-xl text-amber-600 dark:text-amber-400"></i>
                            </div>
                            <div>
                                <h2 class="text-lg font-bold text-gray-900 dark:text-white">Add Keywords</h2>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Search existing or create new keywords</p>
                            </div>
                        </div>
                        <span class="text-xs font-semibold text-amber-700 dark:text-amber-400 bg-amber-100 dark:bg-amber-900/30 px-3 py-1 rounded-full">
                            <span id="keywordCountBadge">0</span> Keyword(s)
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
                            <strong class="font-semibold">Tip:</strong> Search for an existing keyword below, or type a new keyword and press <kbd class="px-1.5 py-0.5 rounded bg-blue-100 dark:bg-blue-800 text-xs font-mono">Enter</kbd> to add it.
                        </div>
                    </div>
                    
                    <!-- Keyword Input with Autocomplete -->
                    <div class="relative">
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            <i class="bi bi-search text-amber-500 me-1"></i>Search Keywords
                        </label>
                        <div class="relative">
                            <input 
                                type="text" 
                                class="w-full px-4 py-3 pr-12 rounded-xl bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition-all" 
                                id="keywordInput" 
                                placeholder="Type to search or add keywords..."
                                autocomplete="off"
                            >
                            <div class="absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none">
                                <kbd class="hidden sm:inline-flex items-center gap-1 px-2 py-1 rounded-md bg-gray-100 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-xs font-mono text-gray-600 dark:text-gray-400">
                                    <span>↵</span>
                                    <span class="text-[10px]">Enter</span>
                                </kbd>
                            </div>
                        </div>
                        
                        <!-- Autocomplete Dropdown -->
                        <div id="keywordDropdown" class="absolute left-0 right-0 mt-2 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl shadow-lg overflow-hidden z-50 hidden">
                            <div class="px-4 py-2 bg-gradient-to-r from-indigo-50 to-purple-50 dark:from-gray-800 dark:to-gray-800 border-b border-gray-200 dark:border-gray-700">
                                <p class="text-xs font-semibold text-gray-700 dark:text-gray-300">
                                    <i class="bi bi-lightbulb text-amber-500 me-1"></i>Suggested keywords:
                                </p>
                            </div>
                            <div id="keywordDropdownList" class="max-h-60 overflow-y-auto p-2"></div>
                        </div>
                    </div>
                    
                    <!-- Keyword Tags -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            <i class="bi bi-tags text-amber-500 me-1"></i>Selected Keywords
                        </label>
                        <div id="keywordTags" class="min-h-[80px] p-4 rounded-xl bg-gradient-to-br from-amber-50/50 to-orange-50/50 dark:from-gray-700/30 dark:to-gray-700/30 border-2 border-dashed border-amber-200 dark:border-amber-800/50">
                            <div id="emptyKeywordsMsg" class="text-center py-4">
                                <div class="w-14 h-14 mx-auto mb-2 rounded-2xl bg-gradient-to-br from-amber-100 to-orange-100 dark:from-amber-900/30 dark:to-orange-900/30 flex items-center justify-center">
                                    <i class="bi bi-tags text-2xl text-amber-500 dark:text-amber-400"></i>
                                </div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">No keywords added yet</p>
                                <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">Start typing above to add keywords</p>
                            </div>
                        </div>
                        <input type="hidden" name="keywords" id="keywordsHidden">
                    </div>
                </div>
            </div>
            
            <!-- Navigation -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 p-5 md:p-6 sticky bottom-4">
                <div class="flex flex-col sm:flex-row items-center justify-between gap-3">
                    <a href="{{ route('contribute.linking.creators') }}" 
                       class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200 font-semibold hover:bg-gray-200 dark:hover:bg-gray-600 transition-all">
                        <i class="bi bi-arrow-left"></i>
                        <span>Back</span>
                    </a>
                    
                    <div class="flex items-center gap-3 w-full sm:w-auto">
                        <span class="text-xs text-gray-500 dark:text-gray-400 hidden sm:inline">
                            Step 4 of 6
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
document.addEventListener('DOMContentLoaded', function() {
    const input = document.getElementById('keywordInput');
    const dropdown = document.getElementById('keywordDropdown');
    const dropdownList = document.getElementById('keywordDropdownList');
    const tagsContainer = document.getElementById('keywordTags');
    const hiddenInput = document.getElementById('keywordsHidden');
    const emptyMsg = document.getElementById('emptyKeywordsMsg');
    const countBadge = document.getElementById('keywordCountBadge');
    
    let keywords = [];
    let allKeywords = @json($allKeywords ?? []);
    let activeIndex = -1;

    // Load existing keywords
    const existing = @json(old('keywords', $keywordsData ?? []));
    if (existing && existing.length > 0) {
        keywords = existing;
        renderTags();
        updateHiddenInput();
    }

    function updateHiddenInput() {
        hiddenInput.value = JSON.stringify(keywords);
        countBadge.textContent = keywords.length;
    }

    function renderTags() {
        tagsContainer.innerHTML = '';
        
        if (keywords.length === 0) {
            tagsContainer.innerHTML = `
                <div id="emptyKeywordsMsg" class="text-center py-4">
                    <div class="w-14 h-14 mx-auto mb-2 rounded-2xl bg-gradient-to-br from-amber-100 to-orange-100 dark:from-amber-900/30 dark:to-orange-900/30 flex items-center justify-center">
                        <i class="bi bi-tags text-2xl text-amber-500 dark:text-amber-400"></i>
                    </div>
                    <p class="text-sm text-gray-500 dark:text-gray-400">No keywords added yet</p>
                    <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">Start typing above to add keywords</p>
                </div>
            `;
            return;
        }
        
        keywords.forEach(kw => {
            const tag = document.createElement('span');
            tag.className = 'inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-gradient-to-r from-amber-500 to-orange-500 text-white text-sm font-semibold shadow-md hover:shadow-lg transition-all animate-fadeIn';
            tag.innerHTML = `
                <i class="bi bi-tag-fill text-xs"></i>
                <span>${kw}</span>
                <button type="button" class="remove-tag w-5 h-5 rounded-full bg-white/20 hover:bg-white/30 flex items-center justify-center transition-colors" data-kw="${kw}">
                    <i class="bi bi-x text-xs"></i>
                </button>
            `;
            tag.style.margin = '0.25rem';
            tagsContainer.appendChild(tag);
        });
    }

    function showDropdown(filtered) {
        dropdownList.innerHTML = '';
        if (filtered.length === 0) {
            dropdown.classList.add('hidden');
            return;
        }
        filtered.forEach((kw, index) => {
            const item = document.createElement('button');
            item.type = 'button';
            item.className = 'w-full text-left px-3 py-2 rounded-lg hover:bg-amber-50 dark:hover:bg-amber-900/20 transition-colors flex items-center gap-2 group';
            item.innerHTML = `
                <i class="bi bi-plus-circle text-amber-500 group-hover:text-amber-600"></i>
                <span class="text-sm text-gray-700 dark:text-gray-300 group-hover:text-amber-700 dark:group-hover:text-amber-400 font-medium">${kw}</span>
            `;
            item.addEventListener('click', () => selectKeyword(kw));
            dropdownList.appendChild(item);
        });
        dropdown.classList.remove('hidden');
        activeIndex = -1;
    }

    function selectKeyword(kw) {
        if (!keywords.includes(kw)) {
            keywords.push(kw);
            renderTags();
            updateHiddenInput();
        }
        input.value = '';
        dropdown.classList.add('hidden');
    }

    // Input event - filter keywords
    input.addEventListener('input', function() {
        const val = this.value.toLowerCase().trim();
        if (val.length === 0) {
            dropdown.classList.add('hidden');
            return;
        }
        const filtered = allKeywords.filter(kw => 
            kw.toLowerCase().includes(val) && !keywords.includes(kw)
        );
        showDropdown(filtered);
    });

    // Keyboard navigation
    input.addEventListener('keydown', function(e) {
        const items = dropdownList.querySelectorAll('button');
        
        if (e.key === 'ArrowDown') {
            e.preventDefault();
            activeIndex = (activeIndex + 1) % items.length;
            items.forEach((item, i) => {
                item.classList.toggle('bg-amber-50', i === activeIndex);
                item.classList.toggle('dark:bg-amber-900/20', i === activeIndex);
            });
        } else if (e.key === 'ArrowUp') {
            e.preventDefault();
            activeIndex = (activeIndex - 1 + items.length) % items.length;
            items.forEach((item, i) => {
                item.classList.toggle('bg-amber-50', i === activeIndex);
                item.classList.toggle('dark:bg-amber-900/20', i === activeIndex);
            });
        } else if (e.key === 'Enter') {
            e.preventDefault();
            if (activeIndex >= 0 && items[activeIndex]) {
                items[activeIndex].click();
            } else {
                const val = this.value.trim();
                if (val && !keywords.includes(val)) {
                    keywords.push(val);
                    renderTags();
                    updateHiddenInput();
                    this.value = '';
                }
            }
            dropdown.classList.add('hidden');
        } else if (e.key === 'Escape') {
            dropdown.classList.add('hidden');
        }
    });

    // Remove keyword
    tagsContainer.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-tag') || e.target.closest('.remove-tag')) {
            const btn = e.target.closest('.remove-tag');
            const kwToRemove = btn.getAttribute('data-kw');
            keywords = keywords.filter(k => k !== kwToRemove);
            renderTags();
            updateHiddenInput();
        }
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', function(e) {
        if (!input.contains(e.target) && !dropdown.contains(e.target)) {
            dropdown.classList.add('hidden');
        }
    });

    // Form submit - loading state
    document.getElementById('keywordsForm').addEventListener('submit', function(e) {
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
});
</script>
@endpush

<style>
@keyframes fadeIn {
    from { opacity: 0; transform: scale(0.8); }
    to { opacity: 1; transform: scale(1); }
}
.animate-fadeIn {
    animation: fadeIn 0.3s ease-out;
}
</style>
@endsection