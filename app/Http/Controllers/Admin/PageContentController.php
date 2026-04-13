<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PageContent;
use App\Helpers\PageContent as PageContentHelper;
use Illuminate\Http\Request;

class PageContentController extends Controller
{
    /** List of pages with human-readable names */
    private static array $pages = [
        'home'           => 'Home Page',
        'about'          => 'About Us',
        'services'       => 'Our Services',
        'joint-venture'  => 'JV Partnership',
        'investor-info'  => 'Invest With Us',
        'contact'        => 'Contact Us',
        'properties'     => 'Properties',
        'csr'            => 'CSR',
        'blog'           => 'Blog',
        'careers'        => 'Careers',
        'faqs'           => 'FAQs',
    ];

    public function index()
    {
        $pages = [];
        foreach (self::$pages as $slug => $name) {
            try {
                $count = PageContent::where('page', $slug)->count();
            } catch (\Throwable $e) {
                $count = 0;
            }
            $pages[] = ['slug' => $slug, 'name' => $name, 'fields' => $count];
        }
        return view('admin.pages.index', compact('pages'));
    }

    public function edit(string $page)
    {
        abort_unless(array_key_exists($page, self::$pages), 404);

        $pageName = self::$pages[$page];
        try {
            $rows = PageContent::where('page', $page)->orderBy('sort_order')->get()->groupBy('section');
        } catch (\Throwable $e) {
            $rows = collect();
        }

        return view('admin.pages.edit', compact('page', 'pageName', 'rows'));
    }

    public function update(Request $request, string $page)
    {
        abort_unless(array_key_exists($page, self::$pages), 404);

        $fields = $request->input('content', []);

        foreach ($fields as $section => $keys) {
            foreach ($keys as $key => $value) {
                PageContent::where('page', $page)
                    ->where('section', $section)
                    ->where('key', $key)
                    ->update(['value' => $value]);
            }
        }

        // Flush in-memory cache
        PageContentHelper::flushCache();

        return back()->with('success', 'Page content updated successfully.');
    }

    public function addField(Request $request, string $page)
    {
        abort_unless(array_key_exists($page, self::$pages), 404);

        $data = $request->validate([
            'section'  => 'required|string|max:80|regex:/^[a-z0-9_-]+$/',
            'key'      => 'required|string|max:80|regex:/^[a-z0-9_-]+$/',
            'label'    => 'required|string|max:120',
            'type'     => 'required|in:text,textarea,html,image,url',
            'value'    => 'nullable|string',
        ]);

        $data['page']       = $page;
        $data['sort_order'] = PageContent::where('page', $page)->max('sort_order') + 1;

        PageContent::firstOrCreate(
            ['page' => $page, 'section' => $data['section'], 'key' => $data['key']],
            $data
        );

        return back()->with('success', 'New field added.');
    }

    public function deleteField(int $id)
    {
        PageContent::findOrFail($id)->delete();
        return back()->with('success', 'Field removed.');
    }
}
