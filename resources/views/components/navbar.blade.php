<nav x-data="{
        scrolled: false,
        mobileOpen: false,
        propertiesOpen: false,
        init() {
            window.addEventListener('scroll', () => {
                this.scrolled = window.scrollY > 50;
            });
        }
    }"
    :class="scrolled
        ? 'bg-[#1A237E] shadow-xl shadow-black/20'
        : 'bg-transparent'"
    class="fixed top-0 left-0 right-0 z-50 transition-all duration-400"
    @click.away="propertiesOpen=false">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-20">

            {{-- Brand Logo --}}
            <a href="{{ route('home') }}" class="flex items-center gap-2.5 group flex-shrink-0">
                <div class="w-9 h-9 bg-[#27AE22] rounded-xl flex items-center justify-center shadow-lg group-hover:scale-105 transition-transform duration-200">
                    <svg class="w-5 h-5 text-[#1A237E]" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
                    </svg>
                </div>
                <div>
                    <span class="font-display font-bold text-white text-lg tracking-wider leading-none block">SHEFAHOMES</span>
                    <span class="text-[#27AE22] text-xs leading-none tracking-widest uppercase">Premium Real Estate</span>
                </div>
            </a>

            {{-- Desktop Navigation --}}
            <div class="hidden lg:flex items-center gap-1">

                {{-- Home --}}
                <a href="{{ route('home') }}"
                   class="px-4 py-2 text-sm font-medium rounded-lg transition-colors duration-200
                          {{ request()->routeIs('home') ? 'text-[#27AE22]' : 'text-gray-200 hover:text-white hover:bg-white/10' }}">
                    Home
                </a>

                {{-- Properties Dropdown --}}
                <div class="relative" x-data="{ open: false }" @mouseenter="open=true" @mouseleave="open=false">
                    <button class="flex items-center gap-1 px-4 py-2 text-sm font-medium rounded-lg transition-colors duration-200
                                   {{ request()->routeIs('properties*') ? 'text-[#27AE22]' : 'text-gray-200 hover:text-white hover:bg-white/10' }}">
                        Properties
                        <svg class="w-4 h-4 transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>

                    {{-- Dropdown Panel --}}
                    <div x-show="open"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 translate-y-1"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100 translate-y-0"
                         x-transition:leave-end="opacity-0 translate-y-1"
                         class="absolute top-full left-1/2 -translate-x-1/2 mt-1 w-56 bg-white rounded-2xl shadow-2xl border border-gray-100 py-2 z-50"
                         style="display:none;">

                        <a href="{{ route('properties.index') }}"
                           class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-[#1A237E]/5 hover:text-[#1A237E] transition-colors group">
                            <div class="w-7 h-7 bg-[#1A237E]/8 rounded-lg flex items-center justify-center group-hover:bg-[#27AE22]/20">
                                <svg class="w-3.5 h-3.5 text-[#27AE22]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                                </svg>
                            </div>
                            All Properties
                        </a>

                        <a href="{{ route('properties.index', ['type' => 'sale']) }}"
                           class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-[#1A237E]/5 hover:text-[#1A237E] transition-colors group">
                            <div class="w-7 h-7 bg-[#1A237E]/8 rounded-lg flex items-center justify-center group-hover:bg-[#27AE22]/20">
                                <svg class="w-3.5 h-3.5 text-[#27AE22]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                </svg>
                            </div>
                            For Sale
                        </a>

                        <a href="{{ route('properties.index', ['type' => 'rent']) }}"
                           class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-[#1A237E]/5 hover:text-[#1A237E] transition-colors group">
                            <div class="w-7 h-7 bg-[#1A237E]/8 rounded-lg flex items-center justify-center group-hover:bg-[#27AE22]/20">
                                <svg class="w-3.5 h-3.5 text-[#27AE22]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                </svg>
                            </div>
                            For Rent
                        </a>

                        <a href="{{ route('properties.index', ['type' => 'shortlet']) }}"
                           class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-[#1A237E]/5 hover:text-[#1A237E] transition-colors group">
                            <div class="w-7 h-7 bg-[#1A237E]/8 rounded-lg flex items-center justify-center group-hover:bg-[#27AE22]/20">
                                <svg class="w-3.5 h-3.5 text-[#27AE22]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            Shortlets
                        </a>

                        <div class="border-t border-gray-100 my-1"></div>

                        <a href="{{ route('properties.index') }}"
                           class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-[#1A237E]/5 hover:text-[#1A237E] transition-colors group">
                            <div class="w-7 h-7 bg-[#1A237E]/8 rounded-lg flex items-center justify-center group-hover:bg-[#27AE22]/20">
                                <svg class="w-3.5 h-3.5 text-[#27AE22]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                            Map View
                        </a>
                    </div>
                </div>

                {{-- Virtual Tour --}}
                <a href="{{ route('virtual-tour') }}"
                   class="px-4 py-2 text-sm font-medium rounded-lg transition-colors duration-200
                          {{ request()->routeIs('virtual-tour') ? 'text-[#27AE22]' : 'text-gray-200 hover:text-white hover:bg-white/10' }}">
                    Virtual Tour
                </a>

                {{-- Blog --}}
                <a href="{{ route('blog.index') }}"
                   class="px-4 py-2 text-sm font-medium rounded-lg transition-colors duration-200
                          {{ request()->routeIs('blog*') ? 'text-[#27AE22]' : 'text-gray-200 hover:text-white hover:bg-white/10' }}">
                    Blog
                </a>

                {{-- Company Dropdown --}}
                <div class="relative" x-data="{ open: false }" @mouseenter="open=true" @mouseleave="open=false">
                    <button class="flex items-center gap-1 px-4 py-2 text-sm font-medium rounded-lg transition-colors duration-200
                                   {{ request()->routeIs('about','services','joint-venture','investor-info','csr') ? 'text-[#27AE22]' : 'text-gray-200 hover:text-white hover:bg-white/10' }}">
                        Company
                        <svg class="w-4 h-4 transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div x-show="open"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 translate-y-1"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100 translate-y-0"
                         x-transition:leave-end="opacity-0 translate-y-1"
                         class="absolute top-full left-1/2 -translate-x-1/2 mt-1 w-60 bg-white rounded-2xl shadow-2xl border border-gray-100 py-2 z-50"
                         style="display:none;">
                        @foreach([
                            ['About Us', route('about'), 'M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z', 'about'],
                            ['Our Services', route('services'), 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5', 'services'],
                            ['JV Partnership', route('joint-venture'), 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0', 'joint-venture'],
                            ['Invest With Us', route('investor-info'), 'M13 7h8m0 0v8m0-8l-8 8-4-4-6 6', 'investor-info'],
                        ] as [$label, $url, $icon, $route])
                        <a href="{{ $url }}"
                           class="flex items-center gap-3 px-4 py-2.5 text-sm {{ request()->routeIs($route) ? 'text-[#27AE22] bg-[#27AE22]/5' : 'text-gray-700 hover:bg-[#1A237E]/5 hover:text-[#1A237E]' }} transition-colors group">
                            <div class="w-7 h-7 bg-[#1A237E]/8 rounded-lg flex items-center justify-center group-hover:bg-[#27AE22]/20 transition-colors">
                                <svg class="w-3.5 h-3.5 text-[#27AE22]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $icon }}"/>
                                </svg>
                            </div>
                            {{ $label }}
                        </a>
                        @endforeach
                        @if($navMenuItems->isNotEmpty())
                        <div class="border-t border-gray-100 my-1"></div>
                        @foreach($navMenuItems as $navItem)
                        <a href="{{ $navItem->url }}" {{ $navItem->opens_new_tab ? 'target="_blank" rel="noopener"' : '' }}
                           class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-[#1A237E]/5 hover:text-[#1A237E] transition-colors group">
                            <div class="w-7 h-7 bg-[#1A237E]/8 rounded-lg flex items-center justify-center group-hover:bg-[#27AE22]/20">
                                <svg class="w-3 h-3 text-[#27AE22]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </div>
                            {{ $navItem->label }}
                        </a>
                        @endforeach
                        @endif
                    </div>
                </div>

                {{-- Contact --}}
                <a href="{{ route('contact') }}"
                   class="px-4 py-2 text-sm font-medium rounded-lg transition-colors duration-200
                          {{ request()->routeIs('contact') ? 'text-[#27AE22]' : 'text-gray-200 hover:text-white hover:bg-white/10' }}">
                    Contact
                </a>
            </div>

            {{-- Desktop CTA Buttons --}}
            <div class="hidden lg:flex items-center gap-3">
                <a href="{{ route('login', ['portal' => 'investor']) }}"
                   class="px-5 py-2 text-sm font-semibold text-[#27AE22] border border-[#27AE22]/60 rounded-full hover:bg-[#27AE22]/10 hover:border-[#27AE22] transition-all duration-200">
                    Investor Portal
                </a>
                <a href="{{ route('login') }}"
                   class="px-5 py-2 text-sm font-semibold bg-[#27AE22] text-[#1A237E] rounded-full hover:bg-[#4ADE80] transition-all duration-200 shadow-lg shadow-[#27AE22]/20 hover:shadow-[#27AE22]/40 hover:-translate-y-0.5">
                    Client Login
                </a>
            </div>

            {{-- Mobile Hamburger --}}
            <button @click="mobileOpen=!mobileOpen"
                    class="lg:hidden text-white p-2 rounded-lg hover:bg-white/10 transition-colors"
                    :aria-label="mobileOpen ? 'Close menu' : 'Open menu'">
                <svg x-show="!mobileOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
                <svg x-show="mobileOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display:none;">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    </div>

    {{-- Mobile Menu Overlay --}}
    <div x-show="mobileOpen"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 -translate-y-4"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-4"
         class="lg:hidden bg-[#1A237E] border-t border-white/10 shadow-2xl"
         style="display:none;">

        <div class="max-w-7xl mx-auto px-4 py-4 space-y-1">

            <a href="{{ route('home') }}"
               @click="mobileOpen=false"
               class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-colors
                      {{ request()->routeIs('home') ? 'text-[#27AE22] bg-[#27AE22]/10' : 'text-gray-200 hover:text-white hover:bg-white/10' }}">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                Home
            </a>

            {{-- Mobile Properties (expandable) --}}
            <div x-data="{ propertiesMobileOpen: false }">
                <button @click="propertiesMobileOpen=!propertiesMobileOpen"
                        class="w-full flex items-center justify-between gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-colors
                               {{ request()->routeIs('properties*') ? 'text-[#27AE22] bg-[#27AE22]/10' : 'text-gray-200 hover:text-white hover:bg-white/10' }}">
                    <span class="flex items-center gap-3">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                        Properties
                    </span>
                    <svg class="w-4 h-4 transition-transform" :class="propertiesMobileOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div x-show="propertiesMobileOpen" x-transition class="mt-1 ml-4 pl-4 border-l border-white/10 space-y-1">
                    <a href="{{ route('properties.index') }}" @click="mobileOpen=false" class="block px-3 py-2 text-sm text-gray-300 hover:text-[#27AE22] rounded-lg transition-colors">All Properties</a>
                    <a href="{{ route('properties.index', ['type' => 'sale']) }}" @click="mobileOpen=false" class="block px-3 py-2 text-sm text-gray-300 hover:text-[#27AE22] rounded-lg transition-colors">For Sale</a>
                    <a href="{{ route('properties.index', ['type' => 'rent']) }}" @click="mobileOpen=false" class="block px-3 py-2 text-sm text-gray-300 hover:text-[#27AE22] rounded-lg transition-colors">For Rent</a>
                    <a href="{{ route('properties.index', ['type' => 'shortlet']) }}" @click="mobileOpen=false" class="block px-3 py-2 text-sm text-gray-300 hover:text-[#27AE22] rounded-lg transition-colors">Shortlets</a>
                    <a href="{{ route('properties.index') }}" @click="mobileOpen=false" class="block px-3 py-2 text-sm text-gray-300 hover:text-[#27AE22] rounded-lg transition-colors">Map View</a>
                </div>
            </div>



            <a href="{{ route('virtual-tour') }}"
               @click="mobileOpen=false"
               class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-colors
                      {{ request()->routeIs('virtual-tour') ? 'text-[#27AE22] bg-[#27AE22]/10' : 'text-gray-200 hover:text-white hover:bg-white/10' }}">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.069A1 1 0 0121 8.87v6.26a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                </svg>
                Virtual Tour
            </a>

            <a href="{{ route('blog.index') }}"
               @click="mobileOpen=false"
               class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-colors
                      {{ request()->routeIs('blog*') ? 'text-[#27AE22] bg-[#27AE22]/10' : 'text-gray-200 hover:text-white hover:bg-white/10' }}">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                </svg>
                Blog
            </a>

            {{-- Mobile Company section --}}
            <div x-data="{ companyOpen: false }">
                <button @click="companyOpen=!companyOpen"
                        class="w-full flex items-center justify-between gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-colors
                               {{ request()->routeIs('about','services','joint-venture','investor-info','csr') ? 'text-[#27AE22] bg-[#27AE22]/10' : 'text-gray-200 hover:text-white hover:bg-white/10' }}">
                    <span class="flex items-center gap-3">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5"/>
                        </svg>
                        Company
                    </span>
                    <svg class="w-4 h-4 transition-transform" :class="companyOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div x-show="companyOpen" x-transition class="mt-1 ml-4 pl-4 border-l border-white/10 space-y-1">
                    <a href="{{ route('about') }}" @click="mobileOpen=false" class="block px-3 py-2 text-sm text-gray-300 hover:text-[#27AE22] rounded-lg transition-colors">About Us</a>
                    <a href="{{ route('services') }}" @click="mobileOpen=false" class="block px-3 py-2 text-sm text-gray-300 hover:text-[#27AE22] rounded-lg transition-colors">Our Services</a>
                    <a href="{{ route('joint-venture') }}" @click="mobileOpen=false" class="block px-3 py-2 text-sm text-gray-300 hover:text-[#27AE22] rounded-lg transition-colors">JV Partnership</a>
                    <a href="{{ route('investor-info') }}" @click="mobileOpen=false" class="block px-3 py-2 text-sm text-gray-300 hover:text-[#27AE22] rounded-lg transition-colors">Invest With Us</a>
                    @foreach($navMenuItems as $navItem)
                    <a href="{{ $navItem->url }}" @click="mobileOpen=false" {{ $navItem->opens_new_tab ? 'target="_blank" rel="noopener"' : '' }}
                       class="block px-3 py-2 text-sm text-gray-300 hover:text-[#27AE22] rounded-lg transition-colors">{{ $navItem->label }}</a>
                    @endforeach
                </div>
            </div>

            <a href="{{ route('contact') }}"
               @click="mobileOpen=false"
               class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-colors
                      {{ request()->routeIs('contact') ? 'text-[#27AE22] bg-[#27AE22]/10' : 'text-gray-200 hover:text-white hover:bg-white/10' }}">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
                Contact
            </a>

            {{-- Mobile CTA Buttons --}}
            <div class="pt-3 pb-2 border-t border-white/10 grid grid-cols-2 gap-3">
                <a href="{{ route('login', ['portal' => 'investor']) }}"
                   @click="mobileOpen=false"
                   class="flex items-center justify-center px-4 py-2.5 text-sm font-semibold text-[#27AE22] border border-[#27AE22]/60 rounded-xl hover:bg-[#27AE22]/10 transition-colors">
                    Investor Portal
                </a>
                <a href="{{ route('login') }}"
                   @click="mobileOpen=false"
                   class="flex items-center justify-center px-4 py-2.5 text-sm font-semibold bg-[#27AE22] text-[#1A237E] rounded-xl hover:bg-[#4ADE80] transition-colors shadow-lg">
                    Client Login
                </a>
            </div>
        </div>
    </div>
</nav>
