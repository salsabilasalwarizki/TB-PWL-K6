@extends('layouts.auth')
@section('title', 'Forgot Password - DataSphere')

@section('content')
<div class="min-h-screen flex items-center justify-center px-4 py-12 bg-gradient-to-br from-gray-50 via-white to-brand-50/30 dark:from-gray-900 dark:via-gray-900 dark:to-brand-950/20">
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-20 left-10 w-72 h-72 bg-brand-500/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-20 right-10 w-96 h-96 bg-sphere-secondary/10 rounded-full blur-3xl"></div>
    </div>

    <div class="relative w-full max-w-md">
        <div class="text-center mb-8">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-3 group">
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

        <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl rounded-3xl shadow-2xl border border-gray-200/50 dark:border-gray-700/50 p-8">
            <div class="text-center mb-6">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-gradient-to-br from-brand-100 to-brand-200 dark:from-brand-900/30 dark:to-brand-800/30 mb-4">
                    <i class="bi bi-shield-lock text-3xl text-brand-600 dark:text-brand-400"></i>
                </div>
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">Forgot Password?</h2>
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    No worries! Enter your email and we'll send you a reset link.
                </p>
            </div>

            @if(session('status'))
            <div class="mb-6 bg-emerald-50 dark:bg-emerald-900/20 border border-emerald-200 dark:border-emerald-800 rounded-xl p-4 flex items-start gap-3">
                <div class="flex-shrink-0 w-8 h-8 rounded-lg bg-emerald-500 flex items-center justify-center">
                    <i class="bi bi-check-lg text-white"></i>
                </div>
                <div class="flex-1">
                    <p class="text-sm font-semibold text-emerald-900 dark:text-emerald-200 mb-0.5">Success!</p>
                    <p class="text-xs text-emerald-800 dark:text-emerald-300">{{ session('status') }}</p>
                </div>
            </div>
            @endif

            <form id="forgotPasswordForm" method="POST" action="{{ route('password.email') }}" class="space-y-4">
                @csrf
               
                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                        <i class="bi bi-envelope me-1 text-gray-400"></i>
                        Email Address
                    </label>
                    <input type="email" 
                           id="email" 
                           name="email" 
                           value="{{ old('email') }}" 
                           required 
                           autofocus
                           autocomplete="email"
                           placeholder="Enter your email address"
                           class="w-full px-4 py-3 rounded-xl bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 transition-all @error('email') border-red-500 @enderror">
                    @error('email')
                    <p class="mt-2 text-xs text-red-500 flex items-center gap-1">
                        <i class="bi bi-exclamation-circle"></i>
                        {{ $message }}
                    </p>
                    @enderror
                </div>

                <button type="submit" 
                        id="submitBtn"
                        class="w-full inline-flex items-center justify-center gap-2 px-6 py-3.5 bg-gradient-to-r from-brand-600 to-sphere-secondary text-white font-semibold rounded-xl shadow-lg shadow-brand-500/30 hover:shadow-xl hover:shadow-brand-500/40 hover:-translate-y-0.5 transition-all duration-300">
                    <i class="bi bi-send"></i>
                    <span id="btnText">Send Reset Link</span>
                    <svg id="btnLoader" class="hidden animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </button>
            </form>

            <div class="relative my-6">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-gray-200 dark:border-gray-700"></div>
                </div>
                <div class="relative flex justify-center">
                    <span class="px-3 text-xs text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800">or</span>
                </div>
            </div>

            <div class="text-center">
                <a href="{{ route('login') }}" 
                   class="inline-flex items-center gap-2 text-sm font-semibold text-brand-600 dark:text-brand-400 hover:text-brand-700 dark:hover:text-brand-300 transition-colors group">
                    <i class="bi bi-arrow-left group-hover:-translate-x-1 transition-transform"></i>
                    <span>Back to Sign In</span>
                </a>
            </div>
        </div>

        <div class="mt-8 text-center">
            <p class="text-xs text-gray-400 dark:text-gray-500">
                © {{ date('Y') }} <span class="font-semibold">DataSphere</span> ML Repository
            </p>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('forgotPasswordForm');
    const submitBtn = document.getElementById('submitBtn');
    const btnText = document.getElementById('btnText');
    const btnLoader = document.getElementById('btnLoader');

    form.addEventListener('submit', function(e) {
        submitBtn.disabled = true;
        btnText.textContent = 'Sending...';
        btnLoader.classList.remove('hidden');
    });

    @if($errors->any())
    submitBtn.disabled = false;
    btnText.textContent = 'Send Reset Link';
    btnLoader.classList.add('hidden');
    @endif
});
</script>
@endpush
@endsection