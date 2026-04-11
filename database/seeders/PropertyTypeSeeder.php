<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\PropertyType;

class PropertyTypeSeeder extends Seeder {
    public function run(): void {
        $types = [
            ['name'=>'Residential Land','icon'=>'🏡','description'=>'Residential plots for building homes'],
            ['name'=>'Commercial Land','icon'=>'🏢','description'=>'Commercial plots for business development'],
            ['name'=>'Duplex','icon'=>'🏘','description'=>'Semi-detached and detached duplexes'],
            ['name'=>'Apartment','icon'=>'🏬','description'=>'Luxury apartments and flats'],
            ['name'=>'Estate House','icon'=>'🏠','description'=>'Houses within gated estates'],
            ['name'=>'Mixed Use','icon'=>'🏗','description'=>'Mixed commercial and residential'],
        ];
        foreach($types as $t) PropertyType::firstOrCreate(['name'=>$t['name']], $t);
    }
}
