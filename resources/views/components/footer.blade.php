<footer class="bg-[#0A1628] text-white">

    {{-- Main Footer Content --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-16 pb-10">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10 lg:gap-8">

            {{-- Column 1: Brand & Social --}}
            <div class="lg:col-span-1">
                {{-- Logo --}}
                <a href="{{ route('home') }}" class="flex items-center gap-2.5 mb-4 w-fit">
                    <div class="w-9 h-9 bg-[#C9A84C] rounded-xl flex items-center justify-center shadow-lg">
                        <svg class="w-5 h-5 text-[#0A1628]" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
                        </svg>
                    </div>
                    <span class="font-display font-bold text-xl tracking-wider text-white">SHEFAHOMES</span>
                </a>

                {{-- Tagline --}}
                <p class="text-gray-400 text-sm leading-relaxed mb-6">
                    Building Dreams Across Nigeria. Your trusted partner for premium real estate investments, sales, and rentals.
                </p>

                {{-- Social Icons --}}
                <div class="flex items-center gap-3">
                    {{-- Facebook --}}
                    <a href="{{ $settings['social_facebook'] ?? '#' }}"
                       target="_blank" rel="noopener"
                       class="w-9 h-9 rounded-full bg-white/10 hover:bg-[#C9A84C] flex items-center justify-center transition-all duration-200 hover:-translate-y-0.5 group"
                       aria-label="Facebook">
                        <svg class="w-4 h-4 text-gray-400 group-hover:text-[#0A1628]" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                        </svg>
                    </a>

                    {{-- Instagram --}}
                    <a href="{{ $settings['social_instagram'] ?? '#' }}"
                       target="_blank" rel="noopener"
                       class="w-9 h-9 rounded-full bg-white/10 hover:bg-[#C9A84C] flex items-center justify-center transition-all duration-200 hover:-translate-y-0.5 group"
                       aria-label="Instagram">
                        <svg class="w-4 h-4 text-gray-400 group-hover:text-[#0A1628]" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                        </svg>
                    </a>

                    {{-- Twitter/X --}}
                    <a href="{{ $settings['social_twitter'] ?? '#' }}"
                       target="_blank" rel="noopener"
                       class="w-9 h-9 rounded-full bg-white/10 hover:bg-[#C9A84C] flex items-center justify-center transition-all duration-200 hover:-translate-y-0.5 group"
                       aria-label="Twitter">
                        <svg class="w-4 h-4 text-gray-400 group-hover:text-[#0A1628]" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                        </svg>
                    </a>

                    {{-- LinkedIn --}}
                    <a href="{{ $settings['social_linkedin'] ?? '#' }}"
                       target="_blank" rel="noopener"
                       class="w-9 h-9 rounded-full bg-white/10 hover:bg-[#C9A84C] flex items-center justify-center transition-all duration-200 hover:-translate-y-0.5 group"
                       aria-label="LinkedIn">
                        <svg class="w-4 h-4 text-gray-400 group-hover:text-[#0A1628]" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                        </svg>
                    </a>

                    {{-- YouTube --}}
                    <a href="{{ $settings['social_youtube'] ?? '#' }}"
                       target="_blank" rel="noopener"
                       class="w-9 h-9 rounded-full bg-white/10 hover:bg-[#C9A84C] flex items-center justify-center transition-all duration-200 hover:-translate-y-0.5 group"
                       aria-label="YouTube">
                        <svg class="w-4 h-4 text-gray-400 group-hover:text-[#0A1628]" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M23.498 6.186a3.016 3.016 0 00-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 00.502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 002.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 002.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                        </svg>
                    </a>
                </div>

                {{-- Certifications --}}
                <div class="mt-6 flex items-center gap-2">
                    <div class="px-3 py-1.5 bg-white/5 border border-white/10 rounded-lg text-xs text-gray-400 font-medium">
                        RC: {{ $settings['rc_number'] ?? '123456' }}
                    </div>
                    <div class="px-3 py-1.5 bg-[#C9A84C]/10 border border-[#C9A84C]/20 rounded-lg text-xs text-[#C9A84C] font-medium">
                        EFCC Certified
                    </div>
                </div>
            </div>

            {{-- Column 2: Quick Links --}}
            <div>
                <h4 class="font-display text-white font-semibold text-base mb-5">Properties</h4>
                <ul class="space-y-3">
                    <li>
                        <a href="{{ route('properties.index') }}"
                           class="text-gray-400 hover:text-[#C9A84C] text-sm transition-colors flex items-center gap-2 group">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#C9A84C]/40 group-hover:bg-[#C9A84C] transition-colors flex-shrink-0"></span>
                            All Properties
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('properties.index', ['type' => 'sale']) }}"
                           class="text-gray-400 hover:text-[#C9A84C] text-sm transition-colors flex items-center gap-2 group">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#C9A84C]/40 group-hover:bg-[#C9A84C] transition-colors flex-shrink-0"></span>
                            Properties for Sale
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('properties.index', ['type' => 'rent']) }}"
                           class="text-gray-400 hover:text-[#C9A84C] text-sm transition-colors flex items-center gap-2 group">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#C9A84C]/40 group-hover:bg-[#C9A84C] transition-colors flex-shrink-0"></span>
                            Properties for Rent
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('properties.index', ['type' => 'shortlet']) }}"
                           class="text-gray-400 hover:text-[#C9A84C] text-sm transition-colors flex items-center gap-2 group">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#C9A84C]/40 group-hover:bg-[#C9A84C] transition-colors flex-shrink-0"></span>
                            Shortlet Apartments
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('properties.map') }}"
                           class="text-gray-400 hover:text-[#C9A84C] text-sm transition-colors flex items-center gap-2 group">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#C9A84C]/40 group-hover:bg-[#C9A84C] transition-colors flex-shrink-0"></span>
                            Property Map
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('virtual-tour') }}"
                           class="text-gray-400 hover:text-[#C9A84C] text-sm transition-colors flex items-center gap-2 group">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#C9A84C]/40 group-hover:bg-[#C9A84C] transition-colors flex-shrink-0"></span>
                            Virtual Tours
                        </a>
                    </li>
                </ul>
            </div>

            {{-- Column 3: Company --}}
            <div>
                <h4 class="font-display text-white font-semibold text-base mb-5">Company</h4>
                <ul class="space-y-3">
                    <li>
                        <a href="{{ route('about') }}"
                           class="text-gray-400 hover:text-[#C9A84C] text-sm transition-colors flex items-center gap-2 group">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#C9A84C]/40 group-hover:bg-[#C9A84C] transition-colors flex-shrink-0"></span>
                            About Us
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('team') }}"
                           class="text-gray-400 hover:text-[#C9A84C] text-sm transition-colors flex items-center gap-2 group">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#C9A84C]/40 group-hover:bg-[#C9A84C] transition-colors flex-shrink-0"></span>
                            Our Team
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('careers') }}"
                           class="text-gray-400 hover:text-[#C9A84C] text-sm transition-colors flex items-center gap-2 group">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#C9A84C]/40 group-hover:bg-[#C9A84C] transition-colors flex-shrink-0"></span>
                            Careers
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('blog.index') }}"
                           class="text-gray-400 hover:text-[#C9A84C] text-sm transition-colors flex items-center gap-2 group">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#C9A84C]/40 group-hover:bg-[#C9A84C] transition-colors flex-shrink-0"></span>
                            Blog & News
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('faqs') }}"
                           class="text-gray-400 hover:text-[#C9A84C] text-sm transition-colors flex items-center gap-2 group">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#C9A84C]/40 group-hover:bg-[#C9A84C] transition-colors flex-shrink-0"></span>
                            FAQs
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('contact') }}"
                           class="text-gray-400 hover:text-[#C9A84C] text-sm transition-colors flex items-center gap-2 group">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#C9A84C]/40 group-hover:bg-[#C9A84C] transition-colors flex-shrink-0"></span>
                            Contact Us
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('login', ['portal' => 'investor']) }}"
                           class="text-gray-400 hover:text-[#C9A84C] text-sm transition-colors flex items-center gap-2 group">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#C9A84C]/40 group-hover:bg-[#C9A84C] transition-colors flex-shrink-0"></span>
                            Investor Portal
                        </a>
                    </li>
                </ul>
            </div>

            {{-- Column 4: Contact & Newsletter --}}
            <div>
                <h4 class="font-display text-white font-semibold text-base mb-5">Get in Touch</h4>

                {{-- Contact Details --}}
                <ul class="space-y-3.5 mb-7">
                    <li class="flex items-start gap-3">
                        <div class="w-7 h-7 bg-[#C9A84C]/10 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                            <svg class="w-3.5 h-3.5 text-[#C9A84C]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <span class="text-gray-400 text-sm leading-relaxed">{{ $settings['address'] ?? '5 Admiralty Way, Lekki Phase 1, Lagos, Nigeria' }}</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <div class="w-7 h-7 bg-[#C9A84C]/10 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-3.5 h-3.5 text-[#C9A84C]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                        </div>
                        <a href="tel:{{ $settings['phone'] ?? '+2348000000000' }}"
                           class="text-gray-400 hover:text-[#C9A84C] text-sm transition-colors">
                            {{ $settings['phone'] ?? '+234 800 000 0000' }}
                        </a>
                    </li>
                    <li class="flex items-center gap-3">
                        <div class="w-7 h-7 bg-[#C9A84C]/10 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-3.5 h-3.5 text-[#C9A84C]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <a href="mailto:{{ $settings['email'] ?? 'hello@shefahomes.com' }}"
                           class="text-gray-400 hover:text-[#C9A84C] text-sm transition-colors">
                            {{ $settings['email'] ?? 'hello@shefahomes.com' }}
                        </a>
                    </li>
                </ul>

                {{-- Newsletter --}}
                <div x-data="{
                    email: '',
                    loading: false,
                    success: false,
                    error: '',
                    async submit() {
                        this.loading = true;
                        this.error = '';
                        try {
                            const res = await fetch('{{ route('newsletter.subscribe') }}', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content,
                                    'Accept': 'application/json'
                                },
                                body: JSON.stringify({ email: this.email })
                            });
                            const data = await res.json();
                            if (res.ok) {
                                this.success = true;
                                this.email = '';
                            } else {
                                this.error = data.message || 'Something went wrong. Please try again.';
                            }
                        } catch(e) {
                            this.error = 'Network error. Please try again.';
                        } finally {
                            this.loading = false;
                        }
                    }
                }">
                    <h5 class="text-white text-sm font-semibold mb-3">Newsletter</h5>
                    <p class="text-gray-400 text-xs leading-relaxed mb-3">Get property updates and market insights delivered to your inbox.</p>

                    <div x-show="success" x-transition class="bg-green-900/30 border border-green-700/40 text-green-400 text-xs rounded-xl px-3 py-2.5 flex items-center gap-2">
                        <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Subscribed! Thank you.
                    </div>

                    <form x-show="!success" @submit.prevent="submit()" class="space-y-2">
                        <div class="relative">
                            <input type="email"
                                   x-model="email"
                                   required
                                   placeholder="Your email address"
                                   class="w-full bg-white/10 border border-white/20 rounded-xl px-4 py-2.5 text-sm text-white placeholder-gray-500 focus:outline-none focus:border-[#C9A84C] transition-colors">
                        </div>
                        <div x-show="error" class="text-red-400 text-xs" x-text="error"></div>
                        <button type="submit"
                                :disabled="loading"
                                class="w-full bg-[#C9A84C] hover:bg-[#E8C97A] text-[#0A1628] font-semibold py-2.5 px-4 rounded-xl text-sm transition-all duration-200 hover:-translate-y-0.5 disabled:opacity-60 disabled:cursor-not-allowed flex items-center justify-center gap-2">
                            <svg x-show="loading" class="w-3.5 h-3.5 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                            </svg>
                            <span x-show="!loading">Subscribe</span>
                            <span x-show="loading" style="display:none;">Subscribing...</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Bottom Bar --}}
    <div class="border-t border-white/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-5">
            <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                <p class="text-gray-500 text-sm text-center sm:text-left">
                    &copy; {{ date('Y') }} <span class="text-[#C9A84C] font-medium">SHEFAHOMES</span>. All rights reserved. Built with excellence in Nigeria.
                </p>
                <div class="flex items-center gap-5">
                    <a href="{{ route('privacy') }}"
                       class="text-gray-500 hover:text-[#C9A84C] text-xs transition-colors">
                        Privacy Policy
                    </a>
                    <span class="text-gray-700">·</span>
                    <a href="{{ route('terms') }}"
                       class="text-gray-500 hover:text-[#C9A84C] text-xs transition-colors">
                        Terms of Service
                    </a>
                    <span class="text-gray-700">·</span>
                    <a href="{{ route('sitemap') }}"
                       class="text-gray-500 hover:text-[#C9A84C] text-xs transition-colors">
                        Sitemap
                    </a>
                </div>
            </div>
        </div>
    </div>
</footer>
