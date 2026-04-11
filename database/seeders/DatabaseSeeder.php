<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
    public function run(): void {
        $this->call([
            RolesPermissionsSeeder::class,
            AdminUserSeeder::class,
            SiteSettingsSeeder::class,
            PropertyTypeSeeder::class,
            EstateSeeder::class,
            PropertySeeder::class,
            SliderSeeder::class,
            TeamMemberSeeder::class,
            TestimonialSeeder::class,
            BlogCategorySeeder::class,
            BlogPostSeeder::class,
            FaqCategorySeeder::class,
            FaqSeeder::class,
            StatSeeder::class,
            AwardSeeder::class,
            PartnerSeeder::class,
            CareerSeeder::class,
        ]);
    }
}
