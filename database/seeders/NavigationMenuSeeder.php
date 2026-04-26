<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\NavigationMenu;

class NavigationMenuSeeder extends Seeder
{
    public function run(): void
    {
        // Only seed if no items exist yet
        if (NavigationMenu::count() > 0) {
            return;
        }

        $topLevel = [
            ['label' => 'Home',         'url' => '/',           'sort_order' => 10, 'location' => 'header'],
            ['label' => 'Properties',   'url' => '/properties', 'sort_order' => 20, 'location' => 'header'],
            ['label' => 'Virtual Tour', 'url' => '/virtual-tour','sort_order'=> 30, 'location' => 'header'],
            ['label' => 'Blog',         'url' => '/blog',        'sort_order' => 40, 'location' => 'header'],
            ['label' => 'Company',      'url' => '#',            'sort_order' => 50, 'location' => 'header'],
            ['label' => 'Contact',      'url' => '/contact',     'sort_order' => 60, 'location' => 'header'],
        ];

        $children = [
            // Properties children
            'Properties' => [
                ['label' => 'All Properties', 'url' => '/properties',                   'sort_order' => 1],
                ['label' => 'For Sale',        'url' => '/properties?status=buy',        'sort_order' => 2],
                ['label' => 'For Rent',        'url' => '/properties?status=rent',       'sort_order' => 3],
                ['label' => 'Shortlets',       'url' => '/properties?status=shortlet',   'sort_order' => 4],
                ['label' => 'Map View',        'url' => '/properties?view=map',          'sort_order' => 5],
            ],
            // Company children
            'Company' => [
                ['label' => 'About Us',      'url' => '/about',                    'sort_order' => 1],
                ['label' => 'Our Services',  'url' => '/our-services',             'sort_order' => 2],
                ['label' => 'JV Partnership','url' => '/joint-venture-partnership','sort_order' => 3],
                ['label' => 'Invest With Us','url' => '/invest-with-us',           'sort_order' => 4],
                ['label' => 'CSR',           'url' => '/csr',                      'sort_order' => 5],
            ],
        ];

        foreach ($topLevel as $item) {
            $created = NavigationMenu::create(array_merge($item, [
                'is_active'     => true,
                'opens_new_tab' => false,
            ]));

            if (isset($children[$item['label']])) {
                foreach ($children[$item['label']] as $child) {
                    NavigationMenu::create(array_merge($child, [
                        'parent_id'     => $created->id,
                        'location'      => $item['location'],
                        'is_active'     => true,
                        'opens_new_tab' => false,
                    ]));
                }
            }
        }

        // Footer links
        $footer = [
            ['label' => 'Home',           'url' => '/',                         'sort_order' => 1],
            ['label' => 'Properties',     'url' => '/properties',               'sort_order' => 2],
            ['label' => 'About Us',       'url' => '/about',                    'sort_order' => 3],
            ['label' => 'Our Services',   'url' => '/our-services',             'sort_order' => 4],
            ['label' => 'JV Partnership', 'url' => '/joint-venture-partnership','sort_order' => 5],
            ['label' => 'Blog',           'url' => '/blog',                     'sort_order' => 6],
            ['label' => 'Contact',        'url' => '/contact',                  'sort_order' => 7],
            ['label' => 'FAQs',           'url' => '/faqs',                     'sort_order' => 8],
        ];

        foreach ($footer as $item) {
            NavigationMenu::create(array_merge($item, [
                'location'      => 'footer',
                'is_active'     => true,
                'opens_new_tab' => false,
            ]));
        }
    }
}
