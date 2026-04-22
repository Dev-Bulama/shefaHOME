{{--
    Property Categories Section
    Shows Rent / For Sale / Short Let tabs with their property type content.
    All content is admin-editable via Admin → Pages → Home.
--}}
@php
use App\Helpers\PageContent as PC;

// Define all property type sections with their page assignments
$propertySections = [
    // key => [section_key, page_types (which tabs show it)]
    'warehouse'       => ['key' => 'warehouse',       'pages' => ['rent'],         'icon' => '🏭'],
    'office_space'    => ['key' => 'office_space',    'pages' => ['rent'],         'icon' => '🏢'],
    'filling_station' => ['key' => 'filling_station', 'pages' => ['rent', 'buy'],  'icon' => '⛽'],
    'hotel'           => ['key' => 'hotel',           'pages' => ['rent', 'buy'],  'icon' => '🏨'],
    'land'            => ['key' => 'land',            'pages' => ['buy'],          'icon' => '🌍'],
    'duplex'          => ['key' => 'duplex',          'pages' => ['buy'],          'icon' => '🏘️'],
    'short_let'       => ['key' => 'short_let',       'pages' => ['shortlet'],     'icon' => '🛏️'],
];

$tabs = [
    'rent'     => 'For Rent',
    'buy'      => 'For Sale',
    'shortlet' => 'Short Let',
];

// Collect visible sections and their data
$sections = [];
foreach ($propertySections as $id => $cfg) {
    $sKey = $cfg['key'];
    $visible = PC::get('home', $sKey . '.visible', '1');
    if ($visible !== '1') continue;

    $sections[$id] = [
        'title'       => PC::get('home', $sKey . '.title',       ucwords(str_replace('_', ' ', $id))),
        'subtitle'    => PC::get('home', $sKey . '.subtitle',    ''),
        'description' => PC::get('home', $sKey . '.description', ''),
        'button_text' => PC::get('home', $sKey . '.button_text', ''),
        'button_url'  => PC::get('home', $sKey . '.button_url',  '/properties'),
        'pages'       => $cfg['pages'],
        'icon'        => $cfg['icon'],
    ];
}
@endphp

<section class="py-20 bg-white" id="property-categories">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Section Header --}}
        <div class="text-center mb-12" data-reveal>
            <span class="inline-block text-[#27AE22] font-semibold text-sm tracking-widest uppercase mb-3">What We Offer</span>
            <h2 class="font-display text-4xl md:text-5xl font-bold text-[#1A237E] mb-4">
                Explore by <span class="text-[#27AE22]">Category</span>
            </h2>
            <p class="text-gray-500 text-lg max-w-2xl mx-auto">
                From warehouses to land, office spaces to short lets — find the perfect property for your needs.
            </p>
        </div>

        {{-- Tabs --}}
        <div x-data="{ activeTab: 'rent' }">

            {{-- Tab Buttons --}}
            <div class="flex flex-wrap justify-center gap-2 mb-10">
                @foreach($tabs as $tabKey => $tabLabel)
                <button
                    @click="activeTab = '{{ $tabKey }}'"
                    :class="activeTab === '{{ $tabKey }}'
                        ? 'bg-[#1A237E] text-white shadow-lg shadow-[#1A237E]/30'
                        : 'bg-gray-100 text-gray-600 hover:bg-gray-200'"
                    class="px-8 py-3 rounded-full font-semibold text-sm transition-all duration-300">
                    {{ $tabLabel }}
                </button>
                @endforeach
            </div>

            {{-- Rent Tab --}}
            <div x-show="activeTab === 'rent'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">
                @php $rentSections = array_filter($sections, fn($s) => in_array('rent', $s['pages'])); @endphp
                @if(count($rentSections))
                <div class="space-y-12">
                    @foreach($rentSections as $id => $s)
                    @include('public.home._property-type-card', ['section' => $s, 'id' => $id, 'loop' => $loop])
                    @endforeach
                </div>
                @else
                <p class="text-center text-gray-400 py-12">No rental properties configured yet.</p>
                @endif
            </div>

            {{-- Buy / For Sale Tab --}}
            <div x-show="activeTab === 'buy'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">
                @php $buySections = array_filter($sections, fn($s) => in_array('buy', $s['pages'])); @endphp
                @if(count($buySections))
                <div class="space-y-12">
                    @foreach($buySections as $id => $s)
                    @include('public.home._property-type-card', ['section' => $s, 'id' => $id, 'loop' => $loop])
                    @endforeach
                </div>
                @else
                <p class="text-center text-gray-400 py-12">No sale properties configured yet.</p>
                @endif
            </div>

            {{-- Short Let Tab --}}
            <div x-show="activeTab === 'shortlet'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">
                @php $shortletSections = array_filter($sections, fn($s) => in_array('shortlet', $s['pages'])); @endphp
                @if(count($shortletSections))
                <div class="space-y-12">
                    @foreach($shortletSections as $id => $s)
                    @include('public.home._property-type-card', ['section' => $s, 'id' => $id, 'loop' => $loop])
                    @endforeach
                </div>
                @else
                <p class="text-center text-gray-400 py-12">No short let properties configured yet.</p>
                @endif
            </div>

        </div>

        {{-- View All CTA --}}
        <div class="text-center mt-14" data-reveal>
            <a href="{{ route('properties.index') }}"
               class="inline-flex items-center gap-2 bg-[#1A237E] hover:bg-[#27AE22] text-white hover:text-[#1A237E] font-bold px-10 py-4 rounded-full transition-all hover:scale-105 hover:shadow-xl shadow-[#1A237E]/20 shadow-lg">
                Browse All Properties
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>
    </div>
</section>
