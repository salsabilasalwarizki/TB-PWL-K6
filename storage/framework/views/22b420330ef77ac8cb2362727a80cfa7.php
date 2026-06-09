
<?php $__env->startSection('title', 'DataSphere Machine Learning Repository'); ?>
<?php $__env->startSection('meta_desc', 'A curated collection of datasets for empirical analysis of machine learning algorithms'); ?>

<?php $__env->startSection('content'); ?>
<div class="relative">
    
    <!-- ===== HERO SECTION ===== -->
    <section class="relative overflow-hidden bg-gradient-to-br from-brand-600 via-sphere-primary to-sphere-secondary text-white">
        <!-- Animated Background -->
        <div class="absolute inset-0">
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_20%_80%,rgba(255,255,255,0.1)_0%,transparent_50%)]"></div>
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_80%_20%,rgba(255,255,255,0.08)_0%,transparent_50%)]"></div>
            
            <!-- Floating Particles -->
            <div class="absolute top-[20%] left-[10%] w-2 h-2 bg-white/30 rounded-full animate-float"></div>
            <div class="absolute top-[60%] left-[80%] w-2 h-2 bg-white/30 rounded-full animate-float" style="animation-delay: 1s"></div>
            <div class="absolute top-[40%] left-[90%] w-2 h-2 bg-white/30 rounded-full animate-float" style="animation-delay: 2s"></div>
            <div class="absolute top-[80%] left-[20%] w-2 h-2 bg-white/30 rounded-full animate-float" style="animation-delay: 3s"></div>
            <div class="absolute top-[30%] left-[70%] w-2 h-2 bg-white/30 rounded-full animate-float" style="animation-delay: 4s"></div>
        </div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 lg:py-28">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                
                <!-- Left Content -->
                <div data-aos="fade-right" data-aos-duration="1000">
                    <!-- Badge -->
                    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/10 backdrop-blur-sm border border-white/20 mb-6">
                        <i class="bi bi-stars text-yellow-300"></i>
                        <span class="text-sm font-semibold">Trusted by 10M+ Researchers Worldwide</span>
                    </div>
                    
                    <!-- Title -->
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6 leading-tight">
                        <span class="block">DataSphere</span>
                        <span class="block bg-gradient-to-r from-white via-blue-100 to-cyan-200 bg-clip-text text-transparent">
                            Machine Learning Repository
                        </span>
                    </h1>
                    
                    <!-- Description -->
                    <p class="text-lg md:text-xl text-white/90 mb-8 leading-relaxed max-w-xl">
                        We maintain <strong class="text-white font-bold"><?php echo e(number_format($stats['total'] ?? 0)); ?></strong> curated datasets 
                        as a service to the machine learning community. Discover, donate, and collaborate on datasets 
                        used by millions of researchers worldwide.
                    </p>
                    
                    <!-- CTA Buttons -->
                    <div class="flex flex-wrap gap-4 mb-10">
                        <a href="<?php echo e(route('datasets.index')); ?>" 
                           class="inline-flex items-center gap-2 px-6 py-3 rounded-full bg-white text-brand-700 font-semibold shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition-all">
                            <i class="bi bi-grid-3x3-gap"></i>
                            <span>Explore Datasets</span>
                        </a>
                        <a href="<?php echo e(route('contribute.policy')); ?>" 
                           class="inline-flex items-center gap-2 px-6 py-3 rounded-full bg-white/10 backdrop-blur-sm border border-white/30 text-white font-semibold hover:bg-white/20 hover:-translate-y-0.5 transition-all">
                            <i class="bi bi-cloud-arrow-up"></i>
                            <span>Contribute</span>
                        </a>
                    </div>
                    
                    <!-- Quick Stats -->
                    <div class="flex flex-wrap gap-8">
                        <div>
                            <div class="text-3xl font-bold text-white"><?php echo e(number_format($stats['total'] ?? 0)); ?></div>
                            <div class="text-sm text-white/70 mt-1">Datasets</div>
                        </div>
                        <div>
                            <div class="text-3xl font-bold text-white"><?php echo e(number_format(($stats['by_data_type'] ?? collect())->count())); ?></div>
                            <div class="text-sm text-white/70 mt-1">Categories</div>
                        </div>
                        <div>
                            <div class="text-3xl font-bold text-white"><?php echo e(number_format(($stats['by_task_type'] ?? collect())->count())); ?></div>
                            <div class="text-sm text-white/70 mt-1">Tasks</div>
                        </div>
                    </div>
                </div>
                
                <!-- Right Visual -->
                <div class="hidden lg:block relative" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="200">
                    <div class="relative">
                        <!-- Glow Effect -->
                        <div class="absolute inset-0 bg-white/20 rounded-full blur-3xl animate-pulse-slow"></div>
                        
                        <!-- Main Icon Card -->
                        <div class="relative bg-white/10 backdrop-blur-md border border-white/20 rounded-3xl p-8 shadow-2xl">
                            <div class="text-center">
                                <i class="bi bi-database text-8xl text-white/60"></i>
                                <div class="mt-4 inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-green-500/20 border border-green-400/30">
                                    <i class="bi bi-check-circle text-green-300"></i>
                                    <span class="text-sm font-semibold text-green-100">Verified</span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Floating Card 1 -->
                        <div class="absolute -top-4 -left-8 bg-white/95 backdrop-blur-sm rounded-2xl p-3 shadow-xl animate-float">
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 rounded-full bg-brand-100 flex items-center justify-center">
                                    <i class="bi bi-graph-up-arrow text-brand-600 text-sm"></i>
                                </div>
                                <div>
                                    <div class="text-xs text-gray-500">Growth</div>
                                    <div class="text-sm font-bold text-gray-900">+<?php echo e(number_format(rand(100, 500))); ?></div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Floating Card 2 -->
                        <div class="absolute -bottom-4 -right-8 bg-white/95 backdrop-blur-sm rounded-2xl p-3 shadow-xl animate-float" style="animation-delay: 2s">
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center">
                                    <i class="bi bi-people text-green-600 text-sm"></i>
                                </div>
                                <div>
                                    <div class="text-xs text-gray-500">Users</div>
                                    <div class="text-sm font-bold text-gray-900"><?php echo e(number_format(rand(1000, 5000))); ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        
        <!-- Scroll Indicator -->
        <div class="absolute bottom-6 left-1/2 -translate-x-1/2 animate-bounce">
            <a href="#content" class="flex flex-col items-center gap-1 text-white/70 hover:text-white transition-colors">
                <span class="text-xs font-medium">Explore</span>
                <i class="bi bi-chevron-down"></i>
            </a>
        </div>
    </section>

    <!-- ===== STATS SECTION ===== -->
    <section class="py-16 bg-gray-50 dark:bg-gray-900" id="content">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Stats Cards -->
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6">
                
                <!-- Total Datasets -->
                <div class="group bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 border border-gray-100 dark:border-gray-700" data-aos="fade-up" data-aos-delay="0">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 rounded-xl bg-brand-50 dark:bg-brand-900/30 flex items-center justify-center group-hover:scale-110 transition-transform">
                            <i class="bi bi-database text-2xl text-brand-600 dark:text-brand-400"></i>
                        </div>
                        <span class="px-2 py-1 rounded-full bg-brand-50 dark:bg-brand-900/30 text-brand-600 dark:text-brand-400 text-xs font-semibold">+12%</span>
                    </div>
                    <h3 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white mb-1"><?php echo e(number_format($stats['total'] ?? 0)); ?></h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Total Datasets</p>
                    <div class="mt-4 h-1 bg-gray-100 dark:bg-gray-700 rounded-full overflow-hidden">
                        <div class="h-full w-3/4 bg-gradient-to-r from-brand-500 to-brand-600 rounded-full"></div>
                    </div>
                </div>
                
                <!-- Data Types -->
                <div class="group bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 border border-gray-100 dark:border-gray-700" data-aos="fade-up" data-aos-delay="100">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 rounded-xl bg-green-50 dark:bg-green-900/30 flex items-center justify-center group-hover:scale-110 transition-transform">
                            <i class="bi bi-diagram-3 text-2xl text-green-600 dark:text-green-400"></i>
                        </div>
                        <span class="px-2 py-1 rounded-full bg-green-50 dark:bg-green-900/30 text-green-600 dark:text-green-400 text-xs font-semibold">+5%</span>
                    </div>
                    <h3 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white mb-1"><?php echo e(number_format(($stats['by_data_type'] ?? collect())->count())); ?></h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Data Types</p>
                    <div class="mt-4 h-1 bg-gray-100 dark:bg-gray-700 rounded-full overflow-hidden">
                        <div class="h-full w-3/5 bg-gradient-to-r from-green-500 to-green-600 rounded-full"></div>
                    </div>
                </div>
                
                <!-- Task Types -->
                <div class="group bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 border border-gray-100 dark:border-gray-700" data-aos="fade-up" data-aos-delay="200">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 rounded-xl bg-cyan-50 dark:bg-cyan-900/30 flex items-center justify-center group-hover:scale-110 transition-transform">
                            <i class="bi bi-bullseye text-2xl text-cyan-600 dark:text-cyan-400"></i>
                        </div>
                        <span class="px-2 py-1 rounded-full bg-cyan-50 dark:bg-cyan-900/30 text-cyan-600 dark:text-cyan-400 text-xs font-semibold">+8%</span>
                    </div>
                    <h3 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white mb-1"><?php echo e(number_format(($stats['by_task_type'] ?? collect())->count())); ?></h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Task Types</p>
                    <div class="mt-4 h-1 bg-gray-100 dark:bg-gray-700 rounded-full overflow-hidden">
                        <div class="h-full w-2/3 bg-gradient-to-r from-cyan-500 to-cyan-600 rounded-full"></div>
                    </div>
                </div>
                
                <!-- Downloads -->
                <div class="group bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 border border-gray-100 dark:border-gray-700" data-aos="fade-up" data-aos-delay="300">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 rounded-xl bg-amber-50 dark:bg-amber-900/30 flex items-center justify-center group-hover:scale-110 transition-transform">
                            <i class="bi bi-cloud-download text-2xl text-amber-600 dark:text-amber-400"></i>
                        </div>
                        <span class="px-2 py-1 rounded-full bg-amber-50 dark:bg-amber-900/30 text-amber-600 dark:text-amber-400 text-xs font-semibold">+25%</span>
                    </div>
                    <h3 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white mb-1"><?php echo e(number_format(($stats['recent_downloads'] ?? collect())->sum('download_count') ?? 0)); ?></h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Downloads</p>
                    <div class="mt-4 h-1 bg-gray-100 dark:bg-gray-700 rounded-full overflow-hidden">
                        <div class="h-full w-4/5 bg-gradient-to-r from-amber-500 to-amber-600 rounded-full"></div>
                    </div>
                </div>
                
            </div>
            
            <!-- Chart Section -->
            <div class="mt-12 max-w-4xl mx-auto" data-aos="fade-up" data-aos-delay="400">
                <div class="bg-white dark:bg-gray-800 rounded-3xl p-6 md:p-8 shadow-sm border border-gray-100 dark:border-gray-700">
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white">Dataset Distribution</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Overview of data types and tasks</p>
                        </div>
                        <div class="hidden sm:flex items-center gap-2 px-3 py-1.5 rounded-full bg-gray-100 dark:bg-gray-700">
                            <i class="bi bi-bar-chart text-brand-600 dark:text-brand-400"></i>
                            <span class="text-xs font-semibold text-gray-700 dark:text-gray-300">Real-time</span>
                        </div>
                    </div>
                    
                    <!-- Tab Navigation -->
                    <div class="flex gap-2 mb-6 border-b border-gray-200 dark:border-gray-700">
                        <button onclick="switchChart('dataType')" id="tab-dataType" 
                                class="chart-tab px-4 py-2 text-sm font-semibold border-b-2 border-brand-600 text-brand-600 dark:text-brand-400 transition-all">
                            <i class="bi bi-diagram-3 me-1"></i>Data Types
                        </button>
                        <button onclick="switchChart('taskType')" id="tab-taskType"
                                class="chart-tab px-4 py-2 text-sm font-semibold border-b-2 border-transparent text-gray-500 hover:text-gray-700 dark:hover:text-gray-300 transition-all">
                            <i class="bi bi-bullseye me-1"></i>Task Types
                        </button>
                        <button onclick="switchChart('subjectArea')" id="tab-subjectArea"
                                class="chart-tab px-4 py-2 text-sm font-semibold border-b-2 border-transparent text-gray-500 hover:text-gray-700 dark:hover:text-gray-300 transition-all">
                            <i class="bi bi-folder me-1"></i>Subject Areas
                        </button>
                    </div>
                    
                    <div class="relative h-64 md:h-80">
                        <canvas id="statsChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Monthly Growth Chart -->
            <div class="mt-8 max-w-4xl mx-auto" data-aos="fade-up" data-aos-delay="500">
                <div class="bg-white dark:bg-gray-800 rounded-3xl p-6 md:p-8 shadow-sm border border-gray-100 dark:border-gray-700">
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white">Monthly Growth</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">New datasets added per month</p>
                        </div>
                        <div class="flex items-center gap-2 px-3 py-1.5 rounded-full bg-green-50 dark:bg-green-900/30">
                            <i class="bi bi-graph-up-arrow text-green-600 dark:text-green-400"></i>
                            <span class="text-xs font-semibold text-green-700 dark:text-green-300">
                                +<?php echo e($stats['new_this_month'] ?? 0); ?> this month
                            </span>
                        </div>
                    </div>
                    <div class="relative h-64 md:h-80">
                        <canvas id="growthChart"></canvas>
                    </div>
                </div>
            </div>
            
        </div>
    </section>

    <!-- ===== MAIN CONTENT ===== -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        
        <?php if($popularDatasets->isNotEmpty() || $newDatasets->isNotEmpty()): ?>
            <div class="space-y-16">
                
                <!-- Popular Datasets -->
                <?php if($popularDatasets->isNotEmpty()): ?>
                <section data-aos="fade-up">
                    <div class="flex items-center justify-between mb-8">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 rounded-xl bg-red-50 dark:bg-red-900/30 flex items-center justify-center">
                                <i class="bi bi-fire text-2xl text-red-500"></i>
                            </div>
                            <div>
                                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Popular Datasets</h2>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Most viewed by researchers</p>
                            </div>
                        </div>
                        <a href="<?php echo e(route('datasets.index', ['sort' => 'view_count', 'order' => 'desc'])); ?>" 
                           class="hidden sm:inline-flex items-center gap-1 text-sm font-semibold text-brand-600 dark:text-brand-400 hover:text-brand-700 dark:hover:text-brand-300 transition-colors">
                            View All
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6">
                        <?php $__currentLoopData = $popularDatasets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $dataset): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div data-aos="fade-up" data-aos-delay="<?php echo e($index * 100); ?>">
                            <?php echo $__env->make('components.dataset-card-mini', [
                                'dataset' => $dataset, 
                                'showStats' => true,
                                'showBadge' => true,
                                'badgeText' => 'Popular',
                                'badgeVariant' => 'danger'
                            ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </section>
                <?php endif; ?>

                <!-- New Datasets -->
                <?php if($newDatasets->isNotEmpty()): ?>
                <section data-aos="fade-up">
                    <div class="flex items-center justify-between mb-8">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 rounded-xl bg-brand-50 dark:bg-brand-900/30 flex items-center justify-center">
                                <i class="bi bi-clock-history text-2xl text-brand-600 dark:text-brand-400"></i>
                            </div>
                            <div>
                                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Newly Added</h2>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Fresh datasets for exploration</p>
                            </div>
                        </div>
                        <a href="<?php echo e(route('datasets.index', ['sort' => 'created_at', 'order' => 'desc'])); ?>" 
                           class="hidden sm:inline-flex items-center gap-1 text-sm font-semibold text-brand-600 dark:text-brand-400 hover:text-brand-700 dark:hover:text-brand-300 transition-colors">
                            View All
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6">
                        <?php $__currentLoopData = $newDatasets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $dataset): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div data-aos="fade-up" data-aos-delay="<?php echo e($index * 100); ?>">
                            <?php echo $__env->make('components.dataset-card-mini', [
                                'dataset' => $dataset, 
                                'showStats' => false,
                                'showBadge' => true,
                                'badgeText' => 'New',
                                'badgeVariant' => 'success'
                            ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </section>
                <?php endif; ?>

            </div>
        <?php else: ?>
            <!-- Empty State -->
            <section class="text-center py-20" data-aos="zoom-in">
                <div class="w-24 h-24 mx-auto mb-6 rounded-full bg-gray-100 dark:bg-gray-800 flex items-center justify-center">
                    <i class="bi bi-database text-5xl text-gray-300 dark:text-gray-600"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-3">No datasets available yet</h3>
                <p class="text-gray-500 dark:text-gray-400 mb-8 max-w-md mx-auto">
                    Be the first to contribute a dataset to the repository and help advance machine learning research!
                </p>
                <a href="<?php echo e(route('contribute.policy')); ?>" 
                   class="inline-flex items-center gap-2 px-6 py-3 rounded-full bg-gradient-to-r from-brand-600 to-sphere-secondary text-white font-semibold shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition-all">
                    <i class="bi bi-plus-circle"></i>
                    <span>Donate Your First Dataset</span>
                </a>
            </section>
        <?php endif; ?>

        <!-- ===== BROWSE BY CATEGORY ===== -->
        <section class="mt-20" data-aos="fade-up">
            <div class="text-center mb-10">
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-brand-50 dark:bg-brand-900/30 mb-4">
                    <i class="bi bi-folder2-open text-brand-600 dark:text-brand-400"></i>
                    <span class="text-sm font-semibold text-brand-700 dark:text-brand-300">Explore</span>
                </div>
                <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">Browse by Category</h2>
                <p class="text-gray-500 dark:text-gray-400">Find datasets by data type or machine learning task</p>
            </div>
            
            <div class="grid md:grid-cols-2 gap-6">
                
                <!-- Data Types Card -->
                <div class="bg-white dark:bg-gray-800 rounded-3xl p-6 md:p-8 shadow-sm border border-gray-100 dark:border-gray-700 hover:shadow-xl hover:-translate-y-1 transition-all duration-300" data-aos="fade-right">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 rounded-xl bg-brand-50 dark:bg-brand-900/30 flex items-center justify-center">
                            <i class="bi bi-diagram-3 text-brand-600 dark:text-brand-400"></i>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white">Data Types</h3>
                    </div>
                    <div class="flex flex-wrap gap-2">
                        <?php $__currentLoopData = ($stats['by_data_type'] ?? collect())->take(10); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type => $count): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($type): ?>
                        <a href="<?php echo e(route('datasets.index', ['data_type' => $type])); ?>" 
                           class="inline-flex items-center gap-2 px-3 py-2 rounded-full bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 hover:bg-brand-600 hover:border-brand-600 hover:text-white hover:-translate-y-0.5 transition-all group">
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-200 group-hover:text-white"><?php echo e($type); ?></span>
                            <span class="px-2 py-0.5 rounded-full bg-gray-200 dark:bg-gray-600 text-xs font-semibold text-gray-600 dark:text-gray-300 group-hover:bg-white/20 group-hover:text-white"><?php echo e($count); ?></span>
                        </a>
                        <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
                
                <!-- Task Types Card -->
                <div class="bg-white dark:bg-gray-800 rounded-3xl p-6 md:p-8 shadow-sm border border-gray-100 dark:border-gray-700 hover:shadow-xl hover:-translate-y-1 transition-all duration-300" data-aos="fade-left">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 rounded-xl bg-cyan-50 dark:bg-cyan-900/30 flex items-center justify-center">
                            <i class="bi bi-bullseye text-cyan-600 dark:text-cyan-400"></i>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white">Task Types</h3>
                    </div>
                    <div class="flex flex-wrap gap-2">
                        <?php $__currentLoopData = ($stats['by_task_type'] ?? collect())->take(10); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task => $count): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($task): ?>
                        <a href="<?php echo e(route('datasets.index', ['task_type' => $task])); ?>" 
                           class="inline-flex items-center gap-2 px-3 py-2 rounded-full bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 hover:bg-cyan-600 hover:border-cyan-600 hover:text-white hover:-translate-y-0.5 transition-all group">
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-200 group-hover:text-white"><?php echo e($task); ?></span>
                            <span class="px-2 py-0.5 rounded-full bg-gray-200 dark:bg-gray-600 text-xs font-semibold text-gray-600 dark:text-gray-300 group-hover:bg-white/20 group-hover:text-white"><?php echo e($count); ?></span>
                        </a>
                        <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
                
            </div>
        </section>

        <!-- ===== LATEST POSTS SECTION (NEW) ===== -->
        <?php if($latestPosts->isNotEmpty()): ?>
        <section class="mt-20" data-aos="fade-up">
            <div class="flex items-center justify-between mb-8">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 rounded-xl bg-purple-50 dark:bg-purple-900/30 flex items-center justify-center">
                        <i class="bi bi-journal-text text-2xl text-purple-600 dark:text-purple-400"></i>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Latest Articles</h2>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Insights and updates from our community</p>
                    </div>
                </div>
                <a href="<?php echo e(route('posts.index')); ?>" 
                   class="hidden sm:inline-flex items-center gap-1 text-sm font-semibold text-brand-600 dark:text-brand-400 hover:text-brand-700 dark:hover:text-brand-300 transition-colors">
                    View All
                    <i class="bi bi-arrow-right"></i>
                </a>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php $__currentLoopData = $latestPosts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <article class="group bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden hover:shadow-xl hover:-translate-y-1 transition-all duration-300" data-aos="fade-up" data-aos-delay="<?php echo e($index * 100); ?>">
                    <!-- Featured Image -->
                    <?php if($post->featured_img): ?>
                    <div class="relative h-48 overflow-hidden">
                        <img src="<?php echo e(Storage::url($post->featured_img)); ?>" alt="<?php echo e($post->title); ?>" 
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                    </div>
                    <?php else: ?>
                    <div class="relative h-48 bg-gradient-to-br from-brand-500 to-sphere-secondary flex items-center justify-center">
                        <i class="bi bi-journal-text text-6xl text-white/30"></i>
                    </div>
                    <?php endif; ?>
                    
                    <!-- Content -->
                    <div class="p-6">
                        <!-- Category Badge -->
                        <div class="flex items-center gap-2 mb-3">
                            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-brand-100 dark:bg-brand-900/30 text-brand-700 dark:text-brand-400">
                                <?php echo e($post->category->name); ?>

                            </span>
                            <span class="text-xs text-gray-500 dark:text-gray-400">
                                <i class="bi bi-eye me-1"></i><?php echo e(number_format($post->view_count)); ?>

                            </span>
                        </div>
                        
                        <!-- Title -->
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2 line-clamp-2 group-hover:text-brand-600 dark:group-hover:text-brand-400 transition-colors">
                            <a href="<?php echo e(route('posts.show', $post)); ?>">
                                <?php echo e($post->title); ?>

                            </a>
                        </h3>
                        
                        <!-- Excerpt -->
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-4 line-clamp-3">
                            <?php echo e($post->excerpt ?: Str::limit(strip_tags($post->body), 120)); ?>

                        </p>
                        
                        <!-- Author & Date -->
                        <div class="flex items-center justify-between pt-4 border-t border-gray-100 dark:border-gray-700">
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 rounded-full bg-gradient-to-br from-brand-500 to-sphere-secondary flex items-center justify-center text-white text-xs font-bold">
                                    <?php echo e(strtoupper(substr($post->user->name, 0, 1))); ?>

                                </div>
                                <span class="text-xs text-gray-600 dark:text-gray-400"><?php echo e($post->user->name); ?></span>
                            </div>
                            <span class="text-xs text-gray-500 dark:text-gray-400">
                                <?php echo e($post->published_at->format('M d, Y')); ?>

                            </span>
                        </div>
                    </div>
                </article>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            
            <!-- Mobile View All Button -->
            <div class="mt-8 text-center sm:hidden">
                <a href="<?php echo e(route('posts.index')); ?>" 
                   class="inline-flex items-center gap-2 px-6 py-3 rounded-full bg-brand-600 text-white font-semibold hover:bg-brand-700 transition-colors">
                    <span>View All Articles</span>
                    <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </section>
        <?php endif; ?>

        <!-- ===== BROWSE POSTS BY CATEGORY (NEW) ===== -->
        <?php if($categories->isNotEmpty()): ?>
        <section class="mt-20" data-aos="fade-up">
            <div class="text-center mb-10">
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-purple-50 dark:bg-purple-900/30 mb-4">
                    <i class="bi bi-tags text-purple-600 dark:text-purple-400"></i>
                    <span class="text-sm font-semibold text-purple-700 dark:text-purple-300">Categories</span>
                </div>
                <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">Explore Articles by Topic</h2>
                <p class="text-gray-500 dark:text-gray-400">Find articles by category</p>
            </div>
            
            <div class="bg-white dark:bg-gray-800 rounded-3xl p-6 md:p-8 shadow-sm border border-gray-100 dark:border-gray-700">
                <div class="flex flex-wrap gap-3">
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(route('posts.index', ['category' => $category->id])); ?>" 
                       class="inline-flex items-center gap-2 px-4 py-2.5 rounded-full bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-700/50 dark:to-gray-700 border border-gray-200 dark:border-gray-600 hover:from-purple-50 hover:to-purple-100 dark:hover:from-purple-900/20 dark:hover:to-purple-900/30 hover:border-purple-300 dark:hover:border-purple-600 hover:-translate-y-0.5 transition-all group">
                        <i class="bi bi-tag-fill text-purple-500 group-hover:text-purple-600"></i>
                        <span class="text-sm font-medium text-gray-700 dark:text-gray-200 group-hover:text-purple-700 dark:group-hover:text-purple-300"><?php echo e($category->name); ?></span>
                        <span class="px-2 py-0.5 rounded-full bg-white dark:bg-gray-600 text-xs font-semibold text-gray-600 dark:text-gray-300 group-hover:bg-purple-100 dark:group-hover:bg-purple-900/50 group-hover:text-purple-700 dark:group-hover:text-purple-300">
                            <?php echo e($category->posts_count); ?>

                        </span>
                    </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </section>
        <?php endif; ?>
        
        <!-- ===== CTA SECTION ===== -->
        <section class="mt-20" data-aos="zoom-in">
            <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-brand-600 via-sphere-primary to-sphere-secondary text-white">
                <!-- Background Pattern -->
                <div class="absolute inset-0 bg-[radial-gradient(circle_at_30%_50%,rgba(255,255,255,0.1)_0%,transparent_50%)]"></div>
                
                <div class="relative p-8 md:p-12 lg:p-16">
                    <div class="grid md:grid-cols-2 gap-8 items-center">
                        <div>
                            <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-white/10 backdrop-blur-sm border border-white/20 mb-4">
                                <i class="bi bi-rocket-takeoff text-yellow-300"></i>
                                <span class="text-xs font-semibold">Get Started</span>
                            </div>
                            <h3 class="text-3xl md:text-4xl font-bold mb-4">Ready to Share Your Research?</h3>
                            <p class="text-white/90 mb-8 leading-relaxed">
                                Contribute your dataset to help advance machine learning research worldwide. 
                                All submissions are reviewed by our team and assigned a permanent DOI.
                            </p>
                            <a href="<?php echo e(route('contribute.policy')); ?>" 
                               class="inline-flex items-center gap-2 px-6 py-3 rounded-full bg-white text-brand-700 font-semibold shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition-all">
                                <i class="bi bi-cloud-arrow-up"></i>
                                <span>Start Contributing</span>
                            </a>
                        </div>
                        <div class="hidden md:flex justify-center">
                            <div class="relative">
                                <div class="absolute inset-0 bg-white/20 rounded-full blur-3xl"></div>
                                <i class="bi bi-cloud-arrow-up text-9xl text-white/40 relative animate-float"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<!-- AOS Animation Library -->
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<style>
    /* Custom Animations */
    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
    }
    
    @keyframes pulse-slow {
        0%, 100% { opacity: 0.5; transform: scale(1); }
        50% { opacity: 0.8; transform: scale(1.1); }
    }
    
    .animate-float {
        animation: float 4s ease-in-out infinite;
    }
    
    .animate-pulse-slow {
        animation: pulse-slow 4s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }
    
    /* Smooth scroll */
    html {
        scroll-behavior: smooth;
    }
    
    /* Custom scrollbar */
    ::-webkit-scrollbar {
        width: 10px;
        height: 10px;
    }
    
    ::-webkit-scrollbar-track {
        background: transparent;
    }
    
    ::-webkit-scrollbar-thumb {
        background: rgba(99, 102, 241, 0.3);
        border-radius: 10px;
    }
    
    ::-webkit-scrollbar-thumb:hover {
        background: rgba(99, 102, 241, 0.5);
    }
    
    /* Line clamp utilities */
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    /* Accessibility */
    @media (prefers-reduced-motion: reduce) {
        *, *::before, *::after {
            animation-duration: 0.01ms !important;
            animation-iteration-count: 1 !important;
            transition-duration: 0.01ms !important;
        }
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
<!-- AOS Animation Library -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

<script>
// Initialize AOS
AOS.init({
    duration: 800,
    easing: 'ease-out-cubic',
    once: true,
    offset: 50
});

// ===== DATA DARI DATABASE (via Blade) =====
const chartData = {
    dataType: {
        labels: <?php echo json_encode(($stats['by_data_type'] ?? collect())->keys()->toArray(), 15, 512) ?>,
        values: <?php echo json_encode(($stats['by_data_type'] ?? collect())->values()->toArray(), 15, 512) ?>,
        color: '#6366f1'
    },
    taskType: {
        labels: <?php echo json_encode(($stats['by_task_type'] ?? collect())->keys()->toArray(), 15, 512) ?>,
        values: <?php echo json_encode(($stats['by_task_type'] ?? collect())->values()->toArray(), 15, 512) ?>,
        color: '#06b6d4'
    },
    subjectArea: {
        labels: <?php echo json_encode(($stats['by_subject_area'] ?? collect())->keys()->toArray(), 15, 512) ?>,
        values: <?php echo json_encode(($stats['by_subject_area'] ?? collect())->values()->toArray(), 15, 512) ?>,
        color: '#8b5cf6'
    },
    monthlyGrowth: {
        labels: <?php echo json_encode(($stats['monthly_growth'] ?? collect())->keys()->map(fn($m) => \Carbon\Carbon::parse($m.'-01')->format('M Y'))->toArray(), 15, 512) ?>,
        values: <?php echo json_encode(($stats['monthly_growth'] ?? collect())->values()->toArray(), 15, 512) ?>,
    }
};

let currentChart = null;
let growthChart = null;
let activeTab = 'dataType';

// ===== INITIALIZE CHARTS =====
document.addEventListener('DOMContentLoaded', function() {
    initMainChart('dataType');
    initGrowthChart();
    
    // Auto-refresh setiap 5 menit
    setInterval(() => {
        fetchCurrentStats();
    }, 300000);
});

// ===== MAIN CHART (Distribution) =====
function initMainChart(type) {
    const ctx = document.getElementById('statsChart');
    if (!ctx) return;
    
    if (currentChart) currentChart.destroy();
    
    const data = chartData[type];
    const isDark = document.documentElement.classList.contains('dark');
    
    const colors = data.labels.map((_, i) => {
        const hue = (i * 360 / Math.max(data.labels.length, 1)) % 360;
        return `hsla(${hue}, 70%, 60%, 0.8)`;
    });
    
    const borderColors = colors.map(c => c.replace('0.8', '1'));
    
    currentChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: data.labels,
            datasets: [{
                label: 'Number of Datasets',
                data: data.values,
                backgroundColor: colors,
                borderColor: borderColors,
                borderWidth: 2,
                borderRadius: 12,
                borderSkipped: false,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: isDark ? 'rgba(31, 41, 55, 0.95)' : 'rgba(255, 255, 255, 0.95)',
                    titleColor: isDark ? '#e5e7eb' : '#374151',
                    bodyColor: isDark ? '#e5e7eb' : '#374151',
                    borderColor: isDark ? 'rgba(255,255,255,0.1)' : 'rgba(0,0,0,0.05)',
                    borderWidth: 1,
                    padding: 12,
                    cornerRadius: 8,
                    callbacks: {
                        label: (context) => ` ${context.parsed.y} datasets`
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { 
                        color: isDark ? '#e5e7eb' : '#374151',
                        stepSize: 1,
                        font: { size: 11 }
                    },
                    grid: { 
                        color: isDark ? 'rgba(255,255,255,0.1)' : 'rgba(0,0,0,0.05)',
                        drawBorder: false
                    }
                },
                x: {
                    ticks: { 
                        color: isDark ? '#e5e7eb' : '#374151',
                        maxRotation: 45,
                        font: { size: 11 }
                    },
                    grid: { display: false }
                }
            },
            animation: {
                duration: 1000,
                easing: 'easeInOutQuart'
            }
        }
    });
}

// ===== GROWTH CHART (Line) =====
function initGrowthChart() {
    const ctx = document.getElementById('growthChart');
    if (!ctx) return;
    
    const isDark = document.documentElement.classList.contains('dark');
    const data = chartData.monthlyGrowth;
    
    const gradient = ctx.getContext('2d').createLinearGradient(0, 0, 0, 300);
    gradient.addColorStop(0, 'rgba(99, 102, 241, 0.3)');
    gradient.addColorStop(1, 'rgba(99, 102, 241, 0)');
    
    growthChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: data.labels,
            datasets: [{
                label: 'New Datasets',
                data: data.values,
                borderColor: '#6366f1',
                backgroundColor: gradient,
                borderWidth: 3,
                fill: true,
                tension: 0.4,
                pointBackgroundColor: '#6366f1',
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
                pointRadius: 5,
                pointHoverRadius: 7,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: isDark ? 'rgba(31, 41, 55, 0.95)' : 'rgba(255, 255, 255, 0.95)',
                    titleColor: isDark ? '#e5e7eb' : '#374151',
                    bodyColor: isDark ? '#e5e7eb' : '#374151',
                    padding: 12,
                    cornerRadius: 8,
                    callbacks: {
                        label: (context) => ` ${context.parsed.y} new datasets`
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { 
                        color: isDark ? '#e5e7eb' : '#374151',
                        stepSize: 1
                    },
                    grid: { 
                        color: isDark ? 'rgba(255,255,255,0.1)' : 'rgba(0,0,0,0.05)'
                    }
                },
                x: {
                    ticks: { color: isDark ? '#e5e7eb' : '#374151' },
                    grid: { display: false }
                }
            }
        }
    });
}

// ===== SWITCH CHART TAB =====
function switchChart(type) {
    document.querySelectorAll('.chart-tab').forEach(tab => {
        tab.classList.remove('border-brand-600', 'text-brand-600', 'dark:text-brand-400');
        tab.classList.add('border-transparent', 'text-gray-500');
    });
    
    const activeTabEl = document.getElementById(`tab-${type}`);
    activeTabEl.classList.add('border-brand-600', 'text-brand-600', 'dark:text-brand-400');
    activeTabEl.classList.remove('border-transparent', 'text-gray-500');
    
    initMainChart(type);
    activeTab = type;
}

// ===== FETCH CURRENT STATS =====
function fetchCurrentStats() {
    fetch('<?php echo e(route("home")); ?>', {
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
    .then(response => response.text())
    .then(html => {
        console.log('Stats refreshed');
    })
    .catch(err => console.warn('Failed to refresh stats:', err));
}

// ===== UPDATE CHART ON THEME CHANGE =====
const observer = new MutationObserver((mutations) => {
    mutations.forEach((mutation) => {
        if (mutation.attributeName === 'class') {
            if (currentChart) initMainChart(activeTab);
            if (growthChart) initGrowthChart();
        }
    });
});

observer.observe(document.documentElement, { attributes: true });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Documents\TB-PWL-DATASPHERE\resources\views/home.blade.php ENDPATH**/ ?>