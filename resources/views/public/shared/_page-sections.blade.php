{{--
  Shared dynamic content sections for any page.
  Usage: @include('public.shared._page-sections', ['pageSlug' => 'about'])
  Admin edits via: Admin → Pages → [page name]
--}}
@php use App\Helpers\PageContent as PC; @endphp

@foreach(['section_1','section_2','section_3','section_4'] as $sKey)
@php
    $visible = PC::get($pageSlug, $sKey.'.visible', '0');
    if ($visible !== '1') continue;

    $title       = PC::get($pageSlug, $sKey.'.title',       '');
    $subtitle    = PC::get($pageSlug, $sKey.'.subtitle',    '');
    $description = PC::get($pageSlug, $sKey.'.description', '');
    $image       = PC::get($pageSlug, $sKey.'.image',       '');
    $imgSide     = PC::get($pageSlug, $sKey.'.image_side',  'right');
    $btnText     = PC::get($pageSlug, $sKey.'.button_text', '');
    $btnUrl      = PC::get($pageSlug, $sKey.'.button_url',  '/contact');
    $bg          = PC::get($pageSlug, $sKey.'.bg',          'white');

    $sectionBg = match($bg) { 'gray' => 'bg-gray-50', 'navy' => 'bg-[#1A237E]', default => 'bg-white' };
    $isNavy    = $bg === 'navy';
    $headColor = $isNavy ? 'text-white' : 'text-[#1A237E]';
    $textColor = $isNavy ? 'text-gray-300' : 'text-gray-500';
    $reverse   = $imgSide === 'left';
@endphp

@if($title)
<section class="py-20 {{ $sectionBg }} overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20 items-center">

            {{-- Image --}}
            <div class="{{ $reverse ? 'lg:order-first' : 'lg:order-last' }}" data-reveal="{{ $reverse ? 'left' : 'right' }}">
                @if($image)
                <div class="relative rounded-3xl overflow-hidden shadow-2xl {{ $isNavy ? 'shadow-black/30' : 'shadow-[#1A237E]/15' }}">
                    <img src="{{ $image }}" alt="{{ $title }}" class="w-full h-[420px] object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                </div>
                @else
                <div class="rounded-3xl overflow-hidden bg-gradient-to-br {{ $isNavy ? 'from-white/10 to-[#27AE22]/10' : 'from-[#1A237E]/8 to-[#27AE22]/8' }} h-[360px] flex items-center justify-center border-2 border-dashed {{ $isNavy ? 'border-white/20' : 'border-[#1A237E]/15' }}">
                    <div class="text-center">
                        <svg class="w-12 h-12 {{ $isNavy ? 'text-white/30' : 'text-gray-300' }} mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <p class="{{ $isNavy ? 'text-white/40' : 'text-gray-400' }} text-xs">Add image via Admin → Pages</p>
                    </div>
                </div>
                @endif
            </div>

            {{-- Text --}}
            <div class="{{ $reverse ? 'lg:order-last' : 'lg:order-first' }}" data-reveal="{{ $reverse ? 'right' : 'left' }}">
                @if($subtitle)
                <span class="inline-block text-[#27AE22] font-semibold text-sm tracking-widest uppercase mb-3">{{ $subtitle }}</span>
                @endif
                <h2 class="font-display text-4xl md:text-5xl font-bold {{ $headColor }} mb-5 leading-tight">{{ $title }}</h2>
                @if($description)
                <div class="{{ $textColor }} text-base leading-relaxed mb-8 space-y-3">
                    @foreach(explode("\n", $description) as $para)
                        @if(trim($para))<p>{{ trim($para) }}</p>@endif
                    @endforeach
                </div>
                @endif
                @if($btnText)
                <a href="{{ $btnUrl }}"
                   class="inline-flex items-center gap-2 {{ $isNavy ? 'bg-[#27AE22] text-[#1A237E]' : 'bg-[#1A237E] text-white' }} font-bold px-8 py-4 rounded-full hover:opacity-90 transition-all hover:scale-105 shadow-lg">
                    {{ $btnText }}
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
                @endif
            </div>

        </div>
    </div>
</section>
@endif
@endforeach
