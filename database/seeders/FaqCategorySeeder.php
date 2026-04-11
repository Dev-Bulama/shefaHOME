<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\FaqCategory;
use Illuminate\Support\Str;

class FaqCategorySeeder extends Seeder {
    public function run(): void {
        $cats = ['General Questions','Buying Process','Payment Plans','Documentation','After Purchase'];
        foreach($cats as $i => $c) FaqCategory::firstOrCreate(['slug'=>Str::slug($c)], ['name'=>$c,'sort_order'=>$i]);
    }
}
