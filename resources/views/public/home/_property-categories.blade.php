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
<p>We offer access to office spaces in key commercial hubs across Lagos, including:</p>
<ul>
  <li>GRA, Ikeja (Premium corporate environment)</li>
  <li>Ikeja Central Business District</li>
  <li>Ogba (Growing commercial hub)</li>
  <li>Lekki Phase 1 (Modern business &amp; lifestyle district)</li>
  <li>Ikoyi (High-end corporate &amp; executive offices)</li>
  <li>Surulere (Strategic central location for businesses)</li>
</ul>

<h3>Office Space Options Available</h3>
<p>Our portfolio includes a wide range of office types to suit different business structures:</p>
<ul>
  <li>Serviced Offices – Ready-to-use with facilities and management</li>
  <li>Private Offices – For small teams and growing companies</li>
  <li>Corporate Office Floors – Ideal for large organizations</li>
  <li>Co-working Spaces – Flexible and cost-effective solutions</li>
  <li>Open Plan Offices – Customizable layouts for your operations</li>
</ul>

<h3>Flexible Leasing to Match Your Business</h3>
<p>We understand that every business has unique needs, so we offer:</p>
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
        'subtitle'    => 'Rent &amp; Buy',
        'pages'       => ['rent', 'buy'],
        'icon'        => '⛽',
        'button_text' => 'View Filling Stations',
        'button_url'  => '/properties?status=buy_and_rent',
        'description' => '
<p>At Shefa Homes, we specialize in connecting investors and businesses with profitable filling station opportunities across Lagos and Ogun State.</p>
<p>Whether you are looking to acquire an existing station, lease an operational outlet, or secure land suitable for fuel station development, we provide tailored solutions that align with your investment goals.</p>

<h3>Strategic Locations Available</h3>
<p>We source filling stations and suitable sites in high-traffic, high-demand areas, including:</p>
<ul>
  <li>Major highways (Lagos/Ibadan Expressway, Lagos/Abeokuta Expressway)</li>
  <li>Urban commercial zones (Ikeja, Surulere, Lekki, Ikoyi)</li>
  <li>Growing suburban areas (Ajah, Sangotedo, Ogun axis)</li>
  <li>Industrial and logistics corridors</li>
</ul>

<h3>Opportunities We Offer</h3>
<p>Our portfolio includes a wide range of options:</p>
<ul>
  <li>Operational Filling Stations (For Sale) – With existing customer base and infrastructure</li>
  <li>Filling Stations for Lease – Ready for immediate business operations</li>
  <li>Development Sites – Strategically located land suitable for new station setup</li>
  <li>Partnership / JV Opportunities – For investors looking to collaborate</li>
</ul>

<h3>Flexible Investment Options</h3>
<p>We understand the scale and complexity of this investment, so we provide:</p>
<ul>
  <li>Flexible budget matching (we source based on your financial capacity)</li>
  <li>Options ranging from small-scale stations to mega stations</li>
  <li>Support with due diligence and documentation</li>
  <li>Access to both on-market and off-market opportunities</li>
</ul>

<h3>Why Work With Shefa Homes?</h3>
<ul>
  <li>Strong network within commercial and petroleum property space</li>
  <li>Access to verified and high-potential opportunities</li>
  <li>Discreet handling of sensitive and high-value transactions</li>
  <li>Professional guidance from sourcing to acquisition/lease completion</li>
</ul>

<h3>Let\'s Help You Secure the Right Opportunity</h3>
<p>Looking to buy or lease a filling station? Share your requirements:</p>
<ul>
  <li>Preferred location</li>
  <li>Budget range</li>
  <li>Buy or lease preference</li>
  <li>Scale (number of pumps, size, etc.)</li>
</ul>
<p>We will connect you with carefully vetted opportunities that match your investment strategy.</p>
',
    ],

    'hotel' => [
        'title'       => 'Hotel',
        'subtitle'    => 'For Sale & Rent',
        'pages'       => ['rent', 'buy'],
        'icon'        => '🏨',
        'button_text' => 'View Hotel Properties',
        'button_url'  => '/properties?status=buy_and_rent',
        'description' => '
<p>At Shefa Homes, we connect investors and hospitality operators with high-potential hotel opportunities across Lagos and Ogun State.</p>
<p>Whether you\'re looking to acquire an existing hotel, lease a fully operational facility, or partner on a hospitality project, we provide tailored solutions aligned with your investment and operational goals.</p>

<h3>Strategic Locations Available</h3>
<p>We source hotels and hospitality assets in prime and high-demand areas, including:</p>
<ul>
  <li>Lagos Island (Lekki, Victoria Island, Ikoyi – premium hospitality zones)</li>
  <li>Lagos Mainland (Ikeja, Surulere, Yaba – business &amp; transit hubs)</li>
  <li>Airport axis (high occupancy potential)</li>
  <li>Ogun State corridors (emerging hospitality &amp; industrial demand zones)</li>
</ul>

<h3>Opportunities We Offer</h3>
<p>Our portfolio covers a wide range of hospitality assets:</p>
<ul>
  <li>Operational Hotels (For Sale) – With existing clientele and revenue flow</li>
  <li>Hotels for Lease – Ready for immediate operation</li>
  <li>Partially Completed / Conversion Projects</li>
  <li>Management &amp; Partnership Opportunities</li>
  <li>Boutique hotels, serviced apartments, and large-scale hospitality facilities</li>
</ul>

<h3>Flexible Investment Structure</h3>
<p>We understand that hospitality investments vary in scale, so we offer:</p>
<ul>
  <li>Flexible budget matching (aligned with your capacity)</li>
  <li>Options ranging from small boutique hotels to large facilities</li>
  <li>Support with due diligence and documentation</li>
  <li>Access to off-market and discreet listings</li>
</ul>

<h3>Key Features You May Find</h3>
<p>Depending on the property, features may include:</p>
<ul>
  <li>Multiple fully furnished guest rooms (en-suite)</li>
  <li>Reception &amp; lobby areas</li>
  <li>Restaurant / bar / lounge spaces</li>
  <li>Swimming pool &amp; leisure facilities</li>
  <li>Backup power supply (generator/transformer)</li>
  <li>Conference &amp; event spaces</li>
</ul>

<h3>Why Work With Shefa Homes?</h3>
<ul>
  <li>Strong network in the commercial and hospitality property market</li>
  <li>Access to verified, high-potential hotel assets</li>
  <li>Discreet handling of high-value transactions</li>
  <li>End-to-end support — from sourcing to acquisition or lease</li>
</ul>
',
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
<p>Our network spans high-demand and fast-growing areas across both Mainland and Island, including:</p>
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
<p>We offer a diverse portfolio tailored to different purposes:</p>
<ul>
  <li>Residential Land – Ideal for private homes, estates, and gated communities</li>
  <li>Commercial Land – Perfect for offices, retail developments, and mixed-use projects</li>
  <li>Industrial Land – Suitable for factories, warehouses, logistics hubs, and large-scale operations</li>
</ul>

<h3>Flexible &amp; Client-Focused Approach</h3>
<p>We understand that land acquisition is a major investment, so we offer:</p>
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
        'description' => '
<p>At Shefa Homes, we help you secure well-located 4-bedroom detached duplexes across Lagos Mainland\'s most desirable residential neighborhoods.</p>
<p>Whether you\'re buying for comfortable family living, rental income, or long-term investment, we connect you with homes that offer space, accessibility, and value.</p>

<h3>Prime Mainland Locations We Cover</h3>
<p>Our listings are carefully sourced from key residential hubs, including:</p>
<ul>
  <li>Ikeja GRA (Premium, serene, and highly secured environment)</li>
  <li>Ikeja (Central location with excellent infrastructure)</li>
  <li>Magodo (Well-planned estates with high livability)</li>
  <li>Ogba (Affordable and fast-developing residential zone)</li>
  <li>Surulere (Strategic central location with strong rental demand)</li>
</ul>

<h3>Features of Our Duplexes</h3>
<p>Our properties are designed to deliver comfort, functionality, and modern living:</p>
<ul>
  <li>4 spacious en-suite bedrooms</li>
  <li>Large living and family lounges</li>
  <li>Fully fitted modern kitchens</li>
  <li>Ample parking space within private compounds</li>
  <li>Optional BQ (Boys\' Quarters)</li>
  <li>Located in secure estates or well-developed neighborhoods</li>
</ul>

<h3>Flexible Buying Options</h3>
<p>We make property acquisition easier and more tailored to your needs:</p>
<ul>
  <li>Flexible budget matching (we work within your range)</li>
  <li>Ready-to-move-in &amp; newly built homes</li>
  <li>Options for personal residence or investment purposes</li>
  <li>High rental yield potential in key Mainland areas</li>
</ul>

<h3>Why Choose Shefa Homes?</h3>
<ul>
  <li>Access to verified Mainland property listings</li>
  <li>Strong presence in Ikeja, Magodo, Surulere, and surrounding areas</li>
  <li>Professional support from inspection to closing</li>
  <li>Focus on properties with good appreciation and rental value</li>
</ul>

<h3>Let\'s Help You Find the Right Home</h3>
<p>Tell us your preferences, and we\'ll handle the search:</p>
<ul>
  <li>Preferred location</li>
  <li>Budget range</li>
  <li>Specific features (BQ, estate, parking space, etc.)</li>
</ul>
<p>We\'ll present you with carefully selected duplex options that match your lifestyle and goals.</p>
',
    ],

    'duplex_island' => [
        'title'       => 'Duplex',
        'subtitle'    => 'For Sale – Island Properties',
        'pages'       => ['buy'],
        'icon'        => '🏡',
        'button_text' => 'View Island Duplexes',
        'button_url'  => '/properties?status=buy',
        'description' => '
<p>At Shefa Homes, we connect you with premium 4-bedroom detached duplexes located in some of Lagos Island\'s most desirable neighborhoods.</p>
<p>Whether you\'re buying for personal living, family comfort, or investment purposes, we provide access to carefully selected homes that combine luxury, functionality, and long-term value.</p>

<h3>Prime Island Locations We Cover</h3>
<p>Our listings span across top residential hubs, including:</p>
<ul>
  <li>Lekki Phase 1 (High-end living &amp; central accessibility)</li>
  <li>Ajah (Affordable luxury &amp; fast-growing communities)</li>
  <li>Sangotedo (Modern estates &amp; investment hotspots)</li>
  <li>Other key areas across the Lekki-Ajah corridor</li>
</ul>

<h3>What to Expect in Our Duplexes</h3>
<p>Our 4-bedroom detached homes are designed for comfort and modern living:</p>
<ul>
  <li>All rooms en-suite with spacious layouts</li>
  <li>Contemporary living areas with premium finishing</li>
  <li>Fully fitted modern kitchens</li>
  <li>Ample parking space within private compounds</li>
  <li>BQ (Boys\' Quarters) in selected properties</li>
  <li>Located in secure, gated estates with good road access</li>
</ul>

<h3>Flexible Options Tailored to You</h3>
<p>We understand that every buyer has different preferences, so we offer:</p>
<ul>
  <li>Flexible budget options (we match homes within your range)</li>
  <li>Ready-to-move-in homes &amp; off-plan opportunities</li>
  <li>Options for outright purchase or investment acquisition</li>
  <li>Homes suited for both owner-occupiers and rental income</li>
</ul>

<h3>Why Choose Shefa Homes?</h3>
<ul>
  <li>Access to verified and premium duplex listings</li>
  <li>Strong presence across Lagos Island property market</li>
  <li>Professional guidance from inspection to closing</li>
  <li>Focus on delivering properties that offer comfort, value &amp; appreciation</li>
</ul>

<h3>Let\'s Help You Find Your Ideal Home</h3>
<p>Tell us exactly what you\'re looking for:</p>
<ul>
  <li>Preferred location (Lekki, Ajah, Sangotedo, etc.)</li>
  <li>Budget range</li>
  <li>Specific features (BQ, smart home, estate type, etc.)</li>
</ul>
<p>We\'ll match you with the best available options tailored to your lifestyle and investment goals.</p>
',
    ],

    'short_let' => [
        'title'       => 'Short Let',
        'subtitle'    => 'Short Let Only',
        'pages'       => ['shortlet'],
        'icon'        => '🛏️',
        'button_text' => 'View Short Lets',
        'button_url'  => '/properties?status=shortlet',
        'description' => '
<p>At Shefa Homes, we offer access to fully furnished shortlet apartments across Lagos, designed for comfort, convenience, and a premium living experience.</p>
<p>Whether you\'re visiting, relocating, on business, or simply need a temporary luxury stay, we connect you with apartments that feel just like home — only better.</p>

<h3>Prime Locations Available</h3>
<p>Our shortlet apartments are located in some of Lagos\' most vibrant and secure neighborhoods, including:</p>
<ul>
  <li>Lekki Phase 1 (Lifestyle &amp; entertainment hub)</li>
  <li>Ikoyi (Luxury &amp; executive living)</li>
  <li>Victoria Island (Business &amp; commercial center)</li>
  <li>Ajah / Sangotedo (Affordable luxury &amp; serene environment)</li>
  <li>Ikeja (Mainland convenience &amp; proximity to the airport)</li>
</ul>

<h3>Apartment Options</h3>
<p>We provide a variety of shortlet options to suit your stay:</p>
<ul>
  <li>Studio Apartments</li>
  <li>1-, 2- &amp; 3-Bedroom Apartments</li>
  <li>Luxury Duplex Shortlets</li>
  <li>Serviced Apartments for Corporate Clients</li>
</ul>

<h3>What You Can Expect</h3>
<p>Our apartments are designed to deliver a seamless experience:</p>
<ul>
  <li>Fully furnished &amp; tastefully finished interiors</li>
  <li>High-speed internet &amp; smart TVs</li>
  <li>24/7 power supply &amp; security</li>
  <li>Housekeeping services (in selected apartments)</li>
  <li>Fully equipped kitchens</li>
  <li>Secure parking space</li>
</ul>

<h3>Flexible Booking Options</h3>
<p>We make your stay easy and convenient:</p>
<ul>
  <li>Daily, weekly, and monthly booking options</li>
  <li>Flexible pricing based on duration and apartment type</li>
  <li>Options for individuals, families, and corporate clients</li>
</ul>

<h3>Why Choose Shefa Homes?</h3>
<ul>
  <li>Access to verified and high-quality shortlet apartments</li>
  <li>Prime locations with easy accessibility</li>
  <li>Seamless booking and customer support</li>
  <li>Perfect balance of comfort, privacy, and luxury</li>
</ul>

<h3>Book Your Stay Today</h3>
<p>Tell us what you need, and we\'ll match you with the perfect apartment:</p>
<ul>
  <li>Preferred location</li>
  <li>Budget range</li>
  <li>Duration of stay</li>
  <li>Number of guests</li>
</ul>
<p>We\'ll provide you with carefully selected options tailored to your needs.</p>
',
    ],
];

// ── Override with DB content if available (admin-editable) ─────────────────
$sections = [];
foreach ($defaults as $id => $def) {
    $visible = PC::get('home', $id . '.visible', '1');
    if ($visible === '0') continue;

    $dbPages = PC::get('home', $id . '.pages', '');
    $pages   = $dbPages ? array_filter(array_map('trim', explode(',', $dbPages))) : $def['pages'];

    $sections[$id] = [
        'title'       => PC::get('home', $id . '.title',       '') ?: $def['title'],
        'subtitle'    => PC::get('home', $id . '.subtitle',    '') ?: $def['subtitle'],
        'description' => PC::get('home', $id . '.description', '') ?: $def['description'],
        'button_text' => PC::get('home', $id . '.button_text', '') ?: $def['button_text'],
        'button_url'  => PC::get('home', $id . '.button_url',  '') ?: $def['button_url'],
        'image'       => PC::get('home', $id . '.image',   ''),
        'image_2'     => PC::get('home', $id . '.image_2', ''),
        'image_3'     => PC::get('home', $id . '.image_3', ''),
        'icon'        => PC::get('home', $id . '.icon',    '') ?: $def['icon'],
        'pages'       => $pages,
    ];
}

// ── Load any extra sections added via Admin → Add Category Section ──────────
try {
    $extraTitles = \App\Models\PageContent::where('page', 'home')
        ->whereNotIn('section', array_keys($defaults))
        ->where('key', 'title')
        ->where('value', '!=', '')
        ->orderBy('sort_order')
        ->get();

    foreach ($extraTitles as $rec) {
        $sid = $rec->section;
        if (PC::get('home', $sid . '.visible', '1') === '0') continue;

        $rawPages = PC::get('home', $sid . '.pages', 'rent');
        $pages    = array_filter(array_map('trim', explode(',', $rawPages)));
        if (empty($pages)) $pages = ['rent'];

        $sections[$sid] = [
            'title'       => $rec->value,
            'subtitle'    => PC::get('home', $sid . '.subtitle',    ''),
            'description' => PC::get('home', $sid . '.description', ''),
            'button_text' => PC::get('home', $sid . '.button_text', ''),
            'button_url'  => PC::get('home', $sid . '.button_url',  ''),
            'image'       => PC::get('home', $sid . '.image',   ''),
            'image_2'     => PC::get('home', $sid . '.image_2', ''),
            'image_3'     => PC::get('home', $sid . '.image_3', ''),
            'icon'        => PC::get('home', $sid . '.icon', '🏠'),
            'pages'       => $pages,
        ];
    }
} catch (\Throwable $e) {}

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

        <div x-data="{
                activeTab: 'rent',
                switchTab(tab) {
                    this.activeTab = tab;
                    this.$nextTick(() => {
                        this.$el.querySelectorAll('[data-reveal]').forEach(el => el.classList.add('revealed'));
                    });
                }
            }"
            x-init="$nextTick(() => $el.querySelectorAll('[data-reveal]').forEach(el => el.classList.add('revealed')))">

            {{-- Tab Buttons --}}
            <div class="flex flex-wrap justify-center gap-2 mb-10">
                @foreach($tabs as $tabKey => $tabLabel)
                <button @click="switchTab('{{ $tabKey }}')"
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
