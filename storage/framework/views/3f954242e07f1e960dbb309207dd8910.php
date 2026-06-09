
<?php $__env->startSection('title', 'Edit Dataset Metadata - DataSphere ML Repository'); ?>
<?php $__env->startSection('meta_desc', 'Edit metadata for your approved dataset'); ?>

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
            <a href="<?php echo e(route('profile')); ?>" class="hover:text-brand-600 dark:hover:text-brand-400 transition-colors">Profile</a>
            <i class="bi bi-chevron-right text-xs"></i>
            <a href="<?php echo e(route('profile.edits')); ?>" class="hover:text-brand-600 dark:hover:text-brand-400 transition-colors">Edits</a>
            <i class="bi bi-chevron-right text-xs"></i>
            <span class="text-brand-600 dark:text-brand-400 font-semibold">Edit Metadata</span>
        </nav>
        
        <!-- Header -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 overflow-hidden mb-6">
            <div class="bg-gradient-to-r from-blue-600 to-indigo-600 p-8 md:p-10">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <div class="w-14 h-14 rounded-xl bg-white/20 backdrop-blur-sm flex items-center justify-center">
                            <i class="bi bi-pencil-square text-3xl text-white"></i>
                        </div>
                        <div>
                            <h1 class="text-3xl md:text-4xl font-bold text-white">
                                Edit Dataset Metadata
                            </h1>
                            <p class="text-white/90 text-sm md:text-base mt-1">
                                Update information for your approved dataset
                            </p>
                        </div>
                    </div>
                    <a href="<?php echo e(route('profile.edits')); ?>" class="hidden md:inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-white/20 backdrop-blur-sm text-white font-semibold hover:bg-white/30 transition-all">
                        <i class="bi bi-arrow-left"></i>
                        <span>Back</span>
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Alert Info -->
        <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-2xl p-5 mb-6 flex items-start gap-3">
            <div class="flex-shrink-0 w-10 h-10 rounded-lg bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center">
                <i class="bi bi-info-circle-fill text-xl text-blue-600 dark:text-blue-400"></i>
            </div>
            <div class="flex-1">
                <h3 class="text-sm font-bold text-blue-900 dark:text-blue-200 mb-1">
                    Important Notice
                </h3>
                <p class="text-sm text-blue-800 dark:text-blue-200">
                    Changes to approved datasets will be reviewed by admins before going live. Your dataset status will change to "pending" after submission.
                </p>
            </div>
        </div>
        
        <!-- Edit Form -->
        <form action="<?php echo e(route('contribute.edit.metadata.update', $dataset)); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
            
            <!-- Current Status -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 overflow-hidden mb-6">
                <div class="bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-800 dark:to-gray-800 p-5 md:p-6 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg bg-gray-100 dark:bg-gray-700 flex items-center justify-center">
                            <i class="bi bi-info-circle text-xl text-gray-600 dark:text-gray-400"></i>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-gray-900 dark:text-white">Current Status</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                Last updated: <?php echo e($dataset->updated_at?->diffForHumans() ?? 'N/A'); ?>

                            </p>
                        </div>
                    </div>
                    <span class="px-4 py-2 rounded-full text-sm font-bold <?php echo e($dataset->status === 'approved' ? 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400' : 'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400'); ?>">
                        <?php echo e(ucfirst($dataset->status)); ?>

                    </span>
                </div>
            </div>
            
            <!-- Edit Form Card -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 overflow-hidden mb-6">
                <div class="bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-gray-800 dark:to-gray-800 p-5 md:p-6 border-b border-gray-200 dark:border-gray-700">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center">
                            <i class="bi bi-pencil text-xl text-blue-600 dark:text-blue-400"></i>
                        </div>
                        <div>
                            <h2 class="text-lg font-bold text-gray-900 dark:text-white">Edit Metadata</h2>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Update dataset information</p>
                        </div>
                    </div>
                </div>
                
                <div class="p-5 md:p-6 space-y-5">
                    
                    <!-- Dataset Name -->
                    <div>
                        <label for="name" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            <i class="bi bi-tag me-1 text-blue-500"></i>Dataset Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               id="name" 
                               name="name" 
                               value="<?php echo e(old('name', $dataset->name)); ?>" 
                               required
                               placeholder="Enter dataset name"
                               class="w-full px-4 py-3 rounded-xl bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition-all <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 focus:border-red-500 focus:ring-red-500/20 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                        <?php $__errorArgs = ['name'];
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
                        <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">Use a clear, descriptive name for your dataset</p>
                    </div>
                    
                    <!-- Abstract -->
                    <div>
                        <label for="abstract" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            <i class="bi bi-card-text me-1 text-blue-500"></i>Abstract <span class="text-red-500">*</span>
                        </label>
                        <textarea id="abstract" 
                                  name="abstract" 
                                  rows="5" 
                                  required
                                  maxlength="2000"
                                  oninput="updateCharCount(this, 2000)"
                                  placeholder="Provide a concise summary of the dataset"
                                  class="w-full px-4 py-3 rounded-xl bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition-all resize-none <?php $__errorArgs = ['abstract'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 focus:border-red-500 focus:ring-red-500/20 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"><?php echo e(old('abstract', $dataset->abstract)); ?></textarea>
                        <?php $__errorArgs = ['abstract'];
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
                        <div class="flex justify-between mt-2">
                            <p class="text-xs text-gray-500 dark:text-gray-400">Brief description (max 2000 characters)</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400"><span id="abstractCount"><?php echo e(strlen(old('abstract', $dataset->abstract ?? ''))); ?></span>/2000</p>
                        </div>
                    </div>
                    
                    <!-- Detailed Description -->
                    <div>
                        <label for="description" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            <i class="bi bi-file-text me-1 text-blue-500"></i>Detailed Description
                        </label>
                        <textarea id="description" 
                                  name="description" 
                                  rows="6"
                                  placeholder="Provide comprehensive details about the dataset"
                                  class="w-full px-4 py-3 rounded-xl bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition-all resize-none <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 focus:border-red-500 focus:ring-red-500/20 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"><?php echo e(old('description', $dataset->description)); ?></textarea>
                        <?php $__errorArgs = ['description'];
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
                    
                    <!-- Subject Area & Data Type -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="subject_area" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                <i class="bi bi-folder me-1 text-blue-500"></i>Subject Area
                            </label>
                            <select id="subject_area" 
                                    name="subject_area"
                                    class="w-full px-4 py-3 rounded-xl bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-white focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition-all appearance-none cursor-pointer <?php $__errorArgs = ['subject_area'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 focus:border-red-500 focus:ring-red-500/20 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                <option value="">Select subject area</option>
                                <option value="Biology" <?php echo e(old('subject_area', $dataset->subject_area) == 'Biology' ? 'selected' : ''); ?>>Biology</option>
                                <option value="Computer Science" <?php echo e(old('subject_area', $dataset->subject_area) == 'Computer Science' ? 'selected' : ''); ?>>Computer Science</option>
                                <option value="Medicine" <?php echo e(old('subject_area', $dataset->subject_area) == 'Medicine' ? 'selected' : ''); ?>>Medicine</option>
                                <option value="Engineering" <?php echo e(old('subject_area', $dataset->subject_area) == 'Engineering' ? 'selected' : ''); ?>>Engineering</option>
                                <option value="Social Sciences" <?php echo e(old('subject_area', $dataset->subject_area) == 'Social Sciences' ? 'selected' : ''); ?>>Social Sciences</option>
                                <option value="Business" <?php echo e(old('subject_area', $dataset->subject_area) == 'Business' ? 'selected' : ''); ?>>Business</option>
                                <option value="Other" <?php echo e(old('subject_area', $dataset->subject_area) == 'Other' ? 'selected' : ''); ?>>Other</option>
                            </select>
                            <?php $__errorArgs = ['subject_area'];
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
                        <div>
                            <label for="data_type" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                <i class="bi bi-diagram-3 me-1 text-blue-500"></i>Data Type
                            </label>
                            <select id="data_type" 
                                    name="data_type"
                                    class="w-full px-4 py-3 rounded-xl bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-white focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition-all appearance-none cursor-pointer <?php $__errorArgs = ['data_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 focus:border-red-500 focus:ring-red-500/20 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                <option value="">Select data type</option>
                                <option value="Multivariate" <?php echo e(old('data_type', $dataset->data_type) == 'Multivariate' ? 'selected' : ''); ?>>Multivariate</option>
                                <option value="Univariate" <?php echo e(old('data_type', $dataset->data_type) == 'Univariate' ? 'selected' : ''); ?>>Univariate</option>
                                <option value="Sequential" <?php echo e(old('data_type', $dataset->data_type) == 'Sequential' ? 'selected' : ''); ?>>Sequential</option>
                                <option value="Time-Series" <?php echo e(old('data_type', $dataset->data_type) == 'Time-Series' ? 'selected' : ''); ?>>Time-Series</option>
                                <option value="Text" <?php echo e(old('data_type', $dataset->data_type) == 'Text' ? 'selected' : ''); ?>>Text</option>
                                <option value="Image" <?php echo e(old('data_type', $dataset->data_type) == 'Image' ? 'selected' : ''); ?>>Image</option>
                                <option value="Tabular" <?php echo e(old('data_type', $dataset->data_type) == 'Tabular' ? 'selected' : ''); ?>>Tabular</option>
                            </select>
                            <?php $__errorArgs = ['data_type'];
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
                    </div>
                    
                    <!-- Task Type -->
                    <div>
                        <label for="task_type" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            <i class="bi bi-bullseye me-1 text-blue-500"></i>Associated Task
                        </label>
                        <select id="task_type" 
                                name="task_type"
                                class="w-full px-4 py-3 rounded-xl bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-white focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition-all appearance-none cursor-pointer <?php $__errorArgs = ['task_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 focus:border-red-500 focus:ring-red-500/20 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                            <option value="">Select task type</option>
                            <option value="Classification" <?php echo e(old('task_type', $dataset->task_type) == 'Classification' ? 'selected' : ''); ?>>Classification</option>
                            <option value="Regression" <?php echo e(old('task_type', $dataset->task_type) == 'Regression' ? 'selected' : ''); ?>>Regression</option>
                            <option value="Clustering" <?php echo e(old('task_type', $dataset->task_type) == 'Clustering' ? 'selected' : ''); ?>>Clustering</option>
                            <option value="Causal Discovery" <?php echo e(old('task_type', $dataset->task_type) == 'Causal Discovery' ? 'selected' : ''); ?>>Causal Discovery</option>
                            <option value="Other" <?php echo e(old('task_type', $dataset->task_type) == 'Other' ? 'selected' : ''); ?>>Other</option>
                        </select>
                        <?php $__errorArgs = ['task_type'];
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
                    
                    <!-- Number of Instances & Features -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="num_instances" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                <i class="bi bi-hash me-1 text-blue-500"></i>Number of Instances
                            </label>
                            <input type="number" 
                                   id="num_instances" 
                                   name="num_instances" 
                                   value="<?php echo e(old('num_instances', $dataset->num_instances)); ?>"
                                   min="0"
                                   placeholder="e.g., 150"
                                   class="w-full px-4 py-3 rounded-xl bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition-all <?php $__errorArgs = ['num_instances'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 focus:border-red-500 focus:ring-red-500/20 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                            <?php $__errorArgs = ['num_instances'];
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
                        <div>
                            <label for="num_features" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                <i class="bi bi-grid-3x3-gap me-1 text-blue-500"></i>Number of Features
                            </label>
                            <input type="number" 
                                   id="num_features" 
                                   name="num_features" 
                                   value="<?php echo e(old('num_features', $dataset->num_features)); ?>"
                                   min="0"
                                   placeholder="e.g., 4"
                                   class="w-full px-4 py-3 rounded-xl bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition-all <?php $__errorArgs = ['num_features'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 focus:border-red-500 focus:ring-red-500/20 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                            <?php $__errorArgs = ['num_features'];
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
                    </div>
                </div>
            </div>
            
            <!-- Submit Buttons -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 p-5 md:p-6 sticky bottom-4">
                <div class="flex flex-col sm:flex-row items-center justify-between gap-3">
                    <a href="<?php echo e(route('profile.edits')); ?>" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200 font-semibold hover:bg-gray-200 dark:hover:bg-gray-600 transition-all">
                        <i class="bi bi-x-circle"></i>
                        <span>Cancel</span>
                    </a>
                    
                    <button type="submit" 
                            id="submitBtn"
                            class="flex-1 sm:flex-none inline-flex items-center justify-center gap-2 px-8 py-3 rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-bold shadow-lg hover:shadow-xl hover:shadow-blue-500/30 hover:-translate-y-0.5 transition-all">
                        <i class="bi bi-check-circle"></i>
                        <span>Submit for Review</span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
// Character counter for abstract
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

// Initialize character counter
document.addEventListener('DOMContentLoaded', function() {
    const abstract = document.getElementById('abstract');
    if (abstract) {
        updateCharCount(abstract, 2000);
    }
});

// Form submission with loading state
document.querySelector('form').addEventListener('submit', function(e) {
    const btn = document.getElementById('submitBtn');
    btn.disabled = true;
    btn.innerHTML = `
        <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
        <span>Submitting...</span>
    `;
});
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Documents\TB-PWL-DATASPHERE\resources\views/contribute/edit/metadata.blade.php ENDPATH**/ ?>