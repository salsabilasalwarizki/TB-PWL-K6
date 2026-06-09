{{-- 
    Variable Item Partial
    Parameters:
    - $index (int): Index variable
    - $var (array): Data variable
    - $canRemove (bool): Apakah bisa dihapus
--}}

<div class="variable-item bg-gradient-to-br from-violet-50/50 to-purple-50/50 dark:from-gray-700/30 dark:to-gray-700/30 border-2 border-violet-200 dark:border-violet-800/50 rounded-2xl p-5 md:p-6 transition-all hover:shadow-lg" data-index="{{ $index }}">
    
    <!-- Header -->
    <div class="flex items-center justify-between mb-5 pb-4 border-b border-violet-200 dark:border-violet-800/50">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-violet-500 to-purple-500 flex items-center justify-center text-white font-bold text-sm shadow-md">
                <span class="var-number">{{ $index + 1 }}</span>
            </div>
            <div>
                <h6 class="text-sm font-bold text-gray-900 dark:text-white">Variable {{ $index + 1 }}</h6>
                <p class="text-xs text-gray-500 dark:text-gray-400">Define column properties</p>
            </div>
        </div>
        @if($canRemove)
        <button type="button" 
                class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-red-50 dark:bg-red-900/20 text-red-600 dark:text-red-400 text-xs font-semibold hover:bg-red-100 dark:hover:bg-red-900/40 transition-colors"
                onclick="removeVariable({{ $index }})">
            <i class="bi bi-trash"></i>
            <span class="hidden sm:inline">Remove</span>
        </button>
        @endif
    </div>
    
    <!-- Grid Layout -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        
        <!-- Variable Name -->
        <div>
            <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1.5">
                <i class="bi bi-code-square me-1 text-violet-500"></i>Variable Name <span class="text-red-500">*</span>
            </label>
            <input type="text" 
                   class="w-full px-3 py-2.5 rounded-lg bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 text-sm text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:border-violet-500 focus:ring-2 focus:ring-violet-500/20 transition-all @error('variables.'.$index.'.variable_name') border-red-500 focus:border-red-500 focus:ring-red-500/20 @enderror" 
                   name="variables[{{ $index }}][variable_name]" 
                   value="{{ $var['variable_name'] ?? '' }}" 
                   required 
                   maxlength="100" 
                   placeholder="column_name">
            @error('variables.'.$index.'.variable_name')
            <p class="mt-1 text-xs text-red-500 flex items-center gap-1">
                <i class="bi bi-exclamation-circle"></i>{{ $message }}
            </p>
            @enderror
        </div>
        
        <!-- Display Name -->
        <div>
            <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1.5">
                <i class="bi bi-person-badge me-1 text-violet-500"></i>Display Name
            </label>
            <input type="text" 
                   class="w-full px-3 py-2.5 rounded-lg bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 text-sm text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:border-violet-500 focus:ring-2 focus:ring-violet-500/20 transition-all" 
                   name="variables[{{ $index }}][display_name]" 
                   value="{{ $var['display_name'] ?? '' }}" 
                   maxlength="100" 
                   placeholder="Human readable name">
        </div>
        
        <!-- Role -->
        <div>
            <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1.5">
                <i class="bi bi-bullseye me-1 text-violet-500"></i>Role <span class="text-red-500">*</span>
            </label>
            <select class="w-full px-3 py-2.5 rounded-lg bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 text-sm text-gray-900 dark:text-white focus:outline-none focus:border-violet-500 focus:ring-2 focus:ring-violet-500/20 transition-all appearance-none cursor-pointer @error('variables.'.$index.'.role') border-red-500 @enderror" 
                    name="variables[{{ $index }}][role]" 
                    required>
                <option value="feature" {{ ($var['role'] ?? 'feature') == 'feature' ? 'selected' : '' }}>Feature (Input)</option>
                <option value="target" {{ ($var['role'] ?? '') == 'target' ? 'selected' : '' }}>Target (Output)</option>
                <option value="id" {{ ($var['role'] ?? '') == 'id' ? 'selected' : '' }}>ID (Identifier)</option>
                <option value="metadata" {{ ($var['role'] ?? '') == 'metadata' ? 'selected' : '' }}>Metadata</option>
                <option value="other" {{ ($var['role'] ?? '') == 'other' ? 'selected' : '' }}>Other</option>
            </select>
            @error('variables.'.$index.'.role')
            <p class="mt-1 text-xs text-red-500 flex items-center gap-1">
                <i class="bi bi-exclamation-circle"></i>{{ $message }}
            </p>
            @enderror
        </div>
        
        <!-- Variable Type -->
        <div>
            <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1.5">
                <i class="bi bi-diagram-2 me-1 text-violet-500"></i>Type <span class="text-red-500">*</span>
            </label>
            <select class="var-type-select w-full px-3 py-2.5 rounded-lg bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 text-sm text-gray-900 dark:text-white focus:outline-none focus:border-violet-500 focus:ring-2 focus:ring-violet-500/20 transition-all appearance-none cursor-pointer @error('variables.'.$index.'.variable_type') border-red-500 @enderror" 
                    name="variables[{{ $index }}][variable_type]" 
                    required 
                    onchange="toggleCategoriesField(this)">
                @foreach(['Categorical', 'Integer', 'Real', 'Text', 'Binary', 'Ordinal', 'Nominal', 'DateTime'] as $vtype)
                <option value="{{ $vtype }}" {{ ($var['variable_type'] ?? 'Real') == $vtype ? 'selected' : '' }}>{{ $vtype }}</option>
                @endforeach
            </select>
            @error('variables.'.$index.'.variable_type')
            <p class="mt-1 text-xs text-red-500 flex items-center gap-1">
                <i class="bi bi-exclamation-circle"></i>{{ $message }}
            </p>
            @enderror
        </div>
        
        <!-- Unit -->
        <div>
            <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1.5">
                <i class="bi bi-rulers me-1 text-violet-500"></i>Unit
            </label>
            <input type="text" 
                   class="w-full px-3 py-2.5 rounded-lg bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 text-sm text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:border-violet-500 focus:ring-2 focus:ring-violet-500/20 transition-all" 
                   name="variables[{{ $index }}][unit]" 
                   value="{{ $var['unit'] ?? '' }}" 
                   maxlength="50" 
                   placeholder="e.g., kg, °C, meters">
        </div>
        
        <!-- Min Value -->
        <div>
            <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1.5">
                <i class="bi bi-arrow-down-left me-1 text-violet-500"></i>Min Value
            </label>
            <input type="number" 
                   step="any" 
                   class="w-full px-3 py-2.5 rounded-lg bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 text-sm text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:border-violet-500 focus:ring-2 focus:ring-violet-500/20 transition-all" 
                   name="variables[{{ $index }}][min_value]" 
                   value="{{ $var['min_value'] ?? '' }}" 
                   placeholder="Minimum">
        </div>
        
        <!-- Max Value -->
        <div>
            <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1.5">
                <i class="bi bi-arrow-up-right me-1 text-violet-500"></i>Max Value
            </label>
            <input type="number" 
                   step="any" 
                   class="w-full px-3 py-2.5 rounded-lg bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 text-sm text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:border-violet-500 focus:ring-2 focus:ring-violet-500/20 transition-all" 
                   name="variables[{{ $index }}][max_value]" 
                   value="{{ $var['max_value'] ?? '' }}" 
                   placeholder="Maximum">
        </div>
        
        <!-- Description -->
        <div class="lg:col-span-2">
            <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1.5">
                <i class="bi bi-card-text me-1 text-violet-500"></i>Description
            </label>
            <input type="text" 
                   class="w-full px-3 py-2.5 rounded-lg bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 text-sm text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:border-violet-500 focus:ring-2 focus:ring-violet-500/20 transition-all" 
                   name="variables[{{ $index }}][description]" 
                   value="{{ $var['description'] ?? '' }}" 
                   maxlength="500" 
                   placeholder="Brief description of this variable">
        </div>
    </div>
    
    <!-- Categories Field (for Categorical type) -->
    <div class="categories-row mt-4 pt-4 border-t border-violet-200 dark:border-violet-800/50 {{ ($var['variable_type'] ?? '') == 'Categorical' ? '' : 'hidden' }}" data-index="{{ $index }}">
        <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1.5">
            <i class="bi bi-tags me-1 text-violet-500"></i>Categories <span class="text-xs font-normal text-gray-500">(comma-separated)</span>
        </label>
        <input type="text" 
               class="w-full px-3 py-2.5 rounded-lg bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 text-sm text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:border-violet-500 focus:ring-2 focus:ring-violet-500/20 transition-all" 
               name="variables[{{ $index }}][categories]" 
               value="{{ $var['categories'] ?? '' }}" 
               placeholder="e.g., low, medium, high">
        <p class="mt-1.5 text-xs text-gray-500 dark:text-gray-400 flex items-center gap-1">
            <i class="bi bi-info-circle"></i>
            Enter category values separated by commas
        </p>
    </div>
</div>