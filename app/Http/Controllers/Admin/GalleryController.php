<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryItem;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        $category = $request->input('category', 'all');
        $items = GalleryItem::when($category !== 'all', fn($q) => $q->where('category', $category))
            ->orderBy('sort_order')->orderBy('id', 'desc')
            ->paginate(20)->withQueryString();

        return view('admin.gallery.index', compact('items', 'category'));
    }

    public function create()
    {
        return view('admin.gallery.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:200',
            'caption'     => 'nullable|string|max:500',
            'category'    => 'required|in:general,projects,events,team,properties',
            'type'        => 'required|in:image,video',
            'is_featured' => 'boolean',
            'is_active'   => 'boolean',
            'file'        => 'required_if:type,image|nullable|file|mimes:jpg,jpeg,png,gif,webp|max:10240',
            'video_file'  => 'required_if:type,video|nullable|file|mimes:mp4,mov,webm,avi|max:102400',
        ]);

        $file = $request->hasFile('video_file') ? $request->file('video_file') : $request->file('file');
        if ($file) {
            if ($data['type'] === 'image') {
                $data['file_path'] = ImageService::upload($file, 'gallery');
            } else {
                $folder   = 'gallery/videos';
                $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
                Storage::disk('public')->putFileAs($folder, $file, $filename);
                $data['file_path'] = $folder . '/' . $filename;
            }
        }

        $data['sort_order']   = GalleryItem::max('sort_order') + 1;
        $data['is_featured']  = $request->boolean('is_featured');
        $data['is_active']    = $request->boolean('is_active', true);

        GalleryItem::create($data);
        return redirect()->route('admin.gallery.index')->with('success', 'Gallery item added.');
    }

    public function edit(GalleryItem $galleryItem)
    {
        return view('admin.gallery.edit', compact('galleryItem'));
    }

    public function update(Request $request, GalleryItem $galleryItem)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:200',
            'caption'     => 'nullable|string|max:500',
            'category'    => 'required|in:general,projects,events,team,properties',
            'is_featured' => 'boolean',
            'is_active'   => 'boolean',
            'file'        => 'nullable|file|mimes:jpg,jpeg,png,gif,webp|max:10240',
            'video_file'  => 'nullable|file|mimes:mp4,mov,webm,avi|max:102400',
        ]);

        $file = $request->hasFile('video_file') ? $request->file('video_file') : ($request->hasFile('file') ? $request->file('file') : null);
        if ($file) {
            Storage::disk('public')->delete($galleryItem->file_path);
            if ($galleryItem->type === 'image' || $request->hasFile('file')) {
                $data['file_path'] = ImageService::upload($file, 'gallery');
            } else {
                $folder   = 'gallery/videos';
                $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
                Storage::disk('public')->putFileAs($folder, $file, $filename);
                $data['file_path'] = $folder . '/' . $filename;
            }
        }

        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_active']   = $request->boolean('is_active', true);

        $galleryItem->update($data);
        return redirect()->route('admin.gallery.index')->with('success', 'Gallery item updated.');
    }

    public function destroy(GalleryItem $galleryItem)
    {
        Storage::disk('public')->delete($galleryItem->file_path);
        $galleryItem->delete();
        return back()->with('success', 'Gallery item deleted.');
    }
}
