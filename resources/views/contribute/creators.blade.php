@extends('layouts.app')
@section('title', 'Dataset Donation - Creators - DataSphere ML Repository')
@section('meta_desc', 'Step 3: Add creators for your dataset donation')

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
                        <i class="bi bi-people-fill text-3xl text-white"></i>
                    </div>
                    <div>
                        <h1 class="text-3xl md:text-4xl font-bold text-white">
                            Dataset Donation Form
                        </h1>
                        <p class="text-white/90 text-sm md:text-base mt-1">
                            Step 3 of 7 — Creators Information
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
                            3
                        </div>
                        <span class="text-sm font-bold text-gray-900 dark:text-white">Creators</span>
                    </div>
                    <span class="text-xs font-semibold text-amber-700 dark:text-amber-400 bg-amber-100 dark:bg-amber-900/30 px-3 py-1 rounded-full">
                        Page 3 / 7
                    </span>
                </div>
                
                <!-- Step indicators -->
                <div class="hidden md:flex items-center gap-1 mb-3">
                    @for($i = 1; $i <= 7; $i++)
                        <div class="flex-1 h-2 rounded-full {{ $i <= 3 ? 'bg-gradient-to-r from-amber-500 to-orange-500' : 'bg-gray-200 dark:bg-gray-700' }}"></div>
                    @endfor
                </div>
                <div class="md:hidden h-2 rounded-full bg-gray-200 dark:bg-gray-700 overflow-hidden">
                    <div class="h-full bg-gradient-to-r from-amber-500 to-orange-500" style="width: 42.5%"></div>
                </div>
                
                <!-- Step labels -->
                <div class="hidden md:grid grid-cols-7 gap-1 mt-2 text-[10px] text-gray-500 dark:text-gray-400">
                    <span class="text-center font-semibold text-amber-700 dark:text-amber-400">Basic</span>
                    <span class="text-center font-semibold text-amber-700 dark:text-amber-400">Paper</span>
                    <span class="text-center font-semibold text-amber-700 dark:text-amber-400">Creators</span>
                    <span class="text-center">Files</span>
                    <span class="text-center">Keywords</span>
                    <span class="text-center">Variables</span>
                    <span class="text-center">Descriptive</span>
                </div>
            </div>
        </div>
        
        <!-- Form -->
        <form action="{{ route('contribute.creators.store') }}" method="POST" id="creatorsForm">
            @csrf
            
            <!-- ============================================ -->
            <!-- SECTION: Creators -->
            <!-- ============================================ -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 overflow-hidden mb-6">
                <div class="bg-gradient-to-r from-rose-50 to-pink-50 dark:from-gray-800 dark:to-gray-800 border-b border-gray-200 dark:border-gray-700 p-5 md:p-6">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg bg-rose-100 dark:bg-rose-900/30 flex items-center justify-center">
                            <i class="bi bi-person-plus text-xl text-rose-600 dark:text-rose-400"></i>
                        </div>
                        <div class="flex-1">
                            <h2 class="text-lg font-bold text-gray-900 dark:text-white">Add Creators</h2>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Optional: Add people who contributed to this dataset</p>
                        </div>
                        <span class="text-xs font-semibold text-rose-700 dark:text-rose-400 bg-rose-100 dark:bg-rose-900/30 px-3 py-1 rounded-full">
                            <span id="creatorCount">0</span> Creator(s)
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
                            <strong class="font-semibold">Note:</strong> Creator information will be publicly visible on the dataset page. You can add multiple creators.
                        </div>
                    </div>
                    
                    <!-- Creators List -->
                    <div id="creators-container" class="space-y-4">
                        @php
                            $creators = old('creators', $creatorsData ?? []);
                        @endphp
                        
                        @forelse($creators as $index => $creator)
                            @include('contribute.partials.creator-item', [
                                'index' => $index,
                                'creator' => $creator,
                                'canRemove' => true
                            ])
                        @empty
                            <div id="no-creators-msg" class="text-center py-12">
                                <div class="w-20 h-20 mx-auto mb-4 rounded-2xl bg-gradient-to-br from-rose-100 to-pink-100 dark:from-rose-900/30 dark:to-pink-900/30 flex items-center justify-center">
                                    <i class="bi bi-people text-4xl text-rose-500 dark:text-rose-400"></i>
                                </div>
                                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">No Creators Added Yet</h3>
                                <p class="text-sm text-gray-500 dark:text-gray-400 mb-6 max-w-md mx-auto">
                                    Click the button below to add creators who contributed to this dataset.
                                </p>
                            </div>
                        @endforelse
                    </div>
                    
                    <!-- Add Creator Button -->
                    <div class="pt-4 border-t border-gray-100 dark:border-gray-700">
                        <button type="button" 
                                id="addCreatorBtn"
                                onclick="addCreator()"
                                class="w-full inline-flex items-center justify-center gap-2 px-6 py-4 rounded-xl border-2 border-dashed border-rose-300 dark:border-rose-700 text-rose-600 dark:text-rose-400 font-semibold hover:border-rose-500 hover:bg-rose-50 dark:hover:bg-rose-900/10 hover:-translate-y-0.5 transition-all">
                            <div class="w-8 h-8 rounded-full bg-rose-100 dark:bg-rose-900/30 flex items-center justify-center">
                                <i class="bi bi-plus-lg"></i>
                            </div>
                            <span id="addCreatorText">BEGIN ADDING CREATORS</span>
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- ============================================ -->
            <!-- Navigation -->
            <!-- ============================================ -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 p-5 md:p-6 sticky bottom-4">
                <div class="flex flex-col sm:flex-row items-center justify-between gap-3">
                    <a href="{{ route('contribute.paper') }}" 
                       class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200 font-semibold hover:bg-gray-200 dark:hover:bg-gray-600 transition-all">
                        <i class="bi bi-arrow-left"></i>
                        <span>Back</span>
                    </a>
                    
                    <div class="flex items-center gap-3 w-full sm:w-auto">
                        <span class="text-xs text-gray-500 dark:text-gray-400 hidden sm:inline">
                            Step 3 of 7
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

<!-- Hidden template for new creator -->
<template id="creator-template">
    <div class="creator-item bg-gradient-to-br from-rose-50/50 to-pink-50/50 dark:from-gray-700/30 dark:to-gray-700/30 border-2 border-rose-200 dark:border-rose-800/50 rounded-2xl p-5 md:p-6 transition-all hover:shadow-lg animate-fadeIn" data-index="__INDEX__">
        <div class="flex items-center justify-between mb-5 pb-4 border-b border-rose-200 dark:border-rose-800/50">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-rose-500 to-pink-500 flex items-center justify-center text-white font-bold text-sm shadow-md">
                    <span class="creator-number">__DISPLAY_INDEX__</span>
                </div>
                <div>
                    <h6 class="text-sm font-bold text-gray-900 dark:text-white">Creator __DISPLAY_INDEX__</h6>
                    <p class="text-xs text-gray-500 dark:text-gray-400">Fill in creator details</p>
                </div>
            </div>
            <button type="button" 
                    class="btn-remove-creator inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-red-50 dark:bg-red-900/20 text-red-600 dark:text-red-400 text-xs font-semibold hover:bg-red-100 dark:hover:bg-red-900/40 transition-colors"
                    onclick="removeCreator(__INDEX__)">
                <i class="bi bi-trash"></i>
                <span class="hidden sm:inline">Remove</span>
            </button>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- Name -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                    <i class="bi bi-person me-1 text-rose-500"></i>Name <span class="text-red-500">*</span>
                </label>
                <input type="text" 
                       class="creator-input w-full px-4 py-3 rounded-xl bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:border-rose-500 focus:ring-2 focus:ring-rose-500/20 transition-all" 
                       name="creators[__INDEX__][name]" 
                       placeholder="e.g., John Doe"
                       required>
            </div>
            
            <!-- Affiliation -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                    <i class="bi bi-building me-1 text-rose-500"></i>Affiliation
                </label>
                <input type="text" 
                       class="creator-input w-full px-4 py-3 rounded-xl bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:border-rose-500 focus:ring-2 focus:ring-rose-500/20 transition-all" 
                       name="creators[__INDEX__][affiliation]"
                       placeholder="e.g., University of California">
            </div>
            
            <!-- Email -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                    <i class="bi bi-envelope me-1 text-rose-500"></i>Email
                </label>
                <input type="email" 
                       class="creator-input w-full px-4 py-3 rounded-xl bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:border-rose-500 focus:ring-2 focus:ring-rose-500/20 transition-all" 
                       name="creators[__INDEX__][email]"
                       placeholder="creator@example.com">
            </div>
            
            <!-- ORCID -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                    <i class="bi bi-person-badge me-1 text-rose-500"></i>ORCID
                </label>
                <input type="text" 
                       class="creator-input w-full px-4 py-3 rounded-xl bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:border-rose-500 focus:ring-2 focus:ring-rose-500/20 transition-all" 
                       name="creators[__INDEX__][orcid]"
                       placeholder="0000-0000-0000-0000">
                <p class="mt-1.5 text-xs text-gray-500 dark:text-gray-400 flex items-center gap-1">
                    <i class="bi bi-info-circle"></i>Format: 0000-0000-0000-0000
                </p>
            </div>
            
            <!-- Contribution Role -->
            <div class="md:col-span-2">
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                    <i class="bi bi-award me-1 text-rose-500"></i>Contribution Role
                </label>
                <select class="creator-input w-full px-4 py-3 rounded-xl bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-white focus:outline-none focus:border-rose-500 focus:ring-2 focus:ring-rose-500/20 transition-all appearance-none cursor-pointer" 
                        name="creators[__INDEX__][contribution_role]">
                    <option value="Creator">Creator - Original creator of the dataset</option>
                    <option value="Donor">Donor - Donated the dataset to repository</option>
                    <option value="Analyst">Analyst - Analyzed and processed the data</option>
                    <option value="Data Collector">Data Collector - Collected the raw data</option>
                    <option value="Other">Other - Other contribution</option>
                </select>
            </div>
        </div>
    </div>
</template>

<style>
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fadeIn {
        animation: fadeIn 0.3s ease-out;
    }
</style>

@push('scripts')
<script>
    let creatorIndex = {{ count($creatorsData ?? old('creators', [])) }};
    
    function updateCreatorCount() {
        const count = document.querySelectorAll('.creator-item').length;
        document.getElementById('creatorCount').textContent = count;
        
        // Toggle no creators message
        const noCreatorsMsg = document.getElementById('no-creators-msg');
        const addBtnText = document.getElementById('addCreatorText');
        
        if (count === 0) {
            if (noCreatorsMsg) noCreatorsMsg.style.display = 'block';
            if (addBtnText) addBtnText.textContent = 'BEGIN ADDING CREATORS';
        } else {
            if (noCreatorsMsg) noCreatorsMsg.style.display = 'none';
            if (addBtnText) addBtnText.textContent = 'ADD ANOTHER CREATOR';
        }
        
        // Update all creator numbers
        document.querySelectorAll('.creator-item').forEach((item, index) => {
            const numEl = item.querySelector('.creator-number');
            if (numEl) numEl.textContent = index + 1;
        });
    }
    
    function addCreator() {
        const template = document.getElementById('creator-template');
        const clone = template.content.cloneNode(true);
        
        // Replace placeholders
        const html = clone.querySelector('.creator-item').outerHTML
            .replace(/__INDEX__/g, creatorIndex)
            .replace(/__DISPLAY_INDEX__/g, creatorIndex + 1);
        
        // Add to container
        const container = document.getElementById('creators-container');
        const tempDiv = document.createElement('div');
        tempDiv.innerHTML = html;
        container.appendChild(tempDiv.firstElementChild);
        
        creatorIndex++;
        updateCreatorCount();
        
        // Focus on first input of new creator
        setTimeout(() => {
            const lastCreator = container.querySelector('.creator-item:last-child');
            if (lastCreator) {
                const firstInput = lastCreator.querySelector('input[name*="[name]"]');
                if (firstInput) {
                    firstInput.focus();
                    firstInput.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
            }
        }, 100);
    }
    
    function removeCreator(index) {
        const creatorItem = document.querySelector(`.creator-item[data-index="${index}"]`);
        if (creatorItem) {
            // Add exit animation
            creatorItem.style.transition = 'all 0.3s ease';
            creatorItem.style.opacity = '0';
            creatorItem.style.transform = 'translateX(20px)';
            
            setTimeout(() => {
                creatorItem.remove();
                updateCreatorCount();
            }, 300);
        }
    }
    
    // Initial count update
    updateCreatorCount();
    
    // ORCID format validation
    document.addEventListener('input', function(e) {
        if (e.target.name && e.target.name.includes('[orcid]')) {
            let value = e.target.value.replace(/[^0-9-]/g, '');
            // Auto-format: XXXX-XXXX-XXXX-XXXX
            if (value.length > 0 && !value.includes('-')) {
                value = value.replace(/(.{4})/g, '$1-').slice(0, 19);
            }
            e.target.value = value;
        }
    });
    
    // Form validation before submit
    document.getElementById('creatorsForm').addEventListener('submit', function(e) {
        const creators = document.querySelectorAll('.creator-item');
        
        if (creators.length === 0) {
            // Allow submission with no creators (optional)
            return true;
        }
        
        // Validate each creator has at least a name
        let valid = true;
        creators.forEach(creator => {
            const nameInput = creator.querySelector('input[name*="[name]"]');
            if (nameInput && !nameInput.value.trim()) {
                valid = false;
                nameInput.classList.add('border-red-500', 'focus:border-red-500', 'focus:ring-red-500/20');
                nameInput.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
            
            // Validate ORCID format if provided
            const orcidInput = creator.querySelector('input[name*="[orcid]"]');
            if (orcidInput && orcidInput.value.trim()) {
                const orcidRegex = /^\d{4}-\d{4}-\d{4}-\d{4}$/;
                if (!orcidRegex.test(orcidInput.value.trim())) {
                    valid = false;
                    orcidInput.classList.add('border-red-500', 'focus:border-red-500', 'focus:ring-red-500/20');
                }
            }
        });
        
        if (!valid) {
            e.preventDefault();
            alert('Please fill in all required fields (Name) and check ORCID format for each creator.');
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

@push('styles')
<style>
    /* Creator Item Component - untuk Blade partial jika dibutuhkan */
    .creator-item {
        background: linear-gradient(135deg, rgba(244, 63, 94, 0.02), rgba(236, 72, 153, 0.02));
    }
</style>
@endpush
@endsection