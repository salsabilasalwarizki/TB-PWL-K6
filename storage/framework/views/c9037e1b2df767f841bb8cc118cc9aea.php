<?php $__env->startSection('title', 'Reset Password - DataSphere'); ?>

<?php $__env->startSection('content'); ?>
<div class="min-h-screen flex items-center justify-center px-4 py-12 bg-gradient-to-br from-gray-50 via-white to-brand-50/30 dark:from-gray-900 dark:via-gray-900 dark:to-brand-950/20">
    
    <!-- Background Decoration -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-20 left-10 w-72 h-72 bg-brand-500/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-20 right-10 w-96 h-96 bg-sphere-secondary/10 rounded-full blur-3xl"></div>
    </div>

    <div class="relative w-full max-w-md">
        
        <!-- Logo -->
        <div class="text-center mb-8">
            <a href="<?php echo e(route('home')); ?>" class="inline-flex items-center gap-3 group">
                <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-brand-500 via-sphere-primary to-sphere-secondary flex items-center justify-center shadow-lg shadow-brand-500/30">
                    <svg width="32" height="32" viewBox="0 0 40 40" fill="none">
                        <circle cx="20" cy="20" r="18" fill="white" fill-opacity="0.2"/>
                        <ellipse cx="20" cy="20" rx="18" ry="8" stroke="white" stroke-width="1" fill="none" opacity="0.6"/>
                        <ellipse cx="20" cy="20" rx="8" ry="18" stroke="white" stroke-width="1" fill="none" opacity="0.6"/>
                        <line x1="2" y1="20" x2="38" y2="20" stroke="white" stroke-width="1" opacity="0.6"/>
                        <line x1="20" y1="2" x2="20" y2="38" stroke="white" stroke-width="1" opacity="0.6"/>
                        <circle cx="12" cy="14" r="2" fill="white"/>
                        <circle cx="28" cy="16" r="2" fill="white"/>
                        <circle cx="20" cy="28" r="2" fill="white"/>
                    </svg>
                </div>
            </a>
            <div class="mt-4">
                <h1 class="text-2xl font-bold bg-gradient-to-r from-brand-600 via-sphere-primary to-sphere-secondary bg-clip-text text-transparent">
                    DataSphere
                </h1>
                <p class="text-xs text-gray-500 dark:text-gray-400 font-medium tracking-wide mt-1">ML Repository</p>
            </div>
        </div>

        <!-- Card -->
        <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl rounded-3xl shadow-2xl border border-gray-200/50 dark:border-gray-700/50 p-8">
            
            <!-- Header -->
            <div class="text-center mb-6">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-gradient-to-br from-amber-100 to-amber-200 dark:from-amber-900/30 dark:to-amber-800/30 mb-4">
                    <i class="bi bi-key-fill text-3xl text-amber-600 dark:text-amber-400"></i>
                </div>
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">
                    Create New Password
                </h2>
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    Your new password must be different from previously used passwords.
                </p>
            </div>

            <!-- Form -->
            <form id="resetPasswordForm" method="POST" action="<?php echo e(route('password.store')); ?>" class="space-y-4">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="token" value="<?php echo e($request->route('token')); ?>">
                
                <!-- Email Field -->
                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                        <i class="bi bi-envelope me-1 text-gray-400"></i>
                        Email Address
                    </label>
                    <input type="email" 
                           id="email" 
                           name="email" 
                           value="<?php echo e(old('email', $request->email)); ?>" 
                           required 
                           autofocus
                           autocomplete="email"
                           placeholder="Enter your email address"
                           class="w-full px-4 py-3 rounded-xl bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 transition-all <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
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

                <!-- New Password Field -->
                <div>
                    <label for="password" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                        <i class="bi bi-shield-lock me-1 text-gray-400"></i>
                        New Password
                    </label>
                    <input type="password" 
                           id="password" 
                           name="password" 
                           required
                           autocomplete="new-password"
                           placeholder="Enter new password"
                           class="w-full px-4 py-3 rounded-xl bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 transition-all <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
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
                    <p class="mt-1 text-[11px] text-gray-500 dark:text-gray-400">Minimum 8 characters</p>
                </div>

                <!-- Confirm Password Field -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                        <i class="bi bi-shield-check me-1 text-gray-400"></i>
                        Confirm Password
                    </label>
                    <input type="password" 
                           id="password_confirmation" 
                           name="password_confirmation" 
                           required
                           autocomplete="new-password"
                           placeholder="Confirm your new password"
                           class="w-full px-4 py-3 rounded-xl bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 transition-all">
                </div>

                <!-- Submit Button -->
                <button type="submit" 
                        id="submitBtn"
                        class="w-full inline-flex items-center justify-center gap-2 px-6 py-3.5 bg-gradient-to-r from-brand-600 to-sphere-secondary text-white font-semibold rounded-xl shadow-lg shadow-brand-500/30 hover:shadow-xl hover:shadow-brand-500/40 hover:-translate-y-0.5 transition-all duration-300 mt-2">
                    <i class="bi bi-arrow-clockwise" id="btnIcon"></i>
                    <span id="btnText">Reset Password</span>
                    <svg id="btnLoader" class="hidden animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </button>
            </form>

            <!-- Divider -->
            <div class="relative my-6">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-gray-200 dark:border-gray-700"></div>
                </div>
                <div class="relative flex justify-center">
                    <span class="px-3 text-xs text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800">or</span>
                </div>
            </div>

            <!-- Back to Login -->
            <div class="text-center">
                <a href="<?php echo e(route('login')); ?>" 
                   class="inline-flex items-center gap-2 text-sm font-semibold text-brand-600 dark:text-brand-400 hover:text-brand-700 dark:hover:text-brand-300 transition-colors group">
                    <i class="bi bi-arrow-left group-hover:-translate-x-1 transition-transform"></i>
                    <span>Back to Sign In</span>
                </a>
            </div>
        </div>

        <!-- Copyright -->
        <div class="mt-8 text-center">
            <p class="text-xs text-gray-400 dark:text-gray-500">
                © <?php echo e(date('Y')); ?> <span class="font-semibold">DataSphere</span> ML Repository
            </p>
        </div>
    </div>
</div>

<?php $__env->startPush('styles'); ?>
<style>
    @keyframes slide-up {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .animate-slide-up {
        animation: slide-up 0.5s ease-out;
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('resetPasswordForm');
    const submitBtn = document.getElementById('submitBtn');
    const btnText = document.getElementById('btnText');
    const btnIcon = document.getElementById('btnIcon');
    const btnLoader = document.getElementById('btnLoader');

    form.addEventListener('submit', function(e) {
        // Validate password match
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('password_confirmation').value;
        
        if (password !== confirmPassword) {
            e.preventDefault();
            alert('Passwords do not match!');
            return;
        }

        // Show loading state
        submitBtn.disabled = true;
        btnText.textContent = 'Resetting...';
        btnIcon.classList.add('hidden');
        btnLoader.classList.remove('hidden');

        // Form akan submit secara normal
        // Jika ada error dari server, button akan di-enable kembali
    });

    // Jika ada error validation dari server, enable button kembali
    <?php if($errors->any()): ?>
    submitBtn.disabled = false;
    btnText.textContent = 'Reset Password';
    btnIcon.classList.remove('hidden');
    btnLoader.classList.add('hidden');
    <?php endif; ?>
});
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.auth', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Documents\TB-PWL-DATASPHERE\resources\views/auth/reset-password.blade.php ENDPATH**/ ?>