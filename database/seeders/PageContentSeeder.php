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

                // Section 1
                ['section'=>'section_1','key'=>'visible',     'label'=>'Section 1 – Visible',       'type'=>'boolean',  'value'=>'1', 'sort_order'=>30],
                ['section'=>'section_1','key'=>'title',       'label'=>'Section 1 – Title',         'type'=>'text',     'value'=>'Why Real Estate Is the Smartest Investment', 'sort_order'=>31],
                ['section'=>'section_1','key'=>'subtitle',    'label'=>'Section 1 – Subtitle Tag',  'type'=>'text',     'value'=>'Smart Investment',  'sort_order'=>32],
                ['section'=>'section_1','key'=>'description', 'label'=>'Section 1 – Description',   'type'=>'textarea', 'value'=>"Real estate in Nigeria has consistently outperformed other asset classes over the past decade. With a growing population, rapid urbanisation, and constrained land supply in key corridors, property values continue to appreciate — making land acquisition one of the most reliable stores of value available.\n\nWhether you are preserving capital, generating rental income, or building equity for the next generation, strategic real estate ownership remains the cornerstone of lasting wealth.", 'sort_order'=>33],
                ['section'=>'section_1','key'=>'image',       'label'=>'Section 1 – Image',         'type'=>'image',    'value'=>'',  'sort_order'=>34],
                ['section'=>'section_1','key'=>'image_side',  'label'=>'Section 1 – Image Side',    'type'=>'text',     'value'=>'right', 'sort_order'=>35],
                ['section'=>'section_1','key'=>'button_text', 'label'=>'Section 1 – Button Text',   'type'=>'text',     'value'=>'Explore Properties', 'sort_order'=>36],
                ['section'=>'section_1','key'=>'button_url',  'label'=>'Section 1 – Button URL',    'type'=>'url',      'value'=>'/properties', 'sort_order'=>37],
                ['section'=>'section_1','key'=>'bg',          'label'=>'Section 1 – Background',    'type'=>'text',     'value'=>'white', 'sort_order'=>38],

                // Section 2
                ['section'=>'section_2','key'=>'visible',     'label'=>'Section 2 – Visible',       'type'=>'boolean',  'value'=>'1', 'sort_order'=>40],
                ['section'=>'section_2','key'=>'title',       'label'=>'Section 2 – Title',         'type'=>'text',     'value'=>'Strategic Locations Across Nigeria', 'sort_order'=>41],
                ['section'=>'section_2','key'=>'subtitle',    'label'=>'Section 2 – Subtitle Tag',  'type'=>'text',     'value'=>'Prime Locations',  'sort_order'=>42],
                ['section'=>'section_2','key'=>'description', 'label'=>'Section 2 – Description',   'type'=>'textarea', 'value'=>"Our estates and land banks are carefully sited in the fastest-appreciating corridors across Nigeria — from Lagos (Ibeju-Lekki, Epe, Mowe) to Abuja (Kuje, Gwagwalada, Kubwa), Ogun State, Enugu, and Delta State.\n\nWe identify emerging growth zones before they peak, giving our investors early-mover advantages that translate into exceptional appreciation over 3–10 year horizons.", 'sort_order'=>43],
                ['section'=>'section_2','key'=>'image',       'label'=>'Section 2 – Image',         'type'=>'image',    'value'=>'',  'sort_order'=>44],
                ['section'=>'section_2','key'=>'image_side',  'label'=>'Section 2 – Image Side',    'type'=>'text',     'value'=>'left', 'sort_order'=>45],
                ['section'=>'section_2','key'=>'button_text', 'label'=>'Section 2 – Button Text',   'type'=>'text',     'value'=>'View Estate Locations', 'sort_order'=>46],
                ['section'=>'section_2','key'=>'button_url',  'label'=>'Section 2 – Button URL',    'type'=>'url',      'value'=>'/properties', 'sort_order'=>47],
                ['section'=>'section_2','key'=>'bg',          'label'=>'Section 2 – Background',    'type'=>'text',     'value'=>'gray', 'sort_order'=>48],

                // Section 3
                ['section'=>'section_3','key'=>'visible',     'label'=>'Section 3 – Visible',       'type'=>'boolean',  'value'=>'1', 'sort_order'=>50],
                ['section'=>'section_3','key'=>'title',       'label'=>'Section 3 – Title',         'type'=>'text',     'value'=>'Flexible Payment Plans Built for You', 'sort_order'=>51],
                ['section'=>'section_3','key'=>'subtitle',    'label'=>'Section 3 – Subtitle Tag',  'type'=>'text',     'value'=>'Payment Plans',  'sort_order'=>52],
                ['section'=>'section_3','key'=>'description', 'label'=>'Section 3 – Description',   'type'=>'textarea', 'value'=>"We believe that property ownership should be accessible to every Nigerian — not just those with large capital reserves. That's why we offer payment plans spanning 6 to 36 months with zero interest, making it possible for salaried workers, entrepreneurs, and diaspora investors alike to secure their piece of Nigeria's most valuable land.\n\nAll plans come with a written Deed of Subscription, full legal documentation, and a dedicated account officer to guide you through every stage.", 'sort_order'=>53],
                ['section'=>'section_3','key'=>'image',       'label'=>'Section 3 – Image',         'type'=>'image',    'value'=>'',  'sort_order'=>54],
                ['section'=>'section_3','key'=>'image_side',  'label'=>'Section 3 – Image Side',    'type'=>'text',     'value'=>'right', 'sort_order'=>55],
                ['section'=>'section_3','key'=>'button_text', 'label'=>'Section 3 – Button Text',   'type'=>'text',     'value'=>'See Payment Options', 'sort_order'=>56],
                ['section'=>'section_3','key'=>'button_url',  'label'=>'Section 3 – Button URL',    'type'=>'url',      'value'=>'/contact', 'sort_order'=>57],
                ['section'=>'section_3','key'=>'bg',          'label'=>'Section 3 – Background',    'type'=>'text',     'value'=>'white', 'sort_order'=>58],

                // Section 4
                ['section'=>'section_4','key'=>'visible',     'label'=>'Section 4 – Visible',       'type'=>'boolean',  'value'=>'1', 'sort_order'=>60],
                ['section'=>'section_4','key'=>'title',       'label'=>'Section 4 – Title',         'type'=>'text',     'value'=>'Trusted by Over 5,000 Satisfied Investors', 'sort_order'=>61],
                ['section'=>'section_4','key'=>'subtitle',    'label'=>'Section 4 – Subtitle Tag',  'type'=>'text',     'value'=>'Our Track Record',  'sort_order'=>62],
                ['section'=>'section_4','key'=>'description', 'label'=>'Section 4 – Description',   'type'=>'textarea', 'value'=>"Since our founding, we have helped thousands of Nigerians and diaspora investors secure government-approved land and property titles across Nigeria's highest-growth corridors. Our portfolio spans residential plots, mixed-use developments, and large-scale estate projects.\n\nEvery subscriber receives full legal documentation, a dedicated relationship manager, and lifetime after-sales support — because our commitment doesn't end at the point of sale.", 'sort_order'=>63],
                ['section'=>'section_4','key'=>'image',       'label'=>'Section 4 – Image',         'type'=>'image',    'value'=>'',  'sort_order'=>64],
                ['section'=>'section_4','key'=>'image_side',  'label'=>'Section 4 – Image Side',    'type'=>'text',     'value'=>'left', 'sort_order'=>65],
                ['section'=>'section_4','key'=>'button_text', 'label'=>'Section 4 – Button Text',   'type'=>'text',     'value'=>'Read Client Stories', 'sort_order'=>66],
                ['section'=>'section_4','key'=>'button_url',  'label'=>'Section 4 – Button URL',    'type'=>'url',      'value'=>'/testimonials', 'sort_order'=>67],
                ['section'=>'section_4','key'=>'bg',          'label'=>'Section 4 – Background',    'type'=>'text',     'value'=>'gray', 'sort_order'=>68],
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

                // Section 1 – Our History & Journey
                ['section'=>'section_1','key'=>'visible',     'label'=>'Section 1 – Visible',      'type'=>'boolean',  'value'=>'0',  'sort_order'=>50],
                ['section'=>'section_1','key'=>'title',       'label'=>'Section 1 – Title',        'type'=>'text',     'value'=>'Our History & Journey', 'sort_order'=>51],
                ['section'=>'section_1','key'=>'subtitle',    'label'=>'Section 1 – Subtitle Tag', 'type'=>'text',     'value'=>'Since 2015',           'sort_order'=>52],
                ['section'=>'section_1','key'=>'description', 'label'=>'Section 1 – Description',  'type'=>'textarea', 'value'=>"Shefa Homes and Properties Ltd was founded in 2015 with a single conviction: that every Nigerian deserves access to land and property ownership — regardless of income bracket or social class. What started as a modest land-banking operation in Lagos has grown into one of Nigeria's most trusted real estate development and investment firms.\n\nOver the years we have expanded our footprint from Lagos to Abuja, Ogun State, Delta, and Enugu — acquiring, developing, and delivering estates that create real, lasting value for thousands of families and investors.", 'sort_order'=>53],
                ['section'=>'section_1','key'=>'image',       'label'=>'Section 1 – Image',        'type'=>'image',    'value'=>'',   'sort_order'=>54],
                ['section'=>'section_1','key'=>'image_side',  'label'=>'Section 1 – Image Side',   'type'=>'text',     'value'=>'right', 'sort_order'=>55],
                ['section'=>'section_1','key'=>'button_text', 'label'=>'Section 1 – Button Text',  'type'=>'text',     'value'=>'Explore Our Properties', 'sort_order'=>56],
                ['section'=>'section_1','key'=>'button_url',  'label'=>'Section 1 – Button URL',   'type'=>'url',      'value'=>'/properties', 'sort_order'=>57],
                ['section'=>'section_1','key'=>'bg',          'label'=>'Section 1 – Background',   'type'=>'text',     'value'=>'white', 'sort_order'=>58],

                // Section 2 – Leadership Philosophy
                ['section'=>'section_2','key'=>'visible',     'label'=>'Section 2 – Visible',      'type'=>'boolean',  'value'=>'0',  'sort_order'=>60],
                ['section'=>'section_2','key'=>'title',       'label'=>'Section 2 – Title',        'type'=>'text',     'value'=>'Leadership Philosophy', 'sort_order'=>61],
                ['section'=>'section_2','key'=>'subtitle',    'label'=>'Section 2 – Subtitle Tag', 'type'=>'text',     'value'=>'How We Lead',           'sort_order'=>62],
                ['section'=>'section_2','key'=>'description', 'label'=>'Section 2 – Description',  'type'=>'textarea', 'value'=>"Our leadership philosophy is grounded in three non-negotiable principles: transparency, integrity, and client-centricity. Every decision made at Shefa Homes — from site acquisition to title documentation — is filtered through these values.\n\nWe believe that a real estate firm's greatest asset is not its land bank, but the trust of its clients. That is why we invest heavily in communication, legal rigour, and post-sale support, ensuring that every investor who partners with us feels informed, protected, and valued at every step of the journey.", 'sort_order'=>63],
                ['section'=>'section_2','key'=>'image',       'label'=>'Section 2 – Image',        'type'=>'image',    'value'=>'',   'sort_order'=>64],
                ['section'=>'section_2','key'=>'image_side',  'label'=>'Section 2 – Image Side',   'type'=>'text',     'value'=>'left', 'sort_order'=>65],
                ['section'=>'section_2','key'=>'button_text', 'label'=>'Section 2 – Button Text',  'type'=>'text',     'value'=>'Meet Our Team', 'sort_order'=>66],
                ['section'=>'section_2','key'=>'button_url',  'label'=>'Section 2 – Button URL',   'type'=>'url',      'value'=>'/our-team', 'sort_order'=>67],
                ['section'=>'section_2','key'=>'bg',          'label'=>'Section 2 – Background',   'type'=>'text',     'value'=>'gray', 'sort_order'=>68],

                // Section 3 – Community Impact
                ['section'=>'section_3','key'=>'visible',     'label'=>'Section 3 – Visible',      'type'=>'boolean',  'value'=>'0',  'sort_order'=>70],
                ['section'=>'section_3','key'=>'title',       'label'=>'Section 3 – Title',        'type'=>'text',     'value'=>'Building Communities, Not Just Properties', 'sort_order'=>71],
                ['section'=>'section_3','key'=>'subtitle',    'label'=>'Section 3 – Subtitle Tag', 'type'=>'text',     'value'=>'Community Impact',     'sort_order'=>72],
                ['section'=>'section_3','key'=>'description', 'label'=>'Section 3 – Description',  'type'=>'textarea', 'value'=>"From the outset, Shefa Homes has embedded community development into its corporate DNA. We do not simply build estates — we build neighbourhoods. Each project we undertake includes a community infrastructure component: road networks, drainage systems, green spaces, and utility provisions that uplift the surrounding area.\n\nWe are proud to have directly impacted over 600 residents in Ifako-Ijaye through borehole drilling, solar lighting installation, and road construction — initiatives funded entirely by Shefa Homes as part of our commitment to community stewardship.", 'sort_order'=>73],
                ['section'=>'section_3','key'=>'image',       'label'=>'Section 3 – Image',        'type'=>'image',    'value'=>'',   'sort_order'=>74],
                ['section'=>'section_3','key'=>'image_side',  'label'=>'Section 3 – Image Side',   'type'=>'text',     'value'=>'right', 'sort_order'=>75],
                ['section'=>'section_3','key'=>'button_text', 'label'=>'Section 3 – Button Text',  'type'=>'text',     'value'=>'Our CSR Initiatives', 'sort_order'=>76],
                ['section'=>'section_3','key'=>'button_url',  'label'=>'Section 3 – Button URL',   'type'=>'url',      'value'=>'/csr', 'sort_order'=>77],
                ['section'=>'section_3','key'=>'bg',          'label'=>'Section 3 – Background',   'type'=>'text',     'value'=>'navy', 'sort_order'=>78],

                // Section 4 – Future Direction
                ['section'=>'section_4','key'=>'visible',     'label'=>'Section 4 – Visible',      'type'=>'boolean',  'value'=>'0',  'sort_order'=>80],
                ['section'=>'section_4','key'=>'title',       'label'=>'Section 4 – Title',        'type'=>'text',     'value'=>'Our Vision for the Next Decade', 'sort_order'=>81],
                ['section'=>'section_4','key'=>'subtitle',    'label'=>'Section 4 – Subtitle Tag', 'type'=>'text',     'value'=>'Future Direction',     'sort_order'=>82],
                ['section'=>'section_4','key'=>'description', 'label'=>'Section 4 – Description',  'type'=>'textarea', 'value'=>"The next decade at Shefa Homes is defined by scale, innovation, and continental ambition. We are actively developing a pipeline of 12 new estate projects across six Nigerian states, with plans to introduce PropTech-driven investment platforms that will allow diaspora and retail investors to participate in large-scale developments with flexible capital commitments.\n\nOur goal by 2030 is to become the most trusted real estate brand in West Africa — delivering government-approved properties to 50,000 families, and unlocking wealth-building opportunities for a new generation of African investors.", 'sort_order'=>83],
                ['section'=>'section_4','key'=>'image',       'label'=>'Section 4 – Image',        'type'=>'image',    'value'=>'',   'sort_order'=>84],
                ['section'=>'section_4','key'=>'image_side',  'label'=>'Section 4 – Image Side',   'type'=>'text',     'value'=>'left', 'sort_order'=>85],
                ['section'=>'section_4','key'=>'button_text', 'label'=>'Section 4 – Button Text',  'type'=>'text',     'value'=>'Partner With Us', 'sort_order'=>86],
                ['section'=>'section_4','key'=>'button_url',  'label'=>'Section 4 – Button URL',   'type'=>'url',      'value'=>'/contact', 'sort_order'=>87],
                ['section'=>'section_4','key'=>'bg',          'label'=>'Section 4 – Background',   'type'=>'text',     'value'=>'white', 'sort_order'=>88],
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

                // Section 1 – Land Acquisition Process
                ['section'=>'section_1','key'=>'visible',     'label'=>'Section 1 – Visible',      'type'=>'boolean',  'value'=>'0',  'sort_order'=>70],
                ['section'=>'section_1','key'=>'title',       'label'=>'Section 1 – Title',        'type'=>'text',     'value'=>'Our Land Acquisition Process', 'sort_order'=>71],
                ['section'=>'section_1','key'=>'subtitle',    'label'=>'Section 1 – Subtitle Tag', 'type'=>'text',     'value'=>'How We Acquire',              'sort_order'=>72],
                ['section'=>'section_1','key'=>'description', 'label'=>'Section 1 – Description',  'type'=>'textarea', 'value'=>"Every piece of land in the Shefa Homes portfolio undergoes a rigorous acquisition process before it is offered to investors. We begin with market intelligence — identifying high-growth corridors where land values are projected to appreciate significantly over a 5–10 year horizon.\n\nOnce a target location is identified, our team conducts an in-depth feasibility study covering infrastructure access, proximity to economic drivers, regulatory environment, and title history. Only parcels that pass all four filters enter our acquisition pipeline — ensuring that every property we offer is strategically sound.", 'sort_order'=>73],
                ['section'=>'section_1','key'=>'image',       'label'=>'Section 1 – Image',        'type'=>'image',    'value'=>'',   'sort_order'=>74],
                ['section'=>'section_1','key'=>'image_side',  'label'=>'Section 1 – Image Side',   'type'=>'text',     'value'=>'right', 'sort_order'=>75],
                ['section'=>'section_1','key'=>'button_text', 'label'=>'Section 1 – Button Text',  'type'=>'text',     'value'=>'View Available Properties', 'sort_order'=>76],
                ['section'=>'section_1','key'=>'button_url',  'label'=>'Section 1 – Button URL',   'type'=>'url',      'value'=>'/properties', 'sort_order'=>77],
                ['section'=>'section_1','key'=>'bg',          'label'=>'Section 1 – Background',   'type'=>'text',     'value'=>'white', 'sort_order'=>78],

                // Section 2 – Due Diligence & Verification
                ['section'=>'section_2','key'=>'visible',     'label'=>'Section 2 – Visible',      'type'=>'boolean',  'value'=>'0',  'sort_order'=>80],
                ['section'=>'section_2','key'=>'title',       'label'=>'Section 2 – Title',        'type'=>'text',     'value'=>'Due Diligence & Title Verification', 'sort_order'=>81],
                ['section'=>'section_2','key'=>'subtitle',    'label'=>'Section 2 – Subtitle Tag', 'type'=>'text',     'value'=>'Legal Security',                    'sort_order'=>82],
                ['section'=>'section_2','key'=>'description', 'label'=>'Section 2 – Description',  'type'=>'textarea', 'value'=>"Title security is non-negotiable at Shefa Homes. Before any property enters our sales catalogue, it undergoes a full legal due diligence process: survey plan verification, government approval confirmation, encumbrance search, and assignment documentation review.\n\nAll estates in our portfolio carry government-approved titles — Certificates of Occupancy (C of O), Registered Surveys, and Deeds of Assignment — giving our investors the highest level of legal protection available under Nigerian property law.", 'sort_order'=>83],
                ['section'=>'section_2','key'=>'image',       'label'=>'Section 2 – Image',        'type'=>'image',    'value'=>'',   'sort_order'=>84],
                ['section'=>'section_2','key'=>'image_side',  'label'=>'Section 2 – Image Side',   'type'=>'text',     'value'=>'left', 'sort_order'=>85],
                ['section'=>'section_2','key'=>'button_text', 'label'=>'Section 2 – Button Text',  'type'=>'text',     'value'=>'Request a Document Checklist', 'sort_order'=>86],
                ['section'=>'section_2','key'=>'button_url',  'label'=>'Section 2 – Button URL',   'type'=>'url',      'value'=>'/contact', 'sort_order'=>87],
                ['section'=>'section_2','key'=>'bg',          'label'=>'Section 2 – Background',   'type'=>'text',     'value'=>'gray', 'sort_order'=>88],

                // Section 3 – Project Delivery Standards
                ['section'=>'section_3','key'=>'visible',     'label'=>'Section 3 – Visible',      'type'=>'boolean',  'value'=>'0',  'sort_order'=>90],
                ['section'=>'section_3','key'=>'title',       'label'=>'Section 3 – Title',        'type'=>'text',     'value'=>'Our Project Delivery Standards', 'sort_order'=>91],
                ['section'=>'section_3','key'=>'subtitle',    'label'=>'Section 3 – Subtitle Tag', 'type'=>'text',     'value'=>'Built Right. Delivered on Time.',  'sort_order'=>92],
                ['section'=>'section_3','key'=>'description', 'label'=>'Section 3 – Description',  'type'=>'textarea', 'value'=>"We hold every development project to a defined set of quality and delivery standards — because our reputation is built on promises kept. Our in-house project management team works to ISO-aligned processes, with milestone-based reporting and transparent cost management at every stage.\n\nFrom site clearing and perimeter fencing to road construction and utility installation, each phase is independently verified before sign-off. Clients receive progress updates, photographic documentation, and site visit access throughout the development lifecycle.", 'sort_order'=>93],
                ['section'=>'section_3','key'=>'image',       'label'=>'Section 3 – Image',        'type'=>'image',    'value'=>'',   'sort_order'=>94],
                ['section'=>'section_3','key'=>'image_side',  'label'=>'Section 3 – Image Side',   'type'=>'text',     'value'=>'right', 'sort_order'=>95],
                ['section'=>'section_3','key'=>'button_text', 'label'=>'Section 3 – Button Text',  'type'=>'text',     'value'=>'Tour Our Active Estates', 'sort_order'=>96],
                ['section'=>'section_3','key'=>'button_url',  'label'=>'Section 3 – Button URL',   'type'=>'url',      'value'=>'/properties', 'sort_order'=>97],
                ['section'=>'section_3','key'=>'bg',          'label'=>'Section 3 – Background',   'type'=>'text',     'value'=>'navy', 'sort_order'=>98],

                // Section 4 – After-Sales Support
                ['section'=>'section_4','key'=>'visible',     'label'=>'Section 4 – Visible',      'type'=>'boolean',  'value'=>'0',  'sort_order'=>100],
                ['section'=>'section_4','key'=>'title',       'label'=>'Section 4 – Title',        'type'=>'text',     'value'=>'After-Sales Support That Never Ends', 'sort_order'=>101],
                ['section'=>'section_4','key'=>'subtitle',    'label'=>'Section 4 – Subtitle Tag', 'type'=>'text',     'value'=>'Lifetime Support',                   'sort_order'=>102],
                ['section'=>'section_4','key'=>'description', 'label'=>'Section 4 – Description',  'type'=>'textarea', 'value'=>"Our commitment to clients does not end at the point of sale. Every property purchaser is assigned a dedicated relationship manager who remains available throughout the payment plan period and beyond.\n\nPost-allocation, our After-Sales team assists with deed processing, land survey coordination, title upgrade support, and site access arrangement. We also operate a resale assistance programme for clients who wish to exit or transfer their investment — connecting sellers with verified buyers from our active investor network.", 'sort_order'=>103],
                ['section'=>'section_4','key'=>'image',       'label'=>'Section 4 – Image',        'type'=>'image',    'value'=>'',   'sort_order'=>104],
                ['section'=>'section_4','key'=>'image_side',  'label'=>'Section 4 – Image Side',   'type'=>'text',     'value'=>'left', 'sort_order'=>105],
                ['section'=>'section_4','key'=>'button_text', 'label'=>'Section 4 – Button Text',  'type'=>'text',     'value'=>'Contact Your Account Manager', 'sort_order'=>106],
                ['section'=>'section_4','key'=>'button_url',  'label'=>'Section 4 – Button URL',   'type'=>'url',      'value'=>'/contact', 'sort_order'=>107],
                ['section'=>'section_4','key'=>'bg',          'label'=>'Section 4 – Background',   'type'=>'text',     'value'=>'white', 'sort_order'=>108],
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

                // Section 1 – Housing for the Underserved
                ['section'=>'section_1','key'=>'visible',     'label'=>'Section 1 – Visible',      'type'=>'boolean',  'value'=>'0',  'sort_order'=>40],
                ['section'=>'section_1','key'=>'title',       'label'=>'Section 1 – Title',        'type'=>'text',     'value'=>'Affordable Housing for the Underserved', 'sort_order'=>41],
                ['section'=>'section_1','key'=>'subtitle',    'label'=>'Section 1 – Subtitle Tag', 'type'=>'text',     'value'=>'Housing for All',                       'sort_order'=>42],
                ['section'=>'section_1','key'=>'description', 'label'=>'Section 1 – Description',  'type'=>'textarea', 'value'=>"Property ownership should not be a privilege reserved for the wealthy. As part of our core CSR mandate, Shefa Homes reserves a dedicated portion of every new estate for subsidised housing units — offered to low-to-middle income earners through extended payment plans and reduced down payments.\n\nSince 2019, this programme has helped over 200 families access decent, government-approved homes in Lagos and Ogun State. Our target is to house 1,000 underserved families by 2027 through a combination of in-house subsidies and public-private partnership arrangements.", 'sort_order'=>43],
                ['section'=>'section_1','key'=>'image',       'label'=>'Section 1 – Image',        'type'=>'image',    'value'=>'',   'sort_order'=>44],
                ['section'=>'section_1','key'=>'image_side',  'label'=>'Section 1 – Image Side',   'type'=>'text',     'value'=>'right', 'sort_order'=>45],
                ['section'=>'section_1','key'=>'button_text', 'label'=>'Section 1 – Button Text',  'type'=>'text',     'value'=>'Learn About Our Housing Schemes', 'sort_order'=>46],
                ['section'=>'section_1','key'=>'button_url',  'label'=>'Section 1 – Button URL',   'type'=>'url',      'value'=>'/contact', 'sort_order'=>47],
                ['section'=>'section_1','key'=>'bg',          'label'=>'Section 1 – Background',   'type'=>'text',     'value'=>'white', 'sort_order'=>48],

                // Section 2 – Youth Empowerment
                ['section'=>'section_2','key'=>'visible',     'label'=>'Section 2 – Visible',      'type'=>'boolean',  'value'=>'0',  'sort_order'=>50],
                ['section'=>'section_2','key'=>'title',       'label'=>'Section 2 – Title',        'type'=>'text',     'value'=>'Empowering the Next Generation', 'sort_order'=>51],
                ['section'=>'section_2','key'=>'subtitle',    'label'=>'Section 2 – Subtitle Tag', 'type'=>'text',     'value'=>'Youth Empowerment',               'sort_order'=>52],
                ['section'=>'section_2','key'=>'description', 'label'=>'Section 2 – Description',  'type'=>'textarea', 'value'=>"Through the Shefa Trades Programme, we provide hands-on vocational training to young Nigerians aged 18–30 in construction-related skills — masonry, plumbing, electrical installation, carpentry, and project site management. Graduates are given priority placement on Shefa Homes construction sites and connected to our contractor network.\n\nSince launch, the programme has trained over 500 young people, with a 78% employment placement rate within six months of graduation. We are expanding the programme to cover real estate marketing, property management, and PropTech in 2025.", 'sort_order'=>53],
                ['section'=>'section_2','key'=>'image',       'label'=>'Section 2 – Image',        'type'=>'image',    'value'=>'',   'sort_order'=>54],
                ['section'=>'section_2','key'=>'image_side',  'label'=>'Section 2 – Image Side',   'type'=>'text',     'value'=>'left', 'sort_order'=>55],
                ['section'=>'section_2','key'=>'button_text', 'label'=>'Section 2 – Button Text',  'type'=>'text',     'value'=>'Apply for the Trades Programme', 'sort_order'=>56],
                ['section'=>'section_2','key'=>'button_url',  'label'=>'Section 2 – Button URL',   'type'=>'url',      'value'=>'/contact', 'sort_order'=>57],
                ['section'=>'section_2','key'=>'bg',          'label'=>'Section 2 – Background',   'type'=>'text',     'value'=>'gray', 'sort_order'=>58],

                // Section 3 – Environmental Responsibility
                ['section'=>'section_3','key'=>'visible',     'label'=>'Section 3 – Visible',      'type'=>'boolean',  'value'=>'0',  'sort_order'=>60],
                ['section'=>'section_3','key'=>'title',       'label'=>'Section 3 – Title',        'type'=>'text',     'value'=>'Our Commitment to the Environment', 'sort_order'=>61],
                ['section'=>'section_3','key'=>'subtitle',    'label'=>'Section 3 – Subtitle Tag', 'type'=>'text',     'value'=>'Environmental Responsibility',       'sort_order'=>62],
                ['section'=>'section_3','key'=>'description', 'label'=>'Section 3 – Description',  'type'=>'textarea', 'value'=>"Responsible development means leaving the land in a better state than we found it. Shefa Homes has adopted a Green Building Framework across all new estate projects — incorporating energy-efficient design, tree-planting mandates, solar-powered common infrastructure, and on-site waste segregation programmes.\n\nIn 2023 alone, we planted over 1,200 trees across our active development sites, installed solar streetlighting in three estates, and introduced a construction waste recycling protocol that diverted 40% of site waste from landfill. Our goal is net-zero site operations across all new projects by 2028.", 'sort_order'=>63],
                ['section'=>'section_3','key'=>'image',       'label'=>'Section 3 – Image',        'type'=>'image',    'value'=>'',   'sort_order'=>64],
                ['section'=>'section_3','key'=>'image_side',  'label'=>'Section 3 – Image Side',   'type'=>'text',     'value'=>'right', 'sort_order'=>65],
                ['section'=>'section_3','key'=>'button_text', 'label'=>'Section 3 – Button Text',  'type'=>'text',     'value'=>'Our Sustainability Report', 'sort_order'=>66],
                ['section'=>'section_3','key'=>'button_url',  'label'=>'Section 3 – Button URL',   'type'=>'url',      'value'=>'/contact', 'sort_order'=>67],
                ['section'=>'section_3','key'=>'bg',          'label'=>'Section 3 – Background',   'type'=>'text',     'value'=>'navy', 'sort_order'=>68],

                // Section 4 – Women in Real Estate
                ['section'=>'section_4','key'=>'visible',     'label'=>'Section 4 – Visible',      'type'=>'boolean',  'value'=>'0',  'sort_order'=>70],
                ['section'=>'section_4','key'=>'title',       'label'=>'Section 4 – Title',        'type'=>'text',     'value'=>'Women in Real Estate', 'sort_order'=>71],
                ['section'=>'section_4','key'=>'subtitle',    'label'=>'Section 4 – Subtitle Tag', 'type'=>'text',     'value'=>'Gender Inclusion',     'sort_order'=>72],
                ['section'=>'section_4','key'=>'description', 'label'=>'Section 4 – Description',  'type'=>'textarea', 'value'=>"Women represent one of the fastest-growing segments of property investors in Nigeria — yet they face systemic barriers to land ownership, construction sector employment, and real estate entrepreneurship. Shefa Homes is actively working to change this.\n\nOur Women in Real Estate initiative provides mentorship, preferential payment plan terms, and business development support to women who want to build wealth through property. We partner with women-led NGOs, SACCO groups, and corporate organisations to extend access to investment-grade land to communities that have historically been excluded from the formal property market.", 'sort_order'=>73],
                ['section'=>'section_4','key'=>'image',       'label'=>'Section 4 – Image',        'type'=>'image',    'value'=>'',   'sort_order'=>74],
                ['section'=>'section_4','key'=>'image_side',  'label'=>'Section 4 – Image Side',   'type'=>'text',     'value'=>'left', 'sort_order'=>75],
                ['section'=>'section_4','key'=>'button_text', 'label'=>'Section 4 – Button Text',  'type'=>'text',     'value'=>'Join the Initiative', 'sort_order'=>76],
                ['section'=>'section_4','key'=>'button_url',  'label'=>'Section 4 – Button URL',   'type'=>'url',      'value'=>'/contact', 'sort_order'=>77],
                ['section'=>'section_4','key'=>'bg',          'label'=>'Section 4 – Background',   'type'=>'text',     'value'=>'white', 'sort_order'=>78],
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
