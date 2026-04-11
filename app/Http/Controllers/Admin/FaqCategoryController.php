<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\FaqCategory;
use Illuminate\Http\Request;

class FaqCategoryController extends Controller {
    public function store(Request $request) { FaqCategory::create($request->validate(['name'=>'required','slug'=>'required|unique:faq_categories'])); return back()->with('success','Created!'); }
    public function update(Request $request, $id) { FaqCategory::findOrFail($id)->update($request->validate(['name'=>'required'])); return back()->with('success','Updated!'); }
    public function destroy($id) { FaqCategory::findOrFail($id)->delete(); return back()->with('success','Deleted!'); }
}
