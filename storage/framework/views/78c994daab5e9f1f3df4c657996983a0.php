
<?php $__env->startSection('title', 'My Profile - DataSphere Machine Learning Repository'); ?>

<?php $__env->startSection('content'); ?>
<div class="relative">
    
    <!-- ===== EMAIL VERIFICATION NOTICE (PROMINENT) ===== -->
    <?php if(!$user->email_verified_at): ?>
    <div class="bg-gradient-to-r from-amber-500 to-orange-500 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3">
                <div class="flex items-start gap-3 flex-1">
                    <div class="flex-shrink-0 w-10 h-10 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center">
                        <i class="bi bi-envelope-exclamation text-xl"></i>
                    </div>
                    <div class="flex-1">
                        <h3 class="font-bold text-sm sm:text-base">Verify Your Email Address</h3>
                        <p class="text-white/90 text-xs sm:text-sm mt-0.5">
                            Please verify your email to unlock all features. Check your inbox or 
                            <form method="POST" action="<?php echo e(route('verification.send')); ?>" class="inline">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="underline font-semibold hover:text-white/70 transition-colors">
                                    resend verification email
                                </button>
                            </form>
                        </p>
                    </div>
                </div>
                <a href="<?php echo e(route('verification.notice')); ?>" 
                   class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-white text-amber-600 font-semibold text-sm hover:bg-white/90 transition-all shadow-md">
                    <i class="bi bi-envelope-check"></i>
                    <span>Verify Now</span>
                </a>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <!-- ===== PROFILE HERO ===== -->
    <section class="relative overflow-hidden bg-gradient-to-br from-brand-600 via-sphere-primary to-sphere-secondary text-white">
        <div class="absolute inset-0">
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_20%_80%,rgba(255,255,255,0.1)_0%,transparent_50%)]"></div>
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_80%_20%,rgba(255,255,255,0.08)_0%,transparent_50%)]"></div>
        </div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-16">
            <div class="flex flex-col md:flex-row items-center md:items-end gap-6">
                
                <!-- Avatar -->
                <div class="relative">
                    <div class="absolute inset-0 bg-white/20 rounded-full blur-2xl"></div>
                    <div class="relative w-28 h-28 md:w-32 md:h-32 rounded-full bg-white/10 backdrop-blur-md border-4 border-white/30 flex items-center justify-center text-5xl md:text-6xl font-bold shadow-2xl">
                        <?php echo e(strtoupper(substr($user->name, 0, 1))); ?>

                    </div>
                    <?php if($user->email_verified_at): ?>
                    <div class="absolute -bottom-1 -right-1 w-10 h-10 rounded-full bg-green-500 border-4 border-white flex items-center justify-center shadow-lg">
                        <i class="bi bi-check-lg text-white text-lg"></i>
                    </div>
                    <?php else: ?>
                    <div class="absolute -bottom-1 -right-1 w-10 h-10 rounded-full bg-amber-500 border-4 border-white flex items-center justify-center shadow-lg animate-pulse">
                        <i class="bi bi-exclamation text-white text-lg"></i>
                    </div>
                    <?php endif; ?>
                </div>
                
                <!-- User Info -->
                <div class="flex-1 text-center md:text-left">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 backdrop-blur-sm border border-white/20 mb-3">
                        <i class="bi bi-patch-check-fill text-yellow-300"></i>
                        <span class="text-xs font-semibold"><?php echo e(ucfirst($user->role ?? 'user')); ?></span>
                    </div>
                    <h1 class="text-3xl md:text-4xl font-bold mb-1"><?php echo e($user->name); ?></h1>
                    <p class="text-white/80 text-sm md:text-base flex items-center gap-2 justify-center md:justify-start">
                        <i class="bi bi-envelope"></i>
                        <span><?php echo e($user->email); ?></span>
                        <?php if($user->email_verified_at): ?>
                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full bg-green-500/20 border border-green-400/30 text-green-100 text-xs font-semibold">
                            <i class="bi bi-patch-check-fill"></i>
                            <span>Verified</span>
                        </span>
                        <?php else: ?>
                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full bg-amber-500/20 border border-amber-400/30 text-amber-100 text-xs font-semibold">
                            <i class="bi bi-exclamation-circle"></i>
                            <span>Not Verified</span>
                        </span>
                        <?php endif; ?>
                    </p>
                    <?php if($user->institution): ?>
                    <p class="text-white/70 text-sm mt-1">
                        <i class="bi bi-building me-1"></i><?php echo e($user->institution); ?>

                    </p>
                    <?php endif; ?>
                </div>
                
                <!-- Quick Stats -->
                <div class="flex gap-4 md:gap-6">
                    <div class="text-center">
                        <div class="text-2xl md:text-3xl font-bold"><?php echo e($user->datasets->count() ?? 0); ?></div>
                        <div class="text-xs text-white/70 mt-1">Datasets</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl md:text-3xl font-bold"><?php echo e(number_format($user->datasets->sum('view_count') ?? 0)); ?></div>
                        <div class="text-xs text-white/70 mt-1">Views</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl md:text-3xl font-bold"><?php echo e(number_format($user->datasets->sum('download_count') ?? 0)); ?></div>
                        <div class="text-xs text-white/70 mt-1">Downloads</div>
                    </div>
                </div>
                
            </div>
        </div>
    </section>

    <!-- ===== MAIN CONTENT ===== -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid lg:grid-cols-[280px_1fr] gap-6">
            
            <!-- ===== SIDEBAR NAVIGATION ===== -->
            <aside class="lg:sticky lg:top-24 lg:self-start">
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
                    <div class="p-4 border-b border-gray-100 dark:border-gray-700">
                        <h3 class="text-sm font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Navigation</h3>
                    </div>
                    <nav class="p-2">
                        <a href="<?php echo e(route('profile')); ?>" 
                           class="flex items-center gap-3 px-4 py-3 rounded-xl mb-1 transition-all <?php echo e(request()->routeIs('profile') ? 'bg-gradient-to-r from-brand-500 to-sphere-secondary text-white shadow-md' : 'text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700/50'); ?>">
                            <i class="bi bi-person-fill text-lg"></i>
                            <span class="font-semibold text-sm">Profile</span>
                            <?php if(request()->routeIs('profile')): ?>
                            <i class="bi bi-chevron-right ml-auto"></i>
                            <?php endif; ?>
                        </a>
                        <a href="<?php echo e(route('profile.datasets')); ?>" 
                           class="flex items-center gap-3 px-4 py-3 rounded-xl mb-1 transition-all <?php echo e(request()->routeIs('profile.datasets*') ? 'bg-gradient-to-r from-brand-500 to-sphere-secondary text-white shadow-md' : 'text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700/50'); ?>">
                            <i class="bi bi-grid-3x3-gap-fill text-lg"></i>
                            <span class="font-semibold text-sm">My Datasets</span>
                            <?php if(request()->routeIs('profile.datasets*')): ?>
                            <i class="bi bi-chevron-right ml-auto"></i>
                            <?php endif; ?>
                        </a>
                        <a href="<?php echo e(route('profile.edits')); ?>" 
                           class="flex items-center gap-3 px-4 py-3 rounded-xl mb-1 transition-all <?php echo e(request()->routeIs('profile.edits*') ? 'bg-gradient-to-r from-brand-500 to-sphere-secondary text-white shadow-md' : 'text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700/50'); ?>">
                            <i class="bi bi-pencil-fill text-lg"></i>
                            <span class="font-semibold text-sm">Edits</span>
                            <?php if(request()->routeIs('profile.edits*')): ?>
                            <i class="bi bi-chevron-right ml-auto"></i>
                            <?php endif; ?>
                        </a>
                    </nav>
                    
                    <!-- Quick Actions -->
                    <div class="p-4 border-t border-gray-100 dark:border-gray-700">
                        <h3 class="text-sm font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-3">Quick Actions</h3>
                        <a href="<?php echo e(route('contribute.policy')); ?>" 
                           class="flex items-center justify-center gap-2 w-full px-4 py-2.5 rounded-xl bg-gradient-to-r from-brand-500 to-sphere-secondary text-white font-semibold text-sm shadow-md hover:shadow-lg hover:-translate-y-0.5 transition-all">
                            <i class="bi bi-plus-circle"></i>
                            <span>Donate Dataset</span>
                        </a>
                    </div>
                </div>
            </aside>

            <!-- ===== MAIN CONTENT AREA ===== -->
            <div class="space-y-6">
                
                <!-- Flash Messages -->
                <?php if(session('success')): ?>
                <div class="bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-800 text-green-800 dark:text-green-200 px-4 py-3 rounded-xl flex items-start gap-3">
                    <i class="bi bi-check-circle-fill text-green-500 text-xl mt-0.5"></i>
                    <div class="flex-1 text-sm font-medium"><?php echo e(session('success')); ?></div>
                    <button onclick="this.parentElement.remove()" class="text-green-500 hover:text-green-700">
                        <i class="bi bi-x-lg"></i>
                    </button>
                </div>
                <?php endif; ?>
                
                <?php if(session('error')): ?>
                <div class="bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-800 text-red-800 dark:text-red-200 px-4 py-3 rounded-xl flex items-start gap-3">
                    <i class="bi bi-exclamation-triangle-fill text-red-500 text-xl mt-0.5"></i>
                    <div class="flex-1 text-sm font-medium"><?php echo e(session('error')); ?></div>
                    <button onclick="this.parentElement.remove()" class="text-red-500 hover:text-red-700">
                        <i class="bi bi-x-lg"></i>
                    </button>
                </div>
                <?php endif; ?>

                <!-- ===== EMAIL VERIFICATION CARD ===== -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border-2 <?php echo e($user->email_verified_at ? 'border-green-200 dark:border-green-800' : 'border-amber-200 dark:border-amber-800'); ?> overflow-hidden">
                    <div class="p-6 border-b <?php echo e($user->email_verified_at ? 'border-green-100 dark:border-green-900/30' : 'border-amber-100 dark:border-amber-900/30'); ?>">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl <?php echo e($user->email_verified_at ? 'bg-green-100 dark:bg-green-900/30' : 'bg-amber-100 dark:bg-amber-900/30'); ?> flex items-center justify-center">
                                <i class="bi <?php echo e($user->email_verified_at ? 'bi-envelope-check-fill' : 'bi-envelope-exclamation'); ?> text-xl <?php echo e($user->email_verified_at ? 'text-green-600 dark:text-green-400' : 'text-amber-600 dark:text-amber-400'); ?>"></i>
                            </div>
                            <div>
                                <h2 class="text-xl font-bold text-gray-900 dark:text-white">Email Verification</h2>
                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    <?php echo e($user->email_verified_at ? 'Your email is verified' : 'Verify your email to unlock all features'); ?>

                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="p-6">
                        <?php if($user->email_verified_at): ?>
                        <!-- Verified State -->
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-4">
                                <div class="w-16 h-16 rounded-full bg-green-100 dark:bg-green-900/30 flex items-center justify-center">
                                    <i class="bi bi-check-circle-fill text-3xl text-green-600 dark:text-green-400"></i>
                                </div>
                                <div>
                                    <h3 class="font-bold text-gray-900 dark:text-white">Email Verified</h3>
                                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                        Verified on <?php echo e($user->email_verified_at->format('F d, Y \a\t g:i A')); ?>

                                    </p>
                                </div>
                            </div>
                            <span class="px-4 py-2 rounded-full bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400 text-sm font-semibold">
                                <i class="bi bi-patch-check-fill me-1"></i>Verified
                            </span>
                        </div>
                        <?php else: ?>
                        <!-- Not Verified State -->
                        <div class="space-y-4">
                            <div class="flex items-start gap-4">
                                <div class="w-16 h-16 rounded-full bg-amber-100 dark:bg-amber-900/30 flex items-center justify-center flex-shrink-0">
                                    <i class="bi bi-envelope-exclamation text-3xl text-amber-600 dark:text-amber-400"></i>
                                </div>
                                <div class="flex-1">
                                    <h3 class="font-bold text-gray-900 dark:text-white">Email Not Verified</h3>
                                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                                        We sent a verification link to <strong class="text-gray-900 dark:text-white"><?php echo e($user->email); ?></strong>. 
                                        Please check your inbox and click the link to verify your email address.
                                    </p>
                                </div>
                            </div>
                            
                            <div class="bg-amber-50 dark:bg-amber-900/20 border border-amber-200 dark:border-amber-800 rounded-xl p-4">
                                <div class="flex items-start gap-3">
                                    <i class="bi bi-info-circle-fill text-amber-500 mt-0.5"></i>
                                    <div class="flex-1 text-sm text-amber-800 dark:text-amber-200">
                                        <p class="font-semibold mb-1">Didn't receive the email?</p>
                                        <ul class="space-y-1 text-xs">
                                            <li>• Check your spam or junk folder</li>
                                            <li>• Make sure the email address is correct</li>
                                            <li>• Click the button below to resend the verification email</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="flex flex-col sm:flex-row gap-3">
                                <form method="POST" action="<?php echo e(route('verification.send')); ?>" class="flex-1">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" 
                                            class="w-full inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl bg-gradient-to-r from-amber-500 to-orange-500 text-white font-semibold shadow-md hover:shadow-lg hover:-translate-y-0.5 transition-all">
                                        <i class="bi bi-envelope-paper"></i>
                                        <span>Resend Verification Email</span>
                                    </button>
                                </form>
                                <a href="<?php echo e(route('verification.notice')); ?>" 
                                   class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200 font-semibold hover:bg-gray-200 dark:hover:bg-gray-600 transition-all">
                                    <i class="bi bi-eye"></i>
                                    <span>View Details</span>
                                </a>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- ===== PROFILE CARD ===== -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
                    <div class="p-6 border-b border-gray-100 dark:border-gray-700 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-brand-50 dark:bg-brand-900/30 flex items-center justify-center">
                                <i class="bi bi-person-circle text-xl text-brand-600 dark:text-brand-400"></i>
                            </div>
                            <div>
                                <h2 class="text-xl font-bold text-gray-900 dark:text-white">Profile Information</h2>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Your personal details</p>
                            </div>
                        </div>
                        <button onclick="toggleEditForm()" id="editBtn" 
                                class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-brand-50 dark:bg-brand-900/30 text-brand-600 dark:text-brand-400 font-semibold text-sm hover:bg-brand-100 dark:hover:bg-brand-900/50 transition-colors">
                            <i class="bi bi-pencil"></i>
                            <span>Edit</span>
                        </button>
                    </div>
                    
                    <!-- Display Mode -->
                    <div id="profileDisplay" class="p-6">
                        <div class="grid md:grid-cols-2 gap-4">
                            <div class="p-4 rounded-xl bg-gray-50 dark:bg-gray-700/30 border border-gray-100 dark:border-gray-700">
                                <div class="flex items-center gap-2 mb-2">
                                    <i class="bi bi-person text-gray-400"></i>
                                    <span class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Full Name</span>
                                </div>
                                <p class="text-gray-900 dark:text-white font-semibold"><?php echo e($user->name); ?></p>
                            </div>
                            
                            <div class="p-4 rounded-xl bg-gray-50 dark:bg-gray-700/30 border border-gray-100 dark:border-gray-700">
                                <div class="flex items-center gap-2 mb-2">
                                    <i class="bi bi-envelope text-gray-400"></i>
                                    <span class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Email Address</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <p class="text-gray-900 dark:text-white font-semibold"><?php echo e($user->email); ?></p>
                                    <?php if($user->email_verified_at): ?>
                                    <i class="bi bi-patch-check-fill text-green-500" title="Verified"></i>
                                    <?php else: ?>
                                    <i class="bi bi-exclamation-circle text-amber-500" title="Not verified"></i>
                                    <?php endif; ?>
                                </div>
                            </div>
                            
                            <div class="p-4 rounded-xl bg-gray-50 dark:bg-gray-700/30 border border-gray-100 dark:border-gray-700">
                                <div class="flex items-center gap-2 mb-2">
                                    <i class="bi bi-shield-check text-gray-400"></i>
                                    <span class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Role</span>
                                </div>
                                <span class="inline-flex px-3 py-1 rounded-full text-xs font-semibold
                                    <?php if($user->role === 'admin' || $user->role === 'superadmin'): ?> bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400
                                    <?php elseif($user->role === 'contributor'): ?> bg-brand-100 text-brand-700 dark:bg-brand-900/30 dark:text-brand-400
                                    <?php else: ?> bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-300
                                    <?php endif; ?>">
                                    <?php echo e(ucfirst($user->role ?? 'user')); ?>

                                </span>
                            </div>
                            
                            <div class="p-4 rounded-xl bg-gray-50 dark:bg-gray-700/30 border border-gray-100 dark:border-gray-700">
                                <div class="flex items-center gap-2 mb-2">
                                    <i class="bi bi-calendar-check text-gray-400"></i>
                                    <span class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Member Since</span>
                                </div>
                                <p class="text-gray-900 dark:text-white font-semibold"><?php echo e($user->created_at->format('M d, Y')); ?></p>
                            </div>
                            
                            <div class="p-4 rounded-xl bg-gray-50 dark:bg-gray-700/30 border border-gray-100 dark:border-gray-700 md:col-span-2">
                                <div class="flex items-center gap-2 mb-2">
                                    <i class="bi bi-building text-gray-400"></i>
                                    <span class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Institution</span>
                                </div>
                                <p class="text-gray-900 dark:text-white font-semibold"><?php echo e($user->institution ?? 'Not specified'); ?></p>
                            </div>
                            
                            <?php if($user->institution_address): ?>
                            <div class="p-4 rounded-xl bg-gray-50 dark:bg-gray-700/30 border border-gray-100 dark:border-gray-700 md:col-span-2">
                                <div class="flex items-center gap-2 mb-2">
                                    <i class="bi bi-geo-alt text-gray-400"></i>
                                    <span class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Institution Address</span>
                                </div>
                                <p class="text-gray-900 dark:text-white font-semibold"><?php echo e($user->institution_address); ?></p>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <!-- Edit Form (Hidden by default) -->
                    <div id="editProfileForm" class="hidden border-t border-gray-100 dark:border-gray-700">
                        <form action="<?php echo e(route('profile.update')); ?>" method="POST" class="p-6">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>
                            
                            <div class="grid md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                        <i class="bi bi-person me-1"></i>Full Name
                                    </label>
                                    <input type="text" name="name" 
                                           class="w-full px-4 py-2.5 rounded-xl bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-white focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 transition-all" 
                                           value="<?php echo e(old('name', $user->name)); ?>" required>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                        <i class="bi bi-envelope me-1"></i>Email Address
                                    </label>
                                    <input type="email" name="email" 
                                           class="w-full px-4 py-2.5 rounded-xl bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-white focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 transition-all" 
                                           value="<?php echo e(old('email', $user->email)); ?>" required>
                                </div>
                                
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                        <i class="bi bi-building me-1"></i>Institution
                                    </label>
                                    <input type="text" name="institution" 
                                           class="w-full px-4 py-2.5 rounded-xl bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-white focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 transition-all" 
                                           value="<?php echo e(old('institution', $user->institution)); ?>">
                                </div>
                                
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                        <i class="bi bi-geo-alt me-1"></i>Institution Address
                                    </label>
                                    <textarea name="institution_address" rows="3"
                                              class="w-full px-4 py-2.5 rounded-xl bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-white focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 transition-all resize-none"><?php echo e(old('institution_address', $user->institution_address)); ?></textarea>
                                </div>
                            </div>
                            
                            <div class="flex gap-3 mt-6 pt-6 border-t border-gray-100 dark:border-gray-700">
                                <button type="submit" 
                                        class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl bg-gradient-to-r from-brand-600 to-sphere-secondary text-white font-semibold shadow-md hover:shadow-lg hover:-translate-y-0.5 transition-all">
                                    <i class="bi bi-check-circle"></i>
                                    <span>Save Changes</span>
                                </button>
                                <button type="button" onclick="toggleEditForm()" 
                                        class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200 font-semibold hover:bg-gray-200 dark:hover:bg-gray-600 transition-all">
                                    <i class="bi bi-x-circle"></i>
                                    <span>Cancel</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- ===== CHANGE PASSWORD CARD ===== -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
                    <div class="p-6 border-b border-gray-100 dark:border-gray-700">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-amber-50 dark:bg-amber-900/30 flex items-center justify-center">
                                <i class="bi bi-lock-fill text-xl text-amber-600 dark:text-amber-400"></i>
                            </div>
                            <div>
                                <h2 class="text-xl font-bold text-gray-900 dark:text-white">Change Password</h2>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Update your account password</p>
                            </div>
                        </div>
                    </div>
                    
                    <form action="<?php echo e(route('profile.password')); ?>" method="POST" class="p-6">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>
                        
                        <div class="space-y-4 max-w-xl">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                    <i class="bi bi-key me-1"></i>Current Password
                                </label>
                                <input type="password" name="current_password" 
                                       class="w-full px-4 py-2.5 rounded-xl bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-white focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 transition-all" 
                                       required>
                            </div>
                            
                            <div class="grid md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                        <i class="bi bi-shield-lock me-1"></i>New Password
                                    </label>
                                    <input type="password" name="password" 
                                           class="w-full px-4 py-2.5 rounded-xl bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-white focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 transition-all" 
                                           required>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                        <i class="bi bi-shield-check me-1"></i>Confirm Password
                                    </label>
                                    <input type="password" name="password_confirmation" 
                                           class="w-full px-4 py-2.5 rounded-xl bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-white focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 transition-all" 
                                           required>
                                </div>
                            </div>
                            
                            <div class="bg-amber-50 dark:bg-amber-900/20 border border-amber-200 dark:border-amber-800 rounded-xl p-3 flex items-start gap-2">
                                <i class="bi bi-info-circle-fill text-amber-500 mt-0.5"></i>
                                <p class="text-xs text-amber-700 dark:text-amber-300">
                                    Password must be at least 8 characters long and contain a mix of letters, numbers, and symbols.
                                </p>
                            </div>
                        </div>
                        
                        <div class="mt-6 pt-6 border-t border-gray-100 dark:border-gray-700">
                            <button type="submit" 
                                    class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl bg-gradient-to-r from-amber-500 to-orange-500 text-white font-semibold shadow-md hover:shadow-lg hover:-translate-y-0.5 transition-all">
                                <i class="bi bi-lock"></i>
                                <span>Update Password</span>
                            </button>
                        </div>
                    </form>
                </div>

                <!-- ===== ACCOUNT SECURITY CARD ===== -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
                    <div class="p-6 border-b border-gray-100 dark:border-gray-700">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-red-50 dark:bg-red-900/30 flex items-center justify-center">
                                <i class="bi bi-shield-exclamation text-xl text-red-600 dark:text-red-400"></i>
                            </div>
                            <div>
                                <h2 class="text-xl font-bold text-gray-900 dark:text-white">Account Security</h2>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Manage your account security settings</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="p-6 space-y-4">
                        <div class="flex items-center justify-between p-4 rounded-xl bg-gray-50 dark:bg-gray-700/30 border border-gray-100 dark:border-gray-700">
                            <div class="flex items-center gap-3">
                                <i class="bi bi-envelope-check text-2xl <?php echo e($user->email_verified_at ? 'text-green-500' : 'text-amber-500'); ?>"></i>
                                <div>
                                    <h4 class="font-semibold text-gray-900 dark:text-white">Email Verification</h4>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">
                                        <?php if($user->email_verified_at): ?>
                                            Verified on <?php echo e($user->email_verified_at->format('M d, Y')); ?>

                                        <?php else: ?>
                                            Your email is not verified
                                        <?php endif; ?>
                                    </p>
                                </div>
                            </div>
                            <?php if(!$user->email_verified_at): ?>
                            <a href="<?php echo e(route('verification.notice')); ?>" 
                               class="px-4 py-2 rounded-xl bg-amber-500 hover:bg-amber-600 text-white font-semibold text-sm transition-colors">
                                Verify Now
                            </a>
                            <?php else: ?>
                            <span class="px-3 py-1 rounded-full bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400 text-xs font-semibold">
                                <i class="bi bi-check-circle-fill me-1"></i>Verified
                            </span>
                            <?php endif; ?>
                        </div>
                        
                        <div class="flex items-center justify-between p-4 rounded-xl bg-gray-50 dark:bg-gray-700/30 border border-gray-100 dark:border-gray-700">
                            <div class="flex items-center gap-3">
                                <i class="bi bi-clock-history text-2xl text-gray-400"></i>
                                <div>
                                    <h4 class="font-semibold text-gray-900 dark:text-white">Last Login</h4>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">
                                        <?php echo e($user->last_login_at ? $user->last_login_at->diffForHumans() : 'Never logged in'); ?>

                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
function toggleEditForm() {
    const display = document.getElementById('profileDisplay');
    const form = document.getElementById('editProfileForm');
    const btn = document.getElementById('editBtn');
    
    if (form.classList.contains('hidden')) {
        form.classList.remove('hidden');
        btn.innerHTML = '<i class="bi bi-x-circle"></i><span>Cancel</span>';
    } else {
        form.classList.add('hidden');
        btn.innerHTML = '<i class="bi bi-pencil"></i><span>Edit</span>';
    }
}
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Documents\TB-PWL-DATASPHERE\resources\views/profile/index.blade.php ENDPATH**/ ?>