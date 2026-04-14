@extends('layouts.app')

@section('title', 'Our Team — Shefa Homes and Properties Ltd')
@section('description', 'Meet the dedicated professionals driving excellence in real estate development, investment, and client service at Shefa Homes.')

@section('content')

{{-- Hero --}}
<section class="relative bg-[#1A237E] py-24 overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-br from-[#1A237E] to-[#0D1566]"></div>
    <div class="absolute bottom-0 right-0 w-80 h-80 opacity-10 rounded-full" style="background:radial-gradient(circle, #27AE22, transparent 70%)"></div>
    <div class="absolute top-16 left-10 w-48 h-48 opacity-5 rounded-full" style="background:radial-gradient(circle, #27AE22, transparent 70%)"></div>
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <span class="inline-block text-[#27AE22] font-semibold text-sm tracking-widest uppercase mb-4">People & Culture</span>
        <h1 class="font-display text-5xl lg:text-6xl font-bold text-white mb-5">Meet Our Team</h1>
        <p class="text-gray-300 text-xl max-w-2xl mx-auto">The dedicated professionals behind every project, partnership, and property we deliver across Nigeria.</p>
    </div>
</section>

@if($featured->isNotEmpty())
{{-- Leadership / Featured --}}
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-14">
            <span class="inline-block text-[#27AE22] font-semibold text-sm tracking-widest uppercase mb-3">Leadership</span>
            <h2 class="font-display text-4xl font-bold text-[#1A237E]">Executive Team</h2>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10">
            @foreach($featured as $member)
            <div class="group text-center">
                <div class="relative inline-block mb-5">
                    <div class="w-40 h-40 mx-auto rounded-full overflow-hidden ring-4 ring-[#27AE22]/20 group-hover:ring-[#27AE22]/50 transition-all shadow-lg">
                        <img src="{{ $member->photo_url }}" alt="{{ $member->name }}"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    </div>
                    <span class="absolute bottom-1 right-1/2 translate-x-1/2 translate-y-1/2 w-8 h-8 bg-[#27AE22] rounded-full flex items-center justify-center shadow-md">
                        <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                    </span>
                </div>
                <h3 class="text-xl font-bold text-[#1A237E]">{{ $member->name }}</h3>
                <p class="text-[#27AE22] font-semibold text-sm mt-0.5">{{ $member->position }}</p>
                @if($member->department)
                <p class="text-gray-400 text-xs mt-0.5 uppercase tracking-wide">{{ $member->department }}</p>
                @endif
                @if($member->bio)
                <p class="text-gray-500 text-sm leading-relaxed mt-3 max-w-xs mx-auto">{{ Str::limit($member->bio, 120) }}</p>
                @endif
                @if($member->linkedin || $member->twitter || $member->email)
                <div class="flex items-center justify-center gap-3 mt-4">
                    @if($member->linkedin)
                    <a href="{{ $member->linkedin }}" target="_blank" rel="noopener"
                       class="w-8 h-8 bg-gray-100 hover:bg-[#1A237E] rounded-full flex items-center justify-center transition-colors group/icon">
                        <svg class="w-4 h-4 text-gray-500 group-hover/icon:text-white transition-colors" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                        </svg>
                    </a>
                    @endif
                    @if($member->twitter)
                    <a href="{{ $member->twitter }}" target="_blank" rel="noopener"
                       class="w-8 h-8 bg-gray-100 hover:bg-[#1A237E] rounded-full flex items-center justify-center transition-colors group/icon">
                        <svg class="w-4 h-4 text-gray-500 group-hover/icon:text-white transition-colors" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-4.714-6.231-5.401 6.231H2.744l7.73-8.835L1.254 2.25H8.08l4.259 5.63zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                        </svg>
                    </a>
                    @endif
                    @if($member->email)
                    <a href="mailto:{{ $member->email }}"
                       class="w-8 h-8 bg-gray-100 hover:bg-[#27AE22] rounded-full flex items-center justify-center transition-colors group/icon">
                        <svg class="w-4 h-4 text-gray-500 group-hover/icon:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </a>
                    @endif
                </div>
                @endif
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

@if($others->isNotEmpty())
{{-- Full Team Grid --}}
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-14">
            <span class="inline-block text-[#27AE22] font-semibold text-sm tracking-widest uppercase mb-3">Our People</span>
            <h2 class="font-display text-4xl font-bold text-[#1A237E]">The Full Team</h2>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6">
            @foreach($others as $member)
            <div class="group bg-white rounded-2xl overflow-hidden border border-gray-100 hover:border-[#27AE22]/30 hover:shadow-md transition-all text-center p-5">
                <div class="w-20 h-20 mx-auto rounded-full overflow-hidden ring-2 ring-gray-100 group-hover:ring-[#27AE22]/30 transition-all mb-3">
                    <img src="{{ $member->photo_url }}" alt="{{ $member->name }}"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                </div>
                <h4 class="font-bold text-[#1A237E] text-sm leading-tight">{{ $member->name }}</h4>
                <p class="text-[#27AE22] text-xs font-medium mt-0.5">{{ $member->position }}</p>
                @if($member->department)
                <p class="text-gray-400 text-xs mt-0.5">{{ $member->department }}</p>
                @endif
                @if($member->linkedin || $member->email)
                <div class="flex items-center justify-center gap-2 mt-3">
                    @if($member->linkedin)
                    <a href="{{ $member->linkedin }}" target="_blank" rel="noopener"
                       class="w-6 h-6 bg-gray-100 hover:bg-[#1A237E] rounded-full flex items-center justify-center transition-colors group/icon">
                        <svg class="w-3 h-3 text-gray-500 group-hover/icon:text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                        </svg>
                    </a>
                    @endif
                    @if($member->email)
                    <a href="mailto:{{ $member->email }}"
                       class="w-6 h-6 bg-gray-100 hover:bg-[#27AE22] rounded-full flex items-center justify-center transition-colors group/icon">
                        <svg class="w-3 h-3 text-gray-500 group-hover/icon:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </a>
                    @endif
                </div>
                @endif
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

@if($team->isEmpty())
<section class="py-32 bg-white text-center">
    <div class="max-w-md mx-auto px-4">
        <svg class="w-16 h-16 text-gray-200 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0"/>
        </svg>
        <p class="text-gray-400 text-lg">Our team profiles are coming soon.</p>
    </div>
</section>
@endif

{{-- Values / Culture --}}
<section class="py-20 bg-[#1A237E]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-14">
            <span class="inline-block text-[#27AE22] font-semibold text-sm tracking-widest uppercase mb-3">Our Culture</span>
            <h2 class="font-display text-4xl font-bold text-white">What Drives Us</h2>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach([
                ['Integrity', 'We do what we say, transparently and consistently — in every deal and every interaction.', 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z'],
                ['Excellence', 'From site selection to final delivery, we set the bar high and hold ourselves to it.', 'M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z'],
                ['Innovation', 'We embrace forward-thinking approaches to meet the evolving demands of modern real estate.', 'M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z'],
                ['People First', 'Our clients, investors, and staff are at the heart of every decision we make.', 'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z'],
            ] as [$title, $desc, $icon])
            <div class="bg-white/5 border border-white/10 rounded-2xl p-6 hover:bg-white/10 transition-all">
                <div class="w-10 h-10 bg-[#27AE22]/20 rounded-xl flex items-center justify-center mb-4">
                    <svg class="w-5 h-5 text-[#27AE22]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $icon }}"/>
                    </svg>
                </div>
                <h3 class="text-white font-bold text-lg mb-2">{{ $title }}</h3>
                <p class="text-gray-400 text-sm leading-relaxed">{{ $desc }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Join CTA --}}
<section class="py-16 bg-white">
    <div class="max-w-4xl mx-auto px-4 text-center">
        <span class="inline-block text-[#27AE22] font-semibold text-sm tracking-widest uppercase mb-4">Join Us</span>
        <h2 class="font-display text-3xl font-bold text-[#1A237E] mb-4">Want to Build With Us?</h2>
        <p class="text-gray-500 mb-8">We're always looking for talented, passionate individuals to join the Shefa Homes family. Browse open positions or reach out directly.</p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('careers.index') }}" class="inline-flex items-center justify-center gap-2 bg-[#27AE22] text-white font-bold px-8 py-4 rounded-full hover:bg-[#1D9418] transition-all">
                View Open Roles
            </a>
            <a href="{{ route('contact') }}" class="inline-flex items-center justify-center gap-2 border-2 border-[#1A237E] text-[#1A237E] font-bold px-8 py-4 rounded-full hover:bg-[#1A237E] hover:text-white transition-all">
                Get in Touch
            </a>
        </div>
    </div>
</section>

@endsection
