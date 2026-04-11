@extends('layouts.app')

@section('title', 'About SHEFAHOMES — Premium Real Estate Nigeria')
@section('meta_description', 'Learn the story of SHEFAHOMES, Nigeria\'s premier real estate developer. Our mission, vision, team and track record of excellence.')

@section('content')

{{-- Page Hero --}}
<section class="relative bg-[#0A1628] py-24 overflow-hidden">
    <div class="absolute inset-0">
        <img src="https://picsum.photos/seed/about-hero/1400/500" class="w-full h-full object-cover opacity-20" alt="">
        <div class="absolute inset-0 bg-gradient-to-r from-[#0A1628] via-[#0A1628]/90 to-[#0A1628]/70"></div>
    </div>
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl">
            <span class="inline-block text-[#C9A84C] font-semibold text-sm tracking-widest uppercase mb-3">Our Story</span>
            <h1 class="font-display text-5xl lg:text-6xl font-bold text-white mb-5 leading-tight">
                Building Nigeria's <span class="text-[#C9A84C]">Future</span>,<br>One Estate at a Time
            </h1>
            <p class="text-gray-300 text-xl leading-relaxed">
                A decade of turning real estate dreams into legal, documented and profitable realities for Nigerians at home and abroad.
            </p>
        </div>
    </div>
</section>

{{-- Company Story --}}
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <div data-reveal>
                <img src="https://picsum.photos/seed/about-story/800/600" alt="SHEFAHOMES Story" class="w-full rounded-3xl shadow-2xl shadow-[#0A1628]/15 object-cover h-[480px]">
            </div>
            <div data-reveal style="transition-delay:200ms">
                <span class="inline-block text-[#C9A84C] font-semibold text-sm tracking-widest uppercase mb-3">Who We Are</span>
                <h2 class="font-display text-4xl font-bold text-[#0A1628] mb-6 leading-tight">
                    Born from a Vision to Democratise Real Estate
                </h2>
                <div class="space-y-4 text-gray-500 leading-relaxed">
                    <p>SHEFAHOMES was founded on the belief that every hardworking Nigerian deserves to own a piece of their nation's land — with proper documentation, strategic location and genuine aftercare.</p>
                    <p>Since our inception, we have allocated over 5,000 plots across Nigeria's fastest-growing property corridors, in Lagos, Abuja, Ogun, Enugu and beyond. Every property we sell comes with a government-approved title and a dedicated account manager.</p>
                    <p>We are members of the Real Estate Developers Association of Nigeria (REDAN), the Lagos State Real Estate Regulatory Authority (LASRERA) and the Federal Capital Development Authority (FCDA) approved developers list.</p>
                </div>
                <div class="mt-8 flex flex-wrap gap-4">
                    <a href="{{ route('properties.index') }}" class="bg-[#C9A84C] text-[#0A1628] font-bold px-8 py-4 rounded-full hover:bg-[#E8C97A] transition-all hover:scale-105">
                        Explore Properties
                    </a>
                    <a href="{{ route('contact') }}" class="border-2 border-[#0A1628] text-[#0A1628] hover:border-[#C9A84C] hover:text-[#C9A84C] font-bold px-8 py-4 rounded-full transition-all">
                        Talk to Us
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Mission & Vision --}}
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-14" data-reveal>
            <span class="inline-block text-[#C9A84C] font-semibold text-sm tracking-widest uppercase mb-3">Purpose &amp; Direction</span>
            <h2 class="font-display text-4xl md:text-5xl font-bold text-[#0A1628]">Our <span class="text-[#C9A84C]">Mission &amp; Vision</span></h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            {{-- Mission --}}
            <div class="bg-[#0A1628] rounded-3xl p-10 text-white relative overflow-hidden" data-reveal>
                <div class="absolute top-0 right-0 w-32 h-32 bg-[#C9A84C]/10 rounded-bl-full"></div>
                <div class="w-14 h-14 bg-[#C9A84C]/20 rounded-2xl flex items-center justify-center mb-6">
                    <svg class="w-7 h-7 text-[#C9A84C]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                </div>
                <h3 class="font-display text-2xl font-bold text-[#C9A84C] mb-4">Our Mission</h3>
                <p class="text-gray-300 leading-relaxed text-lg">
                    To make land and property ownership accessible to every Nigerian by providing premium, legally secured real estate with transparent processes, flexible payment options and unmatched client support.
                </p>
            </div>
            {{-- Vision --}}
            <div class="bg-[#C9A84C] rounded-3xl p-10 text-[#0A1628] relative overflow-hidden" data-reveal style="transition-delay:150ms">
                <div class="absolute top-0 right-0 w-32 h-32 bg-[#0A1628]/10 rounded-bl-full"></div>
                <div class="w-14 h-14 bg-[#0A1628]/15 rounded-2xl flex items-center justify-center mb-6">
                    <svg class="w-7 h-7 text-[#0A1628]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                </div>
                <h3 class="font-display text-2xl font-bold text-[#0A1628] mb-4">Our Vision</h3>
                <p class="text-[#0A1628]/80 leading-relaxed text-lg">
                    To be Africa's most trusted real estate company — a household name synonymous with integrity, innovation and life-changing property investments that span every state in Nigeria and beyond.
                </p>
            </div>
        </div>

        {{-- Core values --}}
        <div class="mt-12 grid grid-cols-2 sm:grid-cols-4 gap-6">
            @foreach([
                ['icon'=>'shield','value'=>'Integrity','desc'=>'Every promise, kept.'],
                ['icon'=>'star','value'=>'Excellence','desc'=>'Standards that set us apart.'],
                ['icon'=>'users','value'=>'Community','desc'=>'Clients are family.'],
                ['icon'=>'refresh','value'=>'Innovation','desc'=>'Always improving.'],
            ] as $i => $v)
            <div class="bg-white rounded-2xl p-6 text-center shadow-sm border border-gray-100 hover:border-[#C9A84C]/30 hover:shadow-md transition-all" data-reveal style="transition-delay:{{ $i*100 }}ms">
                <div class="w-12 h-12 bg-[#C9A84C]/10 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <svg class="w-6 h-6 text-[#C9A84C]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        @if($v['icon']==='shield')<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        @elseif($v['icon']==='star')<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                        @elseif($v['icon']==='users')<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        @else<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                        @endif
                    </svg>
                </div>
                <h4 class="font-bold text-[#0A1628] mb-1">{{ $v['value'] }}</h4>
                <p class="text-gray-400 text-sm">{{ $v['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Stats Bar --}}
<section class="py-16 bg-[#0A1628]"
         x-data="{animated:false}"
         x-intersect.once="animated=true; $el.querySelectorAll('[data-count]').forEach(el=>{const t=parseInt(el.dataset.count),s=t/125;let c=0;const ti=setInterval(()=>{c+=s;if(c>=t){c=t;clearInterval(ti);}el.textContent=Math.floor(c).toLocaleString();},16);})">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-8 text-center">
            @foreach([['5000','+','Happy Clients'],['50','+','Premium Estates'],['15','+','States'],['10','+','Years']] as $s)
            <div>
                <div class="font-display text-5xl font-bold text-[#C9A84C]">
                    <span data-count="{{ $s[0] }}">0</span>{{ $s[1] }}
                </div>
                <p class="text-gray-400 mt-2 text-sm uppercase tracking-wider">{{ $s[2] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Team --}}
@if(isset($team) && $team->count())
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-14" data-reveal>
            <span class="inline-block text-[#C9A84C] font-semibold text-sm tracking-widest uppercase mb-3">The People Behind the Vision</span>
            <h2 class="font-display text-4xl md:text-5xl font-bold text-[#0A1628]">Meet Our <span class="text-[#C9A84C]">Team</span></h2>
        </div>
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($team as $i => $member)
            <div class="group relative bg-white rounded-2xl overflow-hidden shadow-sm border border-gray-100 hover:shadow-xl transition-all duration-500 hover:-translate-y-1"
                 data-reveal style="transition-delay:{{ $i * 100 }}ms">
                <div class="relative h-60 overflow-hidden">
                    @if($member->photo_url)
                    <img src="{{ $member->photo_url }}" alt="{{ $member->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                    @else
                    <div class="w-full h-full bg-gradient-to-br from-[#0A1628] to-[#1a2d4a] flex items-center justify-center">
                        <span class="text-4xl font-bold text-[#C9A84C]">{{ strtoupper(substr($member->name,0,1)) }}</span>
                    </div>
                    @endif
                    {{-- Bio overlay on hover --}}
                    <div class="absolute inset-0 bg-[#0A1628]/90 flex items-center justify-center p-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <p class="text-gray-300 text-xs text-center leading-relaxed">{{ Str::limit($member->bio ?? '', 140) }}</p>
                    </div>
                </div>
                <div class="p-4 text-center">
                    <h4 class="font-bold text-[#0A1628] mb-0.5">{{ $member->name }}</h4>
                    <p class="text-[#C9A84C] text-xs font-semibold">{{ $member->title }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- Awards --}}
@if(isset($awards) && $awards->count())
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-14">
            <span class="inline-block text-[#C9A84C] font-semibold text-sm tracking-widest uppercase mb-3">Recognition</span>
            <h2 class="font-display text-4xl font-bold text-[#0A1628]">Awards &amp; <span class="text-[#C9A84C]">Accreditations</span></h2>
        </div>
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($awards as $i => $award)
            <div class="bg-white rounded-2xl p-6 text-center shadow-sm border border-gray-100 hover:border-[#C9A84C]/30 hover:shadow-md transition-all"
                 data-reveal style="transition-delay:{{ $i*100 }}ms">
                <div class="w-12 h-12 bg-[#C9A84C]/10 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <svg class="w-6 h-6 text-[#C9A84C]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
                </div>
                <h4 class="font-bold text-[#0A1628] text-sm mb-1">{{ $award->title }}</h4>
                <p class="text-[#C9A84C] text-xs font-semibold">{{ $award->year }}</p>
                @if($award->organization)<p class="text-gray-400 text-xs mt-1">{{ $award->organization }}</p>@endif
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- Partners row --}}
@if(isset($partners) && $partners->count())
<section class="py-12 bg-white border-t border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <p class="text-center text-xs font-semibold text-gray-400 uppercase tracking-widest mb-8">Our Partners &amp; Regulators</p>
        <div class="flex flex-wrap items-center justify-center gap-8">
            @foreach($partners as $partner)
            <div class="grayscale hover:grayscale-0 opacity-60 hover:opacity-100 transition-all">
                @if($partner->logo_url)
                <img src="{{ $partner->logo_url }}" alt="{{ $partner->name }}" class="h-10 max-w-[120px] object-contain">
                @else
                <span class="text-gray-400 font-bold px-4 py-2 border border-gray-200 rounded-xl text-sm">{{ $partner->name }}</span>
                @endif
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

@endsection
