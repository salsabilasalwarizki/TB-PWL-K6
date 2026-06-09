
<?php $__env->startSection('title', $dataset->display_name ?? $dataset->name); ?>
<?php $__env->startSection('meta_desc', Str::limit($dataset->abstract ?? $dataset->description, 160)); ?>

<?php $__env->startSection('content'); ?>
<div class="relative">
    
    <!-- ===== HERO SECTION ===== -->
    <section class="relative overflow-hidden bg-gradient-to-br from-brand-600 via-sphere-primary to-sphere-secondary text-white">
        <div class="absolute inset-0">
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_20%_80%,rgba(255,255,255,0.1)_0%,transparent_50%)]"></div>
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_80%_20%,rgba(255,255,255,0.08)_0%,transparent_50%)]"></div>
        </div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 lg:py-14">
            <!-- Breadcrumb -->
            <nav class="flex items-center gap-2 text-sm text-white/70 mb-4">
                <a href="<?php echo e(route('home')); ?>" class="hover:text-white transition-colors">Home</a>
                <i class="bi bi-chevron-right text-xs"></i>
                <a href="<?php echo e(route('datasets.index')); ?>" class="hover:text-white transition-colors">Datasets</a>
                <i class="bi bi-chevron-right text-xs"></i>
                <span class="text-white truncate max-w-xs"><?php echo e(Str::limit($dataset->display_name ?? $dataset->name, 40)); ?></span>
            </nav>
            
            <div class="flex flex-col md:flex-row items-start md:items-center gap-6">
                <!-- Thumbnail -->
                <div class="flex-shrink-0">
                    <div class="w-24 h-24 md:w-28 md:h-28 rounded-2xl overflow-hidden bg-white/10 backdrop-blur-md border-2 border-white/20 flex items-center justify-center shadow-2xl">
                        <?php if($dataset->thumbnail_url): ?>
                            <img src="<?php echo e($dataset->thumbnail_url); ?>" alt="<?php echo e($dataset->name); ?>" class="w-full h-full object-cover">
                        <?php elseif($dataset->large_image_url): ?>
                            <img src="<?php echo e($dataset->large_image_url); ?>" alt="<?php echo e($dataset->name); ?>" class="w-full h-full object-cover">
                        <?php else: ?>
                            <i class="bi bi-database text-5xl text-white/80"></i>
                        <?php endif; ?>
                    </div>
                </div>
                
                <!-- Info -->
                <div class="flex-1 min-w-0">
                    <div class="flex flex-wrap items-center gap-2 mb-2">
                        <?php if($dataset->data_type): ?>
                        <span class="px-2.5 py-1 rounded-full bg-white/15 backdrop-blur-sm border border-white/20 text-xs font-semibold">
                            <?php echo e($dataset->data_type); ?>

                        </span>
                        <?php endif; ?>
                        <?php if($dataset->task_type): ?>
                        <span class="px-2.5 py-1 rounded-full bg-white/15 backdrop-blur-sm border border-white/20 text-xs font-semibold">
                            <?php echo e($dataset->task_type); ?>

                        </span>
                        <?php endif; ?>
                        <?php
                            $statusColors = [
                                'pending' => 'bg-amber-500/20 border-amber-300/30 text-amber-100',
                                'approved' => 'bg-green-500/20 border-green-300/30 text-green-100',
                                'rejected' => 'bg-red-500/20 border-red-300/30 text-red-100',
                                'available' => 'bg-blue-500/20 border-blue-300/30 text-blue-100',
                                'deprecated' => 'bg-gray-500/20 border-gray-300/30 text-gray-100',
                            ][$dataset->status] ?? 'bg-gray-500/20 border-gray-300/30 text-gray-100';
                        ?>
                        <span class="px-2.5 py-1 rounded-full border text-xs font-semibold <?php echo e($statusColors); ?>">
                            <?php echo e(ucfirst($dataset->status)); ?>

                        </span>
                    </div>
                    
                    <h1 class="text-2xl md:text-3xl lg:text-4xl font-bold mb-2 leading-tight">
                        <?php echo e($dataset->display_name ?? $dataset->name); ?>

                    </h1>
                    
                    <div class="flex flex-wrap items-center gap-4 text-sm text-white/80">
                        <?php if($dataset->donated_date): ?>
                        <span class="flex items-center gap-1.5">
                            <i class="bi bi-calendar"></i>
                            Donated <?php echo e(\Carbon\Carbon::parse($dataset->donated_date)->format('M d, Y')); ?>

                        </span>
                        <?php endif; ?>
                        <?php if($dataset->subject_area): ?>
                        <span class="flex items-center gap-1.5">
                            <i class="bi bi-folder"></i>
                            <?php echo e($dataset->subject_area); ?>

                        </span>
                        <?php endif; ?>
                        <?php if($dataset->license): ?>
                        <span class="flex items-center gap-1.5">
                            <i class="bi bi-shield-check"></i>
                            <?php echo e($dataset->license->license_name); ?>

                        </span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== MAIN CONTENT ===== -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid lg:grid-cols-[1fr_320px] gap-6">
            
            <!-- ===== LEFT: MAIN CONTENT ===== -->
            <div class="space-y-6 min-w-0">
                
                <!-- Abstract -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-6">
                    <div class="flex items-center gap-2 mb-3">
                        <div class="w-8 h-8 rounded-lg bg-brand-50 dark:bg-brand-900/30 flex items-center justify-center">
                            <i class="bi bi-file-text text-brand-600 dark:text-brand-400"></i>
                        </div>
                        <h2 class="text-lg font-bold text-gray-900 dark:text-white">Abstract</h2>
                    </div>
                    <p class="text-gray-700 dark:text-gray-300 leading-relaxed">
                        <?php echo e($dataset->abstract ?? $dataset->description ?? 'No description available.'); ?>

                    </p>
                    <?php if($dataset->summary): ?>
                    <div class="mt-4 pt-4 border-t border-gray-100 dark:border-gray-700">
                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            <span class="font-semibold text-gray-900 dark:text-white">Summary:</span>
                            <?php echo e($dataset->summary); ?>

                        </p>
                    </div>
                    <?php endif; ?>
                </div>

                <!-- Characteristics Grid -->
                <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                    <?php
                        $characteristics = [
                            ['label' => 'Instances', 'value' => $dataset->num_instances, 'icon' => 'bi-table', 'color' => 'brand'],
                            ['label' => 'Features', 'value' => $dataset->num_features, 'icon' => 'bi-grid-3x3-gap', 'color' => 'green'],
                            ['label' => 'Classes', 'value' => $dataset->num_classes, 'icon' => 'bi-diagram-3', 'color' => 'purple'],
                            ['label' => 'Domain', 'value' => $dataset->domain, 'icon' => 'bi-globe', 'color' => 'cyan', 'isText' => true],
                            ['label' => 'Data Type', 'value' => $dataset->data_type, 'icon' => 'bi-layers', 'color' => 'amber', 'isText' => true],
                            ['label' => 'Missing Values', 'value' => $dataset->has_missing_values ? 'Yes' : 'No', 'icon' => 'bi-question-circle', 'color' => $dataset->has_missing_values ? 'red' : 'green', 'isText' => true],
                        ];
                    ?>
                    <?php $__currentLoopData = $characteristics; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $char): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($char['value'] !== null && $char['value'] !== ''): ?>
                        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-4 hover:shadow-md hover:-translate-y-0.5 transition-all">
                            <div class="flex items-center gap-2 mb-2">
                                <div class="w-8 h-8 rounded-lg bg-<?php echo e($char['color']); ?>-50 dark:bg-<?php echo e($char['color']); ?>-900/30 flex items-center justify-center">
                                    <i class="bi <?php echo e($char['icon']); ?> text-<?php echo e($char['color']); ?>-600 dark:text-<?php echo e($char['color']); ?>-400"></i>
                                </div>
                                <span class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider"><?php echo e($char['label']); ?></span>
                            </div>
                            <div class="text-xl font-bold text-gray-900 dark:text-white">
                                <?php if(isset($char['isText'])): ?>
                                    <?php echo e($char['value']); ?>

                                <?php else: ?>
                                    <?php echo e(number_format($char['value'])); ?>

                                <?php endif; ?>
                            </div>
                        </div>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                <!-- Collapsible: Dataset Information -->
                <?php if($dataset->descriptionDetails): ?>
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
                    <button type="button" onclick="toggleSection('datasetInfoSection')" class="w-full p-5 flex items-center justify-between hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-brand-50 dark:bg-brand-900/30 flex items-center justify-center">
                                <i class="bi bi-info-circle text-xl text-brand-600 dark:text-brand-400"></i>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white">Dataset Information</h3>
                        </div>
                        <i class="bi bi-chevron-down text-gray-400 transition-transform" id="datasetInfoSection-icon"></i>
                    </button>
                    <div id="datasetInfoSection" class="px-5 pb-5 space-y-4">
                        <?php
                            $infoFields = [
                                ['label' => 'What do the instances represent?', 'value' => $dataset->descriptionDetails->instances_represent],
                                ['label' => 'Purpose', 'value' => $dataset->descriptionDetails->purpose],
                                ['label' => 'Funding', 'value' => $dataset->descriptionDetails->funding],
                                ['label' => 'Recommended Data Splits', 'value' => $dataset->descriptionDetails->data_splits],
                                ['label' => 'Sensitive Data', 'value' => $dataset->descriptionDetails->sensitive_data],
                                ['label' => 'Additional Information', 'value' => $dataset->descriptionDetails->additional_info],
                            ];
                        ?>
                        <?php $__currentLoopData = $infoFields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($field['value']): ?>
                            <div class="p-4 rounded-xl bg-gray-50 dark:bg-gray-700/30 border border-gray-100 dark:border-gray-700">
                                <h4 class="text-sm font-semibold text-gray-900 dark:text-white mb-1"><?php echo e($field['label']); ?></h4>
                                <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed"><?php echo e($field['value']); ?></p>
                            </div>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
                <?php endif; ?>

                <!-- Collapsible: Variables Table -->
                <?php if($dataset->variables->isNotEmpty()): ?>
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
                    <button type="button" onclick="toggleSection('variablesSection')" class="w-full p-5 flex items-center justify-between hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-purple-50 dark:bg-purple-900/30 flex items-center justify-center">
                                <i class="bi bi-list-columns text-xl text-purple-600 dark:text-purple-400"></i>
                            </div>
                            <div class="text-left">
                                <h3 class="text-lg font-bold text-gray-900 dark:text-white">Variables</h3>
                                <p class="text-xs text-gray-500 dark:text-gray-400"><?php echo e($dataset->variables->count()); ?> variables total</p>
                            </div>
                        </div>
                        <i class="bi bi-chevron-down text-gray-400 transition-transform" id="variablesSection-icon"></i>
                    </button>
                    <div id="variablesSection" class="px-5 pb-5">
                        <div class="overflow-x-auto rounded-xl border border-gray-100 dark:border-gray-700">
                            <table class="w-full text-sm">
                                <thead class="bg-gray-50 dark:bg-gray-700/50">
                                    <tr>
                                        <th class="px-4 py-3 text-left text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Name</th>
                                        <th class="px-4 py-3 text-left text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Role</th>
                                        <th class="px-4 py-3 text-left text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Type</th>
                                        <th class="px-4 py-3 text-left text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Description</th>
                                        <th class="px-4 py-3 text-left text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Missing</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                                    <?php $__currentLoopData = $dataset->variables; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $var): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors">
                                        <td class="px-4 py-3 font-semibold text-gray-900 dark:text-white"><?php echo e($var->display_name ?? $var->variable_name); ?></td>
                                        <td class="px-4 py-3">
                                            <?php
                                                $roleColors = [
                                                    'feature' => 'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400',
                                                    'target' => 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400',
                                                    'id' => 'bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-300',
                                                ][$var->role] ?? 'bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-300';
                                            ?>
                                            <span class="px-2 py-0.5 rounded-full text-xs font-semibold <?php echo e($roleColors); ?>"><?php echo e(ucfirst($var->role)); ?></span>
                                        </td>
                                        <td class="px-4 py-3 text-gray-600 dark:text-gray-400"><?php echo e($var->variable_type); ?></td>
                                        <td class="px-4 py-3 text-gray-600 dark:text-gray-400 max-w-xs truncate"><?php echo e($var->description ?? '-'); ?></td>
                                        <td class="px-4 py-3">
                                            <?php if($var->missing_count > 0): ?>
                                                <span class="text-red-600 dark:text-red-400 font-semibold"><?php echo e($var->missing_count); ?></span>
                                            <?php else: ?>
                                                <span class="text-green-600 dark:text-green-400">No</span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <?php if($var->variable_type === 'Categorical' && $var->categories->isNotEmpty()): ?>
                                    <tr class="bg-gray-50 dark:bg-gray-700/20">
                                        <td colspan="5" class="px-4 py-2">
                                            <div class="flex flex-wrap gap-1">
                                                <span class="text-xs text-gray-500 dark:text-gray-400 mr-2">Categories:</span>
                                                <?php $__currentLoopData = $var->categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <span class="px-2 py-0.5 rounded bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 text-xs text-gray-700 dark:text-gray-300">
                                                    <?php echo e($cat->category_label ?? $cat->category_value); ?>

                                                </span>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

                <!-- Collapsible: Introductory Paper -->
                <?php
                    $introductoryPapers = $dataset->papers->where('pivot.citation_type', 'introductory')->take(1);
                ?>
                <?php if($introductoryPapers->isNotEmpty()): ?>
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
                    <button type="button" onclick="toggleSection('paperSection')" class="w-full p-5 flex items-center justify-between hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-amber-50 dark:bg-amber-900/30 flex items-center justify-center">
                                <i class="bi bi-journal-text text-xl text-amber-600 dark:text-amber-400"></i>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white">Introductory Paper</h3>
                        </div>
                        <i class="bi bi-chevron-down text-gray-400 transition-transform" id="paperSection-icon"></i>
                    </button>
                    <div id="paperSection" class="px-5 pb-5">
                        <?php $__currentLoopData = $introductoryPapers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $paper): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="p-4 rounded-xl bg-gray-50 dark:bg-gray-700/30 border border-gray-100 dark:border-gray-700">
                            <?php if($paper->url): ?>
                            <a href="<?php echo e($paper->url); ?>" target="_blank" class="font-semibold text-gray-900 dark:text-white hover:text-brand-600 dark:hover:text-brand-400 transition-colors">
                                <?php echo e($paper->title); ?>

                            </a>
                            <?php else: ?>
                            <h4 class="font-semibold text-gray-900 dark:text-white"><?php echo e($paper->title); ?></h4>
                            <?php endif; ?>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">By <?php echo e($paper->authors); ?></p>
                            <p class="text-xs text-gray-500 dark:text-gray-500 mt-1">
                                Published in <?php echo e($paper->venue ?? 'N/A'); ?>, <?php echo e($paper->publication_year); ?>

                            </p>
                            <?php if($paper->abstract): ?>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mt-3 leading-relaxed"><?php echo e(Str::limit($paper->abstract, 300)); ?></p>
                            <?php endif; ?>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
                <?php endif; ?>

                <!-- Collapsible: Dataset Files -->
                <?php if($dataset->files->isNotEmpty()): ?>
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
                    <button type="button" onclick="toggleSection('filesSection')" class="w-full p-5 flex items-center justify-between hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-green-50 dark:bg-green-900/30 flex items-center justify-center">
                                <i class="bi bi-files text-xl text-green-600 dark:text-green-400"></i>
                            </div>
                            <div class="text-left">
                                <h3 class="text-lg font-bold text-gray-900 dark:text-white">Dataset Files</h3>
                                <p class="text-xs text-gray-500 dark:text-gray-400"><?php echo e($dataset->files->count()); ?> files available</p>
                            </div>
                        </div>
                        <i class="bi bi-chevron-down text-gray-400 transition-transform" id="filesSection-icon"></i>
                    </button>
                    <div id="filesSection" class="px-5 pb-5">
                        <div class="space-y-2">
                            <?php $__currentLoopData = $dataset->files; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="flex items-center justify-between p-3 rounded-xl bg-gray-50 dark:bg-gray-700/30 border border-gray-100 dark:border-gray-700 hover:border-brand-300 dark:hover:border-brand-700 transition-colors">
                                <div class="flex items-center gap-3 min-w-0">
                                    <div class="w-10 h-10 rounded-lg bg-brand-50 dark:bg-brand-900/30 flex items-center justify-center flex-shrink-0">
                                        <i class="bi bi-file-earmark-text text-brand-600 dark:text-brand-400"></i>
                                    </div>
                                    <div class="min-w-0">
                                        <p class="font-semibold text-sm text-gray-900 dark:text-white truncate"><?php echo e($file->original_filename ?? $file->filename); ?></p>
                                        <div class="flex items-center gap-2 mt-0.5">
                                            <span class="px-1.5 py-0.5 rounded bg-gray-200 dark:bg-gray-600 text-xs font-semibold text-gray-700 dark:text-gray-300"><?php echo e(strtoupper($file->file_format)); ?></span>
                                            <span class="text-xs text-gray-500 dark:text-gray-400">
                                                <?php echo e($file->file_size_bytes ? number_format($file->file_size_bytes / 1024, 2) . ' KB' : 'N/A'); ?>

                                            </span>
                                            <span class="text-xs text-gray-500 dark:text-gray-400">• <?php echo e(ucfirst($file->pivot->file_role ?? 'data')); ?></span>
                                        </div>
                                    </div>
                                </div>
                                <a href="<?php echo e(asset('storage/' . $file->file_path)); ?>" 
                                   class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg bg-brand-50 dark:bg-brand-900/30 text-brand-600 dark:text-brand-400 text-xs font-semibold hover:bg-brand-100 dark:hover:bg-brand-900/50 transition-colors flex-shrink-0 ml-2"
                                   download>
                                    <i class="bi bi-download"></i>
                                    <span class="hidden sm:inline">Download</span>
                                </a>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

                <!-- Papers Citing this Dataset -->
                <?php
                    $citingPapers = $dataset->papers->where(function($paper) {
                        return $paper->pivot->citation_type === 'citing' || $paper->pivot->citation_type === null;
                    })->sortByDesc('publication_year');
                    $papersPerPage = request('per_page', 5);
                    $currentPage = request('page', 1);
                    $totalPapers = $citingPapers->count();
                    $startIndex = ($currentPage - 1) * $papersPerPage;
                    $endIndex = min($startIndex + $papersPerPage, $totalPapers);
                    $paginatedPapers = $citingPapers->slice($startIndex, $papersPerPage);
                    $totalPages = ceil($totalPapers / $papersPerPage);
                ?>
                
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
                    <div class="p-5 border-b border-gray-100 dark:border-gray-700 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-cyan-50 dark:bg-cyan-900/30 flex items-center justify-center">
                                <i class="bi bi-journal-arrow-up text-xl text-cyan-600 dark:text-cyan-400"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-gray-900 dark:text-white">Papers Citing this Dataset</h3>
                                <p class="text-xs text-gray-500 dark:text-gray-400"><?php echo e($totalPapers); ?> papers found</p>
                            </div>
                        </div>
                        <select id="sortByYear" onchange="sortPapers()" class="px-3 py-1.5 rounded-lg bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 text-sm text-gray-700 dark:text-gray-200 focus:outline-none focus:border-brand-500">
                            <option value="year_desc" <?php echo e(request('sort') === 'year_desc' || !request('sort') ? 'selected' : ''); ?>>Year (Newest)</option>
                            <option value="year_asc" <?php echo e(request('sort') === 'year_asc' ? 'selected' : ''); ?>>Year (Oldest)</option>
                            <option value="title_asc" <?php echo e(request('sort') === 'title_asc' ? 'selected' : ''); ?>>Title (A-Z)</option>
                            <option value="title_desc" <?php echo e(request('sort') === 'title_desc' ? 'selected' : ''); ?>>Title (Z-A)</option>
                        </select>
                    </div>
                    
                    <div class="p-5">
                        <?php if($paginatedPapers->isNotEmpty()): ?>
                        <div class="space-y-3">
                            <?php $__currentLoopData = $paginatedPapers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $paper): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="p-4 rounded-xl bg-gray-50 dark:bg-gray-700/30 border border-gray-100 dark:border-gray-700 hover:border-brand-300 dark:hover:border-brand-700 transition-colors">
                                <?php if($paper->url): ?>
                                <a href="<?php echo e($paper->url); ?>" target="_blank" class="font-semibold text-gray-900 dark:text-white hover:text-brand-600 dark:hover:text-brand-400 transition-colors">
                                    <?php echo e($paper->title); ?>

                                </a>
                                <?php else: ?>
                                <h4 class="font-semibold text-gray-900 dark:text-white"><?php echo e($paper->title); ?></h4>
                                <?php endif; ?>
                                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">By <?php echo e($paper->authors); ?></p>
                                <div class="flex flex-wrap items-center gap-3 mt-2 text-xs text-gray-500 dark:text-gray-400">
                                    <span><i class="bi bi-journal me-1"></i><?php echo e($paper->venue ?? 'ArXiv'); ?></span>
                                    <span><i class="bi bi-calendar me-1"></i><?php echo e($paper->publication_year); ?></span>
                                    <?php if($paper->doi): ?>
                                    <span class="text-brand-600 dark:text-brand-400"><i class="bi bi-upc-scan me-1"></i><?php echo e($paper->doi); ?></span>
                                    <?php endif; ?>
                                </div>
                                <?php if($paper->abstract): ?>
                                <p class="text-sm text-gray-600 dark:text-gray-400 mt-2 leading-relaxed"><?php echo e(Str::limit($paper->abstract, 200)); ?></p>
                                <?php endif; ?>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        
                        <!-- Pagination -->
                        <?php if($totalPages > 1 || $totalPapers > 5): ?>
                        <div class="mt-5 pt-5 border-t border-gray-100 dark:border-gray-700 flex flex-col sm:flex-row items-center justify-between gap-3">
                            <div class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-400">
                                <span>Rows per page:</span>
                                <select onchange="changePageSize(this.value)" class="px-2 py-1 rounded-lg bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 text-sm text-gray-700 dark:text-gray-200 focus:outline-none focus:border-brand-500">
                                    <option value="5" <?php echo e($papersPerPage == 5 ? 'selected' : ''); ?>>5</option>
                                    <option value="10" <?php echo e($papersPerPage == 10 ? 'selected' : ''); ?>>10</option>
                                    <option value="20" <?php echo e($papersPerPage == 20 ? 'selected' : ''); ?>>20</option>
                                    <option value="50" <?php echo e($papersPerPage == 50 ? 'selected' : ''); ?>>50</option>
                                </select>
                                <span class="ml-2"><?php echo e($totalPapers > 0 ? $startIndex + 1 : 0); ?>-<?php echo e($endIndex); ?> of <?php echo e($totalPapers); ?></span>
                            </div>
                            
                            <?php if($totalPages > 1): ?>
                            <nav class="flex items-center gap-1">
                                <?php if($currentPage > 1): ?>
                                <a href="?page=<?php echo e($currentPage - 1); ?>&per_page=<?php echo e($papersPerPage); ?>&sort=<?php echo e(request('sort', 'year_desc')); ?>" 
                                   class="w-8 h-8 rounded-lg flex items-center justify-center text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                                    <i class="bi bi-chevron-left"></i>
                                </a>
                                <?php endif; ?>
                                
                                <?php for($i = 1; $i <= $totalPages; $i++): ?>
                                    <?php if($i == 1 || $i == $totalPages || ($i >= $currentPage - 1 && $i <= $currentPage + 1)): ?>
                                        <a href="?page=<?php echo e($i); ?>&per_page=<?php echo e($papersPerPage); ?>&sort=<?php echo e(request('sort', 'year_desc')); ?>" 
                                           class="w-8 h-8 rounded-lg flex items-center justify-center text-sm font-semibold transition-colors <?php echo e($i == $currentPage ? 'bg-brand-600 text-white' : 'text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700'); ?>">
                                            <?php echo e($i); ?>

                                        </a>
                                    <?php elseif($i == $currentPage - 2 || $i == $currentPage + 2): ?>
                                        <span class="w-8 h-8 flex items-center justify-center text-gray-400">…</span>
                                    <?php endif; ?>
                                <?php endfor; ?>
                                
                                <?php if($currentPage < $totalPages): ?>
                                <a href="?page=<?php echo e($currentPage + 1); ?>&per_page=<?php echo e($papersPerPage); ?>&sort=<?php echo e(request('sort', 'year_desc')); ?>" 
                                   class="w-8 h-8 rounded-lg flex items-center justify-center text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                                    <i class="bi bi-chevron-right"></i>
                                </a>
                                <?php endif; ?>
                            </nav>
                            <?php endif; ?>
                        </div>
                        <?php endif; ?>
                        <?php else: ?>
                        <div class="text-center py-8">
                            <div class="w-16 h-16 mx-auto mb-3 rounded-full bg-gray-100 dark:bg-gray-700 flex items-center justify-center">
                                <i class="bi bi-journal-x text-3xl text-gray-400"></i>
                            </div>
                            <p class="text-gray-500 dark:text-gray-400">No papers citing this dataset yet.</p>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Related Papers -->
                <?php
                    $relatedPapers = $dataset->papers->where('pivot.citation_type', 'related');
                ?>
                <?php if($relatedPapers->isNotEmpty()): ?>
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
                    <div class="p-5 border-b border-gray-100 dark:border-gray-700 flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-indigo-50 dark:bg-indigo-900/30 flex items-center justify-center">
                            <i class="bi bi-link-45deg text-xl text-indigo-600 dark:text-indigo-400"></i>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white">Related Papers</h3>
                    </div>
                    <div class="p-5 space-y-2">
                        <?php $__currentLoopData = $relatedPapers->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $paper): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="p-3 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors">
                            <h4 class="font-semibold text-gray-900 dark:text-white text-sm"><?php echo e($paper->title); ?></h4>
                            <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">By <?php echo e($paper->authors); ?></p>
                            <p class="text-xs text-gray-500 dark:text-gray-500 mt-0.5"><?php echo e($paper->venue ?? 'N/A'); ?>, <?php echo e($paper->publication_year); ?></p>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
                <?php endif; ?>

                <!-- Reviews -->
                <?php if($dataset->reviews->isNotEmpty()): ?>
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
                    <div class="p-5 border-b border-gray-100 dark:border-gray-700 flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-yellow-50 dark:bg-yellow-900/30 flex items-center justify-center">
                            <i class="bi bi-chat-quote text-xl text-yellow-600 dark:text-yellow-400"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white">User Reviews</h3>
                            <p class="text-xs text-gray-500 dark:text-gray-400"><?php echo e($dataset->reviews->count()); ?> reviews</p>
                        </div>
                    </div>
                    <div class="p-5 space-y-4">
                        <?php $__currentLoopData = $dataset->reviews->take(5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="pb-4 border-b border-gray-100 dark:border-gray-700 last:border-0 last:pb-0">
                            <div class="flex items-start justify-between gap-3 mb-2">
                                <h4 class="font-semibold text-gray-900 dark:text-white"><?php echo e($review->title ?? 'Untitled Review'); ?></h4>
                                <div class="flex items-center gap-1 text-yellow-500 flex-shrink-0">
                                    <?php for($i = 1; $i <= 5; $i++): ?>
                                        <i class="bi bi-star<?php echo e($i <= $review->rating ? '-fill' : ''); ?>"></i>
                                    <?php endfor; ?>
                                    <span class="text-xs text-gray-500 dark:text-gray-400 ml-1">(<?php echo e(number_format($review->rating, 1)); ?>)</span>
                                </div>
                            </div>
                            <p class="text-sm text-gray-700 dark:text-gray-300 mb-2"><?php echo e($review->content); ?></p>
                            <?php if($review->pros): ?>
                            <p class="text-xs text-green-600 dark:text-green-400 mb-1"><i class="bi bi-plus-circle me-1"></i><strong>Pros:</strong> <?php echo e($review->pros); ?></p>
                            <?php endif; ?>
                            <?php if($review->cons): ?>
                            <p class="text-xs text-red-600 dark:text-red-400 mb-2"><i class="bi bi-dash-circle me-1"></i><strong>Cons:</strong> <?php echo e($review->cons); ?></p>
                            <?php endif; ?>
                            <div class="flex items-center gap-2 text-xs text-gray-500 dark:text-gray-400">
                                <i class="bi bi-person-circle"></i>
                                <span><?php echo e($review->user->name ?? 'Anonymous'); ?></span>
                                <span>•</span>
                                <span><?php echo e($review->created_at->format('M d, Y')); ?></span>
                                <?php if($review->is_verified): ?>
                                <span class="px-2 py-0.5 rounded-full bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400 text-xs font-semibold">Verified</span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
                <?php endif; ?>

            </div>

            <!-- ===== RIGHT: SIDEBAR ===== -->
            <aside class="space-y-4 lg:sticky lg:top-24 lg:self-start">
                
                <!-- Action Buttons -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-5">
                    <?php
                        $defaultFile = $dataset->files->where('pivot.is_default', 1)->first() ?? $dataset->files->first();
                    ?>
                    <?php if($defaultFile): ?>
                    <a href="<?php echo e(asset('storage/' . $defaultFile->file_path)); ?>" 
                       class="w-full inline-flex items-center justify-center gap-2 px-4 py-3 rounded-xl bg-gradient-to-r from-brand-600 to-sphere-secondary text-white font-semibold shadow-md hover:shadow-lg hover:-translate-y-0.5 transition-all mb-3"
                       download>
                        <i class="bi bi-download"></i>
                        <span>Download Dataset</span>
                    </a>
                    <?php endif; ?>
                    
                    <div class="grid grid-cols-2 gap-2 mb-4">
                        <button onclick="importInPython()" class="inline-flex items-center justify-center gap-1 px-3 py-2 rounded-xl bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200 text-sm font-semibold hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors">
                            <i class="bi bi-code-slash"></i>
                            <span>Python</span>
                        </button>
                        <button onclick="showCitation()" class="inline-flex items-center justify-center gap-1 px-3 py-2 rounded-xl bg-amber-50 dark:bg-amber-900/30 text-amber-600 dark:text-amber-400 text-sm font-semibold hover:bg-amber-100 dark:hover:bg-amber-900/50 transition-colors">
                            <i class="bi bi-quote"></i>
                            <span>Cite</span>
                        </button>
                    </div>
                    
                    <div class="pt-4 border-t border-gray-100 dark:border-gray-700 space-y-2">
                        <div class="flex items-center justify-between text-sm">
                            <span class="flex items-center gap-2 text-gray-600 dark:text-gray-400"><i class="bi bi-chat-quote"></i>Citations</span>
                            <span class="font-bold text-gray-900 dark:text-white"><?php echo e(number_format($dataset->citation_count ?? 0)); ?></span>
                        </div>
                        <div class="flex items-center justify-between text-sm" data-view-count>
                            <span class="flex items-center gap-2 text-gray-600 dark:text-gray-400"><i class="bi bi-eye"></i>Views</span>
                            <span class="font-bold text-gray-900 dark:text-white"><?php echo e(number_format($dataset->view_count ?? 0)); ?></span>
                        </div>
                        <div class="flex items-center justify-between text-sm">
                            <span class="flex items-center gap-2 text-gray-600 dark:text-gray-400"><i class="bi bi-cloud-download"></i>Downloads</span>
                            <span class="font-bold text-gray-900 dark:text-white"><?php echo e(number_format($dataset->download_count ?? 0)); ?></span>
                        </div>
                    </div>
                </div>

                <!-- Keywords -->
                <?php if($dataset->keywords->isNotEmpty()): ?>
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-5">
                    <h3 class="text-sm font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-3 flex items-center gap-2">
                        <i class="bi bi-tags"></i>Keywords
                    </h3>
                    <div class="flex flex-wrap gap-1.5">
                        <?php $__currentLoopData = $dataset->keywords; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $keyword): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e(route('datasets.index', ['keyword' => $keyword->slug])); ?>" 
                           class="px-2.5 py-1 rounded-lg bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 text-xs font-medium hover:bg-brand-100 dark:hover:bg-brand-900/30 hover:text-brand-600 dark:hover:text-brand-400 transition-colors">
                            <?php echo e($keyword->keyword_name); ?>

                        </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
                <?php endif; ?>

                <!-- Creators -->
                <?php
                    $creators = $dataset->contributors->where('pivot.contribution_role', 'creator');
                    $otherContributors = $dataset->contributors->whereNotIn('pivot.contribution_role', ['creator']);
                ?>
                <?php if($creators->isNotEmpty()): ?>
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-5">
                    <h3 class="text-sm font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-3 flex items-center gap-2">
                        <i class="bi bi-person-badge"></i>Creators
                    </h3>
                    <div class="space-y-3">
                        <?php $__currentLoopData = $creators; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $creator): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="flex items-start gap-2">
                            <div class="w-8 h-8 rounded-full bg-gradient-to-br from-brand-500 to-sphere-secondary flex items-center justify-center text-white text-xs font-bold flex-shrink-0">
                                <?php echo e(strtoupper(substr($creator->name, 0, 1))); ?>

                            </div>
                            <div class="min-w-0 flex-1">
                                <p class="font-semibold text-sm text-gray-900 dark:text-white truncate"><?php echo e($creator->name); ?></p>
                                <?php if($creator->affiliation): ?>
                                <p class="text-xs text-gray-500 dark:text-gray-400 truncate"><?php echo e($creator->affiliation); ?></p>
                                <?php endif; ?>
                                <?php if($creator->orcid): ?>
                                <a href="https://orcid.org/<?php echo e($creator->orcid); ?>" target="_blank" class="text-xs text-brand-600 dark:text-brand-400 hover:underline">
                                    <i class="bi bi-orcid"></i> ORCID
                                </a>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
                <?php endif; ?>

                <?php if($otherContributors->isNotEmpty()): ?>
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-5">
                    <h3 class="text-sm font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-3 flex items-center gap-2">
                        <i class="bi bi-people"></i>Contributors
                    </h3>
                    <div class="space-y-2">
                        <?php $__currentLoopData = $otherContributors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contributor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="flex items-center gap-2">
                            <div class="w-7 h-7 rounded-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center text-gray-600 dark:text-gray-300 text-xs font-bold flex-shrink-0">
                                <?php echo e(strtoupper(substr($contributor->name, 0, 1))); ?>

                            </div>
                            <div class="min-w-0 flex-1">
                                <p class="font-medium text-sm text-gray-900 dark:text-white truncate"><?php echo e($contributor->name); ?></p>
                                <p class="text-xs text-gray-500 dark:text-gray-400"><?php echo e(ucfirst($contributor->pivot->contribution_role)); ?></p>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
                <?php endif; ?>

                <!-- DOI -->
                <?php if($dataset->doi): ?>
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-5">
                    <h3 class="text-sm font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-3 flex items-center gap-2">
                        <i class="bi bi-upc-scan"></i>DOI
                    </h3>
                    <a href="<?php echo e($dataset->doi->resolution_url ?? 'https://doi.org/' . $dataset->doi->doi_string); ?>" 
                       target="_blank" 
                       class="text-sm text-brand-600 dark:text-brand-400 hover:underline break-all">
                        <?php echo e($dataset->doi->doi_string); ?>

                    </a>
                </div>
                <?php endif; ?>

                <!-- Dataset Details -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-5">
                    <h3 class="text-sm font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-3 flex items-center gap-2">
                        <i class="bi bi-info-circle"></i>Details
                    </h3>
                    <div class="space-y-2.5 text-sm">
                        <?php if($dataset->uci_id): ?>
                        <div class="flex justify-between gap-2">
                            <span class="text-gray-500 dark:text-gray-400 flex-shrink-0">UCI ID</span>
                            <span class="font-semibold text-gray-900 dark:text-white text-right truncate"><?php echo e($dataset->uci_id); ?></span>
                        </div>
                        <?php endif; ?>
                        <div class="flex justify-between gap-2">
                            <span class="text-gray-500 dark:text-gray-400 flex-shrink-0">Added</span>
                            <span class="font-semibold text-gray-900 dark:text-white text-right"><?php echo e($dataset->created_at->format('M d, Y')); ?></span>
                        </div>
                        <div class="flex justify-between gap-2">
                            <span class="text-gray-500 dark:text-gray-400 flex-shrink-0">Updated</span>
                            <span class="font-semibold text-gray-900 dark:text-white text-right"><?php echo e($dataset->updated_at->format('M d, Y')); ?></span>
                        </div>
                        <?php if($dataset->approved_at): ?>
                        <div class="flex justify-between gap-2">
                            <span class="text-gray-500 dark:text-gray-400 flex-shrink-0">Approved</span>
                            <span class="font-semibold text-gray-900 dark:text-white text-right"><?php echo e($dataset->approved_at->format('M d, Y')); ?></span>
                        </div>
                        <?php endif; ?>
                        <?php if($dataset->dataset_url): ?>
                        <div class="pt-2 border-t border-gray-100 dark:border-gray-700">
                            <a href="<?php echo e($dataset->dataset_url); ?>" target="_blank" class="inline-flex items-center gap-1 text-xs text-brand-600 dark:text-brand-400 hover:underline">
                                <i class="bi bi-box-arrow-up-right"></i>View Original Source
                            </a>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>

            </aside>
        </div>
    </div>
</div>

<!-- Citation Modal -->
<div id="citationModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:p-0">
        <div class="fixed inset-0 bg-gray-900 bg-opacity-60 transition-opacity" onclick="closeCitationModal()"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
        <div class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full">
            <div class="px-6 pt-6 pb-4">
                <div class="flex items-start justify-between mb-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-amber-50 dark:bg-amber-900/30 flex items-center justify-center">
                            <i class="bi bi-quote text-xl text-amber-600 dark:text-amber-400"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white">Cite this Dataset</h3>
                    </div>
                    <button onclick="closeCitationModal()" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 transition-colors">
                        <i class="bi bi-x-lg text-xl"></i>
                    </button>
                </div>
                
                <div class="space-y-4">
                    <div>
                        <h6 class="text-sm font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-2">BibTeX</h6>
                        <pre class="bg-gray-50 dark:bg-gray-700/50 p-4 rounded-xl text-xs text-gray-900 dark:text-gray-100 overflow-auto max-h-48" id="bibtexCode"><code>@dataset<?php echo e($dataset->dataset_id); ?>,
  title = { <?php echo e($dataset->name); ?> },
<?php if($dataset->user): ?>  author = { <?php echo e($dataset->user->name); ?> },
<?php endif; ?>  year = { <?php echo e($dataset->created_at->year); ?> },
<?php if($dataset->doi): ?>  doi = { <?php echo e($dataset->doi->doi_string); ?> },
<?php endif; ?>  url = { <?php echo e(route('datasets.show', $dataset)); ?> }
}</code></pre>
                        <button id="copyBtn" class="mt-3 inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200 text-sm font-semibold hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors" 
                                onclick="copyCitation()">
                            <i class="bi bi-clipboard"></i><span>Copy BibTeX</span>
                        </button>
                    </div>
                    
                    <div>
                        <h6 class="text-sm font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-2">APA Style</h6>
                        <p class="bg-gray-50 dark:bg-gray-700/50 p-4 rounded-xl text-sm text-gray-900 dark:text-gray-100" id="apaCitation">
                            <?php if($dataset->user): ?><?php echo e($dataset->user->name); ?><?php else: ?><?php echo e($dataset->name); ?><?php endif; ?>. 
                            (<?php echo e($dataset->created_at->year); ?>). 
                            <em><?php echo e($dataset->name); ?></em>. 
                            <?php if($dataset->doi): ?>https://doi.org/<?php echo e($dataset->doi->doi_string); ?><?php endif; ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 dark:bg-gray-700/50 px-6 py-4 flex justify-end">
                <button type="button" class="px-6 py-2.5 rounded-xl bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-200 font-semibold hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors" onclick="closeCitationModal()">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<style>
    pre code {
        white-space: pre-wrap;
        word-break: break-word;
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
// ===== Toggle Collapsible Sections =====
function toggleSection(id) {
    const section = document.getElementById(id);
    const icon = document.getElementById(id + '-icon');
    if (!section) return;
    
    section.classList.toggle('hidden');
    if (icon) icon.style.transform = section.classList.contains('hidden') ? 'rotate(0deg)' : 'rotate(180deg)';
}

// ===== Citation Modal =====
function showCitation() {
    document.getElementById('citationModal').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeCitationModal() {
    document.getElementById('citationModal').classList.add('hidden');
    document.body.style.overflow = '';
}

function copyCitation() {
    const text = document.getElementById('bibtexCode').textContent;
    const btn = document.getElementById('copyBtn');
    
    navigator.clipboard.writeText(text).then(() => {
        const original = btn.innerHTML;
        btn.innerHTML = '<i class="bi bi-check-circle"></i><span>Copied!</span>';
        btn.classList.remove('bg-gray-100', 'dark:bg-gray-700');
        btn.classList.add('bg-green-500', 'text-white');
        setTimeout(() => {
            btn.innerHTML = original;
            btn.classList.remove('bg-green-500', 'text-white');
            btn.classList.add('bg-gray-100', 'dark:bg-gray-700');
        }, 2000);
    });
}

// ===== Python Import =====
function importInPython() {
    <?php $defaultFile = $dataset->files->where('pivot.is_default', 1)->first() ?? $dataset->files->first(); ?>
    const code = `# Import the dataset
import pandas as pd

# Load the dataset
df = pd.read_csv('<?php echo e(asset('storage/' . ($defaultFile->file_path ?? ''))); ?>')

# Display basic information
print(df.info())
print(df.describe())`;
    
    navigator.clipboard.writeText(code).then(() => {
        const notif = document.createElement('div');
        notif.className = 'fixed top-20 right-4 z-50 bg-green-500 text-white px-4 py-3 rounded-xl shadow-lg flex items-center gap-2';
        notif.innerHTML = '<i class="bi bi-check-circle"></i><span>Python code copied!</span>';
        document.body.appendChild(notif);
        setTimeout(() => notif.remove(), 2000);
    });
}

// ===== Sort Papers =====
function sortPapers() {
    const sortBy = document.getElementById('sortByYear').value;
    const urlParams = new URLSearchParams(window.location.search);
    urlParams.set('sort', sortBy);
    urlParams.set('page', '1');
    window.location.search = urlParams.toString();
}

// ===== Change Page Size =====
function changePageSize(size) {
    const urlParams = new URLSearchParams(window.location.search);
    urlParams.set('per_page', size);
    urlParams.set('page', '1');
    window.location.search = urlParams.toString();
}

// ===== Track View =====
document.addEventListener('DOMContentLoaded', function() {
    const datasetId = <?php echo e($dataset->dataset_id); ?>;
    const trackUrl = "<?php echo e(route('datasets.track-view', $dataset)); ?>";
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content 
        || document.querySelector('[name="_token"]')?.value;
    
    if (trackUrl && csrfToken) {
        fetch(trackUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            },
            body: JSON.stringify({})
        })
        .then(response => response.json())
        .then(data => {
            const viewCountEl = document.querySelector('[data-view-count] span:last-child');
            if (viewCountEl && data.views) {
                viewCountEl.textContent = new Intl.NumberFormat().format(data.views);
            }
        })
        .catch(err => console.warn('Tracking error:', err));
    }
});

// ===== Close modal on Escape =====
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeCitationModal();
    }
});
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Documents\TB-PWL-DATASPHERE\resources\views/datasets/show.blade.php ENDPATH**/ ?>