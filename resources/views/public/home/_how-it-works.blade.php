{{-- How It Works --}}
<section class="py-20 bg-gray-50 overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Section Header --}}
        <div class="text-center mb-16" data-reveal>
            <span class="inline-block text-[#27AE22] font-semibold text-sm tracking-widest uppercase mb-3">Simple Process</span>
            <h2 class="font-display text-4xl md:text-5xl font-bold text-[#1A237E] mb-4">
                How It <span class="text-[#27AE22]">Works</span>
            </h2>
            <p class="text-gray-500 text-lg max-w-2xl mx-auto">
                Owning a piece of Nigeria's most promising real estate is simpler than you think. Follow these four easy steps.
            </p>
        </div>

        {{-- Steps --}}
        @php
        $steps = [
            [
                'number' => '01',
                'icon'   => 'search',
                'title'  => 'Browse & Choose',
                'desc'   => 'Explore our curated portfolio of premium estates online or visit our showrooms. Filter by location, budget and property type.',
            ],
            [
                'number' => '02',
                'icon'   => 'consult',
                'title'  => 'Consult Our Experts',
                'desc'   => 'Book a free consultation with our certified property advisors. Get honest guidance, site visits and a personalised investment plan.',
            ],
            [
                'number' => '03',
                'icon'   => 'sign',
                'title'  => 'Subscribe & Pay',
                'desc'   => 'Complete your Deed of Subscription, make your initial deposit and choose a payment plan that fits your cash flow.',
            ],
            [
                'number' => '04',
                'icon'   => 'key',
                'title'  => 'Receive Your Title',
                'desc'   => 'On final payment receive your government-approved title deed. Your land is yours — forever documented and legally secured.',
            ],
        ];
        @endphp

        {{-- Desktop: horizontal flow --}}
        <div class="hidden lg:grid lg:grid-cols-4 gap-0 relative">
            {{-- Connecting line --}}
            <div class="absolute top-16 left-[12.5%] right-[12.5%] h-0.5 bg-gradient-to-r from-[#27AE22]/20 via-[#27AE22] to-[#27AE22]/20" style="z-index:0"></div>

            @foreach($steps as $i => $step)
            <div class="relative flex flex-col items-center text-center px-6" data-reveal style="transition-delay: {{ $i * 150 }}ms">
                {{-- Number circle --}}
                <div class="relative z-10 w-16 h-16 rounded-full bg-[#27AE22] text-[#1A237E] font-display font-black text-lg flex items-center justify-center shadow-lg shadow-[#27AE22]/30 mb-6 ring-4 ring-white">
                    {{ $step['number'] }}
                </div>

                {{-- Icon box --}}
                <div class="w-14 h-14 rounded-2xl bg-white shadow-md border border-gray-100 flex items-center justify-center mb-5">
                    @if($step['icon'] === 'search')
                    <svg class="w-7 h-7 text-[#1A237E]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    @elseif($step['icon'] === 'consult')
                    <svg class="w-7 h-7 text-[#1A237E]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"/>
                    </svg>
                    @elseif($step['icon'] === 'sign')
                    <svg class="w-7 h-7 text-[#1A237E]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    @else
                    <svg class="w-7 h-7 text-[#1A237E]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
                    </svg>
                    @endif
                </div>

                <h3 class="font-display font-bold text-[#1A237E] text-lg mb-3">{{ $step['title'] }}</h3>
                <p class="text-gray-500 text-sm leading-relaxed">{{ $step['desc'] }}</p>
            </div>
            @endforeach
        </div>

        {{-- Mobile: vertical stacked --}}
        <div class="lg:hidden space-y-0">
            @foreach($steps as $i => $step)
            <div class="flex gap-6 relative" data-reveal style="transition-delay: {{ $i * 100 }}ms">
                {{-- Left: number + line --}}
                <div class="flex flex-col items-center flex-shrink-0">
                    <div class="w-12 h-12 rounded-full bg-[#27AE22] text-[#1A237E] font-display font-black text-base flex items-center justify-center shadow-md z-10">
                        {{ $step['number'] }}
                    </div>
                    @if(!$loop->last)
                    <div class="w-0.5 flex-1 bg-[#27AE22]/30 my-2 min-h-[40px]"></div>
                    @endif
                </div>

                {{-- Right: content --}}
                <div class="pb-8 flex-1">
                    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
                        <h3 class="font-display font-bold text-[#1A237E] text-lg mb-2">{{ $step['title'] }}</h3>
                        <p class="text-gray-500 text-sm leading-relaxed">{{ $step['desc'] }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Bottom CTA --}}
        <div class="text-center mt-14" data-reveal>
            <a href="{{ route('properties.index') }}"
               class="inline-flex items-center gap-2 bg-[#1A237E] hover:bg-[#27AE22] text-white hover:text-[#1A237E] font-bold px-10 py-4 rounded-full transition-all hover:scale-105 shadow-lg">
                Get Started Today
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>
    </div>
</section>
