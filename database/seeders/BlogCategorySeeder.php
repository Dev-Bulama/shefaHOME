<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\BlogCategory;
use Illuminate\Support\Str;

class BlogCategorySeeder extends Seeder {
    public function run(): void {
        $categories = ['Real Estate Tips','Market Insights','Investment Guide','Lifestyle','Company News'];
        foreach($categories as $c) BlogCategory::firstOrCreate(['slug'=>Str::slug($c)], ['name'=>$c,'description'=>'Articles about '.$c]);
    }
}
