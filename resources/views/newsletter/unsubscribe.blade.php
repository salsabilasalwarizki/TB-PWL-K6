@extends('layouts.app')
@section('title', 'Unsubscribed - DataSphere')

@section('content')
<div class="min-h-[calc(100vh-200px)] flex items-center justify-center px-4 py-12">
    <div class="max-w-md w-full">
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-100 dark:border-gray-700 p-8 text-center">
            <div class="w-20 h-20 mx-auto mb-4 rounded-full bg-amber-50 dark:bg-amber-900/30 flex items-center justify-center">
                <i class="bi bi-envelope-dash text-4xl text-amber-600 dark:text-amber-400"></i>
            </div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">You've Been Unsubscribed</h1>
            <p class="text-gray-600 dark:text-gray-400 mb-6">
                We're sorry to see you go! <strong class="text-gray-900 dark:text-white">{{ $email }}</strong> has been removed from our newsletter list.
            </p>
            <p class="text-sm text-gray-500 dark:text-gray-400 mb-6">
                You can always resubscribe anytime from our website footer.
            </p>
            <a href="{{ route('home') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-full bg-gradient-to-r from-brand-600 to-sphere-secondary text-white font-semibold hover:shadow-lg transition-all">
                <i class="bi bi-house"></i>
                <span>Back to Home</span>
            </a>
        </div>
    </div>
</div>
@endsection