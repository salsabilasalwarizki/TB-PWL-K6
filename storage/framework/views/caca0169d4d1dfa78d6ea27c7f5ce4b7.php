
<?php $__env->startSection('title', 'User Management'); ?>
<?php $__env->startSection('page-title', 'User Management'); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-6">

    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h2 class="text-2xl font-bold text-ink-900 dark:text-white">Users</h2>
            <p class="text-sm text-ink-500 dark:text-ink-400 mt-1">Manage users, roles, and access control</p>
        </div>
        <div class="flex gap-2">
            <a href="<?php echo e(route('admin.users.export')); ?>" class="inline-flex items-center gap-2 px-4 py-2.5 text-sm font-medium text-ink-700 dark:text-ink-300 bg-white dark:bg-ink-800 border border-ink-300 dark:border-ink-600 rounded-lg hover:bg-ink-50 dark:hover:bg-ink-700 transition-all">
                <i class="bi bi-download"></i>
                <span>Export CSV</span>
            </a>
            <a href="<?php echo e(route('admin.users.create')); ?>" class="inline-flex items-center gap-2 px-4 py-2.5 text-sm font-medium text-white bg-gradient-to-r from-brand-600 to-sphere-600 rounded-lg hover:shadow-lg hover:shadow-brand-500/20 transition-all">
                <i class="bi bi-person-plus"></i>
                <span>Add User</span>
            </a>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4">
        <div class="bg-white dark:bg-ink-800 rounded-xl shadow-card border border-ink-200 dark:border-ink-700 p-5 hover:-translate-y-0.5 hover:shadow-elev transition-all duration-300">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center">
                    <i class="bi bi-people text-xl text-blue-600 dark:text-blue-400"></i>
                </div>
                <div>
                    <p class="text-xs text-ink-500 dark:text-ink-400 mb-1">Total</p>
                    <p class="text-2xl font-bold text-ink-900 dark:text-white"><?php echo e($stats['total'] ?? 0); ?></p>
                </div>
            </div>
        </div>
        <div class="bg-white dark:bg-ink-800 rounded-xl shadow-card border border-ink-200 dark:border-ink-700 p-5 hover:-translate-y-0.5 hover:shadow-elev transition-all duration-300">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-green-100 dark:bg-green-900/30 flex items-center justify-center">
                    <i class="bi bi-check-circle text-xl text-green-600 dark:text-green-400"></i>
                </div>
                <div>
                    <p class="text-xs text-ink-500 dark:text-ink-400 mb-1">Active</p>
                    <p class="text-2xl font-bold text-ink-900 dark:text-white"><?php echo e($stats['active'] ?? 0); ?></p>
                </div>
            </div>
        </div>
        <div class="bg-white dark:bg-ink-800 rounded-xl shadow-card border border-ink-200 dark:border-ink-700 p-5 hover:-translate-y-0.5 hover:shadow-elev transition-all duration-300">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-red-100 dark:bg-red-900/30 flex items-center justify-center">
                    <i class="bi bi-x-circle text-xl text-red-600 dark:text-red-400"></i>
                </div>
                <div>
                    <p class="text-xs text-ink-500 dark:text-ink-400 mb-1">Inactive</p>
                    <p class="text-2xl font-bold text-ink-900 dark:text-white"><?php echo e($stats['inactive'] ?? 0); ?></p>
                </div>
            </div>
        </div>
        <div class="bg-white dark:bg-ink-800 rounded-xl shadow-card border border-ink-200 dark:border-ink-700 p-5 hover:-translate-y-0.5 hover:shadow-elev transition-all duration-300">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-amber-100 dark:bg-amber-900/30 flex items-center justify-center">
                    <i class="bi bi-clock-history text-xl text-amber-600 dark:text-amber-400"></i>
                </div>
                <div>
                    <p class="text-xs text-ink-500 dark:text-ink-400 mb-1">Unverified</p>
                    <p class="text-2xl font-bold text-ink-900 dark:text-white"><?php echo e($stats['unverified'] ?? 0); ?></p>
                </div>
            </div>
        </div>
        <div class="bg-white dark:bg-ink-800 rounded-xl shadow-card border border-ink-200 dark:border-ink-700 p-5 hover:-translate-y-0.5 hover:shadow-elev transition-all duration-300">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-cyan-100 dark:bg-cyan-900/30 flex items-center justify-center">
                    <i class="bi bi-shield-lock text-xl text-cyan-600 dark:text-cyan-400"></i>
                </div>
                <div>
                    <p class="text-xs text-ink-500 dark:text-ink-400 mb-1">Admins</p>
                    <p class="text-2xl font-bold text-ink-900 dark:text-white"><?php echo e($stats['admins'] ?? 0); ?></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts (Only if data exists) -->
    <?php if(isset($registrationData) && $registrationData->isNotEmpty()): ?>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 bg-white dark:bg-ink-800 rounded-xl shadow-card border border-ink-200 dark:border-ink-700 overflow-hidden">
            <div class="px-6 py-4 border-b border-ink-200 dark:border-ink-700">
                <h3 class="text-lg font-semibold text-ink-900 dark:text-white flex items-center gap-2">
                    <i class="bi bi-graph-up text-brand-600"></i>
                    User Registration Trend
                </h3>
            </div>
            <div class="p-6">
                <canvas id="registrationChart" height="80"></canvas>
            </div>
        </div>
        <div class="bg-white dark:bg-ink-800 rounded-xl shadow-card border border-ink-200 dark:border-ink-700 overflow-hidden">
            <div class="px-6 py-4 border-b border-ink-200 dark:border-ink-700">
                <h3 class="text-lg font-semibold text-ink-900 dark:text-white flex items-center gap-2">
                    <i class="bi bi-pie-chart text-brand-600"></i>
                    Role Distribution
                </h3>
            </div>
            <div class="p-6 flex items-center justify-center">
                <canvas id="roleChart"></canvas>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <!-- Filters -->
    <div class="bg-white dark:bg-ink-800 rounded-xl shadow-card border border-ink-200 dark:border-ink-700 p-5">
        <form method="GET" class="grid grid-cols-1 sm:grid-cols-4 gap-4">
            <div>
                <div class="relative">
                    <i class="bi bi-search absolute left-3 top-1/2 -translate-y-1/2 text-ink-400"></i>
                    <input type="text" name="search" class="w-full pl-10 pr-4 py-2.5 rounded-lg bg-ink-50 dark:bg-ink-700/50 border border-ink-200 dark:border-ink-600 text-sm text-ink-900 dark:text-white placeholder-ink-400 focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 transition-all"
                           placeholder="Search users..." value="<?php echo e(request('search')); ?>">
                </div>
            </div>
            <div>
                <select name="role" class="w-full px-4 py-2.5 rounded-lg bg-ink-50 dark:bg-ink-700/50 border border-ink-200 dark:border-ink-600 text-sm text-ink-900 dark:text-white focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 transition-all appearance-none cursor-pointer">
                    <option value="">All Roles</option>
                    <option value="user" <?php echo e(request('role')=='user'?'selected':''); ?>>User</option>
                    <option value="contributor" <?php echo e(request('role')=='contributor'?'selected':''); ?>>Contributor</option>
                    <option value="admin" <?php echo e(request('role')=='admin'?'selected':''); ?>>Admin</option>
                    <option value="superadmin" <?php echo e(request('role')=='superadmin'?'selected':''); ?>>Super Admin</option>
                </select>
            </div>
            <div>
                <select name="status" class="w-full px-4 py-2.5 rounded-lg bg-ink-50 dark:bg-ink-700/50 border border-ink-200 dark:border-ink-600 text-sm text-ink-900 dark:text-white focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 transition-all appearance-none cursor-pointer">
                    <option value="">All Status</option>
                    <option value="active" <?php echo e(request('status')=='active'?'selected':''); ?>>Active</option>
                    <option value="inactive" <?php echo e(request('status')=='inactive'?'selected':''); ?>>Inactive</option>
                    <option value="unverified" <?php echo e(request('status')=='unverified'?'selected':''); ?>>Unverified</option>
                </select>
            </div>
            <div>
                <button type="submit" class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-medium text-white bg-gradient-to-r from-brand-600 to-sphere-600 rounded-lg hover:shadow-lg hover:shadow-brand-500/20 transition-all">
                    <i class="bi bi-funnel"></i>
                    <span>Filter</span>
                </button>
            </div>
        </form>
    </div>

    <!-- Table -->
    <div class="bg-white dark:bg-ink-800 rounded-xl shadow-card border border-ink-200 dark:border-ink-700 overflow-hidden">
        <form method="POST" action="<?php echo e(route('admin.users.bulk-action')); ?>">
            <?php echo csrf_field(); ?>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-ink-50 dark:bg-ink-900/50">
                        <tr>
                            <th class="px-4 py-3 text-left w-10">
                                <input type="checkbox" id="selectAll" class="w-4 h-4 rounded border-ink-300 dark:border-ink-600 text-brand-600 focus:ring-brand-500">
                            </th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-ink-600 dark:text-ink-400 uppercase tracking-wider">User</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-ink-600 dark:text-ink-400 uppercase tracking-wider">Role</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-ink-600 dark:text-ink-400 uppercase tracking-wider">Datasets</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-ink-600 dark:text-ink-400 uppercase tracking-wider">Status</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-ink-600 dark:text-ink-400 uppercase tracking-wider">Joined</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-ink-600 dark:text-ink-400 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-ink-200 dark:divide-ink-700">
                        <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="hover:bg-ink-50 dark:hover:bg-ink-900/50 transition-colors duration-200">
                            <td class="px-4 py-3">
                                <?php if($user->id !== auth()->id()): ?>
                                <input type="checkbox" name="user_ids[]" value="<?php echo e($user->id); ?>" class="w-4 h-4 rounded border-ink-300 dark:border-ink-600 text-brand-600 focus:ring-brand-500">
                                <?php endif; ?>
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-full bg-gradient-to-br from-brand-500 to-sphere-500 flex items-center justify-center text-white text-xs font-bold flex-shrink-0">
                                        <?php echo e(strtoupper(substr($user->name, 0, 1))); ?>

                                    </div>
                                    <div class="min-w-0">
                                        <a href="<?php echo e(route('admin.users.edit', $user)); ?>" class="text-sm font-semibold text-ink-900 dark:text-white hover:text-brand-600 dark:hover:text-brand-400 truncate block transition-colors">
                                            <?php echo e($user->name); ?>

                                        </a>
                                        <p class="text-xs text-ink-500 dark:text-ink-400 truncate"><?php echo e($user->email); ?></p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-3">
                                <span class="inline-flex px-2.5 py-1 text-xs font-medium rounded-full
                                    <?php echo e($user->role === 'superadmin' ? 'bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-400' : ''); ?>

                                    <?php echo e($user->role === 'admin' ? 'bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400' : ''); ?>

                                    <?php echo e($user->role === 'contributor' ? 'bg-cyan-100 dark:bg-cyan-900/30 text-cyan-700 dark:text-cyan-400' : ''); ?>

                                    <?php echo e($user->role === 'user' ? 'bg-ink-100 dark:bg-ink-700 text-ink-600 dark:text-ink-400' : ''); ?>

                                ">
                                    <?php echo e(ucfirst($user->role)); ?>

                                </span>
                            </td>
                            <td class="px-4 py-3">
                                <span class="text-sm text-ink-600 dark:text-ink-400"><?php echo e($user->datasets_count ?? 0); ?></span>
                            </td>
                            <td class="px-4 py-3">
                                <?php if($user->is_active): ?>
                                    <?php if($user->email_verified_at): ?>
                                    <span class="inline-flex px-2.5 py-1 text-xs font-medium rounded-full bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400">
                                        Active
                                    </span>
                                    <?php else: ?>
                                    <span class="inline-flex px-2.5 py-1 text-xs font-medium rounded-full bg-amber-100 dark:bg-amber-900/30 text-amber-700 dark:text-amber-400">
                                        Unverified
                                    </span>
                                    <?php endif; ?>
                                <?php else: ?>
                                <span class="inline-flex px-2.5 py-1 text-xs font-medium rounded-full bg-ink-100 dark:bg-ink-700 text-ink-600 dark:text-ink-400">
                                    Inactive
                                </span>
                                <?php endif; ?>
                            </td>
                            <td class="px-4 py-3">
                                <span class="text-sm text-ink-500 dark:text-ink-400"><?php echo e($user->created_at?->format('M d, Y') ?? 'N/A'); ?></span>
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-1">
                                    <a href="<?php echo e(route('admin.users.edit', $user)); ?>" class="p-2 text-ink-500 dark:text-ink-400 hover:text-blue-600 dark:hover:text-blue-400 hover:bg-ink-100 dark:hover:bg-ink-700 rounded-lg transition-all duration-200" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <?php if($user->id !== auth()->id()): ?>
                                    <button type="button"
                                            class="p-2 text-ink-500 dark:text-ink-400 hover:text-<?php echo e($user->is_active ? 'amber' : 'green'); ?>-600 dark:hover:text-<?php echo e($user->is_active ? 'amber' : 'green'); ?>-400 hover:bg-ink-100 dark:hover:bg-ink-700 rounded-lg transition-all duration-200"
                                            title="<?php echo e($user->is_active ? 'Deactivate' : 'Activate'); ?>"
                                            onclick="toggleActive(<?php echo e($user->id); ?>)">
                                        <i class="bi bi-<?php echo e($user->is_active ? 'pause' : 'play'); ?>"></i>
                                    </button>
                                    <?php endif; ?>
                                    <button type="button" onclick="confirmDelete('<?php echo e(route('admin.users.destroy', $user)); ?>')"
                                            class="p-2 text-ink-500 dark:text-ink-400 hover:text-red-600 dark:hover:text-red-400 hover:bg-ink-100 dark:hover:bg-ink-700 rounded-lg transition-all duration-200" title="Delete">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="7" class="px-4 py-12 text-center">
                                <i class="bi bi-people text-5xl text-ink-300 dark:text-ink-600 mb-3"></i>
                                <p class="text-ink-500 dark:text-ink-400">No users found.</p>
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <?php if($users->count()): ?>
            <div class="px-4 py-3 bg-ink-50 dark:bg-ink-900/50 border-t border-ink-200 dark:border-ink-700 flex flex-col sm:flex-row justify-between items-center gap-3">
                <div class="flex items-center gap-3">
                    <select name="action" class="px-3 py-2 rounded-lg bg-white dark:bg-ink-700 border border-ink-200 dark:border-ink-600 text-sm text-ink-700 dark:text-ink-300 focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 transition-all appearance-none cursor-pointer" style="min-width: 180px;">
                        <option value="">Bulk Actions...</option>
                        <option value="activate">Activate Selected</option>
                        <option value="deactivate">Deactivate Selected</option>
                        <option value="demote">Demote to User</option>
                        <option value="delete">Delete Selected</option>
                    </select>
                    <button type="submit" class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-brand-600 to-sphere-600 text-white text-sm font-medium rounded-lg hover:shadow-lg hover:shadow-brand-500/20 transition-all" onclick="return confirm('Apply bulk action to selected users?')">
                        Apply
                    </button>
                </div>
                <?php echo e($users->withQueryString()->links()); ?>

            </div>
            <?php endif; ?>
        </form>
    </div>

    <form id="deleteForm" method="POST" class="hidden">
        <?php echo csrf_field(); ?>
        <?php echo method_field('DELETE'); ?>
    </form>
</div>

<?php $__env->startPush('scripts'); ?>
<?php if(isset($registrationData) && $registrationData->isNotEmpty()): ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Registration Trend Chart
const regCtx = document.getElementById('registrationChart')?.getContext('2d');
if (regCtx) {
    new Chart(regCtx, {
        type: 'line',
        data: {
            labels: <?php echo json_encode($registrationData->pluck('month')); ?>,
            datasets: [{
                label: 'New Users',
                data: <?php echo json_encode($registrationData->pluck('count')); ?>,
                borderColor: '#10b981',
                backgroundColor: 'rgba(16, 185, 129, 0.1)',
                fill: true,
                tension: 0.4,
                pointBackgroundColor: '#10b981',
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
                pointRadius: 4,
                pointHoverRadius: 6
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: 'rgba(0,0,0,0.8)',
                    padding: 12,
                    titleFont: { size: 13 },
                    bodyFont: { size: 12 }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { stepSize: 1, precision: 0 },
                    grid: { color: 'rgba(0,0,0,0.05)' }
                },
                x: {
                    grid: { display: false }
                }
            }
        }
    });
}

// Role Distribution Chart
const roleCtx = document.getElementById('roleChart')?.getContext('2d');
if (roleCtx && <?php echo json_encode($roleData->isNotEmpty()); ?>) {
    new Chart(roleCtx, {
        type: 'doughnut',
        data: {
            labels: <?php echo json_encode($roleData->pluck('role')); ?>,
            datasets: [{
                data: <?php echo json_encode($roleData->pluck('count')); ?>,
                backgroundColor: ['#64748b', '#06b6d4', '#3b82f6', '#ef4444'],
                borderWidth: 2,
                borderColor: '#fff'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: { padding: 15, font: { size: 12 } }
                }
            }
        }
    });
}
</script>
<?php endif; ?>

<script>
// Select all checkbox
document.getElementById('selectAll')?.addEventListener('change', function() {
    document.querySelectorAll('input[name="user_ids[]"]').forEach(cb => {
        if (!cb.disabled) cb.checked = this.checked;
    });
});

// Toggle active/inactive
function toggleActive(userId) {
    fetch(`/admin/users/${userId}/toggle-active`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
        },
        body: JSON.stringify({})
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        } else {
            alert(data.error || 'Failed to update user status');
        }
    })
    .catch(err => {
        console.error('Error:', err);
        alert('Failed to connect to server');
    });
}

// Confirm delete
function confirmDelete(url) {
    if (confirm('Are you sure you want to delete this user?')) {
        document.getElementById('deleteForm').action = url;
        document.getElementById('deleteForm').submit();
    }
}
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Documents\TB-PWL-DATASPHERE\resources\views/admin/users/index.blade.php ENDPATH**/ ?>