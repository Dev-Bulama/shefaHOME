{{-- Single property category card – large image + full-width excerpt --}}
@php
    $isEven = ($loop->index ?? 0) % 2 === 0;

    // Plain-text excerpt (~240 chars)
    $plainText = trim(preg_replace('/\s+/', ' ', strip_tags($section['description'] ?? '')));
    $excerpt   = mb_strlen($plainText) > 240 ? mb_substr($plainText, 0, 240) . '…' : $plainText;

    // Image URL: admin-set or seed-based placeholder
    $img = $section['image'] ?? '';
    $imageUrl = $img
        ? (str_starts_with($img, 'http') || str_starts_with($img, '//')
            ? $img
            : asset('uploads/' . $img))
        : 'https://picsum.photos/seed/cat_' . $id . '/1200/700';
@endphp

<div class="group bg-white rounded-3xl overflow-hidden shadow-sm border border-gray-100 hover:shadow-xl transition-all duration-500" data-reveal>
    <div class="flex flex-col {{ $isEven ? 'lg:flex-row' : 'lg:flex-row-reverse' }}">

        {{-- ── Image panel ──────────────────────────────────────────── --}}
        <div class="relative overflow-hidden lg:w-1/2 category-img-panel">
            <img src="{{ $imageUrl }}"
                 alt="{{ $section['title'] }}"
                 class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                 loading="lazy"
                 onerror="this.src='https://picsum.photos/seed/cat_{{ $id }}/1200/700'">

            {{-- Subtle dark overlay --}}
            <div class="absolute inset-0 bg-black/20 pointer-events-none"></div>

            {{-- Category badge --}}
            <div class="absolute top-5 {{ $isEven ? 'left-5' : 'right-5' }} z-10">
                <span class="inline-flex items-center gap-1.5 bg-white/90 backdrop-blur-sm text-[#1A237E] text-xs font-bold px-3.5 py-1.5 rounded-full shadow-md">
                    <span class="text-base leading-none">{{ $section['icon'] ?? '🏠' }}</span>
                    <span>{{ $section['subtitle'] }}</span>
                </span>
            </div>
        </div>

        {{-- ── Content panel ────────────────────────────────────────── --}}
        <div class="lg:w-1/2 flex flex-col justify-center px-8 py-10 lg:px-16 lg:py-16">

            @if($section['subtitle'])
            <span class="inline-block text-[#27AE22] font-semibold text-xs tracking-widest uppercase mb-3">
                {{ $section['subtitle'] }}
            </span>
            @endif

            <h3 class="font-display text-3xl lg:text-4xl font-bold text-[#1A237E] leading-tight mb-5">
                {{ $section['title'] }}
            </h3>

            @if($excerpt)
            <p class="text-gray-500 text-lg leading-relaxed mb-8">
                {{ $excerpt }}
            </p>
            @endif

            @if($section['button_text'] && $section['button_url'])
            <div>
                <a href="{{ $section['button_url'] }}"
                   class="inline-flex items-center gap-2 bg-[#1A237E] hover:bg-[#27AE22] text-white hover:text-[#1A237E] font-semibold px-7 py-3.5 rounded-xl transition-all duration-300 hover:shadow-lg text-sm">
                    {{ $section['button_text'] }}
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>
            @endif

        </div>
    </div>
</div>

@once
<style>
    .category-img-panel { min-height: 320px; }
    @media (min-width: 1024px) { .category-img-panel { min-height: 500px; } }
</style>
@endonce
