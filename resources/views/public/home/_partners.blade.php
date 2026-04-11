{{-- Partners & Awards --}}
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Section Header --}}
        <div class="text-center mb-14" data-reveal>
            <span class="inline-block text-[#C9A84C] font-semibold text-sm tracking-widest uppercase mb-3">Trust & Credibility</span>
            <h2 class="font-display text-4xl md:text-5xl font-bold text-[#0A1628] mb-4">
                Trusted Partners &amp; <span class="text-[#C9A84C]">Recognitions</span>
            </h2>
            <p class="text-gray-500 text-lg max-w-xl mx-auto">
                Endorsed by Nigeria's leading institutions and recognised for excellence in real estate development.
            </p>
        </div>

        {{-- Partners Marquee --}}
        @if(isset($partners) && $partners->count())
        <div class="mb-16">
            <p class="text-center text-xs font-semibold text-gray-400 uppercase tracking-widest mb-8">Our Partners</p>
            <div class="relative overflow-hidden" style="mask-image: linear-gradient(to right, transparent, black 10%, black 90%, transparent);">
                <div class="flex gap-12 animate-marquee whitespace-nowrap"
                     style="animation: marquee 30s linear infinite;">
                    @foreach($partners as $partner)
                    <div class="flex-shrink-0 flex items-center justify-center h-16 grayscale hover:grayscale-0 opacity-60 hover:opacity-100 transition-all duration-300">
                        @if($partner->logo_url)
                        <img src="{{ $partner->logo_url }}"
                             alt="{{ $partner->name }}"
                             class="h-10 max-w-[140px] object-contain"
                             loading="lazy">
                        @else
                        <span class="text-gray-400 font-bold text-sm px-6 py-3 border border-gray-200 rounded-xl">{{ $partner->name }}</span>
                        @endif
                    </div>
                    @endforeach
                    {{-- Duplicate for seamless loop --}}
                    @foreach($partners as $partner)
                    <div class="flex-shrink-0 flex items-center justify-center h-16 grayscale hover:grayscale-0 opacity-60 hover:opacity-100 transition-all duration-300">
                        @if($partner->logo_url)
                        <img src="{{ $partner->logo_url }}"
                             alt="{{ $partner->name }}"
                             class="h-10 max-w-[140px] object-contain"
                             loading="lazy">
                        @else
                        <span class="text-gray-400 font-bold text-sm px-6 py-3 border border-gray-200 rounded-xl">{{ $partner->name }}</span>
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @else
        {{-- Placeholder logos --}}
        <div class="mb-16">
            <p class="text-center text-xs font-semibold text-gray-400 uppercase tracking-widest mb-8">Our Partners</p>
            <div class="relative overflow-hidden" style="mask-image: linear-gradient(to right, transparent, black 10%, black 90%, transparent);">
                <div class="flex gap-12 items-center" style="animation: marquee 25s linear infinite; display: flex;">
                    @foreach(['LASRERA', 'FCDA', 'NHF', 'PENCOM', 'Sterling Bank', 'UBA', 'Access Bank', 'NNPC', 'NAFDAC', 'CBN'] as $p)
                    <div class="flex-shrink-0 px-6 py-3 border border-gray-200 rounded-xl text-gray-400 font-bold text-sm whitespace-nowrap grayscale hover:grayscale-0 opacity-60 hover:opacity-100 transition-all">
                        {{ $p }}
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif

        {{-- Divider --}}
        <div class="flex items-center gap-4 mb-12">
            <div class="flex-1 h-px bg-gray-200"></div>
            <div class="flex items-center gap-2">
                <div class="w-2 h-2 rounded-full bg-[#C9A84C]"></div>
                <span class="text-xs font-semibold text-gray-400 uppercase tracking-widest">Awards & Recognition</span>
                <div class="w-2 h-2 rounded-full bg-[#C9A84C]"></div>
            </div>
            <div class="flex-1 h-px bg-gray-200"></div>
        </div>

        {{-- Awards Grid --}}
        @if(isset($awards) && $awards->count())
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($awards as $i => $award)
            <div class="bg-white rounded-2xl p-6 text-center shadow-sm border border-gray-100 hover:shadow-md hover:border-[#C9A84C]/30 transition-all hover:-translate-y-1 group"
                 data-reveal style="transition-delay: {{ $i * 100 }}ms">
                @if($award->icon_url)
                <img src="{{ $award->icon_url }}" alt="{{ $award->title }}" class="w-16 h-16 object-contain mx-auto mb-4">
                @else
                <div class="w-14 h-14 mx-auto mb-4 bg-gradient-to-br from-[#C9A84C]/20 to-[#C9A84C]/10 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform">
                    <svg class="w-7 h-7 text-[#C9A84C]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                    </svg>
                </div>
                @endif
                <h4 class="font-bold text-[#0A1628] text-sm mb-1 leading-snug">{{ $award->title }}</h4>
                @if($award->year)
                <p class="text-[#C9A84C] text-xs font-semibold">{{ $award->year }}</p>
                @endif
                @if($award->organization)
                <p class="text-gray-400 text-xs mt-1">{{ $award->organization }}</p>
                @endif
            </div>
            @endforeach
        </div>
        @else
        {{-- Placeholder awards --}}
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach([
                ['title' => 'Best Real Estate Developer', 'year' => '2023', 'org' => 'PropertyNG Awards'],
                ['title' => 'Customer Excellence Award', 'year' => '2022', 'org' => 'REAN Conference'],
                ['title' => 'Most Innovative Developer', 'year' => '2022', 'org' => 'Lagos Business Awards'],
                ['title' => 'Top 10 Fastest-Growing', 'year' => '2021', 'org' => 'BusinessDay Nigeria'],
            ] as $i => $award)
            <div class="bg-white rounded-2xl p-6 text-center shadow-sm border border-gray-100 hover:shadow-md hover:border-[#C9A84C]/30 transition-all hover:-translate-y-1 group"
                 data-reveal style="transition-delay: {{ $i * 100 }}ms">
                <div class="w-14 h-14 mx-auto mb-4 bg-gradient-to-br from-[#C9A84C]/20 to-[#C9A84C]/10 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform">
                    <svg class="w-7 h-7 text-[#C9A84C]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                    </svg>
                </div>
                <h4 class="font-bold text-[#0A1628] text-sm mb-1 leading-snug">{{ $award['title'] }}</h4>
                <p class="text-[#C9A84C] text-xs font-semibold">{{ $award['year'] }}</p>
                <p class="text-gray-400 text-xs mt-1">{{ $award['org'] }}</p>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</section>

<style>
@keyframes marquee {
    0% { transform: translateX(0); }
    100% { transform: translateX(-50%); }
}
.animate-marquee {
    animation: marquee 30s linear infinite;
}
</style>
