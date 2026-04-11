<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\{Faq, FaqCategory};

class FaqSeeder extends Seeder {
    public function run(): void {
        $general = FaqCategory::where('slug','general-questions')->first();
        $buying = FaqCategory::where('slug','buying-process')->first();
        $payment = FaqCategory::where('slug','payment-plans')->first();
        $docs = FaqCategory::where('slug','documentation')->first();

        $faqs = [
            [$general->id,'What is SHEFAHOMES?','SHEFAHOMES is a premium real estate company in Nigeria offering well-located, government-approved residential and commercial properties across 15 states.'],
            [$general->id,'Is SHEFAHOMES registered?','Yes, SHEFAHOMES is a fully registered company with the Corporate Affairs Commission (CAC) Nigeria. Our properties have valid government documentation.'],
            [$buying->id,'How do I buy a property?','Simply browse our property listings, select your preferred plot/unit, choose a payment plan, make your initial deposit and you are on your way to property ownership.'],
            [$buying->id,'Can I visit the site before buying?','Absolutely! We encourage all buyers to visit the site. Contact us to schedule a free site inspection with our team.'],
            [$payment->id,'What payment plans do you offer?','We offer outright payment (with discount), 6 months, 12 months, 24 months, and 36 months installment plans.'],
            [$payment->id,'What is the minimum initial deposit?','Initial deposits start from 20% of the total property price depending on the chosen payment plan.'],
            [$docs->id,'What documents will I receive after purchase?','You will receive: Deed of Assignment, Survey Plan, and Allocation Letter. We assist in processing Governor\'s Consent and Certificate of Occupancy.'],
            [$docs->id,'How long does documentation take?','Standard documentation takes 30-60 days. We provide regular updates throughout the process.'],
        ];
        foreach($faqs as $i => $f) {
            Faq::firstOrCreate(['question'=>$f[1]], ['faq_category_id'=>$f[0],'answer'=>$f[2],'is_active'=>true,'sort_order'=>$i]);
        }
    }
}
