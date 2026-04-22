<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        $now = now();

        $warehouseContent = <<<'HTML'
<p>At Shefa Homes, we specialize in connecting businesses with strategically located warehouse spaces across key industrial and commercial hubs in Lagos and Ogun State.</p>

<p>Whether you're expanding operations, optimizing logistics, or seeking a more efficient distribution base, we provide tailored warehouse leasing solutions that match your exact requirements.</p>

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
<p>We understand that every business is unique. That's why we offer:</p>
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

<h3>Let's Help You Secure the Right Warehouse</h3>
<p>Tell us what you need, and we'll handle the search. Send us your requirements today:</p>
<ul>
<li>Preferred location</li>
<li>Budget range</li>
<li>Size / capacity needed</li>
<li>Intended use</li>
</ul>
<p>Our team will provide you with carefully curated warehouse options that match your business goals.</p>
HTML;

        $landContent = <<<'HTML'
<p>At Shefa Homes, we provide access to premium land opportunities across Lagos and Ogun State, strategically positioned for residential, commercial, and industrial development.</p>

<p>Whether you are an investor, developer, or corporate organization, we help you secure the right land in the right location—aligned with your vision and budget.</p>

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
<li>Various plot sizes—from standard plots to large acreage</li>
<li>Tailored sourcing based on your exact requirements and purpose</li>
</ul>

<h3>Why Choose Shefa Homes?</h3>
<ul>
<li>Deep market knowledge across Lagos Mainland &amp; Island + Ogun axis</li>
<li>Access to off-market and exclusive land deals</li>
<li>Due diligence support to ensure secure and safe transactions</li>
<li>End-to-end assistance—from search to documentation</li>
</ul>

<h3>Let Us Help You Secure the Right Land</h3>
<p>Looking for land? Tell us exactly what you need:</p>
<ul>
<li>Preferred location</li>
<li>Budget range</li>
<li>Land size (plot, half plot, acres, etc.)</li>
<li>Intended use (residential, commercial, industrial)</li>
</ul>
<p>We'll match you with carefully selected options that fit your goal.</p>
HTML;

        $officeContent = <<<'HTML'
<p>At Shefa Homes, we help businesses secure strategically located office spaces across Lagos' most sought-after commercial districts.</p>

<p>Whether you're a startup, SME, or established company, we provide tailored office solutions that align with your brand image, operational needs, and budget.</p>

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
<li>Strong presence across Lagos' key business districts</li>
<li>Fast and efficient property sourcing</li>
<li>Professional support from inspection to lease completion</li>
<li>Focus on matching you with a space that enhances your business image and productivity</li>
</ul>

<h3>Let's Find the Right Office for You</h3>
<p>Tell us your requirements, and we'll handle the search:</p>
<ul>
<li>Preferred location</li>
<li>Budget range</li>
<li>Office size / team size</li>
<li>Type of office (serviced, private, corporate, etc.)</li>
</ul>
<p>We'll present you with carefully selected office options tailored to your needs.</p>
HTML;

        $entries = [
            // ── WAREHOUSE (Rent page) ──────────────────────────────────────
            ['page' => 'home', 'section' => 'warehouse', 'key' => 'visible',     'label' => 'Warehouse – Visible',     'type' => 'boolean',  'value' => '1',          'sort_order' => 200],
            ['page' => 'home', 'section' => 'warehouse', 'key' => 'title',       'label' => 'Warehouse – Title',       'type' => 'text',     'value' => 'Warehouse',  'sort_order' => 201],
            ['page' => 'home', 'section' => 'warehouse', 'key' => 'subtitle',    'label' => 'Warehouse – Subtitle',    'type' => 'text',     'value' => 'To Rent',    'sort_order' => 202],
            ['page' => 'home', 'section' => 'warehouse', 'key' => 'page_type',   'label' => 'Warehouse – Page Type',   'type' => 'text',     'value' => 'rent',       'sort_order' => 203],
            ['page' => 'home', 'section' => 'warehouse', 'key' => 'description', 'label' => 'Warehouse – Description', 'type' => 'html',     'value' => $warehouseContent, 'sort_order' => 204],
            ['page' => 'home', 'section' => 'warehouse', 'key' => 'button_text', 'label' => 'Warehouse – Button Text', 'type' => 'text',     'value' => 'View Warehouses', 'sort_order' => 205],
            ['page' => 'home', 'section' => 'warehouse', 'key' => 'button_url',  'label' => 'Warehouse – Button URL',  'type' => 'url',      'value' => '/properties?status=rent', 'sort_order' => 206],

            // ── OFFICE SPACE (Rent page) ───────────────────────────────────
            ['page' => 'home', 'section' => 'office_space', 'key' => 'visible',     'label' => 'Office Space – Visible',     'type' => 'boolean', 'value' => '1',              'sort_order' => 210],
            ['page' => 'home', 'section' => 'office_space', 'key' => 'title',       'label' => 'Office Space – Title',       'type' => 'text',    'value' => 'Office Space',   'sort_order' => 211],
            ['page' => 'home', 'section' => 'office_space', 'key' => 'subtitle',    'label' => 'Office Space – Subtitle',    'type' => 'text',    'value' => 'To Rent',        'sort_order' => 212],
            ['page' => 'home', 'section' => 'office_space', 'key' => 'page_type',   'label' => 'Office Space – Page Type',   'type' => 'text',    'value' => 'rent',           'sort_order' => 213],
            ['page' => 'home', 'section' => 'office_space', 'key' => 'description', 'label' => 'Office Space – Description', 'type' => 'html',    'value' => $officeContent,   'sort_order' => 214],
            ['page' => 'home', 'section' => 'office_space', 'key' => 'button_text', 'label' => 'Office Space – Button Text', 'type' => 'text',    'value' => 'View Office Spaces', 'sort_order' => 215],
            ['page' => 'home', 'section' => 'office_space', 'key' => 'button_url',  'label' => 'Office Space – Button URL',  'type' => 'url',     'value' => '/properties?status=rent', 'sort_order' => 216],

            // ── LAND (Buy / For Sale page) ─────────────────────────────────
            ['page' => 'home', 'section' => 'land', 'key' => 'visible',     'label' => 'Land – Visible',     'type' => 'boolean', 'value' => '1',       'sort_order' => 220],
            ['page' => 'home', 'section' => 'land', 'key' => 'title',       'label' => 'Land – Title',       'type' => 'text',    'value' => 'Land',    'sort_order' => 221],
            ['page' => 'home', 'section' => 'land', 'key' => 'subtitle',    'label' => 'Land – Subtitle',    'type' => 'text',    'value' => 'For Sale', 'sort_order' => 222],
            ['page' => 'home', 'section' => 'land', 'key' => 'page_type',   'label' => 'Land – Page Type',   'type' => 'text',    'value' => 'buy',     'sort_order' => 223],
            ['page' => 'home', 'section' => 'land', 'key' => 'description', 'label' => 'Land – Description', 'type' => 'html',    'value' => $landContent, 'sort_order' => 224],
            ['page' => 'home', 'section' => 'land', 'key' => 'button_text', 'label' => 'Land – Button Text', 'type' => 'text',    'value' => 'View Land Listings', 'sort_order' => 225],
            ['page' => 'home', 'section' => 'land', 'key' => 'button_url',  'label' => 'Land – Button URL',  'type' => 'url',     'value' => '/properties?status=buy', 'sort_order' => 226],

            // ── DUPLEX (Buy page) ──────────────────────────────────────────
            ['page' => 'home', 'section' => 'duplex', 'key' => 'visible',   'label' => 'Duplex – Visible',   'type' => 'boolean', 'value' => '1',        'sort_order' => 230],
            ['page' => 'home', 'section' => 'duplex', 'key' => 'title',     'label' => 'Duplex – Title',     'type' => 'text',    'value' => 'Duplex',   'sort_order' => 231],
            ['page' => 'home', 'section' => 'duplex', 'key' => 'subtitle',  'label' => 'Duplex – Subtitle',  'type' => 'text',    'value' => 'For Sale', 'sort_order' => 232],
            ['page' => 'home', 'section' => 'duplex', 'key' => 'page_type', 'label' => 'Duplex – Page Type', 'type' => 'text',    'value' => 'buy',      'sort_order' => 233],

            // ── FILLING STATION (Rent + Buy) ───────────────────────────────
            ['page' => 'home', 'section' => 'filling_station', 'key' => 'visible',   'label' => 'Filling Station – Visible',   'type' => 'boolean', 'value' => '1',                'sort_order' => 240],
            ['page' => 'home', 'section' => 'filling_station', 'key' => 'title',     'label' => 'Filling Station – Title',     'type' => 'text',    'value' => 'Filling Station',  'sort_order' => 241],
            ['page' => 'home', 'section' => 'filling_station', 'key' => 'subtitle',  'label' => 'Filling Station – Subtitle',  'type' => 'text',    'value' => 'Rent & Buy',       'sort_order' => 242],
            ['page' => 'home', 'section' => 'filling_station', 'key' => 'page_type', 'label' => 'Filling Station – Page Type', 'type' => 'text',    'value' => 'buy_and_rent',     'sort_order' => 243],

            // ── HOTEL (Rent + Buy) ─────────────────────────────────────────
            ['page' => 'home', 'section' => 'hotel', 'key' => 'visible',   'label' => 'Hotel – Visible',   'type' => 'boolean', 'value' => '1',          'sort_order' => 250],
            ['page' => 'home', 'section' => 'hotel', 'key' => 'title',     'label' => 'Hotel – Title',     'type' => 'text',    'value' => 'Hotel',      'sort_order' => 251],
            ['page' => 'home', 'section' => 'hotel', 'key' => 'subtitle',  'label' => 'Hotel – Subtitle',  'type' => 'text',    'value' => 'Rent & Buy', 'sort_order' => 252],
            ['page' => 'home', 'section' => 'hotel', 'key' => 'page_type', 'label' => 'Hotel – Page Type', 'type' => 'text',    'value' => 'buy_and_rent', 'sort_order' => 253],

            // ── SHORT LET (Short Let page only) ───────────────────────────
            ['page' => 'home', 'section' => 'short_let', 'key' => 'visible',   'label' => 'Short Let – Visible',   'type' => 'boolean', 'value' => '1',        'sort_order' => 260],
            ['page' => 'home', 'section' => 'short_let', 'key' => 'title',     'label' => 'Short Let – Title',     'type' => 'text',    'value' => 'Short Let', 'sort_order' => 261],
            ['page' => 'home', 'section' => 'short_let', 'key' => 'subtitle',  'label' => 'Short Let – Subtitle',  'type' => 'text',    'value' => 'Short Let Only', 'sort_order' => 262],
            ['page' => 'home', 'section' => 'short_let', 'key' => 'page_type', 'label' => 'Short Let – Page Type', 'type' => 'text',    'value' => 'shortlet',  'sort_order' => 263],
        ];

        foreach ($entries as $entry) {
            DB::table('page_contents')->updateOrInsert(
                ['page' => $entry['page'], 'section' => $entry['section'], 'key' => $entry['key']],
                array_merge($entry, ['created_at' => $now, 'updated_at' => $now])
            );
        }
    }

    public function down(): void
    {
        $sections = ['warehouse', 'office_space', 'land', 'duplex', 'filling_station', 'hotel', 'short_let'];
        DB::table('page_contents')
            ->where('page', 'home')
            ->whereIn('section', $sections)
            ->delete();
    }
};
