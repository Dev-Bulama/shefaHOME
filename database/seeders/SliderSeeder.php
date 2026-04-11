<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Slider;

class SliderSeeder extends Seeder {
    public function run(): void {
        $sliders = [
            ['title'=>'Find Your Dream Home in Nigeria','subtitle'=>'Flexible payment plans. Government approved titles. Premium locations.','cta_text'=>'Explore Properties','cta_url'=>'/properties','cta_text_2'=>'Contact Us','cta_url_2'=>'/contact','sort_order'=>1],
            ['title'=>'Invest in the Future of Real Estate','subtitle'=>'Up to 35% ROI on property investments. Secure. Verified. Profitable.','cta_text'=>'Become an Investor','cta_url'=>'/investor-info','cta_text_2'=>'Learn More','cta_url_2'=>'/about-us','sort_order'=>2],
            ['title'=>'Over 5,000 Families Housed Nationwide','subtitle'=>'25+ premium estates across 15 states in Nigeria. Your home awaits.','cta_text'=>'View Our Estates','cta_url'=>'/properties','cta_text_2'=>'Virtual Tour','cta_url_2'=>'/virtual-tour','sort_order'=>3],
        ];
        foreach($sliders as $s) Slider::firstOrCreate(['title'=>$s['title']], array_merge($s, ['image'=>'sliders/placeholder.jpg','is_active'=>true,'text_position'=>'left']));
    }
}
