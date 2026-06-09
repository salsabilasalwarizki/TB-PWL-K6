@extends('layouts.app')
@section('title', 'Donation Policy - DataSphere ML Repository')
@section('meta_desc', 'Learn about the donation policy for contributing datasets to DataSphere')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 via-brand-50/30 to-sphere-secondary/10 dark:from-gray-900 dark:via-gray-900 dark:to-gray-900 py-12 px-4 sm:px-6 lg:px-8">
    
    <!-- Background Decoration -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-20 left-10 w-72 h-72 bg-brand-500/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-20 right-10 w-96 h-96 bg-sphere-secondary/10 rounded-full blur-3xl"></div>
    </div>
    
    <div class="relative max-w-4xl mx-auto">
        
        <!-- Header Card -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 overflow-hidden mb-8">
            <div class="bg-gradient-to-r from-brand-600 to-sphere-secondary p-8 md:p-10">
                <div class="flex items-center gap-4 mb-4">
                    <div class="w-14 h-14 rounded-xl bg-white/20 backdrop-blur-sm flex items-center justify-center">
                        <i class="bi bi-file-earmark-text text-3xl text-white"></i>
                    </div>
                    <h1 class="text-3xl md:text-4xl font-bold text-white">
                        Donation Policy
                    </h1>
                </div>
                <p class="text-white/90 text-base md:text-lg leading-relaxed">
                    Thank you for considering donating a dataset to DataSphere ML Repository! Through donating a dataset, you are helping keep machine learning a strong and vital research area.
                </p>
            </div>
        </div>
        
        <!-- Important Information -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 p-6 md:p-8 mb-8">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-10 h-10 rounded-lg bg-amber-50 dark:bg-amber-900/30 flex items-center justify-center">
                    <i class="bi bi-exclamation-triangle text-xl text-amber-600 dark:text-amber-400"></i>
                </div>
                <h2 class="text-xl md:text-2xl font-bold text-gray-900 dark:text-white">
                    Important Information
                </h2>
            </div>
            
            <p class="text-sm text-gray-600 dark:text-gray-400 mb-6">
                Before donating a dataset, please read the IMPORTANT information below:
            </p>
            
            <div class="space-y-4">
                <!-- Item 1 -->
                <div class="flex gap-4 p-4 rounded-xl bg-gray-50 dark:bg-gray-700/30 border border-gray-100 dark:border-gray-700 hover:shadow-md transition-shadow">
                    <div class="flex-shrink-0 w-8 h-8 rounded-full bg-brand-100 dark:bg-brand-900/30 flex items-center justify-center">
                        <span class="text-sm font-bold text-brand-600 dark:text-brand-400">1</span>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm text-gray-700 dark:text-gray-300 leading-relaxed">
                            You must have explicit permission to make the dataset publicly available. If you are not the original dataset collector, the original dataset collector should be aware that you are donating the dataset to DataSphere and provide their consent.
                        </p>
                    </div>
                </div>
                
                <!-- Item 2 -->
                <div class="flex gap-4 p-4 rounded-xl bg-gray-50 dark:bg-gray-700/30 border border-gray-100 dark:border-gray-700 hover:shadow-md transition-shadow">
                    <div class="flex-shrink-0 w-8 h-8 rounded-full bg-brand-100 dark:bg-brand-900/30 flex items-center justify-center">
                        <span class="text-sm font-bold text-brand-600 dark:text-brand-400">2</span>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm text-gray-700 dark:text-gray-300 leading-relaxed">
                            If your dataset contains Personally Identifiable Information (PII), this information should be removed prior to donation, such that no individuals can be identified through your dataset.
                        </p>
                    </div>
                </div>
                
                <!-- Item 3 -->
                <div class="flex gap-4 p-4 rounded-xl bg-gray-50 dark:bg-gray-700/30 border border-gray-100 dark:border-gray-700 hover:shadow-md transition-shadow">
                    <div class="flex-shrink-0 w-8 h-8 rounded-full bg-brand-100 dark:bg-brand-900/30 flex items-center justify-center">
                        <span class="text-sm font-bold text-brand-600 dark:text-brand-400">3</span>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm text-gray-700 dark:text-gray-300 leading-relaxed">
                            Datasets approved to be in the repository will be assigned a Digital Object Identifier (DOI) if they do not already possess one. DOIs allow for "persistent and actionable identification" of datasets, which is an important component of reproducible research. For more information on DOIs, please read more in the 
                            <a href="https://www.doi.org/handbook_2000/introduction.html" target="_blank" rel="noopener" class="text-brand-600 dark:text-brand-400 hover:underline font-semibold">
                                DOI Handbook
                            </a>.
                        </p>
                    </div>
                </div>
                
                <!-- Item 4 -->
                <div class="flex gap-4 p-4 rounded-xl bg-gray-50 dark:bg-gray-700/30 border border-gray-100 dark:border-gray-700 hover:shadow-md transition-shadow">
                    <div class="flex-shrink-0 w-8 h-8 rounded-full bg-brand-100 dark:bg-brand-900/30 flex items-center justify-center">
                        <span class="text-sm font-bold text-brand-600 dark:text-brand-400">4</span>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm text-gray-700 dark:text-gray-300 leading-relaxed">
                            Datasets will be licensed under a Creative Commons Attribution 4.0 International license (CC BY 4.0) which allows for the sharing and adaptation of the datasets for any purpose, provided that the appropriate credit is given (see Citation Policy). For more information on the CC BY 4.0 license, please read more in the 
                            <a href="https://creativecommons.org/licenses/by/4.0/" target="_blank" rel="noopener" class="text-brand-600 dark:text-brand-400 hover:underline font-semibold">
                                license deed
                            </a>.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Contact Information -->
        <div class="bg-gradient-to-r from-brand-50 to-sphere-secondary/10 dark:from-gray-800 dark:to-gray-800 rounded-2xl shadow-xl border border-brand-200 dark:border-gray-700 p-6 mb-8">
            <div class="flex items-start gap-4">
                <div class="flex-shrink-0 w-12 h-12 rounded-xl bg-brand-100 dark:bg-brand-900/30 flex items-center justify-center">
                    <i class="bi bi-envelope text-2xl text-brand-600 dark:text-brand-400"></i>
                </div>
                <div class="flex-1">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">
                        Questions?
                    </h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">
                        For questions, please email:
                    </p>
                    <a href="mailto:dataspheremlrepository@gmail.com" class="inline-flex items-center gap-2 text-brand-600 dark:text-brand-400 hover:text-brand-700 dark:hover:text-brand-300 font-semibold transition-colors">
                        <i class="bi bi-envelope-fill"></i>
                        <span>dataspheremlrepository@gmail.com</span>
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Consent Section -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 overflow-hidden">
            <div class="bg-gradient-to-r from-green-50 to-emerald-50 dark:from-gray-800 dark:to-gray-800 border-b border-gray-200 dark:border-gray-700 p-6 md:p-8">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 rounded-lg bg-green-100 dark:bg-green-900/30 flex items-center justify-center">
                        <i class="bi bi-shield-check text-xl text-green-600 dark:text-green-400"></i>
                    </div>
                    <h2 class="text-xl md:text-2xl font-bold text-gray-900 dark:text-white">
                        Consent to DOI and CC 4.0
                    </h2>
                </div>
                <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">
                    By clicking yes below, I am agreeing to the inclusion of the external dataset in the DataSphere Machine Learning Repository. I understand that this means that my dataset will be publicly available under the CC BY 4.0 license and will be assigned a DOI if one has not already been assigned.
                </p>
            </div>
            
            <div class="p-6 md:p-8">
                @auth
                    <!-- User sudah login -->
                    <form action="{{ route('contribute.metadata') }}" method="GET" class="consent-form">
                        <input type="hidden" name="agreed" value="1">
                        <button type="submit" class="w-full md:w-auto inline-flex items-center justify-center gap-3 px-8 py-4 rounded-xl bg-gradient-to-r from-brand-600 to-sphere-secondary text-white font-bold text-base shadow-lg hover:shadow-xl hover:shadow-brand-500/30 hover:-translate-y-0.5 transition-all">
                            <i class="bi bi-check-circle-fill text-xl"></i>
                            <span>I AGREE AND CONTINUE</span>
                        </button>
                    </form>
                @else
                    <!-- User belum login -->
                    <div class="bg-amber-50 dark:bg-amber-900/20 border border-amber-200 dark:border-amber-800 rounded-xl p-6">
                        <div class="flex items-start gap-3 mb-4">
                            <i class="bi bi-info-circle-fill text-xl text-amber-600 dark:text-amber-400 mt-0.5"></i>
                            <div class="flex-1">
                                <h3 class="text-base font-bold text-gray-900 dark:text-white mb-2">
                                    Authentication Required
                                </h3>
                                <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
                                    You must be logged in to contribute a dataset. Please login or create an account to continue.
                                </p>
                            </div>
                        </div>
                        <div class="flex flex-col sm:flex-row gap-3">
                            <a href="{{ route('login') }}" class="flex-1 inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl bg-gradient-to-r from-brand-600 to-sphere-secondary text-white font-semibold shadow-lg hover:shadow-xl hover:shadow-brand-500/30 hover:-translate-y-0.5 transition-all">
                                <i class="bi bi-box-arrow-in-right"></i>
                                <span>Login to Agree & Contribute</span>
                            </a>
                            <a href="{{ route('register') }}" class="flex-1 inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 text-gray-700 dark:text-gray-200 font-semibold hover:bg-gray-50 dark:hover:bg-gray-600 hover:-translate-y-0.5 transition-all">
                                <i class="bi bi-person-plus"></i>
                                <span>Create Account</span>
                            </a>
                        </div>
                    </div>
                @endauth
            </div>
        </div>
        
    </div>
</div>
@endsection