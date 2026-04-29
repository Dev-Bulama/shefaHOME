<?php
namespace App\Http\Controllers\Public;
use App\Http\Controllers\Controller;
use App\Models\{Property, PropertyType, Estate};
use Illuminate\Http\Request;

class PropertyController extends Controller {
    public function index(Request $request) {
        $query = Property::with('propertyType','estate')->where('is_active', true);

        // State — multi-select checkboxes send state[]=Lagos&state[]=Ogun
        if ($request->filled('state')) {
            $states = array_filter((array) $request->input('state'));
            if ($states) $query->whereIn('state', $states);
        }

        // Type — radio sends the PropertyType ID (not slug)
        if ($request->filled('type')) {
            $query->where('property_type_id', $request->input('type'));
        }

        // Status — direct exact match (rent, buy, shortlet, available, etc.)
        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        // Price range — form fields are named min_price / max_price
        if ($request->filled('min_price')) {
            $query->where('price_from', '>=', (float) $request->input('min_price'));
        }
        if ($request->filled('max_price')) {
            $query->where('price_from', '<=', (float) $request->input('max_price'));
        }

        // Keyword search by title
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->input('search') . '%');
        }

        // Sort
        match ($request->input('sort', 'featured')) {
            'price_asc'  => $query->orderBy('price_from'),
            'price_desc' => $query->orderByDesc('price_from'),
            'latest'     => $query->latest(),
            'popular'    => $query->orderByDesc('is_featured')->latest(),
            default      => $query->orderByDesc('is_featured')->latest(),
        };

        $properties    = $query->paginate(12)->withQueryString();
        $propertyTypes = PropertyType::all();
        $states        = Property::where('is_active', true)->distinct()->pluck('state')->filter()->sort()->values();
        $estates       = Estate::where('is_active', true)->get();
        return view('public.properties.index', compact('properties','propertyTypes','states','estates'));
    }

    public function show(string $slug) {
        $property = Property::where('slug', $slug)->where('is_active', true)
            ->with(['propertyType','estate','galleries','virtualTours'])->firstOrFail();
        $related = Property::where('state', $property->state)->where('id', '!=', $property->id)
            ->where('is_active', true)->take(3)->get();
        return view('public.properties.show', compact('property','related'));
    }
}
