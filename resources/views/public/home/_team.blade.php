@if($featuredTeam->isNotEmpty())
{{-- Team Section --}}
<section class="py-20 bg-white overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 mb-14" data-reveal>
            <div>
                <span class="inline-block text-[#27AE22] font-semibold text-sm tracking-widest uppercase mb-3">Our People</span>
                <h2 class="font-display text-4xl md:text-5xl font-bold text-[#1A237E]">Meet the Team</h2>
                <p class="text-gray-500 mt-3 max-w-xl">The passionate professionals who turn vision into reality — one estate at a time.</p>
            </div>
            <a href="{{ route('team') }}" class="inline-flex items-center gap-2 text-[#1A237E] font-semibold text-sm hover:text-[#27AE22] transition-colors flex-shrink-0">
                View Full Team
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-6">
            @foreach($featuredTeam as $i => $member)
            <div class="group text-center" data-reveal style="transition-delay: {{ $i * 80 }}ms">
                <a href="{{ route('team') }}" class="block">
                    <div class="relative w-full pb-[100%] rounded-2xl overflow-hidden mb-3 bg-gray-100 shadow-sm group-hover:shadow-lg transition-all">
                        <img src="{{ $member->photo_url }}"
                             alt="{{ $member->name }}"
                             class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-[#1A237E]/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </div>
                    <h4 class="font-bold text-[#1A237E] text-sm group-hover:text-[#27AE22] transition-colors leading-tight">{{ $member->name }}</h4>
                    <p class="text-gray-400 text-xs mt-0.5">{{ $member->position }}</p>
                </a>
            </div>
            @endforeach
        </div>

    </div>
</section>
@endif
