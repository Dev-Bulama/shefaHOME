<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Estate;
use App\Services\ImageService;
use Illuminate\Http\Request;
class EstateController extends Controller {
    public function index() { return view('admin.estates.index', ['estates'=>Estate::withCount('properties')->latest()->get()]); }
    public function create() { return view('admin.estates.create'); }
    public function store(Request $request) {
        $data=$request->validate(['name'=>'required','state'=>'required']);
        if($request->hasFile('cover_image')) $data['cover_image']=ImageService::upload($request->file('cover_image'),'estates');
        $data['description']=$request->description; $data['is_active']=$request->boolean('is_active',true);
        Estate::create($data); return redirect()->route('admin.estates.index')->with('success','Estate created!');
    }
    public function edit($id) { return view('admin.estates.edit', ['estate'=>Estate::findOrFail($id)]); }
    public function update(Request $request, $id) {
        $estate=Estate::findOrFail($id); $data=$request->validate(['name'=>'required','state'=>'required']);
        if($request->hasFile('cover_image')) { if($estate->cover_image)ImageService::delete($estate->cover_image); $data['cover_image']=ImageService::upload($request->file('cover_image'),'estates'); }
        $data['description']=$request->description; $data['is_active']=$request->boolean('is_active',true);
        $estate->update($data); return redirect()->route('admin.estates.index')->with('success','Updated!');
    }
    public function destroy($id) { Estate::findOrFail($id)->delete(); return redirect()->route('admin.estates.index')->with('success','Deleted!'); }
}
