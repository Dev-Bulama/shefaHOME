{{-- Single property type content card --}}
@php
    $isEven = ($loop->index ?? 0) % 2 === 0;
    $hasDescription = !empty($section['description']);
@endphp

<div class="bg-gray-50 rounded-3xl overflow-hidden shadow-sm border border-gray-100 hover:shadow-lg transition-shadow duration-300" data-reveal>
    <div class="p-8 lg:p-10">

        {{-- Header --}}
        <div class="flex items-start gap-4 mb-6">
            <div class="flex-shrink-0 w-14 h-14 bg-[#1A237E]/10 rounded-2xl flex items-center justify-center text-3xl">
                {{ $section['icon'] ?? '🏠' }}
            </div>
            <div>
                @if($section['subtitle'])
                <span class="inline-block text-[#27AE22] font-semibold text-xs tracking-widest uppercase mb-1">
                    {{ $section['subtitle'] }}
                </span>
                @endif
                <h3 class="font-display text-2xl lg:text-3xl font-bold text-[#1A237E]">
                    {{ $section['title'] }}
                </h3>
            </div>
        </div>

        {{-- Description / Content --}}
        @if($hasDescription)
        <div x-data="{ expanded: false }">
            {{-- Collapsed preview (first paragraph only) --}}
            <div x-show="!expanded" class="property-type-preview prose prose-sm max-w-none text-gray-600 leading-relaxed mb-4">
                @php
                    preg_match('/<p[^>]*>(.*?)<\/p>/si', $section['description'], $firstPara);
                    $preview = $firstPara[0] ?? strip_tags($section['description'], '<p>');
                @endphp
                {!! $preview !!}
            </div>

            {{-- Full content --}}
            <div x-show="expanded"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 class="property-type-content prose prose-sm max-w-none text-gray-600 leading-relaxed mb-4">
                {!! $section['description'] !!}
            </div>

            {{-- Read more / less toggle --}}
            <button @click="expanded = !expanded"
                    class="text-sm font-semibold text-[#27AE22] hover:text-[#1A237E] transition-colors flex items-center gap-1 mb-6">
                <span x-text="expanded ? 'Show Less' : 'Read More'"></span>
                <svg :class="expanded ? 'rotate-180' : ''" class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>
        </div>
        @endif

        {{-- CTA Button --}}
        @if($section['button_text'] && $section['button_url'])
        <a href="{{ $section['button_url'] }}"
           class="inline-flex items-center gap-2 bg-[#1A237E] hover:bg-[#27AE22] text-white hover:text-[#1A237E] font-semibold text-sm px-6 py-3 rounded-xl transition-all hover:shadow-md">
            {{ $section['button_text'] }}
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
            </svg>
        </a>
        @endif
    </div>
</div>

<style>
.property-type-content h3 { font-size: 1.05rem; font-weight: 700; color: #1A237E; margin-top: 1.25rem; margin-bottom: 0.5rem; }
.property-type-content ul { list-style-type: disc; padding-left: 1.5rem; margin-bottom: 0.75rem; }
.property-type-content li { margin-bottom: 0.25rem; }
.property-type-content p  { margin-bottom: 0.75rem; }
.property-type-preview p  { margin-bottom: 0; }
</style>
