
<?php $__env->startSection('title', 'Link External Dataset - Variable Info - DataSphere ML Repository'); ?>
<?php $__env->startSection('meta_desc', 'Step 5: Provide variable information for your linked external dataset'); ?>

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
                            Step 5 of 6 — Variable Information
                        </p>
                    </div>
                </div>
            </div>
            
            <!-- Progress Bar -->
            <div class="p-6 md:p-8 bg-gradient-to-r from-indigo-50 to-purple-50 dark:from-gray-800 dark:to-gray-800">
                <div class="flex items-center justify-between mb-3">
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 rounded-full bg-gradient-to-br from-indigo-500 to-purple-500 flex items-center justify-center text-white font-bold text-sm">
                            5
                        </div>
                        <span class="text-sm font-bold text-gray-900 dark:text-white">Variables</span>
                    </div>
                    <span class="text-xs font-semibold text-indigo-700 dark:text-indigo-400 bg-indigo-100 dark:bg-indigo-900/30 px-3 py-1 rounded-full">
                        Page 5 / 6
                    </span>
                </div>
                
                <!-- Progress bar -->
                <div class="hidden md:flex items-center gap-1 mb-3">
                    <div class="flex-1 h-2 rounded-full bg-gradient-to-r from-indigo-500 to-purple-500"></div>
                    <div class="flex-1 h-2 rounded-full bg-gradient-to-r from-indigo-500 to-purple-500"></div>
                    <div class="flex-1 h-2 rounded-full bg-gradient-to-r from-indigo-500 to-purple-500"></div>
                    <div class="flex-1 h-2 rounded-full bg-gradient-to-r from-indigo-500 to-purple-500"></div>
                    <div class="flex-1 h-2 rounded-full bg-gradient-to-r from-indigo-500 to-purple-500"></div>
                    <div class="flex-1 h-2 rounded-full bg-gray-200 dark:bg-gray-700"></div>
                </div>
                <div class="md:hidden h-2 rounded-full bg-gray-200 dark:bg-gray-700 overflow-hidden">
                    <div class="h-full bg-gradient-to-r from-indigo-500 to-purple-500" style="width: 83.33%"></div>
                </div>
                
                <!-- Step labels -->
                <div class="hidden md:grid grid-cols-6 gap-1 mt-2 text-[10px] text-gray-500 dark:text-gray-400">
                    <span class="text-center font-semibold text-indigo-700 dark:text-indigo-400">Basic</span>
                    <span class="text-center font-semibold text-indigo-700 dark:text-indigo-400">Paper</span>
                    <span class="text-center font-semibold text-indigo-700 dark:text-indigo-400">Creators</span>
                    <span class="text-center font-semibold text-indigo-700 dark:text-indigo-400">Keywords</span>
                    <span class="text-center font-semibold text-indigo-700 dark:text-indigo-400">Variables</span>
                    <span class="text-center">Review</span>
                </div>
            </div>
        </div>
        
        <form action="<?php echo e(route('contribute.linking.variable-info.store')); ?>" method="POST" id="variableInfoForm">
            <?php echo csrf_field(); ?>
            
            <!-- ============================================ -->
            <!-- SECTION: Variable Information -->
            <!-- ============================================ -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 overflow-hidden mb-6">
                <div class="bg-gradient-to-r from-violet-50 to-purple-50 dark:from-gray-800 dark:to-gray-800 border-b border-gray-200 dark:border-gray-700 p-5 md:p-6">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg bg-violet-100 dark:bg-violet-900/30 flex items-center justify-center">
                            <i class="bi bi-list-columns-reverse text-xl text-violet-600 dark:text-violet-400"></i>
                        </div>
                        <div>
                            <h2 class="text-lg font-bold text-gray-900 dark:text-white">Variable Information</h2>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Optional: Describe variables in your dataset</p>
                        </div>
                    </div>
                </div>
                
                <div class="p-5 md:p-6 space-y-6">
                    
                    <!-- Info Alert -->
                    <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-xl p-4 flex items-start gap-3">
                        <div class="flex-shrink-0 w-8 h-8 rounded-lg bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center">
                            <i class="bi bi-info-circle text-lg text-blue-600 dark:text-blue-400"></i>
                        </div>
                        <div class="flex-1 text-sm text-blue-800 dark:text-blue-200">
                            <strong class="font-semibold">Tip:</strong> Providing detailed variable information helps users understand your dataset structure and use it effectively.
                        </div>
                    </div>
                    
                    <!-- Class Labels -->
                    <div>
                        <label for="class_labels" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            <i class="bi bi-tags me-1 text-violet-500"></i>Class Labels
                        </label>
                        <textarea 
                            id="class_labels" 
                            name="class_labels" 
                            rows="4"
                            maxlength="5000"
                            oninput="updateCharCount(this, 5000)"
                            placeholder="e.g., Class1, Class2, Class3 (one per line or comma-separated)"
                            class="var-textarea w-full px-4 py-3 rounded-xl bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:border-violet-500 focus:ring-2 focus:ring-violet-500/20 transition-all resize-none"><?php echo e(old('class_labels', $data['class_labels'] ?? '')); ?></textarea>
                        <div class="flex justify-between mt-1.5">
                            <p class="text-xs text-gray-500 dark:text-gray-400">List the possible values for the target variable if this is a classification dataset</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400"><span id="class_labelsCount"><?php echo e(strlen(old('class_labels', $data['class_labels'] ?? ''))); ?></span>/5000</p>
                        </div>
                        <?php $__errorArgs = ['class_labels'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-2 text-xs text-red-500 flex items-center gap-1">
                            <i class="bi bi-exclamation-circle"></i><?php echo e($message); ?>

                        </p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    
                    <!-- Divider -->
                    <div class="border-t border-gray-200 dark:border-gray-700"></div>
                    
                    <!-- Additional Variable Info -->
                    <div>
                        <label for="variable_info" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            <i class="bi bi-card-text me-1 text-violet-500"></i>Additional Variable Information
                        </label>
                        <textarea 
                            id="variable_info" 
                            name="variable_info" 
                            rows="8"
                            maxlength="10000"
                            oninput="updateCharCount(this, 10000)"
                            placeholder="Describe the variables in the dataset, their meanings, units, ranges, etc."
                            class="var-textarea w-full px-4 py-3 rounded-xl bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:border-violet-500 focus:ring-2 focus:ring-violet-500/20 transition-all resize-none"><?php echo e(old('variable_info', $data['variable_info'] ?? '')); ?></textarea>
                        <div class="flex justify-between mt-1.5">
                            <p class="text-xs text-gray-500 dark:text-gray-400">Include information about what each variable represents, measurement units, value ranges, or any other relevant details</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400"><span id="variable_infoCount"><?php echo e(strlen(old('variable_info', $data['variable_info'] ?? ''))); ?></span>/10000</p>
                        </div>
                        <?php $__errorArgs = ['variable_info'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-2 text-xs text-red-500 flex items-center gap-1">
                            <i class="bi bi-exclamation-circle"></i><?php echo e($message); ?>

                        </p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    
                    <!-- Helper Box: Example Format -->
                    <div class="bg-gradient-to-r from-violet-50/50 to-purple-50/50 dark:from-violet-900/10 dark:to-purple-900/10 border border-violet-200 dark:border-violet-800 rounded-xl p-5">
                        <div class="flex items-center gap-2 mb-3">
                            <i class="bi bi-lightbulb text-lg text-violet-600 dark:text-violet-400"></i>
                            <h3 class="text-sm font-bold text-gray-900 dark:text-white">Example Format</h3>
                        </div>
                        <pre class="text-xs text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 rounded-lg p-3 overflow-x-auto font-mono border border-gray-200 dark:border-gray-700"><code>age: continuous.
education: categorical (Bachelors, Masters, PhD, High School).
income: continuous (USD, range: 0-500000).
target: categorical (>50K, <=50K).</code></pre>
                    </div>
                </div>
            </div>
            
            <!-- ============================================ -->
            <!-- Navigation -->
            <!-- ============================================ -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 p-5 md:p-6 sticky bottom-4">
                <div class="flex flex-col sm:flex-row items-center justify-between gap-3">
                    <a href="<?php echo e(route('contribute.linking.keywords')); ?>" 
                       class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200 font-semibold hover:bg-gray-200 dark:hover:bg-gray-600 transition-all">
                        <i class="bi bi-arrow-left"></i>
                        <span>Back</span>
                    </a>
                    
                    <div class="flex items-center gap-3 w-full sm:w-auto">
                        <span class="text-xs text-gray-500 dark:text-gray-400 hidden sm:inline">
                            Step 5 of 6
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

<?php $__env->startPush('scripts'); ?>
<script>
    // Character counter for textareas
    function updateCharCount(textarea, max) {
        const count = textarea.value.length;
        const counterId = textarea.id + 'Count';
        const counter = document.getElementById(counterId);
        if (counter) {
            counter.textContent = count;
            if (count > max * 0.9) {
                counter.classList.add('text-amber-600', 'font-semibold');
            } else {
                counter.classList.remove('text-amber-600', 'font-semibold');
            }
        }
    }
    
    // Initialize all counters on page load
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.var-textarea').forEach(textarea => {
            const max = parseInt(textarea.getAttribute('maxlength'));
            if (max) updateCharCount(textarea, max);
        });
    });
    
    // Form submission with loading state
    document.getElementById('variableInfoForm').addEventListener('submit', function(e) {
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
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Documents\TB-PWL-DATASPHERE\resources\views/linking/variable-info.blade.php ENDPATH**/ ?>