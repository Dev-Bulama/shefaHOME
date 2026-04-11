<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\{Property, PropertyType, Estate};
use Illuminate\Support\Str;

class PropertySeeder extends Seeder {
    public function run(): void {
        $type = PropertyType::where('name','Residential Land')->first();
        $estate = Estate::first();
        $properties = [
            ['title'=>'Lekki Phase 2 Gardens','state'=>'Lagos','lga'=>'Eti-Osa','address'=>'Behind Lekki-Epe Expressway','price_from'=>15000000,'status'=>'available','is_featured'=>true],
            ['title'=>'Abuja Apo District Estate','state'=>'Abuja','lga'=>'Apo','address'=>'Apo Resettlement, Abuja','price_from'=>20000000,'status'=>'available','is_featured'=>true],
            ['title'=>'Port Harcourt Waterfront Plots','state'=>'Rivers','lga'=>'Obio-Akpor','address'=>'Rumuola Road, PH','price_from'=>12000000,'status'=>'available','is_featured'=>true],
            ['title'=>'Ibadan Greenfield Estate','state'=>'Oyo','lga'=>'Egbeda','address'=>'Akala Expressway, Ibadan','price_from'=>8000000,'status'=>'available','is_featured'=>false],
            ['title'=>'Lagos Ibeju-Lekki Plots','state'=>'Lagos','lga'=>'Ibeju-Lekki','address'=>'Free Trade Zone Road','price_from'=>6000000,'status'=>'available','is_featured'=>true],
            ['title'=>'Ogun Model City Estate','state'=>'Ogun','lga'=>'Sagamu','address'=>'Lagos-Ibadan Expressway','price_from'=>5500000,'status'=>'coming_soon','is_featured'=>false],
            ['title'=>'Enugu GRA Extension','state'=>'Enugu','lga'=>'Enugu North','address'=>'Trans-Ekulu, Enugu','price_from'=>9000000,'status'=>'available','is_featured'=>false],
            ['title'=>'Kano Nassarawa Estate','state'=>'Kano','lga'=>'Nassarawa','address'=>'Zoo Road, Kano','price_from'=>7000000,'status'=>'available','is_featured'=>false],
            ['title'=>'Benin City Royal Estate','state'=>'Edo','lga'=>'Oredo','address'=>'Airport Road, Benin City','price_from'=>10000000,'status'=>'available','is_featured'=>true],
            ['title'=>'Calabar Waterside Estate','state'=>'Cross River','lga'=>'Calabar South','address'=>'Marian Road, Calabar','price_from'=>11000000,'status'=>'available','is_featured'=>false],
        ];
        $imageId = 100;
        foreach($properties as $p) {
            $plotSizes = json_encode(['300sqm','450sqm','600sqm','750sqm']);
            $paymentPlans = json_encode([
                ['name'=>'Outright','duration'=>'Immediate','deposit'=>100,'monthly'=>0],
                ['name'=>'6 Months','duration'=>'6 months','deposit'=>40,'monthly'=>60],
                ['name'=>'12 Months','duration'=>'12 months','deposit'=>30,'monthly'=>70],
                ['name'=>'24 Months','duration'=>'24 months','deposit'=>20,'monthly'=>80],
            ]);
            Property::firstOrCreate(['slug' => Str::slug($p['title'])], array_merge($p, [
                'property_type_id' => $type->id,
                'estate_id' => $estate->id,
                'short_description' => 'Premium estate land in '.($p['state']).'. Government approved title. Flexible payment plans available.',
                'description' => '<p>Welcome to '.($p['title']).', one of SHEFAHOMES\' flagship estates located in '.($p['state']).'. This premium estate offers well-surveyed and government-approved residential plots in a serene and secured environment with excellent road networks and infrastructure.</p><h3>Key Features</h3><ul><li>Registered Survey Plan</li><li>Governor\'s Consent</li><li>Perimeter Fencing</li><li>Good Road Network</li><li>Security Post</li><li>24/7 Power Supply (Solar)</li></ul>',
                'lga' => $p['lga'],
                'plot_sizes' => $plotSizes,
                'payment_plans' => $paymentPlans,
                'cover_image' => 'properties/placeholder-'.$imageId.'.jpg',
                'is_active' => true,
                'total_units' => 200,
                'available_units' => rand(50, 180),
            ]));
            $imageId++;
        }
    }
}
