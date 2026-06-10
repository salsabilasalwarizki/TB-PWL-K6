@extends('layouts.auth')
@section('title', 'Confirm Password - DataSphere ML Repository')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 via-brand-50/30 to-sphere-secondary/10 dark:from-gray-900 dark:via-gray-900 dark:to-gray-900 flex items-center justify-center px-4 sm:px-6 lg:px-8">
   
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-20 left-10 w-72 h-72 bg-brand-500/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-20 right-10 w-96 h-96 bg-sphere-secondary/10 rounded-full blur-3xl"></div>
    </div>
    
    <div class="relative w-full max-w-md">
       
        <div class="text-center mb-8">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-2 mb-6">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-brand-500 to-sphere-secondary flex items-center justify-center">
                    <i class="bi bi-globe2 text-white text-lg"></i>
                </div>
                <span class="text-xl font-bold text-gray-900 dark:text-white">DataSphere</span>
            </a>
        </div>
       
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 overflow-hidden">
           
            <div class="bg-gradient-to-r from-brand-600 to-sphere-secondary p-6 md:p-8">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-xl bg-white/20 backdrop-blur-sm flex items-center justify-center">
                        <i class="bi bi-shield-lock text-2xl text-white"></i>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-white">Confirm Password</h2>
                        <p class="text-white/80 text-sm mt-1">Secure area verification</p>
                    </div>
                </div>
            </div>
           
            <div class="p-6 md:p-8">
                <p class="text-sm text-gray-600 dark:text-gray-400 mb-6">
                    This is a secure area of the application. Please confirm your password before continuing.
                </p>
                
                <form method="POST" action="{{ route('password.confirm') }}">
                    @csrf
                   
                    <div class="mb-6">
                        <label for="password" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            <i class="bi bi-lock me-1 text-brand-500"></i>Password
                        </label>
                        <div class="relative">
                            <input type="password" 
                                   id="password" 
                                   name="password" 
                                   required 
                                   autofocus
                                   autocomplete="current-password"
                                   class="w-full px-4 py-3 rounded-xl bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 transition-all @error('password') border-red-500 focus:border-red-500 focus:ring-red-500/20 @enderror">
                            <button type="button" 
                                    onclick="togglePassword()" 
                                    class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition-colors">
                                <i class="bi bi-eye" id="toggleIcon"></i>
                            </button>
                        </div>
                        @error('password')
                            <p class="mt-2 text-xs text-red-500 flex items-center gap-1">
                                <i class="bi bi-exclamation-circle"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>
                  
                    <button type="submit" 
                            class="w-full inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl bg-gradient-to-r from-brand-600 to-sphere-secondary text-white font-bold shadow-lg hover:shadow-xl hover:shadow-brand-500/30 hover:-translate-y-0.5 transition-all">
                        <i class="bi bi-shield-check"></i>
                        <span>CONFIRM PASSWORD</span>
                    </button>
                </form>
            </div>
           
            <div class="px-6 md:px-8 pb-6 md:pb-8">
                <div class="text-center">
                    <a href="{{ route('home') }}" class="text-sm text-gray-500 dark:text-gray-400 hover:text-brand-600 dark:hover:text-brand-400 transition-colors">
                        <i class="bi bi-arrow-left me-1"></i>Back to Home
                    </a>
                </div>
            </div>
        </div>
      
        <div class="text-center mt-6">
            <p class="text-xs text-gray-500 dark:text-gray-500">
                &copy; {{ date('Y') }} DataSphere ML Repository. All rights reserved.
            </p>
        </div>
    </div>
</div>

@push('scripts')
<script>
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
@endpush
@endsection
