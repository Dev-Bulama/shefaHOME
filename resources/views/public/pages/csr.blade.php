@extends('layouts.app')

@section('title', 'Corporate Social Responsibility — Shefa Homes and Properties Ltd')
@section('description', 'At Shefa Homes, we believe building communities goes beyond bricks and mortar. Our CSR programmes transform lives through affordable housing, youth empowerment, and community development.')

@section('content')

{{-- Hero --}}
<section class="relative bg-[#1A237E] py-28 overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-br from-[#1A237E] via-[#1A237E]/95 to-[#0D1566]"></div>
    <div class="absolute bottom-0 right-0 w-96 h-96 opacity-10 rounded-full" style="background:radial-gradient(circle, #27AE22, transparent 70%)"></div>
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl">
            <span class="inline-block text-[#27AE22] font-semibold text-sm tracking-widest uppercase mb-4">Corporate Responsibility</span>
            <h1 class="font-display text-5xl lg:text-6xl font-bold text-white mb-6 leading-tight">
                Building Communities.<br><span class="text-[#27AE22]">Transforming Lives.</span>
            </h1>
            <p class="text-gray-300 text-xl leading-relaxed">
                At Shefa Homes and Properties Ltd, we believe that building communities goes far beyond bricks and mortar. Every estate we develop is a commitment to the people who live in it.
            </p>
        </div>
    </div>
</section>

{{-- Intro --}}
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <div>
                <span class="inline-block text-[#27AE22] font-semibold text-sm tracking-widest uppercase mb-3">Our Commitment</span>
                <h2 class="font-display text-4xl font-bold text-[#1A237E] mb-6">More Than Property. A Responsibility to People.</h2>
                <p class="text-gray-600 text-lg leading-relaxed mb-5">Our Corporate Social Responsibility (CSR) initiatives are embedded in our business model — not as an afterthought, but as a core operating principle. We are committed to ensuring that every community we enter is left better than we found it.</p>
                <p class="text-gray-600 leading-relaxed">From affordable housing schemes to youth skills training, environmental stewardship, and community infrastructure, we actively invest in the long-term prosperity of the neighbourhoods where we build.</p>
            </div>
            <div class="grid grid-cols-2 gap-4">
                @foreach([
                    ['200+', 'Families Housed in Affordable Schemes', '#27AE22'],
                    ['15+', 'Community Projects Funded', '#1A237E'],
                    ['500+', 'Youth Trained in Construction & Real Estate', '#27AE22'],
                    ['3', 'States with Active CSR Programmes', '#1A237E'],
                ] as [$num, $label, $color])
                <div class="bg-gray-50 rounded-2xl p-6 text-center">
                    <span class="block text-4xl font-bold mb-2" style="color:{{ $color }}">{{ $num }}</span>
                    <span class="text-sm text-gray-600 leading-tight">{{ $label }}</span>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- Initiatives --}}
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto mb-14">
            <span class="inline-block text-[#27AE22] font-semibold text-sm tracking-widest uppercase mb-3">What We Do</span>
            <h2 class="font-display text-4xl font-bold text-[#1A237E] mb-4">Our CSR Initiatives</h2>
            <p class="text-gray-500">Six pillars of community impact that guide everything we do outside the development floor.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach([
                ['Affordable Housing', 'We reserve a portion of every estate for subsidised housing units designed for low-to-middle income earners, ensuring that quality property ownership is accessible to all Nigerians — not just the privileged few.', 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6'],
                ['Youth Skills Empowerment', 'Through our Shefa Trades Programme, we train young Nigerians in construction skills — masonry, plumbing, electrical, carpentry — creating pathways to employment and self-reliance within the real estate and construction sectors.', 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253'],
                ['Community Infrastructure', 'Beyond property boundaries, we fund essential infrastructure — road access, drainage systems, street lighting, and borehole water supplies — in underserved communities proximate to our development sites.', 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4'],
                ['Environmental Stewardship', 'We incorporate green building practices, tree-planting initiatives, and waste management protocols across all our development sites — minimising our environmental footprint while enhancing the ecological health of our communities.', 'M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064'],
                ['Education Support', 'Our annual scholarship programme supports children of low-income families in communities where we operate, providing bursaries for secondary and tertiary education — investing in the next generation of Nigerian professionals.', 'M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222'],
                ['Women in Real Estate', 'We actively promote gender diversity in property ownership and the construction industry. Our Women in Real Estate initiative provides mentorship, affordable land access, and training for women who want to build wealth through property.', 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z'],
            ] as $i => [$title, $desc, $icon])
            <div class="bg-white rounded-2xl p-7 shadow-sm border border-gray-100 hover:shadow-md hover:border-[#27AE22]/20 transition-all group">
                <div class="w-12 h-12 bg-[#1A237E]/8 rounded-xl flex items-center justify-center mb-5 group-hover:bg-[#27AE22]/10 transition-colors">
                    <svg class="w-6 h-6 text-[#27AE22]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $icon }}"/>
                    </svg>
                </div>
                <h3 class="font-bold text-[#1A237E] text-lg mb-3">{{ $title }}</h3>
                <p class="text-gray-600 text-sm leading-relaxed">{{ $desc }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Impact Story --}}
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-gradient-to-r from-[#1A237E] to-[#0D1566] rounded-3xl p-10 lg:p-16 text-white relative overflow-hidden">
            <div class="absolute top-0 right-0 w-64 h-64 opacity-10 rounded-full" style="background:radial-gradient(circle, #27AE22, transparent)"></div>
            <div class="relative z-10 grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">
                <div>
                    <span class="inline-block text-[#27AE22] font-semibold text-sm tracking-widest uppercase mb-4">Impact Story</span>
                    <h2 class="font-display text-4xl font-bold mb-5">The Oko/Oba Community Initiative</h2>
                    <p class="text-gray-300 leading-relaxed mb-4">
                        In 2023, as part of our Ifako-Ijaye estate development, Shefa Homes constructed a 250-metre access road, installed 12 solar-powered streetlights, and drilled a community borehole that now serves over 600 residents who previously lacked clean water access.
                    </p>
                    <p class="text-gray-300 leading-relaxed">
                        This is what we mean when we say we build communities — not just properties.
                    </p>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    @foreach([['600+','Residents Benefited'],['250m','Road Constructed'],['12','Streetlights Installed'],['1','Community Borehole Drilled']] as [$n, $l])
                    <div class="bg-white/10 rounded-2xl p-5 text-center backdrop-blur-sm">
                        <span class="block text-3xl font-bold text-[#27AE22] mb-1">{{ $n }}</span>
                        <span class="text-xs text-gray-300 leading-tight">{{ $l }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

{{-- CTA --}}
<section class="py-20 bg-gray-50">
    <div class="max-w-3xl mx-auto px-4 text-center">
        <span class="inline-block text-[#27AE22] font-semibold text-sm tracking-widest uppercase mb-4">Get Involved</span>
        <h2 class="font-display text-4xl font-bold text-[#1A237E] mb-5">Partner With Us for Greater Impact</h2>
        <p class="text-gray-600 text-lg mb-8">If you are a corporate, NGO, or individual who shares our vision of community transformation, we would love to collaborate. Together we can build something that lasts.</p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('contact') }}" class="inline-flex items-center justify-center gap-2 bg-[#27AE22] text-white font-bold px-8 py-4 rounded-full hover:bg-[#1D9418] transition-all hover:scale-105 shadow-lg shadow-[#27AE22]/20">
                Partner With Us
            </a>
            <a href="https://wa.me/{{ $whatsapp ?? '2349122388541' }}" target="_blank" class="inline-flex items-center justify-center gap-2 border-2 border-[#1A237E] text-[#1A237E] font-bold px-8 py-4 rounded-full hover:bg-[#1A237E] hover:text-white transition-all">
                Chat on WhatsApp
            </a>
        </div>
    </div>
</section>

@endsection
