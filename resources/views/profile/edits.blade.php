@extends('layouts.app')
@section('title', 'Edit Datasets - DataSphere')

@section('content')
<div class="relative">
    
    
    <section class="relative overflow-hidden bg-gradient-to-br from-brand-600 via-sphere-primary to-sphere-secondary text-white">
        <div class="absolute inset-0">
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_20%_80%,rgba(255,255,255,0.1)_0%,transparent_50%)]"></div>
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_80%_20%,rgba(255,255,255,0.08)_0%,transparent_50%)]"></div>
        </div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-16">
            <div class="flex flex-col md:flex-row items-center justify-between gap-6">
                
                <div class="text-center md:text-left">
                    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/10 backdrop-blur-sm border border-white/20 mb-4">
                        <i class="bi bi-pencil-square text-yellow-300"></i>
                        <span class="text-sm font-semibold">Edit History</span>
                    </div>
                    
                    <h1 class="text-3xl md:text-4xl font-bold mb-2">
                        Edit Datasets
                    </h1>
                    <p class="text-white/80 text-sm md:text-base max-w-xl">
                        Manage and update your approved datasets. Changes will be reviewed by admins before going live.
                    </p>
                </div>
                
                <div class="flex gap-3">
                    <a href="{{ route('datasets.index') }}" 
                       class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-white/10 backdrop-blur-sm border border-white/30 text-white font-semibold hover:bg-white/20 transition-all">
                        <i class="bi bi-search"></i>
                        <span>Browse</span>
                    </a>
                    <a href="{{ route('contribute.policy') }}" 
                       class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-white text-brand-700 font-semibold shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition-all">
                        <i class="bi bi-plus-circle"></i>
                        <span>Donate New</span>
                    </a>
                </div>
                
            </div>
        </div>
    </section>

    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid lg:grid-cols-[280px_1fr] gap-6">
            
            
            <aside class="lg:sticky lg:top-24 lg:self-start">
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
                    <div class="p-4 border-b border-gray-100 dark:border-gray-700">
                        <h3 class="text-sm font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Navigation</h3>
                    </div>
                    <nav class="p-2">
                        <a href="{{ route('profile') }}" 
                           class="flex items-center gap-3 px-4 py-3 rounded-xl mb-1 transition-all text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700/50">
                            <i class="bi bi-person-fill text-lg"></i>
                            <span class="font-semibold text-sm">Profile</span>
                        </a>
                        <a href="{{ route('profile.datasets') }}" 
                           class="flex items-center gap-3 px-4 py-3 rounded-xl mb-1 transition-all text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700/50">
                            <i class="bi bi-grid-3x3-gap-fill text-lg"></i>
                            <span class="font-semibold text-sm">My Datasets</span>
                        </a>
                        <a href="{{ route('profile.edits') }}" 
                           class="flex items-center gap-3 px-4 py-3 rounded-xl mb-1 transition-all bg-gradient-to-r from-brand-500 to-sphere-secondary text-white shadow-md">
                            <i class="bi bi-pencil-fill text-lg"></i>
                            <span class="font-semibold text-sm">Edits</span>
                            <i class="bi bi-chevron-right ml-auto"></i>
                        </a>
                    </nav>
                    
                    
                    <div class="p-4 border-t border-gray-100 dark:border-gray-700">
                        <div class="bg-gradient-to-br from-brand-50 to-sphere-secondary/10 dark:from-brand-900/30 dark:to-sphere-secondary/20 rounded-xl p-4">
                            <div class="flex items-start gap-2 mb-2">
                                <i class="bi bi-info-circle-fill text-brand-600 dark:text-brand-400 mt-0.5"></i>
                                <h4 class="text-sm font-bold text-gray-900 dark:text-white">How Editing Works</h4>
                            </div>
                            <p class="text-xs text-gray-600 dark:text-gray-400 leading-relaxed">
                                All edits to approved datasets are reviewed by our admin team before being published to ensure quality and accuracy.
                            </p>
                        </div>
                    </div>
                </div>
            </aside>

            
            <div class="space-y-6">
                
                
                <div class="bg-gradient-to-r from-amber-50 to-orange-50 dark:from-amber-900/20 dark:to-orange-900/20 border border-amber-200 dark:border-amber-800 rounded-2xl p-4 flex items-start gap-3">
                    <i class="bi bi-lightbulb-fill text-amber-500 text-xl mt-0.5"></i>
                    <div class="flex-1">
                        <h4 class="font-semibold text-amber-900 dark:text-amber-200 mb-1">Editable Datasets</h4>
                        <p class="text-sm text-amber-800 dark:text-amber-300">
                            Below are your approved datasets that you can still edit. Changes will be reviewed by admins before going live.
                        </p>
                    </div>
                </div>

                @if($datasets->isNotEmpty())
                    
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
                        <div class="p-6 border-b border-gray-100 dark:border-gray-700 flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-brand-50 dark:bg-brand-900/30 flex items-center justify-center">
                                    <i class="bi bi-pencil-square text-xl text-brand-600 dark:text-brand-400"></i>
                                </div>
                                <div>
                                    <h2 class="text-lg font-bold text-gray-900 dark:text-white">Your Editable Datasets</h2>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ $datasets->total() }} datasets available for editing</p>
                                </div>
                            </div>
                        </div>
                        
                        
                        <div class="hidden md:block">
                            <div class="overflow-x-auto">
                                <table class="w-full">
                                    <thead class="bg-gray-50 dark:bg-gray-700/50 border-b border-gray-100 dark:border-gray-700">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Dataset</th>
                                            <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Status</th>
                                            <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Last Updated</th>
                                            <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Views</th>
                                            <th class="px-6 py-3 text-right text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                                        @foreach($datasets as $dataset)
                                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors">
                                            <td class="px-6 py-4">
                                                <div class="flex items-center gap-3">
                                                    @if($dataset->thumbnail_url)
                                                    <img src="{{ $dataset->thumbnail_url }}" 
                                                         alt="{{ $dataset->name }}" 
                                                         class="w-10 h-10 rounded-xl object-cover shadow-sm">
                                                    @else
                                                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-brand-500 to-sphere-secondary flex items-center justify-center shadow-sm">
                                                        <i class="bi bi-database text-white"></i>
                                                    </div>
                                                    @endif
                                                    <div>
                                                        <a href="{{ route('datasets.show', $dataset) }}" 
                                                           class="font-semibold text-gray-900 dark:text-white hover:text-brand-600 dark:hover:text-brand-400 transition-colors line-clamp-1">
                                                            {{ Str::limit($dataset->name, 35) }}
                                                        </a>
                                                        @if($dataset->subject_area)
                                                        <div class="text-xs text-gray-500 dark:text-gray-400 mt-0.5 flex items-center gap-1">
                                                            <i class="bi bi-folder"></i>
                                                            {{ $dataset->subject_area }}
                                                        </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4">
                                                @php
                                                    $statusStyles = [
                                                        'approved' => 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400 border-green-200 dark:border-green-800',
                                                        'pending' => 'bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400 border-amber-200 dark:border-amber-800'
                                                    ][$dataset->status] ?? 'bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-300 border-gray-200 dark:border-gray-600';
                                                    
                                                    $statusIcon = [
                                                        'approved' => 'check-circle-fill',
                                                        'pending' => 'clock-history'
                                                    ][$dataset->status] ?? 'question-circle-fill';
                                                @endphp
                                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold border {{ $statusStyles }}">
                                                    <i class="bi bi-{{ $statusIcon }}"></i>
                                                    {{ ucfirst($dataset->status) }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="text-sm text-gray-900 dark:text-white font-medium">
                                                    {{ $dataset->updated_at?->diffForHumans() ?? 'N/A' }}
                                                </div>
                                                <div class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">
                                                    {{ $dataset->updated_at?->format('M d, Y') ?? '' }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="flex items-center gap-1.5 text-sm text-gray-600 dark:text-gray-400">
                                                    <i class="bi bi-eye"></i>
                                                    <span class="font-semibold">{{ number_format($dataset->view_count ?? 0) }}</span>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="flex items-center justify-end gap-2">
                                                    <a href="{{ route('datasets.show', $dataset) }}" 
                                                       class="w-9 h-9 rounded-lg bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400 hover:bg-gray-200 dark:hover:bg-gray-600 flex items-center justify-center transition-colors"
                                                       title="View Public Page">
                                                        <i class="bi bi-eye"></i>
                                                    </a>
                                                    <a href="{{ route('contribute.edit.metadata', $dataset) }}" 
                                                       class="w-9 h-9 rounded-lg bg-brand-50 dark:bg-brand-900/30 text-brand-600 dark:text-brand-400 hover:bg-brand-100 dark:hover:bg-brand-900/50 flex items-center justify-center transition-colors"
                                                       title="Edit Metadata">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                        
                        <div class="md:hidden divide-y divide-gray-100 dark:divide-gray-700">
                            @foreach($datasets as $dataset)
                            <div class="p-4 hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors">
                                <div class="flex items-start gap-3 mb-3">
                                    @if($dataset->thumbnail_url)
                                    <img src="{{ $dataset->thumbnail_url }}" 
                                         alt="{{ $dataset->name }}" 
                                         class="w-12 h-12 rounded-xl object-cover shadow-sm">
                                    @else
                                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-brand-500 to-sphere-secondary flex items-center justify-center shadow-sm">
                                        <i class="bi bi-database text-white text-lg"></i>
                                    </div>
                                    @endif
                                    <div class="flex-1 min-w-0">
                                        <a href="{{ route('datasets.show', $dataset) }}" 
                                           class="font-semibold text-gray-900 dark:text-white hover:text-brand-600 dark:hover:text-brand-400 transition-colors block line-clamp-2">
                                            {{ $dataset->name }}
                                        </a>
                                        @if($dataset->subject_area)
                                        <div class="text-xs text-gray-500 dark:text-gray-400 mt-1 flex items-center gap-1">
                                            <i class="bi bi-folder"></i>
                                            {{ $dataset->subject_area }}
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="flex items-center justify-between">
                                    @php
                                        $statusStyles = [
                                            'approved' => 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400',
                                            'pending' => 'bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400'
                                        ][$dataset->status] ?? 'bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-300';
                                    @endphp
                                    <div class="flex items-center gap-2">
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-semibold {{ $statusStyles }}">
                                            {{ ucfirst($dataset->status) }}
                                        </span>
                                        <span class="text-xs text-gray-500 dark:text-gray-400">
                                            <i class="bi bi-eye mr-1"></i>{{ number_format($dataset->view_count ?? 0) }}
                                        </span>
                                    </div>
                                    
                                    <div class="flex items-center gap-2">
                                        <a href="{{ route('datasets.show', $dataset) }}" 
                                           class="w-9 h-9 rounded-lg bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400 flex items-center justify-center">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{ route('contribute.edit.metadata', $dataset) }}" 
                                           class="w-9 h-9 rounded-lg bg-brand-50 dark:bg-brand-900/30 text-brand-600 dark:text-brand-400 flex items-center justify-center">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        
                        
                        @if($datasets->hasPages())
                        <div class="p-4 border-t border-gray-100 dark:border-gray-700 bg-gray-50 dark:bg-gray-700/30">
                            {{ $datasets->links() }}
                        </div>
                        @endif
                    </div>
                @else
                    
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
                        <div class="p-12 text-center">
                            <div class="w-24 h-24 mx-auto mb-6 rounded-full bg-gradient-to-br from-brand-50 to-sphere-secondary/10 dark:from-brand-900/30 dark:to-sphere-secondary/20 flex items-center justify-center">
                                <i class="bi bi-inbox text-5xl text-brand-500 dark:text-brand-400"></i>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-3">No Editable Datasets Yet</h3>
                            <p class="text-gray-500 dark:text-gray-400 mb-8 max-w-md mx-auto">
                                You don't have any approved datasets yet. Once your donated datasets are approved by admins, they will appear here for editing.
                            </p>
                            <div class="flex flex-wrap gap-3 justify-center">
                                <a href="{{ route('datasets.index') }}" 
                                   class="inline-flex items-center gap-2 px-6 py-3 rounded-full bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200 font-semibold hover:bg-gray-200 dark:hover:bg-gray-600 transition-all">
                                    <i class="bi bi-search"></i>
                                    <span>Browse Datasets</span>
                                </a>
                                <a href="{{ route('contribute.policy') }}" 
                                   class="inline-flex items-center gap-2 px-6 py-3 rounded-full bg-gradient-to-r from-brand-600 to-sphere-secondary text-white font-semibold shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition-all">
                                    <i class="bi bi-plus-circle"></i>
                                    <span>Donate Dataset</span>
                                </a>
                            </div>
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>
</div>
@endsection