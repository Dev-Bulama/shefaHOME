<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Partner;
use App\Services\ImageService;
use Illuminate\Http\Request;
class PartnerController extends Controller {
    public function index() { return view('admin.partners.index', ['partners'=>Partner::orderBy('sort_order')->get()]); }
    public function create() { return view('admin.partners.create'); }
    public function store(Request $request) {
        $data=$request->validate(['name'=>'required','logo'=>'required|image|max:2048']);
        $data['logo']=ImageService::upload($request->file('logo'),'partners');
        $data['website']=$request->website; $data['sort_order']=$request->sort_order??0; $data['is_active']=true;
        Partner::create($data); return redirect()->route('admin.partners.index')->with('success','Partner added!');
    }
    public function edit($id) { return view('admin.partners.edit', ['partner'=>Partner::findOrFail($id)]); }
    public function update(Request $request, $id) {
        $p=Partner::findOrFail($id); $data=$request->validate(['name'=>'required']);
        if($request->hasFile('logo')) { ImageService::delete($p->logo); $data['logo']=ImageService::upload($request->file('logo'),'partners'); }
        $data['website']=$request->website; $data['sort_order']=$request->sort_order??0; $data['is_active']=$request->boolean('is_active',true);
        $p->update($data); return redirect()->route('admin.partners.index')->with('success','Updated!');
    }
    public function destroy($id) { Partner::findOrFail($id)->delete(); return redirect()->route('admin.partners.index')->with('success','Deleted!'); }
}
