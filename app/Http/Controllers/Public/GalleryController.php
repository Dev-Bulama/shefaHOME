<?php
namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\GalleryItem;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        $category = $request->input('category', 'all');

        $items = GalleryItem::active()
            ->when($category !== 'all', fn($q) => $q->where('category', $category))
            ->paginate(12)->withQueryString();

        $categories = GalleryItem::active()
            ->distinct()
            ->pluck('category')
            ->prepend('all');

        return view('public.gallery.index', compact('items', 'category', 'categories'));
    }
}
