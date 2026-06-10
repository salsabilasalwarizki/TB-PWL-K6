@extends('layouts.admin')
@section('title', 'Edit User')
@section('page-title', 'Edit User')

@section('content')
<div class="min-h-screen bg-ink-50 dark:bg-ink-950 bg-grid py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
       
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6">
            <div>
                <h2 class="text-3xl font-bold text-ink-900 dark:text-white">
                    <i class="bi bi-person-gear me-2"></i>Edit User
                </h2>
                <p class="text-ink-600 dark:text-ink-400 mt-1">Update user information and permissions</p>
            </div>
            <a href="{{ route('admin.users.index') }}" class="mt-4 sm:mt-0 inline-flex items-center gap-2 px-4 py-2.5 bg-white dark:bg-ink-800 border border-ink-300 dark:border-ink-600 rounded-lg hover:bg-ink-50 dark:hover:bg-ink-700 transition-colors">
                <i class="bi bi-arrow-left"></i>
                <span>Back to List</span>
            </a>
        </div>

        <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-xl p-4 mb-6">
            <div class="flex items-start gap-3">
                <div class="flex-shrink-0 w-10 h-10 rounded-lg bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center">
                    <i class="bi bi-info-circle text-xl text-blue-600 dark:text-blue-400"></i>
                </div>
                <div class="flex-1">
                    <h3 class="text-sm font-bold text-blue-900 dark:text-blue-200 mb-2">Account Information</h3>
                    <div class="space-y-1 text-sm">
                        <div class="flex items-center gap-2">
                            <span class="text-blue-800 dark:text-blue-200">Created:</span>
                            <span class="text-blue-800 dark:text-blue-200">{{ $user->created_at->format('M d, Y') }}</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="text-blue-800 dark:text-blue-200">Status:</span>
                            @if($user->is_active)
                                <span class="inline-flex px-2 py-0.5 text-xs font-medium rounded-full bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400">Active</span>
                            @else
                                <span class="inline-flex px-2 py-0.5 text-xs font-medium rounded-full bg-ink-100 dark:bg-ink-700 text-ink-600 dark:text-ink-400">Inactive</span>
                            @endif
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="text-blue-800 dark:text-blue-200">Datasets:</span>
                            <span class="text-blue-800 dark:text-blue-200">{{ $user->datasets_count ?? 0 }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <form id="editUserForm" action="{{ route('admin.users.update', $user) }}" method="POST">
            @csrf
            @method('PUT')
           
            <div class="bg-white dark:bg-ink-900 rounded-xl shadow-card mb-6">
                <div class="p-6 border-b border-ink-200 dark:border-ink-800">
                    <h3 class="text-lg font-bold text-ink-900 dark:text-white flex items-center gap-2">
                        <i class="bi bi-person text-blue-500"></i>
                        Basic Information
                    </h3>
                </div>
                <div class="p-6 space-y-5">
                 
                    <div>
                        <label for="name" class="block text-sm font-semibold text-ink-700 dark:text-ink-300 mb-2">
                            Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               id="name" 
                               name="name" 
                               value="{{ old('name', $user->name) }}" 
                               required 
                               autofocus
                               placeholder="Enter user name"
                               class="w-full px-4 py-3 rounded-lg bg-ink-50 dark:bg-ink-800/50 border border-ink-200 dark:border-ink-600 text-ink-900 dark:text-white placeholder-ink-400 focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 transition-all @error('name') border-red-500 focus:border-red-500 focus:ring-red-500/20 @enderror">
                        @error('name')
                        <p class="mt-2 text-xs text-red-500 flex items-center gap-1">
                            <i class="bi bi-exclamation-circle"></i>{{ $message }}
                        </p>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-semibold text-ink-700 dark:text-ink-300 mb-2">
                            Email <span class="text-red-500">*</span>
                        </label>
                        <input type="email" 
                               id="email" 
                               name="email" 
                               value="{{ old('email', $user->email) }}" 
                               required
                               placeholder="user@example.com"
                               class="w-full px-4 py-3 rounded-lg bg-ink-50 dark:bg-ink-800/50 border border-ink-200 dark:border-ink-600 text-ink-900 dark:text-white placeholder-ink-400 focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 transition-all @error('email') border-red-500 focus:border-red-500 focus:ring-red-500/20 @enderror">
                        @error('email')
                        <p class="mt-2 text-xs text-red-500 flex items-center gap-1">
                            <i class="bi bi-exclamation-circle"></i>{{ $message }}
                        </p>
                        @enderror
                    </div>

                    <div>
                        <label for="role" class="block text-sm font-semibold text-ink-700 dark:text-ink-300 mb-2">
                            Role <span class="text-red-500">*</span>
                        </label>
                        <select id="role" 
                                name="role" 
                                required
                                class="w-full px-4 py-3 rounded-lg bg-ink-50 dark:bg-ink-800/50 border border-ink-200 dark:border-ink-600 text-ink-900 dark:text-white focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 transition-all appearance-none cursor-pointer @error('role') border-red-500 focus:border-red-500 focus:ring-red-500/20 @enderror">
                            <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>User</option>
                            <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="superadmin" {{ old('role', $user->role) == 'superadmin' ? 'selected' : '' }}>Super Admin</option>
                        </select>
                        @error('role')
                        <p class="mt-2 text-xs text-red-500 flex items-center gap-1">
                            <i class="bi bi-exclamation-circle"></i>{{ $message }}
                        </p>
                        @enderror
                        <div class="mt-3 space-y-1">
                            <div class="flex items-start gap-2 text-xs text-ink-600 dark:text-ink-400">
                                <span class="inline-flex px-2 py-0.5 text-xs font-medium rounded-full bg-ink-100 dark:bg-ink-700 text-ink-600 dark:text-ink-400">User</span>
                                <span>Regular user with basic access</span>
                            </div>
                            <div class="flex items-start gap-2 text-xs text-ink-600 dark:text-ink-400">
                                <span class="inline-flex px-2 py-0.5 text-xs font-medium rounded-full bg-cyan-100 dark:bg-cyan-900/30 text-cyan-700 dark:text-cyan-400">Contributor</span>
                                <span>Can contribute datasets</span>
                            </div>
                            <div class="flex items-start gap-2 text-xs text-ink-600 dark:text-ink-400">
                                <span class="inline-flex px-2 py-0.5 text-xs font-medium rounded-full bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400">Admin</span>
                                <span>Can manage users and datasets</span>
                            </div>
                            <div class="flex items-start gap-2 text-xs text-ink-600 dark:text-ink-400">
                                <span class="inline-flex px-2 py-0.5 text-xs font-medium rounded-full bg-purple-100 dark:bg-purple-900/30 text-purple-700 dark:text-purple-400">Super Admin</span>
                                <span>Full system access</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-ink-900 rounded-xl shadow-card mb-6">
                <div class="p-6 border-b border-ink-200 dark:border-ink-800">
                    <h3 class="text-lg font-bold text-ink-900 dark:text-white flex items-center gap-2">
                        <i class="bi bi-shield-lock text-blue-500"></i>
                        Password
                    </h3>
                    <p class="text-sm text-ink-500 dark:text-ink-400 mt-1">Leave blank to keep current password</p>
                </div>
                <div class="p-6 space-y-5">
                
                    <div>
                        <label for="password" class="block text-sm font-semibold text-ink-700 dark:text-ink-300 mb-2">
                            New Password <span class="text-muted">(leave blank to keep current)</span>
                        </label>
                        <input type="password" 
                               id="password" 
                               name="password"
                               placeholder="Enter new password (optional)"
                               class="w-full px-4 py-3 rounded-lg bg-ink-50 dark:bg-ink-800/50 border border-ink-200 dark:border-ink-600 text-ink-900 dark:text-white placeholder-ink-400 focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 transition-all @error('password') border-red-500 focus:border-red-500 focus:ring-red-500/20 @enderror">
                        @error('password')
                        <p class="mt-2 text-xs text-red-500 flex items-center gap-1">
                            <i class="bi bi-exclamation-circle"></i>{{ $message }}
                        </p>
                        @enderror
                        <p class="mt-2 text-xs text-ink-500 dark:text-ink-400">Minimum 8 characters</p>
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-semibold text-ink-700 dark:text-ink-300 mb-2">
                            Confirm New Password
                        </label>
                        <input type="password" 
                               id="password_confirmation" 
                               name="password_confirmation"
                               placeholder="Confirm new password"
                               class="w-full px-4 py-3 rounded-lg bg-ink-50 dark:bg-ink-800/50 border border-ink-200 dark:border-ink-600 text-ink-900 dark:text-white placeholder-ink-400 focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 transition-all">
                        <p class="mt-2 text-xs text-ink-500 dark:text-ink-400">Re-enter the new password to confirm</p>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-ink-900 rounded-xl shadow-card p-6 flex flex-col sm:flex-row justify-end gap-3">
                <a href="{{ route('admin.users.index') }}" class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-white dark:bg-ink-800 border border-ink-300 dark:border-ink-600 rounded-lg hover:bg-ink-50 dark:hover:bg-ink-700 transition-colors">
                    <i class="bi bi-x-circle"></i>
                    <span>Cancel</span>
                </a>
                <button type="submit" 
                        id="submitBtn"
                        class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-gradient-to-r from-brand-600 to-sphere-600 text-white rounded-lg hover:shadow-lg hover:shadow-brand-500/30 transition-all">
                    <i class="bi bi-check-circle"></i>
                    <span>Update User</span>
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('editUserForm');
    const btn = document.getElementById('submitBtn');
    
    if (!form || !btn) return;
    
    const hasErrors = {{ $errors->any() ? 'true' : 'false' }};
    
    if (hasErrors) {
        btn.disabled = false;
        btn.innerHTML = '<i class="bi bi-check-circle"></i><span>Update User</span>';
    }
    
    form.addEventListener('submit', function(e) {
        btn.disabled = true;
        btn.innerHTML = `
            <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            <span>Updating...</span>
        `;
    });
});
</script>
@endpush
@endsection