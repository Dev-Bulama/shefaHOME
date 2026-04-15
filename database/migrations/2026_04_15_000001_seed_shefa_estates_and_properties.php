<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

/**
 * Seeds the 4 real Shefa Homes estates and properties.
 * Uses DB::table() so it runs without a vendor install (php artisan migrate).
 */
return new class extends Migration
{
    public function up(): void
    {
        $now = now();

        // ── Estates ──────────────────────────────────────────────────────────────
        $estates = [
            [
                'name'        => 'Papalantoro Estate',
                'slug'        => 'papalantoro-estate',
                'state'       => 'Ogun',
                'description' => 'A strategic land asset in the fast-rising growth corridor of Papalantoro, Ifo — just 48km to Ikeja, near Lafarge Africa Plc, Federal Polytechnic Ilaro, and Government Technical College Ajegunle.',
                'cover_image' => '',
                'is_active'   => 1,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'name'        => 'Mojoda Estate',
                'slug'        => 'mojoda-estate',
                'state'       => 'Lagos',
                'description' => "Premium coastal investment within the thriving and rapidly expanding Epe corridor, one of Lagos' most promising growth zones. Near the Dangote Refinery, Epe Resort & Spa, Yaba College of Technology Epe Campus, and Lagos State University of Education.",
                'cover_image' => '',
                'is_active'   => 1,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'name'        => 'Belmont Estate',
                'slug'        => 'belmont-estate',
                'state'       => 'Lagos',
                'description' => 'An exclusive mini estate thoughtfully positioned just beyond the Dangote Refinery axis, Ode-Omi. Designed for exclusivity and controlled development within the Ibeju-Lekki corridor.',
                'cover_image' => '',
                'is_active'   => 1,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'name'        => 'Aurelia Estate',
                'slug'        => 'aurelia-estate',
                'state'       => 'Lagos',
                'description' => "A prime investment address within the same high-growth corridor as Epe, Ibeju-Lekki. Surrounded by transformative infrastructure including the Dangote Refinery, Lekki Free Trade Zone, and the evolving coastal economy.",
                'cover_image' => '',
                'is_active'   => 1,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
        ];

        foreach ($estates as $e) {
            if (! DB::table('estates')->where('slug', $e['slug'])->exists()) {
                DB::table('estates')->insert($e);
            }
        }

        // ── Property type lookup ──────────────────────────────────────────────────
        $typeId = DB::table('property_types')->where('name', 'Residential Land')->value('id')
               ?? DB::table('property_types')->value('id');

        // ── Properties ───────────────────────────────────────────────────────────
        $properties = [

            // 1. Papalantoro
            [
                'title'             => 'Papalantoro Estate — Ifo, Ogun State',
                'estate_slug'       => 'papalantoro-estate',
                'state'             => 'Ogun',
                'lga'               => 'Ifo',
                'address'           => 'Papalantoro, Ifo, Ogun State',
                'price_from'        => 1000000.00,
                'price_to'          => 1500000.00,
                'status'            => 'available',
                'is_featured'       => 1,
                'short_description' => 'A strategic land asset in the fast-rising growth corridor of Papalantoro, Ifo — just 48km to Ikeja. Registered Survey. Dry, build-ready terrain with flexible plot sizes.',
                'plot_sizes'        => json_encode(['300sqm', '500sqm']),
                'payment_plans'     => json_encode([
                    ['name' => 'Outright (300sqm)', 'duration' => 'Immediate', 'deposit' => 100, 'monthly' => 0, 'price' => 1000000],
                    ['name' => 'Outright (500sqm)', 'duration' => 'Immediate', 'deposit' => 100, 'monthly' => 0, 'price' => 1500000],
                ]),
                'description' => '<p>A Strategic Land Asset by Shefa Homes &amp; Properties</p>

<p>Positioned within the fast-rising growth corridor of Papalantoro, Ifo, this exclusive land offering presents a rare opportunity to secure a high-potential asset with seamless connectivity to Lagos.</p>

<p>Just 48km to Ikeja, and within minutes of Lafarge Africa Plc, Federal Polytechnic Ilaro, and Government Technical College Ajegunle, this location is primed for capital appreciation and strategic residential development.</p>

<h3>Available Plots</h3>
<ul>
  <li>500sqm — ₦1,500,000</li>
  <li>300sqm — ₦1,000,000</li>
</ul>

<h3>Title &amp; Documentation</h3>
<ul>
  <li>Registered Survey</li>
  <li>Deed of Assignment</li>
  <li>Official Receipt</li>
  <li>Allocation Letter</li>
</ul>

<h3>Estate Features</h3>
<ul>
  <li>Dry, build-ready terrain</li>
  <li>Accessible road network</li>
  <li>Peaceful residential environment</li>
  <li>Proximity to key institutions &amp; industrial hubs</li>
  <li>High-growth investment corridor</li>
</ul>

<p>An intelligently positioned acquisition for discerning investors seeking value, growth, and long-term security.</p>

<p><em>Shefa Homes &amp; Properties — Where every home tells a story.</em></p>',
            ],

            // 2. Mojoda
            [
                'title'             => 'Mojoda Estate — Epe, Lagos',
                'estate_slug'       => 'mojoda-estate',
                'state'             => 'Lagos',
                'lga'               => 'Epe',
                'address'           => 'Mojoda, Epe, Lagos',
                'price_from'        => 6000000.00,
                'price_to'          => 8000000.00,
                'status'            => 'available',
                'is_featured'       => 1,
                'short_description' => "Premium coastal investment in the thriving Epe corridor, Lagos. Near the Dangote Refinery, Epe Resort & Spa, and key institutions. High-value opportunity with strong ROI potential.",
                'plot_sizes'        => json_encode(['300sqm', '500sqm']),
                'payment_plans'     => json_encode([
                    ['name' => 'Outright (300sqm)', 'duration' => 'Immediate', 'deposit' => 100, 'monthly' => 0, 'price' => 6000000],
                    ['name' => 'Outright (500sqm)', 'duration' => 'Immediate', 'deposit' => 100, 'monthly' => 0, 'price' => 8000000],
                ]),
                'description' => "<p>Premium Coastal Investment by Shefa Homes &amp; Properties</p>

<p>Nestled within the thriving and rapidly expanding Epe corridor, this premium land offering at Mojoda presents a high-value investment opportunity in one of Lagos' most promising growth zones. With strong government and private sector developments shaping the area, this is a strategic acquisition for forward-thinking investors.</p>

<p>Located within proximity to the Dangote Refinery, Epe Resort &amp; Spa, Yaba College of Technology Epe Campus, and Lagos State University of Education, the environment is primed for rapid urbanization, rental demand, and long-term capital appreciation.</p>

<h3>Available Plots</h3>
<ul>
  <li>500sqm — ₦8,000,000</li>
  <li>300sqm — ₦6,000,000</li>
</ul>

<h3>Title &amp; Documentation</h3>
<ul>
  <li>Provisional Survey</li>
  <li>Deed of Assignment</li>
  <li>Official Receipt</li>
  <li>Letter of Allocation</li>
</ul>

<h3>Estate Features</h3>
<ul>
  <li>Dry, build-ready terrain</li>
  <li>Well-planned and accessible road network</li>
  <li>Serene and secure residential environment</li>
  <li>Proximity to key institutions and commercial hubs</li>
  <li>Fast-developing neighborhood with strong ROI potential</li>
</ul>

<p>An exceptional opportunity to secure a premium landholding within Lagos' new economic frontier.</p>

<p><em>Shefa Homes &amp; Properties — Building Assets. Securing Futures.</em></p>",
            ],

            // 3. Belmont — SOLD OUT
            [
                'title'             => 'Belmont Estate — Ode-Omi, Ibeju-Lekki',
                'estate_slug'       => 'belmont-estate',
                'state'             => 'Lagos',
                'lga'               => 'Ibeju-Lekki',
                'address'           => 'Ode-Omi (After Dangote Refinery), Ibeju-Lekki, Lagos',
                'price_from'        => 0.00,
                'price_to'          => null,
                'status'            => 'sold_out',
                'is_featured'       => 1,
                'short_description' => 'An exclusive mini estate boutique development just beyond the Dangote Refinery axis, Ode-Omi. Designed for exclusivity and controlled development within the Ibeju-Lekki corridor. NOW SOLD OUT.',
                'plot_sizes'        => json_encode(['300sqm', '500sqm']),
                'payment_plans'     => json_encode([]),
                'description' => '<p><strong>SOLD OUT</strong></p>

<p><strong>BELMONT ESTATE, ODE-OMI (AFTER REFINERY)</strong></p>
<p>An Exclusive Mini Estate Investment</p>

<p>Introducing Belmont Estate, Ode-Omi — a boutique mini estate thoughtfully positioned just beyond the Dangote Refinery axis. Designed for exclusivity and controlled development, this estate offers a rare blend of affordability, privacy, and strategic location within the expanding Ibeju-Lekki corridor.</p>

<p>Perfect for investors and homeowners seeking a more intimate estate setting without compromising on growth potential.</p>

<h3>Available Plots</h3>
<ul>
  <li>500sqm</li>
  <li>300sqm</li>
</ul>

<h3>Title &amp; Documentation</h3>
<ul>
  <li>Survey</li>
  <li>Deed of Assignment</li>
  <li>Official Receipt</li>
  <li>Letter of Allocation</li>
</ul>

<h3>Estate Features</h3>
<ul>
  <li>Dry and ready-to-build land</li>
  <li>Mini estate layout with defined structure</li>
  <li>Accessible road network</li>
  <li>Peaceful and private residential setting</li>
  <li>Close proximity to key industrial and coastal developments</li>
  <li>Strong appreciation potential within a developing axis</li>
</ul>

<p>A smart, exclusive acquisition for those who value both location and controlled estate living.</p>

<p><em>Shefa Homes &amp; Properties — Building Assets. Securing Futures.</em></p>',
            ],

            // 4. Aurelia — COMING SOON
            [
                'title'             => 'Aurelia Estate — Ibeju-Lekki, Lagos',
                'estate_slug'       => 'aurelia-estate',
                'state'             => 'Lagos',
                'lga'               => 'Ibeju-Lekki',
                'address'           => 'Ibeju-Lekki, Lagos',
                'price_from'        => 0.00,
                'price_to'          => null,
                'status'            => 'coming_soon',
                'is_featured'       => 1,
                'short_description' => 'A prime investment address within the high-growth Ibeju-Lekki corridor. Near the Dangote Refinery and Lekki Free Trade Zone. Price on Request.',
                'plot_sizes'        => json_encode(['300sqm', '500sqm']),
                'payment_plans'     => json_encode([]),
                'description' => '<p><strong>COMING SOON</strong></p>

<p><strong>AURELIA ESTATE, IBEJU-LEKKI</strong></p>
<p>A Prime Investment Address by Shefa Homes &amp; Properties</p>

<p>Strategically positioned within the same high-growth corridor as Epe, Aurelia Estate, Ibeju-Lekki offers a premium gateway into Lagos\' fastest-developing investment zone. Surrounded by transformative infrastructure and large-scale developments, this location is designed for investors seeking strong capital appreciation and future-forward living.</p>

<p>In close proximity to the Dangote Refinery, Lekki Free Trade Zone, and the evolving coastal economy, Aurelia Estate stands at the center of Lagos\' new economic frontier.</p>

<h3>Available Plots</h3>
<ul>
  <li>500sqm — Price on Request</li>
  <li>300sqm — Price on Request</li>
</ul>

<h3>Title &amp; Documentation</h3>
<ul>
  <li>Survey</li>
  <li>Deed of Assignment</li>
  <li>Official Receipt</li>
  <li>Letter of Allocation</li>
</ul>

<h3>Estate Features</h3>
<ul>
  <li>Dry, build-ready land</li>
  <li>Well-structured layout and road network</li>
  <li>Serene and secure environment</li>
  <li>Proximity to major developments and commercial hubs</li>
  <li>High-growth corridor with exceptional ROI potential</li>
</ul>

<p>A refined opportunity to secure land within a globally emerging investment destination.</p>

<p><em>Shefa Homes &amp; Properties — Building Assets. Securing Futures.</em></p>',
            ],
        ];

        foreach ($properties as $p) {
            $slug    = Str::slug($p['title']);
            $estateId = DB::table('estates')->where('slug', $p['estate_slug'])->value('id');

            if (DB::table('properties')->where('slug', $slug)->exists()) {
                continue;
            }

            DB::table('properties')->insert([
                'title'             => $p['title'],
                'slug'              => $slug,
                'property_type_id'  => $typeId,
                'estate_id'         => $estateId,
                'short_description' => $p['short_description'],
                'description'       => $p['description'],
                'state'             => $p['state'],
                'lga'               => $p['lga'],
                'address'           => $p['address'],
                'price_from'        => $p['price_from'],
                'price_to'          => $p['price_to'],
                'plot_sizes'        => $p['plot_sizes'],
                'payment_plans'     => $p['payment_plans'],
                'cover_image'       => 'properties/placeholder.jpg',
                'is_featured'       => $p['is_featured'],
                'is_active'         => 1,
                'status'            => $p['status'],
                'total_units'       => null,
                'available_units'   => null,
                'created_at'        => $now,
                'updated_at'        => $now,
            ]);
        }
    }

    public function down(): void
    {
        $slugs = [
            'papalantoro-estate-ifo-ogun-state',
            'mojoda-estate-epe-lagos',
            'belmont-estate-ode-omi-ibeju-lekki',
            'aurelia-estate-ibeju-lekki-lagos',
        ];
        DB::table('properties')->whereIn('slug', $slugs)->delete();

        $estateSlugs = ['papalantoro-estate','mojoda-estate','belmont-estate','aurelia-estate'];
        DB::table('estates')->whereIn('slug', $estateSlugs)->delete();
    }
};
