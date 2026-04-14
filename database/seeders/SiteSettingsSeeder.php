<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\SiteSetting;

class SiteSettingsSeeder extends Seeder {
    public function run(): void {
        $metaPixel = '<!-- Meta Pixel Code -->
<script>
!function(f,b,e,v,n,t,s)
{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};
if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version=\'2.0\';
n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];
s.parentNode.insertBefore(t,s)}(window, document,\'script\',
\'https://connect.facebook.net/en_US/fbevents.js\');
fbq(\'init\', \'2115240449426594\');
fbq(\'track\', \'PageView\');
</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=2115240449426594&ev=PageView&noscript=1"
/></noscript>
<!-- End Meta Pixel Code -->';

        $settings = [
            // General
            ['key'=>'site_name',             'value'=>'Shefa Homes and Properties Ltd',                       'group'=>'general'],
            ['key'=>'tagline',               'value'=>'Building Strategic Assets. Creating Lasting Value.',   'group'=>'general'],
            ['key'=>'logo',                  'value'=>'',                                                      'group'=>'general'],
            ['key'=>'favicon',               'value'=>'',                                                      'group'=>'general'],
            ['key'=>'phone_1',               'value'=>'08105494713',                                           'group'=>'general'],
            ['key'=>'phone_2',               'value'=>'09122388541',                                           'group'=>'general'],
            ['key'=>'contact_email',         'value'=>'info@shefahomesng.com',                                 'group'=>'general'],
            ['key'=>'address',               'value'=>'5, Charity Road, Opposite UBA Oko/Oba Ifako-Ijaye Ijaiye, Lagos', 'group'=>'general'],
            ['key'=>'whatsapp_number',       'value'=>'2349122388541',                                        'group'=>'general'],
            ['key'=>'google_maps_embed',     'value'=>'',                                                      'group'=>'general'],
            // Social
            ['key'=>'social_facebook',       'value'=>'',                                                      'group'=>'social'],
            ['key'=>'social_instagram',      'value'=>'',                                                      'group'=>'social'],
            ['key'=>'social_twitter',        'value'=>'',                                                      'group'=>'social'],
            ['key'=>'social_linkedin',       'value'=>'',                                                      'group'=>'social'],
            ['key'=>'social_youtube',        'value'=>'',                                                      'group'=>'social'],
            ['key'=>'social_tiktok',         'value'=>'',                                                      'group'=>'social'],
            // SEO
            ['key'=>'meta_title',            'value'=>'Shefa Homes and Properties Ltd — Strategic Real Estate Nigeria', 'group'=>'seo'],
            ['key'=>'meta_description',      'value'=>'Shefa Homes and Properties Ltd delivers structured, high-value real estate investment and development solutions across Nigeria.', 'group'=>'seo'],
            ['key'=>'google_analytics_id',   'value'=>'',                                                      'group'=>'seo'],
            ['key'=>'google_site_verification','value'=>'',                                                    'group'=>'seo'],
            ['key'=>'facebook_pixel_id',     'value'=>'2115240449426594',                                     'group'=>'seo'],
            // General (extra)
            ['key'=>'logo_height',           'value'=>'48',                                                     'group'=>'general'],
            // Payments
            ['key'=>'paystack_public_key',   'value'=>'',                                                      'group'=>'payments'],
            ['key'=>'paystack_secret_key',   'value'=>'',                                                      'group'=>'payments'],
            ['key'=>'paystack_mode',         'value'=>'live',                                                   'group'=>'payments'],
            ['key'=>'payment_currency',      'value'=>'NGN',                                                    'group'=>'payments'],
            ['key'=>'payment_page_title',    'value'=>'Complete Your Payment',                                  'group'=>'payments'],
            ['key'=>'receipt_support_email', 'value'=>'info@shefahomesng.com',                                  'group'=>'payments'],
            ['key'=>'payment_method',        'value'=>'paystack',                                               'group'=>'payments'],
            ['key'=>'bank_name',             'value'=>'',                                                       'group'=>'payments'],
            ['key'=>'bank_account_name',     'value'=>'',                                                       'group'=>'payments'],
            ['key'=>'bank_account_number',   'value'=>'',                                                       'group'=>'payments'],
            ['key'=>'bank_sort_code',        'value'=>'',                                                       'group'=>'payments'],
            ['key'=>'bank_transfer_instructions', 'value'=>'Please transfer the exact amount and email proof of payment to payments@shefahomes.com within 24 hours.', 'group'=>'payments'],
            // Scripts & Integrations
            ['key'=>'head_scripts',          'value'=>$metaPixel,                                              'group'=>'scripts'],
            ['key'=>'body_scripts',          'value'=>'',                                                      'group'=>'scripts'],
            ['key'=>'gtm_id',                'value'=>'',                                                      'group'=>'scripts'],
            ['key'=>'chat_widget_id',        'value'=>'',                                                      'group'=>'scripts'],
            ['key'=>'crisp_website_id',      'value'=>'',                                                      'group'=>'scripts'],
        ];

        foreach ($settings as $s) {
            SiteSetting::firstOrCreate(
                ['key' => $s['key']],
                ['value' => $s['value'], 'group' => $s['group']]
            );
        }
    }
}
