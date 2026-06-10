@extends('layouts.app')
@section('title', 'Citation Metadata - DataSphere')
@section('meta_desc', 'Learn how to properly cite datasets from DataSphere Machine Learning Repository')

@section('content')
<div class="relative">
    
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
                <span class="text-white">Citation Metadata</span>
            </nav>
            
            <div class="flex flex-col md:flex-row items-start md:items-center gap-6">
                <div class="flex-1">
                    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/10 backdrop-blur-sm border border-white/20 mb-4">
                        <i class="bi bi-quote text-yellow-300"></i>
                        <span class="text-sm font-semibold">Academic Standards</span>
                    </div>
                    
                    <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-3">
                        Citation Metadata
                    </h1>
                    <p class="text-white/90 text-base md:text-lg max-w-2xl leading-relaxed">
                        Proper citation guidelines for datasets used in research, ensuring reproducibility and acknowledging contributors.
                    </p>
                </div>
                
                <div class="hidden md:block">
                    <div class="w-32 h-32 rounded-3xl bg-white/10 backdrop-blur-md border-2 border-white/20 flex items-center justify-center shadow-2xl">
                        <i class="bi bi-journal-text text-6xl text-white/80"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="space-y-8">
          
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-6 md:p-8">
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 rounded-xl bg-brand-50 dark:bg-brand-900/30 flex items-center justify-center flex-shrink-0">
                        <i class="bi bi-info-circle text-2xl text-brand-600 dark:text-brand-400"></i>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-3">Why Citation Matters</h2>
                        <p class="text-gray-700 dark:text-gray-300 leading-relaxed mb-4">
                            When using datasets from DataSphere Machine Learning Repository in your research, proper citation is essential to:
                        </p>
                        <ul class="space-y-2">
                            <li class="flex items-start gap-2 text-gray-700 dark:text-gray-300">
                                <i class="bi bi-check-circle-fill text-green-500 mt-1 flex-shrink-0"></i>
                                <span>Acknowledge the original contributors and data collectors</span>
                            </li>
                            <li class="flex items-start gap-2 text-gray-700 dark:text-gray-300">
                                <i class="bi bi-check-circle-fill text-green-500 mt-1 flex-shrink-0"></i>
                                <span>Enable reproducibility of your research findings</span>
                            </li>
                            <li class="flex items-start gap-2 text-gray-700 dark:text-gray-300">
                                <i class="bi bi-check-circle-fill text-green-500 mt-1 flex-shrink-0"></i>
                                <span>Support the academic community in tracking dataset usage</span>
                            </li>
                            <li class="flex items-start gap-2 text-gray-700 dark:text-gray-300">
                                <i class="bi bi-check-circle-fill text-green-500 mt-1 flex-shrink-0"></i>
                                <span>Maintain proper academic integrity and ethics</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-6 md:p-8">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 rounded-xl bg-purple-50 dark:bg-purple-900/30 flex items-center justify-center">
                        <i class="bi bi-file-text text-xl text-purple-600 dark:text-purple-400"></i>
                    </div>
                    <h2 class="text-xl font-bold text-gray-900 dark:text-white">General Citation Format</h2>
                </div>
                
                <p class="text-gray-700 dark:text-gray-300 leading-relaxed mb-4">
                    Use the following template as a general guideline for citing datasets:
                </p>
                
                <div class="bg-gradient-to-r from-brand-50 to-sphere-secondary/10 dark:from-brand-900/20 dark:to-sphere-secondary/10 border-l-4 border-brand-500 p-5 rounded-r-xl mb-4">
                    <p class="text-gray-800 dark:text-gray-200 leading-relaxed">
                        <strong class="text-brand-700 dark:text-brand-400">Author(s)</strong> (<span class="text-brand-700 dark:text-brand-400">Year</span>). 
                        <em>Dataset Name</em> [Dataset]. 
                        <span class="font-semibold">DataSphere Machine Learning Repository</span>. 
                        <span class="text-brand-600 dark:text-brand-400 break-all">https://doi.org/xxxx</span>
                    </p>
                </div>
                
                <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-xl p-4 flex items-start gap-3">
                    <i class="bi bi-lightbulb-fill text-blue-500 text-xl mt-0.5 flex-shrink-0"></i>
                    <div class="text-sm text-blue-800 dark:text-blue-200">
                        <strong>Example:</strong> Dua, D. & Graff, C. (2017). <em>Iris</em> [Dataset]. DataSphere Machine Learning Repository. https://doi.org/10.24432/C56C76
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-6 md:p-8">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-amber-50 dark:bg-amber-900/30 flex items-center justify-center">
                            <i class="bi bi-code-slash text-xl text-amber-600 dark:text-amber-400"></i>
                        </div>
                        <h2 class="text-xl font-bold text-gray-900 dark:text-white">BibTeX Format</h2>
                    </div>
                    <button onclick="copyBibtex()" id="copyBtn" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200 text-sm font-semibold hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors">
                        <i class="bi bi-clipboard"></i>
                        <span>Copy</span>
                    </button>
                </div>
                
                <p class="text-gray-700 dark:text-gray-300 leading-relaxed mb-4">
                    For LaTeX users, copy the BibTeX entry below and add it to your bibliography file:
                </p>
                
                <div class="relative">
                    <pre id="bibtexCode" class="bg-gray-900 dark:bg-gray-950 text-gray-100 p-5 rounded-xl overflow-x-auto text-sm font-mono leading-relaxed border border-gray-700"><code>@dataset{datasphere2024,
  author    = {Author Name},
  title     = {Dataset Name},
  year      = {2024},
  publisher = {DataSphere Machine Learning Repository},
  url       = {https://datasphere.example.com/dataset/xxx},
  doi       = {10.24433/CO.xxxxxx.x}
}</code></pre>
                </div>
                
                <div class="mt-4 grid md:grid-cols-2 gap-3">
                    <div class="p-3 rounded-xl bg-gray-50 dark:bg-gray-700/30 border border-gray-100 dark:border-gray-700">
                        <div class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1">Entry Type</div>
                        <div class="text-sm font-semibold text-gray-900 dark:text-white">@dataset</div>
                    </div>
                    <div class="p-3 rounded-xl bg-gray-50 dark:bg-gray-700/30 border border-gray-100 dark:border-gray-700">
                        <div class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1">Required Fields</div>
                        <div class="text-sm font-semibold text-gray-900 dark:text-white">author, title, year, publisher</div>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-6 md:p-8">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 rounded-xl bg-green-50 dark:bg-green-900/30 flex items-center justify-center">
                        <i class="bi bi-mortarboard text-xl text-green-600 dark:text-green-400"></i>
                    </div>
                    <h2 class="text-xl font-bold text-gray-900 dark:text-white">APA Format (7th Edition)</h2>
                </div>
                
                <p class="text-gray-700 dark:text-gray-300 leading-relaxed mb-4">
                    The American Psychological Association (APA) format is commonly used in social sciences:
                </p>
                
                <div class="bg-gray-50 dark:bg-gray-700/30 p-5 rounded-xl border border-gray-100 dark:border-gray-700">
                    <p class="text-gray-800 dark:text-gray-200 leading-relaxed font-mono text-sm">
                        Author, A. A., & Author, B. B. (Year). <em>Title of dataset</em> (Version number) [Dataset]. DataSphere Machine Learning Repository. https://doi.org/xxxxx
                    </p>
                </div>
                
                <div class="mt-4 p-4 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-xl">
                    <p class="text-sm text-green-800 dark:text-green-200">
                        <strong>Example:</strong> Fisher, R. A. (1936). <em>Iris</em> [Dataset]. DataSphere Machine Learning Repository. https://doi.org/10.24432/C56C76
                    </p>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-6 md:p-8">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 rounded-xl bg-cyan-50 dark:bg-cyan-900/30 flex items-center justify-center">
                        <i class="bi bi-bookmark-check text-xl text-cyan-600 dark:text-cyan-400"></i>
                    </div>
                    <h2 class="text-xl font-bold text-gray-900 dark:text-white">Best Practices</h2>
                </div>
                
                <div class="space-y-4">
                    <div class="flex items-start gap-3 p-4 rounded-xl bg-gray-50 dark:bg-gray-700/30 border border-gray-100 dark:border-gray-700">
                        <div class="w-8 h-8 rounded-lg bg-brand-100 dark:bg-brand-900/30 flex items-center justify-center flex-shrink-0">
                            <span class="text-brand-600 dark:text-brand-400 font-bold">1</span>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-900 dark:text-white mb-1">Check Dataset Page</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Each dataset page has a "Cite" button that generates the correct citation format automatically with all required fields.</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start gap-3 p-4 rounded-xl bg-gray-50 dark:bg-gray-700/30 border border-gray-100 dark:border-gray-700">
                        <div class="w-8 h-8 rounded-lg bg-brand-100 dark:bg-brand-900/30 flex items-center justify-center flex-shrink-0">
                            <span class="text-brand-600 dark:text-brand-400 font-bold">2</span>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-900 dark:text-white mb-1">Include DOI When Available</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Digital Object Identifiers (DOIs) provide permanent links to datasets. Always include DOI if available for better citation stability.</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start gap-3 p-4 rounded-xl bg-gray-50 dark:bg-gray-700/30 border border-gray-100 dark:border-gray-700">
                        <div class="w-8 h-8 rounded-lg bg-brand-100 dark:bg-brand-900/30 flex items-center justify-center flex-shrink-0">
                            <span class="text-brand-600 dark:text-brand-400 font-bold">3</span>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-900 dark:text-white mb-1">Specify Version</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400">If the dataset has multiple versions, specify which version you used to ensure reproducibility of your research.</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start gap-3 p-4 rounded-xl bg-gray-50 dark:bg-gray-700/30 border border-gray-100 dark:border-gray-700">
                        <div class="w-8 h-8 rounded-lg bg-brand-100 dark:bg-brand-900/30 flex items-center justify-center flex-shrink-0">
                            <span class="text-brand-600 dark:text-brand-400 font-bold">4</span>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-900 dark:text-white mb-1">Follow Journal Guidelines</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Different journals and conferences may have specific citation requirements. Always check the author guidelines before submission.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-brand-600 via-sphere-primary to-sphere-secondary rounded-2xl p-6 md:p-8 text-white shadow-xl">
                <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
                    <div>
                        <h3 class="text-xl font-bold mb-2">Ready to Cite a Dataset?</h3>
                        <p class="text-white/90 text-sm">Browse our collection and find the perfect dataset for your research.</p>
                    </div>
                    <div class="flex gap-3">
                        <a href="{{ route('datasets.index') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-white text-brand-700 font-semibold shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition-all">
                            <i class="bi bi-search"></i>
                            <span>Browse Datasets</span>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function copyBibtex() {
    const code = document.getElementById('bibtexCode').textContent;
    const btn = document.getElementById('copyBtn');
    
    navigator.clipboard.writeText(code).then(() => {
        const original = btn.innerHTML;
        btn.innerHTML = '<i class="bi bi-check-circle"></i><span>Copied!</span>';
        btn.classList.remove('bg-gray-100', 'dark:bg-gray-700');
        btn.classList.add('bg-green-500', 'text-white');
        setTimeout(() => {
            btn.innerHTML = original;
            btn.classList.remove('bg-green-500', 'text-white');
            btn.classList.add('bg-gray-100', 'dark:bg-gray-700');
        }, 2000);
    });
}
</script>
@endpush
