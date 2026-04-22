<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\PropertyType;
use Illuminate\Http\Request;
class PropertyTypeController extends Controller {
    public function index() { return view('admin.property-types.index', ['types'=>PropertyType::withCount('properties')->get()]); }
    public function store(Request $request) {
        $request->validate(['name'=>'required|unique:property_types,name','listing_type'=>'nullable|in:rent,buy,buy_and_rent,shortlet']);
        PropertyType::create(['name'=>$request->name,'icon'=>$request->icon,'description'=>$request->description,'listing_type'=>$request->listing_type ?: null]);
        return back()->with('success','Created!');
    }
    public function update(Request $request, $id) {
        $request->validate(['listing_type'=>'nullable|in:rent,buy,buy_and_rent,shortlet']);
        PropertyType::findOrFail($id)->update(['name'=>$request->name,'icon'=>$request->icon,'description'=>$request->description,'listing_type'=>$request->listing_type ?: null]);
        return back()->with('success','Updated!');
    }
    public function destroy($id) { PropertyType::findOrFail($id)->delete(); return back()->with('success','Deleted!'); }
}
