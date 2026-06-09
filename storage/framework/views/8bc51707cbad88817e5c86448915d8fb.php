<?php $__env->startSection('title', 'Verify Email'); ?>

<?php $__env->startSection('content'); ?>
<div class="min-h-screen bg-gray-50 dark:bg-gray-900 flex items-center justify-center px-4 py-12">
    <div class="max-w-md w-full">
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-8">
            <div class="text-center">
                <div class="w-16 h-16 bg-blue-100 dark:bg-blue-900/30 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="bi bi-envelope text-3xl text-blue-600 dark:text-blue-400"></i>
                </div>
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">
                    Verify Your Email
                </h2>
                <p class="text-gray-600 dark:text-gray-400 mb-6">
                    We've sent a verification link to <strong><?php echo e(auth()->user()->email); ?></strong>
                </p>
                
                <?php if(session('success')): ?>
                <div class="bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-800 text-green-800 dark:text-green-200 px-4 py-3 rounded-lg mb-4">
                    <?php echo e(session('success')); ?>

                </div>
                <?php endif; ?>
                
                <form method="POST" action="<?php echo e(route('verification.send')); ?>">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-6 py-3 rounded-lg font-semibold hover:shadow-lg transition-all">
                        <i class="bi bi-envelope-paper me-2"></i>
                        Resend Verification Email
                    </button>
                </form>
                
                <form method="POST" action="<?php echo e(route('logout')); ?>" class="mt-4">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white text-sm">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Documents\TB-PWL-DATASPHERE\resources\views/auth/verify-email.blade.php ENDPATH**/ ?>