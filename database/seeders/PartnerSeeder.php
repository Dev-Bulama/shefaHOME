<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Partner;

class PartnerSeeder extends Seeder {
    public function run(): void {
        $partners = [
            ['name'=>'Lagos State Government','sort_order'=>1],
            ['name'=>'Abuja Investment Agency','sort_order'=>2],
            ['name'=>'First Bank Nigeria','sort_order'=>3],
            ['name'=>'Access Bank','sort_order'=>4],
            ['name'=>'GTBank','sort_order'=>5],
            ['name'=>'Nigerian Institute of Estate Surveyors','sort_order'=>6],
        ];
        foreach($partners as $p) Partner::firstOrCreate(['name'=>$p['name']], array_merge($p, ['logo'=>'partners/placeholder.png','is_active'=>true]));
    }
}
