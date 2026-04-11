@extends('layouts.app')

@section('title', 'Investor Information — SHEFAHOMES')
@section('meta_description', 'Invest with SHEFAHOMES and earn premium ROI through Nigeria\'s fastest-growing real estate market.')

@section('content')

{{-- Hero --}}
<section class="bg-[#0A1628] py-24 relative overflow-hidden">
    <div class="absolute inset-0">
        <img src="https://picsum.photos/seed/investor-hero/1400/600" class="w-full h-full object-cover opacity-15" alt="">
        <div class="absolute inset-0 bg-gradient-to-r from-[#0A1628] to-[#0A1628]/90"></div>
    </div>
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl">
            <span class="inline-block text-[#C9A84C] font-semibold text-sm tracking-widest uppercase mb-3">Wealth Building</span>
            <h1 class="font-display text-5xl lg:text-7xl font-bold text-white mb-6 leading-tight">
                Grow Your Wealth<br>with <span class="text-[#C9A84C]">SHEFAHOMES</span>
            </h1>
            <p class="text-gray-300 text-xl leading-relaxed mb-8 max-w-2xl">
                Nigeria's real estate market has consistently delivered double-digit returns. Join our growing community of smart investors and secure your financial future.
            </p>
            <div class="flex flex-wrap gap-4">
                <a href="#investment-tiers" class="bg-[#C9A84C] hover:bg-[#E8C97A] text-[#0A1628] font-bold px-10 py-4 rounded-full transition-all hover:scale-105">
                    View Investment Tiers
                </a>
                <a href="{{ route('contact') }}" class="border-2 border-white text-white hover:bg-white hover:text-[#0A1628] font-bold px-10 py-4 rounded-full transition-all">
                    Talk to an Advisor
                </a>
            </div>
        </div>
    </div>
</section>

{{-- ROI Showcase --}}
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-8 text-center">
            @foreach([
                ['30%+', 'Average Annual Appreciation', 'bg-blue-50 text-blue-600'],
                ['₦500K', 'Minimum Investment', 'bg-amber-50 text-amber-600'],
                ['10+', 'Years of Market Expertise', 'bg-emerald-50 text-emerald-600'],
            ] as $stat)
            <div class="p-8 rounded-2xl {{ $stat[2] }} border border-current/10">
                <p class="font-display text-5xl font-bold mb-2">{{ $stat[0] }}</p>
                <p class="font-semibold text-base">{{ $stat[1] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Investment Tiers --}}
<section id="investment-tiers" class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-14" data-reveal>
            <span class="inline-block text-[#C9A84C] font-semibold text-sm tracking-widest uppercase mb-3">Investment Options</span>
            <h2 class="font-display text-4xl md:text-5xl font-bold text-[#0A1628] mb-4">
                Choose Your <span class="text-[#C9A84C]">Investment Tier</span>
            </h2>
            <p class="text-gray-500 text-lg max-w-xl mx-auto">We have packages designed for every budget and investment appetite.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @php
            $tiers = [
                [
                    'name'     => 'Bronze',
                    'subtitle' => 'Starter Investor',
                    'price'    => '₦500,000+',
                    'color'    => 'border-orange-200',
                    'badge'    => 'bg-orange-100 text-orange-700',
                    'icon_bg'  => 'bg-orange-100',
                    'icon_color' => 'text-orange-500',
                    'benefits' => ['1–2 plots allocation', 'Instalment payment plan', 'E-title delivery', 'Client portal access', 'Monthly reports'],
                    'popular'  => false,
                ],
                [
                    'name'     => 'Silver',
                    'subtitle' => 'Smart Investor',
                    'price'    => '₦2,000,000+',
                    'color'    => 'border-gray-300',
                    'badge'    => 'bg-gray-100 text-gray-600',
                    'icon_bg'  => 'bg-gray-100',
                    'icon_color' => 'text-gray-500',
                    'benefits' => ['3–5 plots allocation', 'Priority payment plan', 'Hard copy title deed', 'Dedicated account manager', 'Quarterly site visits', 'Resale assistance'],
                    'popular'  => false,
                ],
                [
                    'name'     => 'Gold',
                    'subtitle' => 'Premium Investor',
                    'price'    => '₦5,000,000+',
                    'color'    => 'border-[#C9A84C]',
                    'badge'    => 'bg-[#C9A84C] text-[#0A1628]',
                    'icon_bg'  => 'bg-[#C9A84C]/15',
                    'icon_color' => 'text-[#C9A84C]',
                    'benefits' => ['6–15 plots allocation', 'Flexible payment terms', 'C of O processing', 'VIP account manager', 'Monthly site visits', 'Resale &amp; rental management', 'Investment report'],
                    'popular'  => true,
                ],
                [
                    'name'     => 'Platinum',
                    'subtitle' => 'Elite Investor',
                    'price'    => '₦20,000,000+',
                    'color'    => 'border-purple-300',
                    'badge'    => 'bg-purple-100 text-purple-700',
                    'icon_bg'  => 'bg-purple-100',
                    'icon_color' => 'text-purple-500',
                    'benefits' => ['Bulk plot allocation', 'Outright or deferred payment', 'Full C of O / Survey plan', 'Direct MD access', 'Customised estate development', 'Co-investment opportunities', 'Full legal support'],
                    'popular'  => false,
                ],
            ];
            @endphp

            @foreach($tiers as $i => $tier)
            <div class="relative bg-white rounded-3xl border-2 {{ $tier['color'] }} overflow-hidden shadow-sm hover:shadow-xl transition-all hover:-translate-y-1 flex flex-col"
                 data-reveal style="transition-delay:{{ $i * 120 }}ms">

                @if($tier['popular'])
                <div class="absolute top-0 left-0 right-0 h-1 bg-[#C9A84C]"></div>
                <div class="absolute top-4 right-4">
                    <span class="bg-[#C9A84C] text-[#0A1628] text-xs font-bold px-3 py-1 rounded-full">Most Popular</span>
                </div>
                @endif

                <div class="p-7 flex flex-col flex-1">
                    {{-- Tier icon --}}
                    <div class="w-14 h-14 {{ $tier['icon_bg'] }} rounded-2xl flex items-center justify-center mb-5">
                        <svg class="w-7 h-7 {{ $tier['icon_color'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
                    </div>

                    <span class="{{ $tier['badge'] }} text-xs font-bold px-3 py-1 rounded-full self-start mb-3">{{ $tier['name'] }}</span>
                    <p class="text-gray-400 text-xs font-semibold uppercase tracking-wider mb-2">{{ $tier['subtitle'] }}</p>
                    <p class="font-display text-3xl font-bold text-[#0A1628] mb-6">{{ $tier['price'] }}</p>

                    {{-- Benefits --}}
                    <ul class="space-y-3 mb-8 flex-1">
                        @foreach($tier['benefits'] as $benefit)
                        <li class="flex items-start gap-3 text-sm text-gray-500">
                            <svg class="w-4 h-4 text-[#C9A84C] flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            {!! $benefit !!}
                        </li>
                        @endforeach
                    </ul>

                    <a href="{{ route('contact') }}"
                       class="{{ $tier['popular'] ? 'bg-[#C9A84C] text-[#0A1628] hover:bg-[#E8C97A]' : 'bg-[#0A1628] text-white hover:bg-[#C9A84C] hover:text-[#0A1628]' }} font-bold text-sm py-3.5 rounded-xl transition-all text-center block">
                        Get Started
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Benefits Section --}}
<section class="py-20 bg-[#0A1628]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <div>
                <span class="inline-block text-[#C9A84C] font-semibold text-sm tracking-widest uppercase mb-3">Why Invest With Us</span>
                <h2 class="font-display text-4xl font-bold text-white mb-8">The SHEFAHOMES<br><span class="text-[#C9A84C]">Investor Advantage</span></h2>
                <div class="space-y-5">
                    @foreach([
                        ['Guaranteed Capital Appreciation', 'Nigerian real estate has never lost value long-term. Our estates are in fast-growth corridors with documented 30–100% appreciation in under 5 years.'],
                        ['Zero Interest Payment Plans', 'Spread your investment with no finance charges. Our flexible instalment plans make property ownership achievable for any budget.'],
                        ['Legal Security', 'Every title is government-approved, conflict-free and fully surveyed. Our legal team handles all documentation.'],
                        ['Resale & Rental Management', 'We help you monetise your investment through our managed resale and rental listing service.'],
                    ] as $b)
                    <div class="flex gap-5 group">
                        <div class="w-12 h-12 bg-[#C9A84C]/15 rounded-2xl flex items-center justify-center flex-shrink-0 group-hover:bg-[#C9A84C]/30 transition-colors">
                            <svg class="w-6 h-6 text-[#C9A84C]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-white mb-1">{{ $b[0] }}</h4>
                            <p class="text-gray-400 text-sm leading-relaxed">{{ $b[1] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="relative">
                <img src="https://picsum.photos/seed/investor-side/800/600" alt="Real Estate Investment" class="w-full rounded-3xl shadow-2xl h-[450px] object-cover">
                {{-- ROI Badge --}}
                <div class="absolute -bottom-6 -right-6 hidden lg:block">
                    <div class="bg-[#C9A84C] text-[#0A1628] rounded-2xl p-6 text-center shadow-xl">
                        <div class="font-display text-4xl font-black">30%+</div>
                        <div class="text-xs font-bold uppercase tracking-wide">Annual ROI</div>
                        <div class="text-xs opacity-70 mt-1">Average across our estates</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Become an Investor CTA --}}
<section class="py-20 bg-gradient-to-r from-[#C9A84C] to-[#E8C97A]">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="font-display text-4xl lg:text-5xl font-bold text-[#0A1628] mb-5">Ready to Start Building Wealth?</h2>
        <p class="text-[#0A1628]/70 text-xl mb-10 max-w-xl mx-auto">
            Join over 5,000 investors who are already growing their wealth through SHEFAHOMES real estate.
        </p>
        <div class="flex flex-wrap gap-4 justify-center">
            <a href="{{ route('properties.index') }}"
               class="bg-[#0A1628] hover:bg-[#1a2d4a] text-white font-bold px-10 py-5 rounded-full transition-all hover:scale-105 hover:shadow-xl text-lg">
                Become an Investor
            </a>
            <a href="{{ route('contact') }}"
               class="border-2 border-[#0A1628] text-[#0A1628] hover:bg-[#0A1628] hover:text-white font-bold px-10 py-5 rounded-full transition-all text-lg">
                Speak to an Advisor
            </a>
        </div>
    </div>
</section>

@endsection
