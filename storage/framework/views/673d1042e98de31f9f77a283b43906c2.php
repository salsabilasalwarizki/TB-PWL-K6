<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title', 'Admin Dashboard'); ?> — DataSphere</title>
    
    <!-- Preconnect & Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'system-ui', 'sans-serif'],
                        mono: ['JetBrains Mono', 'monospace'],
                    },
                    colors: {
                        brand: {
                            50:  '#f0f7ff', 100: '#e0effe', 200: '#bae0fd', 300: '#7cc8fb',
                            400: '#36adf6', 500: '#0c93e7', 600: '#0074c5', 700: '#015c9f',
                            800: '#064f83', 900: '#0b426d', 950: '#072a49',
                        },
                        sphere: {
                            50:  '#f5f3ff', 100: '#ede9fe', 200: '#ddd6fe', 300: '#c4b5fd',
                            400: '#a78bfa', 500: '#8b5cf6', 600: '#7c3aed', 700: '#6d28d9',
                            800: '#5b21b6', 900: '#4c1d95',
                        },
                        ink: {
                            50:  '#f8fafc', 100: '#f1f5f9', 200: '#e2e8f0', 300: '#cbd5e1',
                            400: '#94a3b8', 500: '#64748b', 600: '#475569', 700: '#334155',
                            800: '#1e293b', 900: '#0f172a', 950: '#020617',
                        }
                    },
                    boxShadow: {
                        'soft':   '0 1px 2px 0 rgb(0 0 0 / 0.04)',
                        'card':   '0 1px 3px 0 rgb(0 0 0 / 0.04), 0 1px 2px -1px rgb(0 0 0 / 0.04)',
                        'elev':   '0 4px 6px -1px rgb(0 0 0 / 0.05), 0 2px 4px -2px rgb(0 0 0 / 0.05)',
                        'float':  '0 10px 15px -3px rgb(0 0 0 / 0.08), 0 4px 6px -4px rgb(0 0 0 / 0.05)',
                        'glow-b': '0 0 0 4px rgb(12 147 231 / 0.12)',
                        'glow-v': '0 0 0 4px rgb(139 92 246 / 0.12)',
                    },
                    animation: {
                        'fade-in':    'fadeIn 0.4s ease-out',
                        'slide-up':   'slideUp 0.4s ease-out',
                        'slide-in':   'slideIn 0.3s ease-out',
                        'scale-in':   'scaleIn 0.2s ease-out',
                        'pulse-soft': 'pulseSoft 2s ease-in-out infinite',
                        'spin-slow':  'spin 3s linear infinite',
                    },
                    keyframes: {
                        fadeIn:    { '0%': { opacity: '0' }, '100%': { opacity: '1' } },
                        slideUp:   { '0%': { opacity: '0', transform: 'translateY(12px)' }, '100%': { opacity: '1', transform: 'translateY(0)' } },
                        slideIn:   { '0%': { opacity: '0', transform: 'translateX(-8px)' }, '100%': { opacity: '1', transform: 'translateX(0)' } },
                        scaleIn:   { '0%': { opacity: '0', transform: 'scale(0.95)' }, '100%': { opacity: '1', transform: 'scale(1)' } },
                        pulseSoft: { '0%,100%': { opacity: '1' }, '50%': { opacity: '.6' } },
                    }
                }
            }
        }
    </script>
    
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    
    <style>
        :root {
            --sidebar-w: 264px;
            --sidebar-w-collapsed: 76px;
            --header-h: 68px;
        }
        
        html, body { height: 100%; }
        body { font-family: 'Inter', system-ui, sans-serif; -webkit-font-smoothing: antialiased; }
        
        /* Scrollbar */
        ::-webkit-scrollbar { width: 10px; height: 10px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: rgb(203 213 225 / 0.5); border-radius: 10px; border: 2px solid transparent; background-clip: padding-box; }
        ::-webkit-scrollbar-thumb:hover { background: rgb(148 163 184 / 0.7); background-clip: padding-box; border: 2px solid transparent; }
        .dark ::-webkit-scrollbar-thumb { background: rgb(51 65 85 / 0.5); background-clip: padding-box; border: 2px solid transparent; }
        .dark ::-webkit-scrollbar-thumb:hover { background: rgb(71 85 105 / 0.7); background-clip: padding-box; border: 2px solid transparent; }
        
        .sidebar-scroll::-webkit-scrollbar { width: 6px; }
        .sidebar-scroll::-webkit-scrollbar-thumb { background: rgb(255 255 255 / 0.15); background-clip: padding-box; border: 2px solid transparent; }
        .sidebar-scroll::-webkit-scrollbar-thumb:hover { background: rgb(255 255 255 / 0.3); background-clip: padding-box; border: 2px solid transparent; }
        
        /* Sidebar */
        .sidebar {
            position: fixed;
            inset: 0 auto 0 0;
            width: var(--sidebar-w);
            z-index: 40;
            transition: transform .3s cubic-bezier(.4,0,.2,1), width .3s cubic-bezier(.4,0,.2,1);
        }
        
        .main-wrapper {
            margin-left: var(--sidebar-w);
            min-height: 100vh;
            transition: margin-left .3s cubic-bezier(.4,0,.2,1);
            display: flex;
            flex-direction: column;
        }
        
        /* Grid background */
        .bg-grid {
            background-image: radial-gradient(circle at 1px 1px, rgb(148 163 184 / 0.15) 1px, transparent 0);
            background-size: 24px 24px;
        }
        .dark .bg-grid {
            background-image: radial-gradient(circle at 1px 1px, rgb(51 65 85 / 0.4) 1px, transparent 0);
        }
        
        .sidebar-glow::before {
            content: '';
            position: absolute;
            top: -120px; left: 50%;
            transform: translateX(-50%);
            width: 400px; height: 400px;
            background: radial-gradient(circle, rgb(139 92 246 / 0.25) 0%, transparent 70%);
            pointer-events: none;
        }
        
        /* Mobile */
        @media (max-width: 1023px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.open { transform: translateX(0); }
            .main-wrapper { margin-left: 0; }
        }
        
        /* Collapsed state */
        @media (min-width: 1024px) {
            .sidebar.collapsed { width: var(--sidebar-w-collapsed); }
            .sidebar.collapsed .sidebar-label,
            .sidebar.collapsed .sidebar-section-title,
            .sidebar.collapsed .sidebar-badge,
            .sidebar.collapsed .sidebar-subtitle { display: none; }
            .sidebar.collapsed .sidebar-item { justify-content: center; padding-left: 0; padding-right: 0; }
            .sidebar.collapsed .brand-text { display: none; }
            .main-wrapper.sidebar-collapsed { margin-left: var(--sidebar-w-collapsed); }
        }
        
        .focus-ring:focus-visible {
            outline: none;
            box-shadow: 0 0 0 3px rgb(12 147 231 / 0.25);
            border-radius: 8px;
        }
        
        .nav-item {
            position: relative;
            transition: all .2s ease;
        }
        .nav-item::before {
            content: '';
            position: absolute;
            left: 0; top: 50%;
            transform: translateY(-50%) scaleY(0);
            width: 3px; height: 24px;
            background: linear-gradient(180deg, #36adf6, #8b5cf6);
            border-radius: 0 3px 3px 0;
            transition: transform .25s cubic-bezier(.4,0,.2,1);
        }
        .nav-item.active::before { transform: translateY(-50%) scaleY(1); }
        
        .hover-lift { transition: transform .25s ease, box-shadow .25s ease; }
        .hover-lift:hover { transform: translateY(-2px); }
        
        /* Loading Overlay */
        .loading-overlay {
            position: fixed;
            inset: 0;
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(4px);
            z-index: 9999;
            display: none;
            align-items: center;
            justify-content: center;
        }
        .loading-overlay.active { display: flex; }
        .dark .loading-overlay { background: rgba(15, 23, 42, 0.8); }
        
        /* Command Palette */
        .cmd-palette {
            position: fixed;
            inset: 0;
            z-index: 9998;
            display: none;
            align-items: flex-start;
            justify-content: center;
            padding-top: 20vh;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(8px);
        }
        .cmd-palette.active { display: flex; }
        
        /* Toast Container */
        .toast-container {
            position: fixed;
            top: calc(var(--header-h) + 1rem);
            right: 1rem;
            z-index: 9997;
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
            max-width: 400px;
        }
        
        /* Tooltip */
        [data-tooltip] { position: relative; }
        [data-tooltip]:hover::after {
            content: attr(data-tooltip);
            position: absolute;
            left: 100%;
            top: 50%;
            transform: translateY(-50%);
            margin-left: 8px;
            padding: 4px 10px;
            background: rgb(15 23 42);
            color: white;
            font-size: 11px;
            font-weight: 500;
            border-radius: 6px;
            white-space: nowrap;
            z-index: 50;
            pointer-events: none;
        }
        .sidebar.collapsed [data-tooltip]:hover::after { display: block; }
    </style>
    
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>

<body class="bg-slate-50 dark:bg-ink-950 text-ink-900 dark:text-ink-100 antialiased">

    <!-- ============== LOADING OVERLAY ============== -->
    <div id="loadingOverlay" class="loading-overlay">
        <div class="text-center">
            <div class="relative w-16 h-16 mx-auto mb-4">
                <div class="absolute inset-0 rounded-full border-4 border-brand-200 dark:border-brand-900"></div>
                <div class="absolute inset-0 rounded-full border-4 border-transparent border-t-brand-500 animate-spin"></div>
            </div>
            <p class="text-sm font-medium text-ink-600 dark:text-ink-400">Loading...</p>
        </div>
    </div>

    <!-- ============== COMMAND PALETTE ============== -->
    <div id="cmdPalette" class="cmd-palette" onclick="if(event.target === this) closeCmdPalette()">
        <div class="w-full max-w-2xl bg-white dark:bg-ink-900 rounded-2xl shadow-float border border-slate-200 dark:border-ink-800 overflow-hidden animate-scale-in mx-4">
            <!-- Search -->
            <div class="p-4 border-b border-slate-200 dark:border-ink-800">
                <div class="relative">
                    <i class="bi bi-search absolute left-4 top-1/2 -translate-y-1/2 text-ink-400"></i>
                    <input type="text" id="cmdInput" placeholder="Type a command or search..." 
                           class="w-full pl-12 pr-4 py-3 bg-transparent text-ink-900 dark:text-white placeholder-ink-400 focus:outline-none text-base"
                           autocomplete="off">
                </div>
            </div>
            
            <!-- Results -->
            <div id="cmdResults" class="max-h-96 overflow-y-auto p-2">
                <!-- Quick Actions -->
                <div class="cmd-section">
                    <p class="px-3 py-2 text-[10px] font-bold uppercase tracking-wider text-ink-500 dark:text-ink-400">Quick Actions</p>
                    <a href="<?php echo e(route('admin.dashboard')); ?>" class="cmd-item flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-slate-100 dark:hover:bg-ink-800 transition-colors">
                        <div class="w-8 h-8 rounded-lg bg-brand-100 dark:bg-brand-900/30 flex items-center justify-center">
                            <i class="bi bi-speedometer2 text-brand-600 dark:text-brand-400"></i>
                        </div>
                        <span class="flex-1 text-sm font-medium text-ink-900 dark:text-white">Go to Dashboard</span>
                        <kbd class="text-[10px] text-ink-500 bg-slate-100 dark:bg-ink-800 px-1.5 py-0.5 rounded">⌘1</kbd>
                    </a>
                    <a href="<?php echo e(route('admin.datasets.index')); ?>" class="cmd-item flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-slate-100 dark:hover:bg-ink-800 transition-colors">
                        <div class="w-8 h-8 rounded-lg bg-emerald-100 dark:bg-emerald-900/30 flex items-center justify-center">
                            <i class="bi bi-stack text-emerald-600 dark:text-emerald-400"></i>
                        </div>
                        <span class="flex-1 text-sm font-medium text-ink-900 dark:text-white">Manage Datasets</span>
                        <kbd class="text-[10px] text-ink-500 bg-slate-100 dark:bg-ink-800 px-1.5 py-0.5 rounded">⌘2</kbd>
                    </a>
                    <a href="<?php echo e(route('admin.posts.index')); ?>" class="cmd-item flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-slate-100 dark:hover:bg-ink-800 transition-colors">
                        <div class="w-8 h-8 rounded-lg bg-purple-100 dark:bg-purple-900/30 flex items-center justify-center">
                            <i class="bi bi-journal-text text-purple-600 dark:text-purple-400"></i>
                        </div>
                        <span class="flex-1 text-sm font-medium text-ink-900 dark:text-white">Manage Posts</span>
                        <kbd class="text-[10px] text-ink-500 bg-slate-100 dark:bg-ink-800 px-1.5 py-0.5 rounded">⌘3</kbd>
                    </a>
                    <a href="<?php echo e(route('admin.users.index')); ?>" class="cmd-item flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-slate-100 dark:hover:bg-ink-800 transition-colors">
                        <div class="w-8 h-8 rounded-lg bg-cyan-100 dark:bg-cyan-900/30 flex items-center justify-center">
                            <i class="bi bi-people text-cyan-600 dark:text-cyan-400"></i>
                        </div>
                        <span class="flex-1 text-sm font-medium text-ink-900 dark:text-white">Manage Users</span>
                        <kbd class="text-[10px] text-ink-500 bg-slate-100 dark:bg-ink-800 px-1.5 py-0.5 rounded">⌘4</kbd>
                    </a>
                </div>
                
                <!-- Navigation -->
                <div class="cmd-section mt-2">
                    <p class="px-3 py-2 text-[10px] font-bold uppercase tracking-wider text-ink-500 dark:text-ink-400">Navigation</p>
                    <a href="<?php echo e(route('home')); ?>" class="cmd-item flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-slate-100 dark:hover:bg-ink-800 transition-colors">
                        <div class="w-8 h-8 rounded-lg bg-slate-100 dark:bg-ink-800 flex items-center justify-center">
                            <i class="bi bi-house text-ink-600 dark:text-ink-400"></i>
                        </div>
                        <span class="flex-1 text-sm font-medium text-ink-900 dark:text-white">Public Site</span>
                        <i class="bi bi-arrow-up-right text-xs text-ink-400"></i>
                    </a>
                    <a href="<?php echo e(route('profile')); ?>" class="cmd-item flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-slate-100 dark:hover:bg-ink-800 transition-colors">
                        <div class="w-8 h-8 rounded-lg bg-slate-100 dark:bg-ink-800 flex items-center justify-center">
                            <i class="bi bi-person-circle text-ink-600 dark:text-ink-400"></i>
                        </div>
                        <span class="flex-1 text-sm font-medium text-ink-900 dark:text-white">My Profile</span>
                    </a>
                </div>
                
                <!-- Actions -->
                <div class="cmd-section mt-2">
                    <p class="px-3 py-2 text-[10px] font-bold uppercase tracking-wider text-ink-500 dark:text-ink-400">Actions</p>
                    <button onclick="toggleTheme(); closeCmdPalette()" class="cmd-item w-full flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-slate-100 dark:hover:bg-ink-800 transition-colors text-left">
                        <div class="w-8 h-8 rounded-lg bg-amber-100 dark:bg-amber-900/30 flex items-center justify-center">
                            <i class="bi bi-moon-stars text-amber-600 dark:text-amber-400"></i>
                        </div>
                        <span class="flex-1 text-sm font-medium text-ink-900 dark:text-white">Toggle Dark Mode</span>
                        <kbd class="text-[10px] text-ink-500 bg-slate-100 dark:bg-ink-800 px-1.5 py-0.5 rounded">⌘D</kbd>
                    </button>
                    <form method="POST" action="<?php echo e(route('logout')); ?>">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="cmd-item w-full flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors text-left">
                            <div class="w-8 h-8 rounded-lg bg-red-100 dark:bg-red-900/30 flex items-center justify-center">
                                <i class="bi bi-box-arrow-right text-red-600 dark:text-red-400"></i>
                            </div>
                            <span class="flex-1 text-sm font-medium text-red-600 dark:text-red-400">Sign Out</span>
                            <kbd class="text-[10px] text-ink-500 bg-slate-100 dark:bg-ink-800 px-1.5 py-0.5 rounded">⌘Q</kbd>
                        </button>
                    </form>
                </div>
            </div>
            
            <!-- Footer -->
            <div class="p-3 border-t border-slate-200 dark:border-ink-800 bg-slate-50 dark:bg-ink-950/50 flex items-center justify-between text-[11px] text-ink-500">
                <div class="flex items-center gap-3">
                    <span class="flex items-center gap-1"><kbd class="px-1.5 py-0.5 bg-white dark:bg-ink-800 border border-slate-200 dark:border-ink-700 rounded">↑↓</kbd> Navigate</span>
                    <span class="flex items-center gap-1"><kbd class="px-1.5 py-0.5 bg-white dark:bg-ink-800 border border-slate-200 dark:border-ink-700 rounded">↵</kbd> Select</span>
                    <span class="flex items-center gap-1"><kbd class="px-1.5 py-0.5 bg-white dark:bg-ink-800 border border-slate-200 dark:border-ink-700 rounded">Esc</kbd> Close</span>
                </div>
                <span class="text-ink-400">DataSphere Admin v2.0</span>
            </div>
        </div>
    </div>

    <!-- ============== TOAST CONTAINER ============== -->
    <div id="toastContainer" class="toast-container"></div>

    <!-- ============== SIDEBAR ============== -->
    <aside id="sidebar" class="sidebar bg-ink-900 dark:bg-ink-950 text-white sidebar-glow overflow-hidden border-r border-white/5 flex flex-col">
        
        <!-- Brand -->
        <div class="px-5 h-[var(--header-h)] flex items-center gap-3 border-b border-white/5 relative z-10 shrink-0">
            <div class="relative shrink-0">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-brand-400 via-brand-500 to-sphere-500 flex items-center justify-center shadow-lg shadow-brand-500/30">
                    <i class="bi bi-hexagon-fill text-white text-lg"></i>
                </div>
                <span class="absolute -top-1 -right-1 w-3 h-3 rounded-full bg-emerald-400 ring-2 ring-ink-900 animate-pulse-soft"></span>
            </div>
            <div class="brand-text overflow-hidden">
                <h5 class="text-[15px] font-bold tracking-tight leading-tight">DataSphere</h5>
                <p class="text-[11px] text-white/50 font-medium leading-tight mt-0.5">Admin Console</p>
            </div>
        </div>
        
        <!-- User mini card -->
        <?php if(auth()->guard()->check()): ?>
        <div class="px-4 py-4 border-b border-white/5 shrink-0">
            <div class="flex items-center gap-3 p-2 rounded-xl bg-white/5 hover:bg-white/10 transition-colors">
                <div class="w-9 h-9 rounded-lg bg-gradient-to-br from-brand-400 to-sphere-500 flex items-center justify-center text-sm font-bold shadow-inner shrink-0">
                    <?php echo e(strtoupper(substr(auth()->user()->name, 0, 1))); ?>

                </div>
                <div class="brand-text flex-1 min-w-0">
                    <p class="text-sm font-semibold truncate leading-tight"><?php echo e(auth()->user()->name); ?></p>
                    <p class="text-[11px] text-white/50 truncate leading-tight mt-0.5"><?php echo e(ucfirst(auth()->user()->role ?? 'admin')); ?></p>
                </div>
            </div>
        </div>
        <?php endif; ?>
        
        <!-- Navigation -->
        <nav class="flex-1 overflow-y-auto sidebar-scroll px-3 py-4 space-y-6">
            
            <!-- Main Section -->
            <div>
                <p class="sidebar-section-title px-3 mb-2 text-[10px] font-bold uppercase tracking-wider text-white/40">Main</p>
                
                <a href="<?php echo e(route('admin.dashboard')); ?>" data-tooltip="Dashboard"
                   class="nav-item sidebar-item flex items-center gap-3 px-3 py-2.5 rounded-lg text-[13px] font-medium text-white/70 hover:text-white hover:bg-white/5 transition-colors <?php echo e(request()->routeIs('admin.dashboard') ? 'active text-white bg-white/10' : ''); ?>">
                    <i class="bi bi-grid-1x2-fill text-[17px] w-5 text-center"></i>
                    <span class="sidebar-label flex-1">Dashboard</span>
                </a>
                
                <a href="<?php echo e(route('admin.datasets.index')); ?>" data-tooltip="Datasets"
                   class="nav-item sidebar-item flex items-center gap-3 px-3 py-2.5 rounded-lg text-[13px] font-medium text-white/70 hover:text-white hover:bg-white/5 transition-colors <?php echo e(request()->routeIs('admin.datasets.*') ? 'active text-white bg-white/10' : ''); ?>">
                    <i class="bi bi-stack text-[17px] w-5 text-center"></i>
                    <span class="sidebar-label flex-1">Datasets</span>
                    <?php $pendingCount = \App\Models\Dataset::where('status', 'pending')->count(); ?>
                    <?php if($pendingCount > 0): ?>
                    <span class="sidebar-badge inline-flex items-center justify-center min-w-[20px] h-5 px-1.5 text-[10px] font-bold rounded-md bg-gradient-to-r from-amber-400 to-orange-500 text-ink-900 shadow-sm"><?php echo e($pendingCount); ?></span>
                    <?php endif; ?>
                </a>
                
                <a href="<?php echo e(route('admin.users.index')); ?>" data-tooltip="Users"
                   class="nav-item sidebar-item flex items-center gap-3 px-3 py-2.5 rounded-lg text-[13px] font-medium text-white/70 hover:text-white hover:bg-white/5 transition-colors <?php echo e(request()->routeIs('admin.users.*') ? 'active text-white bg-white/10' : ''); ?>">
                    <i class="bi bi-people-fill text-[17px] w-5 text-center"></i>
                    <span class="sidebar-label flex-1">Users</span>
                </a>
                
                <a href="<?php echo e(route('admin.statistics')); ?>" data-tooltip="Analytics"
                   class="nav-item sidebar-item flex items-center gap-3 px-3 py-2.5 rounded-lg text-[13px] font-medium text-white/70 hover:text-white hover:bg-white/5 transition-colors <?php echo e(request()->routeIs('admin.statistics') ? 'active text-white bg-white/10' : ''); ?>">
                    <i class="bi bi-bar-chart-line-fill text-[17px] w-5 text-center"></i>
                    <span class="sidebar-label flex-1">Analytics</span>
                </a>
            </div>
            
            <!-- Content Section -->
            <div>
                <p class="sidebar-section-title px-3 mb-2 text-[10px] font-bold uppercase tracking-wider text-white/40">Content</p>
                
                <a href="<?php echo e(route('admin.posts.index')); ?>" data-tooltip="Posts"
                   class="nav-item sidebar-item flex items-center gap-3 px-3 py-2.5 rounded-lg text-[13px] font-medium text-white/70 hover:text-white hover:bg-white/5 transition-colors <?php echo e(request()->routeIs('admin.posts.*') ? 'active text-white bg-white/10' : ''); ?>">
                    <i class="bi bi-journal-text text-[17px] w-5 text-center"></i>
                    <span class="sidebar-label flex-1">Posts</span>
                    <?php if(class_exists('\App\Models\Post')): ?>
                        <?php $postsCount = \App\Models\Post::count(); ?>
                        <?php if($postsCount > 0): ?>
                        <span class="sidebar-badge inline-flex items-center justify-center min-w-[20px] h-5 px-1.5 text-[10px] font-bold rounded-md bg-white/10 text-white/80"><?php echo e($postsCount); ?></span>
                        <?php endif; ?>
                    <?php endif; ?>
                </a>
                
                <a href="<?php echo e(route('admin.categories.index')); ?>" data-tooltip="Categories"
                   class="nav-item sidebar-item flex items-center gap-3 px-3 py-2.5 rounded-lg text-[13px] font-medium text-white/70 hover:text-white hover:bg-white/5 transition-colors <?php echo e(request()->routeIs('admin.categories.*') ? 'active text-white bg-white/10' : ''); ?>">
                    <i class="bi bi-tags-fill text-[17px] w-5 text-center"></i>
                    <span class="sidebar-label flex-1">Categories</span>
                </a>
                
                <a href="<?php echo e(route('datasets.index')); ?>" data-tooltip="Public Site"
                   class="nav-item sidebar-item flex items-center gap-3 px-3 py-2.5 rounded-lg text-[13px] font-medium text-white/70 hover:text-white hover:bg-white/5 transition-colors">
                    <i class="bi bi-globe2 text-[17px] w-5 text-center"></i>
                    <span class="sidebar-label flex-1">Public Site</span>
                    <i class="bi bi-arrow-up-right text-[11px] text-white/40 sidebar-label"></i>
                </a>
            </div>
            
            <!-- System Section -->
            <div>
                <p class="sidebar-section-title px-3 mb-2 text-[10px] font-bold uppercase tracking-wider text-white/40">System</p>
                
                <a href="<?php echo e(route('profile')); ?>" data-tooltip="Settings"
                   class="nav-item sidebar-item flex items-center gap-3 px-3 py-2.5 rounded-lg text-[13px] font-medium text-white/70 hover:text-white hover:bg-white/5 transition-colors">
                    <i class="bi bi-gear-fill text-[17px] w-5 text-center"></i>
                    <span class="sidebar-label flex-1">Settings</span>
                </a>
                
                <button onclick="openCmdPalette()" data-tooltip="Command Palette"
                   class="sidebar-item w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-[13px] font-medium text-white/70 hover:text-white hover:bg-white/5 transition-colors text-left">
                    <i class="bi bi-terminal text-[17px] w-5 text-center"></i>
                    <span class="sidebar-label flex-1">Commands</span>
                    <kbd class="sidebar-label text-[9px] text-white/40 bg-white/10 px-1.5 py-0.5 rounded">⌘K</kbd>
                </button>
            </div>
        </nav>
        
        <!-- Footer -->
        <div class="px-3 py-3 border-t border-white/5 shrink-0">
            <form method="POST" action="<?php echo e(route('logout')); ?>">
                <?php echo csrf_field(); ?>
                <button type="submit" 
                        class="sidebar-item w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-[13px] font-medium text-white/60 hover:text-red-300 hover:bg-red-500/10 transition-colors">
                    <i class="bi bi-box-arrow-left text-[17px] w-5 text-center"></i>
                    <span class="sidebar-label flex-1 text-left">Sign out</span>
                </button>
            </form>
            
            <p class="sidebar-subtitle px-3 mt-3 text-[10px] text-white/30">© <?php echo e(date('Y')); ?> DataSphere v2.0</p>
        </div>
    </aside>
    
    <!-- Mobile overlay -->
    <div id="sidebarOverlay" class="fixed inset-0 bg-ink-950/60 backdrop-blur-sm z-30 lg:hidden hidden"></div>

    <!-- ============== MAIN ============== -->
    <div id="mainWrapper" class="main-wrapper">
        
        <!-- Topbar -->
        <header class="sticky top-0 z-20 h-[var(--header-h)] bg-white/80 dark:bg-ink-900/80 backdrop-blur-xl border-b border-slate-200/60 dark:border-ink-800/60 px-4 sm:px-6 flex items-center justify-between gap-4 shrink-0">
            
            <div class="flex items-center gap-3 flex-1 min-w-0">
                <!-- Sidebar toggle mobile -->
                <button id="sidebarToggle" class="lg:hidden p-2 -ml-2 rounded-lg hover:bg-slate-100 dark:hover:bg-ink-800 transition-colors focus-ring">
                    <i class="bi bi-list text-xl text-ink-700 dark:text-ink-300"></i>
                </button>
                
                <!-- Desktop collapse -->
                <button id="sidebarCollapse" class="hidden lg:flex p-2 -ml-2 rounded-lg hover:bg-slate-100 dark:hover:bg-ink-800 transition-colors focus-ring">
                    <i class="bi bi-layout-sidebar-inset text-xl text-ink-700 dark:text-ink-300"></i>
                </button>
                
                <!-- Breadcrumb / Title -->
                <div class="hidden sm:block min-w-0">
                    <h1 class="text-[15px] font-bold text-ink-900 dark:text-white truncate leading-tight">
                        <?php echo $__env->yieldContent('page-title', 'Dashboard'); ?>
                    </h1>
                    <div class="flex items-center gap-1.5 text-[11px] text-ink-500 mt-0.5">
                        <i class="bi bi-house-fill text-[10px]"></i>
                        <span>Admin</span>
                        <i class="bi bi-chevron-right text-[8px]"></i>
                        <span class="text-ink-700 dark:text-ink-300 font-medium truncate"><?php echo $__env->yieldContent('page-title', 'Dashboard'); ?></span>
                    </div>
                </div>
            </div>
            
            <!-- Search Bar (Desktop) -->
            <div class="hidden md:block flex-shrink-0">
                <button onclick="openCmdPalette()" 
                        class="flex items-center gap-2 px-4 py-2 rounded-xl bg-slate-100 dark:bg-ink-800 hover:bg-slate-200 dark:hover:bg-ink-700 transition-colors border border-transparent hover:border-slate-300 dark:hover:border-ink-700 group">
                    <i class="bi bi-search text-sm text-ink-400"></i>
                    <span class="text-sm text-ink-500 dark:text-ink-400">Search or command...</span>
                    <kbd class="text-[10px] text-ink-500 bg-white dark:bg-ink-900 border border-slate-200 dark:border-ink-700 px-1.5 py-0.5 rounded ml-2 group-hover:border-brand-500 transition-colors">⌘K</kbd>
                </button>
            </div>
            
            <!-- Right actions -->
            <div class="flex items-center gap-1.5">
                
                <!-- Theme Toggle -->
                <button onclick="toggleTheme()" class="p-2 rounded-lg hover:bg-slate-100 dark:hover:bg-ink-800 transition-colors focus-ring" title="Toggle theme">
                    <i class="bi bi-moon-stars-fill text-[18px] text-ink-600 dark:text-ink-300 dark:hidden"></i>
                    <i class="bi bi-sun-fill text-[18px] text-amber-400 hidden dark:block"></i>
                </button>
                
                <!-- Notifications -->
                <?php $pendingCount = \App\Models\Dataset::where('status', 'pending')->count(); ?>
                <div class="relative">
                    <button id="notifBtn" class="relative p-2 rounded-lg hover:bg-slate-100 dark:hover:bg-ink-800 transition-colors focus-ring">
                        <i class="bi bi-bell text-[18px] text-ink-600 dark:text-ink-300"></i>
                        <?php if($pendingCount > 0): ?>
                        <span class="absolute top-1 right-1 flex h-2 w-2">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-red-500"></span>
                        </span>
                        <?php endif; ?>
                    </button>
                    
                    <div id="notifDropdown" class="hidden absolute right-0 mt-2 w-80 bg-white dark:bg-ink-900 rounded-xl shadow-float border border-slate-200 dark:border-ink-800 overflow-hidden animate-scale-in origin-top-right">
                        <div class="px-4 py-3 border-b border-slate-200 dark:border-ink-800 flex items-center justify-between">
                            <h6 class="text-sm font-bold text-ink-900 dark:text-white">Notifications</h6>
                            <?php if($pendingCount > 0): ?>
                            <span class="text-[10px] font-bold text-brand-700 dark:text-brand-400 bg-brand-100 dark:bg-brand-900/30 px-2 py-0.5 rounded-full"><?php echo e($pendingCount); ?> new</span>
                            <?php endif; ?>
                        </div>
                        <div class="max-h-80 overflow-y-auto">
                            <?php if($pendingCount > 0): ?>
                            <a href="<?php echo e(route('admin.datasets.index', ['status' => 'pending'])); ?>" class="flex gap-3 p-4 hover:bg-slate-50 dark:hover:bg-ink-800/50 transition-colors border-b border-slate-100 dark:border-ink-800">
                                <div class="w-9 h-9 rounded-lg bg-amber-100 dark:bg-amber-900/30 flex items-center justify-center shrink-0">
                                    <i class="bi bi-hourglass-split text-amber-600 dark:text-amber-400"></i>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-semibold text-ink-900 dark:text-white leading-tight">Pending Review</p>
                                    <p class="text-xs text-ink-500 mt-0.5"><?php echo e($pendingCount); ?> dataset(s) waiting for approval</p>
                                    <p class="text-[10px] text-ink-400 mt-1">Just now</p>
                                </div>
                            </a>
                            <?php endif; ?>
                            <a href="#" class="flex gap-3 p-4 hover:bg-slate-50 dark:hover:bg-ink-800/50 transition-colors">
                                <div class="w-9 h-9 rounded-lg bg-emerald-100 dark:bg-emerald-900/30 flex items-center justify-center shrink-0">
                                    <i class="bi bi-check2-circle text-emerald-600 dark:text-emerald-400"></i>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-semibold text-ink-900 dark:text-white leading-tight">System Online</p>
                                    <p class="text-xs text-ink-500 mt-0.5">All services are operational</p>
                                    <p class="text-[10px] text-ink-400 mt-1">2h ago</p>
                                </div>
                            </a>
                        </div>
                        <a href="<?php echo e(route('admin.datasets.index')); ?>" class="block px-4 py-2.5 text-center text-xs font-semibold text-brand-600 dark:text-brand-400 hover:bg-slate-50 dark:hover:bg-ink-800/50 transition-colors border-t border-slate-100 dark:border-ink-800">
                            View all notifications →
                        </a>
                    </div>
                </div>
                
                <div class="w-px h-6 bg-slate-200 dark:bg-ink-800 mx-1"></div>
                
                <!-- User menu -->
                <?php if(auth()->guard()->check()): ?>
                <div class="relative">
                    <button id="userBtn" class="flex items-center gap-2 p-1 pr-2 rounded-lg hover:bg-slate-100 dark:hover:bg-ink-800 transition-colors focus-ring">
                        <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-brand-500 to-sphere-500 flex items-center justify-center text-white text-xs font-bold shadow-sm ring-2 ring-white dark:ring-ink-900">
                            <?php echo e(strtoupper(substr(auth()->user()->name, 0, 1))); ?>

                        </div>
                        <div class="hidden sm:block text-left">
                            <p class="text-xs font-semibold text-ink-900 dark:text-white leading-tight"><?php echo e(auth()->user()->name); ?></p>
                            <p class="text-[10px] text-ink-500 leading-tight"><?php echo e(ucfirst(auth()->user()->role ?? 'admin')); ?></p>
                        </div>
                        <i class="bi bi-chevron-down text-[11px] text-ink-400 hidden sm:block"></i>
                    </button>
                    
                    <div id="userDropdown" class="hidden absolute right-0 mt-2 w-64 bg-white dark:bg-ink-900 rounded-xl shadow-float border border-slate-200 dark:border-ink-800 overflow-hidden animate-scale-in origin-top-right">
                        <div class="p-4 border-b border-slate-100 dark:border-ink-800 bg-gradient-to-br from-brand-50 to-sphere-50 dark:from-ink-800 dark:to-ink-800">
                            <p class="text-sm font-bold text-ink-900 dark:text-white truncate"><?php echo e(auth()->user()->name); ?></p>
                            <p class="text-xs text-ink-500 truncate mt-0.5"><?php echo e(auth()->user()->email); ?></p>
                            <span class="inline-block mt-2 px-2 py-0.5 text-[10px] font-bold bg-brand-500 text-white rounded-full">
                                <?php echo e(ucfirst(auth()->user()->role ?? 'admin')); ?>

                            </span>
                        </div>
                        <div class="p-1.5">
                            <a href="<?php echo e(route('profile')); ?>" class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-sm text-ink-700 dark:text-ink-300 hover:bg-slate-100 dark:hover:bg-ink-800 transition-colors">
                                <i class="bi bi-person text-[15px] text-ink-500"></i>
                                <span>My Profile</span>
                            </a>
                            <a href="<?php echo e(route('profile.datasets')); ?>" class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-sm text-ink-700 dark:text-ink-300 hover:bg-slate-100 dark:hover:bg-ink-800 transition-colors">
                                <i class="bi bi-collection text-[15px] text-ink-500"></i>
                                <span>My Datasets</span>
                            </a>
                            <a href="<?php echo e(route('home')); ?>" class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-sm text-ink-700 dark:text-ink-300 hover:bg-slate-100 dark:hover:bg-ink-800 transition-colors">
                                <i class="bi bi-house text-[15px] text-ink-500"></i>
                                <span>View Site</span>
                            </a>
                        </div>
                        <div class="p-1.5 border-t border-slate-100 dark:border-ink-800">
                            <form method="POST" action="<?php echo e(route('logout')); ?>">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="w-full flex items-center gap-2.5 px-3 py-2 rounded-lg text-sm text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors">
                                    <i class="bi bi-box-arrow-right text-[15px]"></i>
                                    <span>Sign out</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </header>
        
        <!-- Page content -->
        <main class="flex-1 p-4 sm:p-6 lg:p-8 bg-grid">
            
            <!-- Flash messages -->
            <?php if(session('success')): ?>
            <div class="mb-6 bg-emerald-50 dark:bg-emerald-900/20 border border-emerald-200 dark:border-emerald-800/50 rounded-xl p-4 flex items-start gap-3 animate-slide-up shadow-card">
                <div class="flex-shrink-0 w-9 h-9 rounded-lg bg-emerald-500 flex items-center justify-center shadow-sm shadow-emerald-500/30">
                    <i class="bi bi-check-lg text-lg text-white"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-bold text-emerald-900 dark:text-emerald-200 mb-0.5">Success</p>
                    <p class="text-sm text-emerald-800 dark:text-emerald-300"><?php echo e(session('success')); ?></p>
                </div>
                <button onclick="this.parentElement.remove()" class="flex-shrink-0 p-1 hover:bg-emerald-100 dark:hover:bg-emerald-900/40 rounded-lg transition-colors">
                    <i class="bi bi-x-lg text-emerald-600 dark:text-emerald-400 text-sm"></i>
                </button>
            </div>
            <?php endif; ?>
            
            <?php if(session('error')): ?>
            <div class="mb-6 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800/50 rounded-xl p-4 flex items-start gap-3 animate-slide-up shadow-card">
                <div class="flex-shrink-0 w-9 h-9 rounded-lg bg-red-500 flex items-center justify-center shadow-sm shadow-red-500/30">
                    <i class="bi bi-exclamation-lg text-lg text-white"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-bold text-red-900 dark:text-red-200 mb-0.5">Error</p>
                    <p class="text-sm text-red-800 dark:text-red-300"><?php echo e(session('error')); ?></p>
                </div>
                <button onclick="this.parentElement.remove()" class="flex-shrink-0 p-1 hover:bg-red-100 dark:hover:bg-red-900/40 rounded-lg transition-colors">
                    <i class="bi bi-x-lg text-red-600 dark:text-red-400 text-sm"></i>
                </button>
            </div>
            <?php endif; ?>
            
            <?php echo $__env->yieldContent('content'); ?>
        </main>
        
        <!-- Footer -->
        <footer class="border-t border-slate-200 dark:border-ink-800 bg-white/50 dark:bg-ink-900/50 backdrop-blur-sm px-4 sm:px-6 lg:px-8 py-4">
            <div class="flex flex-col sm:flex-row justify-between items-center gap-2 text-xs text-ink-500">
                <p>© <?php echo e(date('Y')); ?> <span class="font-semibold gradient-text">DataSphere</span> ML Repository</p>
                <div class="flex items-center gap-3">
                    <span class="flex items-center gap-1.5">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                        <span>System Online</span>
                    </span>
                    <span>•</span>
                    <span>Version 2.0</span>
                </div>
            </div>
        </footer>
    </div>
    
    <script>
        // ===== THEME TOGGLE =====
        function toggleTheme() {
            const html = document.documentElement;
            const isDark = html.classList.toggle('dark');
            localStorage.setItem('datasphere-admin-theme', isDark ? 'dark' : 'light');
        }
        
        // Init theme
        (function() {
            const theme = localStorage.getItem('datasphere-admin-theme') || 
                         (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
            if (theme === 'dark') document.documentElement.classList.add('dark');
        })();
        
        // ===== LOADING OVERLAY =====
        function showLoading() {
            document.getElementById('loadingOverlay').classList.add('active');
        }
        function hideLoading() {
            document.getElementById('loadingOverlay').classList.remove('active');
        }
        
        // ===== TOAST NOTIFICATIONS =====
        function showToast(message, type = 'success') {
            const container = document.getElementById('toastContainer');
            const toast = document.createElement('div');
            
            const colors = {
                success: 'bg-emerald-500',
                error: 'bg-red-500',
                warning: 'bg-amber-500',
                info: 'bg-brand-500'
            };
            
            const icons = {
                success: 'bi-check-lg',
                error: 'bi-exclamation-lg',
                warning: 'bi-exclamation-triangle',
                info: 'bi-info-lg'
            };
            
            toast.className = `flex items-center gap-3 p-4 rounded-xl shadow-float bg-white dark:bg-ink-900 border border-slate-200 dark:border-ink-800 animate-slide-in min-w-[300px]`;
            toast.innerHTML = `
                <div class="w-8 h-8 rounded-lg ${colors[type]} flex items-center justify-center flex-shrink-0">
                    <i class="bi ${icons[type]} text-white"></i>
                </div>
                <p class="flex-1 text-sm font-medium text-ink-900 dark:text-white">${message}</p>
                <button onclick="this.parentElement.remove()" class="p-1 hover:bg-slate-100 dark:hover:bg-ink-800 rounded transition-colors">
                    <i class="bi bi-x text-ink-400"></i>
                </button>
            `;
            
            container.appendChild(toast);
            
            setTimeout(() => {
                toast.style.transition = 'all 0.3s ease';
                toast.style.opacity = '0';
                toast.style.transform = 'translateX(100%)';
                setTimeout(() => toast.remove(), 300);
            }, 4000);
        }
        
        // ===== COMMAND PALETTE =====
        function openCmdPalette() {
            document.getElementById('cmdPalette').classList.add('active');
            setTimeout(() => document.getElementById('cmdInput').focus(), 100);
        }
        function closeCmdPalette() {
            document.getElementById('cmdPalette').classList.remove('active');
            document.getElementById('cmdInput').value = '';
        }
        
        // ===== SIDEBAR TOGGLE (mobile) =====
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebarOverlay');
        const toggleBtn = document.getElementById('sidebarToggle');
        
        if (toggleBtn) {
            toggleBtn.addEventListener('click', () => {
                sidebar.classList.toggle('open');
                overlay.classList.toggle('hidden');
            });
        }
        if (overlay) {
            overlay.addEventListener('click', () => {
                sidebar.classList.remove('open');
                overlay.classList.add('hidden');
            });
        }
        
        // ===== SIDEBAR COLLAPSE (desktop) =====
        const collapseBtn = document.getElementById('sidebarCollapse');
        const mainWrapper = document.getElementById('mainWrapper');
        if (collapseBtn) {
            collapseBtn.addEventListener('click', () => {
                sidebar.classList.toggle('collapsed');
                mainWrapper.classList.toggle('sidebar-collapsed');
                localStorage.setItem('sidebarCollapsed', sidebar.classList.contains('collapsed'));
            });
            if (localStorage.getItem('sidebarCollapsed') === 'true') {
                sidebar.classList.add('collapsed');
                mainWrapper.classList.add('sidebar-collapsed');
            }
        }
        
        // ===== DROPDOWNS =====
        function setupDropdown(btnId, dropdownId) {
            const btn = document.getElementById(btnId);
            const dropdown = document.getElementById(dropdownId);
            if (!btn || !dropdown) return;
            
            btn.addEventListener('click', (e) => {
                e.stopPropagation();
                document.querySelectorAll('[id$="Dropdown"]').forEach(d => {
                    if (d.id !== dropdownId) d.classList.add('hidden');
                });
                dropdown.classList.toggle('hidden');
            });
            
            dropdown.addEventListener('click', (e) => e.stopPropagation());
        }
        
        setupDropdown('notifBtn', 'notifDropdown');
        setupDropdown('userBtn', 'userDropdown');
        
        document.addEventListener('click', () => {
            document.querySelectorAll('[id$="Dropdown"]').forEach(d => d.classList.add('hidden'));
        });
        
        // ===== KEYBOARD SHORTCUTS =====
        document.addEventListener('keydown', (e) => {
            // Escape
            if (e.key === 'Escape') {
                document.querySelectorAll('[id$="Dropdown"]').forEach(d => d.classList.add('hidden'));
                closeCmdPalette();
            }
            
            // Cmd/Ctrl + K = Command Palette
            if ((e.metaKey || e.ctrlKey) && e.key === 'k') {
                e.preventDefault();
                openCmdPalette();
            }
            
            // Cmd/Ctrl + D = Toggle Dark Mode
            if ((e.metaKey || e.ctrlKey) && e.key === 'd') {
                e.preventDefault();
                toggleTheme();
            }
            
            // Cmd/Ctrl + 1-4 = Quick navigation
            if ((e.metaKey || e.ctrlKey) && ['1','2','3','4'].includes(e.key)) {
                e.preventDefault();
                const routes = {
                    '1': '<?php echo e(route("admin.dashboard")); ?>',
                    '2': '<?php echo e(route("admin.datasets.index")); ?>',
                    '3': '<?php echo e(route("admin.posts.index")); ?>',
                    '4': '<?php echo e(route("admin.users.index")); ?>'
                };
                if (routes[e.key]) window.location.href = routes[e.key];
            }
        });
        
        // ===== COMMAND PALETTE SEARCH =====
        const cmdInput = document.getElementById('cmdInput');
        if (cmdInput) {
            cmdInput.addEventListener('input', (e) => {
                const query = e.target.value.toLowerCase();
                document.querySelectorAll('.cmd-item').forEach(item => {
                    const text = item.textContent.toLowerCase();
                    item.style.display = text.includes(query) ? 'flex' : 'none';
                });
                
                // Hide empty sections
                document.querySelectorAll('.cmd-section').forEach(section => {
                    const visibleItems = section.querySelectorAll('.cmd-item[style*="flex"], .cmd-item:not([style])');
                    const hasVisible = Array.from(section.querySelectorAll('.cmd-item')).some(item => item.style.display !== 'none');
                    section.style.display = hasVisible ? 'block' : 'none';
                });
            });
        }
        
        // ===== AUTO-HIDE FLASH MESSAGES =====
        document.querySelectorAll('[class*="animate-slide-up"]').forEach(msg => {
            if (msg.querySelector('.bi-check-lg, .bi-exclamation-lg')) {
                setTimeout(() => {
                    msg.style.transition = 'all 0.4s ease';
                    msg.style.opacity = '0';
                    msg.style.transform = 'translateY(-20px)';
                    setTimeout(() => msg.remove(), 400);
                }, 5000);
            }
        });
        
        // ===== FORM SUBMIT WITH LOADING =====
        document.querySelectorAll('form[method="POST"], form[method="post"]').forEach(form => {
            form.addEventListener('submit', function(e) {
                const submitBtn = this.querySelector('button[type="submit"]');
                if (submitBtn && !submitBtn.disabled) {
                    // Optional: show loading for heavy operations
                }
            });
        });
    </script>
    
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html><?php /**PATH D:\Documents\TB-PWL-DATASPHERE\resources\views/layouts/admin.blade.php ENDPATH**/ ?>