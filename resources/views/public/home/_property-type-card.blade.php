{{-- Single property category card – image + excerpt + read-more modal --}}
@php
    $isEven  = ($loop->index ?? 0) % 2 === 0;
    $hasDesc = !empty($section['description']) && trim(strip_tags($section['description'])) !== '';

    $stripped  = preg_replace('/<(style|script)[^>]*>.*?<\/\1>/is', '', $section['description'] ?? '');
    $plainText = trim(preg_replace('/\s+/', ' ', strip_tags($stripped)));
    $excerpt   = mb_strlen($plainText) > 240 ? mb_substr($plainText, 0, 240) . '…' : $plainText;

    $img      = $section['image'] ?? '';
    $imageUrl = $img
        ? (str_starts_with($img, 'http') || str_starts_with($img, '//')
            ? $img
            : asset('uploads/' . $img))
        : 'https://picsum.photos/seed/cat_' . $id . '/1200/700';
@endphp

{{-- x-init $watch keeps body-scroll in sync without getting stuck --}}
<div x-data="{ open: false }"
     x-init="$watch('open', val => document.body.style.overflow = val ? 'hidden' : '')"
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
            <p class="text-gray-500 text-lg leading-relaxed mb-6">{{ $excerpt }}</p>
            @endif

            <div class="flex flex-wrap items-center gap-4">

                @if($hasDesc)
                <button @click="open = true"
                        class="inline-flex items-center gap-1.5 text-[#27AE22] hover:text-[#1A237E] font-semibold text-sm transition-colors">
                    Read More
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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

    {{-- ── Modal – teleported to <body> so it escapes overflow-hidden ── --}}
    @if($hasDesc)
    <template x-teleport="body">
        {{-- Backdrop --}}
        <div x-show="open"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             @click.self="open = false"
             @keydown.escape.window="open = false"
             class="fixed inset-0 z-50 flex items-end sm:items-center justify-center sm:p-6 bg-black/60 backdrop-blur-sm"
             style="display:none;">

            {{-- Panel --}}
            <div x-show="open"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-6 sm:translate-y-0 sm:scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave-end="opacity-0 translate-y-6 sm:translate-y-0 sm:scale-95"
                 @click.stop
                 class="bg-white w-full sm:max-w-2xl rounded-t-2xl sm:rounded-2xl shadow-2xl flex flex-col"
                 style="max-height:88vh;">

                {{-- Header --}}
                <div class="flex-shrink-0 flex items-center justify-between gap-4 px-6 py-4 border-b border-gray-100">
                    <div class="flex items-center gap-3 min-w-0">
                        <span class="text-3xl flex-shrink-0 leading-none">{{ $section['icon'] ?? '🏠' }}</span>
                        <div class="min-w-0">
                            <p class="text-[#27AE22] text-xs font-bold uppercase tracking-widest leading-none mb-1">{{ $section['subtitle'] }}</p>
                            <h4 class="font-bold text-[#1A237E] text-lg leading-snug truncate">{{ $section['title'] }}</h4>
                        </div>
                    </div>
                    <button @click="open = false"
                            class="flex-shrink-0 w-9 h-9 flex items-center justify-center rounded-full bg-gray-100 hover:bg-red-50 text-gray-400 hover:text-red-500 transition-colors">
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
                <div class="flex-shrink-0 flex items-center justify-between gap-4 px-6 py-4 border-t border-gray-100 bg-gray-50 rounded-b-2xl">
                    <p class="text-sm text-gray-400 hidden sm:block">Ready to get started?</p>
                    <a href="{{ $section['button_url'] }}"
                       class="inline-flex items-center gap-2 bg-[#1A237E] hover:bg-[#27AE22] text-white hover:text-[#1A237E] font-semibold px-6 py-2.5 rounded-xl transition-all text-sm w-full sm:w-auto justify-center">
                        {{ $section['button_text'] }}
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                </div>
                @endif

            </div>
        </div>
    </template>
    @endif

</div>

@once
<style>
    /* Image panel height */
    .category-img-panel { min-height: 320px; }
    @media (min-width: 1024px) { .category-img-panel { min-height: 500px; } }

    /* ── Modal content: auto-format any HTML/CSS the admin writes ─── */
    .cat-modal-body {
        font-size: 0.9375rem;
        line-height: 1.8;
        color: #374151;
    }

    /* Headings */
    .cat-modal-body h1,
    .cat-modal-body h2,
    .cat-modal-body h3 {
        font-weight: 700;
        color: #1A237E;
        margin-top: 1.6rem;
        margin-bottom: 0.5rem;
        padding-bottom: 0.35rem;
        border-bottom: 2px solid rgba(39,174,34,0.2);
        line-height: 1.35;
    }
    .cat-modal-body h1 { font-size: 1.2rem; }
    .cat-modal-body h2 { font-size: 1.1rem; }
    .cat-modal-body h3 { font-size: 1rem; }
    .cat-modal-body h4,
    .cat-modal-body h5 {
        font-weight: 600;
        color: #1e3a8a;
        margin-top: 1.25rem;
        margin-bottom: 0.35rem;
        font-size: 0.95rem;
    }
    .cat-modal-body h1:first-child,
    .cat-modal-body h2:first-child,
    .cat-modal-body h3:first-child { margin-top: 0; }

    /* Paragraphs */
    .cat-modal-body p {
        margin-bottom: 0.9rem;
        color: #4b5563;
    }
    .cat-modal-body p:last-child { margin-bottom: 0; }

    /* Unordered lists – green dot bullets */
    .cat-modal-body ul {
        list-style: none;
        padding: 0;
        margin: 0 0 1rem;
    }
    .cat-modal-body ul li {
        display: flex;
        align-items: flex-start;
        gap: 0.65rem;
        padding: 0.28rem 0;
        color: #374151;
    }
    .cat-modal-body ul li::before {
        content: '';
        flex-shrink: 0;
        width: 7px;
        height: 7px;
        border-radius: 50%;
        background: #27AE22;
        margin-top: 0.52rem;
    }

    /* Ordered lists */
    .cat-modal-body ol {
        list-style: none;
        counter-reset: cat-counter;
        padding: 0;
        margin: 0 0 1rem;
    }
    .cat-modal-body ol li {
        display: flex;
        align-items: flex-start;
        gap: 0.65rem;
        padding: 0.28rem 0;
        color: #374151;
        counter-increment: cat-counter;
    }
    .cat-modal-body ol li::before {
        content: counter(cat-counter) '.';
        flex-shrink: 0;
        font-weight: 700;
        color: #27AE22;
        min-width: 1.5rem;
    }

    /* Blockquote */
    .cat-modal-body blockquote {
        border-left: 3px solid #27AE22;
        padding: 0.5rem 1rem;
        margin: 1rem 0;
        background: rgba(39,174,34,0.05);
        border-radius: 0 0.5rem 0.5rem 0;
        color: #6b7280;
        font-style: italic;
    }

    /* Inline */
    .cat-modal-body strong,
    .cat-modal-body b { color: #1A237E; font-weight: 600; }
    .cat-modal-body em,
    .cat-modal-body i { font-style: italic; }
    .cat-modal-body a { color: #27AE22; text-decoration: underline; }
    .cat-modal-body a:hover { color: #1A237E; }
    .cat-modal-body code {
        background: #f3f4f6;
        padding: 0.1rem 0.35rem;
        border-radius: 0.25rem;
        font-family: monospace;
        font-size: 0.85em;
    }

    /* Tables */
    .cat-modal-body table {
        width: 100%;
        border-collapse: collapse;
        margin: 1rem 0;
        font-size: 0.875rem;
    }
    .cat-modal-body th {
        background: #1A237E;
        color: #fff;
        font-weight: 600;
        padding: 0.5rem 0.75rem;
        text-align: left;
    }
    .cat-modal-body td {
        padding: 0.45rem 0.75rem;
        border-bottom: 1px solid #e5e7eb;
        color: #374151;
    }
    .cat-modal-body tr:nth-child(even) td { background: #f9fafb; }

    /* Divider */
    .cat-modal-body hr {
        border: none;
        border-top: 2px solid rgba(39,174,34,0.2);
        margin: 1.5rem 0;
    }

    /* Inline styles from admin take precedence – no !important here */
</style>
@endonce
