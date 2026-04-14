<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PageContent;

class PageContentSeeder extends Seeder
{
    public function run(): void
    {
        $pages = [

            /* ─── HOME ────────────────────────────────────── */
            'home' => [
                ['section'=>'hero',     'key'=>'title',              'label'=>'Hero – Main Heading',           'type'=>'text',     'value'=>'Invest in Nigeria\'s Future. Own Land That Works.',            'sort_order'=>1],
                ['section'=>'hero',     'key'=>'subtitle',           'label'=>'Hero – Subheading',             'type'=>'textarea', 'value'=>'Premium real estate properties across Nigeria. Flexible payment plans. Government approved titles.',  'sort_order'=>2],
                ['section'=>'hero',     'key'=>'cta_primary_text',   'label'=>'Hero – Primary Button Text',    'type'=>'text',     'value'=>'Explore Properties',    'sort_order'=>3],
                ['section'=>'hero',     'key'=>'cta_primary_url',    'label'=>'Hero – Primary Button URL',     'type'=>'url',      'value'=>'/properties',           'sort_order'=>4],
                ['section'=>'hero',     'key'=>'cta_secondary_text', 'label'=>'Hero – Secondary Button Text',  'type'=>'text',     'value'=>'Contact Us',            'sort_order'=>5],
                ['section'=>'hero',     'key'=>'cta_secondary_url',  'label'=>'Hero – Secondary Button URL',   'type'=>'url',      'value'=>'/contact',              'sort_order'=>6],
                ['section'=>'why_us',   'key'=>'title',              'label'=>'Why Us – Section Title',        'type'=>'text',     'value'=>'Why Choose Shefa Homes?','sort_order'=>10],
                ['section'=>'why_us',   'key'=>'subtitle',           'label'=>'Why Us – Section Subtitle',     'type'=>'textarea', 'value'=>'We deliver transparency, value, and results in every transaction.',  'sort_order'=>11],
                ['section'=>'why_us',   'key'=>'image',              'label'=>'Why Us – Section Image',        'type'=>'image',    'value'=>'',                        'sort_order'=>12],
                ['section'=>'cta',      'key'=>'title',              'label'=>'CTA Banner – Heading',          'type'=>'text',     'value'=>'Ready to Start Your Real Estate Journey?', 'sort_order'=>20],
                ['section'=>'cta',      'key'=>'subtitle',           'label'=>'CTA Banner – Subtext',          'type'=>'textarea', 'value'=>'Join thousands of Nigerians building wealth through strategic real estate.', 'sort_order'=>21],
            ],

            /* ─── ABOUT ───────────────────────────────────── */
            'about' => [
                ['section'=>'hero',    'key'=>'title',   'label'=>'Hero – Title',                 'type'=>'text',     'value'=>'Building Strategic Assets. Creating Lasting Value.',  'sort_order'=>1],
                ['section'=>'hero',    'key'=>'subtitle','label'=>'Hero – Subtitle',               'type'=>'textarea', 'value'=>'Shefa Homes and Properties Ltd is a premier real estate development and investment firm headquartered in Lagos, Nigeria.',  'sort_order'=>2],
                ['section'=>'intro',   'key'=>'body',    'label'=>'Company Introduction',          'type'=>'html',     'value'=>'<p>Shefa Homes and Properties Ltd is a premier real estate development and investment firm headquartered in Lagos, Nigeria. We specialise in land banking, property development, joint venture partnerships, and structured investment products that deliver measurable returns.</p><p>Our philosophy is simple: <strong>every transaction must create strategic, lasting value</strong> — for our clients, our partners, and the communities we develop in.</p>', 'sort_order'=>10],
                ['section'=>'vision',  'key'=>'content', 'label'=>'Vision Statement',              'type'=>'textarea', 'value'=>'To be the most trusted, transparent, and transformative real estate firm in Africa — building strategic assets that create generational wealth.', 'sort_order'=>20],
                ['section'=>'mission', 'key'=>'content', 'label'=>'Mission Statement',             'type'=>'textarea', 'value'=>'To provide structured, high-value real estate investment and development solutions that empower individuals, families, and institutions to build, preserve, and multiply wealth through property ownership.', 'sort_order'=>30],
                ['section'=>'cta',     'key'=>'title',   'label'=>'CTA – Heading',                 'type'=>'text',     'value'=>'Ready to Partner With Us?',  'sort_order'=>40],
                ['section'=>'cta',     'key'=>'subtitle','label'=>'CTA – Subtitle',                 'type'=>'textarea', 'value'=>'Whether you are an investor, landowner, or buyer — we have a solution designed for you.', 'sort_order'=>41],
            ],

            /* ─── SERVICES ────────────────────────────────── */
            'services' => [
                ['section'=>'hero',          'key'=>'title',       'label'=>'Hero – Title',              'type'=>'text',     'value'=>'Our Services',  'sort_order'=>1],
                ['section'=>'hero',          'key'=>'subtitle',    'label'=>'Hero – Subtitle',            'type'=>'textarea', 'value'=>'Comprehensive real estate solutions tailored to investors, developers, and individual buyers across Nigeria.', 'sort_order'=>2],
                ['section'=>'land_banking',  'key'=>'title',       'label'=>'Land Banking – Title',       'type'=>'text',     'value'=>'Land Banking',  'sort_order'=>10],
                ['section'=>'land_banking',  'key'=>'description', 'label'=>'Land Banking – Description', 'type'=>'html',     'value'=>'<p>We acquire and hold strategically located land in high-growth corridors across Nigeria. Our land banking programme gives investors early access to parcels with guaranteed appreciation potential — without the complexity of direct development.</p><ul><li>Outright purchase or flexible payment plans</li><li>Government approved C of O and survey documents</li><li>Buy-back guarantee options available</li><li>Access to estates in Lagos, Abuja, Ogun, and Delta</li></ul>', 'sort_order'=>11],
                ['section'=>'project_mgmt',  'key'=>'title',       'label'=>'Project Management – Title',       'type'=>'text', 'value'=>'Project Management',  'sort_order'=>20],
                ['section'=>'project_mgmt',  'key'=>'description', 'label'=>'Project Management – Description', 'type'=>'html', 'value'=>'<p>From site acquisition to completion, we manage every stage of the development process. Our in-house team of architects, project managers, and quality assurance experts ensures every project is delivered on time and to specification.</p><ul><li>Full lifecycle project management</li><li>Transparent cost reporting</li><li>Milestone-based disbursement</li><li>Post-delivery support and facility management</li></ul>', 'sort_order'=>21],
                ['section'=>'property_flip', 'key'=>'title',       'label'=>'Property Flipping – Title',       'type'=>'text', 'value'=>'Property Flipping',  'sort_order'=>30],
                ['section'=>'property_flip', 'key'=>'description', 'label'=>'Property Flipping – Description', 'type'=>'html', 'value'=>'<p>Our Property Flipping programme identifies undervalued properties in prime locations, acquires them, renovates to a premium standard, and resells at profitable margins — with investor co-participation options available.</p><ul><li>Target 25–50% ROI per cycle</li><li>6–18 month turnaround</li><li>Joint funding options</li><li>End-to-end handled by our team</li></ul>', 'sort_order'=>31],
                ['section'=>'jv',            'key'=>'title',       'label'=>'JV Partnerships – Title',      'type'=>'text', 'value'=>'JV Partnerships',  'sort_order'=>40],
                ['section'=>'jv',            'key'=>'description', 'label'=>'JV Partnerships – Description', 'type'=>'html', 'value'=>'<p>We partner with landowners, investors, and institutions on structured joint venture agreements that unlock the full potential of underdeveloped assets.</p><ul><li>Landowner, Capital Investor, and Hybrid JV models</li><li>Clear profit-sharing agreements</li><li>Legal documentation handled in-house</li><li>Transparent execution from ground-breaking to sale</li></ul>', 'sort_order'=>41],
                ['section'=>'development',   'key'=>'title',       'label'=>'Property Development – Title',      'type'=>'text', 'value'=>'Property Development',  'sort_order'=>50],
                ['section'=>'development',   'key'=>'description', 'label'=>'Property Development – Description', 'type'=>'html', 'value'=>'<p>We develop residential and mixed-use estates across Nigeria\'s high-demand corridors. Our estates combine quality construction, infrastructure, and community planning to deliver properties that appreciate and last.</p><ul><li>Residential and mixed-use developments</li><li>Infrastructure provision (roads, power, water)</li><li>Government-approved titles on all units</li><li>Flexible off-plan payment structures</li></ul>', 'sort_order'=>51],
                ['section'=>'cta',           'key'=>'title',       'label'=>'CTA – Heading',      'type'=>'text',     'value'=>'Ready to Get Started?',  'sort_order'=>60],
                ['section'=>'cta',           'key'=>'subtitle',    'label'=>'CTA – Subtitle',      'type'=>'textarea', 'value'=>'Whether you are looking to invest, develop, or acquire property — our team is ready to guide you.', 'sort_order'=>61],
            ],

            /* ─── JOINT VENTURE ───────────────────────────── */
            'joint-venture' => [
                ['section'=>'hero',    'key'=>'title',    'label'=>'Hero – Title',       'type'=>'text',     'value'=>'Build More Together. Partner With Purpose.',  'sort_order'=>1],
                ['section'=>'hero',    'key'=>'subtitle', 'label'=>'Hero – Subtitle',    'type'=>'textarea', 'value'=>'Shefa Homes and Properties Ltd offers structured Joint Venture (JV) Partnership frameworks designed for landowners, capital investors, and hybrid collaborators looking to unlock the full potential of real estate assets.', 'sort_order'=>2],
                ['section'=>'why',     'key'=>'title',    'label'=>'Why Partner – Title','type'=>'text',     'value'=>'Why Partner With Shefa?',  'sort_order'=>10],
                ['section'=>'why',     'key'=>'subtitle', 'label'=>'Why Partner – Subtitle','type'=>'textarea','value'=>'We bring the expertise, capital structure, and market access to turn your asset into a profitable development.',  'sort_order'=>11],
                ['section'=>'cta',     'key'=>'title',    'label'=>'CTA – Heading',      'type'=>'text',     'value'=>'Ready to Explore a Partnership?',  'sort_order'=>50],
                ['section'=>'cta',     'key'=>'subtitle', 'label'=>'CTA – Subtitle',     'type'=>'textarea', 'value'=>'Take the first step today. Our team will evaluate your asset, structure a viable proposal, and walk you through the entire process.',  'sort_order'=>51],
                ['section'=>'cta',     'key'=>'phone',    'label'=>'CTA – Phone Number', 'type'=>'text',     'value'=>'08105494713',  'sort_order'=>52],
                ['section'=>'cta',     'key'=>'email',    'label'=>'CTA – Email',        'type'=>'text',     'value'=>'info@shefahomesng.com',  'sort_order'=>53],
            ],

            /* ─── INVESTOR INFO ───────────────────────────── */
            'investor-info' => [
                ['section'=>'hero',  'key'=>'title',    'label'=>'Hero – Title',    'type'=>'text',     'value'=>'Partner With Purpose. Invest With Confidence.',  'sort_order'=>1],
                ['section'=>'hero',  'key'=>'subtitle', 'label'=>'Hero – Subtitle', 'type'=>'textarea', 'value'=>'Shefa Homes and Properties Ltd offers structured, high-yield real estate investment opportunities backed by verified assets, transparent processes, and a proven track record.',  'sort_order'=>2],
                ['section'=>'why',   'key'=>'title',    'label'=>'Why Invest – Title',   'type'=>'text',     'value'=>'Why Invest With Shefa Homes?',  'sort_order'=>10],
                ['section'=>'why',   'key'=>'subtitle', 'label'=>'Why Invest – Subtitle','type'=>'textarea', 'value'=>'We combine market expertise with a commitment to delivering real, measurable returns.',  'sort_order'=>11],
                ['section'=>'cta',   'key'=>'title',    'label'=>'CTA – Heading',        'type'=>'text',     'value'=>'Ready to Grow Your Wealth Through Real Estate?',  'sort_order'=>30],
                ['section'=>'cta',   'key'=>'subtitle', 'label'=>'CTA – Subtitle',       'type'=>'textarea', 'value'=>'Schedule a consultation with our investment team today. Let us help you structure a portfolio that works for your goals.',  'sort_order'=>31],
            ],

            /* ─── CONTACT ─────────────────────────────────── */
            'contact' => [
                ['section'=>'hero',  'key'=>'title',    'label'=>'Hero – Title',    'type'=>'text',     'value'=>'Get In Touch',  'sort_order'=>1],
                ['section'=>'hero',  'key'=>'subtitle', 'label'=>'Hero – Subtitle', 'type'=>'textarea', 'value'=>'We are here to help. Reach out to our team for property inquiries, investment questions, or partnership discussions.',  'sort_order'=>2],
                ['section'=>'info',  'key'=>'address',  'label'=>'Office Address',  'type'=>'textarea', 'value'=>'5, Charity Road, Opposite UBA Oko/Oba Ifako-Ijaye Ijaiye, Lagos', 'sort_order'=>10],
                ['section'=>'info',  'key'=>'phone',    'label'=>'Phone Number',    'type'=>'text',     'value'=>'08105494713',  'sort_order'=>11],
                ['section'=>'info',  'key'=>'whatsapp', 'label'=>'WhatsApp Number', 'type'=>'text',     'value'=>'09122388541',  'sort_order'=>12],
                ['section'=>'info',  'key'=>'email',    'label'=>'Email Address',   'type'=>'text',     'value'=>'info@shefahomesng.com',  'sort_order'=>13],
                ['section'=>'info',  'key'=>'hours',    'label'=>'Office Hours',    'type'=>'text',     'value'=>'Monday – Saturday: 8am – 6pm',  'sort_order'=>14],
            ],

            /* ─── PROPERTIES ──────────────────────────────── */
            'properties' => [
                ['section'=>'hero',  'key'=>'title',    'label'=>'Hero – Title',    'type'=>'text',     'value'=>'Find Your Perfect Property',  'sort_order'=>1],
                ['section'=>'hero',  'key'=>'subtitle', 'label'=>'Hero – Subtitle', 'type'=>'textarea', 'value'=>'Browse our curated selection of premium real estate across Nigeria.', 'sort_order'=>2],
            ],

            /* ─── CSR ─────────────────────────────────────── */
            'csr' => [
                ['section'=>'hero',   'key'=>'title',    'label'=>'Hero – Title',    'type'=>'text',     'value'=>'Corporate Social Responsibility',  'sort_order'=>1],
                ['section'=>'hero',   'key'=>'subtitle', 'label'=>'Hero – Subtitle', 'type'=>'textarea', 'value'=>'At Shefa Homes, we believe that building communities goes far beyond bricks and mortar.',  'sort_order'=>2],
                ['section'=>'intro',  'key'=>'body',     'label'=>'Introduction',    'type'=>'html',     'value'=>'<p>Our Corporate Social Responsibility programmes are designed to give back to the communities that form the foundation of our work — through affordable housing initiatives, youth empowerment, environmental sustainability, and community infrastructure development.</p>',  'sort_order'=>10],
                ['section'=>'cta',    'key'=>'title',    'label'=>'CTA – Heading',   'type'=>'text',     'value'=>'Partner With Us for Greater Impact',  'sort_order'=>30],
                ['section'=>'cta',    'key'=>'subtitle', 'label'=>'CTA – Subtitle',  'type'=>'textarea', 'value'=>'If you are a corporate, NGO, or individual who shares our vision of community transformation, we would love to collaborate.',  'sort_order'=>31],
            ],

            /* ─── BLOG ────────────────────────────────────── */
            'blog' => [
                ['section'=>'hero',  'key'=>'title',    'label'=>'Hero – Title',    'type'=>'text',     'value'=>'Insights & Updates',  'sort_order'=>1],
                ['section'=>'hero',  'key'=>'subtitle', 'label'=>'Hero – Subtitle', 'type'=>'textarea', 'value'=>'Market trends, investment guides, and company news from the Shefa Homes team.', 'sort_order'=>2],
            ],

            /* ─── CAREERS ─────────────────────────────────── */
            'careers' => [
                ['section'=>'hero',  'key'=>'title',    'label'=>'Hero – Title',    'type'=>'text',     'value'=>'Join Our Team',  'sort_order'=>1],
                ['section'=>'hero',  'key'=>'subtitle', 'label'=>'Hero – Subtitle', 'type'=>'textarea', 'value'=>'We are building the future of real estate in Nigeria. Come build it with us.', 'sort_order'=>2],
            ],

            /* ─── FAQS ────────────────────────────────────── */
            'faqs' => [
                ['section'=>'hero',  'key'=>'title',    'label'=>'Hero – Title',    'type'=>'text',     'value'=>'Frequently Asked Questions',  'sort_order'=>1],
                ['section'=>'hero',  'key'=>'subtitle', 'label'=>'Hero – Subtitle', 'type'=>'textarea', 'value'=>'Everything you need to know about buying, investing, and partnering with Shefa Homes.', 'sort_order'=>2],
            ],
        ];

        foreach ($pages as $pageName => $fields) {
            foreach ($fields as $field) {
                \App\Models\PageContent::firstOrCreate(
                    ['page' => $pageName, 'section' => $field['section'], 'key' => $field['key']],
                    ['label' => $field['label'], 'value' => $field['value'], 'type' => $field['type'], 'sort_order' => $field['sort_order']]
                );
            }
        }
    }
}
