@extends('layouts.app')
@section('title', 'Who We Are - DataSphere')
@section('meta_desc', 'Learn about DataSphere Machine Learning Repository and our mission')

@section('content')
<div class="relative">
    
    <!-- ===== HERO SECTION ===== -->
    <section class="relative overflow-hidden bg-gradient-to-br from-brand-600 via-sphere-primary to-sphere-secondary text-white">
        <div class="absolute inset-0">
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_20%_80%,rgba(255,255,255,0.1)_0%,transparent_50%)]"></div>
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_80%_20%,rgba(255,255,255,0.08)_0%,transparent_50%)]"></div>
        </div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-16">
            <!-- Breadcrumb -->
            <nav class="flex items-center gap-2 text-sm text-white/70 mb-4">
                <a href="{{ route('home') }}" class="hover:text-white transition-colors">Home</a>
                <i class="bi bi-chevron-right text-xs"></i>
                <a href="#" class="hover:text-white transition-colors">About</a>
                <i class="bi bi-chevron-right text-xs"></i>
                <span class="text-white">Who We Are</span>
            </nav>
            
            <div class="flex flex-col md:flex-row items-start md:items-center gap-6">
                <div class="flex-1">
                    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/10 backdrop-blur-sm border border-white/20 mb-4">
                        <i class="bi bi-people-fill text-yellow-300"></i>
                        <span class="text-sm font-semibold">Our Story</span>
                    </div>
                    
                    <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-3">
                        Who We Are
                    </h1>
                    <p class="text-white/90 text-base md:text-lg max-w-2xl leading-relaxed">
                        A student project dedicated to creating a comprehensive machine learning repository for educational purposes.
                    </p>
                </div>
                
                <div class="hidden md:block">
                    <div class="w-32 h-32 rounded-3xl bg-white/10 backdrop-blur-md border-2 border-white/20 flex items-center justify-center shadow-2xl">
                        <i class="bi bi-people-fill text-6xl text-white/80"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== MAIN CONTENT ===== -->
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="space-y-8">
            
            <!-- About Section -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-6 md:p-8">
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 rounded-xl bg-brand-50 dark:bg-brand-900/30 flex items-center justify-center flex-shrink-0">
                        <i class="bi bi-info-circle text-2xl text-brand-600 dark:text-brand-400"></i>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-3">About DataSphere Machine Learning Repository</h2>
                        <p class="text-gray-700 dark:text-gray-300 leading-relaxed mb-4">
                            DataSphere Machine Learning Repository is a comprehensive collection of databases, domain theories, and data generators 
                            that are used by the machine learning community for the empirical analysis of machine learning algorithms.
                        </p>
                        <p class="text-gray-700 dark:text-gray-300 leading-relaxed">
                            This project was developed as part of the final project for Semester 2 in the Advanced Web Programming course, 
                            demonstrating our skills in modern web development technologies and database management.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Mission & Vision -->
            <div class="grid md:grid-cols-2 gap-6">
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-6">
                    <div class="w-12 h-12 rounded-xl bg-purple-50 dark:bg-purple-900/30 flex items-center justify-center mb-4">
                        <i class="bi bi-bullseye text-2xl text-purple-600 dark:text-purple-400"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-3">Our Mission</h3>
                    <p class="text-gray-700 dark:text-gray-300 leading-relaxed">
                        To provide a centralized, curated repository of datasets that can be used by researchers, educators, and students 
                        worldwide for machine learning research and education, fostering innovation and reproducibility.
                    </p>
                </div>
                
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-6">
                    <div class="w-12 h-12 rounded-xl bg-cyan-50 dark:bg-cyan-900/30 flex items-center justify-center mb-4">
                        <i class="bi bi-eye text-2xl text-cyan-600 dark:text-cyan-400"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-3">Our Vision</h3>
                    <p class="text-gray-700 dark:text-gray-300 leading-relaxed">
                        To become the world's most trusted and comprehensive resource for machine learning datasets, 
                        enabling breakthrough discoveries and advancing the field of artificial intelligence.
                    </p>
                </div>
            </div>

            <!-- History Section -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-6 md:p-8">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 rounded-xl bg-amber-50 dark:bg-amber-900/30 flex items-center justify-center">
                        <i class="bi bi-clock-history text-xl text-amber-600 dark:text-amber-400"></i>
                    </div>
                    <h2 class="text-xl font-bold text-gray-900 dark:text-white">Our History</h2>
                </div>
                
                <div class="space-y-4">
                    <div class="flex gap-4 p-4 rounded-xl bg-gray-50 dark:bg-gray-700/30 border border-gray-100 dark:border-gray-700">
                        <div class="w-20 h-20 rounded-xl bg-gradient-to-br from-brand-500 to-sphere-secondary flex items-center justify-center text-white font-bold flex-shrink-0">
                            <div class="text-center">
                                <div class="text-xs">April</div>
                                <div class="text-lg">2026</div>
                            </div>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-900 dark:text-white mb-1">Project Inception</h4>
                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                DataSphere was established in April 2026 as a final project for Semester 2 Advanced Web Programming course. 
                                Our team of 5 students came together to create a comprehensive machine learning repository system 
                                with modern web technologies and best practices.
                            </p>
                        </div>
                    </div>
                    
                    <div class="flex gap-4 p-4 rounded-xl bg-gray-50 dark:bg-gray-700/30 border border-gray-100 dark:border-gray-700">
                        <div class="w-20 h-20 rounded-xl bg-gradient-to-br from-brand-500 to-sphere-secondary flex items-center justify-center text-white font-bold flex-shrink-0">
                            <div class="text-center">
                                <div class="text-xs">Present</div>
                                <div class="text-lg">Now</div>
                            </div>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-900 dark:text-white mb-1">Current Development</h4>
                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                We continue to develop and enhance DataSphere with features like dataset management, 
                                user authentication, citation tools, and a user-friendly interface. 
                                Our goal is to create a functional and educational platform for the machine learning community.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- What We Offer -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-6 md:p-8">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 rounded-xl bg-green-50 dark:bg-green-900/30 flex items-center justify-center">
                        <i class="bi bi-gift text-xl text-green-600 dark:text-green-400"></i>
                    </div>
                    <h2 class="text-xl font-bold text-gray-900 dark:text-white">What We Offer</h2>
                </div>
                
                <div class="grid md:grid-cols-2 gap-4">
                    <div class="flex items-start gap-3 p-4 rounded-xl bg-gray-50 dark:bg-gray-700/30 border border-gray-100 dark:border-gray-700">
                        <div class="w-8 h-8 rounded-lg bg-green-100 dark:bg-green-900/30 flex items-center justify-center flex-shrink-0">
                            <i class="bi bi-check-circle-fill text-green-600 dark:text-green-400"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-900 dark:text-white mb-1">Curated Datasets</h4>
                            <p class="text-sm text-gray-600 dark:text-gray-400">High-quality, well-documented datasets reviewed by our team.</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start gap-3 p-4 rounded-xl bg-gray-50 dark:bg-gray-700/30 border border-gray-100 dark:border-gray-700">
                        <div class="w-8 h-8 rounded-lg bg-green-100 dark:bg-green-900/30 flex items-center justify-center flex-shrink-0">
                            <i class="bi bi-check-circle-fill text-green-600 dark:text-green-400"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-900 dark:text-white mb-1">Citation Support</h4>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Proper citation formats (BibTeX, APA) for academic research.</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start gap-3 p-4 rounded-xl bg-gray-50 dark:bg-gray-700/30 border border-gray-100 dark:border-gray-700">
                        <div class="w-8 h-8 rounded-lg bg-green-100 dark:bg-green-900/30 flex items-center justify-center flex-shrink-0">
                            <i class="bi bi-check-circle-fill text-green-600 dark:text-green-400"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-900 dark:text-white mb-1">Modern Interface</h4>
                            <p class="text-sm text-gray-600 dark:text-gray-400">User-friendly interface with dark mode support and responsive design.</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start gap-3 p-4 rounded-xl bg-gray-50 dark:bg-gray-700/30 border border-gray-100 dark:border-gray-700">
                        <div class="w-8 h-8 rounded-lg bg-green-100 dark:bg-green-900/30 flex items-center justify-center flex-shrink-0">
                            <i class="bi bi-check-circle-fill text-green-600 dark:text-green-400"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-900 dark:text-white mb-1">Educational Focus</h4>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Designed specifically for educational and research purposes.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats Section -->
            <div class="bg-gradient-to-br from-brand-600 via-sphere-primary to-sphere-secondary rounded-2xl p-6 md:p-8 text-white shadow-xl">
                <div class="text-center mb-6">
                    <h2 class="text-2xl font-bold mb-2">Our Impact</h2>
                    <p class="text-white/90 text-sm">Growing since April 2026</p>
                </div>
                
                <div class="grid grid-cols-3 gap-4">
                    <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 text-center border border-white/20">
                        <div class="text-3xl md:text-4xl font-bold mb-1">10+</div>
                        <div class="text-xs md:text-sm text-white/80">Users</div>
                    </div>
                    <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 text-center border border-white/20">
                        <div class="text-3xl md:text-4xl font-bold mb-1">1</div>
                        <div class="text-xs md:text-sm text-white/80">Year</div>
                    </div>
                    <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 text-center border border-white/20">
                        <div class="text-3xl md:text-4xl font-bold mb-1">1</div>
                        <div class="text-xs md:text-sm text-white/80">Country</div>
                    </div>
                </div>
            </div>

            <!-- Team Section -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-6 md:p-8">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 rounded-xl bg-indigo-50 dark:bg-indigo-900/30 flex items-center justify-center">
                        <i class="bi bi-people-fill text-xl text-indigo-600 dark:text-indigo-400"></i>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-gray-900 dark:text-white">Our Team</h2>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Meet the developers behind DataSphere</p>
                    </div>
                </div>
                
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Salsabila Salwa Rizki -->
                    <div class="text-center p-6 rounded-xl bg-gray-50 dark:bg-gray-700/30 border border-gray-100 dark:border-gray-700 hover:shadow-lg transition-shadow">
                        <div class="w-24 h-24 rounded-full mx-auto mb-4 overflow-hidden border-4 border-brand-500 dark:border-brand-400">
                            <img src="{{ asset('images/about/ourmembers/salwa.png') }}" alt="Salsabila Salwa Rizki" class="w-full h-full object-cover">
                        </div>
                        <h4 class="font-bold text-gray-900 dark:text-white mb-1">Salsabila Salwa Rizki</h4>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mb-2">251402123</p>
                        <div class="flex flex-wrap gap-1 justify-center">
                            <span class="px-2 py-1 rounded-lg bg-brand-100 dark:bg-brand-900/30 text-brand-700 dark:text-brand-400 text-xs font-semibold">Project Manager</span>
                            <span class="px-2 py-1 rounded-lg bg-purple-100 dark:bg-purple-900/30 text-purple-700 dark:text-purple-400 text-xs font-semibold">Backend Dev</span>
                        </div>
                    </div>

                    <!-- Jesqueen Maria Purba -->
                    <div class="text-center p-6 rounded-xl bg-gray-50 dark:bg-gray-700/30 border border-gray-100 dark:border-gray-700 hover:shadow-lg transition-shadow">
                        <div class="w-24 h-24 rounded-full mx-auto mb-4 overflow-hidden border-4 border-brand-500 dark:border-brand-400">
                            <img src="{{ asset('images/about/ourmembers/jesqueen.png') }}" alt="Jesqueen Maria Purba" class="w-full h-full object-cover">
                        </div>
                        <h4 class="font-bold text-gray-900 dark:text-white mb-1">Jesqueen Maria Purba</h4>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mb-2">251402099</p>
                        <div class="flex flex-wrap gap-1 justify-center">
                            <span class="px-2 py-1 rounded-lg bg-cyan-100 dark:bg-cyan-900/30 text-cyan-700 dark:text-cyan-400 text-xs font-semibold">Frontend Dev</span>
                        </div>
                    </div>

                    <!-- Fadila Lisma Sari -->
                    <div class="text-center p-6 rounded-xl bg-gray-50 dark:bg-gray-700/30 border border-gray-100 dark:border-gray-700 hover:shadow-lg transition-shadow">
                        <div class="w-24 h-24 rounded-full mx-auto mb-4 overflow-hidden border-4 border-brand-500 dark:border-brand-400">
                            <img src="{{ asset('images/about/ourmembers/fadila.png') }}" alt="Fadila Lisma Sari" class="w-full h-full object-cover">
                        </div>
                        <h4 class="font-bold text-gray-900 dark:text-white mb-1">Fadila Lisma Sari</h4>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mb-2">251402117</p>
                        <div class="flex flex-wrap gap-1 justify-center">
                            <span class="px-2 py-1 rounded-lg bg-cyan-100 dark:bg-cyan-900/30 text-cyan-700 dark:text-cyan-400 text-xs font-semibold">Frontend Dev</span>
                        </div>
                    </div>

                    <!-- Syifa Nazira -->
                    <div class="text-center p-6 rounded-xl bg-gray-50 dark:bg-gray-700/30 border border-gray-100 dark:border-gray-700 hover:shadow-lg transition-shadow">
                        <div class="w-24 h-24 rounded-full mx-auto mb-4 overflow-hidden border-4 border-brand-500 dark:border-brand-400">
                            <img src="{{ asset('images/about/ourmembers/syifa.png') }}" alt="Syifa Nazira" class="w-full h-full object-cover">
                        </div>
                        <h4 class="font-bold text-gray-900 dark:text-white mb-1">Syifa Nazira</h4>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mb-2">251402126</p>
                        <div class="flex flex-wrap gap-1 justify-center">
                            <span class="px-2 py-1 rounded-lg bg-purple-100 dark:bg-purple-900/30 text-purple-700 dark:text-purple-400 text-xs font-semibold">Backend Dev</span>
                        </div>
                    </div>

                    <!-- Jelita Hati Sinurat -->
                    <div class="text-center p-6 rounded-xl bg-gray-50 dark:bg-gray-700/30 border border-gray-100 dark:border-gray-700 hover:shadow-lg transition-shadow md:col-span-2 lg:col-span-1 lg:col-start-2">
                        <div class="w-24 h-24 rounded-full mx-auto mb-4 overflow-hidden border-4 border-brand-500 dark:border-brand-400">
                            <img src="{{ asset('images/about/ourmembers/jelita.png') }}" alt="Jelita Hati Sinurat" class="w-full h-full object-cover">
                        </div>
                        <h4 class="font-bold text-gray-900 dark:text-white mb-1">Jelita Hati Sinurat</h4>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mb-2">251402141</p>
                        <div class="flex flex-wrap gap-1 justify-center">
                            <span class="px-2 py-1 rounded-lg bg-amber-100 dark:bg-amber-900/30 text-amber-700 dark:text-amber-400 text-xs font-semibold">Admin Staff</span>
                        </div>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">Reports & Presentations</p>
                    </div>
                </div>
            </div>

            <!-- Project Info -->
            <div class="bg-gradient-to-br from-amber-50 to-orange-50 dark:from-amber-900/20 dark:to-orange-900/20 border border-amber-200 dark:border-amber-800 rounded-2xl p-6 md:p-8">
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 rounded-xl bg-amber-100 dark:bg-amber-900/30 flex items-center justify-center flex-shrink-0">
                        <i class="bi bi-mortarboard text-2xl text-amber-600 dark:text-amber-400"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">Academic Project</h3>
                        <p class="text-gray-700 dark:text-gray-300 leading-relaxed mb-3">
                            This project was developed as part of the final assignment for Semester 2 in the 
                            <strong>Advanced Web Programming</strong> course.
                        </p>
                        <div class="flex flex-wrap gap-2">
                            <span class="px-3 py-1 rounded-full bg-amber-100 dark:bg-amber-900/30 text-amber-800 dark:text-amber-300 text-xs font-semibold">
                                <i class="bi bi-calendar me-1"></i>Semester 2
                            </span>
                            <span class="px-3 py-1 rounded-full bg-amber-100 dark:bg-amber-900/30 text-amber-800 dark:text-amber-300 text-xs font-semibold">
                                <i class="bi bi-code-slash me-1"></i>Advanced Web Programming
                            </span>
                            <span class="px-3 py-1 rounded-full bg-amber-100 dark:bg-amber-900/30 text-amber-800 dark:text-amber-300 text-xs font-semibold">
                                <i class="bi bi-calendar3 me-1"></i>April 2026 - Present
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact CTA -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-6 md:p-8">
                <div class="flex flex-col md:flex-row items-center justify-between gap-4">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 rounded-xl bg-brand-50 dark:bg-brand-900/30 flex items-center justify-center flex-shrink-0">
                            <i class="bi bi-envelope text-2xl text-brand-600 dark:text-brand-400"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-1">Get in Touch</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Have questions or suggestions? We'd love to hear from you.</p>
                        </div>
                    </div>
                    <a href="{{ route('about.contact') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-gradient-to-r from-brand-600 to-sphere-secondary text-white font-semibold shadow-md hover:shadow-lg hover:-translate-y-0.5 transition-all">
                        <i class="bi bi-envelope"></i>
                        <span>Contact Us</span>
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection