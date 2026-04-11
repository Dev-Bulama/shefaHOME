<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Stat;

class StatSeeder extends Seeder {
    public function run(): void {
        $stats = [
            ['label'=>'Families Housed','value'=>'5,000+','icon'=>'🏠','sort_order'=>1],
            ['label'=>'Premium Estates','value'=>'25+','icon'=>'🏘','sort_order'=>2],
            ['label'=>'States Covered','value'=>'15','icon'=>'📍','sort_order'=>3],
            ['label'=>'Years of Excellence','value'=>'10+','icon'=>'⭐','sort_order'=>4],
        ];
        foreach($stats as $s) Stat::firstOrCreate(['label'=>$s['label']], $s);
    }
}
