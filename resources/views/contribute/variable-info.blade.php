@extends('layouts.app')
@section('title', 'Dataset Donation - Variables - DataSphere ML Repository')
@section('meta_desc', 'Step 6: Define variables for your dataset')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 via-brand-50/30 to-sphere-secondary/10 dark:from-gray-900 dark:via-gray-900 dark:to-gray-900 py-8 md:py-12 px-4 sm:px-6 lg:px-8">
    
    
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-20 left-10 w-72 h-72 bg-brand-500/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-20 right-10 w-96 h-96 bg-sphere-secondary/10 rounded-full blur-3xl"></div>
    </div>
    
    <div class="relative max-w-6xl mx-auto">
        
        
        <nav class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-400 mb-6">
            <a href="{{ route('home') }}" class="hover:text-brand-600 dark:hover:text-brand-400 transition-colors">Home</a>
            <i class="bi bi-chevron-right text-xs"></i>
            <a href="{{ route('profile') }}" class="hover:text-brand-600 dark:hover:text-brand-400 transition-colors">Profile</a>
            <i class="bi bi-chevron-right text-xs"></i>
            <a href="{{ route('profile.datasets') }}" class="hover:text-brand-600 dark:hover:text-brand-400 transition-colors">My Datasets</a>
            <i class="bi bi-chevron-right text-xs"></i>
            <span class="text-brand-600 dark:text-brand-400 font-semibold">Donate Dataset</span>
        </nav>
        
        
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 overflow-hidden mb-6">
            <div class="bg-gradient-to-r from-brand-600 to-sphere-secondary p-8 md:p-10">
                <div class="flex items-center gap-4 mb-4">
                    <div class="w-14 h-14 rounded-xl bg-white/20 backdrop-blur-sm flex items-center justify-center">
                        <i class="bi bi-list-columns-reverse text-3xl text-white"></i>
                    </div>
                    <div>
                        <h1 class="text-3xl md:text-4xl font-bold text-white">
                            Dataset Donation Form
                        </h1>
                        <p class="text-white/90 text-sm md:text-base mt-1">
                            Step 6 of 7 — Variable Information
                        </p>
                    </div>
                </div>
            </div>
            
            
            <div class="p-6 md:p-8 bg-gradient-to-r from-amber-50 to-orange-50 dark:from-gray-800 dark:to-gray-800">
                <div class="flex items-center justify-between mb-3">
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 rounded-full bg-gradient-to-br from-amber-500 to-orange-500 flex items-center justify-center text-white font-bold text-sm">
                            6
                        </div>
                        <span class="text-sm font-bold text-gray-900 dark:text-white">Variables</span>
                    </div>
                    <span class="text-xs font-semibold text-amber-700 dark:text-amber-400 bg-amber-100 dark:bg-amber-900/30 px-3 py-1 rounded-full">
                        Page 6 / 7
                    </span>
                </div>
                
                
                <div class="hidden md:flex items-center gap-1 mb-3">
                    @for($i = 1; $i <= 7; $i++)
                        <div class="flex-1 h-2 rounded-full {{ $i <= 6 ? 'bg-gradient-to-r from-amber-500 to-orange-500' : 'bg-gray-200 dark:bg-gray-700' }}"></div>
                    @endfor
                </div>
                <div class="md:hidden h-2 rounded-full bg-gray-200 dark:bg-gray-700 overflow-hidden">
                    <div class="h-full bg-gradient-to-r from-amber-500 to-orange-500" style="width: 85.5%"></div>
                </div>
                
                
                <div class="hidden md:grid grid-cols-7 gap-1 mt-2 text-[10px] text-gray-500 dark:text-gray-400">
                    <span class="text-center font-semibold text-amber-700 dark:text-amber-400">Basic</span>
                    <span class="text-center font-semibold text-amber-700 dark:text-amber-400">Paper</span>
                    <span class="text-center font-semibold text-amber-700 dark:text-amber-400">Creators</span>
                    <span class="text-center font-semibold text-amber-700 dark:text-amber-400">Files</span>
                    <span class="text-center font-semibold text-amber-700 dark:text-amber-400">Keywords</span>
                    <span class="text-center font-semibold text-amber-700 dark:text-amber-400">Variables</span>
                    <span class="text-center">Descriptive</span>
                </div>
            </div>
        </div>
        
        
        @if($errors->any())
        <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-2xl p-5 mb-6 flex items-start gap-3">
            <div class="flex-shrink-0 w-10 h-10 rounded-lg bg-red-100 dark:bg-red-900/30 flex items-center justify-center">
                <i class="bi bi-exclamation-triangle-fill text-xl text-red-600 dark:text-red-400"></i>
            </div>
            <div class="flex-1">
                <h3 class="text-sm font-bold text-red-900 dark:text-red-200 mb-2">
                    Please fix the following errors:
                </h3>
                <ul class="space-y-1">
                    @foreach($errors->all() as $error)
                    <li class="text-sm text-red-700 dark:text-red-300 flex items-start gap-2">
                        <i class="bi bi-x-circle mt-0.5 flex-shrink-0"></i>
                        <span>{{ $error }}</span>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endif
        
        <form action="{{ route('contribute.variable-info.store') }}" method="POST" id="variablesForm">
            @csrf
            
            
            
            
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 overflow-hidden mb-6">
                <div class="bg-gradient-to-r from-violet-50 to-purple-50 dark:from-gray-800 dark:to-gray-800 border-b border-gray-200 dark:border-gray-700 p-5 md:p-6">
                    <div class="flex items-center justify-between flex-wrap gap-3">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-lg bg-violet-100 dark:bg-violet-900/30 flex items-center justify-center">
                                <i class="bi bi-list-columns-reverse text-xl text-violet-600 dark:text-violet-400"></i>
                            </div>
                            <div>
                                <h2 class="text-lg font-bold text-gray-900 dark:text-white">Variable Information</h2>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Optional: Describe columns in your dataset</p>
                            </div>
                        </div>
                        <span class="text-xs font-semibold text-violet-700 dark:text-violet-400 bg-violet-100 dark:bg-violet-900/30 px-3 py-1 rounded-full">
                            <span id="varCount">0</span> Variable(s)
                        </span>
                    </div>
                </div>
                
                <div class="p-5 md:p-6 space-y-5">
                    
                    
                    <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-xl p-4 flex items-start gap-3">
                        <div class="flex-shrink-0 w-8 h-8 rounded-lg bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center">
                            <i class="bi bi-info-circle text-lg text-blue-600 dark:text-blue-400"></i>
                        </div>
                        <div class="flex-1 text-sm text-blue-800 dark:text-blue-200">
                            <strong class="font-semibold">Tip:</strong> Describe each variable (column) in your dataset. Use "Feature" for input variables, "Target" for the variable you want to predict, and "ID" for identifier columns.
                        </div>
                    </div>
                    
                    
                    <div id="variables-container" class="space-y-4">
                        @php
                            $variablesData = old('variables', session('donation_wizard.variables', []));
                            if (empty($variablesData)) {
                                $variablesData = [[
                                    'variable_name' => '', 'display_name' => '', 'role' => 'feature', 
                                    'variable_type' => 'Real', 'description' => '', 'unit' => '', 
                                    'min_value' => '', 'max_value' => '', 'categories' => ''
                                ]];
                            }
                        @endphp
                        
                        @foreach($variablesData as $index => $var)
                            @include('contribute.partials.variable-item', [
                                'index' => $index,
                                'var' => $var,
                                'canRemove' => $index > 0
                            ])
                        @endforeach
                    </div>
                    
                    
                    <div class="pt-4 border-t border-gray-100 dark:border-gray-700">
                        <button type="button" 
                                onclick="addVariable()"
                                class="w-full inline-flex items-center justify-center gap-2 px-6 py-4 rounded-xl border-2 border-dashed border-violet-300 dark:border-violet-700 text-violet-600 dark:text-violet-400 font-semibold hover:border-violet-500 hover:bg-violet-50 dark:hover:bg-violet-900/10 hover:-translate-y-0.5 transition-all">
                            <div class="w-8 h-8 rounded-full bg-violet-100 dark:bg-violet-900/30 flex items-center justify-center">
                                <i class="bi bi-plus-lg"></i>
                            </div>
                            <span>Add Another Variable</span>
                        </button>
                    </div>
                </div>
            </div>
            
            
            
            
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 p-5 md:p-6 sticky bottom-4">
                <div class="flex flex-col sm:flex-row items-center justify-between gap-3">
                    <a href="{{ route('contribute.keywords') }}" 
                       class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200 font-semibold hover:bg-gray-200 dark:hover:bg-gray-600 transition-all">
                        <i class="bi bi-arrow-left"></i>
                        <span>Back</span>
                    </a>
                    
                    <div class="flex items-center gap-3 w-full sm:w-auto">
                        <span class="text-xs text-gray-500 dark:text-gray-400 hidden sm:inline">
                            Step 6 of 7
                        </span>
                        <button type="submit" 
                                id="nextBtn"
                                class="flex-1 sm:flex-none inline-flex items-center justify-center gap-2 px-8 py-3 rounded-xl bg-gradient-to-r from-brand-600 to-sphere-secondary text-white font-bold shadow-lg hover:shadow-xl hover:shadow-brand-500/30 hover:-translate-y-0.5 transition-all">
                            <span>Next</span>
                            <i class="bi bi-arrow-right"></i>
                        </button>
                    </div>
                </div>
            </div>
            
        </form>
        
    </div>
</div>


<template id="variableRowTemplate">
    <div class="variable-item bg-gradient-to-br from-violet-50/50 to-purple-50/50 dark:from-gray-700/30 dark:to-gray-700/30 border-2 border-violet-200 dark:border-violet-800/50 rounded-2xl p-5 md:p-6 transition-all hover:shadow-lg animate-fadeIn" data-index="__INDEX__">
        <div class="flex items-center justify-between mb-5 pb-4 border-b border-violet-200 dark:border-violet-800/50">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-violet-500 to-purple-500 flex items-center justify-center text-white font-bold text-sm shadow-md">
                    <span class="var-number">__DISPLAY_INDEX__</span>
                </div>
                <div>
                    <h6 class="text-sm font-bold text-gray-900 dark:text-white">Variable __DISPLAY_INDEX__</h6>
                    <p class="text-xs text-gray-500 dark:text-gray-400">Define column properties</p>
                </div>
            </div>
            <button type="button" 
                    class="btn-remove-var inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-red-50 dark:bg-red-900/20 text-red-600 dark:text-red-400 text-xs font-semibold hover:bg-red-100 dark:hover:bg-red-900/40 transition-colors"
                    onclick="removeVariable(__INDEX__)">
                <i class="bi bi-trash"></i>
                <span class="hidden sm:inline">Remove</span>
            </button>
        </div>
        
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            
            <div>
                <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1.5">
                    <i class="bi bi-code-square me-1 text-violet-500"></i>Variable Name <span class="text-red-500">*</span>
                </label>
                <input type="text" 
                       class="var-input w-full px-3 py-2.5 rounded-lg bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 text-sm text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:border-violet-500 focus:ring-2 focus:ring-violet-500/20 transition-all" 
                       name="variables[__INDEX__][variable_name]" 
                       required 
                       maxlength="100" 
                       placeholder="column_name">
            </div>
            
            
            <div>
                <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1.5">
                    <i class="bi bi-person-badge me-1 text-violet-500"></i>Display Name
                </label>
                <input type="text" 
                       class="var-input w-full px-3 py-2.5 rounded-lg bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 text-sm text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:border-violet-500 focus:ring-2 focus:ring-violet-500/20 transition-all" 
                       name="variables[__INDEX__][display_name]" 
                       maxlength="100" 
                       placeholder="Human readable name">
            </div>
            
            
            <div>
                <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1.5">
                    <i class="bi bi-bullseye me-1 text-violet-500"></i>Role <span class="text-red-500">*</span>
                </label>
                <select class="var-input w-full px-3 py-2.5 rounded-lg bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 text-sm text-gray-900 dark:text-white focus:outline-none focus:border-violet-500 focus:ring-2 focus:ring-violet-500/20 transition-all appearance-none cursor-pointer" 
                        name="variables[__INDEX__][role]" 
                        required>
                    <option value="feature">Feature (Input)</option>
                    <option value="target">Target (Output)</option>
                    <option value="id">ID (Identifier)</option>
                    <option value="metadata">Metadata</option>
                    <option value="other">Other</option>
                </select>
            </div>
            
            
            <div>
                <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1.5">
                    <i class="bi bi-diagram-2 me-1 text-violet-500"></i>Type <span class="text-red-500">*</span>
                </label>
                <select class="var-input var-type-select w-full px-3 py-2.5 rounded-lg bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 text-sm text-gray-900 dark:text-white focus:outline-none focus:border-violet-500 focus:ring-2 focus:ring-violet-500/20 transition-all appearance-none cursor-pointer" 
                        name="variables[__INDEX__][variable_type]" 
                        required 
                        onchange="toggleCategoriesField(this)">
                    <option value="Categorical">Categorical</option>
                    <option value="Integer">Integer</option>
                    <option value="Real">Real</option>
                    <option value="Text">Text</option>
                    <option value="Binary">Binary</option>
                    <option value="Ordinal">Ordinal</option>
                    <option value="Nominal">Nominal</option>
                    <option value="DateTime">DateTime</option>
                </select>
            </div>
            
            
            <div>
                <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1.5">
                    <i class="bi bi-rulers me-1 text-violet-500"></i>Unit
                </label>
                <input type="text" 
                       class="var-input w-full px-3 py-2.5 rounded-lg bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 text-sm text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:border-violet-500 focus:ring-2 focus:ring-violet-500/20 transition-all" 
                       name="variables[__INDEX__][unit]" 
                       maxlength="50" 
                       placeholder="e.g., kg, °C, meters">
            </div>
            
            
            <div>
                <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1.5">
                    <i class="bi bi-arrow-down-left me-1 text-violet-500"></i>Min Value
                </label>
                <input type="number" 
                       step="any" 
                       class="var-input w-full px-3 py-2.5 rounded-lg bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 text-sm text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:border-violet-500 focus:ring-2 focus:ring-violet-500/20 transition-all" 
                       name="variables[__INDEX__][min_value]" 
                       placeholder="Minimum">
            </div>
            
            
            <div>
                <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1.5">
                    <i class="bi bi-arrow-up-right me-1 text-violet-500"></i>Max Value
                </label>
                <input type="number" 
                       step="any" 
                       class="var-input w-full px-3 py-2.5 rounded-lg bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 text-sm text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:border-violet-500 focus:ring-2 focus:ring-violet-500/20 transition-all" 
                       name="variables[__INDEX__][max_value]" 
                       placeholder="Maximum">
            </div>
            
            
            <div class="lg:col-span-2">
                <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1.5">
                    <i class="bi bi-card-text me-1 text-violet-500"></i>Description
                </label>
                <input type="text" 
                       class="var-input w-full px-3 py-2.5 rounded-lg bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 text-sm text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:border-violet-500 focus:ring-2 focus:ring-violet-500/20 transition-all" 
                       name="variables[__INDEX__][description]" 
                       maxlength="500" 
                       placeholder="Brief description of this variable">
            </div>
        </div>
        
        
        <div class="categories-row mt-4 pt-4 border-t border-violet-200 dark:border-violet-800/50 hidden" data-index="__INDEX__">
            <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1.5">
                <i class="bi bi-tags me-1 text-violet-500"></i>Categories <span class="text-xs font-normal text-gray-500">(comma-separated)</span>
            </label>
            <input type="text" 
                   class="var-input w-full px-3 py-2.5 rounded-lg bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 text-sm text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:border-violet-500 focus:ring-2 focus:ring-violet-500/20 transition-all" 
                   name="variables[__INDEX__][categories]" 
                   placeholder="e.g., low, medium, high">
            <p class="mt-1.5 text-xs text-gray-500 dark:text-gray-400 flex items-center gap-1">
                <i class="bi bi-info-circle"></i>
                Enter category values separated by commas
            </p>
        </div>
    </div>
</template>

<style>
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fadeIn {
        animation: fadeIn 0.3s ease-out;
    }
</style>

@push('scripts')
<script>
    let varIndex = {{ count($variablesData) }};
    
    function updateVarCount() {
        const count = document.querySelectorAll('.variable-item').length;
        document.getElementById('varCount').textContent = count;
        document.querySelectorAll('.variable-item').forEach((item, idx) => {
            const numEl = item.querySelector('.var-number');
            if (numEl) numEl.textContent = idx + 1;
        });
    }
    
    function addVariable() {
        const template = document.getElementById('variableRowTemplate');
        const clone = template.content.cloneNode(true);
        const html = clone.querySelector('.variable-item').outerHTML
            .replace(/__INDEX__/g, varIndex)
            .replace(/__DISPLAY_INDEX__/g, varIndex + 1);
        
        const container = document.getElementById('variables-container');
        const tempDiv = document.createElement('div');
        tempDiv.innerHTML = html;
        container.appendChild(tempDiv.firstElementChild);
        
        varIndex++;
        updateVarCount();
        setTimeout(() => {
            const lastItem = container.querySelector('.variable-item:last-child');
            if (lastItem) {
                const firstInput = lastItem.querySelector('input[name*="[variable_name]"]');
                if (firstInput) {
                    firstInput.focus();
                    firstInput.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
            }
        }, 100);
    }
    
    function removeVariable(index) {
        const item = document.querySelector(`.variable-item[data-index="${index}"]`);
        if (item) {
            item.style.transition = 'all 0.3s ease';
            item.style.opacity = '0';
            item.style.transform = 'translateX(20px)';
            
            setTimeout(() => {
                item.remove();
                updateVarCount();
            }, 300);
        }
    }
    
    function toggleCategoriesField(select) {
        const item = select.closest('.variable-item');
        const catRow = item.querySelector('.categories-row');
        
        if (catRow) {
            if (select.value === 'Categorical') {
                catRow.classList.remove('hidden');
            } else {
                catRow.classList.add('hidden');
            }
        }
    }
    document.addEventListener('DOMContentLoaded', function() {
        updateVarCount();
        document.querySelectorAll('.var-type-select').forEach(select => {
            toggleCategoriesField(select);
        });
    });
    document.getElementById('variablesForm').addEventListener('submit', function(e) {
        const items = document.querySelectorAll('.variable-item');
        if (items.length === 0) return true;
        
        let valid = true;
        items.forEach(item => {
            const name = item.querySelector('input[name*="[variable_name]"]');
            const role = item.querySelector('select[name*="[role]"]');
            const type = item.querySelector('select[name*="[variable_type]"]');
            
            if (name && !name.value.trim()) {
                valid = false;
                name.classList.add('border-red-500', 'focus:border-red-500');
            } else if (name) {
                name.classList.remove('border-red-500', 'focus:border-red-500');
            }
        });
        
        if (!valid) {
            e.preventDefault();
            alert('Please fill in all required fields (Variable Name) for each variable.');
            return false;
        }
        const btn = document.getElementById('nextBtn');
        btn.disabled = true;
        btn.innerHTML = `
            <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            <span>Processing...</span>
        `;
    });
</script>
@endpush
@endsection