<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\{Property, PropertyType, Estate, PropertyGallery};
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PropertyController extends Controller {
    public function index(Request $request) {
        $query = Property::with('propertyType','estate');
        if($request->search) $query->where('title','like','%'.$request->search.'%');
        if($request->state) $query->where('state',$request->state);
        if($request->type) $query->where('property_type_id',$request->type);
        if($request->status) $query->where('status',$request->status);
        $properties = $query->latest()->paginate(15)->withQueryString();
        $propertyTypes = PropertyType::all();
        $states = Property::distinct()->pluck('state')->sort();
        return view('admin.properties.index', compact('properties','propertyTypes','states'));
    }

    public function bulkDestroy(Request $request) {
        $ids = $request->input('ids', []);
        if(!empty($ids)) {
            Property::whereIn('id', $ids)->delete();
        }
        return response()->json(['success' => true, 'deleted' => count($ids)]);
    }

    public function create() {
        $propertyTypes = PropertyType::all();
        $estates = Estate::where('is_active',true)->get();
        return view('admin.properties.create', compact('propertyTypes','estates'));
    }

    public function store(Request $request) {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'property_type_id' => 'required|exists:property_types,id',
            'estate_id' => 'nullable|exists:estates,id',
            'short_description' => 'required|string|max:500',
            'description' => 'required|string',
            'state' => 'required|string',
            'lga' => 'required|string',
            'address' => 'required|string',
            'price_from' => 'required|numeric|min:0',
            'cover_image' => 'required|image|max:5120',
            'status' => 'required|in:available,sold_out,coming_soon,rent,buy,buy_and_rent,shortlet',
        ]);

        $data['cover_image'] = ImageService::upload($request->file('cover_image'), 'properties');
        $data['price_to'] = $request->price_to ?: null;
        $data['plot_sizes'] = $request->plot_sizes ? json_encode(array_filter(explode(',', $request->plot_sizes))) : null;
        $data['payment_plans'] = $request->payment_plans_json ?: null;
        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_active'] = $request->boolean('is_active', true);
        $data['latitude'] = $request->latitude ?: null;
        $data['longitude'] = $request->longitude ?: null;
        $data['total_units'] = $request->total_units ?: null;
        $data['available_units'] = $request->available_units ?: null;
        $data['virtual_tour_url'] = $request->virtual_tour_url ?: null;
        $data['video_url'] = $request->video_url ?: null;

        $property = Property::create($data);

        // Handle gallery uploads
        if($request->hasFile('gallery')) {
            foreach($request->file('gallery') as $i => $img) {
                $path = ImageService::upload($img, 'properties/gallery');
                PropertyGallery::create(['property_id'=>$property->id,'image'=>$path,'sort_order'=>$i]);
            }
        }

        return redirect()->route('admin.properties.index')->with('success','Property created successfully!');
    }

    public function show($id) {
        $property = Property::withTrashed()->with('propertyType','estate','galleries')->findOrFail($id);
        return view('admin.properties.show', compact('property'));
    }

    public function edit($id) {
        $property = Property::findOrFail($id);
        $propertyTypes = PropertyType::all();
        $estates = Estate::where('is_active',true)->get();
        return view('admin.properties.edit', compact('property','propertyTypes','estates'));
    }

    public function update(Request $request, $id) {
        $property = Property::findOrFail($id);
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'property_type_id' => 'required|exists:property_types,id',
            'estate_id' => 'nullable|exists:estates,id',
            'short_description' => 'required|string|max:500',
            'description' => 'required|string',
            'state' => 'required|string',
            'lga' => 'required|string',
            'address' => 'required|string',
            'price_from' => 'required|numeric|min:0',
            'cover_image' => 'nullable|image|max:5120',
            'status' => 'required|in:available,sold_out,coming_soon,rent,buy,buy_and_rent,shortlet',
        ]);

        if($request->hasFile('cover_image')) {
            ImageService::delete($property->cover_image);
            $data['cover_image'] = ImageService::upload($request->file('cover_image'), 'properties');
        } else {
            unset($data['cover_image']);
        }

        $data['price_to'] = $request->price_to ?: null;
        $data['plot_sizes'] = $request->plot_sizes ? json_encode(array_filter(explode(',', $request->plot_sizes))) : null;
        $data['payment_plans'] = $request->payment_plans_json ?: null;
        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_active'] = $request->boolean('is_active', true);

        $property->update($data);
        return redirect()->route('admin.properties.index')->with('success','Property updated successfully!');
    }

    public function destroy($id) {
        $property = Property::findOrFail($id);
        $property->delete();
        return redirect()->route('admin.properties.index')->with('success','Property deleted!');
    }

    public function uploadGallery(Request $request, $id) {
        $request->validate(['images.*' => 'image|max:5120']);
        $property = Property::findOrFail($id);
        $lastOrder = $property->galleries()->max('sort_order') ?? 0;
        $uploaded = [];
        foreach($request->file('images') as $i => $img) {
            $path = ImageService::upload($img, 'properties/gallery');
            $gallery = PropertyGallery::create(['property_id'=>$id,'image'=>$path,'sort_order'=>$lastOrder+$i+1]);
            $uploaded[] = ['id'=>$gallery->id,'url'=>asset('uploads/'.$path)];
        }
        return response()->json(['success'=>true,'images'=>$uploaded]);
    }

    public function deleteGalleryImage($id, $imageId) {
        $image = PropertyGallery::where('property_id',$id)->findOrFail($imageId);
        ImageService::delete($image->image);
        $image->delete();
        return response()->json(['success'=>true]);
    }

    public function reorderGallery(Request $request) {
        foreach($request->order as $item) {
            PropertyGallery::where('id',$item['id'])->update(['sort_order'=>$item['order']]);
        }
        return response()->json(['success'=>true]);
    }
}
