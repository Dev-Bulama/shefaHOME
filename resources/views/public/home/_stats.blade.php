{{-- Stats Section --}}
<section class="py-20 bg-[#1A237E] relative overflow-hidden">
    {{-- Background decorative elements --}}
    <div class="absolute inset-0 opacity-5">
        <div class="absolute top-0 left-0 w-72 h-72 bg-[#27AE22] rounded-full -translate-x-1/2 -translate-y-1/2"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-[#27AE22] rounded-full translate-x-1/3 translate-y-1/3"></div>
    </div>
    <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width=\"60\" height=\"60\" viewBox=\"0 0 60 60\" xmlns=\"http://www.w3.org/2000/svg\"%3E%3Cg fill=\"none\" fill-rule=\"evenodd\"%3E%3Cg fill=\"%23C9A84C\" fill-opacity=\"0.04\"%3E%3Cpath d=\"M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')]"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

        {{-- Section header --}}
        <div class="text-center mb-14">
            <span class="inline-block text-[#27AE22] font-semibold text-sm tracking-widest uppercase mb-3">Our Track Record</span>
            <h2 class="font-display text-4xl md:text-5xl font-bold text-white mb-4">
                Numbers That <span class="text-[#27AE22]">Speak</span>
            </h2>
            <p class="text-gray-400 text-lg max-w-xl mx-auto">A legacy of excellence built on trust, transparency and transforming lives through premium real estate.</p>
        </div>

        {{-- Stats Grid --}}
        <div data-counter-section class="grid grid-cols-2 lg:grid-cols-4 gap-8 lg:gap-12">

            @php
                $defaultStats = [
                    ['value' => 5000, 'suffix' => '+', 'label' => 'Happy Clients', 'icon' => 'users'],
                    ['value' => 50,   'suffix' => '+', 'label' => 'Premium Estates', 'icon' => 'building'],
                    ['value' => 15,   'suffix' => '+', 'label' => 'States Covered', 'icon' => 'map'],
                    ['value' => 10,   'suffix' => '+', 'label' => 'Years Experience', 'icon' => 'calendar'],
                ];
                $statsData = $stats ?? $defaultStats;
            @endphp

            @foreach($statsData as $index => $stat)
            <div class="text-center group" data-reveal style="transition-delay: {{ $index * 150 }}ms">
                {{-- Icon --}}
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-white/10 group-hover:bg-[#27AE22]/20 border border-white/10 group-hover:border-[#27AE22]/30 transition-all duration-300 mb-6 mx-auto">
                    @php $iconKey = is_array($stat) ? ($stat['icon'] ?? 'star') : ($stat->icon ?? 'star'); @endphp
                    @if($iconKey === 'users')
                    <svg class="w-7 h-7 text-[#27AE22]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    @elseif($iconKey === 'building')
                    <svg class="w-7 h-7 text-[#27AE22]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                    @elseif($iconKey === 'map')
                    <svg class="w-7 h-7 text-[#27AE22]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                    </svg>
                    @elseif($iconKey === 'calendar')
                    <svg class="w-7 h-7 text-[#27AE22]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    @elseif($iconKey === 'award')
                    <svg class="w-7 h-7 text-[#27AE22]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                    </svg>
                    @else
                    <svg class="w-7 h-7 text-[#27AE22]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                    </svg>
                    @endif
                </div>

                {{-- Counter --}}
                <div class="mb-2">
                    <span class="font-display text-5xl lg:text-6xl font-bold text-[#27AE22]"
                          data-count="{{ is_array($stat) ? ($stat['value'] ?? 0) : ($stat->value ?? 0) }}">0</span>
                    <span class="font-display text-4xl font-bold text-[#27AE22]">{{ is_array($stat) ? ($stat['suffix'] ?? '+') : ($stat->suffix ?? '+') }}</span>
                </div>

                {{-- Label --}}
                <p class="text-gray-300 text-base font-medium uppercase tracking-wider">
                    {{ is_array($stat) ? ($stat['label'] ?? '') : ($stat->label ?? '') }}
                </p>

                {{-- Decorative line --}}
                <div class="mt-4 h-0.5 w-12 bg-[#27AE22]/30 mx-auto group-hover:w-24 group-hover:bg-[#27AE22]/60 transition-all duration-500"></div>
            </div>
            @endforeach
        </div>

        {{-- Bottom CTA --}}
        <div class="text-center mt-16 pt-12 border-t border-white/10">
            <p class="text-gray-400 mb-6 text-lg">Join thousands of Nigerians who trust SHEFAHOMES with their real estate investments.</p>
            <a href="{{ route('properties.index') }}"
               class="inline-flex items-center gap-2 bg-[#27AE22] hover:bg-[#4ADE80] text-[#1A237E] font-bold px-10 py-4 rounded-full transition-all hover:scale-105 hover:shadow-xl hover:shadow-[#27AE22]/30">
                Start Your Journey
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>
    </div>
</section>
<script>
(function(){
    var el = document.querySelector('[data-counter-section]');
    if(!el) return;
    var done = false;
    var obs = new IntersectionObserver(function(entries){
        if(entries[0].isIntersecting && !done){
            done = true;
            el.querySelectorAll('[data-count]').forEach(function(counter){
                var target = parseInt(counter.dataset.count);
                var duration = 2000;
                var step = target / (duration / 16);
                var current = 0;
                var timer = setInterval(function(){
                    current += step;
                    if(current >= target){ current = target; clearInterval(timer); }
                    counter.textContent = Math.floor(current).toLocaleString();
                }, 16);
            });
        }
    }, { threshold: 0.3 });
    obs.observe(el);
})();
</script>
