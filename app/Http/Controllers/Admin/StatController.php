<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Stat;
use Illuminate\Http\Request;
class StatController extends Controller {
    public function index() { return view('admin.stats.index', ['stats'=>Stat::orderBy('sort_order')->get()]); }
    public function create() { return view('admin.stats.create'); }
    public function store(Request $request) { $data=$request->validate(['label'=>'required','value'=>'required']); $data['icon']=$request->icon; $data['sort_order']=$request->sort_order??0; Stat::create($data); return redirect()->route('admin.stats.index')->with('success','Stat added!'); }
    public function edit($id) { return view('admin.stats.edit', ['stat'=>Stat::findOrFail($id)]); }
    public function update(Request $request, $id) { $data=$request->validate(['label'=>'required','value'=>'required']); $data['icon']=$request->icon; $data['sort_order']=$request->sort_order??0; Stat::findOrFail($id)->update($data); return redirect()->route('admin.stats.index')->with('success','Updated!'); }
    public function destroy($id) { Stat::findOrFail($id)->delete(); return redirect()->route('admin.stats.index')->with('success','Deleted!'); }
}
