@extends('layouts.app')

@section('title', 'Our Services — Shefa Homes and Properties Ltd')
@section('description', 'Strategic real estate services including land banking, project management, property flipping, JV partnerships, and property development across Nigeria.')

@section('content')

{{-- Hero --}}
<section class="relative bg-[#1A237E] py-28 overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-br from-[#1A237E] via-[#1A237E]/95 to-[#1a2e50]"></div>
    <div class="absolute bottom-0 right-0 w-96 h-96 opacity-10 rounded-full"
         style="background:radial-gradient(circle, #27AE22, transparent)"></div>
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <span class="inline-block text-[#27AE22] font-semibold text-sm tracking-widest uppercase mb-4">What We Do</span>
        <h1 class="font-display text-5xl lg:text-6xl font-bold text-white mb-4 leading-tight">
            Our <span class="text-[#27AE22]">Services</span>
        </h1>
        <p class="text-[#27AE22] font-semibold text-xl mb-5">Elite Real Estate Investment &amp; Development Solutions</p>
        <p class="text-gray-300 text-lg leading-relaxed max-w-3xl mx-auto">
            At Shefa Homes and Properties Ltd, we provide structured, high-value real estate solutions designed for serious investors, strategic partners, and forward-thinking property owners.
        </p>
    </div>
</section>

{{-- Services --}}
<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="space-y-24">

            {{-- Land Banking --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center" data-reveal>
                <div>
                    <div class="w-14 h-14 bg-[#27AE22]/15 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-7 h-7 text-[#27AE22]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <h2 class="font-display text-3xl font-bold text-[#1A237E] mb-4">Land Banking Investment</h2>
                    <p class="text-gray-500 text-base leading-relaxed mb-6">
                        Acquire prime land in high-growth corridors before full urban expansion. Our land banking strategy is built on strategic location acquisition, capital appreciation planning, and long-term wealth preservation.
                    </p>
                    <div class="space-y-3 mb-8">
                        @foreach(['Strategic location acquisition','Capital appreciation planning','Long-term wealth preservation'] as $point)
                        <div class="flex items-center gap-3">
                            <div class="w-5 h-5 bg-[#27AE22]/15 rounded-full flex items-center justify-center flex-shrink-0">
                                <svg class="w-3 h-3 text-[#27AE22]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                            <span class="text-gray-700 text-sm font-medium">{{ $point }}</span>
                        </div>
                        @endforeach
                    </div>
                    <p class="text-[#27AE22] font-semibold italic">Secure today. Multiply tomorrow.</p>
                </div>
                <div class="bg-gradient-to-br from-[#1A237E] to-[#1a2e50] rounded-3xl p-10 text-white flex flex-col justify-center min-h-[280px]">
                    <p class="text-4xl font-bold text-[#27AE22] mb-2">Prime</p>
                    <p class="text-xl font-semibold mb-3">High-Growth Corridors</p>
                    <p class="text-gray-400 text-sm leading-relaxed">We identify locations ahead of urban expansion curves, securing assets before market saturation drives prices upward.</p>
                </div>
            </div>

            <div class="border-t border-gray-100"></div>

            {{-- Project Management --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center" data-reveal>
                <div class="bg-[#27AE22] rounded-3xl p-10 text-[#1A237E] order-2 lg:order-1 flex flex-col justify-center min-h-[280px]">
                    <p class="text-4xl font-bold mb-2">End-to-End</p>
                    <p class="text-xl font-semibold mb-3">Project Oversight</p>
                    <p class="text-[#1A237E]/70 text-sm leading-relaxed">From acquisition to final handover, every project under our management meets professional standards on time and within budget.</p>
                </div>
                <div class="order-1 lg:order-2">
                    <div class="w-14 h-14 bg-[#1A237E]/8 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-7 h-7 text-[#1A237E]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                        </svg>
                    </div>
                    <h2 class="font-display text-3xl font-bold text-[#1A237E] mb-4">Project Management</h2>
                    <p class="text-gray-500 text-base leading-relaxed mb-6">
                        From acquisition to execution, we oversee development projects with precision and accountability — protecting your capital while delivering excellence.
                    </p>
                    <div class="space-y-3 mb-8">
                        @foreach(['Professional planning & budgeting','Contractor coordination','Quality & timeline control'] as $point)
                        <div class="flex items-center gap-3">
                            <div class="w-5 h-5 bg-[#27AE22]/15 rounded-full flex items-center justify-center flex-shrink-0">
                                <svg class="w-3 h-3 text-[#27AE22]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                            <span class="text-gray-700 text-sm font-medium">{{ $point }}</span>
                        </div>
                        @endforeach
                    </div>
                    <p class="text-[#27AE22] font-semibold italic">We protect your capital while delivering excellence.</p>
                </div>
            </div>

            <div class="border-t border-gray-100"></div>

            {{-- Property Flipping --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center" data-reveal>
                <div>
                    <div class="w-14 h-14 bg-[#27AE22]/15 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-7 h-7 text-[#27AE22]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                        </svg>
                    </div>
                    <h2 class="font-display text-3xl font-bold text-[#1A237E] mb-4">Property Flipping Management</h2>
                    <p class="text-gray-500 text-base leading-relaxed mb-6">
                        We identify undervalued assets, reposition them strategically, and maximise resale value. Designed for investors seeking high-yield, short-to-medium-term returns.
                    </p>
                    <div class="space-y-3 mb-8">
                        @foreach(['Smart acquisition of undervalued assets','Structured renovation oversight','Profitable exit strategy'] as $point)
                        <div class="flex items-center gap-3">
                            <div class="w-5 h-5 bg-[#27AE22]/15 rounded-full flex items-center justify-center flex-shrink-0">
                                <svg class="w-3 h-3 text-[#27AE22]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                            <span class="text-gray-700 text-sm font-medium">{{ $point }}</span>
                        </div>
                        @endforeach
                    </div>
                    <p class="text-[#27AE22] font-semibold italic">Designed for investors seeking high-yield returns.</p>
                </div>
                <div class="bg-gradient-to-br from-[#1A237E] to-[#1a2e50] rounded-3xl p-10 text-white flex flex-col justify-center min-h-[280px]">
                    <p class="text-4xl font-bold text-[#27AE22] mb-2">Maximise</p>
                    <p class="text-xl font-semibold mb-3">Resale Value</p>
                    <p class="text-gray-400 text-sm leading-relaxed">Strategic repositioning of undervalued properties to deliver superior investor returns.</p>
                </div>
            </div>

            <div class="border-t border-gray-100"></div>

            {{-- JV Partnerships --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center" data-reveal>
                <div class="bg-[#27AE22] rounded-3xl p-10 text-[#1A237E] order-2 lg:order-1 flex flex-col justify-center min-h-[280px]">
                    <p class="text-4xl font-bold mb-2">Strategic</p>
                    <p class="text-xl font-semibold mb-3">Alliances. Shared Success.</p>
                    <p class="text-[#1A237E]/70 text-sm leading-relaxed">We collaborate with landowners and investors through structured, transparent JV agreements designed for mutual growth.</p>
                </div>
                <div class="order-1 lg:order-2">
                    <div class="w-14 h-14 bg-[#1A237E]/8 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-7 h-7 text-[#1A237E]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0"/>
                        </svg>
                    </div>
                    <h2 class="font-display text-3xl font-bold text-[#1A237E] mb-4">Joint Venture Partnerships</h2>
                    <p class="text-gray-500 text-base leading-relaxed mb-6">
                        We collaborate with landowners and investors through structured, transparent JV agreements — creating strategic alliances with shared success.
                    </p>
                    <div class="space-y-3 mb-8">
                        @foreach(['Development partnerships','Capital-backed construction projects','Profit-sharing frameworks'] as $point)
                        <div class="flex items-center gap-3">
                            <div class="w-5 h-5 bg-[#27AE22]/15 rounded-full flex items-center justify-center flex-shrink-0">
                                <svg class="w-3 h-3 text-[#27AE22]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                            <span class="text-gray-700 text-sm font-medium">{{ $point }}</span>
                        </div>
                        @endforeach
                    </div>
                    <a href="{{ route('joint-venture') }}" class="inline-flex items-center gap-2 text-[#27AE22] font-semibold text-sm hover:underline">
                        Learn more about JV Partnerships
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
            </div>

            <div class="border-t border-gray-100"></div>

            {{-- Property Development --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center" data-reveal>
                <div>
                    <div class="w-14 h-14 bg-[#27AE22]/15 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-7 h-7 text-[#27AE22]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                    </div>
                    <h2 class="font-display text-3xl font-bold text-[#1A237E] mb-4">Property Development</h2>
                    <p class="text-gray-500 text-base leading-relaxed mb-6">
                        We transform raw land into structured, investment-ready developments — from estate planning and infrastructure to completed residential and commercial projects with long-term value.
                    </p>
                    <div class="space-y-3 mb-8">
                        @foreach(['Estate planning & infrastructure','Residential & commercial projects','Long-term value creation'] as $point)
                        <div class="flex items-center gap-3">
                            <div class="w-5 h-5 bg-[#27AE22]/15 rounded-full flex items-center justify-center flex-shrink-0">
                                <svg class="w-3 h-3 text-[#27AE22]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                            <span class="text-gray-700 text-sm font-medium">{{ $point }}</span>
                        </div>
                        @endforeach
                    </div>
                    <p class="text-[#27AE22] font-semibold italic">We build assets that appreciate.</p>
                </div>
                <div class="bg-gradient-to-br from-[#1A237E] to-[#1a2e50] rounded-3xl p-10 text-white flex flex-col justify-center min-h-[280px]">
                    <p class="text-4xl font-bold text-[#27AE22] mb-2">Investment-Ready</p>
                    <p class="text-xl font-semibold mb-3">Developments</p>
                    <p class="text-gray-400 text-sm leading-relaxed">Raw land transformed into structured estates and residential projects built for lasting value.</p>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- Admin-controlled dynamic sections --}}
@include('public.shared._page-sections', ['pageSlug' => 'services'])

{{-- CTA --}}
<section class="py-20 bg-gray-50">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <span class="inline-block text-[#27AE22] font-semibold text-sm tracking-widest uppercase mb-4">Ready to Get Started?</span>
        <h2 class="font-display text-4xl font-bold text-[#1A237E] mb-5">Let's Build Something Together</h2>
        <p class="text-gray-500 text-base leading-relaxed mb-10">
            Whether you're looking to invest, develop, or partner — our team is ready to structure the right solution for your goals.
        </p>
        <div class="flex flex-wrap justify-center gap-4">
            <a href="{{ route('contact') }}"
               class="bg-[#1A237E] text-white font-bold px-8 py-4 rounded-full hover:bg-[#1A237E]/90 transition-all hover:scale-105">
                Contact Us
            </a>
            <a href="{{ route('joint-venture') }}"
               class="border-2 border-[#27AE22] text-[#27AE22] font-bold px-8 py-4 rounded-full hover:bg-[#27AE22] hover:text-[#1A237E] transition-all">
                Explore JV Partnerships
            </a>
            <a href="{{ route('investor-info') }}"
               class="border-2 border-[#1A237E] text-[#1A237E] font-bold px-8 py-4 rounded-full hover:bg-[#1A237E] hover:text-white transition-all">
                Investor Information
            </a>
        </div>
    </div>
</section>

@endsection
