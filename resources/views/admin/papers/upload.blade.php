<form action="{{ route('admin.papers.upload') }}" method="POST" enctype="multipart/form-data" id="uploadForm">
    @csrf
    
    <div class="bg-white dark:bg-ink-900 rounded-xl shadow-card border border-ink-200 dark:border-ink-800 overflow-hidden">
        <div class="p-6 border-b border-ink-200 dark:border-ink-800">
            <h3 class="text-lg font-bold text-ink-900 dark:text-white flex items-center gap-2">
                <i class="bi bi-file-earmark-arrow-up text-brand-500"></i>
                Upload Papers CSV
            </h3>
            <p class="text-sm text-ink-500 dark:text-ink-400 mt-1">Upload a CSV file containing paper data</p>
        </div>
        
        <div class="p-6">
            <div id="dropZone" class="relative border-2 border-dashed border-ink-300 dark:border-ink-600 rounded-xl p-8 text-center cursor-pointer hover:border-brand-500 dark:hover:border-brand-400 hover:bg-brand-50/50 dark:hover:bg-brand-900/10 transition-all duration-300 group">
                <input type="file" 
                       name="csv_file" 
                       accept=".csv" 
                       required
                       id="fileInput"
                       class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                
                <div class="space-y-3 pointer-events-none">
                    <div class="w-16 h-16 mx-auto rounded-2xl bg-brand-100 dark:bg-brand-900/30 flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                        <i class="bi bi-cloud-arrow-up text-3xl text-brand-600 dark:text-brand-400"></i>
                    </div>
                    <div>
                        <p class="text-base font-semibold text-ink-700 dark:text-ink-300">
                            Drop your CSV file here or <span class="text-brand-600 dark:text-brand-400 underline">browse</span>
                        </p>
                        <p class="text-sm text-ink-500 dark:text-ink-400 mt-1">
                            Only CSV files are accepted
                        </p>
                    </div>
                </div>
            </div>
          
            <div id="filePreview" class="hidden mt-4">
                <div class="flex items-center gap-4 p-4 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-xl">
                    <div class="w-12 h-12 rounded-xl bg-green-100 dark:bg-green-900/30 flex items-center justify-center flex-shrink-0">
                        <i class="bi bi-file-earmark-check text-2xl text-green-600 dark:text-green-400"></i>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p id="fileName" class="text-sm font-semibold text-ink-900 dark:text-ink-100 truncate"></p>
                        <p id="fileSize" class="text-xs text-ink-500 dark:text-ink-400 mt-0.5"></p>
                    </div>
                    <button type="button" 
                            id="removeFile"
                            class="p-2 text-red-500 hover:bg-red-100 dark:hover:bg-red-900/30 rounded-lg transition-colors flex-shrink-0">
                        <i class="bi bi-x-lg"></i>
                    </button>
                </div>
            </div>
         
            <div id="errorMessage" class="hidden mt-4">
                <div class="flex items-center gap-4 p-4 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-xl">
                    <div class="w-12 h-12 rounded-xl bg-red-100 dark:bg-red-900/30 flex items-center justify-center flex-shrink-0">
                        <i class="bi bi-exclamation-triangle text-2xl text-red-600 dark:text-red-400"></i>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p id="errorText" class="text-sm font-semibold text-red-900 dark:text-red-200"></p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="px-6 py-4 bg-ink-50 dark:bg-ink-900/50 border-t border-ink-200 dark:border-ink-800">
            <button type="submit" 
                    id="submitBtn"
                    class="w-full inline-flex items-center justify-center gap-2 px-6 py-3 bg-gradient-to-r from-brand-600 to-sphere-600 text-white font-bold rounded-xl shadow-lg hover:shadow-xl hover:shadow-brand-500/30 hover:-translate-y-0.5 transition-all duration-300 disabled:opacity-50 disabled:cursor-not-allowed disabled:hover:translate-y-0 disabled:hover:shadow-lg">
                <i class="bi bi-cloud-arrow-up"></i>
                <span>Upload CSV</span>
            </button>
        </div>
    </div>
</form>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const dropZone = document.getElementById('dropZone');
    const fileInput = document.getElementById('fileInput');
    const filePreview = document.getElementById('filePreview');
    const fileName = document.getElementById('fileName');
    const fileSize = document.getElementById('fileSize');
    const removeFile = document.getElementById('removeFile');
    const errorMessage = document.getElementById('errorMessage');
    const errorText = document.getElementById('errorText');
    const submitBtn = document.getElementById('submitBtn');
    
    function formatFileSize(bytes) {
        if (bytes === 0) return '0 Bytes';
        const k = 1024;
        const sizes = ['Bytes', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return Math.round(bytes / Math.pow(k, i) * 100) / 100 + ' ' + sizes[i];
    }
   
    function handleFile(file) {
        errorMessage.classList.add('hidden');
        
        if (!file) {
            filePreview.classList.add('hidden');
            submitBtn.disabled = true;
            return;
        }
       
        if (!file.name.endsWith('.csv')) {
            errorMessage.classList.remove('hidden');
            errorText.textContent = 'Invalid file type. Only CSV files are accepted.';
            filePreview.classList.add('hidden');
            fileInput.value = '';
            submitBtn.disabled = true;
            return;
        }
       
        fileName.textContent = file.name;
        fileSize.textContent = formatFileSize(file.size);
        filePreview.classList.remove('hidden');
        submitBtn.disabled = false;
    }
    
    fileInput.addEventListener('change', function(e) {
        handleFile(e.target.files[0]);
    });
   
    dropZone.addEventListener('dragover', function(e) {
        e.preventDefault();
        dropZone.classList.add('border-brand-500', 'bg-brand-50/50', 'dark:bg-brand-900/10');
    });
    
    dropZone.addEventListener('dragleave', function(e) {
        e.preventDefault();
        dropZone.classList.remove('border-brand-500', 'bg-brand-50/50', 'dark:bg-brand-900/10');
    });
    
    dropZone.addEventListener('drop', function(e) {
        e.preventDefault();
        dropZone.classList.remove('border-brand-500', 'bg-brand-50/50', 'dark:bg-brand-900/10');
        
        const files = e.dataTransfer.files;
        if (files.length > 0) {
            fileInput.files = files;
            handleFile(files[0]);
        }
    });
   
    removeFile.addEventListener('click', function() {
        fileInput.value = '';
        filePreview.classList.add('hidden');
        errorMessage.classList.add('hidden');
        submitBtn.disabled = true;
    });
    
    document.getElementById('uploadForm').addEventListener('submit', function(e) {
        submitBtn.disabled = true;
        submitBtn.innerHTML = `
            <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            <span>Uploading...</span>
        `;
    });
});
</script>
@endpush