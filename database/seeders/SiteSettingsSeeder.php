<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\SiteSetting;

class SiteSettingsSeeder extends Seeder {
    public function run(): void {
        $settings = [
            ['key'=>'site_name','value'=>'SHEFAHOMES','group'=>'general'],
            ['key'=>'tagline','value'=>'Building Dreams Across Nigeria','group'=>'general'],
            ['key'=>'logo','value'=>'','group'=>'general'],
            ['key'=>'favicon','value'=>'','group'=>'general'],
            ['key'=>'phone_1','value'=>'+234 800 000 0000','group'=>'general'],
            ['key'=>'phone_2','value'=>'+234 800 000 0001','group'=>'general'],
            ['key'=>'contact_email','value'=>'info@shefahomes.com','group'=>'general'],
            ['key'=>'address','value'=>'Plot 1, Shefahomes Close, Victoria Island, Lagos','group'=>'general'],
            ['key'=>'whatsapp_number','value'=>'2348000000000','group'=>'general'],
            ['key'=>'google_maps_embed','value'=>'','group'=>'general'],
            ['key'=>'facebook_url','value'=>'https://facebook.com/shefahomes','group'=>'social'],
            ['key'=>'instagram_url','value'=>'https://instagram.com/shefahomes','group'=>'social'],
            ['key'=>'twitter_url','value'=>'https://twitter.com/shefahomes','group'=>'social'],
            ['key'=>'linkedin_url','value'=>'https://linkedin.com/company/shefahomes','group'=>'social'],
            ['key'=>'youtube_url','value'=>'https://youtube.com/@shefahomes','group'=>'social'],
            ['key'=>'meta_title','value'=>'SHEFAHOMES - Premium Real Estate in Nigeria','group'=>'seo'],
            ['key'=>'meta_description','value'=>'SHEFAHOMES offers premium real estate properties across Nigeria with flexible payment plans and government approved titles.','group'=>'seo'],
            ['key'=>'google_analytics_id','value'=>'','group'=>'seo'],
            ['key'=>'facebook_pixel_id','value'=>'','group'=>'seo'],
        ];
        foreach($settings as $s) SiteSetting::firstOrCreate(['key'=>$s['key']], ['value'=>$s['value'],'group'=>$s['group']]);
    }
}
