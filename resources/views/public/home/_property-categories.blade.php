{{--
    Property Categories Section — For Rent / For Sale / Short Let
    Content is hardcoded here and also admin-editable via Admin → Pages → Home.
--}}
@php
use App\Helpers\PageContent as PC;

// ── Hardcoded default content (shows even without DB migration) ─────────────
$defaults = [

    'warehouse' => [
        'title'       => 'Warehouse',
        'subtitle'    => 'To Rent',
        'pages'       => ['rent'],
        'icon'        => '🏭',
        'button_text' => 'View Warehouses',
        'button_url'  => '/properties?status=rent',
        'description' => '
<p>At Shefa Homes, we specialize in connecting businesses with strategically located warehouse spaces across key industrial and commercial hubs in Lagos and Ogun State.</p>
<p>Whether you\'re expanding operations, optimizing logistics, or seeking a more efficient distribution base, we provide tailored warehouse leasing solutions that match your exact requirements.</p>

<h3>Prime Locations We Cover</h3>
<p>We offer access to a wide network of warehouse options in high-demand areas, including:</p>
<ul>
  <li>Ikeja (Industrial &amp; Commercial Zones)</li>
  <li>Lagos/Ibadan Expressway Corridor</li>
  <li>Oregun Industrial Estate</li>
  <li>Ado-Odo/Ota, Ogun State</li>
  <li>Other emerging logistics hubs across Lagos &amp; Ogun</li>
</ul>

<h3>What We Offer</h3>
<p>Our portfolio includes a variety of warehouse types suitable for different business needs:</p>
<ul>
  <li>Standard &amp; large-scale storage facilities</li>
  <li>Industrial-grade warehouses for manufacturing &amp; production</li>
  <li>Logistics &amp; distribution hubs</li>
  <li>Warehouses with office spaces &amp; administrative sections</li>
  <li>Facilities with ample parking, loading bays &amp; good road access</li>
</ul>

<h3>Flexible Options to Suit Your Needs</h3>
<p>We understand that every business is unique. That\'s why we offer:</p>
<ul>
  <li>Flexible budget options (we work within your range)</li>
  <li>Multiple size configurations (small, medium, large capacity)</li>
  <li>Short-term &amp; long-term lease opportunities</li>
  <li>Custom sourcing based on your exact specifications</li>
</ul>

<h3>Why Choose Shefa Homes?</h3>
<ul>
  <li>Strong network across top industrial locations</li>
  <li>Access to off-market and exclusive listings</li>
  <li>Professional guidance from inspection to lease closure</li>
  <li>Fast turnaround in securing suitable properties</li>
  <li>Transparent and client-focused service delivery</li>
</ul>

<h3>Let\'s Help You Secure the Right Warehouse</h3>
<p>Tell us what you need, and we\'ll handle the search. Send us your requirements today:</p>
<ul>
  <li>Preferred location</li>
  <li>Budget range</li>
  <li>Size / capacity needed</li>
  <li>Intended use</li>
</ul>
<p>Our team will provide you with carefully curated warehouse options that match your business goals.</p>
',
    ],

    'office_space' => [
        'title'       => 'Office Space',
        'subtitle'    => 'To Rent',
        'pages'       => ['rent'],
        'icon'        => '🏢',
        'button_text' => 'View Office Spaces',
        'button_url'  => '/properties?status=rent',
        'description' => '
<p>At Shefa Homes, we help businesses secure strategically located office spaces across Lagos\' most sought-after commercial districts.</p>
<p>Whether you\'re a startup, SME, or established company, we provide tailored office solutions that align with your brand image, operational needs, and budget.</p>

<h3>Prime Business Locations We Cover</h3>
<ul>
  <li>GRA, Ikeja (Premium corporate environment)</li>
  <li>Ikeja Central Business District</li>
  <li>Ogba (Growing commercial hub)</li>
  <li>Lekki Phase 1 (Modern business &amp; lifestyle district)</li>
  <li>Ikoyi (High-end corporate &amp; executive offices)</li>
  <li>Surulere (Strategic central location for businesses)</li>
</ul>

<h3>Office Space Options Available</h3>
<ul>
  <li>Serviced Offices – Ready-to-use with facilities and management</li>
  <li>Private Offices – For small teams and growing companies</li>
  <li>Corporate Office Floors – Ideal for large organizations</li>
  <li>Co-working Spaces – Flexible and cost-effective solutions</li>
  <li>Open Plan Offices – Customizable layouts for your operations</li>
</ul>

<h3>Flexible Leasing to Match Your Business</h3>
<ul>
  <li>Flexible budget options (we source within your range)</li>
  <li>Short-term &amp; long-term lease arrangements</li>
  <li>Offices with modern facilities (parking, elevators, security, power supply, internet readiness)</li>
  <li>Spaces in prime and accessible locations</li>
</ul>

<h3>Why Choose Shefa Homes?</h3>
<ul>
  <li>Access to verified and exclusive office listings</li>
  <li>Strong presence across Lagos\' key business districts</li>
  <li>Fast and efficient property sourcing</li>
  <li>Professional support from inspection to lease completion</li>
  <li>Focus on matching you with a space that enhances your business image and productivity</li>
</ul>

<h3>Let\'s Find the Right Office for You</h3>
<p>Tell us your requirements, and we\'ll handle the search:</p>
<ul>
  <li>Preferred location</li>
  <li>Budget range</li>
  <li>Office size / team size</li>
  <li>Type of office (serviced, private, corporate, etc.)</li>
</ul>
<p>We\'ll present you with carefully selected office options tailored to your needs.</p>
',
    ],

    'filling_station' => [
        'title'       => 'Filling Station',
        'subtitle'    => 'Rent & Buy',
        'pages'       => ['rent', 'buy'],
        'icon'        => '⛽',
        'button_text' => 'View Filling Stations',
        'button_url'  => '/properties?status=buy_and_rent',
        'description' => '<p>At Shefa Homes, we connect investors and operators with prime filling station properties across Lagos and Ogun State — available for outright purchase or long-term lease.</p><p>Whether you are looking to acquire an operational station or secure a lease on a high-traffic location, our team will source the right opportunity for you.</p>',
    ],

    'hotel' => [
        'title'       => 'Hotel',
        'subtitle'    => 'Rent & Buy',
        'pages'       => ['rent', 'buy'],
        'icon'        => '🏨',
        'button_text' => 'View Hotel Properties',
        'button_url'  => '/properties?status=buy_and_rent',
        'description' => '<p>At Shefa Homes, we source and list hotel properties across Lagos — from boutique hotels to large hospitality facilities — available for purchase or management lease.</p><p>Whether you are an investor seeking an income-generating hospitality asset or an operator looking for a managed property, we will find the right match for you.</p>',
    ],

    'land' => [
        'title'       => 'Land',
        'subtitle'    => 'For Sale',
        'pages'       => ['buy'],
        'icon'        => '🌍',
        'button_text' => 'View Land Listings',
        'button_url'  => '/properties?status=buy',
        'description' => '
<p>At Shefa Homes, we provide access to premium land opportunities across Lagos and Ogun State, strategically positioned for residential, commercial, and industrial development.</p>
<p>Whether you are an investor, developer, or corporate organization, we help you secure the right land in the right location — aligned with your vision and budget.</p>

<h3>Strategic Locations We Cover</h3>
<ul>
  <li>GRA, Ikeja (Premium Residential &amp; Commercial)</li>
  <li>Magodo (High-end Residential Developments)</li>
  <li>Lekki Phase 1 (Luxury &amp; Commercial Hub)</li>
  <li>Sangotedo / Ajah Corridor (Rapidly Developing Investment Zone)</li>
  <li>Surulere (Central Commercial &amp; Mixed-Use Area)</li>
  <li>Lagos/Abeokuta Expressway (Industrial &amp; Commercial Growth Belt)</li>
  <li>Lagos/Ibadan Expressway (Logistics &amp; Industrial Advantage)</li>
  <li>Ado-Odo/Ota, Ogun State (Industrial &amp; Affordable Large Parcels)</li>
</ul>

<h3>Land Categories Available</h3>
<ul>
  <li>Residential Land – Ideal for private homes, estates, and gated communities</li>
  <li>Commercial Land – Perfect for offices, retail developments, and mixed-use projects</li>
  <li>Industrial Land – Suitable for factories, warehouses, logistics hubs, and large-scale operations</li>
</ul>

<h3>Flexible &amp; Client-Focused Approach</h3>
<ul>
  <li>Flexible budget options (we work within your financial plan)</li>
  <li>Verified lands with clear titles (C of O, Gazette, Excision, etc.)</li>
  <li>Various plot sizes — from standard plots to large acreage</li>
  <li>Tailored sourcing based on your exact requirements and purpose</li>
</ul>

<h3>Why Choose Shefa Homes?</h3>
<ul>
  <li>Deep market knowledge across Lagos Mainland &amp; Island + Ogun axis</li>
  <li>Access to off-market and exclusive land deals</li>
  <li>Due diligence support to ensure secure and safe transactions</li>
  <li>End-to-end assistance — from search to documentation</li>
</ul>

<h3>Let Us Help You Secure the Right Land</h3>
<p>Looking for land? Tell us exactly what you need:</p>
<ul>
  <li>Preferred location</li>
  <li>Budget range</li>
  <li>Land size (plot, half plot, acres, etc.)</li>
  <li>Intended use (residential, commercial, industrial)</li>
</ul>
<p>We\'ll match you with carefully selected options that fit your goal.</p>
',
    ],

    'duplex' => [
        'title'       => 'Duplex',
        'subtitle'    => 'For Sale',
        'pages'       => ['buy'],
        'icon'        => '🏘️',
        'button_text' => 'View Duplexes',
        'button_url'  => '/properties?status=buy',
        'description' => '<p>At Shefa Homes, we list premium duplex properties across Lagos\'s most desirable residential neighbourhoods — from Lekki and Magodo to Surulere and Ikeja GRA.</p><p>Whether you are buying your first home or expanding your portfolio, we will connect you with the right duplex at the right price.</p>',
    ],

    'short_let' => [
        'title'       => 'Short Let',
        'subtitle'    => 'Short Let Only',
        'pages'       => ['shortlet'],
        'icon'        => '🛏️',
        'button_text' => 'View Short Lets',
        'button_url'  => '/properties?status=shortlet',
        'description' => '<p>At Shefa Homes, we offer a curated selection of fully-furnished short-let apartments and homes across Lagos — ideal for business travellers, relocating professionals, and vacation stays.</p><p>Daily, weekly, and monthly options available across Victoria Island, Lekki, Ikeja GRA, and more.</p>',
    ],
];

// ── Override with DB content if available (admin-editable) ─────────────────
$sections = [];
foreach ($defaults as $id => $def) {
    $sKey    = str_replace('_', '_', $id); // same key
    $dbDesc  = PC::get('home', $sKey . '.description', '');
    $dbTitle = PC::get('home', $sKey . '.title',       '');

    $sections[$id] = [
        'title'       => $dbTitle       ?: $def['title'],
        'subtitle'    => PC::get('home', $sKey . '.subtitle',    '') ?: $def['subtitle'],
        'description' => $dbDesc        ?: $def['description'],
        'button_text' => PC::get('home', $sKey . '.button_text', '') ?: $def['button_text'],
        'button_url'  => PC::get('home', $sKey . '.button_url',  '') ?: $def['button_url'],
        'pages'       => $def['pages'],
        'icon'        => $def['icon'],
    ];

    $visible = PC::get('home', $sKey . '.visible', '1');
    if ($visible === '0') unset($sections[$id]);
}

$tabs = ['rent' => 'For Rent', 'buy' => 'For Sale', 'shortlet' => 'Short Let'];
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

        <div x-data="{ activeTab: 'rent' }">

            {{-- Tab Buttons --}}
            <div class="flex flex-wrap justify-center gap-2 mb-10">
                @foreach($tabs as $tabKey => $tabLabel)
                <button @click="activeTab = '{{ $tabKey }}'"
                    :class="activeTab === '{{ $tabKey }}'
                        ? 'bg-[#1A237E] text-white shadow-lg shadow-[#1A237E]/30'
                        : 'bg-gray-100 text-gray-600 hover:bg-gray-200'"
                    class="px-8 py-3 rounded-full font-semibold text-sm transition-all duration-300">
                    {{ $tabLabel }}
                </button>
                @endforeach
            </div>

            {{-- For Rent --}}
            <div x-show="activeTab === 'rent'"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-4"
                 x-transition:enter-end="opacity-100 translate-y-0">
                @php $rentSections = array_filter($sections, fn($s) => in_array('rent', $s['pages'])); @endphp
                <div class="space-y-10">
                    @foreach($rentSections as $id => $s)
                        @include('public.home._property-type-card', ['section' => $s, 'id' => $id, 'loop' => $loop])
                    @endforeach
                </div>
            </div>

            {{-- For Sale --}}
            <div x-show="activeTab === 'buy'"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-4"
                 x-transition:enter-end="opacity-100 translate-y-0">
                @php $buySections = array_filter($sections, fn($s) => in_array('buy', $s['pages'])); @endphp
                <div class="space-y-10">
                    @foreach($buySections as $id => $s)
                        @include('public.home._property-type-card', ['section' => $s, 'id' => $id, 'loop' => $loop])
                    @endforeach
                </div>
            </div>

            {{-- Short Let --}}
            <div x-show="activeTab === 'shortlet'"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-4"
                 x-transition:enter-end="opacity-100 translate-y-0">
                @php $shortletSections = array_filter($sections, fn($s) => in_array('shortlet', $s['pages'])); @endphp
                <div class="space-y-10">
                    @foreach($shortletSections as $id => $s)
                        @include('public.home._property-type-card', ['section' => $s, 'id' => $id, 'loop' => $loop])
                    @endforeach
                </div>
            </div>

        </div>

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
