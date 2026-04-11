<?php
namespace App\Http\Controllers\Public;
use App\Http\Controllers\Controller;
use App\Models\{Property, PropertyType, Estate};
use Illuminate\Http\Request;

class PropertyController extends Controller {
    public function index(Request $request) {
        $query = Property::with('propertyType','estate')->where('is_active',true);
        if($request->state) $query->where('state',$request->state);
        if($request->type) $query->whereHas('propertyType', fn($q) => $q->where('slug',$request->type));
        if($request->status) $query->where('status',$request->status);
        if($request->price_min) $query->where('price_from','>=',$request->price_min);
        if($request->price_max) $query->where('price_from','<=',$request->price_max);

        $sort = $request->sort ?? 'featured';
        match($sort) {
            'price_asc' => $query->orderBy('price_from'),
            'price_desc' => $query->orderByDesc('price_from'),
            'newest' => $query->latest(),
            default => $query->orderByDesc('is_featured')->latest()
        };

        $properties = $query->paginate(12)->withQueryString();
        $propertyTypes = PropertyType::all();
        $states = Property::where('is_active',true)->distinct()->pluck('state')->sort();
        $estates = Estate::where('is_active',true)->get();
        return view('public.properties.index', compact('properties','propertyTypes','states','estates'));
    }

    public function show(string $slug) {
        $property = Property::where('slug',$slug)->where('is_active',true)
            ->with(['propertyType','estate','galleries','virtualTours'])->firstOrFail();
        $related = Property::where('state',$property->state)->where('id','!=',$property->id)
            ->where('is_active',true)->take(3)->get();
        return view('public.properties.show', compact('property','related'));
    }
}
