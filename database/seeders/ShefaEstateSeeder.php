<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Estate;

class ShefaEstateSeeder extends Seeder {
    public function run(): void {
        $estates = [
            [
                'name'        => 'Papalantoro Estate',
                'slug'        => 'papalantoro-estate',
                'state'       => 'Ogun',
                'description' => 'A strategic land asset in the fast-rising growth corridor of Papalantoro, Ifo — just 48km to Ikeja, near Lafarge Africa Plc, Federal Polytechnic Ilaro, and Government Technical College Ajegunle.',
                'cover_image' => '',
                'is_active'   => true,
            ],
            [
                'name'        => 'Mojoda Estate',
                'slug'        => 'mojoda-estate',
                'state'       => 'Lagos',
                'description' => 'Premium coastal investment within the thriving and rapidly expanding Epe corridor, one of Lagos\' most promising growth zones. Near the Dangote Refinery, Epe Resort & Spa, Yaba College of Technology Epe Campus, and Lagos State University of Education.',
                'cover_image' => '',
                'is_active'   => true,
            ],
            [
                'name'        => 'Belmont Estate',
                'slug'        => 'belmont-estate',
                'state'       => 'Lagos',
                'description' => 'An exclusive mini estate thoughtfully positioned just beyond the Dangote Refinery axis, Ode-Omi. Designed for exclusivity and controlled development within the Ibeju-Lekki corridor.',
                'cover_image' => '',
                'is_active'   => true,
            ],
            [
                'name'        => 'Aurelia Estate',
                'slug'        => 'aurelia-estate',
                'state'       => 'Lagos',
                'description' => 'A prime investment address within the same high-growth corridor as Epe, Ibeju-Lekki. Surrounded by transformative infrastructure including the Dangote Refinery, Lekki Free Trade Zone, and the evolving coastal economy.',
                'cover_image' => '',
                'is_active'   => true,
            ],
        ];
        foreach ($estates as $e) {
            Estate::firstOrCreate(['slug' => $e['slug']], $e);
        }
    }
}
