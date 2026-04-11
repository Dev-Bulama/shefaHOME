<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Career;

class CareerSeeder extends Seeder {
    public function run(): void {
        $careers = [
            ['title'=>'Senior Sales Executive','department'=>'Sales','location'=>'Lagos','type'=>'full_time','summary'=>'Drive property sales across Lagos state, managing client relationships from initial inquiry to closing.','description'=>'<p>We are looking for an experienced Senior Sales Executive to join our growing Lagos team...</p>','requirements'=>'<ul><li>3+ years real estate sales experience</li><li>Strong client relationship skills</li><li>Proven track record of meeting sales targets</li></ul>','salary_range'=>'₦150,000 - ₦300,000 + Commission','is_active'=>true],
            ['title'=>'Digital Marketing Manager','department'=>'Marketing','location'=>'Lagos (Remote eligible)','type'=>'full_time','summary'=>'Lead our digital marketing efforts across social media, SEO, and paid advertising to drive property inquiries.','description'=>'<p>We need a creative and data-driven Digital Marketing Manager to scale our online presence...</p>','requirements'=>'<ul><li>5+ years digital marketing experience</li><li>Proficiency in Meta Ads, Google Ads, SEO</li><li>Real estate industry experience preferred</li></ul>','salary_range'=>'₦200,000 - ₦350,000','is_active'=>true],
            ['title'=>'Property Documentation Officer','department'=>'Legal','location'=>'Abuja','type'=>'full_time','summary'=>'Handle all property documentation, title verification, and government liaison for our Abuja portfolio.','description'=>'<p>We are seeking a meticulous Documentation Officer to manage our growing Abuja portfolio paperwork...</p>','requirements'=>'<ul><li>Law degree or equivalent legal qualification</li><li>Knowledge of Nigerian land law</li><li>Experience with AGIS (Abuja) documentation preferred</li></ul>','salary_range'=>'₦120,000 - ₦200,000','is_active'=>true],
        ];
        foreach($careers as $c) Career::firstOrCreate(['title'=>$c['title']], $c);
    }
}
