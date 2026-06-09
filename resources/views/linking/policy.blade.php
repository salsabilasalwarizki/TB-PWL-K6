@extends('layouts.app')
@section('title', 'Linking Policy - DataSphere ML Repository')
@section('meta_desc', 'Linking policy for external datasets in DataSphere ML Repository')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 via-brand-50/30 to-sphere-secondary/10 dark:from-gray-900 dark:via-gray-900 dark:to-gray-900 py-8 md:py-12 px-4 sm:px-6 lg:px-8">
    
    <!-- Background Decoration -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-20 left-10 w-72 h-72 bg-brand-500/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-20 right-10 w-96 h-96 bg-sphere-secondary/10 rounded-full blur-3xl"></div>
    </div>
    
    <div class="relative max-w-4xl mx-auto">
        
        <!-- Breadcrumb -->
        <nav class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-400 mb-6">
            <a href="{{ route('home') }}" class="hover:text-brand-600 dark:hover:text-brand-400 transition-colors">Home</a>
            <i class="bi bi-chevron-right text-xs"></i>
            <span class="text-brand-600 dark:text-brand-400 font-semibold">Linking Policy</span>
        </nav>
        
        <!-- Header Card -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 overflow-hidden mb-6">
            <div class="bg-gradient-to-r from-brand-600 to-sphere-secondary p-8 md:p-10">
                <div class="flex items-center gap-4">
                    <div class="w-14 h-14 rounded-xl bg-white/20 backdrop-blur-sm flex items-center justify-center">
                        <i class="bi bi-link-45deg text-3xl text-white"></i>
                    </div>
                    <div>
                        <h1 class="text-3xl md:text-4xl font-bold text-white">
                            Linking Policy
                        </h1>
                        <p class="text-white/90 text-sm md:text-base mt-1">
                            Read before linking an external dataset
                        </p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Policy Content Card -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 overflow-hidden mb-6">
            <div class="bg-gradient-to-r from-amber-50 to-orange-50 dark:from-gray-800 dark:to-gray-800 border-b border-gray-200 dark:border-gray-700 p-5 md:p-6">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-lg bg-amber-100 dark:bg-amber-900/30 flex items-center justify-center">
                        <i class="bi bi-exclamation-triangle text-xl text-amber-600 dark:text-amber-400"></i>
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-gray-900 dark:text-white">Important Information</h2>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Please read carefully before proceeding</p>
                    </div>
                </div>
            </div>
            
            <div class="p-5 md:p-8">
                <!-- Policy Rules -->
                <div class="space-y-4 mb-8">
                    <div class="flex items-start gap-4 p-4 rounded-xl bg-gradient-to-r from-amber-50/50 to-orange-50/50 dark:from-amber-900/10 dark:to-orange-900/10 border border-amber-200/50 dark:border-amber-800/30">
                        <div class="flex-shrink-0 w-8 h-8 rounded-full bg-amber-100 dark:bg-amber-900/30 flex items-center justify-center flex-shrink-0">
                            <span class="text-sm font-bold text-amber-600 dark:text-amber-400">1</span>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm text-gray-700 dark:text-gray-300 leading-relaxed">
                                The dataset must be <strong class="text-gray-900 dark:text-white">widely known and high quality</strong> for it to be accepted.
                            </p>
                        </div>
                    </div>
                    
                    <div class="flex items-start gap-4 p-4 rounded-xl bg-gradient-to-r from-amber-50/50 to-orange-50/50 dark:from-amber-900/10 dark:to-orange-900/10 border border-amber-200/50 dark:border-amber-800/30">
                        <div class="flex-shrink-0 w-8 h-8 rounded-full bg-amber-100 dark:bg-amber-900/30 flex items-center justify-center flex-shrink-0">
                            <span class="text-sm font-bold text-amber-600 dark:text-amber-400">2</span>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm text-gray-700 dark:text-gray-300 leading-relaxed">
                                The <strong class="text-gray-900 dark:text-white">download link should be visible</strong> on the linked page.
                            </p>
                        </div>
                    </div>
                </div>
                
                <!-- Contact Info -->
                <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-xl p-4 flex items-start gap-3 mb-8">
                    <div class="flex-shrink-0 w-8 h-8 rounded-lg bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center">
                        <i class="bi bi-envelope text-lg text-blue-600 dark:text-blue-400"></i>
                    </div>
                    <div class="flex-1 text-sm text-blue-800 dark:text-blue-200">
                        <strong class="font-semibold">Questions?</strong> Please email 
                        <a href="mailto:ml-repository@ics.uci.edu" class="font-semibold underline underline-offset-2 hover:text-blue-900 dark:hover:text-blue-100 transition-colors">
                            ml-repository@ics.uci.edu
                        </a>
                    </div>
                </div>
                
                <!-- Divider -->
                <div class="border-t border-gray-200 dark:border-gray-700 my-8"></div>
                
                <!-- Consent Section -->
                <div>
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 rounded-lg bg-emerald-100 dark:bg-emerald-900/30 flex items-center justify-center">
                            <i class="bi bi-shield-check text-xl text-emerald-600 dark:text-emerald-400"></i>
                        </div>
                        <div>
                            <h2 class="text-lg font-bold text-gray-900 dark:text-white">Consent</h2>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Agreement required to proceed</p>
                        </div>
                    </div>
                    
                    <p class="text-sm text-gray-700 dark:text-gray-300 leading-relaxed mb-8 pl-13">
                        By clicking yes below, I am agreeing to the inclusion of the external dataset in 
                        the DataSphere Machine Learning Repository.
                    </p>
                    
                    @auth
                        <form action="{{ route('contribute.external.form') }}" method="GET" class="pl-13">
                            <input type="hidden" name="agreed" value="1">
                            <button type="submit" 
                                    class="inline-flex items-center gap-2 px-8 py-3 rounded-xl bg-gradient-to-r from-emerald-600 to-teal-600 text-white font-bold shadow-lg hover:shadow-xl hover:shadow-emerald-500/30 hover:-translate-y-0.5 transition-all">
                                <i class="bi bi-check-circle-fill"></i>
                                <span>I AGREE</span>
                            </button>
                        </form>
                    @else
                        <div class="bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-700/50 dark:to-gray-700/30 border border-gray-200 dark:border-gray-600 rounded-xl p-6 text-center">
                            <div class="w-12 h-12 mx-auto mb-4 rounded-full bg-gray-200 dark:bg-gray-600 flex items-center justify-center">
                                <i class="bi bi-person-lock text-xl text-gray-500 dark:text-gray-400"></i>
                            </div>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
                                You must be logged in to link an external dataset.
                            </p>
                            <a href="{{ route('login') }}" 
                               class="inline-flex items-center gap-2 px-8 py-3 rounded-xl bg-gradient-to-r from-brand-600 to-sphere-secondary text-white font-bold shadow-lg hover:shadow-xl hover:shadow-brand-500/30 hover:-translate-y-0.5 transition-all">
                                <i class="bi bi-box-arrow-in-right"></i>
                                <span>Login to Continue</span>
                            </a>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
        
    </div>
</div>
@endsection