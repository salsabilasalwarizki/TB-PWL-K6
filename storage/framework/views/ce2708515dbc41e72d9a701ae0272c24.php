<?php $__env->startSection('title', 'Dataset Donation - Files - DataSphere ML Repository'); ?>
<?php $__env->startSection('meta_desc', 'Step 4: Upload your dataset files'); ?>

<?php $__env->startSection('content'); ?>
<div class="min-h-screen bg-gradient-to-br from-gray-50 via-brand-50/30 to-sphere-secondary/10 dark:from-gray-900 dark:via-gray-900 dark:to-gray-900 py-8 md:py-12 px-4 sm:px-6 lg:px-8">
    
    <!-- Background Decoration -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-20 left-10 w-72 h-72 bg-brand-500/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-20 right-10 w-96 h-96 bg-sphere-secondary/10 rounded-full blur-3xl"></div>
    </div>
    
    <div class="relative max-w-5xl mx-auto">
        
        <!-- Breadcrumb -->
        <nav class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-400 mb-6">
            <a href="<?php echo e(route('home')); ?>" class="hover:text-brand-600 dark:hover:text-brand-400 transition-colors">Home</a>
            <i class="bi bi-chevron-right text-xs"></i>
            <a href="<?php echo e(route('profile')); ?>" class="hover:text-brand-600 dark:hover:text-brand-400 transition-colors">Profile</a>
            <i class="bi bi-chevron-right text-xs"></i>
            <a href="<?php echo e(route('profile.datasets')); ?>" class="hover:text-brand-600 dark:hover:text-brand-400 transition-colors">My Datasets</a>
            <i class="bi bi-chevron-right text-xs"></i>
            <span class="text-brand-600 dark:text-brand-400 font-semibold">Donate Dataset</span>
        </nav>
        
        <!-- Header Card -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 overflow-hidden mb-6">
            <div class="bg-gradient-to-r from-brand-600 to-sphere-secondary p-8 md:p-10">
                <div class="flex items-center gap-4 mb-4">
                    <div class="w-14 h-14 rounded-xl bg-white/20 backdrop-blur-sm flex items-center justify-center">
                        <i class="bi bi-folder-fill text-3xl text-white"></i>
                    </div>
                    <div>
                        <h1 class="text-3xl md:text-4xl font-bold text-white">
                            Dataset Donation Form
                        </h1>
                        <p class="text-white/90 text-sm md:text-base mt-1">
                            Step 4 of 7 — Upload Files
                        </p>
                    </div>
                </div>
            </div>
            
            <!-- Modern Progress Bar -->
            <div class="p-6 md:p-8 bg-gradient-to-r from-amber-50 to-orange-50 dark:from-gray-800 dark:to-gray-800">
                <div class="flex items-center justify-between mb-3">
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 rounded-full bg-gradient-to-br from-amber-500 to-orange-500 flex items-center justify-center text-white font-bold text-sm">
                            4
                        </div>
                        <span class="text-sm font-bold text-gray-900 dark:text-white">Upload Files</span>
                    </div>
                    <span class="text-xs font-semibold text-amber-700 dark:text-amber-400 bg-amber-100 dark:bg-amber-900/30 px-3 py-1 rounded-full">
                        Page 4 / 7
                    </span>
                </div>
                
                <!-- Step indicators -->
                <div class="hidden md:flex items-center gap-1 mb-3">
                    <?php for($i = 1; $i <= 7; $i++): ?>
                        <div class="flex-1 h-2 rounded-full <?php echo e($i <= 4 ? 'bg-gradient-to-r from-amber-500 to-orange-500' : 'bg-gray-200 dark:bg-gray-700'); ?>"></div>
                    <?php endfor; ?>
                </div>
                <div class="md:hidden h-2 rounded-full bg-gray-200 dark:bg-gray-700 overflow-hidden">
                    <div class="h-full bg-gradient-to-r from-amber-500 to-orange-500" style="width: 57%"></div>
                </div>
                
                <!-- Step labels -->
                <div class="hidden md:grid grid-cols-7 gap-1 mt-2 text-[10px] text-gray-500 dark:text-gray-400">
                    <span class="text-center font-semibold text-amber-700 dark:text-amber-400">Basic</span>
                    <span class="text-center font-semibold text-amber-700 dark:text-amber-400">Paper</span>
                    <span class="text-center font-semibold text-amber-700 dark:text-amber-400">Creators</span>
                    <span class="text-center font-semibold text-amber-700 dark:text-amber-400">Files</span>
                    <span class="text-center">Keywords</span>
                    <span class="text-center">Variables</span>
                    <span class="text-center">Descriptive</span>
                </div>
            </div>
        </div>
        
        <!-- Error Alert -->
        <?php if($errors->any()): ?>
        <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-2xl p-5 mb-6 flex items-start gap-3">
            <div class="flex-shrink-0 w-10 h-10 rounded-lg bg-red-100 dark:bg-red-900/30 flex items-center justify-center">
                <i class="bi bi-exclamation-triangle-fill text-xl text-red-600 dark:text-red-400"></i>
            </div>
            <div class="flex-1">
                <h3 class="text-sm font-bold text-red-900 dark:text-red-200 mb-2">
                    Please fix the following errors:
                </h3>
                <ul class="space-y-1">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="text-sm text-red-700 dark:text-red-300 flex items-start gap-2">
                        <i class="bi bi-x-circle mt-0.5 flex-shrink-0"></i>
                        <span><?php echo e($error); ?></span>
                    </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        </div>
        <?php endif; ?>
        
        <form action="<?php echo e(route('contribute.files.store')); ?>" method="POST" enctype="multipart/form-data" id="filesForm">
            <?php echo csrf_field(); ?>
            
            <!-- ============================================ -->
            <!-- SECTION 1: File Format Selection -->
            <!-- ============================================ -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 overflow-hidden mb-6">
                <div class="bg-gradient-to-r from-emerald-50 to-teal-50 dark:from-gray-800 dark:to-gray-800 border-b border-gray-200 dark:border-gray-700 p-5 md:p-6">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg bg-emerald-100 dark:bg-emerald-900/30 flex items-center justify-center">
                            <i class="bi bi-file-earmark-code text-xl text-emerald-600 dark:text-emerald-400"></i>
                        </div>
                        <div>
                            <h2 class="text-lg font-bold text-gray-900 dark:text-white">
                                Data File Format <span class="text-red-500">*</span>
                            </h2>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Select the format of your main data file</p>
                        </div>
                    </div>
                </div>
                
                <div class="p-5 md:p-6">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <!-- Tabular Option -->
                        <label class="group relative flex items-start gap-4 p-5 rounded-xl bg-gray-50 dark:bg-gray-700/30 border-2 border-gray-200 dark:border-gray-700 hover:border-emerald-500 hover:bg-emerald-50 dark:hover:bg-emerald-900/10 cursor-pointer transition-all has-[:checked]:border-emerald-500 has-[:checked]:bg-emerald-50 dark:has-[:checked]:bg-emerald-900/20 has-[:checked]:shadow-lg">
                            <input type="radio" 
                                   name="file_format" 
                                   value="tabular" 
                                   id="format_tabular"
                                   <?php echo e(old('file_format', 'tabular') == 'tabular' ? 'checked' : ''); ?>

                                   onchange="toggleFormat()"
                                   class="mt-1 w-5 h-5 border-gray-300 dark:border-gray-600 text-emerald-600 focus:ring-emerald-500">
                            <div class="flex-1">
                                <div class="flex items-center gap-2 mb-1">
                                    <i class="bi bi-table text-emerald-600 dark:text-emerald-400 text-lg"></i>
                                    <span class="text-base font-bold text-gray-900 dark:text-white">Tabular</span>
                                </div>
                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                    CSV, ARFF, or TXT files with rows and columns. Includes header, variable definitions, and test data options.
                                </p>
                            </div>
                            <div class="absolute top-3 right-3 w-6 h-6 rounded-full bg-emerald-500 text-white flex items-center justify-center opacity-0 group-has-[:checked]:opacity-100 transition-opacity">
                                <i class="bi bi-check-lg text-xs"></i>
                            </div>
                        </label>
                        
                        <!-- Other Option -->
                        <label class="group relative flex items-start gap-4 p-5 rounded-xl bg-gray-50 dark:bg-gray-700/30 border-2 border-gray-200 dark:border-gray-700 hover:border-emerald-500 hover:bg-emerald-50 dark:hover:bg-emerald-900/10 cursor-pointer transition-all has-[:checked]:border-emerald-500 has-[:checked]:bg-emerald-50 dark:has-[:checked]:bg-emerald-900/20 has-[:checked]:shadow-lg">
                            <input type="radio" 
                                   name="file_format" 
                                   value="other" 
                                   id="format_other"
                                   <?php echo e(old('file_format') == 'other' ? 'checked' : ''); ?>

                                   onchange="toggleFormat()"
                                   class="mt-1 w-5 h-5 border-gray-300 dark:border-gray-600 text-emerald-600 focus:ring-emerald-500">
                            <div class="flex-1">
                                <div class="flex items-center gap-2 mb-1">
                                    <i class="bi bi-files text-emerald-600 dark:text-emerald-400 text-lg"></i>
                                    <span class="text-base font-bold text-gray-900 dark:text-white">Other</span>
                                </div>
                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                    Non-tabular formats like images, audio, video, or custom binary files. Simpler upload flow.
                                </p>
                            </div>
                            <div class="absolute top-3 right-3 w-6 h-6 rounded-full bg-emerald-500 text-white flex items-center justify-center opacity-0 group-has-[:checked]:opacity-100 transition-opacity">
                                <i class="bi bi-check-lg text-xs"></i>
                            </div>
                        </label>
                    </div>
                </div>
            </div>
            
            <!-- ============================================ -->
            <!-- TABULAR SECTION -->
            <!-- ============================================ -->
            <div id="tabular_section">
                
                <!-- Tabular Options -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 overflow-hidden mb-6">
                    <div class="bg-gradient-to-r from-cyan-50 to-blue-50 dark:from-gray-800 dark:to-gray-800 border-b border-gray-200 dark:border-gray-700 p-5 md:p-6">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-lg bg-cyan-100 dark:bg-cyan-900/30 flex items-center justify-center">
                                <i class="bi bi-table text-xl text-cyan-600 dark:text-cyan-400"></i>
                            </div>
                            <div>
                                <h2 class="text-lg font-bold text-gray-900 dark:text-white">Tabular Data Options</h2>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Configure your tabular data settings</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="p-5 md:p-6 space-y-4">
                        <!-- Has Header -->
                        <label class="group flex items-center justify-between p-4 rounded-xl bg-gray-50 dark:bg-gray-700/30 border-2 border-gray-200 dark:border-gray-700 hover:border-cyan-500 hover:bg-cyan-50 dark:hover:bg-cyan-900/10 cursor-pointer transition-all has-[:checked]:border-cyan-500 has-[:checked]:bg-cyan-50 dark:has-[:checked]:bg-cyan-900/20">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-lg bg-cyan-100 dark:bg-cyan-900/30 flex items-center justify-center group-has-[:checked]:bg-cyan-500 group-has-[:checked]:text-white transition-colors">
                                    <i class="bi bi-card-heading text-cyan-600 dark:text-cyan-400 group-has-[:checked]:text-white"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-gray-900 dark:text-white">Has Header Row</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">First row contains column names</p>
                                </div>
                            </div>
                            <div class="relative">
                                <input type="hidden" name="has_header" value="0">
                                <input type="checkbox" 
                                       name="has_header" 
                                       id="has_header" 
                                       value="1" 
                                       <?php echo e(old('has_header') == '1' ? 'checked' : ''); ?>

                                       class="sr-only peer">
                                <div class="w-11 h-6 bg-gray-300 dark:bg-gray-600 rounded-full peer-checked:bg-cyan-500 transition-colors"></div>
                                <div class="absolute top-0.5 left-0.5 w-5 h-5 bg-white rounded-full shadow-md peer-checked:translate-x-5 transition-transform"></div>
                            </div>
                        </label>
                        
                        <!-- Has Missing Values -->
                        <label class="group flex items-center justify-between p-4 rounded-xl bg-gray-50 dark:bg-gray-700/30 border-2 border-gray-200 dark:border-gray-700 hover:border-cyan-500 hover:bg-cyan-50 dark:hover:bg-cyan-900/10 cursor-pointer transition-all has-[:checked]:border-cyan-500 has-[:checked]:bg-cyan-50 dark:has-[:checked]:bg-cyan-900/20">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-lg bg-cyan-100 dark:bg-cyan-900/30 flex items-center justify-center group-has-[:checked]:bg-cyan-500 group-has-[:checked]:text-white transition-colors">
                                    <i class="bi bi-dash-circle text-cyan-600 dark:text-cyan-400 group-has-[:checked]:text-white"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-gray-900 dark:text-white">Has Missing Values</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">Dataset contains null/empty values</p>
                                </div>
                            </div>
                            <div class="relative">
                                <input type="hidden" name="has_missing" value="0">
                                <input type="checkbox" 
                                       name="has_missing" 
                                       id="has_missing" 
                                       value="1" 
                                       <?php echo e(old('has_missing') == '1' ? 'checked' : ''); ?>

                                       class="sr-only peer">
                                <div class="w-11 h-6 bg-gray-300 dark:bg-gray-600 rounded-full peer-checked:bg-cyan-500 transition-colors"></div>
                                <div class="absolute top-0.5 left-0.5 w-5 h-5 bg-white rounded-full shadow-md peer-checked:translate-x-5 transition-transform"></div>
                            </div>
                        </label>
                    </div>
                </div>
                
                <!-- Main Tabular File Upload -->
<div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 overflow-hidden mb-6">
    <div class="bg-gradient-to-r from-green-50 to-emerald-50 dark:from-gray-800 dark:to-gray-800 border-b border-gray-200 dark:border-gray-700 p-5 md:p-6">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-lg bg-green-100 dark:bg-green-900/30 flex items-center justify-center">
                <i class="bi bi-file-earmark-spreadsheet text-xl text-green-600 dark:text-green-400"></i>
            </div>
            <div>
                <h2 class="text-lg font-bold text-gray-900 dark:text-white">
                    Main Data File <span class="text-red-500">*</span>
                </h2>
                <p class="text-xs text-gray-500 dark:text-gray-400">Upload your primary tabular data file</p>
            </div>
        </div>
    </div>
    
    <div class="p-5 md:p-6">
        <div id="tabularDropZone" class="relative border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-xl p-8 md:p-10 text-center hover:border-green-500 hover:bg-green-50/50 dark:hover:bg-green-900/10 transition-all cursor-pointer">
            
            <input type="file" 
                   id="tabular_file" 
                   name="tabular_file" 
                   class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" 
                   accept=".csv,.arff,.txt">
            
            <div id="tabularContent">
                <div class="w-20 h-20 mx-auto mb-4 rounded-2xl bg-gradient-to-br from-green-100 to-emerald-100 dark:from-green-900/30 dark:to-emerald-900/30 flex items-center justify-center">
                    <i class="bi bi-cloud-arrow-up text-4xl text-green-600 dark:text-green-400"></i>
                </div>
                <p class="text-base font-semibold text-gray-700 dark:text-gray-300 mb-1">
                    Drop your file here or click to browse
                </p>
                <p class="text-xs text-gray-500 dark:text-gray-400">
                    Supported: CSV, ARFF, TXT • Max 50MB
                </p>
            </div>
            
            <div id="tabular-preview" class="hidden"></div>
        </div>
    </div>
</div>
                <!-- Variables Table -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 overflow-hidden mb-6">
                    <div class="bg-gradient-to-r from-violet-50 to-purple-50 dark:from-gray-800 dark:to-gray-800 border-b border-gray-200 dark:border-gray-700 p-5 md:p-6">
                        <div class="flex items-center justify-between flex-wrap gap-3">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-lg bg-violet-100 dark:bg-violet-900/30 flex items-center justify-center">
                                    <i class="bi bi-list-columns-reverse text-xl text-violet-600 dark:text-violet-400"></i>
                                </div>
                                <div>
                                    <h2 class="text-lg font-bold text-gray-900 dark:text-white">Variables Definition</h2>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">Define each column/variable in your dataset</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-2">
                                <span id="varCount" class="text-xs font-semibold text-violet-700 dark:text-violet-400 bg-violet-100 dark:bg-violet-900/30 px-3 py-1 rounded-full">
                                    1 Variable(s)
                                </span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="p-5 md:p-6">
                        <!-- Info Alert -->
                        <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-xl p-4 flex items-start gap-3 mb-5">
                            <div class="flex-shrink-0 w-8 h-8 rounded-lg bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center">
                                <i class="bi bi-info-circle text-lg text-blue-600 dark:text-blue-400"></i>
                            </div>
                            <div class="flex-1 text-sm text-blue-800 dark:text-blue-200">
                                <strong class="font-semibold">Tip:</strong> Define all variables (columns) in your dataset. Use "Feature" for input variables and "Target" for the variable you want to predict.
                            </div>
                        </div>
                        
                        <!-- Desktop Table View -->
                        <div class="hidden lg:block overflow-x-auto rounded-xl border border-gray-200 dark:border-gray-700">
                            <table class="w-full" id="variables_table">
                                <thead class="bg-gradient-to-r from-violet-50 to-purple-50 dark:from-gray-800 dark:to-gray-800">
                                    <tr>
                                        <th class="px-3 py-3 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">#</th>
                                        <th class="px-3 py-3 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">Name</th>
                                        <th class="px-3 py-3 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">Role</th>
                                        <th class="px-3 py-3 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">Type</th>
                                        <th class="px-3 py-3 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">Demographic</th>
                                        <th class="px-3 py-3 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">Description</th>
                                        <th class="px-3 py-3 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">Units</th>
                                        <th class="px-3 py-3 text-center text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">Missing</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                                    <?php
                                        $oldVars = old('variables', [['name' => '', 'role' => 'Feature', 'type' => 'Continuous', 'demo' => '', 'desc' => '', 'units' => '', 'missing' => 0]]);
                                    ?>
                                    <?php $__currentLoopData = $oldVars; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $idx => $var): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="hover:bg-violet-50/50 dark:hover:bg-violet-900/10 transition-colors variable-row">
                                        <td class="px-3 py-2 text-center">
                                            <span class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-violet-100 dark:bg-violet-900/30 text-violet-600 dark:text-violet-400 text-xs font-bold var-number"><?php echo e($idx + 1); ?></span>
                                        </td>
                                        <td class="px-3 py-2">
                                            <input type="text" class="w-full px-3 py-2 rounded-lg bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 text-sm text-gray-900 dark:text-white focus:outline-none focus:border-violet-500 focus:ring-1 focus:ring-violet-500/20 transition-all" 
                                                   name="variables[<?php echo e($idx); ?>][name]" 
                                                   value="<?php echo e($var['name'] ?? ''); ?>"
                                                   placeholder="Column name">
                                        </td>
                                        <td class="px-3 py-2">
                                            <select class="w-full px-2 py-2 rounded-lg bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 text-sm text-gray-900 dark:text-white focus:outline-none focus:border-violet-500 appearance-none cursor-pointer" 
                                                    name="variables[<?php echo e($idx); ?>][role]">
                                                <option value="Feature" <?php echo e(($var['role'] ?? 'Feature') == 'Feature' ? 'selected' : ''); ?>>Feature</option>
                                                <option value="Target" <?php echo e(($var['role'] ?? '') == 'Target' ? 'selected' : ''); ?>>Target</option>
                                                <option value="ID" <?php echo e(($var['role'] ?? '') == 'ID' ? 'selected' : ''); ?>>ID</option>
                                            </select>
                                        </td>
                                        <td class="px-3 py-2">
                                            <select class="w-full px-2 py-2 rounded-lg bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 text-sm text-gray-900 dark:text-white focus:outline-none focus:border-violet-500 appearance-none cursor-pointer" 
                                                    name="variables[<?php echo e($idx); ?>][type]">
                                                <option value="Continuous" <?php echo e(($var['type'] ?? 'Continuous') == 'Continuous' ? 'selected' : ''); ?>>Continuous</option>
                                                <option value="Categorical" <?php echo e(($var['type'] ?? '') == 'Categorical' ? 'selected' : ''); ?>>Categorical</option>
                                                <option value="Integer" <?php echo e(($var['type'] ?? '') == 'Integer' ? 'selected' : ''); ?>>Integer</option>
                                                <option value="Real" <?php echo e(($var['type'] ?? '') == 'Real' ? 'selected' : ''); ?>>Real</option>
                                            </select>
                                        </td>
                                        <td class="px-3 py-2">
                                            <input type="text" class="w-full px-3 py-2 rounded-lg bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 text-sm text-gray-900 dark:text-white focus:outline-none focus:border-violet-500 focus:ring-1 focus:ring-violet-500/20 transition-all" 
                                                   name="variables[<?php echo e($idx); ?>][demo]" 
                                                   value="<?php echo e($var['demo'] ?? ''); ?>"
                                                   placeholder="Optional">
                                        </td>
                                        <td class="px-3 py-2">
                                            <input type="text" class="w-full px-3 py-2 rounded-lg bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 text-sm text-gray-900 dark:text-white focus:outline-none focus:border-violet-500 focus:ring-1 focus:ring-violet-500/20 transition-all" 
                                                   name="variables[<?php echo e($idx); ?>][desc]" 
                                                   value="<?php echo e($var['desc'] ?? ''); ?>"
                                                   placeholder="Description">
                                        </td>
                                        <td class="px-3 py-2">
                                            <input type="text" class="w-full px-3 py-2 rounded-lg bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 text-sm text-gray-900 dark:text-white focus:outline-none focus:border-violet-500 focus:ring-1 focus:ring-violet-500/20 transition-all" 
                                                   name="variables[<?php echo e($idx); ?>][units]" 
                                                   value="<?php echo e($var['units'] ?? ''); ?>"
                                                   placeholder="Units">
                                        </td>
                                        <td class="px-3 py-2 text-center">
                                            <label class="relative inline-flex items-center cursor-pointer">
                                                <input type="checkbox" 
                                                       name="variables[<?php echo e($idx); ?>][missing]" 
                                                       value="1"
                                                       <?php echo e(($var['missing'] ?? 0) ? 'checked' : ''); ?>

                                                       class="sr-only peer">
                                                <div class="w-9 h-5 bg-gray-300 dark:bg-gray-600 rounded-full peer-checked:bg-violet-500 transition-colors"></div>
                                                <div class="absolute top-0.5 left-0.5 w-4 h-4 bg-white rounded-full shadow-md peer-checked:translate-x-4 transition-transform"></div>
                                            </label>
                                        </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                        
                        <!-- Mobile Card View -->
                        <div class="lg:hidden space-y-3" id="mobileVariablesContainer">
                            <?php $__currentLoopData = $oldVars; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $idx => $var): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="mobile-variable-card bg-gradient-to-br from-violet-50/50 to-purple-50/50 dark:from-gray-700/30 dark:to-gray-700/30 border-2 border-violet-200 dark:border-violet-800/50 rounded-xl p-4">
                                <div class="flex items-center justify-between mb-3">
                                    <div class="flex items-center gap-2">
                                        <span class="inline-flex items-center justify-center w-7 h-7 rounded-full bg-violet-500 text-white text-xs font-bold var-number"><?php echo e($idx + 1); ?></span>
                                        <span class="text-sm font-bold text-gray-900 dark:text-white">Variable <?php echo e($idx + 1); ?></span>
                                    </div>
                                </div>
                                <div class="space-y-2">
                                    <input type="text" class="w-full px-3 py-2 rounded-lg bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 text-sm text-gray-900 dark:text-white focus:outline-none focus:border-violet-500" 
                                           name="variables[<?php echo e($idx); ?>][name]" value="<?php echo e($var['name'] ?? ''); ?>" placeholder="Variable name *">
                                    <div class="grid grid-cols-2 gap-2">
                                        <select class="w-full px-2 py-2 rounded-lg bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 text-sm text-gray-900 dark:text-white focus:outline-none focus:border-violet-500 appearance-none" 
                                                name="variables[<?php echo e($idx); ?>][role]">
                                            <option value="Feature" <?php echo e(($var['role'] ?? 'Feature') == 'Feature' ? 'selected' : ''); ?>>Feature</option>
                                            <option value="Target" <?php echo e(($var['role'] ?? '') == 'Target' ? 'selected' : ''); ?>>Target</option>
                                            <option value="ID" <?php echo e(($var['role'] ?? '') == 'ID' ? 'selected' : ''); ?>>ID</option>
                                        </select>
                                        <select class="w-full px-2 py-2 rounded-lg bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 text-sm text-gray-900 dark:text-white focus:outline-none focus:border-violet-500 appearance-none" 
                                                name="variables[<?php echo e($idx); ?>][type]">
                                            <option value="Continuous" <?php echo e(($var['type'] ?? 'Continuous') == 'Continuous' ? 'selected' : ''); ?>>Continuous</option>
                                            <option value="Categorical" <?php echo e(($var['type'] ?? '') == 'Categorical' ? 'selected' : ''); ?>>Categorical</option>
                                            <option value="Integer" <?php echo e(($var['type'] ?? '') == 'Integer' ? 'selected' : ''); ?>>Integer</option>
                                            <option value="Real" <?php echo e(($var['type'] ?? '') == 'Real' ? 'selected' : ''); ?>>Real</option>
                                        </select>
                                    </div>
                                    <input type="text" class="w-full px-3 py-2 rounded-lg bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 text-sm text-gray-900 dark:text-white focus:outline-none focus:border-violet-500" 
                                           name="variables[<?php echo e($idx); ?>][demo]" value="<?php echo e($var['demo'] ?? ''); ?>" placeholder="Demographic">
                                    <input type="text" class="w-full px-3 py-2 rounded-lg bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 text-sm text-gray-900 dark:text-white focus:outline-none focus:border-violet-500" 
                                           name="variables[<?php echo e($idx); ?>][desc]" value="<?php echo e($var['desc'] ?? ''); ?>" placeholder="Description">
                                    <input type="text" class="w-full px-3 py-2 rounded-lg bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 text-sm text-gray-900 dark:text-white focus:outline-none focus:border-violet-500" 
                                           name="variables[<?php echo e($idx); ?>][units]" value="<?php echo e($var['units'] ?? ''); ?>" placeholder="Units">
                                    <label class="flex items-center justify-between p-2 rounded-lg bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600">
                                        <span class="text-xs text-gray-700 dark:text-gray-300">Has missing values</span>
                                        <input type="checkbox" name="variables[<?php echo e($idx); ?>][missing]" value="1" <?php echo e(($var['missing'] ?? 0) ? 'checked' : ''); ?> class="w-4 h-4 rounded border-gray-300 text-violet-600 focus:ring-violet-500">
                                    </label>
                                </div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        
                        <!-- Action Buttons -->
                        <div class="flex flex-col sm:flex-row gap-3 mt-5">
                            <button type="button" 
                                    onclick="addVariableRow()"
                                    class="flex-1 inline-flex items-center justify-center gap-2 px-4 py-3 rounded-xl bg-gradient-to-r from-violet-600 to-purple-600 text-white font-semibold text-sm shadow-md hover:shadow-lg hover:shadow-violet-500/30 hover:-translate-y-0.5 transition-all">
                                <i class="bi bi-plus-circle"></i>
                                <span>Add Variable</span>
                            </button>
                            <button type="button" 
                                    onclick="deleteVariableRow()"
                                    class="flex-1 sm:flex-none inline-flex items-center justify-center gap-2 px-4 py-3 rounded-xl bg-red-50 dark:bg-red-900/20 text-red-600 dark:text-red-400 font-semibold text-sm border border-red-200 dark:border-red-800 hover:bg-red-100 dark:hover:bg-red-900/40 transition-all">
                                <i class="bi bi-trash"></i>
                                <span>Delete Last</span>
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Other Data File -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 overflow-hidden mb-6">
                    <div class="bg-gradient-to-r from-teal-50 to-cyan-50 dark:from-gray-800 dark:to-gray-800 border-b border-gray-200 dark:border-gray-700 p-5 md:p-6">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-lg bg-teal-100 dark:bg-teal-900/30 flex items-center justify-center">
                                <i class="bi bi-paperclip text-xl text-teal-600 dark:text-teal-400"></i>
                            </div>
                            <div class="flex-1">
                                <h2 class="text-lg font-bold text-gray-900 dark:text-white">Other Data Files</h2>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Additional supporting files (optional)</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="p-5 md:p-6">
                        <div id="otherDropZone" class="relative border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-xl p-8 text-center hover:border-teal-500 hover:bg-teal-50/50 dark:hover:bg-teal-900/10 transition-all cursor-pointer">
                            <input type="file" 
                                   id="other_file" 
                                   name="other_file" 
                                   class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                            
                            <div id="otherContent">
                                <div class="w-16 h-16 mx-auto mb-3 rounded-2xl bg-gradient-to-br from-teal-100 to-cyan-100 dark:from-teal-900/30 dark:to-cyan-900/30 flex items-center justify-center">
                                    <i class="bi bi-cloud-arrow-up text-3xl text-teal-600 dark:text-teal-400"></i>
                                </div>
                                <p class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">
                                    Drop file here or click to browse
                                </p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                    Any format • Max 50MB
                                </p>
                            </div>
                            <div id="other-preview" class="hidden"></div>
                        </div>
                    </div>
                </div>
                
                <!-- Test Data File -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 overflow-hidden mb-6">
                    <div class="bg-gradient-to-r from-indigo-50 to-blue-50 dark:from-gray-800 dark:to-gray-800 border-b border-gray-200 dark:border-gray-700 p-5 md:p-6">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-lg bg-indigo-100 dark:bg-indigo-900/30 flex items-center justify-center">
                                <i class="bi bi-clipboard-check text-xl text-indigo-600 dark:text-indigo-400"></i>
                            </div>
                            <div class="flex-1">
                                <h2 class="text-lg font-bold text-gray-900 dark:text-white">Test Data File</h2>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Separate test dataset for validation (optional)</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="p-5 md:p-6">
                        <div id="testDropZone" class="relative border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-xl p-8 text-center hover:border-indigo-500 hover:bg-indigo-50/50 dark:hover:bg-indigo-900/10 transition-all cursor-pointer">
                            <input type="file" 
                                   id="test_file" 
                                   name="test_file" 
                                   class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                            
                            <div id="testContent">
                                <div class="w-16 h-16 mx-auto mb-3 rounded-2xl bg-gradient-to-br from-indigo-100 to-blue-100 dark:from-indigo-900/30 dark:to-blue-900/30 flex items-center justify-center">
                                    <i class="bi bi-cloud-arrow-up text-3xl text-indigo-600 dark:text-indigo-400"></i>
                                </div>
                                <p class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">
                                    Drop file here or click to browse
                                </p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                    Any format • Max 50MB
                                </p>
                            </div>
                            <div id="test-preview" class="hidden"></div>
                        </div>
                    </div>
                </div>
                
            </div>
            
            <!-- ============================================ -->
            <!-- OTHER FORMAT SECTION -->
            <!-- ============================================ -->
            <div id="other_section" style="display: none;">
                
                <!-- Dataset File (Other Format) -->
<div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 overflow-hidden mb-6">
    <div class="bg-gradient-to-r from-green-50 to-emerald-50 dark:from-gray-800 dark:to-gray-800 border-b border-gray-200 dark:border-gray-700 p-5 md:p-6">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-lg bg-green-100 dark:bg-green-900/30 flex items-center justify-center">
                <i class="bi bi-file-earmark-zip text-xl text-green-600 dark:text-green-400"></i>
            </div>
            <div>
                <h2 class="text-lg font-bold text-gray-900 dark:text-white">
                    Dataset File <span class="text-red-500">*</span>
                </h2>
                <p class="text-xs text-gray-500 dark:text-gray-400">Upload your main dataset file</p>
            </div>
        </div>
    </div>
    
    <div class="p-5 md:p-6">
        <div id="datasetDropZone" class="relative border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-xl p-8 md:p-10 text-center hover:border-green-500 hover:bg-green-50/50 dark:hover:bg-green-900/10 transition-all cursor-pointer">
            
            <input type="file" 
                   id="dataset_file" 
                   name="dataset_file" 
                   class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
            
            <div id="datasetContent">
                <div class="w-20 h-20 mx-auto mb-4 rounded-2xl bg-gradient-to-br from-green-100 to-emerald-100 dark:from-green-900/30 dark:to-emerald-900/30 flex items-center justify-center">
                    <i class="bi bi-cloud-arrow-up text-4xl text-green-600 dark:text-green-400"></i>
                </div>
                <p class="text-base font-semibold text-gray-700 dark:text-gray-300 mb-1">
                    Drop your file here or click to browse
                </p>
                <p class="text-xs text-gray-500 dark:text-gray-400">
                    Any format • Max 50MB
                </p>
            </div>
            <div id="dataset-preview" class="hidden"></div>
        </div>
    </div>
</div>
                <!-- Test Data File (Other Format) -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 overflow-hidden mb-6">
                    <div class="bg-gradient-to-r from-indigo-50 to-blue-50 dark:from-gray-800 dark:to-gray-800 border-b border-gray-200 dark:border-gray-700 p-5 md:p-6">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-lg bg-indigo-100 dark:bg-indigo-900/30 flex items-center justify-center">
                                <i class="bi bi-clipboard-check text-xl text-indigo-600 dark:text-indigo-400"></i>
                            </div>
                            <div>
                                <h2 class="text-lg font-bold text-gray-900 dark:text-white">Test Data File</h2>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Separate test dataset (optional)</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="p-5 md:p-6">
                        <div id="testOtherDropZone" class="relative border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-xl p-8 text-center hover:border-indigo-500 hover:bg-indigo-50/50 dark:hover:bg-indigo-900/10 transition-all cursor-pointer">
                            <input type="file" 
                                   id="test_file_other" 
                                   name="test_file_other" 
                                   class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                            
                            <div id="testOtherContent">
                                <div class="w-16 h-16 mx-auto mb-3 rounded-2xl bg-gradient-to-br from-indigo-100 to-blue-100 dark:from-indigo-900/30 dark:to-blue-900/30 flex items-center justify-center">
                                    <i class="bi bi-cloud-arrow-up text-3xl text-indigo-600 dark:text-indigo-400"></i>
                                </div>
                                <p class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">
                                    Drop file here or click to browse
                                </p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                    Any format • Max 50MB
                                </p>
                            </div>
                            <div id="testOther-preview" class="hidden"></div>
                        </div>
                    </div>
                </div>
                
            </div>
            
            <!-- ============================================ -->
            <!-- Navigation -->
            <!-- ============================================ -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 p-5 md:p-6 sticky bottom-4">
                <div class="flex flex-col sm:flex-row items-center justify-between gap-3">
                    <a href="<?php echo e(route('contribute.creators')); ?>" 
                       class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200 font-semibold hover:bg-gray-200 dark:hover:bg-gray-600 transition-all">
                        <i class="bi bi-arrow-left"></i>
                        <span>Back</span>
                    </a>
                    
                    <div class="flex items-center gap-3 w-full sm:w-auto">
                        <span class="text-xs text-gray-500 dark:text-gray-400 hidden sm:inline">
                            Step 4 of 7
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

<?php $__env->startPush('scripts'); ?>
<script>
    // Toggle between Tabular and Other format
        // Toggle between Tabular and Other format
    function toggleFormat() {
        const isTabular = document.getElementById('format_tabular').checked;
        const tabularSection = document.getElementById('tabular_section');
        const otherSection = document.getElementById('other_section');
        const tabularInput = document.getElementById('tabular_file');
        const datasetInput = document.getElementById('dataset_file');
        
        if (isTabular) {
            tabularSection.style.display = 'block';
            otherSection.style.display = 'none';
            // Set required hanya pada input yang terlihat
            tabularInput.setAttribute('required', 'required');
            datasetInput.removeAttribute('required');
        } else {
            tabularSection.style.display = 'none';
            otherSection.style.display = 'block';
            // Set required hanya pada input yang terlihat
            tabularInput.removeAttribute('required');
            datasetInput.setAttribute('required', 'required');
        }
    }
    // Add variable row
    function addVariableRow() {
        const table = document.getElementById('variables_table');
        const tbody = table.querySelector('tbody');
        const rowIndex = tbody.querySelectorAll('tr').length;
        
        const newRow = document.createElement('tr');
        newRow.className = 'hover:bg-violet-50/50 dark:hover:bg-violet-900/10 transition-colors variable-row';
        newRow.innerHTML = `
            <td class="px-3 py-2 text-center">
                <span class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-violet-100 dark:bg-violet-900/30 text-violet-600 dark:text-violet-400 text-xs font-bold var-number">${rowIndex + 1}</span>
            </td>
            <td class="px-3 py-2">
                <input type="text" class="w-full px-3 py-2 rounded-lg bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 text-sm text-gray-900 dark:text-white focus:outline-none focus:border-violet-500 focus:ring-1 focus:ring-violet-500/20 transition-all" 
                       name="variables[${rowIndex}][name]" placeholder="Column name">
            </td>
            <td class="px-3 py-2">
                <select class="w-full px-2 py-2 rounded-lg bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 text-sm text-gray-900 dark:text-white focus:outline-none focus:border-violet-500 appearance-none cursor-pointer" 
                        name="variables[${rowIndex}][role]">
                    <option value="Feature">Feature</option>
                    <option value="Target">Target</option>
                    <option value="ID">ID</option>
                </select>
            </td>
            <td class="px-3 py-2">
                <select class="w-full px-2 py-2 rounded-lg bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 text-sm text-gray-900 dark:text-white focus:outline-none focus:border-violet-500 appearance-none cursor-pointer" 
                        name="variables[${rowIndex}][type]">
                    <option value="Continuous">Continuous</option>
                    <option value="Categorical">Categorical</option>
                    <option value="Integer">Integer</option>
                    <option value="Real">Real</option>
                </select>
            </td>
            <td class="px-3 py-2">
                <input type="text" class="w-full px-3 py-2 rounded-lg bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 text-sm text-gray-900 dark:text-white focus:outline-none focus:border-violet-500 focus:ring-1 focus:ring-violet-500/20 transition-all" 
                       name="variables[${rowIndex}][demo]" placeholder="Optional">
            </td>
            <td class="px-3 py-2">
                <input type="text" class="w-full px-3 py-2 rounded-lg bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 text-sm text-gray-900 dark:text-white focus:outline-none focus:border-violet-500 focus:ring-1 focus:ring-violet-500/20 transition-all" 
                       name="variables[${rowIndex}][desc]" placeholder="Description">
            </td>
            <td class="px-3 py-2">
                <input type="text" class="w-full px-3 py-2 rounded-lg bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 text-sm text-gray-900 dark:text-white focus:outline-none focus:border-violet-500 focus:ring-1 focus:ring-violet-500/20 transition-all" 
                       name="variables[${rowIndex}][units]" placeholder="Units">
            </td>
            <td class="px-3 py-2 text-center">
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" name="variables[${rowIndex}][missing]" value="1" class="sr-only peer">
                    <div class="w-9 h-5 bg-gray-300 dark:bg-gray-600 rounded-full peer-checked:bg-violet-500 transition-colors"></div>
                    <div class="absolute top-0.5 left-0.5 w-4 h-4 bg-white rounded-full shadow-md peer-checked:translate-x-4 transition-transform"></div>
                </label>
            </td>
        `;
        
        tbody.appendChild(newRow);
        
        // Add mobile card too
        const mobileContainer = document.getElementById('mobileVariablesContainer');
        const mobileCard = document.createElement('div');
        mobileCard.className = 'mobile-variable-card bg-gradient-to-br from-violet-50/50 to-purple-50/50 dark:from-gray-700/30 dark:to-gray-700/30 border-2 border-violet-200 dark:border-violet-800/50 rounded-xl p-4';
        mobileCard.innerHTML = `
            <div class="flex items-center justify-between mb-3">
                <div class="flex items-center gap-2">
                    <span class="inline-flex items-center justify-center w-7 h-7 rounded-full bg-violet-500 text-white text-xs font-bold var-number">${rowIndex + 1}</span>
                    <span class="text-sm font-bold text-gray-900 dark:text-white">Variable ${rowIndex + 1}</span>
                </div>
            </div>
            <div class="space-y-2">
                <input type="text" class="w-full px-3 py-2 rounded-lg bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 text-sm text-gray-900 dark:text-white focus:outline-none focus:border-violet-500" 
                       name="variables[${rowIndex}][name]" placeholder="Variable name *">
                <div class="grid grid-cols-2 gap-2">
                    <select class="w-full px-2 py-2 rounded-lg bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 text-sm text-gray-900 dark:text-white focus:outline-none focus:border-violet-500 appearance-none" 
                            name="variables[${rowIndex}][role]">
                        <option value="Feature">Feature</option>
                        <option value="Target">Target</option>
                        <option value="ID">ID</option>
                    </select>
                    <select class="w-full px-2 py-2 rounded-lg bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 text-sm text-gray-900 dark:text-white focus:outline-none focus:border-violet-500 appearance-none" 
                            name="variables[${rowIndex}][type]">
                        <option value="Continuous">Continuous</option>
                        <option value="Categorical">Categorical</option>
                        <option value="Integer">Integer</option>
                        <option value="Real">Real</option>
                    </select>
                </div>
                <input type="text" class="w-full px-3 py-2 rounded-lg bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 text-sm text-gray-900 dark:text-white focus:outline-none focus:border-violet-500" 
                       name="variables[${rowIndex}][demo]" placeholder="Demographic">
                <input type="text" class="w-full px-3 py-2 rounded-lg bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 text-sm text-gray-900 dark:text-white focus:outline-none focus:border-violet-500" 
                       name="variables[${rowIndex}][desc]" placeholder="Description">
                <input type="text" class="w-full px-3 py-2 rounded-lg bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 text-sm text-gray-900 dark:text-white focus:outline-none focus:border-violet-500" 
                       name="variables[${rowIndex}][units]" placeholder="Units">
                <label class="flex items-center justify-between p-2 rounded-lg bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600">
                    <span class="text-xs text-gray-700 dark:text-gray-300">Has missing values</span>
                    <input type="checkbox" name="variables[${rowIndex}][missing]" value="1" class="w-4 h-4 rounded border-gray-300 text-violet-600 focus:ring-violet-500">
                </label>
            </div>
        `;
        mobileContainer.appendChild(mobileCard);
        
        updateVarCount();
        
        // Scroll to new row
        setTimeout(() => {
            newRow.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }, 100);
    }
    
    // Delete variable row
    function deleteVariableRow() {
        const table = document.getElementById('variables_table');
        const tbody = table.querySelector('tbody');
        const rows = tbody.querySelectorAll('tr');
        const mobileCards = document.querySelectorAll('.mobile-variable-card');
        
        if (rows.length > 1) {
            tbody.removeChild(rows[rows.length - 1]);
            if (mobileCards.length > 0) {
                mobileCards[mobileCards.length - 1].remove();
            }
            updateVarCount();
            renumberVariables();
        } else {
            alert('At least one variable row is required.');
        }
    }
    
    function updateVarCount() {
        const count = document.querySelectorAll('#variables_table tbody tr').length;
        document.getElementById('varCount').textContent = `${count} Variable(s)`;
    }
    
    function renumberVariables() {
        document.querySelectorAll('.var-number').forEach((el, idx) => {
            el.textContent = idx + 1;
        });
    }
    
    // File upload preview
    function setupFileUpload(inputId, contentId, previewId, dropZoneId) {
        const input = document.getElementById(inputId);
        const content = document.getElementById(contentId);
        const preview = document.getElementById(previewId);
        const dropZone = document.getElementById(dropZoneId);
        
        if (!input) return;
        
        input.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                showFilePreview(file, content, preview);
            }
        });
        
        // Drag & drop visual feedback
        if (dropZone) {
            ['dragenter', 'dragover'].forEach(eventName => {
                dropZone.addEventListener(eventName, (e) => {
                    e.preventDefault();
                    dropZone.classList.add('border-green-500', 'bg-green-50/50', 'dark:bg-green-900/10');
                });
            });
            
            ['dragleave', 'drop'].forEach(eventName => {
                dropZone.addEventListener(eventName, (e) => {
                    e.preventDefault();
                    dropZone.classList.remove('border-green-500', 'bg-green-50/50', 'dark:bg-green-900/10');
                });
            });
        }
    }
    
    function showFilePreview(file, content, preview) {
        const size = (file.size / 1024 / 1024).toFixed(2);
        const ext = file.name.split('.').pop().toLowerCase();
        const icons = {
            'csv': 'bi-filetype-csv text-green-600',
            'txt': 'bi-filetype-txt text-gray-600',
            'arff': 'bi-file-earmark-code text-purple-600',
            'json': 'bi-filetype-json text-yellow-600',
            'zip': 'bi-file-earmark-zip text-blue-600'
        };
        const icon = icons[ext] || 'bi-file-earmark text-gray-600';
        
        content.classList.add('hidden');
        preview.classList.remove('hidden');
        preview.innerHTML = `
            <div class="inline-block text-left">
                <div class="flex items-center gap-3 p-4 rounded-xl bg-gradient-to-r from-green-50 to-emerald-50 dark:from-green-900/20 dark:to-emerald-900/20 border border-green-200 dark:border-green-800">
                    <div class="flex-shrink-0 w-12 h-12 rounded-lg bg-white dark:bg-gray-800 flex items-center justify-center shadow-sm">
                        <i class="bi ${icon} text-2xl"></i>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-bold text-gray-900 dark:text-white truncate">${file.name}</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">${size} MB • Ready to upload</p>
                    </div>
                    <div class="flex-shrink-0 w-8 h-8 rounded-full bg-green-500 text-white flex items-center justify-center">
                        <i class="bi bi-check-lg"></i>
                    </div>
                </div>
                <button type="button" onclick="removeFile('${preview.id}', '${content.id}')" class="mt-2 text-xs text-red-500 hover:text-red-700 font-semibold inline-flex items-center gap-1">
                    <i class="bi bi-x-circle"></i> Remove file
                </button>
            </div>
        `;
    }
    
    function removeFile(previewId, contentId) {
        const preview = document.getElementById(previewId);
        const content = document.getElementById(contentId);
        const input = preview.previousElementSibling || preview.parentElement.querySelector('input[type="file"]');
        
        if (input && input.type === 'file') {
            input.value = '';
        }
        preview.classList.add('hidden');
        preview.innerHTML = '';
        content.classList.remove('hidden');
    }
    
    // Setup all file uploads
    setupFileUpload('tabular_file', 'tabularContent', 'tabular-preview', 'tabularDropZone');
    setupFileUpload('other_file', 'otherContent', 'other-preview', 'otherDropZone');
    setupFileUpload('test_file', 'testContent', 'test-preview', 'testDropZone');
    setupFileUpload('dataset_file', 'datasetContent', 'dataset-preview', 'datasetDropZone');
    setupFileUpload('test_file_other', 'testOtherContent', 'testOther-preview', 'testOtherDropZone');
    
    // Form validation yang diperbaiki
    document.getElementById('filesForm').addEventListener('submit', function(e) {
        const isTabular = document.getElementById('format_tabular').checked;
        
        if (isTabular) {
            const tabularFile = document.getElementById('tabular_file');
            if (!tabularFile.files || tabularFile.files.length === 0) {
                e.preventDefault();
                alert('Please upload a tabular data file.');
                tabularFile.focus();
                return false;
            }
        } else {
            const datasetFile = document.getElementById('dataset_file');
            if (!datasetFile.files || datasetFile.files.length === 0) {
                e.preventDefault();
                alert('Please upload a dataset file.');
                datasetFile.focus();
                return false;
            }
        }
        
        // Show loading state
        const btn = document.getElementById('nextBtn');
        btn.disabled = true;
        btn.innerHTML = `
            <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            <span>Uploading...</span>
        `;
    });
    
    // Initialize - set required berdasarkan format default
    document.addEventListener('DOMContentLoaded', function() {
        toggleFormat();
        updateVarCount();
    });
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Documents\TB-PWL-DATASPHERE\resources\views/contribute/files.blade.php ENDPATH**/ ?>