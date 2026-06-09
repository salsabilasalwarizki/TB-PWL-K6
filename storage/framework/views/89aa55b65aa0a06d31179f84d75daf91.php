<?php $__env->startSection('title', 'Sign In - DataSphere ML Repository'); ?>
<?php $__env->startSection('meta_desc', 'Sign in to your DataSphere Machine Learning Repository account'); ?>

<?php $__env->startSection('content'); ?>
<div class="min-h-[calc(100vh-64px)] flex items-center justify-center px-4 py-12 bg-gradient-to-br from-gray-50 via-brand-50/30 to-sphere-secondary/10 dark:from-gray-900 dark:via-gray-900 dark:to-gray-900">
    
    <!-- Background Decoration -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-20 left-10 w-72 h-72 bg-brand-500/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-20 right-10 w-96 h-96 bg-sphere-secondary/10 rounded-full blur-3xl"></div>
    </div>
    
    <div class="relative w-full max-w-md">
        
        <!-- Auth Card -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 p-8 md:p-10">
            
            <!-- Logo & Header -->
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-gradient-to-br from-brand-500 to-sphere-secondary mb-4 shadow-lg">
                    <svg width="32" height="32" viewBox="0 0 40 40" fill="none">
                        <circle cx="20" cy="20" r="18" fill="white" opacity="0.2"/>
                        <ellipse cx="20" cy="20" rx="18" ry="8" stroke="white" stroke-width="1.5" fill="none" opacity="0.6"/>
                        <ellipse cx="20" cy="20" rx="8" ry="18" stroke="white" stroke-width="1.5" fill="none" opacity="0.6"/>
                        <line x1="2" y1="20" x2="38" y2="20" stroke="white" stroke-width="1.5" opacity="0.6"/>
                        <line x1="20" y1="2" x2="20" y2="38" stroke="white" stroke-width="1.5" opacity="0.6"/>
                        <circle cx="12" cy="14" r="2" fill="white"/>
                        <circle cx="28" cy="16" r="2" fill="white"/>
                        <circle cx="20" cy="28" r="2" fill="white"/>
                    </svg>
                </div>
                <h2 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white mb-2">
                    Welcome Back!
                </h2>
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    Sign in to continue to <span class="font-semibold gradient-text">DataSphere</span>
                </p>
            </div>
            
            <!-- Success Message -->
            <?php if(session('status')): ?>
            <div class="mb-6 p-4 rounded-xl bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 flex items-start gap-3">
                <i class="bi bi-check-circle-fill text-green-500 text-xl mt-0.5 flex-shrink-0"></i>
                <p class="text-sm text-green-800 dark:text-green-200 font-medium"><?php echo e(session('status')); ?></p>
            </div>
            <?php endif; ?>
            
            <!-- Login Form -->
            <form class="space-y-5" method="POST" action="<?php echo e(route('login')); ?>">
                <?php echo csrf_field(); ?>
                
                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                        <i class="bi bi-envelope me-1"></i>Email Address
                    </label>
                    <input type="email" 
                           id="email" 
                           name="email" 
                           value="<?php echo e(old('email')); ?>" 
                           required 
                           autofocus
                           autocomplete="email"
                           placeholder="your@email.com"
                           class="w-full px-4 py-3 rounded-xl bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 transition-all <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 focus:border-red-500 focus:ring-red-500/20 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-2 text-xs text-red-500 flex items-center gap-1">
                            <i class="bi bi-exclamation-circle"></i>
                            <?php echo e($message); ?>

                        </p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                
                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                        <i class="bi bi-lock me-1"></i>Password
                    </label>
                    <div class="relative">
                        <input type="password" 
                               id="password" 
                               name="password" 
                               required
                               autocomplete="current-password"
                               placeholder="Enter your password"
                               class="w-full px-4 py-3 pr-12 rounded-xl bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 transition-all <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 focus:border-red-500 focus:ring-red-500/20 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                        <button type="button" 
                                onclick="togglePassword()" 
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition-colors">
                            <i class="bi bi-eye" id="toggleIcon"></i>
                        </button>
                    </div>
                    <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-2 text-xs text-red-500 flex items-center gap-1">
                            <i class="bi bi-exclamation-circle"></i>
                            <?php echo e($message); ?>

                        </p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                
                <!-- Remember Me & Forgot Password -->
                <div class="flex items-center justify-between">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" 
                               name="remember" 
                               id="remember"
                               <?php echo e(old('remember') ? 'checked' : ''); ?>

                               class="w-4 h-4 rounded border-gray-300 dark:border-gray-600 text-brand-600 focus:ring-brand-500">
                        <span class="text-sm text-gray-600 dark:text-gray-400">Remember me</span>
                    </label>
                    
                    <?php if(Route::has('password.request')): ?>
                        <a href="<?php echo e(route('password.request')); ?>" class="text-sm font-semibold text-brand-600 dark:text-brand-400 hover:text-brand-700 dark:hover:text-brand-300 transition-colors">
                            Forgot password?
                        </a>
                    <?php endif; ?>
                </div>
                
                <!-- Submit Button -->
                <button type="submit" 
                        class="w-full py-3 rounded-xl bg-gradient-to-r from-brand-600 to-sphere-secondary text-white font-semibold shadow-lg hover:shadow-xl hover:shadow-brand-500/30 hover:-translate-y-0.5 transition-all">
                    <i class="bi bi-box-arrow-in-right me-2"></i>
                    Sign In
                </button>
            </form>
            
            <!-- Divider -->
            <div class="relative my-8">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-gray-200 dark:border-gray-700"></div>
                </div>
                <div class="relative flex justify-center text-sm">
                    <span class="px-4 bg-white dark:bg-gray-800 text-gray-500 dark:text-gray-400">
                        Or continue with
                    </span>
                </div>
            </div>
            
            <!-- Social Login Buttons -->
            <div class="grid grid-cols-2 gap-3">
                <!-- Google -->
                <a href="<?php echo e(route('google.login')); ?>" 
                   class="flex items-center justify-center gap-2 px-4 py-3 rounded-xl bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 text-gray-700 dark:text-gray-200 font-semibold text-sm hover:bg-gray-50 dark:hover:bg-gray-600 hover:border-gray-300 dark:hover:border-gray-500 hover:-translate-y-0.5 transition-all">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92a5.06 5.06 0 0 1-2.2 3.32v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.1z" fill="#4285F4"/>
                        <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                        <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                        <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                    </svg>
                    <span>Google</span>
                </a>
                
                <!-- GitHub -->
                <a href="<?php echo e(route('github.login')); ?>" 
                   class="flex items-center justify-center gap-2 px-4 py-3 rounded-xl bg-gray-900 dark:bg-gray-700 border border-gray-900 dark:border-gray-600 text-white font-semibold text-sm hover:bg-gray-800 dark:hover:bg-gray-600 hover:-translate-y-0.5 transition-all">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0 0 24 12c0-6.63-5.37-12-12-12z"/>
                    </svg>
                    <span>GitHub</span>
                </a>
            </div>
            
            <!-- Sign Up Link -->
            <p class="text-center text-sm text-gray-600 dark:text-gray-400 mt-8">
                Don't have an account? 
                <a href="<?php echo e(route('register')); ?>" class="font-semibold text-brand-600 dark:text-brand-400 hover:text-brand-700 dark:hover:text-brand-300 transition-colors">
                    Sign up now
                </a>
            </p>
            
        </div>
        
        <!-- Footer Info -->
        <div class="text-center mt-6">
            <p class="text-xs text-gray-500 dark:text-gray-400">
                <i class="bi bi-shield-check me-1"></i>
                Protected by industry-standard encryption
            </p>
        </div>
        
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
    // Toggle Password Visibility
    function togglePassword() {
        const passwordInput = document.getElementById('password');
        const toggleIcon = document.getElementById('toggleIcon');
        
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            toggleIcon.classList.remove('bi-eye');
            toggleIcon.classList.add('bi-eye-slash');
        } else {
            passwordInput.type = 'password';
            toggleIcon.classList.remove('bi-eye-slash');
            toggleIcon.classList.add('bi-eye');
        }
    }
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.auth', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Documents\TB-PWL-DATASPHERE\resources\views/auth/login.blade.php ENDPATH**/ ?>