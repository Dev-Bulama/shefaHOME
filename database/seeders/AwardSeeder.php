<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Award;

class AwardSeeder extends Seeder {
    public function run(): void {
        $awards = [
            ['title'=>'Best Real Estate Company Nigeria','year'=>'2024','description'=>'Awarded by the Nigerian Institute of Estate Surveyors and Valuers','sort_order'=>1],
            ['title'=>'Developer of the Year','year'=>'2023','description'=>'PropertyPro Nigeria Annual Real Estate Awards','sort_order'=>2],
            ['title'=>'Most Trusted Property Developer','year'=>'2023','description'=>'BusinessDay Newspapers Real Estate Excellence Awards','sort_order'=>3],
            ['title'=>'Top 10 Real Estate Brands','year'=>'2022','description'=>'Africa Property Investment Summit & Expo','sort_order'=>4],
        ];
        foreach($awards as $a) Award::firstOrCreate(['title'=>$a['title']], $a);
    }
}
