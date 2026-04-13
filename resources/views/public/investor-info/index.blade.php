@extends('layouts.app')

@section('title', 'Investor Invitation — Shefa Homes and Properties Ltd')
@section('description', 'Partner with purpose. Invest with confidence. Access structured real estate opportunities designed for discerning investors across Nigeria.')

@section('content')

{{-- Hero --}}
<section class="relative bg-[#1A237E] py-28 overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-br from-[#1A237E] via-[#1A237E]/95 to-[#1a2e50]"></div>
    <div class="absolute bottom-0 right-0 w-96 h-96 opacity-10 rounded-full" style="background:radial-gradient(circle, #27AE22, transparent 70%)"></div>
    <div class="absolute top-20 left-0 w-64 h-64 opacity-5 rounded-full" style="background:radial-gradient(circle, #27AE22, transparent 70%)"></div>
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl">
            <span class="inline-block text-[#27AE22] font-semibold text-sm tracking-widest uppercase mb-4">Investor Invitation</span>
            <h1 class="font-display text-5xl lg:text-6xl font-bold text-white mb-5 leading-tight">
                Partner With Purpose.<br><span class="text-[#27AE22]">Invest With Confidence.</span>
            </h1>
            <p class="text-gray-300 text-xl leading-relaxed mb-10 max-w-2xl">
                At Shefa Homes and Properties Ltd, we offer more than property — we provide access to structured real estate opportunities designed for discerning investors and strategic partners.
            </p>
            <div class="flex flex-wrap gap-4">
                <a href="{{ route('contact') }}"
                   class="inline-flex items-center gap-2 bg-[#27AE22] text-[#1A237E] font-bold px-8 py-4 rounded-full hover:bg-[#4ADE80] transition-all hover:scale-105 shadow-lg shadow-[#27AE22]/20">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                    </svg>
                    Speak With an Advisor
                </a>
                <a href="https://wa.me/{{ $whatsapp ?? '2349122388541' }}?text=Hello%2C%20I%27m%20interested%20in%20investing%20with%20Shefa%20Homes"
                   target="_blank" rel="noopener"
                   class="inline-flex items-center gap-2 border-2 border-white/40 text-white hover:border-white hover:bg-white/10 font-bold px-8 py-4 rounded-full transition-all">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                    </svg>
                    Chat on WhatsApp
                </a>
                <a href="{{ route('contact') }}"
                   class="inline-flex items-center gap-2 bg-white/10 text-white hover:bg-white/20 font-bold px-8 py-4 rounded-full transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    Schedule a Consultation
                </a>
            </div>
        </div>
    </div>
</section>

{{-- Why Invest With Us --}}
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto mb-14" data-reveal>
            <span class="inline-block text-[#27AE22] font-semibold text-sm tracking-widest uppercase mb-3">Why Choose Us</span>
            <h2 class="font-display text-4xl font-bold text-[#1A237E] mb-4">Why Invest With Us?</h2>
            <p class="text-gray-500">Whether you are looking to preserve capital, generate returns, or participate in large-scale developments, our model is built to deliver clarity, security, and measurable value.</p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach([
                ['Access to high-growth locations before peak development', 'M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z M15 11a3 3 0 11-6 0 3 3 0 016 0z'],
                ['Structured investment models with clear exit strategies', 'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z'],
                ['Transparent documentation & due diligence process', 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z'],
                ['Professional project execution and oversight', 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5'],
                ['Opportunities for passive and active income', 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z'],
                ['Structured Joint Venture partnerships', 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0'],
            ] as [$text, $icon])
            <div class="flex items-start gap-4 p-5 rounded-2xl border border-gray-100 hover:border-[#27AE22]/40 hover:shadow-md transition-all" data-reveal>
                <div class="w-10 h-10 bg-[#27AE22]/10 rounded-xl flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-[#27AE22]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $icon }}"/>
                    </svg>
                </div>
                <p class="text-gray-700 font-medium text-sm leading-relaxed mt-1">{{ $text }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Who This Is For --}}
<section class="py-20 bg-[#1A237E]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <div data-reveal>
                <span class="inline-block text-[#27AE22] font-semibold text-sm tracking-widest uppercase mb-3">Who This Is For</span>
                <h2 class="font-display text-4xl font-bold text-white mb-8">Our investor profile</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @foreach([
                        ['High-Net-Worth Individuals', 'Preserve and grow capital through strategic real estate', 'M16 7a4 4 0 11-8 0 4 4 0 018 0z M12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z'],
                        ['Diaspora Investors', 'Secure assets in Nigeria from anywhere in the world', 'M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z'],
                        ['Landowners', 'Unlock the full development potential of your land', 'M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z M15 11a3 3 0 11-6 0 3 3 0 016 0z'],
                        ['Private & Institutional Investors', 'Structured opportunities for capital deployment at scale', 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5'],
                    ] as [$type, $desc, $icon])
                    <div class="bg-white/5 border border-white/10 rounded-2xl p-5 hover:bg-white/8 transition-all">
                        <div class="w-9 h-9 bg-[#27AE22]/20 rounded-xl flex items-center justify-center mb-3">
                            <svg class="w-4 h-4 text-[#27AE22]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $icon }}"/>
                            </svg>
                        </div>
                        <h4 class="text-white font-semibold text-sm mb-1">{{ $type }}</h4>
                        <p class="text-gray-400 text-xs leading-relaxed">{{ $desc }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="bg-white rounded-3xl p-8 lg:p-10" data-reveal style="transition-delay:200ms">
                <h3 class="font-display text-2xl font-bold text-[#1A237E] mb-2">Start Your Investment Journey</h3>
                <p class="text-gray-500 text-sm mb-8 leading-relaxed">Take the next step toward strategic real estate investment. Our advisors are ready to walk you through the opportunities available.</p>
                <div class="space-y-3">
                    <a href="{{ route('contact') }}"
                       class="flex items-center gap-3 w-full bg-[#1A237E] text-white font-semibold px-6 py-3.5 rounded-xl hover:bg-[#1A237E]/90 transition-all text-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        Speak With an Advisor
                    </a>
                    <a href="https://wa.me/{{ $whatsapp ?? '2349122388541' }}?text=Hello%2C%20I%27m%20interested%20in%20investing%20with%20Shefa%20Homes"
                       target="_blank" rel="noopener"
                       class="flex items-center gap-3 w-full bg-green-600 text-white font-semibold px-6 py-3.5 rounded-xl hover:bg-green-500 transition-all text-sm">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                        </svg>
                        Chat on WhatsApp
                    </a>
                    <a href="{{ route('contact') }}"
                       class="flex items-center gap-3 w-full border-2 border-[#1A237E] text-[#1A237E] font-semibold px-6 py-3.5 rounded-xl hover:bg-[#1A237E] hover:text-white transition-all text-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        Schedule a Private Consultation
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- What Sets Us Apart --}}
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto mb-14" data-reveal>
            <span class="inline-block text-[#27AE22] font-semibold text-sm tracking-widest uppercase mb-3">Our Commitment</span>
            <h2 class="font-display text-4xl font-bold text-[#1A237E]">What Sets Us Apart</h2>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-6 text-center">
            @foreach([
                'Investment-focused model',
                'Carefully selected high-growth locations',
                'Structured Joint Venture partnerships',
                'Professional project management systems',
                'Commitment to integrity and accountability',
            ] as $i => $point)
            <div class="p-5 rounded-2xl border border-gray-100 hover:border-[#27AE22]/30 hover:shadow-sm transition-all" data-reveal>
                <div class="w-8 h-8 bg-[#27AE22] rounded-full flex items-center justify-center mx-auto mb-3">
                    <span class="text-[#1A237E] font-bold text-xs">{{ $i+1 }}</span>
                </div>
                <p class="text-gray-700 font-medium text-sm leading-snug">{{ $point }}</p>
            </div>
            @endforeach
        </div>
        <div class="mt-12 bg-gray-50 rounded-3xl p-8 lg:p-10 text-center max-w-3xl mx-auto" data-reveal>
            <p class="text-gray-600 text-base leading-relaxed italic">
                "We operate with discipline, precision, and a deep understanding of emerging real estate markets."
            </p>
        </div>
    </div>
</section>

{{-- JV CTA --}}
<section class="py-20 bg-gray-50">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <span class="inline-block text-[#27AE22] font-semibold text-sm tracking-widest uppercase mb-4">Interested in JV?</span>
        <h2 class="font-display text-4xl font-bold text-[#1A237E] mb-5">
            Looking to participate in a Joint Venture?
        </h2>
        <p class="text-gray-500 text-base leading-relaxed mb-10 max-w-2xl mx-auto">
            We structure JV partnerships that transform land and capital into high-value real estate developments. Explore how we can build together.
        </p>
        <a href="{{ route('joint-venture') }}"
           class="inline-flex items-center gap-2 bg-[#27AE22] text-[#1A237E] font-bold px-10 py-4 rounded-full hover:bg-[#4ADE80] transition-all hover:scale-105 shadow-lg">
            Explore JV Partnership
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
        </a>
    </div>
</section>

@endsection
