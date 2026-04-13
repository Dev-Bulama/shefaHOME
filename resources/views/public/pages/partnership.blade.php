@extends('layouts.app')

@section('title', 'Partnership Opportunities — SHEFAHOMES')
@section('meta_description', 'Partner with SHEFAHOMES. Explore business partnership opportunities in Nigeria\'s leading real estate company.')

@section('content')

{{-- Page Header --}}
<section class="bg-[#1A237E] py-24 relative overflow-hidden">
    <div class="absolute inset-0">
        <img src="https://picsum.photos/seed/partnership-hero/1400/600" class="w-full h-full object-cover opacity-15" alt="">
        <div class="absolute inset-0 bg-gradient-to-r from-[#1A237E] via-[#1A237E]/95 to-transparent"></div>
    </div>
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-2xl">
            <span class="inline-block text-[#27AE22] font-semibold text-sm tracking-widest uppercase mb-3">Collaborate</span>
            <h1 class="font-display text-5xl lg:text-6xl font-bold text-white mb-5 leading-tight">
                Partner With <span class="text-[#27AE22]">SHEFAHOMES</span>
            </h1>
            <p class="text-gray-300 text-xl leading-relaxed">
                We believe in the power of strategic partnerships. Together, we can expand access to quality real estate across Nigeria.
            </p>
        </div>
    </div>
</section>

{{-- Partnership Types --}}
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-14" data-reveal>
            <span class="inline-block text-[#27AE22] font-semibold text-sm tracking-widest uppercase mb-3">Opportunities</span>
            <h2 class="font-display text-4xl md:text-5xl font-bold text-[#1A237E] mb-4">
                Types of <span class="text-[#27AE22]">Partnership</span>
            </h2>
            <p class="text-gray-500 text-lg max-w-xl mx-auto">Whether you are an individual, organisation or corporation, there is a partnership model for you.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @php
            $partnerTypes = [
                [
                    'title'   => 'Referral Partners',
                    'icon'    => 'users',
                    'color'   => 'bg-blue-50 text-blue-600',
                    'desc'    => 'Earn attractive commissions by referring clients to SHEFAHOMES. No upfront investment required. We handle everything — you earn on every successful sale.',
                    'perks'   => ['Up to 5% referral commission', 'Dedicated affiliate dashboard', 'Marketing materials provided', 'Same-day commission payout'],
                ],
                [
                    'title'   => 'Corporate Partners',
                    'icon'    => 'building',
                    'color'   => 'bg-emerald-50 text-emerald-600',
                    'desc'    => 'Offer SHEFAHOMES real estate as a staff benefit or investment option for your corporate clients. Ideal for banks, HMOs, cooperatives and employers.',
                    'perks'   => ['Exclusive corporate pricing', 'Dedicated account executive', 'Staff investment packages', 'Group purchase discounts'],
                ],
                [
                    'title'   => 'Land Owners',
                    'icon'    => 'map',
                    'color'   => 'bg-purple-50 text-purple-600',
                    'desc'    => 'Own land in a fast-growing area? Partner with us to develop, subdivide and market your property to our pool of over 50,000 active buyers.',
                    'perks'   => ['Joint venture development', 'Revenue share model', 'Full legal and survey management', 'Marketing to our subscriber base'],
                ],
                [
                    'title'   => 'Financial Institutions',
                    'icon'    => 'cash',
                    'color'   => 'bg-amber-50 text-amber-600',
                    'desc'    => 'Banks, mortgage lenders and cooperative societies can partner with us to provide financing products to our clients.',
                    'perks'   => ['Qualified mortgage leads', 'Co-branded products', 'Shared client database', 'Revenue participation'],
                ],
                [
                    'title'   => 'Marketing Agencies',
                    'icon'    => 'chart',
                    'color'   => 'bg-rose-50 text-rose-600',
                    'desc'    => 'Creative and digital marketing agencies can partner with us to execute campaigns, manage social media and generate qualified property leads.',
                    'perks'   => ['Performance-based compensation', 'Long-term retainer opportunities', 'Creative freedom', 'Access to brand assets'],
                ],
                [
                    'title'   => 'Diaspora Agents',
                    'icon'    => 'globe',
                    'color'   => 'bg-teal-50 text-teal-600',
                    'desc'    => 'Based outside Nigeria? Become our international representative and help diaspora Nigerians invest in premium real estate back home.',
                    'perks'   => ['International commission rates', 'Dedicated diaspora support', 'Virtual transaction process', 'Special diaspora pricing'],
                ],
            ];
            @endphp

            @foreach($partnerTypes as $i => $pt)
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-xl transition-all hover:-translate-y-1 p-7 group"
                 data-reveal style="transition-delay:{{ $i * 100 }}ms">
                <div class="w-14 h-14 {{ $pt['color'] }} rounded-2xl flex items-center justify-center mb-5 group-hover:scale-110 transition-transform">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        @if($pt['icon']==='users')<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        @elseif($pt['icon']==='building')<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        @elseif($pt['icon']==='map')<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                        @elseif($pt['icon']==='cash')<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                        @elseif($pt['icon']==='chart')<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        @else<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        @endif
                    </svg>
                </div>
                <h3 class="font-display font-bold text-[#1A237E] text-xl mb-3">{{ $pt['title'] }}</h3>
                <p class="text-gray-500 text-sm leading-relaxed mb-5">{{ $pt['desc'] }}</p>
                <ul class="space-y-2">
                    @foreach($pt['perks'] as $perk)
                    <li class="flex items-center gap-2 text-xs text-gray-500">
                        <svg class="w-4 h-4 text-[#27AE22] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        {{ $perk }}
                    </li>
                    @endforeach
                </ul>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Partnership Enquiry Form --}}
<section class="py-20 bg-gray-50">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-10">
            <h2 class="font-display text-4xl font-bold text-[#1A237E] mb-4">Ready to Partner With Us?</h2>
            <p class="text-gray-500 text-lg">Fill in the form below and our partnerships team will respond within 48 hours.</p>
        </div>
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="h-1 bg-gradient-to-r from-[#1A237E] via-[#27AE22] to-[#1A237E]"></div>
            <div class="p-8">
                @if(session('success'))
                <div class="bg-emerald-50 border border-emerald-200 rounded-2xl p-6 text-center mb-6">
                    <svg class="w-12 h-12 text-emerald-500 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <h3 class="font-bold text-emerald-800 text-lg mb-1">Enquiry Submitted!</h3>
                    <p class="text-emerald-700 text-sm">{{ session('success') }}</p>
                </div>
                @endif

                <form action="{{ route('contact.send') }}" method="POST" class="space-y-5">
                    @csrf
                    <input type="hidden" name="subject" value="Partnership Enquiry">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Full Name *</label>
                            <input type="text" name="name" required value="{{ old('name') }}" placeholder="John Doe"
                                   class="w-full border border-gray-200 rounded-xl px-4 py-3.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#27AE22] text-[#1A237E] @error('name') border-red-400 @enderror">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Organisation</label>
                            <input type="text" name="organisation" value="{{ old('organisation') }}" placeholder="Your Company"
                                   class="w-full border border-gray-200 rounded-xl px-4 py-3.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#27AE22] text-[#1A237E]">
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Email Address *</label>
                        <input type="email" name="email" required value="{{ old('email') }}" placeholder="you@company.com"
                               class="w-full border border-gray-200 rounded-xl px-4 py-3.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#27AE22] text-[#1A237E] @error('email') border-red-400 @enderror">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Phone Number</label>
                        <input type="tel" name="phone" value="{{ old('phone') }}" placeholder="+234 800 000 0000"
                               class="w-full border border-gray-200 rounded-xl px-4 py-3.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#27AE22] text-[#1A237E]">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Partnership Type *</label>
                        <select name="partnership_type" required
                                class="w-full border border-gray-200 rounded-xl px-4 py-3.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#27AE22] text-gray-700 bg-white">
                            <option value="">Select partnership type</option>
                            <option value="referral">Referral Partner</option>
                            <option value="corporate">Corporate Partner</option>
                            <option value="landowner">Land Owner</option>
                            <option value="financial">Financial Institution</option>
                            <option value="marketing">Marketing Agency</option>
                            <option value="diaspora">Diaspora Agent</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Tell Us More *</label>
                        <textarea name="message" rows="4" required placeholder="Describe your partnership proposal and how you can add value..."
                                  class="w-full border border-gray-200 rounded-xl px-4 py-3.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#27AE22] text-[#1A237E] resize-none">{{ old('message') }}</textarea>
                    </div>
                    <button type="submit"
                            class="w-full bg-[#27AE22] hover:bg-[#1D9418] text-[#1A237E] font-bold py-4 rounded-xl transition-all hover:scale-[1.01] hover:shadow-lg hover:shadow-[#27AE22]/30 text-base">
                        Submit Partnership Enquiry
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

{{-- Trust signals --}}
<section class="py-12 bg-[#1A237E] text-center">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <p class="text-gray-400 mb-6">We already work with some of Nigeria's most respected institutions</p>
        <div class="flex flex-wrap items-center justify-center gap-8 text-gray-500 text-sm font-bold">
            @foreach(['LASRERA', 'REDAN', 'CAC', 'FCDA', 'Sterling Bank', 'United Bank for Africa'] as $p)
            <span class="border border-white/10 px-5 py-2 rounded-xl opacity-60 hover:opacity-100 transition-opacity">{{ $p }}</span>
            @endforeach
        </div>
    </div>
</section>

@endsection
