@extends('layouts.app')

@section('title', 'About Us — Shefa Homes and Properties Ltd')
@section('description', 'Building strategic assets and creating lasting value. Shefa Homes and Properties Ltd is a forward-thinking real estate investment and development company in Nigeria.')

@section('content')

{{-- Hero --}}
<section class="relative bg-[#1A237E] py-28 overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-br from-[#1A237E] via-[#1A237E]/95 to-[#1a2e50]"></div>
    <div class="absolute bottom-0 right-0 w-96 h-96 opacity-10 rounded-full" style="background:radial-gradient(circle, #27AE22, transparent)"></div>
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl">
            <span class="inline-block text-[#27AE22] font-semibold text-sm tracking-widest uppercase mb-4">Who We Are</span>
            <h1 class="font-display text-5xl lg:text-6xl font-bold text-white mb-6 leading-tight">
                Building Strategic Assets.<br><span class="text-[#27AE22]">Creating Lasting Value.</span>
            </h1>
            <p class="text-gray-300 text-xl leading-relaxed">
                A forward-thinking real estate investment and development company committed to delivering structured, high-value property solutions across Nigeria's fastest-growing corridors.
            </p>
        </div>
    </div>
</section>

{{-- Who We Are --}}
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <div data-reveal>
                <span class="inline-block text-[#27AE22] font-semibold text-sm tracking-widest uppercase mb-3">Who We Are</span>
                <h2 class="font-display text-4xl font-bold text-[#1A237E] mb-6 leading-tight">
                    Building Strategic Assets. Creating Lasting Value.
                </h2>
                <div class="space-y-4 text-gray-500 leading-relaxed text-base">
                    <p>
                        Shefa Homes and Properties Ltd is a forward-thinking real estate investment and development company committed to delivering structured, high-value property solutions across Nigeria's fastest-growing corridors.
                    </p>
                    <p>
                        We do not merely sell land — we curate strategic real estate opportunities designed for long-term capital appreciation, wealth preservation, and sustainable development.
                    </p>
                </div>
                <div class="mt-8 p-6 bg-[#1A237E]/3 rounded-2xl border border-[#1A237E]/8">
                    <h4 class="font-semibold text-[#1A237E] mb-3">Our Philosophy</h4>
                    <p class="text-gray-500 text-sm mb-4 italic">Real estate is more than ownership — it is a legacy asset.</p>
                    <div class="grid grid-cols-2 gap-3">
                        @foreach(['Strategic acquisition','Structured investment planning','Transparent documentation','Professional project execution'] as $pillar)
                        <div class="flex items-center gap-2">
                            <div class="w-4 h-4 bg-[#27AE22]/20 rounded-full flex items-center justify-center flex-shrink-0">
                                <div class="w-2 h-2 bg-[#27AE22] rounded-full"></div>
                            </div>
                            <span class="text-gray-700 text-sm font-medium">{{ $pillar }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="space-y-4" data-reveal style="transition-delay:200ms">
                <div class="grid grid-cols-2 gap-4">
                    @foreach([
                        ['Investment-focused model', 'M13 7h8m0 0v8m0-8l-8 8-4-4-6 6'],
                        ['High-growth locations', 'M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z M15 11a3 3 0 11-6 0 3 3 0 016 0z'],
                        ['JV partnerships', 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0'],
                        ['Integrity & accountability', 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z'],
                    ] as [$label, $icon])
                    <div class="bg-white border border-gray-100 rounded-2xl p-5 hover:border-[#27AE22]/30 hover:shadow-sm transition-all text-center">
                        <div class="w-10 h-10 bg-[#27AE22]/10 rounded-xl flex items-center justify-center mx-auto mb-3">
                            <svg class="w-5 h-5 text-[#27AE22]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $icon }}"/>
                            </svg>
                        </div>
                        <p class="text-xs font-semibold text-gray-700">{{ $label }}</p>
                    </div>
                    @endforeach
                </div>
                <div class="bg-[#1A237E] rounded-2xl p-6 text-white">
                    <h4 class="text-[#27AE22] font-semibold mb-3 text-sm uppercase tracking-widest">What Sets Us Apart</h4>
                    <div class="space-y-2">
                        @foreach([
                            'Investment-focused model',
                            'Carefully selected high-growth locations',
                            'Structured Joint Venture partnerships',
                            'Professional project management systems',
                            'Commitment to integrity and accountability',
                        ] as $point)
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-[#27AE22] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                            </svg>
                            <p class="text-gray-300 text-sm font-medium">{{ $point }}</p>
                        </div>
                        @endforeach
                    </div>
                    <p class="text-gray-400 text-xs mt-4 leading-relaxed">We operate with discipline, precision, and a deep understanding of emerging real estate markets.</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Vision / Mission --}}
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto mb-14" data-reveal>
            <span class="inline-block text-[#27AE22] font-semibold text-sm tracking-widest uppercase mb-3">Our Direction</span>
            <h2 class="font-display text-4xl font-bold text-[#1A237E]">Vision & Mission</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-5xl mx-auto">
            <div class="bg-[#1A237E] rounded-3xl p-10 text-white relative overflow-hidden" data-reveal>
                <div class="absolute top-0 right-0 w-40 h-40 bg-[#27AE22]/10 rounded-full -translate-y-10 translate-x-10"></div>
                <div class="w-12 h-12 bg-[#27AE22] rounded-2xl flex items-center justify-center mb-6">
                    <svg class="w-6 h-6 text-[#1A237E]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                </div>
                <h3 class="font-display text-2xl font-bold text-[#27AE22] mb-4">Vision Statement</h3>
                <p class="text-gray-300 leading-relaxed text-base">
                    To Contribute to the creation of thriving communities and ecosystems by building long-term relationships with our clients founded on trust and integrity.
                </p>
            </div>
            <div class="bg-[#27AE22] rounded-3xl p-10 text-[#1A237E] relative overflow-hidden" data-reveal style="transition-delay:200ms">
                <div class="absolute top-0 right-0 w-40 h-40 bg-[#1A237E]/10 rounded-full -translate-y-10 translate-x-10"></div>
                <div class="w-12 h-12 bg-[#1A237E] rounded-2xl flex items-center justify-center mb-6">
                    <svg class="w-6 h-6 text-[#27AE22]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                </div>
                <h3 class="font-display text-2xl font-bold text-[#1A237E] mb-4">Mission Statement</h3>
                <p class="text-[#1A237E]/80 leading-relaxed text-base">
                    To deliver exceptional service and transparent communication to our investors, Partners and Stakeholders.
                </p>
            </div>
        </div>
    </div>
</section>

{{-- Core Values --}}
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto mb-14" data-reveal>
            <span class="inline-block text-[#27AE22] font-semibold text-sm tracking-widest uppercase mb-3">What Drives Us</span>
            <h2 class="font-display text-4xl font-bold text-[#1A237E]">Core Values</h2>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach([
                ['Portfolio', 'To acquire and manage a diverse portfolio of high-potential land assets.', 'M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10'],
                ['Integrity & Ethics', 'Conduct business with honesty, transparency and ethical standards.', 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z'],
                ['Open Communication', 'Provide clear and regular communication to investors and stakeholders.', 'M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z'],
                ['Long-term Growth', 'Prioritize sustainable growth and long-term returns over short-term gain.', 'M13 7h8m0 0v8m0-8l-8 8-4-4-6 6'],
                ['Community Engagement', 'Engage positively with local communities and contributes to their growth.', 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5'],
            ] as [$title, $desc, $icon])
            <div class="group bg-white border border-gray-100 rounded-2xl p-6 hover:border-[#27AE22]/40 hover:shadow-lg transition-all duration-300" data-reveal>
                <div class="w-11 h-11 bg-[#27AE22]/10 group-hover:bg-[#27AE22]/20 rounded-xl flex items-center justify-center mb-4 transition-colors">
                    <svg class="w-5 h-5 text-[#27AE22]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $icon }}"/>
                    </svg>
                </div>
                <h3 class="font-semibold text-[#1A237E] text-base mb-2">{{ $title }}</h3>
                <p class="text-gray-500 text-sm leading-relaxed">{{ $desc }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- What Sets Us Apart --}}
<section class="py-20 bg-[#1A237E]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <div data-reveal>
                <span class="inline-block text-[#27AE22] font-semibold text-sm tracking-widest uppercase mb-3">Our Edge</span>
                <h2 class="font-display text-4xl font-bold text-white mb-8">What Sets Us Apart</h2>
                <div class="space-y-4">
                    @foreach([
                        'Investment-focused model',
                        'Carefully selected high-growth locations',
                        'Structured Joint Venture partnerships',
                        'Professional project management systems',
                        'Commitment to integrity and accountability',
                    ] as $point)
                    <div class="flex items-start gap-3">
                        <div class="w-6 h-6 bg-[#27AE22]/20 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                            <svg class="w-3.5 h-3.5 text-[#27AE22]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <p class="text-gray-300 font-medium">{{ $point }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="space-y-4" data-reveal style="transition-delay:200ms">
                <div class="bg-white/5 border border-white/10 rounded-2xl p-6">
                    <h4 class="text-[#27AE22] font-semibold mb-2">Office Address</h4>
                    <p class="text-gray-300 text-sm">5, Charity Road, Opposite UBA Oko/Oba Ifako-Ijaye Ijaiye Lagos</p>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-white/5 border border-white/10 rounded-2xl p-5">
                        <h4 class="text-white font-semibold mb-1 text-sm">Call Us</h4>
                        <a href="tel:08105494713" class="text-[#27AE22] text-sm font-medium hover:text-[#4ADE80] transition-colors">08105494713</a>
                    </div>
                    <div class="bg-white/5 border border-white/10 rounded-2xl p-5">
                        <h4 class="text-white font-semibold mb-1 text-sm">WhatsApp</h4>
                        <a href="https://wa.me/2349122388541" target="_blank" class="text-[#27AE22] text-sm font-medium hover:text-[#4ADE80] transition-colors">09122388541</a>
                    </div>
                </div>
                <div class="bg-[#27AE22] rounded-2xl p-6">
                    <h4 class="text-[#1A237E] font-bold mb-2">Ready to Partner?</h4>
                    <p class="text-[#1A237E]/70 text-sm mb-4">Let's build something meaningful together.</p>
                    <div class="flex gap-3">
                        <a href="{{ route('contact') }}" class="flex-1 text-center bg-[#1A237E] text-white font-semibold px-4 py-2.5 rounded-xl text-sm hover:bg-[#1A237E]/90 transition-all">Contact Us</a>
                        <a href="{{ route('joint-venture') }}" class="flex-1 text-center border-2 border-[#1A237E] text-[#1A237E] font-semibold px-4 py-2.5 rounded-xl text-sm hover:bg-[#1A237E] hover:text-white transition-all">JV Partnership</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Team --}}
{{-- Admin-controlled dynamic sections --}}
@include('public.shared._page-sections', ['pageSlug' => 'about'])

@if(isset($team) && $team->count())
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto mb-14" data-reveal>
            <span class="inline-block text-[#27AE22] font-semibold text-sm tracking-widest uppercase mb-3">The People</span>
            <h2 class="font-display text-4xl font-bold text-[#1A237E]">Meet Our Team</h2>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($team as $member)
            <div class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-lg transition-all group" data-reveal>
                <div class="aspect-[4/3] overflow-hidden bg-gray-100">
                    @if($member->photo)
                    <img src="{{ Storage::url($member->photo) }}" alt="{{ $member->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    @else
                    <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-[#1A237E] to-[#1a2e50]">
                        <span class="text-4xl font-bold text-[#27AE22]">{{ substr($member->name,0,1) }}</span>
                    </div>
                    @endif
                </div>
                <div class="p-5">
                    <h3 class="font-semibold text-[#1A237E] text-base">{{ $member->name }}</h3>
                    <p class="text-[#27AE22] text-sm font-medium">{{ $member->position }}</p>
                    @if($member->bio)
                    <p class="text-gray-500 text-xs mt-2 leading-relaxed line-clamp-3">{{ $member->bio }}</p>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

@endsection
