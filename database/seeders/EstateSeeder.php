<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Estate;

class EstateSeeder extends Seeder {
    public function run(): void {
        $estates = [
            ['name'=>'Shefahomes Lekki Gardens','slug'=>'lekki-gardens','state'=>'Lagos','description'=>'Premium residential estate in the heart of Lekki with modern infrastructure.','cover_image'=>''],
            ['name'=>'Shefahomes Abuja City Estate','slug'=>'abuja-city-estate','state'=>'Abuja','description'=>'Exclusive residential estate in Abuja with serene environment.','cover_image'=>''],
            ['name'=>'Shefahomes PH Waterfront','slug'=>'ph-waterfront','state'=>'Rivers','description'=>'Waterfront luxury estate in Port Harcourt with panoramic views.','cover_image'=>''],
            ['name'=>'Shefahomes Ibadan Greenfield','slug'=>'ibadan-greenfield','state'=>'Oyo','description'=>'Affordable luxury estate in Ibadan with flexible payment plans.','cover_image'=>''],
        ];
        foreach($estates as $e) Estate::firstOrCreate(['slug'=>$e['slug']], $e + ['is_active'=>true]);
    }
}
