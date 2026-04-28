{{-- Single property category card – image + excerpt + read-more modal --}}
@php
    $isEven  = ($loop->index ?? 0) % 2 === 0;
    $hasDesc = !empty($section['description']) && trim(strip_tags($section['description'])) !== '';

    // Plain-text excerpt (~240 chars, stops at word boundary)
    $plainText = trim(preg_replace('/\s+/', ' ', strip_tags($section['description'] ?? '')));
    $excerpt   = mb_strlen($plainText) > 240 ? mb_substr($plainText, 0, 240) . '…' : $plainText;

    // Image URL: admin-set or seed-based placeholder
    $img      = $section['image'] ?? '';
    $imageUrl = $img
        ? (str_starts_with($img, 'http') || str_starts_with($img, '//')
            ? $img
            : asset('uploads/' . $img))
        : 'https://picsum.photos/seed/cat_' . $id . '/1200/700';

    $modalId = 'cat-modal-' . $id;
@endphp

{{-- Card --}}
<div x-data="{ open: false }"
     x-effect="document.body.style.overflow = open ? 'hidden' : ''"
     class="group bg-white rounded-3xl overflow-hidden shadow-sm border border-gray-100 hover:shadow-xl transition-all duration-500"
     data-reveal>

    <div class="flex flex-col {{ $isEven ? 'lg:flex-row' : 'lg:flex-row-reverse' }}">

        {{-- ── Image panel ──────────────────────────────────────────── --}}
        <div class="relative overflow-hidden lg:w-1/2 category-img-panel">
            <img src="{{ $imageUrl }}"
                 alt="{{ $section['title'] }}"
                 class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                 loading="lazy"
                 onerror="this.src='https://picsum.photos/seed/cat_{{ $id }}/1200/700'">

            <div class="absolute inset-0 bg-black/20 pointer-events-none"></div>

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
            <p class="text-gray-500 text-lg leading-relaxed mb-6">
                {{ $excerpt }}
            </p>
            @endif

            <div class="flex flex-wrap items-center gap-4">

                @if($hasDesc)
                <button @click="open = true"
                        class="inline-flex items-center gap-1.5 text-[#27AE22] hover:text-[#1A237E] font-semibold text-sm transition-colors group/rm">
                    Read More
                    <svg class="w-4 h-4 transition-transform group-hover/rm:translate-y-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                @endif

                @if($section['button_text'] && $section['button_url'])
                <a href="{{ $section['button_url'] }}"
                   class="inline-flex items-center gap-2 bg-[#1A237E] hover:bg-[#27AE22] text-white hover:text-[#1A237E] font-semibold px-7 py-3 rounded-xl transition-all duration-300 hover:shadow-lg text-sm">
                    {{ $section['button_text'] }}
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
                @endif

            </div>
        </div>
    </div>

    {{-- ── Modal ──────────────────────────────────────────────────── --}}
    @if($hasDesc)
    <div x-show="open"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @click.self="open = false"
         @keydown.escape.window="open = false"
         class="fixed inset-0 z-[200] flex items-center justify-center p-4 sm:p-8 bg-black/60 backdrop-blur-sm"
         style="display:none;">

        <div x-show="open"
             x-transition:enter="transition ease-out duration-250"
             x-transition:enter-start="opacity-0 scale-95 translate-y-4"
             x-transition:enter-end="opacity-100 scale-100 translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 scale-100 translate-y-0"
             x-transition:leave-end="opacity-0 scale-95 translate-y-4"
             @click.stop
             class="relative bg-white rounded-2xl shadow-2xl w-full max-w-2xl max-h-[88vh] flex flex-col">

            {{-- Header --}}
            <div class="flex-shrink-0 flex items-center justify-between gap-4 px-6 py-5 border-b border-gray-100">
                <div class="flex items-center gap-3 min-w-0">
                    <span class="text-3xl flex-shrink-0">{{ $section['icon'] ?? '🏠' }}</span>
                    <div class="min-w-0">
                        <p class="text-[#27AE22] text-xs font-bold uppercase tracking-widest mb-0.5">{{ $section['subtitle'] }}</p>
                        <h4 class="font-display text-lg font-bold text-[#1A237E] leading-snug truncate">{{ $section['title'] }}</h4>
                    </div>
                </div>
                <button @click="open = false"
                        class="flex-shrink-0 w-9 h-9 flex items-center justify-center rounded-full bg-gray-100 hover:bg-red-50 hover:text-red-500 text-gray-400 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            {{-- Scrollable description --}}
            <div class="flex-1 overflow-y-auto px-6 py-6 cat-modal-body">
                {!! $section['description'] !!}
            </div>

            {{-- Footer CTA --}}
            @if($section['button_text'] && $section['button_url'])
            <div class="flex-shrink-0 px-6 py-4 border-t border-gray-100 bg-gray-50 rounded-b-2xl flex items-center justify-between gap-4">
                <p class="text-sm text-gray-400">Ready to get started?</p>
                <a href="{{ $section['button_url'] }}"
                   class="inline-flex items-center gap-2 bg-[#1A237E] hover:bg-[#27AE22] text-white hover:text-[#1A237E] font-semibold px-6 py-2.5 rounded-xl transition-all text-sm flex-shrink-0">
                    {{ $section['button_text'] }}
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>
            @endif

        </div>
    </div>
    @endif
</div>

@once
<style>
    /* Image panel height */
    .category-img-panel { min-height: 320px; }
    @media (min-width: 1024px) { .category-img-panel { min-height: 500px; } }

    /* ── Modal content auto-formatting ───────────────────────── */
    .cat-modal-body { font-size: 0.95rem; color: #374151; line-height: 1.75; }

    /* Paragraphs */
    .cat-modal-body p { margin-bottom: 0.9rem; color: #4b5563; }
    .cat-modal-body p:last-child { margin-bottom: 0; }

    /* Section headings */
    .cat-modal-body h3,
    .cat-modal-body h2 {
        font-size: 1rem;
        font-weight: 700;
        color: #1A237E;
        margin-top: 1.75rem;
        margin-bottom: 0.5rem;
        padding-bottom: 0.4rem;
        border-bottom: 2px solid rgba(39,174,34,0.2);
        letter-spacing: -0.01em;
    }
    .cat-modal-body h3:first-child,
    .cat-modal-body h2:first-child { margin-top: 0; }

    .cat-modal-body h4 {
        font-size: 0.95rem;
        font-weight: 600;
        color: #1e3a8a;
        margin-top: 1.25rem;
        margin-bottom: 0.4rem;
    }

    /* Lists – replace default bullets with green dots */
    .cat-modal-body ul,
    .cat-modal-body ol { list-style: none; padding: 0; margin: 0 0 1rem; }

    .cat-modal-body ul li,
    .cat-modal-body ol li {
        display: flex;
        align-items: flex-start;
        gap: 0.65rem;
        padding: 0.3rem 0;
        color: #374151;
    }
    .cat-modal-body ul li::before {
        content: '';
        display: inline-block;
        width: 7px;
        height: 7px;
        min-width: 7px;
        border-radius: 50%;
        background: #27AE22;
        margin-top: 0.48rem;
    }
    .cat-modal-body ol { counter-reset: item; }
    .cat-modal-body ol li::before {
        content: counter(item) '.';
        counter-increment: item;
        font-weight: 700;
        color: #27AE22;
        min-width: 1.4rem;
        flex-shrink: 0;
        margin-top: 0;
        background: none;
        border-radius: 0;
        width: auto;
        height: auto;
    }

    /* Inline elements */
    .cat-modal-body strong { color: #1A237E; font-weight: 600; }
    .cat-modal-body em { font-style: italic; }
    .cat-modal-body a { color: #27AE22; text-decoration: underline; }
    .cat-modal-body a:hover { color: #1A237E; }
</style>
@endonce
