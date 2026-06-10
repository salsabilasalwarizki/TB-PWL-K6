<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5">
    <meta name="description" content="@yield('meta_desc', 'DataSphere Machine Learning Repository - A curated collection of datasets for ML research')">
    <title>@yield('title', 'DataSphere Machine Learning Repository')</title>
    
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
    
    
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        'sans': ['Plus Jakarta Sans', 'Inter', 'sans-serif'],
                        'display': ['Plus Jakarta Sans', 'sans-serif'],
                        'mono': ['JetBrains Mono', 'monospace'],
                    },
                    colors: {
                        'brand': {
                            50: '#eef6ff', 100: '#d9ebff', 200: '#bcdcff', 300: '#8ec5ff',
                            400: '#59a3ff', 500: '#3380ff', 600: '#1a5ff5', 700: '#134ae1',
                            800: '#163db6', 900: '#18388f', 950: '#142457',
                        },
                        'sphere': {
                            primary: '#6366f1',
                            secondary: '#8b5cf6',
                            accent: '#06b6d4',
                        }
                    },
                    animation: {
                        'float': 'float 6s ease-in-out infinite',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0px)' },
                            '50%': { transform: 'translateY(-10px)' },
                        }
                    }
                }
            }
        }
    </script>
    
    
    <script>
        (function() {
            const theme = localStorage.getItem('datasphere-theme') || 
                         (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
            if (theme === 'dark') document.documentElement.classList.add('dark');
        })();
    </script>
    
    
    <style>
        
        *, *::before, *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        
        html {
            scroll-behavior: smooth;
            overflow-x: hidden;
            width: 100%;
        }
        
        body {
            font-family: 'Plus Jakarta Sans', 'Inter', sans-serif;
            transition: background-color 0.3s ease, color 0.3s ease;
            overflow-x: hidden;
            width: 100%;
            position: relative;
        }
        
        
        .navbar-glass {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(20px) saturate(180%);
            -webkit-backdrop-filter: blur(20px) saturate(180%);
            border-bottom: 1px solid rgba(229, 231, 235, 0.3);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            width: 100%;
        }
        
        .navbar-glass.scrolled {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px) saturate(200%);
            -webkit-backdrop-filter: blur(20px) saturate(200%);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1), 
                        0 1px 3px rgba(0, 0, 0, 0.08);
            border-bottom: 1px solid rgba(229, 231, 235, 0.5);
        }
        
        .dark .navbar-glass {
            background: rgba(17, 24, 39, 0.7);
            border-bottom: 1px solid rgba(55, 65, 81, 0.3);
        }
        
        .dark .navbar-glass.scrolled {
            background: rgba(17, 24, 39, 0.95);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.3), 
                        0 1px 3px rgba(0, 0, 0, 0.2);
            border-bottom: 1px solid rgba(55, 65, 81, 0.5);
        }
        
        
        .logo-sphere { transition: transform 0.5s cubic-bezier(0.34, 1.56, 0.64, 1); }
        .logo-sphere:hover { transform: rotate(360deg) scale(1.1); }
        
        
        .theme-toggle {
            position: relative;
            width: 40px; height: 40px;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            transition: all 0.3s ease;
            overflow: hidden;
        }
        .theme-toggle:hover {
            background: rgba(99, 102, 241, 0.1);
            transform: scale(1.1);
        }
        .theme-toggle .icon {
            transition: all 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            position: absolute;
        }
        .theme-toggle .sun { opacity: 0; transform: rotate(-90deg) scale(0); }
        .theme-toggle .moon { opacity: 1; transform: rotate(0deg) scale(1); }
        .dark .theme-toggle .sun { opacity: 1; transform: rotate(0deg) scale(1); }
        .dark .theme-toggle .moon { opacity: 0; transform: rotate(90deg) scale(0); }
        
        
        .nav-link-custom {
            position: relative;
            padding: 0.5rem 1rem;
            font-weight: 500;
            transition: color 0.2s ease;
        }
        .nav-link-custom::after {
            content: '';
            position: absolute;
            bottom: 0; left: 50%;
            width: 0; height: 2px;
            background: linear-gradient(90deg, #6366f1, #8b5cf6);
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }
        .nav-link-custom:hover::after,
        .nav-link-custom.active::after { width: 70%; }
        
        
        .dropdown-menu-custom {
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(229, 231, 235, 0.8);
            box-shadow: 0 20px 40px -10px rgba(0, 0, 0, 0.15);
            border-radius: 12px;
            padding: 0.5rem;
            min-width: 220px;
            animation: dropdownFade 0.2s ease;
        }
        .dark .dropdown-menu-custom {
            background: rgba(31, 41, 55, 0.98);
            border: 1px solid rgba(55, 65, 81, 0.8);
        }
        @keyframes dropdownFade {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .dropdown-item-custom {
            padding: 0.625rem 0.875rem;
            border-radius: 8px;
            transition: all 0.2s ease;
            display: flex; align-items: center; gap: 0.75rem;
            font-size: 0.875rem; font-weight: 500;
        }
        .dropdown-item-custom:hover {
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.1), rgba(139, 92, 246, 0.1));
            transform: translateX(4px);
        }
        
        
        .search-input {
            background: rgba(243, 244, 246, 0.8);
            border: 1px solid transparent;
            transition: all 0.3s ease;
        }
        .dark .search-input { background: rgba(55, 65, 81, 0.5); }
        .search-input:focus {
            background: white;
            border-color: #6366f1;
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
            outline: none;
        }
        .dark .search-input:focus {
            background: rgb(31, 41, 55);
            border-color: #818cf8;
        }
        
        
        .avatar-btn {
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
        }
        .avatar-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(99, 102, 241, 0.4);
        }
        
        
        .gradient-text {
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 50%, #06b6d4 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        
        ::-webkit-scrollbar { width: 10px; height: 10px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb {
            background: rgba(99, 102, 241, 0.3);
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb:hover { background: rgba(99, 102, 241, 0.5); }
        
        
        .footer-glass {
            background: linear-gradient(180deg, rgba(249, 250, 251, 0.5) 0%, rgba(243, 244, 246, 0.8) 100%);
            backdrop-filter: blur(10px);
        }
        .dark .footer-glass {
            background: linear-gradient(180deg, rgba(17, 24, 39, 0.5) 0%, rgba(31, 41, 55, 0.8) 100%);
        }
        .footer-link { position: relative; transition: all 0.3s ease; }
        .footer-link::before {
            content: '';
            position: absolute;
            bottom: -2px; left: 0;
            width: 0; height: 1px;
            background: linear-gradient(90deg, #6366f1, #8b5cf6);
            transition: width 0.3s ease;
        }
        .footer-link:hover::before { width: 100%; }
        
        
        .flash-message { animation: slideInDown 0.4s ease; }
        @keyframes slideInDown {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        
        #mobileMenu {
            display: none;
            position: fixed;
            inset: 0;
            z-index: 1100;
        }
        
        #mobileMenu.active {
            display: block;
        }
        
        #mobileMenuBackdrop {
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        
        #mobileMenu.active #mobileMenuBackdrop {
            opacity: 1;
        }
        
        #mobileMenuPanel {
            transform: translateX(100%);
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        #mobileMenu.active #mobileMenuPanel {
            transform: translateX(0);
        }
        
        .mobile-panel {
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .mobile-menu-item {
            transition: all 0.2s ease;
        }
        .mobile-menu-item:active {
            transform: scale(0.98);
        }
        
        
        .newsletter-btn.loading {
            pointer-events: none;
            opacity: 0.7;
        }
        .newsletter-btn.loading .btn-text {
            display: none;
        }
        .newsletter-btn.loading .btn-loader {
            display: inline-block;
        }
        .btn-loader {
            display: none;
            width: 16px;
            height: 16px;
            border: 2px solid rgba(255,255,255,0.3);
            border-top-color: white;
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
        }
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
        
        
        main {
            padding-top: 80px;
        }
    </style>
    
    @stack('styles')
</head>
<body class="bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 antialiased transition-colors duration-300">

    
    
    
    <nav class="navbar-glass" id="mainNavbar">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16 lg:h-20">
                
                
                <a href="{{ route('home') }}" class="flex items-center gap-2 lg:gap-3 group flex-shrink-0">
                    <div class="logo-sphere relative">
                        <svg width="36" height="36" viewBox="0 0 40 40" fill="none" class="lg:w-10 lg:h-10">
                            <defs>
                                <linearGradient id="sphereGrad" x1="0%" y1="0%" x2="100%" y2="100%">
                                    <stop offset="0%" stop-color="#6366f1"/>
                                    <stop offset="50%" stop-color="#8b5cf6"/>
                                    <stop offset="100%" stop-color="#06b6d4"/>
                                </linearGradient>
                                <radialGradient id="sphereGlow" cx="50%" cy="50%" r="50%">
                                    <stop offset="0%" stop-color="#fff" stop-opacity="0.3"/>
                                    <stop offset="100%" stop-color="#fff" stop-opacity="0"/>
                                </radialGradient>
                            </defs>
                            <circle cx="20" cy="20" r="18" fill="url(#sphereGrad)"/>
                            <circle cx="20" cy="20" r="18" fill="url(#sphereGlow)"/>
                            <ellipse cx="20" cy="20" rx="18" ry="8" stroke="white" stroke-width="0.8" fill="none" opacity="0.4"/>
                            <ellipse cx="20" cy="20" rx="8" ry="18" stroke="white" stroke-width="0.8" fill="none" opacity="0.4"/>
                            <line x1="2" y1="20" x2="38" y2="20" stroke="white" stroke-width="0.8" opacity="0.4"/>
                            <line x1="20" y1="2" x2="20" y2="38" stroke="white" stroke-width="0.8" opacity="0.4"/>
                            <circle cx="12" cy="14" r="1.5" fill="white"/>
                            <circle cx="28" cy="16" r="1.5" fill="white"/>
                            <circle cx="20" cy="28" r="1.5" fill="white"/>
                            <circle cx="15" cy="24" r="1" fill="white" opacity="0.7"/>
                            <circle cx="26" cy="24" r="1" fill="white" opacity="0.7"/>
                        </svg>
                    </div>
                    <div class="flex flex-col leading-tight">
                        <span class="font-display font-bold text-base lg:text-lg gradient-text">DataSphere</span>
                        <span class="text-[9px] lg:text-xs text-gray-500 dark:text-gray-400 font-medium tracking-wide">ML Repository</span>
                    </div>
                </a>
                
                
                <div class="hidden lg:flex items-center gap-1">
                    @auth
                        @if(auth()->user()->role === 'admin' || auth()->user()->role === 'superadmin')
                            <a href="{{ route('admin.dashboard') }}" 
                               class="nav-link-custom text-red-500 hover:text-red-600 dark:text-red-400 dark:hover:text-red-300 flex items-center gap-1.5 text-sm">
                                <i class="bi bi-shield-lock-fill"></i>
                                <span>Admin</span>
                            </a>
                        @endif
                    @endauth
                    
                    <a href="{{ route('datasets.index') }}" 
                       class="nav-link-custom text-gray-700 dark:text-gray-200 hover:text-brand-600 dark:hover:text-brand-400 text-sm">
                        Datasets
                    </a>
                    
                    
                    <div class="relative group">
                        <button class="nav-link-custom text-gray-700 dark:text-gray-200 hover:text-brand-600 dark:hover:text-brand-400 text-sm flex items-center gap-1">
                            <span>Contribute</span>
                            <i class="bi bi-chevron-down text-xs transition-transform group-hover:rotate-180"></i>
                        </button>
                        <div class="dropdown-menu-custom absolute left-0 mt-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200">
                            <a href="{{ route('contribute.policy') }}" class="dropdown-item-custom text-gray-700 dark:text-gray-200">
                                <i class="bi bi-cloud-arrow-up text-brand-500"></i>
                                <div>
                                    <div class="font-semibold">Donate New</div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400">Upload your dataset</div>
                                </div>
                            </a>
                            <div class="h-px bg-gray-100 dark:bg-gray-700 my-1"></div>
                            <a href="{{ route('contribute.linking.policy') }}" class="dropdown-item-custom text-gray-700 dark:text-gray-200">
                                <i class="bi bi-link-45deg text-sphere-accent"></i>
                                <div>
                                    <div class="font-semibold">Link External</div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400">Connect external data</div>
                                </div>
                            </a>
                        </div>
                    </div>
                    
                    
                    <div class="relative group">
                        <button class="nav-link-custom text-gray-700 dark:text-gray-200 hover:text-brand-600 dark:hover:text-brand-400 text-sm flex items-center gap-1">
                            <span>About</span>
                            <i class="bi bi-chevron-down text-xs transition-transform group-hover:rotate-180"></i>
                        </button>
                        <div class="dropdown-menu-custom absolute left-0 mt-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200">
                            <a href="{{ route('about.who-we-are') }}" class="dropdown-item-custom text-gray-700 dark:text-gray-200">
                                <i class="bi bi-people-fill text-brand-500"></i>
                                <span class="font-semibold">Who We Are</span>
                            </a>
                            <div class="h-px bg-gray-100 dark:bg-gray-700 my-1"></div>
                            <a href="{{ route('about.citation') }}" class="dropdown-item-custom text-gray-700 dark:text-gray-200">
                                <i class="bi bi-quote text-sphere-secondary"></i>
                                <span class="font-semibold">Citation Metadata</span>
                            </a>
                            <div class="h-px bg-gray-100 dark:bg-gray-700 my-1"></div>
                            <a href="{{ route('about.contact') }}" class="dropdown-item-custom text-gray-700 dark:text-gray-200">
                                <i class="bi bi-envelope-fill text-sphere-accent"></i>
                                <span class="font-semibold">Contact</span>
                            </a>
                        </div>
                    </div>
                </div>
                
                
                <div class="flex items-center gap-2 lg:gap-3">
                    
                    <form action="{{ route('datasets.index') }}" method="GET" class="hidden md:block flex-shrink-0">
                        <div class="relative">
                            <i class="bi bi-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                            <input type="search" name="q" value="{{ request('q') }}" placeholder="Search datasets..."
                                   class="search-input w-48 xl:w-64 pl-9 pr-3 py-2 rounded-full text-sm outline-none">
                        </div>
                    </form>
                    
                    
                    <button class="md:hidden w-10 h-10 flex items-center justify-center rounded-full hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors flex-shrink-0" 
                            onclick="toggleMobileSearch()" aria-label="Search">
                        <i class="bi bi-search text-gray-600 dark:text-gray-300"></i>
                    </button>
                    
                    
                    <button onclick="toggleTheme()" class="theme-toggle flex-shrink-0" aria-label="Toggle theme">
                        <i class="bi bi-moon-stars-fill icon moon text-gray-700 dark:text-yellow-300"></i>
                        <i class="bi bi-sun-fill icon sun text-yellow-500"></i>
                    </button>
                    
                    
                    @auth
                        <div class="hidden lg:block relative group flex-shrink-0">
                            <button class="avatar-btn w-9 h-9 rounded-full flex items-center justify-center text-white font-semibold text-sm">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </button>
                            <div class="dropdown-menu-custom absolute right-0 mt-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 w-56">
                                <div class="px-3 py-2 border-b border-gray-100 dark:border-gray-700 mb-1">
                                    <div class="font-semibold text-sm text-gray-900 dark:text-gray-100">{{ auth()->user()->name }}</div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400 truncate">{{ auth()->user()->email }}</div>
                                </div>
                                <a href="{{ route('profile') }}" class="dropdown-item-custom text-gray-700 dark:text-gray-200">
                                    <i class="bi bi-person-circle text-brand-500"></i>
                                    <span class="font-semibold">My Profile</span>
                                </a>
                                <a href="{{ route('profile.datasets') }}" class="dropdown-item-custom text-gray-700 dark:text-gray-200">
                                    <i class="bi bi-database text-sphere-secondary"></i>
                                    <span class="font-semibold">My Datasets</span>
                                </a>
                                <div class="h-px bg-gray-100 dark:bg-gray-700 my-1"></div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item-custom w-full text-left text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20">
                                        <i class="bi bi-box-arrow-right"></i>
                                        <span class="font-semibold">Logout</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" 
                           class="hidden lg:inline-flex items-center gap-2 px-4 py-2 rounded-full text-sm font-semibold text-white bg-gradient-to-r from-brand-600 to-sphere-secondary hover:shadow-lg hover:shadow-brand-500/30 transition-all hover:-translate-y-0.5 flex-shrink-0">
                            <i class="bi bi-box-arrow-in-right"></i>
                            <span>Login</span>
                        </a>
                    @endauth
                    
                    
                    <button class="lg:hidden w-10 h-10 flex items-center justify-center rounded-full hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors flex-shrink-0" 
                            onclick="toggleMobileMenu()" aria-label="Menu">
                        <i class="bi bi-list text-xl text-gray-600 dark:text-gray-300"></i>
                    </button>
                </div>
            </div>
            
            
            <div id="mobileSearch" class="hidden lg:hidden pb-3">
                <form action="{{ route('datasets.index') }}" method="GET">
                    <div class="relative">
                        <i class="bi bi-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                        <input type="search" name="q" value="{{ request('q') }}" placeholder="Search datasets..."
                               class="search-input w-full pl-9 pr-3 py-2.5 rounded-full text-sm outline-none">
                    </div>
                </form>
            </div>
        </div>
    </nav>

    
    
    
    <div id="mobileMenu">
        
        <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" 
             onclick="toggleMobileMenu()" id="mobileMenuBackdrop"></div>
        
        
        <div class="absolute right-0 top-0 h-full w-full max-w-sm bg-white dark:bg-gray-900 shadow-2xl" 
             id="mobileMenuPanel">
            <div class="flex flex-col h-full">
                
                
                <div class="flex items-center justify-between p-4 border-b border-gray-200 dark:border-gray-700">
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-brand-500 to-sphere-secondary flex items-center justify-center">
                            <i class="bi bi-menu-button-wide text-white text-sm"></i>
                        </div>
                        <span class="font-display font-bold text-lg gradient-text">Menu</span>
                    </div>
                    <button onclick="toggleMobileMenu()" 
                            class="w-10 h-10 rounded-full hover:bg-gray-100 dark:hover:bg-gray-800 flex items-center justify-center transition-colors">
                        <i class="bi bi-x-lg text-gray-600 dark:text-gray-300 text-xl"></i>
                    </button>
                </div>
                
                
                <div class="flex-1 overflow-y-auto py-4">
                    <div class="px-4 space-y-1">
                        
                        @auth
                            @if(auth()->user()->role === 'admin' || auth()->user()->role === 'superadmin')
                                <a href="{{ route('admin.dashboard') }}" 
                                   class="mobile-menu-item flex items-center gap-3 px-4 py-3 rounded-xl text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 font-medium">
                                    <i class="bi bi-shield-lock-fill text-lg"></i>
                                    <span>Admin Panel</span>
                                </a>
                                <div class="h-px bg-gray-100 dark:bg-gray-800 my-2"></div>
                            @endif
                        @endauth
                        
                        <a href="{{ route('datasets.index') }}" 
                           class="mobile-menu-item flex items-center gap-3 px-4 py-3 rounded-xl text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-800 font-medium">
                            <i class="bi bi-grid-3x3-gap text-lg text-brand-500"></i>
                            <span>Datasets</span>
                        </a>
                        
                        <div class="pt-4 pb-1">
                            <div class="px-4 text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-wider">Contribute</div>
                        </div>
                        <a href="{{ route('contribute.policy') }}" 
                           class="mobile-menu-item flex items-center gap-3 px-4 py-3 rounded-xl text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-800 font-medium">
                            <i class="bi bi-cloud-arrow-up text-lg text-green-500"></i>
                            <span>Donate New</span>
                        </a>
                        <a href="{{ route('contribute.linking.policy') }}" 
                           class="mobile-menu-item flex items-center gap-3 px-4 py-3 rounded-xl text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-800 font-medium">
                            <i class="bi bi-link-45deg text-lg text-cyan-500"></i>
                            <span>Link External</span>
                        </a>
                        
                        <div class="pt-4 pb-1">
                            <div class="px-4 text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-wider">About</div>
                        </div>
                        <a href="{{ route('about.who-we-are') }}" 
                           class="mobile-menu-item flex items-center gap-3 px-4 py-3 rounded-xl text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-800 font-medium">
                            <i class="bi bi-people-fill text-lg text-brand-500"></i>
                            <span>Who We Are</span>
                        </a>
                        <a href="{{ route('about.citation') }}" 
                           class="mobile-menu-item flex items-center gap-3 px-4 py-3 rounded-xl text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-800 font-medium">
                            <i class="bi bi-quote text-lg text-purple-500"></i>
                            <span>Citation Metadata</span>
                        </a>
                        <a href="{{ route('about.contact') }}" 
                           class="mobile-menu-item flex items-center gap-3 px-4 py-3 rounded-xl text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-800 font-medium">
                            <i class="bi bi-envelope-fill text-lg text-cyan-500"></i>
                            <span>Contact</span>
                        </a>
                        
                        @auth
                            <div class="pt-4 pb-1">
                                <div class="px-4 text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-wider">Account</div>
                            </div>
                            <a href="{{ route('profile') }}" 
                               class="mobile-menu-item flex items-center gap-3 px-4 py-3 rounded-xl text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-800 font-medium">
                                <i class="bi bi-person-circle text-lg text-brand-500"></i>
                                <span>My Profile</span>
                            </a>
                            <a href="{{ route('profile.datasets') }}" 
                               class="mobile-menu-item flex items-center gap-3 px-4 py-3 rounded-xl text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-800 font-medium">
                                <i class="bi bi-database text-lg text-purple-500"></i>
                                <span>My Datasets</span>
                            </a>
                        @endauth
                    </div>
                </div>
                
                
                <div class="p-4 border-t border-gray-200 dark:border-gray-700 space-y-2 bg-gray-50 dark:bg-gray-800/50">
                    @auth
                        <div class="flex items-center gap-3 px-4 py-3 bg-white dark:bg-gray-800 rounded-xl shadow-sm">
                            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-brand-500 to-sphere-secondary flex items-center justify-center text-white font-bold flex-shrink-0">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="font-semibold text-sm text-gray-900 dark:text-white truncate">{{ auth()->user()->name }}</div>
                                <div class="text-xs text-gray-500 dark:text-gray-400 truncate">{{ auth()->user()->email }}</div>
                            </div>
                        </div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" 
                                    class="mobile-menu-item w-full flex items-center justify-center gap-2 px-4 py-3 rounded-xl bg-red-50 dark:bg-red-900/20 text-red-600 dark:text-red-400 font-semibold hover:bg-red-100 dark:hover:bg-red-900/30 transition-colors">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Logout</span>
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" 
                           class="mobile-menu-item w-full flex items-center justify-center gap-2 px-4 py-3 rounded-xl bg-gradient-to-r from-brand-600 to-sphere-secondary text-white font-semibold shadow-lg hover:shadow-xl transition-all">
                            <i class="bi bi-box-arrow-in-right"></i>
                            <span>Login</span>
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </div>

    
    
    
    @if(session('success'))
    <div class="flash-message fixed top-20 right-4 z-[1200] max-w-sm">
        <div class="bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-800 text-green-800 dark:text-green-200 px-4 py-3 rounded-xl shadow-lg flex items-start gap-3">
            <i class="bi bi-check-circle-fill text-green-500 text-xl mt-0.5"></i>
            <div class="flex-1 text-sm font-medium">{{ session('success') }}</div>
            <button onclick="this.parentElement.parentElement.remove()" class="text-green-500 hover:text-green-700">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>
    </div>
    @endif
    
    @if(session('error'))
    <div class="flash-message fixed top-20 right-4 z-[1200] max-w-sm">
        <div class="bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-800 text-red-800 dark:text-red-200 px-4 py-3 rounded-xl shadow-lg flex items-start gap-3">
            <i class="bi bi-exclamation-triangle-fill text-red-500 text-xl mt-0.5"></i>
            <div class="flex-1 text-sm font-medium">{{ session('error') }}</div>
            <button onclick="this.parentElement.parentElement.remove()" class="text-red-500 hover:text-red-700">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>
    </div>
    @endif

    
    
    
    <main class="w-full">
        @yield('content')
    </main>

    
    
    
    <footer class="footer-glass border-t border-gray-200 dark:border-gray-800 mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            
            <div class="py-12 border-b border-gray-200 dark:border-gray-800">
                <div class="max-w-3xl mx-auto text-center">
                    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-gradient-to-r from-brand-500/10 to-sphere-secondary/10 border border-brand-500/20 mb-4">
                        <i class="bi bi-envelope-paper text-brand-600 dark:text-brand-400"></i>
                        <span class="text-sm font-semibold text-brand-700 dark:text-brand-300">Stay Updated</span>
                    </div>
                    <h3 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-gray-100 mb-3">
                        Subscribe to Our Newsletter
                    </h3>
                    <p class="text-gray-600 dark:text-gray-400 mb-6">
                        Get the latest datasets, research papers, and ML insights delivered to your inbox.
                    </p>
                    
                    
                    <form id="newsletterForm" action="{{ route('newsletter.subscribe') }}" method="POST" class="flex flex-col sm:flex-row gap-3 max-w-md mx-auto">
                        @csrf
                        <input type="email" name="email" required placeholder="Enter your email"
                               value="{{ old('email') }}"
                               class="flex-1 px-4 py-3 rounded-full bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 text-gray-900 dark:text-gray-100 placeholder-gray-400 focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 transition-all">
                        <button type="submit" id="newsletterBtn"
                                class="newsletter-btn px-6 py-3 rounded-full bg-gradient-to-r from-brand-600 to-sphere-secondary text-white font-semibold hover:shadow-lg hover:shadow-brand-500/30 transition-all hover:-translate-y-0.5 whitespace-nowrap flex items-center justify-center gap-2">
                            <span class="btn-text">Subscribe</span>
                            <span class="btn-loader"></span>
                        </button>
                    </form>
                    
                    @if($errors->has('email'))
                    <p class="text-red-500 text-sm mt-3">{{ $errors->first('email') }}</p>
                    @endif
                    
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-4">
                        <i class="bi bi-shield-check me-1"></i>
                        We respect your privacy. Unsubscribe at any time.
                    </p>
                </div>
            </div>
            
            
            <div class="py-12 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-8">
                
                
                <div class="lg:col-span-2">
                    <div class="flex items-center gap-3 mb-4">
                        <svg width="40" height="40" viewBox="0 0 40 40" fill="none">
                            <defs>
                                <linearGradient id="footerGrad" x1="0%" y1="0%" x2="100%" y2="100%">
                                    <stop offset="0%" stop-color="#6366f1"/>
                                    <stop offset="100%" stop-color="#06b6d4"/>
                                </linearGradient>
                            </defs>
                            <circle cx="20" cy="20" r="18" fill="url(#footerGrad)"/>
                            <ellipse cx="20" cy="20" rx="18" ry="8" stroke="white" stroke-width="0.8" fill="none" opacity="0.4"/>
                            <ellipse cx="20" cy="20" rx="8" ry="18" stroke="white" stroke-width="0.8" fill="none" opacity="0.4"/>
                        </svg>
                        <div>
                            <div class="font-bold text-lg gradient-text">DataSphere</div>
                            <div class="text-xs text-gray-500 dark:text-gray-400">ML Repository</div>
                        </div>
                    </div>
                    <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed mb-6 max-w-sm">
                        A curated collection of datasets for machine learning research, serving the global ML community with high-quality, well-documented data.
                    </p>
                </div>
                
                
                <div>
                    <h5 class="font-bold text-sm uppercase tracking-wider text-gray-900 dark:text-gray-100 mb-4">The Project</h5>
                    <ul class="space-y-3">
                        <li><a href="{{ route('about.who-we-are') }}" class="footer-link text-sm text-gray-600 dark:text-gray-400 hover:text-brand-600 dark:hover:text-brand-400">About Us</a></li>
                        <li><a href="#" class="footer-link text-sm text-gray-600 dark:text-gray-400 hover:text-brand-600 dark:hover:text-brand-400">CML</a></li>
                        <li><a href="#" class="footer-link text-sm text-gray-600 dark:text-gray-400 hover:text-brand-600 dark:hover:text-brand-400">National Science Foundation</a></li>
                        <li><a href="#" class="footer-link text-sm text-gray-600 dark:text-gray-400 hover:text-brand-600 dark:hover:text-brand-400">Research Partners</a></li>
                    </ul>
                </div>
                
                
                <div>
                    <h5 class="font-bold text-sm uppercase tracking-wider text-gray-900 dark:text-gray-100 mb-4">Navigation</h5>
                    <ul class="space-y-3">
                        <li><a href="{{ route('home') }}" class="footer-link text-sm text-gray-600 dark:text-gray-400 hover:text-brand-600 dark:hover:text-brand-400">Home</a></li>
                        <li><a href="{{ route('datasets.index') }}" class="footer-link text-sm text-gray-600 dark:text-gray-400 hover:text-brand-600 dark:hover:text-brand-400">View Datasets</a></li>
                        <li><a href="{{ route('contribute.policy') }}" class="footer-link text-sm text-gray-600 dark:text-gray-400 hover:text-brand-600 dark:hover:text-brand-400">Donate a Dataset</a></li>
                        <li><a href="{{ route('about.citation') }}" class="footer-link text-sm text-gray-600 dark:text-gray-400 hover:text-brand-600 dark:hover:text-brand-400">Citation Guide</a></li>
                    </ul>
                </div>
                
                
                <div>
                    <h5 class="font-bold text-sm uppercase tracking-wider text-gray-900 dark:text-gray-100 mb-4">Resources</h5>
                    <ul class="space-y-3">
                        <li><a href="#" class="footer-link text-sm text-gray-600 dark:text-gray-400 hover:text-brand-600 dark:hover:text-brand-400">Documentation</a></li>
                        <li><a href="#" class="footer-link text-sm text-gray-600 dark:text-gray-400 hover:text-brand-600 dark:hover:text-brand-400">API Reference</a></li>
                        <li><a href="#" class="footer-link text-sm text-gray-600 dark:text-gray-400 hover:text-brand-600 dark:hover:text-brand-400">Tutorials</a></li>
                        <li><a href="#" class="footer-link text-sm text-gray-600 dark:text-gray-400 hover:text-brand-600 dark:hover:text-brand-400">Blog</a></li>
                    </ul>
                </div>
            </div>
            
            
            <div class="py-6 border-t border-gray-200 dark:border-gray-800">
                <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                    <div class="flex flex-wrap justify-center md:justify-start gap-6 text-xs text-gray-600 dark:text-gray-400">
                        <a href="{{ route('about.contact') }}" class="footer-link hover:text-brand-600 dark:hover:text-brand-400">Contact</a>
                        <a href="#" class="footer-link hover:text-brand-600 dark:hover:text-brand-400">Privacy Notice</a>
                        <a href="#" class="footer-link hover:text-brand-600 dark:hover:text-brand-400">Terms of Service</a>
                        <a href="#" class="footer-link hover:text-brand-600 dark:hover:text-brand-400">Cookie Policy</a>
                        <a href="#" class="footer-link hover:text-brand-600 dark:hover:text-brand-400">Bug Report</a>
                    </div>
                    <div class="text-center md:text-right">
                        <p class="text-xs text-gray-600 dark:text-gray-400">
                            © {{ date('Y') }} <span class="font-semibold gradient-text">DataSphere</span> ML Repository
                        </p>
                        <p class="text-xs text-gray-500 dark:text-gray-500 mt-1">
                            Kelompok 6 • Pemrograman Web Lanjutan • Universitas Sumatera Utara
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    
    
    
    <script>
        function toggleTheme() {
            const html = document.documentElement;
            const isDark = html.classList.toggle('dark');
            localStorage.setItem('datasphere-theme', isDark ? 'dark' : 'light');
        }
        function toggleMobileMenu() {
            const menu = document.getElementById('mobileMenu');
            menu.classList.toggle('active');
            
            if (menu.classList.contains('active')) {
                document.body.style.overflow = 'hidden';
            } else {
                document.body.style.overflow = '';
            }
        }
        function toggleMobileSearch() {
            const search = document.getElementById('mobileSearch');
            search.classList.toggle('hidden');
            if (!search.classList.contains('hidden')) {
                search.querySelector('input').focus();
            }
        }
        document.querySelectorAll('#mobileMenu a').forEach(link => {
            link.addEventListener('click', () => {
                if (!link.getAttribute('href')?.startsWith('#')) {
                    toggleMobileMenu();
                }
            });
        });
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                const menu = document.getElementById('mobileMenu');
                if (menu.classList.contains('active')) {
                    toggleMobileMenu();
                }
            }
        });
        const navbar = document.getElementById('mainNavbar');
        let lastScroll = 0;
        
        function handleScroll() {
            const currentScroll = window.pageYOffset;
            
            if (currentScroll > 10) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
            
            lastScroll = currentScroll;
        }
        window.addEventListener('scroll', handleScroll, { passive: true });
        handleScroll(); // Check initial scroll position
        document.querySelectorAll('.flash-message').forEach(msg => {
            setTimeout(() => {
                msg.style.transition = 'all 0.4s ease';
                msg.style.opacity = '0';
                msg.style.transform = 'translateX(100%)';
                setTimeout(() => msg.remove(), 400);
            }, 5000);
        });
        const newsletterForm = document.getElementById('newsletterForm');
        const newsletterBtn = document.getElementById('newsletterBtn');
        
        if (newsletterForm) {
            newsletterForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const email = this.querySelector('input[name="email"]').value;
                const btnText = newsletterBtn.querySelector('.btn-text');
                const originalText = btnText.textContent;
                
                newsletterBtn.classList.add('loading');
                
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                
                fetch(this.action, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ email: email })
                })
                .then(response => response.json())
                .then(data => {
                    newsletterBtn.classList.remove('loading');
                    
                    if (data.success) {
                        btnText.textContent = '✓ Subscribed!';
                        newsletterBtn.classList.remove('from-brand-600', 'to-sphere-secondary');
                        newsletterBtn.classList.add('from-green-500', 'to-emerald-600');
                        
                        showFlashMessage('success', data.message || 'Thank you for subscribing!');
                        
                        newsletterForm.reset();
                        
                        setTimeout(() => {
                            btnText.textContent = originalText;
                            newsletterBtn.classList.remove('from-green-500', 'to-emerald-600');
                            newsletterBtn.classList.add('from-brand-600', 'to-sphere-secondary');
                        }, 3000);
                    } else {
                        btnText.textContent = 'Try Again';
                        showFlashMessage('error', data.message || 'Failed to subscribe.');
                        
                        setTimeout(() => {
                            btnText.textContent = originalText;
                        }, 3000);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    newsletterBtn.classList.remove('loading');
                    btnText.textContent = 'Error';
                    showFlashMessage('error', 'Network error. Please check your connection.');
                    
                    setTimeout(() => {
                        btnText.textContent = originalText;
                    }, 3000);
                });
            });
        }
        function showFlashMessage(type, message) {
            const flashContainer = document.createElement('div');
            flashContainer.className = 'flash-message fixed top-20 right-4 z-[1200] max-w-sm';
            
            const bgColor = type === 'success' 
                ? 'bg-green-50 dark:bg-green-900/30 border-green-200 dark:border-green-800 text-green-800 dark:text-green-200'
                : 'bg-red-50 dark:bg-red-900/30 border-red-200 dark:border-red-800 text-red-800 dark:text-red-200';
            
            const iconColor = type === 'success' ? 'text-green-500' : 'text-red-500';
            const iconName = type === 'success' ? 'bi-check-circle-fill' : 'bi-exclamation-triangle-fill';
            
            flashContainer.innerHTML = `
                <div class="${bgColor} border px-4 py-3 rounded-xl shadow-lg flex items-start gap-3">
                    <i class="bi ${iconName} ${iconColor} text-xl mt-0.5"></i>
                    <div class="flex-1 text-sm font-medium">${message}</div>
                    <button onclick="this.parentElement.parentElement.remove()" class="${iconColor} hover:opacity-70">
                        <i class="bi bi-x-lg"></i>
                    </button>
                </div>
            `;
            
            document.body.appendChild(flashContainer);
            
            setTimeout(() => {
                flashContainer.style.transition = 'all 0.4s ease';
                flashContainer.style.opacity = '0';
                flashContainer.style.transform = 'translateX(100%)';
                setTimeout(() => flashContainer.remove(), 400);
            }, 5000);
        }
    </script>
    
    @stack('scripts')
</body>
</html>