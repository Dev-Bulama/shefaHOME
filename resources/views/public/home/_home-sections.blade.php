@php
use App\Helpers\PageContent as PC;
$homeSections = [
    ['key' => 'section_1', 'default_title' => 'Why Real Estate Is the Smartest Investment', 'default_image_side' => 'right', 'default_bg' => 'white'],
    ['key' => 'section_2', 'default_title' => 'Strategic Locations Across Nigeria',         'default_image_side' => 'left',  'default_bg' => 'gray'],
    ['key' => 'section_3', 'default_title' => 'Flexible Plans Built for You',               'default_image_side' => 'right', 'default_bg' => 'white'],
    ['key' => 'section_4', 'default_title' => 'Trusted by Over 5,000 Investors',            'default_image_side' => 'left',  'default_bg' => 'gray'],
];
@endphp

@foreach($homeSections as $s)
@php
    $visible      = PC::get('home', $s['key'].'.visible', '1');
    $title        = PC::get('home', $s['key'].'.title',       $s['default_title']);
    $subtitle     = PC::get('home', $s['key'].'.subtitle',    '');
    $description  = PC::get('home', $s['key'].'.description', '');
    $image        = PC::get('home', $s['key'].'.image',       '');
    $imgSide      = PC::get('home', $s['key'].'.image_side',  $s['default_image_side']);
    $btnText      = PC::get('home', $s['key'].'.button_text', '');
    $btnUrl       = PC::get('home', $s['key'].'.button_url',  '/contact');
    $bg           = PC::get('home', $s['key'].'.bg',          $s['default_bg']);

    $sectionBg = match($bg) {
        'gray'  => 'bg-gray-50',
        'navy'  => 'bg-[#1A237E]',
        default => 'bg-white',
    };
    $textColor = $bg === 'navy' ? 'text-white' : 'text-[#1A237E]';
    $subColor  = $bg === 'navy' ? 'text-gray-300' : 'text-gray-500';
    $isNavy    = $bg === 'navy';
@endphp

@if($visible === '1')
<section class="py-20 {{ $sectionBg }} overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20 items-center {{ $imgSide === 'left' ? '' : 'lg:[&>*:first-child]:order-last' }}">

            {{-- Image side --}}
            <div data-reveal="{{ $imgSide === 'left' ? 'left' : 'right' }}">
                @if($image)
                <div class="relative rounded-3xl overflow-hidden shadow-2xl {{ $isNavy ? 'shadow-black/30' : 'shadow-[#1A237E]/15' }}">
                    <img src="{{ $image }}" alt="{{ $title }}" class="w-full h-[420px] object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                </div>
                @else
                <div class="relative rounded-3xl overflow-hidden bg-gradient-to-br from-[#1A237E]/10 to-[#27AE22]/10 h-[420px] flex items-center justify-center border-2 border-dashed border-[#1A237E]/20">
                    <div class="text-center">
                        <svg class="w-16 h-16 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <p class="text-gray-400 text-sm">Add image in Admin → Pages → Home</p>
                    </div>
                </div>
                @endif
            </div>

            {{-- Text side --}}
            <div data-reveal="{{ $imgSide === 'left' ? 'right' : 'left' }}">
                <span class="inline-block text-[#27AE22] font-semibold text-sm tracking-widest uppercase mb-3">{{ $subtitle }}</span>
                <h2 class="font-display text-4xl md:text-5xl font-bold {{ $textColor }} mb-5 leading-tight">{{ $title }}</h2>
                @if($description)
                <div class="{{ $subColor }} text-base leading-relaxed mb-8 space-y-3">
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
