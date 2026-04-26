<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

return new class extends Migration {
    public function up(): void
    {
        $now = now();

        // ── 1. Ensure all required property types exist ─────────────────────
        $types = [
            ['name' => 'Warehouse',        'icon' => '🏭', 'listing_type' => 'rent',         'description' => 'Industrial & logistics warehouse spaces for rent'],
            ['name' => 'Office Space',     'icon' => '🏢', 'listing_type' => 'rent',         'description' => 'Corporate and commercial office spaces for rent'],
            ['name' => 'Land',             'icon' => '🌍', 'listing_type' => 'buy',          'description' => 'Residential, commercial and industrial land for sale'],
            ['name' => 'Duplex',           'icon' => '🏘️', 'listing_type' => 'buy',          'description' => 'Semi-detached and detached duplexes for sale'],
            ['name' => 'Filling Station',  'icon' => '⛽', 'listing_type' => 'buy_and_rent', 'description' => 'Filling station properties for rent or sale'],
            ['name' => 'Hotel',            'icon' => '🏨', 'listing_type' => 'buy_and_rent', 'description' => 'Hotel properties for rent or sale'],
            ['name' => 'Short Let',        'icon' => '🛏️', 'listing_type' => 'shortlet',     'description' => 'Short-term furnished apartments and homes'],
            ['name' => 'Residential Land', 'icon' => '🏡', 'listing_type' => 'buy',          'description' => 'Residential plots for building homes'],
            ['name' => 'Apartment',        'icon' => '🏬', 'listing_type' => 'buy',          'description' => 'Luxury apartments and flats'],
        ];

        foreach ($types as $t) {
            $existing = DB::table('property_types')->where('name', $t['name'])->first();
            if ($existing) {
                DB::table('property_types')->where('id', $existing->id)
                  ->update(['listing_type' => $t['listing_type'], 'updated_at' => $now]);
            } else {
                DB::table('property_types')->insert(array_merge($t, [
                    'slug'       => Str::slug($t['name']),
                    'created_at' => $now,
                    'updated_at' => $now,
                ]));
            }
        }

        // ── 2. Resolve type IDs ─────────────────────────────────────────────
        $typeIds = DB::table('property_types')->pluck('id', 'name');

        // ── 3. Dummy property definitions ────────────────────────────────────
        $props = [

            // WAREHOUSE (rent) ───────────────────────────────────────────────
            ['title'=>'Ikeja Industrial Warehouse A','lga'=>'Ikeja','state'=>'Lagos','address'=>'Oregun Road, Ikeja Industrial Estate','price_from'=>500000,'status'=>'rent','type'=>'Warehouse','short_desc'=>'Large-capacity warehouse in Oregun Industrial Estate with loading bays and 24/7 power supply.'],
            ['title'=>'Lagos/Ibadan Expressway Warehouse','lga'=>'Ojodu','state'=>'Lagos','address'=>'KM 20, Lagos/Ibadan Expressway','price_from'=>350000,'status'=>'rent','type'=>'Warehouse','short_desc'=>'Strategic logistics warehouse with easy highway access, loading docks and secure yard.'],
            ['title'=>'Ota Industrial Warehouse','lga'=>'Ado-Odo/Ota','state'=>'Ogun','address'=>'Agbara Industrial Estate, Ota, Ogun State','price_from'=>280000,'status'=>'rent','type'=>'Warehouse','short_desc'=>'Modern warehouse facility in Agbara Industrial Estate ideal for manufacturing and distribution.'],

            // OFFICE SPACE (rent) ────────────────────────────────────────────
            ['title'=>'GRA Ikeja Corporate Office','lga'=>'Ikeja','state'=>'Lagos','address'=>'Mobolaji Bank Anthony Way, GRA Ikeja','price_from'=>200000,'status'=>'rent','type'=>'Office Space','short_desc'=>'Premium corporate office floor in GRA Ikeja with parking, 24/7 power and high-speed internet.'],
            ['title'=>'Lekki Phase 1 Office Suite','lga'=>'Lekki','state'=>'Lagos','address'=>'Admiralty Way, Lekki Phase 1','price_from'=>350000,'status'=>'rent','type'=>'Office Space','short_desc'=>'Modern open-plan and private office suites in Lekki Phase 1 commercial hub.'],
            ['title'=>'Ikoyi Executive Office','lga'=>'Ikoyi','state'=>'Lagos','address'=>'Alfred Rewane Road, Ikoyi','price_from'=>500000,'status'=>'rent','type'=>'Office Space','short_desc'=>'High-end executive office space in prestigious Ikoyi with stunning views and full facilities.'],

            // LAND (buy) ─────────────────────────────────────────────────────
            ['title'=>'Magodo Residential Land','lga'=>'Magodo','state'=>'Lagos','address'=>'Phase 2, Magodo, Lagos','price_from'=>8000000,'status'=>'buy','type'=>'Land','short_desc'=>'Prime residential plot in Magodo Phase 2 with C of O, ready for immediate development.'],
            ['title'=>'Ajah Corridor Land','lga'=>'Ajah','state'=>'Lagos','address'=>'Sangotedo, Ajah Corridor, Lagos','price_from'=>3500000,'status'=>'buy','type'=>'Land','short_desc'=>'Fast-appreciating land in the Sangotedo/Ajah corridor — ideal for residential or commercial development.'],
            ['title'=>'Ota Industrial Land','lga'=>'Ado-Odo/Ota','state'=>'Ogun','address'=>'Lagos-Abeokuta Expressway, Ota','price_from'=>2000000,'status'=>'buy','type'=>'Land','short_desc'=>'Large industrial plot on Lagos/Abeokuta Expressway suitable for factories, warehouses and logistics.'],

            // DUPLEX (buy) ───────────────────────────────────────────────────
            ['title'=>'Magodo 4-Bedroom Duplex','lga'=>'Magodo','state'=>'Lagos','address'=>'Shangisha, Magodo Phase 2','price_from'=>85000000,'status'=>'buy','type'=>'Duplex','short_desc'=>'Elegant 4-bedroom semi-detached duplex in a serene Magodo estate with BQ, parking and security.'],
            ['title'=>'Lekki 5-Bedroom Detached Duplex','lga'=>'Lekki','state'=>'Lagos','address'=>'Ikate Elegushi, Lekki','price_from'=>150000000,'status'=>'buy','type'=>'Duplex','short_desc'=>'Luxury 5-bedroom detached duplex in Lekki with swimming pool, smart home features and double BQ.'],
            ['title'=>'Surulere 3-Bedroom Duplex','lga'=>'Surulere','state'=>'Lagos','address'=>'Aguda, Surulere, Lagos','price_from'=>55000000,'status'=>'buy','type'=>'Duplex','short_desc'=>'Spacious 3-bedroom semi-detached duplex in central Surulere, close to major roads and amenities.'],

            // FILLING STATION (buy_and_rent) ─────────────────────────────────
            ['title'=>'Ikeja Filling Station — For Sale','lga'=>'Ikeja','state'=>'Lagos','address'=>'Oba Akran Avenue, Ikeja','price_from'=>120000000,'status'=>'buy','type'=>'Filling Station','short_desc'=>'Operational filling station on high-traffic Oba Akran Avenue, Ikeja — with DPR licence and tanks.'],
            ['title'=>'Ikorodu Road Filling Station — For Rent','lga'=>'Ikorodu','state'=>'Lagos','address'=>'Ikorodu Road, Lagos','price_from'=>3000000,'status'=>'rent','type'=>'Filling Station','short_desc'=>'Well-positioned filling station on Ikorodu Road available for lease — high daily traffic volume.'],
            ['title'=>'Ota Filling Station — Rent or Buy','lga'=>'Ado-Odo/Ota','state'=>'Ogun','address'=>'Lagos-Abeokuta Expressway, Ota','price_from'=>2500000,'status'=>'buy_and_rent','type'=>'Filling Station','short_desc'=>'Filling station facility on expressway corridor available for outright purchase or long-term lease.'],

            // HOTEL (buy_and_rent) ────────────────────────────────────────────
            ['title'=>'Ikeja 20-Room Boutique Hotel','lga'=>'Ikeja','state'=>'Lagos','address'=>'Obafemi Awolowo Way, Ikeja','price_from'=>250000000,'status'=>'buy','type'=>'Hotel','short_desc'=>'Fully operational 20-room boutique hotel with restaurant and event hall in prime Ikeja location.'],
            ['title'=>'Lekki Serviced Hotel — For Rent','lga'=>'Lekki','state'=>'Lagos','address'=>'Lekki Phase 1, Lagos','price_from'=>8000000,'status'=>'rent','type'=>'Hotel','short_desc'=>'Established serviced hotel in Lekki Phase 1 — all rooms furnished, operational and income-generating.'],
            ['title'=>'Agbara Hotel Property','lga'=>'Ado-Odo/Ota','state'=>'Ogun','address'=>'Agbara Industrial Layout, Ogun State','price_from'=>80000000,'status'=>'buy_and_rent','type'=>'Hotel','short_desc'=>'Hotel property in Agbara catering to corporate clients — available for purchase or management lease.'],

            // SHORT LET (shortlet) ────────────────────────────────────────────
            ['title'=>'Lekki Luxury 2-Bed Short Let','lga'=>'Lekki','state'=>'Lagos','address'=>'Lekki Phase 1, Lagos','price_from'=>75000,'status'=>'shortlet','type'=>'Short Let','short_desc'=>'Stunning fully-furnished 2-bedroom apartment in Lekki Phase 1, available for short stays — daily and weekly.'],
            ['title'=>'Victoria Island Executive Short Let','lga'=>'Victoria Island','state'=>'Lagos','address'=>'Ahmadu Bello Way, Victoria Island','price_from'=>120000,'status'=>'shortlet','type'=>'Short Let','short_desc'=>'Premium 3-bedroom executive apartment on Victoria Island — perfect for business travellers and executives.'],
            ['title'=>'Ikeja GRA Studio Short Let','lga'=>'Ikeja','state'=>'Lagos','address'=>'GRA, Ikeja, Lagos','price_from'=>35000,'status'=>'shortlet','type'=>'Short Let','short_desc'=>'Cosy fully-furnished studio apartment in Ikeja GRA available for daily, weekly or monthly short stays.'],

            // APARTMENT ──────────────────────────────────────────────────────
            ['title'=>'Oniru 3-Bed Luxury Apartment','lga'=>'Victoria Island','state'=>'Lagos','address'=>'Oniru Estate, Victoria Island Extension','price_from'=>95000000,'status'=>'buy','type'=>'Apartment','short_desc'=>'High-rise 3-bedroom luxury apartment in Oniru with gym, pool and 24/7 power.'],
            ['title'=>'Ikeja GRA 2-Bed Apartment','lga'=>'Ikeja','state'=>'Lagos','address'=>'GRA, Ikeja, Lagos','price_from'=>45000000,'status'=>'buy','type'=>'Apartment','short_desc'=>'Well-finished 2-bedroom apartment in a quiet GRA estate with ample parking and excellent security.'],
            ['title'=>'Surulere 3-Bed Apartment','lga'=>'Surulere','state'=>'Lagos','address'=>'Bode Thomas, Surulere','price_from'=>35000000,'status'=>'available','type'=>'Apartment','short_desc'=>'Tastefully finished 3-bedroom apartment in a well-maintained Surulere block — flexible payment terms.'],

            // RESIDENTIAL LAND ───────────────────────────────────────────────
            ['title'=>'Lekki Phase 2 Residential Plot','lga'=>'Lekki','state'=>'Lagos','address'=>'Phase 2, Lekki','price_from'=>12000000,'status'=>'buy','type'=>'Residential Land','short_desc'=>'Dry land in fast-developing Lekki Phase 2 — Gazette title, ready for immediate construction.'],
            ['title'=>'Mowe Residential Plot','lga'=>'Obafemi-Owode','state'=>'Ogun','address'=>'Mowe/Ofada, Ogun State','price_from'=>800000,'status'=>'available','type'=>'Residential Land','short_desc'=>'Affordable residential plot in Mowe with registered survey — easy access to Lagos via expressway.'],
            ['title'=>'Ikorodu Estate Plot','lga'=>'Ikorodu','state'=>'Lagos','address'=>'Ijede Road, Ikorodu','price_from'=>2500000,'status'=>'available','type'=>'Residential Land','short_desc'=>'Estate residential land in a gated layout at Ikorodu — perfect for building a family home.'],
        ];

        // ── 4. Insert properties (skip if title already exists) ───────────────
        $coverImages = [
            'properties/dummy-warehouse.jpg',
            'properties/dummy-office.jpg',
            'properties/dummy-land.jpg',
            'properties/dummy-house.jpg',
        ];

        foreach ($props as $i => $p) {
            if (DB::table('properties')->where('title', $p['title'])->exists()) continue;

            $typeId = $typeIds[$p['type']] ?? null;
            if (!$typeId) continue;

            $slug = Str::slug($p['title']);
            $counter = 1;
            while (DB::table('properties')->where('slug', $slug)->exists()) {
                $slug = Str::slug($p['title']) . '-' . $counter++;
            }

            DB::table('properties')->insert([
                'title'             => $p['title'],
                'slug'              => $slug,
                'property_type_id'  => $typeId,
                'estate_id'         => null,
                'short_description' => $p['short_desc'],
                'description'       => '<p>' . $p['short_desc'] . '</p><p>Contact Shefa Homes for full details, inspection scheduling and pricing information tailored to your requirements.</p>',
                'state'             => $p['state'],
                'lga'               => $p['lga'],
                'address'           => $p['address'],
                'price_from'        => $p['price_from'],
                'price_to'          => null,
                'plot_sizes'        => null,
                'payment_plans'     => null,
                'cover_image'       => $coverImages[$i % count($coverImages)],
                'is_featured'       => $i < 6 ? 1 : 0,
                'is_active'         => 1,
                'status'            => $p['status'],
                'virtual_tour_url'  => null,
                'video_url'         => null,
                'total_units'       => null,
                'available_units'   => null,
                'created_at'        => $now,
                'updated_at'        => $now,
            ]);
        }
    }

    public function down(): void
    {
        $titles = [
            'Ikeja Industrial Warehouse A','Lagos/Ibadan Expressway Warehouse','Ota Industrial Warehouse',
            'GRA Ikeja Corporate Office','Lekki Phase 1 Office Suite','Ikoyi Executive Office',
            'Magodo Residential Land','Ajah Corridor Land','Ota Industrial Land',
            'Magodo 4-Bedroom Duplex','Lekki 5-Bedroom Detached Duplex','Surulere 3-Bedroom Duplex',
            'Ikeja Filling Station — For Sale','Ikorodu Road Filling Station — For Rent','Ota Filling Station — Rent or Buy',
            'Ikeja 20-Room Boutique Hotel','Lekki Serviced Hotel — For Rent','Agbara Hotel Property',
            'Lekki Luxury 2-Bed Short Let','Victoria Island Executive Short Let','Ikeja GRA Studio Short Let',
            'Oniru 3-Bed Luxury Apartment','Ikeja GRA 2-Bed Apartment','Surulere 3-Bed Apartment',
            'Lekki Phase 2 Residential Plot','Mowe Residential Plot','Ikorodu Estate Plot',
        ];
        DB::table('properties')->whereIn('title', $titles)->delete();
    }
};
