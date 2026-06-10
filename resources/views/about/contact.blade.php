@extends('layouts.app')
@section('title', 'Contact Us - DataSphere')
@section('meta_desc', 'Get in touch with the DataSphere Machine Learning Repository team')

@section('content')
<div class="relative">

    <section class="relative overflow-hidden bg-gradient-to-br from-brand-600 via-sphere-primary to-sphere-secondary text-white">
        <div class="absolute inset-0">
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_20%_80%,rgba(255,255,255,0.1)_0%,transparent_50%)]"></div>
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_80%_20%,rgba(255,255,255,0.08)_0%,transparent_50%)]"></div>
        </div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-16">

            <nav class="flex items-center gap-2 text-sm text-white/70 mb-4">
                <a href="{{ route('home') }}" class="hover:text-white transition-colors">Home</a>
                <i class="bi bi-chevron-right text-xs"></i>
                <a href="#" class="hover:text-white transition-colors">About</a>
                <i class="bi bi-chevron-right text-xs"></i>
                <span class="text-white">Contact</span>
            </nav>
            
            <div class="flex flex-col md:flex-row items-start md:items-center gap-6">
                <div class="flex-1">
                    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/10 backdrop-blur-sm border border-white/20 mb-4">
                        <i class="bi bi-envelope-fill text-yellow-300"></i>
                        <span class="text-sm font-semibold">Get in Touch</span>
                    </div>
                    
                    <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-3">
                        Contact Us
                    </h1>
                    <p class="text-white/90 text-base md:text-lg max-w-2xl leading-relaxed">
                        Have questions, feedback, or need support? We're here to help! Reach out to our team anytime.
                    </p>
                </div>
                
                <div class="hidden md:block">
                    <div class="w-32 h-32 rounded-3xl bg-white/10 backdrop-blur-md border-2 border-white/20 flex items-center justify-center shadow-2xl">
                        <i class="bi bi-envelope-paper text-6xl text-white/80"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

   
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid lg:grid-cols-[1fr_400px] gap-8">
            
          
            <div class="space-y-6">
                
                <!-- Contact Form -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-6 md:p-8">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 rounded-xl bg-brand-50 dark:bg-brand-900/30 flex items-center justify-center">
                            <i class="bi bi-send text-xl text-brand-600 dark:text-brand-400"></i>
                        </div>
                        <div>
                            <h2 class="text-xl font-bold text-gray-900 dark:text-white">Send us a Message</h2>
                            <p class="text-sm text-gray-500 dark:text-gray-400">We'll get back to you as soon as possible</p>
                        </div>
                    </div>
                    

                    @if(session('success'))
                    <div class="mb-4 p-4 rounded-xl bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 flex items-start gap-3">
                        <i class="bi bi-check-circle-fill text-green-500 text-xl mt-0.5"></i>
                        <div class="flex-1">
                            <p class="text-sm font-semibold text-green-800 dark:text-green-200">Message Sent!</p>
                            <p class="text-xs text-green-700 dark:text-green-300 mt-0.5">{{ session('success') }}</p>
                        </div>
                    </div>
                    @endif
                    
                    @if(session('error'))
                    <div class="mb-4 p-4 rounded-xl bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 flex items-start gap-3">
                        <i class="bi bi-exclamation-triangle-fill text-red-500 text-xl mt-0.5"></i>
                        <div class="flex-1">
                            <p class="text-sm font-semibold text-red-800 dark:text-red-200">Error</p>
                            <p class="text-xs text-red-700 dark:text-red-300 mt-0.5">{{ session('error') }}</p>
                        </div>
                    </div>
                    @endif
                    
                    <form action="{{ route('about.contact.send') }}" method="POST" class="space-y-4">
                        @csrf
                        
                        <div class="grid md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                    <i class="bi bi-person me-1"></i>Full Name <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="name" value="{{ old('name', auth()->user()->name ?? '') }}" required
                                       class="w-full px-4 py-2.5 rounded-xl bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-white focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 transition-all @error('name') border-red-500 @enderror"
                                       placeholder="Your name">
                                @error('name')
                                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                    <i class="bi bi-envelope me-1"></i>Email Address <span class="text-red-500">*</span>
                                </label>
                                <input type="email" name="email" value="{{ old('email', auth()->user()->email ?? '') }}" required
                                       class="w-full px-4 py-2.5 rounded-xl bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-white focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 transition-all @error('email') border-red-500 @enderror"
                                       placeholder="your@email.com">
                                @error('email')
                                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                <i class="bi bi-tag me-1"></i>Subject <span class="text-red-500">*</span>
                            </label>
                            <select name="subject" required
                                    class="w-full px-4 py-2.5 rounded-xl bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-white focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 transition-all @error('subject') border-red-500 @enderror">
                                <option value="">Select a subject</option>
                                <option value="General Inquiry" {{ old('subject') == 'General Inquiry' ? 'selected' : '' }}>General Inquiry</option>
                                <option value="Bug Report" {{ old('subject') == 'Bug Report' ? 'selected' : '' }}>Bug Report</option>
                                <option value="Feature Request" {{ old('subject') == 'Feature Request' ? 'selected' : '' }}>Feature Request</option>
                                <option value="Dataset Submission" {{ old('subject') == 'Dataset Submission' ? 'selected' : '' }}>Dataset Submission</option>
                                <option value="Citation Issue" {{ old('subject') == 'Citation Issue' ? 'selected' : '' }}>Citation Issue</option>
                                <option value="Technical Support" {{ old('subject') == 'Technical Support' ? 'selected' : '' }}>Technical Support</option>
                                <option value="Partnership" {{ old('subject') == 'Partnership' ? 'selected' : '' }}>Partnership</option>
                                <option value="Other" {{ old('subject') == 'Other' ? 'selected' : '' }}>Other</option>
                            </select>
                            @error('subject')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                <i class="bi bi-chat-text me-1"></i>Message <span class="text-red-500">*</span>
                            </label>
                            <textarea name="message" rows="6" required
                                      class="w-full px-4 py-2.5 rounded-xl bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-white focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 transition-all resize-none @error('message') border-red-500 @enderror"
                                      placeholder="Tell us how we can help you...">{{ old('message') }}</textarea>
                            @error('message')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                <span id="charCount">0</span>/1000 characters
                            </p>
                        </div>
                        
                        <div class="flex items-start gap-2">
                            <input type="checkbox" name="agree" id="agree" required class="mt-1 w-4 h-4 rounded border-gray-300 text-brand-600 focus:ring-brand-500">
                            <label for="agree" class="text-sm text-gray-600 dark:text-gray-400">
                                I agree to the <a href="#" class="text-brand-600 dark:text-brand-400 hover:underline">privacy policy</a> and consent to being contacted regarding my inquiry.
                            </label>
                        </div>
                        
                        <button type="submit" class="w-full inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl bg-gradient-to-r from-brand-600 to-sphere-secondary text-white font-semibold shadow-md hover:shadow-lg hover:-translate-y-0.5 transition-all">
                            <i class="bi bi-send"></i>
                            <span>Send Message</span>
                        </button>
                    </form>
                </div>
                
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-6 md:p-8">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 rounded-xl bg-amber-50 dark:bg-amber-900/30 flex items-center justify-center">
                            <i class="bi bi-question-circle text-xl text-amber-600 dark:text-amber-400"></i>
                        </div>
                        <h2 class="text-xl font-bold text-gray-900 dark:text-white">Frequently Asked Questions</h2>
                    </div>
                    
                    <div class="space-y-3">
                        <details class="group rounded-xl bg-gray-50 dark:bg-gray-700/30 border border-gray-100 dark:border-gray-700 overflow-hidden">
                            <summary class="flex items-center justify-between p-4 cursor-pointer list-none">
                                <span class="font-semibold text-gray-900 dark:text-white text-sm">How do I submit a dataset?</span>
                                <i class="bi bi-chevron-down text-gray-400 group-open:rotate-180 transition-transform"></i>
                            </summary>
                            <div class="px-4 pb-4 text-sm text-gray-600 dark:text-gray-400">
                                You can submit a dataset by clicking the "Contribute" button in the navigation bar. Please ensure your dataset complies with our submission guidelines and includes proper documentation.
                            </div>
                        </details>
                        
                        <details class="group rounded-xl bg-gray-50 dark:bg-gray-700/30 border border-gray-100 dark:border-gray-700 overflow-hidden">
                            <summary class="flex items-center justify-between p-4 cursor-pointer list-none">
                                <span class="font-semibold text-gray-900 dark:text-white text-sm">How long does the review process take?</span>
                                <i class="bi bi-chevron-down text-gray-400 group-open:rotate-180 transition-transform"></i>
                            </summary>
                            <div class="px-4 pb-4 text-sm text-gray-600 dark:text-gray-400">
                                Our team typically reviews submissions within 3-5 business days. You'll receive an email notification once your dataset has been approved or if additional information is needed.
                            </div>
                        </details>
                        
                        <details class="group rounded-xl bg-gray-50 dark:bg-gray-700/30 border border-gray-100 dark:border-gray-700 overflow-hidden">
                            <summary class="flex items-center justify-between p-4 cursor-pointer list-none">
                                <span class="font-semibold text-gray-900 dark:text-white text-sm">How should I cite a dataset?</span>
                                <i class="bi bi-chevron-down text-gray-400 group-open:rotate-180 transition-transform"></i>
                            </summary>
                            <div class="px-4 pb-4 text-sm text-gray-600 dark:text-gray-400">
                                Each dataset page has a "Cite" button that generates the correct citation format in BibTeX and APA styles. Visit our <a href="{{ route('about.citation') }}" class="text-brand-600 dark:text-brand-400 hover:underline">Citation Metadata</a> page for more details.
                            </div>
                        </details>
                        
                        <details class="group rounded-xl bg-gray-50 dark:bg-gray-700/30 border border-gray-100 dark:border-gray-700 overflow-hidden">
                            <summary class="flex items-center justify-between p-4 cursor-pointer list-none">
                                <span class="font-semibold text-gray-900 dark:text-white text-sm">Can I request a dataset to be added?</span>
                                <i class="bi bi-chevron-down text-gray-400 group-open:rotate-180 transition-transform"></i>
                            </summary>
                            <div class="px-4 pb-4 text-sm text-gray-600 dark:text-gray-400">
                                Yes! Use the contact form above and select "Feature Request" as the subject. Please provide details about the dataset, including its source and relevance to the machine learning community.
                            </div>
                        </details>
                    </div>
                </div>
            </div>
            
            <aside class="space-y-4 lg:sticky lg:top-24 lg:self-start">
                
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-6">
                    <h3 class="text-sm font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-4 flex items-center gap-2">
                        <i class="bi bi-info-circle"></i>Contact Information
                    </h3>
                    
                    <div class="space-y-4">
                        
                        <div class="flex items-start gap-3 p-3 rounded-xl bg-gray-50 dark:bg-gray-700/30 border border-gray-100 dark:border-gray-700">
                            <div class="w-9 h-9 rounded-lg bg-brand-100 dark:bg-brand-900/30 flex items-center justify-center flex-shrink-0">
                                <i class="bi bi-envelope-fill text-brand-600 dark:text-brand-400"></i>
                            </div>
                            <div class="min-w-0 flex-1">
                                <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1">Email</p>
                                <a href="mailto:dataspheremlrepository@gmail.com" class="text-sm text-brand-600 dark:text-brand-400 hover:underline break-all">
                                    dataspheremlrepository@gmail.com
                                </a>
                            </div>
                        </div>
                        
                        <div class="flex items-start gap-3 p-3 rounded-xl bg-gray-50 dark:bg-gray-700/30 border border-gray-100 dark:border-gray-700">
                            <div class="w-9 h-9 rounded-lg bg-green-100 dark:bg-green-900/30 flex items-center justify-center flex-shrink-0">
                                <i class="bi bi-geo-alt-fill text-green-600 dark:text-green-400"></i>
                            </div>
                            <div class="min-w-0 flex-1">
                                <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1">Address</p>
                                <p class="text-sm text-gray-700 dark:text-gray-300 leading-relaxed">
                                    Fakultas Ilmu Komputer dan Teknologi Informasi<br>
                                    Universitas Sumatera Utara<br>
                                    Medan, Indonesia
                                </p>
                            </div>
                        </div>
                        
                        <div class="flex items-start gap-3 p-3 rounded-xl bg-gray-50 dark:bg-gray-700/30 border border-gray-100 dark:border-gray-700">
                            <div class="w-9 h-9 rounded-lg bg-purple-100 dark:bg-purple-900/30 flex items-center justify-center flex-shrink-0">
                                <i class="bi bi-building text-purple-600 dark:text-purple-400"></i>
                            </div>
                            <div class="min-w-0 flex-1">
                                <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1">Institution</p>
                                <p class="text-sm text-gray-700 dark:text-gray-300">
                                    Universitas Sumatera Utara
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="bg-gradient-to-br from-brand-600 via-sphere-primary to-sphere-secondary rounded-2xl p-6 text-white shadow-xl">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-10 h-10 rounded-xl bg-white/15 backdrop-blur-sm flex items-center justify-center">
                            <i class="bi bi-clock text-xl"></i>
                        </div>
                        <h3 class="font-bold">Response Time</h3>
                    </div>
                    <p class="text-white/90 text-sm leading-relaxed mb-4">
                        We aim to respond to all inquiries within <strong class="text-white">24-48 hours</strong> during business days.
                    </p>
                    <div class="flex items-center gap-2 text-xs text-white/80">
                        <i class="bi bi-circle-fill text-green-400 text-[8px]"></i>
                        <span>Currently Active</span>
                    </div>
                </div>
               
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-6">
                    <h3 class="text-sm font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-4 flex items-center gap-2">
                        <i class="bi bi-calendar-check"></i>Support Hours
                    </h3>
                    <div class="space-y-2 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-600 dark:text-gray-400">Monday - Friday</span>
                            <span class="font-semibold text-gray-900 dark:text-white">08:00 - 17:00</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600 dark:text-gray-400">Saturday</span>
                            <span class="font-semibold text-gray-900 dark:text-white">09:00 - 14:00</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600 dark:text-gray-400">Sunday</span>
                            <span class="font-semibold text-red-500">Closed</span>
                        </div>
                        <p class="text-xs text-gray-500 dark:text-gray-400 pt-2 border-t border-gray-100 dark:border-gray-700 mt-2">
                            <i class="bi bi-info-circle me-1"></i>
                            Timezone: WIB (GMT+7)
                        </p>
                    </div>
                </div>
                
            </aside>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Character counter for message
const messageInput = document.querySelector('textarea[name="message"]');
const charCount = document.getElementById('charCount');

if (messageInput && charCount) {
    messageInput.addEventListener('input', function() {
        charCount.textContent = this.value.length;
        if (this.value.length > 1000) {
            charCount.classList.add('text-red-500');
        } else {
            charCount.classList.remove('text-red-500');
        }
    });
    
    charCount.textContent = messageInput.value.length;
}
</script>
@endpush
