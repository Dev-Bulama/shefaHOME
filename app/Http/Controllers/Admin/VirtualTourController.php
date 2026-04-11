<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\{VirtualTour, Property};
use App\Services\ImageService;
use Illuminate\Http\Request;
class VirtualTourController extends Controller {
    public function index() { return view('admin.virtual-tours.index', ['tours'=>VirtualTour::with('property')->latest()->get()]); }
    public function create() { return view('admin.virtual-tours.create', ['properties'=>Property::where('is_active',true)->get()]); }
    public function store(Request $request) {
        $data=$request->validate(['title'=>'required','embed_url'=>'required','type'=>'required|in:youtube,matterport,other']);
        $data['property_id']=$request->property_id??null;
        if($request->hasFile('thumbnail')) $data['thumbnail']=ImageService::upload($request->file('thumbnail'),'tours');
        $data['is_active']=$request->boolean('is_active',true);
        VirtualTour::create($data); return redirect()->route('admin.virtual-tours.index')->with('success','Tour added!');
    }
    public function edit($id) { return view('admin.virtual-tours.edit', ['tour'=>VirtualTour::findOrFail($id),'properties'=>Property::where('is_active',true)->get()]); }
    public function update(Request $request, $id) {
        $tour=VirtualTour::findOrFail($id); $data=$request->validate(['title'=>'required','embed_url'=>'required','type'=>'required']);
        $data['property_id']=$request->property_id??null;
        if($request->hasFile('thumbnail')) { if($tour->thumbnail)ImageService::delete($tour->thumbnail); $data['thumbnail']=ImageService::upload($request->file('thumbnail'),'tours'); }
        $data['is_active']=$request->boolean('is_active',true);
        $tour->update($data); return redirect()->route('admin.virtual-tours.index')->with('success','Updated!');
    }
    public function destroy($id) { VirtualTour::findOrFail($id)->delete(); return redirect()->route('admin.virtual-tours.index')->with('success','Deleted!'); }
}
