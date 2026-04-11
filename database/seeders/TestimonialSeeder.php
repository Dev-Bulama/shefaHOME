<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Testimonial;

class TestimonialSeeder extends Seeder {
    public function run(): void {
        $testimonials = [
            ['client_name'=>'Mr. Chukwuemeka Eze','client_title'=>'Business Owner, Lagos','content'=>'SHEFAHOMES made buying land so easy! The flexible payment plan was a lifesaver. Within 12 months I completed payment and received my Certificate of Occupancy. Highly recommended!','rating'=>5,'property'=>'Lekki Phase 2 Gardens'],
            ['client_name'=>'Mrs. Folake Johnson','client_title'=>'Engineer, Abuja','content'=>'I was skeptical at first but the transparency and professionalism of the SHEFAHOMES team won me over. My family now owns a beautiful plot in Abuja. Thank you!','rating'=>5,'property'=>'Abuja Apo District Estate'],
            ['client_name'=>'Dr. Ibrahim Bello','client_title'=>'Medical Doctor, Kano','content'=>'The entire process from inquiry to documentation was seamless. The customer service team was always available to answer my questions. Five stars!','rating'=>5,'property'=>'Kano Nassarawa Estate'],
            ['client_name'=>'Adaeze Obi','client_title'=>'Civil Servant, Enugu','content'=>'I purchased through the 24-month payment plan and it was very manageable. The estate is well laid out with good roads. I am very satisfied.','rating'=>4,'property'=>'Enugu GRA Extension'],
            ['client_name'=>'Engr. Tunde Williams','client_title'=>'Entrepreneur, Lagos','content'=>'SHEFAHOMES is the real deal! I have bought three plots already. Their titles are always clean and government approved. They are my go-to real estate company.','rating'=>5,'property'=>'Lagos Ibeju-Lekki Plots'],
            ['client_name'=>'Mrs. Ngozi Okafor','client_title'=>'Teacher, Port Harcourt','content'=>'The virtual tour feature helped me make my decision without having to travel far. When I visited the estate, it was exactly as shown. Very trustworthy company!','rating'=>5,'property'=>'Port Harcourt Waterfront Plots'],
        ];
        foreach($testimonials as $t) Testimonial::firstOrCreate(['client_name'=>$t['client_name']], array_merge($t, ['is_featured'=>true,'is_active'=>true,'sort_order'=>0]));
    }
}
