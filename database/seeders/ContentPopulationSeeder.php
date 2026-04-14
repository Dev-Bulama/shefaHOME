<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PageContent;

/**
 * Populates/overwrites specific page content with exact client-provided copy.
 * Uses updateOrCreate so it is safe to re-run at any time.
 */
class ContentPopulationSeeder extends Seeder
{
    public function run(): void
    {
        $updates = [

            /* ─── HOME – Section 1: Who We Are ──────────────── */
            ['page'=>'home','section'=>'section_1','key'=>'visible',
             'value'=>'1','label'=>'Section 1 – Visible','type'=>'boolean','sort_order'=>28],

            ['page'=>'home','section'=>'section_1','key'=>'title',
             'value'=>'Who We Are',
             'label'=>'Section 1 – Title','type'=>'text','sort_order'=>29],

            ['page'=>'home','section'=>'section_1','key'=>'subtitle',
             'value'=>'Building Strategic Assets. Creating Lasting Value.',
             'label'=>'Section 1 – Subtitle Tag','type'=>'text','sort_order'=>30],

            ['page'=>'home','section'=>'section_1','key'=>'description',
             'value'=>"Shefa Homes and Properties Ltd is a forward-thinking real estate investment and development company committed to delivering structured, high-value property solutions across Nigeria's fastest-growing corridors.\n\nWe do not merely sell land — we curate strategic real estate opportunities designed for long-term capital appreciation, wealth preservation, and sustainable development.",
             'label'=>'Section 1 – Description','type'=>'textarea','sort_order'=>31],

            ['page'=>'home','section'=>'section_1','key'=>'image_side',
             'value'=>'right','label'=>'Section 1 – Image Side','type'=>'text','sort_order'=>32],

            ['page'=>'home','section'=>'section_1','key'=>'button_text',
             'value'=>'Learn About Us','label'=>'Section 1 – Button Text','type'=>'text','sort_order'=>33],

            ['page'=>'home','section'=>'section_1','key'=>'button_url',
             'value'=>'/about','label'=>'Section 1 – Button URL','type'=>'url','sort_order'=>34],

            ['page'=>'home','section'=>'section_1','key'=>'bg',
             'value'=>'white','label'=>'Section 1 – Background','type'=>'text','sort_order'=>35],

            /* ─── HOME – Section 2: What Sets Us Apart ──────── */
            ['page'=>'home','section'=>'section_2','key'=>'visible',
             'value'=>'1','label'=>'Section 2 – Visible','type'=>'boolean','sort_order'=>40],

            ['page'=>'home','section'=>'section_2','key'=>'title',
             'value'=>'What Sets Us Apart',
             'label'=>'Section 2 – Title','type'=>'text','sort_order'=>41],

            ['page'=>'home','section'=>'section_2','key'=>'subtitle',
             'value'=>'Our Edge',
             'label'=>'Section 2 – Subtitle Tag','type'=>'text','sort_order'=>42],

            ['page'=>'home','section'=>'section_2','key'=>'description',
             'value'=>"Investment-focused model\n\nCarefully selected high-growth locations\n\nStructured Joint Venture partnerships\n\nProfessional project management systems\n\nCommitment to integrity and accountability\n\nWe operate with discipline, precision, and a deep understanding of emerging real estate markets.",
             'label'=>'Section 2 – Description','type'=>'textarea','sort_order'=>43],

            ['page'=>'home','section'=>'section_2','key'=>'image_side',
             'value'=>'left','label'=>'Section 2 – Image Side','type'=>'text','sort_order'=>44],

            ['page'=>'home','section'=>'section_2','key'=>'button_text',
             'value'=>'Our Services','label'=>'Section 2 – Button Text','type'=>'text','sort_order'=>45],

            ['page'=>'home','section'=>'section_2','key'=>'button_url',
             'value'=>'/services','label'=>'Section 2 – Button URL','type'=>'url','sort_order'=>46],

            ['page'=>'home','section'=>'section_2','key'=>'bg',
             'value'=>'gray','label'=>'Section 2 – Background','type'=>'text','sort_order'=>47],

            /* ─── ABOUT – Core text (hero / intro / vision / mission) ─ */
            ['page'=>'about','section'=>'hero','key'=>'title',
             'value'=>'Building Strategic Assets. Creating Lasting Value.',
             'label'=>'Hero – Title','type'=>'text','sort_order'=>1],

            ['page'=>'about','section'=>'hero','key'=>'subtitle',
             'value'=>'A forward-thinking real estate investment and development company committed to delivering structured, high-value property solutions across Nigeria\'s fastest-growing corridors.',
             'label'=>'Hero – Subtitle','type'=>'textarea','sort_order'=>2],

            ['page'=>'about','section'=>'vision','key'=>'content',
             'value'=>'To Contribute to the creation of thriving communities and ecosystems by building long-term relationships with our clients founded on trust and integrity.',
             'label'=>'Vision Statement','type'=>'textarea','sort_order'=>20],

            ['page'=>'about','section'=>'mission','key'=>'content',
             'value'=>'To deliver exceptional service and transparent communication to our investors, Partners and Stakeholders.',
             'label'=>'Mission Statement','type'=>'textarea','sort_order'=>30],

            /* ─── SERVICES – Hero text ───────────────────────── */
            ['page'=>'services','section'=>'hero','key'=>'title',
             'value'=>'Our Services','label'=>'Hero – Title','type'=>'text','sort_order'=>1],

            ['page'=>'services','section'=>'hero','key'=>'subtitle',
             'value'=>'Elite Real Estate Investment & Development Solutions',
             'label'=>'Hero – Subtitle','type'=>'text','sort_order'=>2],
        ];

        foreach ($updates as $row) {
            PageContent::updateOrCreate(
                ['page' => $row['page'], 'section' => $row['section'], 'key' => $row['key']],
                ['value' => $row['value'], 'label' => $row['label'], 'type' => $row['type'], 'sort_order' => $row['sort_order']]
            );
        }
    }
}
