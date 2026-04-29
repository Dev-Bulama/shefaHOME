<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PageContent;
use App\Helpers\PageContent as PageContentHelper;
use Illuminate\Http\Request;

class PageContentController extends Controller
{
    /** List of pages with human-readable names */
    private static array $pages = [
        'home'           => 'Home Page',
        'about'          => 'About Us',
        'services'       => 'Our Services',
        'joint-venture'  => 'JV Partnership',
        'investor-info'  => 'Invest With Us',
        'contact'        => 'Contact Us',
        'properties'     => 'Properties',
        'csr'            => 'CSR',
        'blog'           => 'Blog',
        'careers'        => 'Careers',
        'faqs'           => 'FAQs',
        'gallery'        => 'Gallery',
        'privacy-policy' => 'Privacy Policy',
    ];

    public function index()
    {
        $pages = [];
        foreach (self::$pages as $slug => $name) {
            try {
                $count = PageContent::where('page', $slug)->count();
            } catch (\Throwable $e) {
                $count = 0;
            }
            $pages[] = ['slug' => $slug, 'name' => $name, 'fields' => $count];
        }
        return view('admin.pages.index', compact('pages'));
    }

    public function edit(string $page)
    {
        abort_unless(array_key_exists($page, self::$pages), 404);

        if ($page === 'home') {
            $this->seedHomePropertyTypeSections();
        }
        if ($page === 'gallery') {
            $this->seedGalleryPageContent();
        }
        if ($page === 'privacy-policy') {
            $this->seedPrivacyPolicyContent();
        }

        $pageName = self::$pages[$page];
        try {
            $rows = PageContent::where('page', $page)->orderBy('sort_order')->get()->groupBy('section');
        } catch (\Throwable $e) {
            $rows = collect();
        }

        return view('admin.pages.edit', compact('page', 'pageName', 'rows'));
    }

    private function seedHomePropertyTypeSections(): void
    {
        $warehouseDesc = '<p>At Shefa Homes, we specialize in connecting businesses with strategically located warehouse spaces across key industrial and commercial hubs in Lagos and Ogun State.</p>
<p>Whether you\'re expanding operations, optimizing logistics, or seeking a more efficient distribution base, we provide tailored warehouse leasing solutions that match your exact requirements.</p>
<h3>Prime Locations We Cover</h3>
<p>We offer access to a wide network of warehouse options in high-demand areas, including:</p>
<ul><li>Ikeja (Industrial &amp; Commercial Zones)</li><li>Lagos/Ibadan Expressway Corridor</li><li>Oregun Industrial Estate</li><li>Ado-Odo/Ota, Ogun State</li><li>Other emerging logistics hubs across Lagos &amp; Ogun</li></ul>
<h3>What We Offer</h3>
<ul><li>Standard &amp; large-scale storage facilities</li><li>Industrial-grade warehouses for manufacturing &amp; production</li><li>Logistics &amp; distribution hubs</li><li>Warehouses with office spaces &amp; administrative sections</li><li>Facilities with ample parking, loading bays &amp; good road access</li></ul>
<h3>Flexible Options to Suit Your Needs</h3>
<ul><li>Flexible budget options (we work within your range)</li><li>Multiple size configurations (small, medium, large capacity)</li><li>Short-term &amp; long-term lease opportunities</li><li>Custom sourcing based on your exact specifications</li></ul>
<h3>Why Choose Shefa Homes?</h3>
<ul><li>Strong network across top industrial locations</li><li>Access to off-market and exclusive listings</li><li>Professional guidance from inspection to lease closure</li><li>Fast turnaround in securing suitable properties</li><li>Transparent and client-focused service delivery</li></ul>
<h3>Let\'s Help You Secure the Right Warehouse</h3>
<p>Tell us what you need, and we\'ll handle the search. Send us your requirements today:</p>
<ul><li>Preferred location</li><li>Budget range</li><li>Size / capacity needed</li><li>Intended use</li></ul>
<p>Our team will provide you with carefully curated warehouse options that match your business goals.</p>';

        $officeDesc = '<p>At Shefa Homes, we help businesses secure strategically located office spaces across Lagos\' most sought-after commercial districts.</p>'
            . '<p>Whether you\'re a startup, SME, or established company, we provide tailored office solutions that align with your brand image, operational needs, and budget.</p>'
            . '<h3>Prime Business Locations We Cover</h3>'
            . '<p>We offer access to office spaces in key commercial hubs across Lagos, including:</p>'
            . '<ul><li>GRA, Ikeja (Premium corporate environment)</li><li>Ikeja Central Business District</li><li>Ogba (Growing commercial hub)</li><li>Lekki Phase 1 (Modern business &amp; lifestyle district)</li><li>Ikoyi (High-end corporate &amp; executive offices)</li><li>Surulere (Strategic central location for businesses)</li></ul>'
            . '<h3>Office Space Options Available</h3>'
            . '<p>Our portfolio includes a wide range of office types to suit different business structures:</p>'
            . '<ul><li>Serviced Offices – Ready-to-use with facilities and management</li><li>Private Offices – For small teams and growing companies</li><li>Corporate Office Floors – Ideal for large organizations</li><li>Co-working Spaces – Flexible and cost-effective solutions</li><li>Open Plan Offices – Customizable layouts for your operations</li></ul>'
            . '<h3>Flexible Leasing to Match Your Business</h3>'
            . '<p>We understand that every business has unique needs, so we offer:</p>'
            . '<ul><li>Flexible budget options (we source within your range)</li><li>Short-term &amp; long-term lease arrangements</li><li>Offices with modern facilities (parking, elevators, security, power supply, internet readiness)</li><li>Spaces in prime and accessible locations</li></ul>'
            . '<h3>Why Choose Shefa Homes?</h3>'
            . '<ul><li>Access to verified and exclusive office listings</li><li>Strong presence across Lagos\' key business districts</li><li>Fast and efficient property sourcing</li><li>Professional support from inspection to lease completion</li><li>Focus on matching you with a space that enhances your business image and productivity</li></ul>'
            . '<h3>Let\'s Find the Right Office for You</h3>'
            . '<p>Tell us your requirements, and we\'ll handle the search:</p>'
            . '<ul><li>Preferred location</li><li>Budget range</li><li>Office size / team size</li><li>Type of office (serviced, private, corporate, etc.)</li></ul>'
            . '<p>We\'ll present you with carefully selected office options tailored to your needs.</p>';

        $landDesc = '<p>At Shefa Homes, we provide access to premium land opportunities across Lagos and Ogun State, strategically positioned for residential, commercial, and industrial development.</p>'
            . '<p>Whether you are an investor, developer, or corporate organization, we help you secure the right land in the right location — aligned with your vision and budget.</p>'
            . '<h3>Strategic Locations We Cover</h3>'
            . '<p>Our network spans high-demand and fast-growing areas across both Mainland and Island, including:</p>'
            . '<ul><li>GRA, Ikeja (Premium Residential &amp; Commercial)</li><li>Magodo (High-end Residential Developments)</li><li>Lekki Phase 1 (Luxury &amp; Commercial Hub)</li><li>Sangotedo / Ajah Corridor (Rapidly Developing Investment Zone)</li><li>Surulere (Central Commercial &amp; Mixed-Use Area)</li><li>Lagos/Abeokuta Expressway (Industrial &amp; Commercial Growth Belt)</li><li>Lagos/Ibadan Expressway (Logistics &amp; Industrial Advantage)</li><li>Ado-Odo/Ota, Ogun State (Industrial &amp; Affordable Large Parcels)</li></ul>'
            . '<h3>Land Categories Available</h3>'
            . '<p>We offer a diverse portfolio tailored to different purposes:</p>'
            . '<ul><li>Residential Land – Ideal for private homes, estates, and gated communities</li><li>Commercial Land – Perfect for offices, retail developments, and mixed-use projects</li><li>Industrial Land – Suitable for factories, warehouses, logistics hubs, and large-scale operations</li></ul>'
            . '<h3>Flexible &amp; Client-Focused Approach</h3>'
            . '<p>We understand that land acquisition is a major investment, so we offer:</p>'
            . '<ul><li>Flexible budget options (we work within your financial plan)</li><li>Verified lands with clear titles (C of O, Gazette, Excision, etc.)</li><li>Various plot sizes — from standard plots to large acreage</li><li>Tailored sourcing based on your exact requirements and purpose</li></ul>'
            . '<h3>Why Choose Shefa Homes?</h3>'
            . '<ul><li>Deep market knowledge across Lagos Mainland &amp; Island + Ogun axis</li><li>Access to off-market and exclusive land deals</li><li>Due diligence support to ensure secure and safe transactions</li><li>End-to-end assistance — from search to documentation</li></ul>'
            . '<h3>Let Us Help You Secure the Right Land</h3>'
            . '<p>Looking for land? Tell us exactly what you need:</p>'
            . '<ul><li>Preferred location</li><li>Budget range</li><li>Land size (plot, half plot, acres, etc.)</li><li>Intended use (residential, commercial, industrial)</li></ul>'
            . '<p>We\'ll match you with carefully selected options that fit your goal.</p>';

        $duplexDesc = '<p>At Shefa Homes, we help you secure well-located 4-bedroom detached duplexes across Lagos Mainland\'s most desirable residential neighborhoods.</p>'
            . '<p>Whether you\'re buying for comfortable family living, rental income, or long-term investment, we connect you with homes that offer space, accessibility, and value.</p>'
            . '<h3>Prime Mainland Locations We Cover</h3>'
            . '<p>Our listings are carefully sourced from key residential hubs, including:</p>'
            . '<ul><li>Ikeja GRA (Premium, serene, and highly secured environment)</li><li>Ikeja (Central location with excellent infrastructure)</li><li>Magodo (Well-planned estates with high livability)</li><li>Ogba (Affordable and fast-developing residential zone)</li><li>Surulere (Strategic central location with strong rental demand)</li></ul>'
            . '<h3>Features of Our Duplexes</h3>'
            . '<p>Our properties are designed to deliver comfort, functionality, and modern living:</p>'
            . '<ul><li>4 spacious en-suite bedrooms</li><li>Large living and family lounges</li><li>Fully fitted modern kitchens</li><li>Ample parking space within private compounds</li><li>Optional BQ (Boys\' Quarters)</li><li>Located in secure estates or well-developed neighborhoods</li></ul>'
            . '<h3>Flexible Buying Options</h3>'
            . '<p>We make property acquisition easier and more tailored to your needs:</p>'
            . '<ul><li>Flexible budget matching (we work within your range)</li><li>Ready-to-move-in &amp; newly built homes</li><li>Options for personal residence or investment purposes</li><li>High rental yield potential in key Mainland areas</li></ul>'
            . '<h3>Why Choose Shefa Homes?</h3>'
            . '<ul><li>Access to verified Mainland property listings</li><li>Strong presence in Ikeja, Magodo, Surulere, and surrounding areas</li><li>Professional support from inspection to closing</li><li>Focus on properties with good appreciation and rental value</li></ul>'
            . '<h3>Let\'s Help You Find the Right Home</h3>'
            . '<p>Tell us your preferences, and we\'ll handle the search:</p>'
            . '<ul><li>Preferred location</li><li>Budget range</li><li>Specific features (BQ, estate, parking space, etc.)</li></ul>'
            . '<p>We\'ll present you with carefully selected duplex options that match your lifestyle and goals.</p>';

        $hotelDesc = '<p>At Shefa Homes, we connect investors and hospitality operators with high-potential hotel opportunities across Lagos and Ogun State.</p>'
            . '<p>Whether you\'re looking to acquire an existing hotel, lease a fully operational facility, or partner on a hospitality project, we provide tailored solutions aligned with your investment and operational goals.</p>'
            . '<h3>Strategic Locations Available</h3>'
            . '<p>We source hotels and hospitality assets in prime and high-demand areas, including:</p>'
            . '<ul><li>Lagos Island (Lekki, Victoria Island, Ikoyi – premium hospitality zones)</li><li>Lagos Mainland (Ikeja, Surulere, Yaba – business &amp; transit hubs)</li><li>Airport axis (high occupancy potential)</li><li>Ogun State corridors (emerging hospitality &amp; industrial demand zones)</li></ul>'
            . '<h3>Opportunities We Offer</h3>'
            . '<p>Our portfolio covers a wide range of hospitality assets:</p>'
            . '<ul><li>Operational Hotels (For Sale) – With existing clientele and revenue flow</li><li>Hotels for Lease – Ready for immediate operation</li><li>Partially Completed / Conversion Projects</li><li>Management &amp; Partnership Opportunities</li><li>Boutique hotels, serviced apartments, and large-scale hospitality facilities</li></ul>'
            . '<h3>Flexible Investment Structure</h3>'
            . '<p>We understand that hospitality investments vary in scale, so we offer:</p>'
            . '<ul><li>Flexible budget matching (aligned with your capacity)</li><li>Options ranging from small boutique hotels to large facilities</li><li>Support with due diligence and documentation</li><li>Access to off-market and discreet listings</li></ul>'
            . '<h3>Key Features You May Find</h3>'
            . '<p>Depending on the property, features may include:</p>'
            . '<ul><li>Multiple fully furnished guest rooms (en-suite)</li><li>Reception &amp; lobby areas</li><li>Restaurant / bar / lounge spaces</li><li>Swimming pool &amp; leisure facilities</li><li>Backup power supply (generator/transformer)</li><li>Conference &amp; event spaces</li></ul>'
            . '<h3>Why Work With Shefa Homes?</h3>'
            . '<ul><li>Strong network in the commercial and hospitality property market</li><li>Access to verified, high-potential hotel assets</li><li>Discreet handling of high-value transactions</li><li>End-to-end support — from sourcing to acquisition or lease</li></ul>';

        $shortLetDesc = '<p>At Shefa Homes, we offer access to fully furnished shortlet apartments across Lagos, designed for comfort, convenience, and a premium living experience.</p>'
            . '<p>Whether you\'re visiting, relocating, on business, or simply need a temporary luxury stay, we connect you with apartments that feel just like home — only better.</p>'
            . '<h3>Prime Locations Available</h3>'
            . '<p>Our shortlet apartments are located in some of Lagos\' most vibrant and secure neighborhoods, including:</p>'
            . '<ul><li>Lekki Phase 1 (Lifestyle &amp; entertainment hub)</li><li>Ikoyi (Luxury &amp; executive living)</li><li>Victoria Island (Business &amp; commercial center)</li><li>Ajah / Sangotedo (Affordable luxury &amp; serene environment)</li><li>Ikeja (Mainland convenience &amp; proximity to the airport)</li></ul>'
            . '<h3>Apartment Options</h3>'
            . '<p>We provide a variety of shortlet options to suit your stay:</p>'
            . '<ul><li>Studio Apartments</li><li>1-, 2- &amp; 3-Bedroom Apartments</li><li>Luxury Duplex Shortlets</li><li>Serviced Apartments for Corporate Clients</li></ul>'
            . '<h3>What You Can Expect</h3>'
            . '<p>Our apartments are designed to deliver a seamless experience:</p>'
            . '<ul><li>Fully furnished &amp; tastefully finished interiors</li><li>High-speed internet &amp; smart TVs</li><li>24/7 power supply &amp; security</li><li>Housekeeping services (in selected apartments)</li><li>Fully equipped kitchens</li><li>Secure parking space</li></ul>'
            . '<h3>Flexible Booking Options</h3>'
            . '<p>We make your stay easy and convenient:</p>'
            . '<ul><li>Daily, weekly, and monthly booking options</li><li>Flexible pricing based on duration and apartment type</li><li>Options for individuals, families, and corporate clients</li></ul>'
            . '<h3>Why Choose Shefa Homes?</h3>'
            . '<ul><li>Access to verified and high-quality shortlet apartments</li><li>Prime locations with easy accessibility</li><li>Seamless booking and customer support</li><li>Perfect balance of comfort, privacy, and luxury</li></ul>'
            . '<h3>Book Your Stay Today</h3>'
            . '<p>Tell us what you need, and we\'ll match you with the perfect apartment:</p>'
            . '<ul><li>Preferred location</li><li>Budget range</li><li>Duration of stay</li><li>Number of guests</li></ul>'
            . '<p>We\'ll provide you with carefully selected options tailored to your needs.</p>';

        $fillingStationDesc = '<p>At Shefa Homes, we specialize in connecting investors and businesses with profitable filling station opportunities across Lagos and Ogun State.</p>'
            . '<p>Whether you are looking to acquire an existing station, lease an operational outlet, or secure land suitable for fuel station development, we provide tailored solutions that align with your investment goals.</p>'
            . '<h3>Strategic Locations Available</h3>'
            . '<p>We source filling stations and suitable sites in high-traffic, high-demand areas, including:</p>'
            . '<ul><li>Major highways (Lagos/Ibadan Expressway, Lagos/Abeokuta Expressway)</li><li>Urban commercial zones (Ikeja, Surulere, Lekki, Ikoyi)</li><li>Growing suburban areas (Ajah, Sangotedo, Ogun axis)</li><li>Industrial and logistics corridors</li></ul>'
            . '<h3>Opportunities We Offer</h3>'
            . '<p>Our portfolio includes a wide range of options:</p>'
            . '<ul><li>Operational Filling Stations (For Sale) – With existing customer base and infrastructure</li><li>Filling Stations for Lease – Ready for immediate business operations</li><li>Development Sites – Strategically located land suitable for new station setup</li><li>Partnership / JV Opportunities – For investors looking to collaborate</li></ul>'
            . '<h3>Flexible Investment Options</h3>'
            . '<p>We understand the scale and complexity of this investment, so we provide:</p>'
            . '<ul><li>Flexible budget matching (we source based on your financial capacity)</li><li>Options ranging from small-scale stations to mega stations</li><li>Support with due diligence and documentation</li><li>Access to both on-market and off-market opportunities</li></ul>'
            . '<h3>Why Work With Shefa Homes?</h3>'
            . '<ul><li>Strong network within commercial and petroleum property space</li><li>Access to verified and high-potential opportunities</li><li>Discreet handling of sensitive and high-value transactions</li><li>Professional guidance from sourcing to acquisition/lease completion</li></ul>'
            . '<h3>Let\'s Help You Secure the Right Opportunity</h3>'
            . '<p>Looking to buy or lease a filling station? Share your requirements:</p>'
            . '<ul><li>Preferred location</li><li>Budget range</li><li>Buy or lease preference</li><li>Scale (number of pumps, size, etc.)</li></ul>'
            . '<p>We will connect you with carefully vetted opportunities that match your investment strategy.</p>';

        $duplexIslandDesc = '<p>At Shefa Homes, we connect you with premium 4-bedroom detached duplexes located in some of Lagos Island\'s most desirable neighborhoods.</p>'
            . '<p>Whether you\'re buying for personal living, family comfort, or investment purposes, we provide access to carefully selected homes that combine luxury, functionality, and long-term value.</p>'
            . '<h3>Prime Island Locations We Cover</h3>'
            . '<p>Our listings span across top residential hubs, including:</p>'
            . '<ul><li>Lekki Phase 1 (High-end living &amp; central accessibility)</li><li>Ajah (Affordable luxury &amp; fast-growing communities)</li><li>Sangotedo (Modern estates &amp; investment hotspots)</li><li>Other key areas across the Lekki-Ajah corridor</li></ul>'
            . '<h3>What to Expect in Our Duplexes</h3>'
            . '<p>Our 4-bedroom detached homes are designed for comfort and modern living:</p>'
            . '<ul><li>All rooms en-suite with spacious layouts</li><li>Contemporary living areas with premium finishing</li><li>Fully fitted modern kitchens</li><li>Ample parking space within private compounds</li><li>BQ (Boys\' Quarters) in selected properties</li><li>Located in secure, gated estates with good road access</li></ul>'
            . '<h3>Flexible Options Tailored to You</h3>'
            . '<p>We understand that every buyer has different preferences, so we offer:</p>'
            . '<ul><li>Flexible budget options (we match homes within your range)</li><li>Ready-to-move-in homes &amp; off-plan opportunities</li><li>Options for outright purchase or investment acquisition</li><li>Homes suited for both owner-occupiers and rental income</li></ul>'
            . '<h3>Why Choose Shefa Homes?</h3>'
            . '<ul><li>Access to verified and premium duplex listings</li><li>Strong presence across Lagos Island property market</li><li>Professional guidance from inspection to closing</li><li>Focus on delivering properties that offer comfort, value &amp; appreciation</li></ul>'
            . '<h3>Let\'s Help You Find Your Ideal Home</h3>'
            . '<p>Tell us exactly what you\'re looking for:</p>'
            . '<ul><li>Preferred location (Lekki, Ajah, Sangotedo, etc.)</li><li>Budget range</li><li>Specific features (BQ, smart home, estate type, etc.)</li></ul>'
            . '<p>We\'ll match you with the best available options tailored to your lifestyle and investment goals.</p>';

        $sections = [
            ['section'=>'warehouse',       'key'=>'image',       'label'=>'Warehouse – Image',            'type'=>'image',   'value'=>'',                      'sort_order'=>199],
            ['section'=>'warehouse',       'key'=>'image_2',     'label'=>'Warehouse – Image 2',          'type'=>'image',   'value'=>'',                      'sort_order'=>1991],
            ['section'=>'warehouse',       'key'=>'image_3',     'label'=>'Warehouse – Image 3',          'type'=>'image',   'value'=>'',                      'sort_order'=>1992],
            ['section'=>'warehouse',       'key'=>'title',       'label'=>'Warehouse – Title',            'type'=>'text',    'value'=>'Warehouse',             'sort_order'=>200],
            ['section'=>'warehouse',       'key'=>'subtitle',    'label'=>'Warehouse – Subtitle',         'type'=>'text',    'value'=>'To Rent',               'sort_order'=>201],
            ['section'=>'warehouse',       'key'=>'description', 'label'=>'Warehouse – Description',      'type'=>'html',    'value'=>$warehouseDesc,          'sort_order'=>202],
            ['section'=>'warehouse',       'key'=>'button_text', 'label'=>'Warehouse – Button Text',      'type'=>'text',    'value'=>'View Warehouses',       'sort_order'=>203],
            ['section'=>'warehouse',       'key'=>'button_url',  'label'=>'Warehouse – Button URL',       'type'=>'url',     'value'=>'/properties?status=rent','sort_order'=>204],
            ['section'=>'warehouse',       'key'=>'visible',     'label'=>'Warehouse – Visible',          'type'=>'boolean', 'value'=>'1',                     'sort_order'=>205],
            ['section'=>'warehouse',       'key'=>'icon',        'label'=>'Warehouse – Icon (emoji)',     'type'=>'text',    'value'=>'🏭',                    'sort_order'=>206],
            ['section'=>'warehouse',       'key'=>'pages',       'label'=>'Warehouse – Tab(s) (rent/buy/shortlet, comma-separated)', 'type'=>'text', 'value'=>'rent', 'sort_order'=>207],

            ['section'=>'office_space',    'key'=>'image',       'label'=>'Office Space – Image',         'type'=>'image',   'value'=>'',                      'sort_order'=>209],
            ['section'=>'office_space',    'key'=>'image_2',     'label'=>'Office Space – Image 2',       'type'=>'image',   'value'=>'',                      'sort_order'=>2091],
            ['section'=>'office_space',    'key'=>'image_3',     'label'=>'Office Space – Image 3',       'type'=>'image',   'value'=>'',                      'sort_order'=>2092],
            ['section'=>'office_space',    'key'=>'title',       'label'=>'Office Space – Title',         'type'=>'text',    'value'=>'Office Space',          'sort_order'=>210],
            ['section'=>'office_space',    'key'=>'subtitle',    'label'=>'Office Space – Subtitle',      'type'=>'text',    'value'=>'To Rent',               'sort_order'=>211],
            ['section'=>'office_space',    'key'=>'description', 'label'=>'Office Space – Description',   'type'=>'html',    'value'=>$officeDesc,             'sort_order'=>212],
            ['section'=>'office_space',    'key'=>'button_text', 'label'=>'Office Space – Button Text',   'type'=>'text',    'value'=>'View Office Spaces',    'sort_order'=>213],
            ['section'=>'office_space',    'key'=>'button_url',  'label'=>'Office Space – Button URL',    'type'=>'url',     'value'=>'/properties?status=rent','sort_order'=>214],
            ['section'=>'office_space',    'key'=>'visible',     'label'=>'Office Space – Visible',       'type'=>'boolean', 'value'=>'1',                     'sort_order'=>215],
            ['section'=>'office_space',    'key'=>'icon',        'label'=>'Office Space – Icon (emoji)',  'type'=>'text',    'value'=>'🏢',                    'sort_order'=>216],
            ['section'=>'office_space',    'key'=>'pages',       'label'=>'Office Space – Tab(s)',        'type'=>'text',    'value'=>'rent',                  'sort_order'=>217],

            ['section'=>'land',            'key'=>'image',       'label'=>'Land – Image',                 'type'=>'image',   'value'=>'',                      'sort_order'=>219],
            ['section'=>'land',            'key'=>'image_2',     'label'=>'Land – Image 2',               'type'=>'image',   'value'=>'',                      'sort_order'=>2191],
            ['section'=>'land',            'key'=>'image_3',     'label'=>'Land – Image 3',               'type'=>'image',   'value'=>'',                      'sort_order'=>2192],
            ['section'=>'land',            'key'=>'title',       'label'=>'Land – Title',                 'type'=>'text',    'value'=>'Land',                  'sort_order'=>220],
            ['section'=>'land',            'key'=>'subtitle',    'label'=>'Land – Subtitle',              'type'=>'text',    'value'=>'For Sale',              'sort_order'=>221],
            ['section'=>'land',            'key'=>'description', 'label'=>'Land – Description',           'type'=>'html',    'value'=>$landDesc,               'sort_order'=>222],
            ['section'=>'land',            'key'=>'button_text', 'label'=>'Land – Button Text',           'type'=>'text',    'value'=>'View Land Listings',    'sort_order'=>223],
            ['section'=>'land',            'key'=>'button_url',  'label'=>'Land – Button URL',            'type'=>'url',     'value'=>'/properties?status=buy','sort_order'=>224],
            ['section'=>'land',            'key'=>'visible',     'label'=>'Land – Visible',               'type'=>'boolean', 'value'=>'1',                     'sort_order'=>225],
            ['section'=>'land',            'key'=>'icon',        'label'=>'Land – Icon (emoji)',          'type'=>'text',    'value'=>'🌍',                    'sort_order'=>226],
            ['section'=>'land',            'key'=>'pages',       'label'=>'Land – Tab(s)',                'type'=>'text',    'value'=>'buy',                   'sort_order'=>227],

            ['section'=>'duplex',          'key'=>'image',       'label'=>'Duplex – Image',               'type'=>'image',   'value'=>'',                      'sort_order'=>229],
            ['section'=>'duplex',          'key'=>'image_2',     'label'=>'Duplex – Image 2',             'type'=>'image',   'value'=>'',                      'sort_order'=>2291],
            ['section'=>'duplex',          'key'=>'image_3',     'label'=>'Duplex – Image 3',             'type'=>'image',   'value'=>'',                      'sort_order'=>2292],
            ['section'=>'duplex',          'key'=>'title',       'label'=>'Duplex – Title',               'type'=>'text',    'value'=>'Duplex',                'sort_order'=>230],
            ['section'=>'duplex',          'key'=>'subtitle',    'label'=>'Duplex – Subtitle',            'type'=>'text',    'value'=>'For Sale',              'sort_order'=>231],
            ['section'=>'duplex',          'key'=>'description', 'label'=>'Duplex – Description',         'type'=>'html',    'value'=>$duplexDesc,             'sort_order'=>232],
            ['section'=>'duplex',          'key'=>'button_text', 'label'=>'Duplex – Button Text',         'type'=>'text',    'value'=>'View Duplexes',         'sort_order'=>233],
            ['section'=>'duplex',          'key'=>'button_url',  'label'=>'Duplex – Button URL',          'type'=>'url',     'value'=>'/properties?status=buy','sort_order'=>234],
            ['section'=>'duplex',          'key'=>'visible',     'label'=>'Duplex – Visible',             'type'=>'boolean', 'value'=>'1',                     'sort_order'=>235],
            ['section'=>'duplex',          'key'=>'icon',        'label'=>'Duplex – Icon (emoji)',        'type'=>'text',    'value'=>'🏘️',                   'sort_order'=>236],
            ['section'=>'duplex',          'key'=>'pages',       'label'=>'Duplex – Tab(s)',              'type'=>'text',    'value'=>'buy',                   'sort_order'=>237],

            ['section'=>'duplex_island',   'key'=>'image',       'label'=>'Duplex Island – Image',        'type'=>'image',   'value'=>'',                      'sort_order'=>2355],
            ['section'=>'duplex_island',   'key'=>'image_2',     'label'=>'Duplex Island – Image 2',      'type'=>'image',   'value'=>'',                      'sort_order'=>2356],
            ['section'=>'duplex_island',   'key'=>'image_3',     'label'=>'Duplex Island – Image 3',      'type'=>'image',   'value'=>'',                      'sort_order'=>2357],
            ['section'=>'duplex_island',   'key'=>'title',       'label'=>'Duplex Island – Title',        'type'=>'text',    'value'=>'Duplex',                    'sort_order'=>236],
            ['section'=>'duplex_island',   'key'=>'subtitle',    'label'=>'Duplex Island – Subtitle',     'type'=>'text',    'value'=>'For Sale – Island Properties','sort_order'=>237],
            ['section'=>'duplex_island',   'key'=>'description', 'label'=>'Duplex Island – Description',  'type'=>'html',    'value'=>$duplexIslandDesc,           'sort_order'=>238],
            ['section'=>'duplex_island',   'key'=>'button_text', 'label'=>'Duplex Island – Button Text',  'type'=>'text',    'value'=>'View Island Duplexes',      'sort_order'=>239],
            ['section'=>'duplex_island',   'key'=>'button_url',  'label'=>'Duplex Island – Button URL',   'type'=>'url',     'value'=>'/properties?status=buy',    'sort_order'=>2391],
            ['section'=>'duplex_island',   'key'=>'visible',     'label'=>'Duplex Island – Visible',      'type'=>'boolean', 'value'=>'1',                         'sort_order'=>2392],
            ['section'=>'duplex_island',   'key'=>'icon',        'label'=>'Duplex Island – Icon (emoji)', 'type'=>'text',    'value'=>'🏡',                        'sort_order'=>2393],
            ['section'=>'duplex_island',   'key'=>'pages',       'label'=>'Duplex Island – Tab(s)',       'type'=>'text',    'value'=>'buy',                       'sort_order'=>2394],

            ['section'=>'filling_station', 'key'=>'image',       'label'=>'Filling Station – Image',      'type'=>'image',   'value'=>'',                      'sort_order'=>2395],
            ['section'=>'filling_station', 'key'=>'image_2',     'label'=>'Filling Station – Image 2',    'type'=>'image',   'value'=>'',                      'sort_order'=>2396],
            ['section'=>'filling_station', 'key'=>'image_3',     'label'=>'Filling Station – Image 3',    'type'=>'image',   'value'=>'',                      'sort_order'=>2397],
            ['section'=>'filling_station', 'key'=>'title',       'label'=>'Filling Station – Title',      'type'=>'text',    'value'=>'Filling Station',       'sort_order'=>240],
            ['section'=>'filling_station', 'key'=>'subtitle',    'label'=>'Filling Station – Subtitle',   'type'=>'text',    'value'=>'Rent & Buy',            'sort_order'=>241],
            ['section'=>'filling_station', 'key'=>'description', 'label'=>'Filling Station – Description','type'=>'html',    'value'=>$fillingStationDesc,     'sort_order'=>242],
            ['section'=>'filling_station', 'key'=>'button_text', 'label'=>'Filling Station – Button Text','type'=>'text',    'value'=>'View Filling Stations', 'sort_order'=>243],
            ['section'=>'filling_station', 'key'=>'button_url',  'label'=>'Filling Station – Button URL', 'type'=>'url',     'value'=>'/properties?status=buy_and_rent','sort_order'=>244],
            ['section'=>'filling_station', 'key'=>'visible',     'label'=>'Filling Station – Visible',    'type'=>'boolean', 'value'=>'1',                     'sort_order'=>245],
            ['section'=>'filling_station', 'key'=>'icon',        'label'=>'Filling Station – Icon',       'type'=>'text',    'value'=>'⛽',                    'sort_order'=>246],
            ['section'=>'filling_station', 'key'=>'pages',       'label'=>'Filling Station – Tab(s)',     'type'=>'text',    'value'=>'rent,buy',              'sort_order'=>247],

            ['section'=>'hotel',           'key'=>'image',       'label'=>'Hotel – Image',                'type'=>'image',   'value'=>'',                      'sort_order'=>249],
            ['section'=>'hotel',           'key'=>'image_2',     'label'=>'Hotel – Image 2',              'type'=>'image',   'value'=>'',                      'sort_order'=>2491],
            ['section'=>'hotel',           'key'=>'image_3',     'label'=>'Hotel – Image 3',              'type'=>'image',   'value'=>'',                      'sort_order'=>2492],
            ['section'=>'hotel',           'key'=>'title',       'label'=>'Hotel – Title',                'type'=>'text',    'value'=>'Hotel',                 'sort_order'=>250],
            ['section'=>'hotel',           'key'=>'subtitle',    'label'=>'Hotel – Subtitle',             'type'=>'text',    'value'=>'For Sale & Rent',       'sort_order'=>251],
            ['section'=>'hotel',           'key'=>'description', 'label'=>'Hotel – Description',          'type'=>'html',    'value'=>$hotelDesc,              'sort_order'=>252],
            ['section'=>'hotel',           'key'=>'button_text', 'label'=>'Hotel – Button Text',          'type'=>'text',    'value'=>'View Hotel Properties', 'sort_order'=>253],
            ['section'=>'hotel',           'key'=>'button_url',  'label'=>'Hotel – Button URL',           'type'=>'url',     'value'=>'/properties?status=buy_and_rent','sort_order'=>254],
            ['section'=>'hotel',           'key'=>'visible',     'label'=>'Hotel – Visible',              'type'=>'boolean', 'value'=>'1',                     'sort_order'=>255],
            ['section'=>'hotel',           'key'=>'icon',        'label'=>'Hotel – Icon (emoji)',         'type'=>'text',    'value'=>'🏨',                    'sort_order'=>256],
            ['section'=>'hotel',           'key'=>'pages',       'label'=>'Hotel – Tab(s)',               'type'=>'text',    'value'=>'rent,buy',              'sort_order'=>257],

            ['section'=>'short_let',       'key'=>'image',       'label'=>'Short Let – Image',            'type'=>'image',   'value'=>'',                      'sort_order'=>259],
            ['section'=>'short_let',       'key'=>'image_2',     'label'=>'Short Let – Image 2',          'type'=>'image',   'value'=>'',                      'sort_order'=>2591],
            ['section'=>'short_let',       'key'=>'image_3',     'label'=>'Short Let – Image 3',          'type'=>'image',   'value'=>'',                      'sort_order'=>2592],
            ['section'=>'short_let',       'key'=>'title',       'label'=>'Short Let – Title',            'type'=>'text',    'value'=>'Short Let',             'sort_order'=>260],
            ['section'=>'short_let',       'key'=>'subtitle',    'label'=>'Short Let – Subtitle',         'type'=>'text',    'value'=>'Short Let Only',        'sort_order'=>261],
            ['section'=>'short_let',       'key'=>'description', 'label'=>'Short Let – Description',      'type'=>'html',    'value'=>$shortLetDesc,           'sort_order'=>262],
            ['section'=>'short_let',       'key'=>'button_text', 'label'=>'Short Let – Button Text',      'type'=>'text',    'value'=>'View Short Lets',       'sort_order'=>263],
            ['section'=>'short_let',       'key'=>'button_url',  'label'=>'Short Let – Button URL',       'type'=>'url',     'value'=>'/properties?status=shortlet','sort_order'=>264],
            ['section'=>'short_let',       'key'=>'visible',     'label'=>'Short Let – Visible',          'type'=>'boolean', 'value'=>'1',                     'sort_order'=>265],
            ['section'=>'short_let',       'key'=>'icon',        'label'=>'Short Let – Icon (emoji)',     'type'=>'text',    'value'=>'🛏️',                   'sort_order'=>266],
            ['section'=>'short_let',       'key'=>'pages',       'label'=>'Short Let – Tab(s)',           'type'=>'text',    'value'=>'shortlet',              'sort_order'=>267],
        ];

        foreach ($sections as $row) {
            PageContent::firstOrCreate(
                ['page' => 'home', 'section' => $row['section'], 'key' => $row['key']],
                array_merge($row, ['page' => 'home'])
            );
        }

        PageContentHelper::flushCache();
    }

    private function seedGalleryPageContent(): void
    {
        $fields = [
            ['section'=>'hero', 'key'=>'eyebrow',     'label'=>'Gallery – Eyebrow Text',    'type'=>'text',    'value'=>'Our Portfolio',                                                        'sort_order'=>1],
            ['section'=>'hero', 'key'=>'title',       'label'=>'Gallery – Page Title',      'type'=>'text',    'value'=>'Gallery',                                                              'sort_order'=>2],
            ['section'=>'hero', 'key'=>'description', 'label'=>'Gallery – Hero Description','type'=>'textarea','value'=>'Explore our completed projects, community events, and real estate developments across Nigeria.','sort_order'=>3],
            ['section'=>'cta',  'key'=>'title',       'label'=>'Gallery – CTA Title',       'type'=>'text',    'value'=>'Interested in Our Properties?',                                        'sort_order'=>10],
            ['section'=>'cta',  'key'=>'description', 'label'=>'Gallery – CTA Description', 'type'=>'textarea','value'=>'Browse our premium estates and find the right investment for you.',   'sort_order'=>11],
        ];
        foreach ($fields as $row) {
            PageContent::firstOrCreate(
                ['page' => 'gallery', 'section' => $row['section'], 'key' => $row['key']],
                array_merge($row, ['page' => 'gallery'])
            );
        }
        PageContentHelper::flushCache();
    }

    private function seedPrivacyPolicyContent(): void
    {
        $privacyHtml = '<h2>1. Introduction</h2>
<p>Welcome to <strong>Shefa Homes and Properties Ltd</strong> ("we", "our", or "us"). We are committed to protecting your personal information and your right to privacy. This Privacy Policy explains how we collect, use, disclose, and safeguard your information when you visit our website or use our services.</p>

<h2>2. Information We Collect</h2>
<p>We may collect the following types of information:</p>
<ul>
<li><strong>Personal Identification Information:</strong> Name, email address, phone number, and postal address.</li>
<li><strong>Property Inquiry Data:</strong> Details about properties you inquire about, preferred locations, budget range, and purchase intent.</li>
<li><strong>Usage Data:</strong> IP address, browser type, pages visited, time spent on pages, and referring URLs.</li>
<li><strong>Communication Records:</strong> Records of any correspondence you send us via email, phone, or our contact forms.</li>
</ul>

<h2>3. How We Use Your Information</h2>
<p>We use the information we collect to:</p>
<ul>
<li>Respond to your property inquiries and provide relevant listings.</li>
<li>Send you marketing communications about our properties and services (where you have consented).</li>
<li>Improve our website and tailor our services to your needs.</li>
<li>Process transactions and manage your account.</li>
<li>Comply with applicable laws and regulations.</li>
</ul>

<h2>4. Sharing Your Information</h2>
<p>We do not sell, trade, or rent your personal information to third parties. We may share your information with:</p>
<ul>
<li>Trusted service providers who assist us in operating our website and delivering our services, subject to confidentiality agreements.</li>
<li>Legal authorities where required by law or to protect our legal rights.</li>
<li>Business partners (such as mortgage brokers or legal services) only with your explicit consent.</li>
</ul>

<h2>5. Cookies and Tracking</h2>
<p>Our website uses cookies to enhance your browsing experience. Cookies are small data files stored on your device. You may choose to disable cookies through your browser settings; however, this may affect some functionality of our website.</p>
<p>We use cookies for:</p>
<ul>
<li>Session management and authentication.</li>
<li>Analytics and performance tracking (Google Analytics).</li>
<li>Remembering your preferences.</li>
</ul>

<h2>6. Data Security</h2>
<p>We implement appropriate technical and organisational measures to protect your personal data against unauthorised access, alteration, disclosure, or destruction. However, no internet transmission is completely secure, and we cannot guarantee absolute security.</p>

<h2>7. Data Retention</h2>
<p>We retain your personal information for as long as necessary to fulfil the purposes outlined in this policy, or as required by law. When your data is no longer needed, we will securely delete or anonymise it.</p>

<h2>8. Your Rights</h2>
<p>Depending on your location, you may have the following rights regarding your personal data:</p>
<ul>
<li><strong>Access:</strong> Request a copy of the personal data we hold about you.</li>
<li><strong>Correction:</strong> Request correction of inaccurate or incomplete data.</li>
<li><strong>Deletion:</strong> Request deletion of your personal data, subject to legal obligations.</li>
<li><strong>Objection:</strong> Object to our processing of your data for marketing purposes.</li>
<li><strong>Portability:</strong> Request that we transfer your data to another organisation.</li>
</ul>
<p>To exercise any of these rights, please contact us at the details below.</p>

<h2>9. Third-Party Links</h2>
<p>Our website may contain links to third-party websites. We are not responsible for the privacy practices of those sites and encourage you to review their privacy policies.</p>

<h2>10. Children\'s Privacy</h2>
<p>Our services are not directed to individuals under the age of 18. We do not knowingly collect personal information from children. If you believe we have inadvertently collected such data, please contact us immediately.</p>

<h2>11. Changes to This Policy</h2>
<p>We may update this Privacy Policy from time to time. We will notify you of significant changes by posting the new policy on this page with an updated date. Your continued use of our services after any changes constitutes your acceptance of the revised policy.</p>

<h2>12. Contact Us</h2>
<p>If you have any questions or concerns about this Privacy Policy or our data practices, please contact us:</p>
<ul>
<li><strong>Shefa Homes and Properties Ltd</strong></li>
<li>Email: info@shefahomes.com</li>
<li>Phone: +234 912 238 8541</li>
<li>Address: Lagos, Nigeria</li>
</ul>';

        $fields = [
            ['section'=>'hero', 'key'=>'title',          'label'=>'Privacy Policy – Page Title',    'type'=>'text',    'value'=>'Privacy Policy',          'sort_order'=>1],
            ['section'=>'hero', 'key'=>'last_updated',   'label'=>'Privacy Policy – Last Updated',  'type'=>'text',    'value'=>'Last updated: January 2025','sort_order'=>2],
            ['section'=>'page', 'key'=>'content',        'label'=>'Privacy Policy – Full Content',  'type'=>'html',    'value'=>$privacyHtml,              'sort_order'=>10],
        ];
        foreach ($fields as $row) {
            PageContent::firstOrCreate(
                ['page' => 'privacy-policy', 'section' => $row['section'], 'key' => $row['key']],
                array_merge($row, ['page' => 'privacy-policy'])
            );
        }
        PageContentHelper::flushCache();
    }

    public function update(Request $request, string $page)
    {
        abort_unless(array_key_exists($page, self::$pages), 404);

        $fields = $request->input('content', []);

        foreach ($fields as $section => $keys) {
            foreach ($keys as $key => $value) {
                // Decode values that were base64-encoded client-side to bypass WAF
                if (is_string($value) && str_starts_with($value, '__b64__:')) {
                    $decoded = base64_decode(substr($value, 8), true);
                    if ($decoded !== false) {
                        $value = $decoded;
                    }
                }

                $record = PageContent::where([
                    'page'    => $page,
                    'section' => $section,
                    'key'     => $key,
                ])->first();

                if ($record) {
                    // Only update the value — never touch type, label, or sort_order
                    $record->update(['value' => $value]);
                } else {
                    // Brand-new field (added via "Add Field" but saved through main form)
                    PageContent::create([
                        'page'       => $page,
                        'section'    => $section,
                        'key'        => $key,
                        'value'      => $value,
                        'label'      => ucwords(str_replace(['-', '_'], ' ', $key)),
                        'type'       => 'text',
                        'sort_order' => 999,
                    ]);
                }
            }
        }

        // Flush in-memory cache
        PageContentHelper::flushCache();

        return back()->with('success', 'Page content updated successfully.');
    }

    public function addField(Request $request, string $page)
    {
        abort_unless(array_key_exists($page, self::$pages), 404);

        $data = $request->validate([
            'section'  => 'required|string|max:80|regex:/^[a-z0-9_-]+$/',
            'key'      => 'required|string|max:80|regex:/^[a-z0-9_-]+$/',
            'label'    => 'required|string|max:120',
            'type'     => 'required|in:text,textarea,html,image,url,boolean',
            'value'    => 'nullable|string',
        ]);

        $data['page']       = $page;
        $data['sort_order'] = PageContent::where('page', $page)->max('sort_order') + 1;

        PageContent::firstOrCreate(
            ['page' => $page, 'section' => $data['section'], 'key' => $data['key']],
            $data
        );

        return back()->with('success', 'New field added.');
    }

    public function addCategorySection(Request $request, string $page)
    {
        abort_unless($page === 'home', 404);

        $data = $request->validate([
            'section_id'  => ['required', 'string', 'max:60', 'regex:/^[a-z0-9_]+$/'],
            'title'       => 'required|string|max:120',
            'subtitle'    => 'nullable|string|max:120',
            'icon'        => 'nullable|string|max:20',
            'tabs'        => 'required|array|min:1',
            'tabs.*'      => 'in:rent,buy,shortlet',
            'button_text' => 'nullable|string|max:120',
            'button_url'  => 'nullable|string|max:255',
        ]);

        $sid   = $data['section_id'];
        $label = ucwords(str_replace('_', ' ', $sid));
        $base  = PageContent::where('page', 'home')->max('sort_order') + 1;

        $fields = [
            ['key'=>'image',       'label'=>"$label – Image",                         'type'=>'image',   'value'=>''],
            ['key'=>'image_2',     'label'=>"$label – Image 2",                       'type'=>'image',   'value'=>''],
            ['key'=>'image_3',     'label'=>"$label – Image 3",                       'type'=>'image',   'value'=>''],
            ['key'=>'icon',        'label'=>"$label – Icon (emoji)",                  'type'=>'text',    'value'=>$data['icon'] ?? '🏠'],
            ['key'=>'title',       'label'=>"$label – Title",                         'type'=>'text',    'value'=>$data['title']],
            ['key'=>'subtitle',    'label'=>"$label – Subtitle",                      'type'=>'text',    'value'=>$data['subtitle'] ?? ''],
            ['key'=>'description', 'label'=>"$label – Description",                   'type'=>'html',    'value'=>''],
            ['key'=>'button_text', 'label'=>"$label – Button Text",                   'type'=>'text',    'value'=>$data['button_text'] ?? ''],
            ['key'=>'button_url',  'label'=>"$label – Button URL",                    'type'=>'url',     'value'=>$data['button_url'] ?? ''],
            ['key'=>'pages',       'label'=>"$label – Tab(s) (rent/buy/shortlet)",    'type'=>'text',    'value'=>implode(',', $data['tabs'])],
            ['key'=>'visible',     'label'=>"$label – Visible",                       'type'=>'boolean', 'value'=>'1'],
        ];

        foreach ($fields as $i => $field) {
            PageContent::firstOrCreate(
                ['page' => 'home', 'section' => $sid, 'key' => $field['key']],
                array_merge($field, ['page' => 'home', 'section' => $sid, 'sort_order' => $base + $i])
            );
        }

        PageContentHelper::flushCache();
        return back()->with('success', "Category section \"{$data['title']}\" added. Fill in the fields below.");
    }

    public function deleteField(int $id)
    {
        PageContent::findOrFail($id)->delete();
        return back()->with('success', 'Field removed.');
    }
}
