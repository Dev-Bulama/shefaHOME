@php $navbarBg = \App\Helpers\Settings::get('navbar_bg_color', '#1A237E'); @endphp
<nav x-data="{
        scrolled: false,
        mobileOpen: false,
        init() { window.addEventListener('scroll', () => { this.scrolled = window.scrollY > 50; }); }
    }"
    :class="scrolled ? 'shadow-xl shadow-black/20' : 'bg-transparent'"
    :style="scrolled ? 'background-color: {{ $navbarBg }}' : ''"
    class="fixed top-0 left-0 right-0 z-50 transition-all duration-400">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-20">

            {{-- Brand Logo --}}
            <a href="{{ route('home') }}" class="flex items-center gap-2.5 group flex-shrink-0">
                @php
                    $logo = \App\Helpers\Settings::get('logo');
                    $logoHeight = \App\Helpers\Settings::get('logo_height', '48');
                @endphp
                @if($logo)
                    <img src="{{ Storage::url($logo) }}" alt="{{ $siteName ?? 'SHEFAHOMES' }}"
                         style="height: {{ intval($logoHeight) }}px;" class="w-auto object-contain">
                @else
                <div class="w-9 h-9 bg-[#27AE22] rounded-xl flex items-center justify-center shadow-lg group-hover:scale-105 transition-transform duration-200">
                    <svg class="w-5 h-5 text-[#1A237E]" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
                    </svg>
                </div>
                <div>
                    <span class="font-display font-bold text-white text-lg tracking-wider leading-none block">SHEFAHOMES</span>
                    <span class="text-[#27AE22] text-xs leading-none tracking-widest uppercase">Premium Real Estate</span>
                </div>
                @endif
            </a>

            {{-- Desktop Navigation --}}
            <div class="hidden lg:flex items-center gap-1">
                @foreach($navHeaderItems as $item)
                    @if($item->children->isNotEmpty())
                    {{-- Dropdown --}}
                    <div class="relative" x-data="{ open: false }" @mouseenter="open=true" @mouseleave="open=false">
                        <button class="flex items-center gap-1 px-4 py-2 text-sm font-medium rounded-lg transition-colors duration-200
                            {{ request()->is(ltrim($item->url,'/')) || request()->is(ltrim($item->url,'/').'/*') ? 'text-[#27AE22]' : 'text-gray-200 hover:text-white hover:bg-white/10' }}">
                            {{ $item->label }}
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
                             class="absolute top-full left-1/2 -translate-x-1/2 mt-1 w-56 bg-white rounded-2xl shadow-2xl border border-gray-100 py-2 z-50"
                             style="display:none;">
                            @foreach($item->children as $child)
                            <a href="{{ $child->url }}" {{ $child->opens_new_tab ? 'target="_blank" rel="noopener"' : '' }}
                               class="flex items-center gap-3 px-4 py-2.5 text-sm {{ request()->is(ltrim($child->url,'/')) ? 'text-[#27AE22] bg-[#27AE22]/5' : 'text-gray-700 hover:bg-[#1A237E]/5 hover:text-[#1A237E]' }} transition-colors group">
                                <div class="w-7 h-7 bg-[#1A237E]/8 rounded-lg flex items-center justify-center group-hover:bg-[#27AE22]/20 flex-shrink-0">
                                    <svg class="w-3.5 h-3.5 text-[#27AE22]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </div>
                                {{ $child->label }}
                            </a>
                            @endforeach
                        </div>
                    </div>
                    @else
                    {{-- Simple link --}}
                    <a href="{{ $item->url }}" {{ $item->opens_new_tab ? 'target="_blank" rel="noopener"' : '' }}
                       class="px-4 py-2 text-sm font-medium rounded-lg transition-colors duration-200
                              {{ $item->url !== '#' && request()->is(ltrim($item->url,'/')) ? 'text-[#27AE22]' : 'text-gray-200 hover:text-white hover:bg-white/10' }}">
                        {{ $item->label }}
                    </a>
                    @endif
                @endforeach

                {{-- Fallback if DB is empty --}}
                @if($navHeaderItems->isEmpty())
                <a href="{{ route('home') }}" class="px-4 py-2 text-sm font-medium rounded-lg text-gray-200 hover:text-white hover:bg-white/10 transition-colors duration-200">Home</a>
                <a href="{{ route('properties.index') }}" class="px-4 py-2 text-sm font-medium rounded-lg text-gray-200 hover:text-white hover:bg-white/10 transition-colors duration-200">Properties</a>
                <a href="{{ route('contact') }}" class="px-4 py-2 text-sm font-medium rounded-lg text-gray-200 hover:text-white hover:bg-white/10 transition-colors duration-200">Contact</a>
                @endif
            </div>

            {{-- Desktop CTA Buttons --}}
            <div class="hidden lg:flex items-center gap-3">
                <a href="{{ route('login', ['portal' => 'investor']) }}"
                   class="px-5 py-2 text-sm font-semibold text-[#27AE22] border border-[#27AE22]/60 rounded-full hover:bg-[#27AE22]/10 hover:border-[#27AE22] transition-all duration-200">
                    Investor Portal
                </a>
                <a href="{{ route('login') }}"
                   class="px-5 py-2 text-sm font-semibold bg-[#27AE22] text-white rounded-full hover:bg-[#1D9418] transition-all duration-200 shadow-lg shadow-[#27AE22]/20 hover:-translate-y-0.5">
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

    {{-- Mobile Menu --}}
    <div x-show="mobileOpen"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 -translate-y-4"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-4"
         class="lg:hidden border-t border-white/10 shadow-2xl"
         style="background-color: {{ $navbarBg }}; display:none;">

        <div class="max-w-7xl mx-auto px-4 py-4 space-y-1">

            @foreach($navHeaderItems as $item)
                @if($item->children->isNotEmpty())
                {{-- Expandable section --}}
                <div x-data="{ open: false }">
                    <button @click="open=!open"
                            class="w-full flex items-center justify-between gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-colors text-gray-200 hover:text-white hover:bg-white/10">
                        <span>{{ $item->label }}</span>
                        <svg class="w-4 h-4 transition-transform flex-shrink-0" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div x-show="open" x-transition class="mt-1 ml-4 pl-4 border-l border-white/10 space-y-1">
                        @foreach($item->children as $child)
                        <a href="{{ $child->url }}" @click="mobileOpen=false" {{ $child->opens_new_tab ? 'target="_blank" rel="noopener"' : '' }}
                           class="block px-3 py-2 text-sm text-gray-300 hover:text-[#27AE22] rounded-lg transition-colors">
                            {{ $child->label }}
                        </a>
                        @endforeach
                    </div>
                </div>
                @else
                <a href="{{ $item->url }}" @click="mobileOpen=false" {{ $item->opens_new_tab ? 'target="_blank" rel="noopener"' : '' }}
                   class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-colors
                          {{ $item->url !== '#' && request()->is(ltrim($item->url,'/')) ? 'text-[#27AE22] bg-[#27AE22]/10' : 'text-gray-200 hover:text-white hover:bg-white/10' }}">
                    {{ $item->label }}
                </a>
                @endif
            @endforeach

            {{-- Fallback --}}
            @if($navHeaderItems->isEmpty())
            <a href="{{ route('home') }}" @click="mobileOpen=false" class="block px-4 py-3 rounded-xl text-sm font-medium text-gray-200 hover:text-white hover:bg-white/10 transition-colors">Home</a>
            <a href="{{ route('properties.index') }}" @click="mobileOpen=false" class="block px-4 py-3 rounded-xl text-sm font-medium text-gray-200 hover:text-white hover:bg-white/10 transition-colors">Properties</a>
            <a href="{{ route('contact') }}" @click="mobileOpen=false" class="block px-4 py-3 rounded-xl text-sm font-medium text-gray-200 hover:text-white hover:bg-white/10 transition-colors">Contact</a>
            @endif

            {{-- Mobile CTA Buttons --}}
            <div class="pt-3 pb-2 border-t border-white/10 grid grid-cols-2 gap-3">
                <a href="{{ route('login', ['portal' => 'investor']) }}"
                   @click="mobileOpen=false"
                   class="flex items-center justify-center px-4 py-2.5 text-sm font-semibold text-[#27AE22] border border-[#27AE22]/60 rounded-xl hover:bg-[#27AE22]/10 transition-colors">
                    Investor Portal
                </a>
                <a href="{{ route('login') }}"
                   @click="mobileOpen=false"
                   class="flex items-center justify-center px-4 py-2.5 text-sm font-semibold bg-[#27AE22] text-white rounded-xl hover:bg-[#1D9418] transition-colors shadow-lg">
                    Client Login
                </a>
            </div>
        </div>
    </div>
</nav>
