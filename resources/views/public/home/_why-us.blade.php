{{-- Why Choose Us --}}
<section class="py-20 bg-white overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">

            {{-- Left: Image --}}
            <div class="relative" data-reveal>
                {{-- Main image --}}
                <div class="relative rounded-3xl overflow-hidden shadow-2xl shadow-[#0A1628]/20">
                    <img src="https://picsum.photos/seed/luxury2/800/600"
                         alt="Luxury Real Estate"
                         class="w-full h-[500px] object-cover">
                    <div class="absolute inset-0 bg-gradient-to-tr from-[#0A1628]/40 via-transparent to-transparent"></div>
                </div>

                {{-- Floating badge top-right --}}
                <div class="absolute -top-6 -right-6 hidden lg:block">
                    <div class="bg-[#C9A84C] text-[#0A1628] font-bold rounded-2xl p-5 shadow-xl text-center">
                        <div class="text-3xl font-display font-black">10+</div>
                        <div class="text-xs font-semibold uppercase tracking-wide">Years of<br>Excellence</div>
                    </div>
                </div>

                {{-- Floating stat card bottom-left --}}
                <div class="absolute -bottom-8 -left-6 hidden lg:block">
                    <div class="bg-white rounded-2xl p-5 shadow-2xl shadow-[#0A1628]/15 border border-gray-100 min-w-[180px]">
                        <div class="flex items-center gap-3 mb-2">
                            <div class="w-10 h-10 bg-emerald-100 rounded-xl flex items-center justify-center">
                                <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-400">Verified Titles</p>
                                <p class="font-bold text-[#0A1628]">100% Government Approved</p>
                            </div>
                        </div>
                        <div class="h-1 bg-gray-100 rounded-full">
                            <div class="h-1 bg-emerald-500 rounded-full w-full"></div>
                        </div>
                    </div>
                </div>

                {{-- Decorative dots --}}
                <div class="absolute -z-10 -bottom-10 -right-10 w-40 h-40 opacity-20" style="background-image: radial-gradient(circle, #C9A84C 1.5px, transparent 1.5px); background-size: 12px 12px;"></div>
            </div>

            {{-- Right: Content --}}
            <div data-reveal style="transition-delay: 200ms">
                <span class="inline-block text-[#C9A84C] font-semibold text-sm tracking-widest uppercase mb-3">Why Choose Us</span>
                <h2 class="font-display text-4xl md:text-5xl font-bold text-[#0A1628] mb-4 leading-tight">
                    We Don't Just Sell<br>Land — We Build <span class="text-[#C9A84C]">Futures</span>
                </h2>
                <p class="text-gray-500 text-lg mb-10 leading-relaxed">
                    SHEFAHOMES is Nigeria's most trusted real estate development company. We combine government-approved titles, flexible payment plans and unmatched aftercare service to deliver lasting value for every investor.
                </p>

                {{-- Feature Bullets --}}
                <div class="space-y-6">
                    @php
                    $features = [
                        [
                            'icon'  => 'shield',
                            'title' => 'Government Approved Titles',
                            'desc'  => 'Every property comes with full legal documentation — C of O, R of O, Deed of Assignment. Zero encumbrances.',
                            'color' => 'bg-blue-50 text-blue-600',
                        ],
                        [
                            'icon'  => 'cash',
                            'title' => 'Flexible Payment Plans',
                            'desc'  => 'Spread your investment over 6 to 36 months with 0% interest. Real estate ownership made accessible to every Nigerian.',
                            'color' => 'bg-emerald-50 text-emerald-600',
                        ],
                        [
                            'icon'  => 'location',
                            'title' => 'Strategic Locations',
                            'desc'  => 'Our estates are carefully sited in fast-appreciating corridors across Lagos, Abuja, Ogun, Enugu and beyond.',
                            'color' => 'bg-purple-50 text-purple-600',
                        ],
                        [
                            'icon'  => 'support',
                            'title' => '24/7 Client Support',
                            'desc'  => 'Dedicated account managers, a transparent client portal and lifetime aftercare for every subscriber.',
                            'color' => 'bg-amber-50 text-amber-600',
                        ],
                    ];
                    @endphp

                    @foreach($features as $i => $feature)
                    <div class="flex gap-5 group" data-reveal style="transition-delay: {{ ($i + 1) * 100 + 200 }}ms">
                        <div class="flex-shrink-0 w-12 h-12 {{ $feature['color'] }} rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                            @if($feature['icon'] === 'shield')
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                            @elseif($feature['icon'] === 'cash')
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                            @elseif($feature['icon'] === 'location')
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            @else
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/>
                            </svg>
                            @endif
                        </div>
                        <div class="flex-1">
                            <h4 class="font-bold text-[#0A1628] text-base mb-1">{{ $feature['title'] }}</h4>
                            <p class="text-gray-500 text-sm leading-relaxed">{{ $feature['desc'] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>

                {{-- CTA --}}
                <div class="mt-10 flex flex-wrap gap-4">
                    <a href="{{ route('about') }}"
                       class="bg-[#0A1628] hover:bg-[#C9A84C] text-white hover:text-[#0A1628] font-bold px-8 py-4 rounded-full transition-all hover:scale-105 hover:shadow-lg">
                        Our Story
                    </a>
                    <a href="{{ route('properties.index') }}"
                       class="border-2 border-[#0A1628] text-[#0A1628] hover:border-[#C9A84C] hover:text-[#C9A84C] font-bold px-8 py-4 rounded-full transition-all">
                        Browse Estates
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
