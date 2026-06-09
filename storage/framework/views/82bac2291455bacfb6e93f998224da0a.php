
<?php $__env->startSection('title', 'Link External Dataset - Creators - DataSphere ML Repository'); ?>
<?php $__env->startSection('meta_desc', 'Step 3: Add creators for your linked external dataset'); ?>

<?php $__env->startSection('content'); ?>
<div class="min-h-screen bg-gradient-to-br from-gray-50 via-brand-50/30 to-sphere-secondary/10 dark:from-gray-900 dark:via-gray-900 dark:to-gray-900 py-8 md:py-12 px-4 sm:px-6 lg:px-8">
    
    <!-- Background Decoration -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-20 left-10 w-72 h-72 bg-brand-500/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-20 right-10 w-96 h-96 bg-sphere-secondary/10 rounded-full blur-3xl"></div>
    </div>
    
    <div class="relative max-w-4xl mx-auto">
        
        <!-- Breadcrumb -->
        <nav class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-400 mb-6">
            <a href="<?php echo e(route('home')); ?>" class="hover:text-brand-600 dark:hover:text-brand-400 transition-colors">Home</a>
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
                            Step 3 of 6 — Creators Information
                        </p>
                    </div>
                </div>
            </div>
            
            <!-- Progress Bar -->
            <div class="p-6 md:p-8 bg-gradient-to-r from-indigo-50 to-purple-50 dark:from-gray-800 dark:to-gray-800">
                <div class="flex items-center justify-between mb-3">
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 rounded-full bg-gradient-to-br from-indigo-500 to-purple-500 flex items-center justify-center text-white font-bold text-sm">
                            3
                        </div>
                        <span class="text-sm font-bold text-gray-900 dark:text-white">Creators</span>
                    </div>
                    <span class="text-xs font-semibold text-indigo-700 dark:text-indigo-400 bg-indigo-100 dark:bg-indigo-900/30 px-3 py-1 rounded-full">
                        Page 3 / 6
                    </span>
                </div>
                
                <!-- Progress bar -->
                <div class="hidden md:flex items-center gap-1 mb-3">
                    <div class="flex-1 h-2 rounded-full bg-gradient-to-r from-indigo-500 to-purple-500"></div>
                    <div class="flex-1 h-2 rounded-full bg-gradient-to-r from-indigo-500 to-purple-500"></div>
                    <div class="flex-1 h-2 rounded-full bg-gradient-to-r from-indigo-500 to-purple-500"></div>
                    <?php for($i = 4; $i <= 6; $i++): ?>
                        <div class="flex-1 h-2 rounded-full bg-gray-200 dark:bg-gray-700"></div>
                    <?php endfor; ?>
                </div>
                <div class="md:hidden h-2 rounded-full bg-gray-200 dark:bg-gray-700 overflow-hidden">
                    <div class="h-full bg-gradient-to-r from-indigo-500 to-purple-500" style="width: 50%"></div>
                </div>
                
                <!-- Step labels -->
                <div class="hidden md:grid grid-cols-6 gap-1 mt-2 text-[10px] text-gray-500 dark:text-gray-400">
                    <span class="text-center font-semibold text-indigo-700 dark:text-indigo-400">Basic</span>
                    <span class="text-center font-semibold text-indigo-700 dark:text-indigo-400">Paper</span>
                    <span class="text-center font-semibold text-indigo-700 dark:text-indigo-400">Creators</span>
                    <span class="text-center">Keywords</span>
                    <span class="text-center">Variables</span>
                    <span class="text-center">Review</span>
                </div>
            </div>
        </div>
        
        <form action="<?php echo e(route('contribute.linking.creators.store')); ?>" method="POST" id="creatorsForm">
            <?php echo csrf_field(); ?>
            
            <!-- ============================================ -->
            <!-- SECTION: Creators -->
            <!-- ============================================ -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 overflow-hidden mb-6">
                <div class="bg-gradient-to-r from-rose-50 to-pink-50 dark:from-gray-800 dark:to-gray-800 border-b border-gray-200 dark:border-gray-700 p-5 md:p-6">
                    <div class="flex items-center justify-between flex-wrap gap-3">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-lg bg-rose-100 dark:bg-rose-900/30 flex items-center justify-center">
                                <i class="bi bi-person-plus text-xl text-rose-600 dark:text-rose-400"></i>
                            </div>
                            <div>
                                <h2 class="text-lg font-bold text-gray-900 dark:text-white">Add Creators</h2>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Optional: Add people who contributed to this dataset</p>
                            </div>
                        </div>
                        <span class="text-xs font-semibold text-rose-700 dark:text-rose-400 bg-rose-100 dark:bg-rose-900/30 px-3 py-1 rounded-full">
                            <span id="creatorCount">1</span> Creator(s)
                        </span>
                    </div>
                </div>
                
                <div class="p-5 md:p-6 space-y-5">
                    
                    <!-- Note Box -->
                    <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-xl p-4 flex items-start gap-3">
                        <div class="flex-shrink-0 w-8 h-8 rounded-lg bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center">
                            <i class="bi bi-info-circle text-lg text-blue-600 dark:text-blue-400"></i>
                        </div>
                        <div class="flex-1 text-sm text-blue-800 dark:text-blue-200">
                            <strong class="font-semibold">Note:</strong> Creator information will be publicly visible on the dataset page.
                        </div>
                    </div>
                    
                    <!-- Creators Container -->
                    <div id="creatorsContainer" class="space-y-4">
                        <!-- Initial Creator (Creator 1) -->
                        <div class="creator-card bg-gradient-to-br from-rose-50/50 to-pink-50/50 dark:from-gray-700/30 dark:to-gray-700/30 border-2 border-rose-200 dark:border-rose-800/50 rounded-2xl p-5 md:p-6 transition-all hover:shadow-lg" data-index="0">
                            <div class="flex items-center justify-between mb-5 pb-4 border-b border-rose-200 dark:border-rose-800/50">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-rose-500 to-pink-500 flex items-center justify-center text-white font-bold text-sm shadow-md">
                                        <span class="creator-number">1</span>
                                    </div>
                                    <div>
                                        <h6 class="text-sm font-bold text-gray-900 dark:text-white">Creator 1</h6>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">Fill in creator details</p>
                                    </div>
                                </div>
                                <button type="button" class="btn-remove-creator inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-red-50 dark:bg-red-900/20 text-red-600 dark:text-red-400 text-xs font-semibold opacity-30 cursor-not-allowed" disabled title="Cannot remove the only creator">
                                    <i class="bi bi-trash"></i>
                                    <span class="hidden sm:inline">Remove</span>
                                </button>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1.5">
                                        <i class="bi bi-person me-1 text-rose-500"></i>First Name <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" class="creator-input w-full px-3 py-2.5 rounded-lg bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 text-sm text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:border-rose-500 focus:ring-2 focus:ring-rose-500/20 transition-all" name="creators[0][first_name]" placeholder="First Name" required>
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1.5">
                                        <i class="bi bi-person me-1 text-rose-500"></i>Last Name <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" class="creator-input w-full px-3 py-2.5 rounded-lg bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 text-sm text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:border-rose-500 focus:ring-2 focus:ring-rose-500/20 transition-all" name="creators[0][last_name]" placeholder="Last Name" required>
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1.5">
                                        <i class="bi bi-envelope me-1 text-rose-500"></i>Email
                                    </label>
                                    <input type="email" class="creator-input w-full px-3 py-2.5 rounded-lg bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 text-sm text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:border-rose-500 focus:ring-2 focus:ring-rose-500/20 transition-all" name="creators[0][email]" placeholder="Email">
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1.5">
                                        <i class="bi bi-building me-1 text-rose-500"></i>Institution
                                    </label>
                                    <input type="text" class="creator-input w-full px-3 py-2.5 rounded-lg bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 text-sm text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:border-rose-500 focus:ring-2 focus:ring-rose-500/20 transition-all" name="creators[0][institution]" placeholder="Institution">
                                </div>
                                <div class="md:col-span-2">
                                    <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1.5">
                                        <i class="bi bi-geo-alt me-1 text-rose-500"></i>Institution Address
                                    </label>
                                    <input type="text" class="creator-input w-full px-3 py-2.5 rounded-lg bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 text-sm text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:border-rose-500 focus:ring-2 focus:ring-rose-500/20 transition-all" name="creators[0][institution_address]" placeholder="Institution Address">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Add More Button -->
                    <div class="pt-4 border-t border-gray-100 dark:border-gray-700">
                        <button type="button" id="addCreatorBtn" class="w-full inline-flex items-center justify-center gap-2 px-6 py-4 rounded-xl border-2 border-dashed border-rose-300 dark:border-rose-700 text-rose-600 dark:text-rose-400 font-semibold hover:border-rose-500 hover:bg-rose-50 dark:hover:bg-rose-900/10 hover:-translate-y-0.5 transition-all">
                            <div class="w-8 h-8 rounded-full bg-rose-100 dark:bg-rose-900/30 flex items-center justify-center">
                                <i class="bi bi-plus-lg"></i>
                            </div>
                            <span>ADD MORE CREATORS</span>
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- ============================================ -->
            <!-- Navigation -->
            <!-- ============================================ -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 p-5 md:p-6 sticky bottom-4">
                <div class="flex flex-col sm:flex-row items-center justify-between gap-3">
                    <a href="<?php echo e(route('contribute.linking.paper')); ?>" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200 font-semibold hover:bg-gray-200 dark:hover:bg-gray-600 transition-all">
                        <i class="bi bi-arrow-left"></i>
                        <span>Back</span>
                    </a>
                    
                    <div class="flex items-center gap-3 w-full sm:w-auto">
                        <span class="text-xs text-gray-500 dark:text-gray-400 hidden sm:inline">
                            Step 3 of 6
                        </span>
                        <button type="submit" id="nextBtn" class="flex-1 sm:flex-none inline-flex items-center justify-center gap-2 px-8 py-3 rounded-xl bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-bold shadow-lg hover:shadow-xl hover:shadow-indigo-500/30 hover:-translate-y-0.5 transition-all">
                            <span>Next</span>
                            <i class="bi bi-arrow-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Hidden Template for JavaScript -->
<template id="creator-template">
    <div class="creator-card bg-gradient-to-br from-rose-50/50 to-pink-50/50 dark:from-gray-700/30 dark:to-gray-700/30 border-2 border-rose-200 dark:border-rose-800/50 rounded-2xl p-5 md:p-6 transition-all hover:shadow-lg animate-fadeIn" data-index="__INDEX__">
        <div class="flex items-center justify-between mb-5 pb-4 border-b border-rose-200 dark:border-rose-800/50">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-rose-500 to-pink-500 flex items-center justify-center text-white font-bold text-sm shadow-md">
                    <span class="creator-number">__NUM__</span>
                </div>
                <div>
                    <h6 class="text-sm font-bold text-gray-900 dark:text-white">Creator __NUM__</h6>
                    <p class="text-xs text-gray-500 dark:text-gray-400">Fill in creator details</p>
                </div>
            </div>
            <button type="button" class="btn-remove-creator inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-red-50 dark:bg-red-900/20 text-red-600 dark:text-red-400 text-xs font-semibold hover:bg-red-100 dark:hover:bg-red-900/40 transition-colors">
                <i class="bi bi-trash"></i>
                <span class="hidden sm:inline">Remove</span>
            </button>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1.5">
                    <i class="bi bi-person me-1 text-rose-500"></i>First Name <span class="text-red-500">*</span>
                </label>
                <input type="text" class="creator-input w-full px-3 py-2.5 rounded-lg bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 text-sm text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:border-rose-500 focus:ring-2 focus:ring-rose-500/20 transition-all" name="creators[__INDEX__][first_name]" placeholder="First Name" required>
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1.5">
                    <i class="bi bi-person me-1 text-rose-500"></i>Last Name <span class="text-red-500">*</span>
                </label>
                <input type="text" class="creator-input w-full px-3 py-2.5 rounded-lg bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 text-sm text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:border-rose-500 focus:ring-2 focus:ring-rose-500/20 transition-all" name="creators[__INDEX__][last_name]" placeholder="Last Name" required>
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1.5">
                    <i class="bi bi-envelope me-1 text-rose-500"></i>Email
                </label>
                <input type="email" class="creator-input w-full px-3 py-2.5 rounded-lg bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 text-sm text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:border-rose-500 focus:ring-2 focus:ring-rose-500/20 transition-all" name="creators[__INDEX__][email]" placeholder="Email">
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1.5">
                    <i class="bi bi-building me-1 text-rose-500"></i>Institution
                </label>
                <input type="text" class="creator-input w-full px-3 py-2.5 rounded-lg bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 text-sm text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:border-rose-500 focus:ring-2 focus:ring-rose-500/20 transition-all" name="creators[__INDEX__][institution]" placeholder="Institution">
            </div>
            <div class="md:col-span-2">
                <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1.5">
                    <i class="bi bi-geo-alt me-1 text-rose-500"></i>Institution Address
                </label>
                <input type="text" class="creator-input w-full px-3 py-2.5 rounded-lg bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 text-sm text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:border-rose-500 focus:ring-2 focus:ring-rose-500/20 transition-all" name="creators[__INDEX__][institution_address]" placeholder="Institution Address">
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

<?php $__env->startPush('scripts'); ?>
<script>
let creatorCounter = 1;

document.getElementById('addCreatorBtn').addEventListener('click', function() {
    creatorCounter++;
    const container = document.getElementById('creatorsContainer');
    const template = document.getElementById('creator-template').innerHTML;
    const newRow = document.createElement('div');
    newRow.innerHTML = template.replace(/__INDEX__/g, creatorCounter - 1).replace(/__NUM__/g, creatorCounter);
    container.appendChild(newRow.firstElementChild);
    updateCreatorCount();
    updateDeleteButtons();
    
    // Scroll to new creator
    setTimeout(() => {
        const lastCreator = container.querySelector('.creator-card:last-child');
        if (lastCreator) {
            lastCreator.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
    }, 100);
});

document.addEventListener('click', function(e) {
    if (e.target.closest('.btn-remove-creator')) {
        e.target.closest('.creator-card').remove();
        updateCreatorCount();
        updateDeleteButtons();
    }
});

function updateCreatorCount() {
    const count = document.querySelectorAll('.creator-card').length;
    document.getElementById('creatorCount').textContent = count;
    
    // Update all creator numbers
    document.querySelectorAll('.creator-card').forEach((card, index) => {
        const numEl = card.querySelector('.creator-number');
        if (numEl) numEl.textContent = index + 1;
    });
}

function updateDeleteButtons() {
    const cards = document.querySelectorAll('.creator-card');
    cards.forEach(card => {
        const btn = card.querySelector('.btn-remove-creator');
        if (cards.length === 1) {
            btn.disabled = true;
            btn.classList.add('opacity-30', 'cursor-not-allowed');
        } else {
            btn.disabled = false;
            btn.classList.remove('opacity-30', 'cursor-not-allowed');
        }
    });
}

// Form validation
document.getElementById('creatorsForm').addEventListener('submit', function(e) {
    const cards = document.querySelectorAll('.creator-card');
    let valid = true;
    
    cards.forEach(card => {
        const firstName = card.querySelector('input[name*="[first_name]"]');
        const lastName = card.querySelector('input[name*="[last_name]"]');
        
        if (firstName && !firstName.value.trim()) {
            valid = false;
            firstName.classList.add('border-red-500', 'focus:border-red-500');
        }
        if (lastName && !lastName.value.trim()) {
            valid = false;
            lastName.classList.add('border-red-500', 'focus:border-red-500');
        }
    });
    
    if (!valid) {
        e.preventDefault();
        alert('Please fill in all required fields (First Name and Last Name) for each creator.');
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
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Documents\TB-PWL-DATASPHERE\resources\views/linking/creators.blade.php ENDPATH**/ ?>