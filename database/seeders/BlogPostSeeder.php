<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\{BlogPost, BlogCategory, User};
use Illuminate\Support\Str;

class BlogPostSeeder extends Seeder {
    public function run(): void {
        $admin = User::where('email','admin@shefahomes.com')->first();
        $category = BlogCategory::first();
        $posts = [
            ['title'=>'Why Lekki is Nigeria\'s Hottest Real Estate Investment Hub','excerpt'=>'Lekki has emerged as Nigeria\'s premier real estate destination. Here\'s why investing now could be the best financial decision of your life.','body'=>'<p>Lekki, the sprawling coastal district of Lagos, has transformed dramatically over the past decade...</p><p>With the Lekki Free Trade Zone, the proposed Lekki Deep Sea Port, and the massive residential and commercial development, land prices have appreciated by over 300% in some areas.</p><h2>Why You Should Invest Now</h2><p>Land banking in Lekki offers some of the best returns on investment in Africa...</p>','is_featured'=>true],
            ['title'=>'Understanding Land Documentation in Nigeria: A Complete Guide','excerpt'=>'Confused about C of O, Governor\'s Consent, and deed of assignment? This comprehensive guide breaks down everything you need to know.','body'=>'<p>Buying land in Nigeria can be overwhelming when it comes to documentation...</p><h2>Types of Land Titles</h2><p>1. Certificate of Occupancy (C of O)...</p><p>2. Governor\'s Consent...</p><p>3. Deed of Assignment...</p>','is_featured'=>false],
            ['title'=>'How to Build Wealth Through Real Estate on a Salary','excerpt'=>'You don\'t need to be a millionaire to invest in real estate. Discover how SHEFAHOMES\' flexible payment plans make property ownership accessible to everyone.','body'=>'<p>Many Nigerians believe real estate is only for the wealthy...</p><p>With flexible payment plans ranging from 6 to 36 months, you can start building your property portfolio today...</p>','is_featured'=>true],
            ['title'=>'SHEFAHOMES Expands to 5 New States in 2025','excerpt'=>'We are excited to announce the expansion of our estate portfolio to Anambra, Edo, Kwara, Plateau, and Delta states.','body'=>'<p>SHEFAHOMES is proud to announce significant expansion plans for 2025...</p><p>These five new states have been carefully selected based on market research, population growth, and infrastructure development...</p>','is_featured'=>false],
        ];
        foreach($posts as $p) {
            BlogPost::firstOrCreate(['slug'=>Str::slug($p['title'])], array_merge($p, [
                'blog_category_id'=>$category->id,
                'author_id'=>$admin->id,
                'featured_image'=>'blog/placeholder.jpg',
                'is_published'=>true,
                'published_at'=>now()->subDays(rand(1,60)),
            ]));
        }
    }
}
