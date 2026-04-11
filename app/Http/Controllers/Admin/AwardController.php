<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Award;
use App\Services\ImageService;
use Illuminate\Http\Request;
class AwardController extends Controller {
    public function index() { return view('admin.awards.index', ['awards'=>Award::orderBy('sort_order')->get()]); }
    public function create() { return view('admin.awards.create'); }
    public function store(Request $request) {
        $data = $request->validate(['title'=>'required','year'=>'required']);
        if($request->hasFile('image')) $data['image']=ImageService::upload($request->file('image'),'awards');
        $data['description']=$request->description; $data['sort_order']=$request->sort_order??0;
        Award::create($data); return redirect()->route('admin.awards.index')->with('success','Award added!');
    }
    public function edit($id) { return view('admin.awards.edit', ['award'=>Award::findOrFail($id)]); }
    public function update(Request $request, $id) {
        $award=Award::findOrFail($id); $data=$request->validate(['title'=>'required','year'=>'required']);
        if($request->hasFile('image')) { if($award->image)ImageService::delete($award->image); $data['image']=ImageService::upload($request->file('image'),'awards'); }
        $data['description']=$request->description; $data['sort_order']=$request->sort_order??0;
        $award->update($data); return redirect()->route('admin.awards.index')->with('success','Updated!');
    }
    public function destroy($id) { Award::findOrFail($id)->delete(); return redirect()->route('admin.awards.index')->with('success','Deleted!'); }
}
