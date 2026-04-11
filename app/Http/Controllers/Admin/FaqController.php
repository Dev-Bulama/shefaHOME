<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\{Faq, FaqCategory};
use Illuminate\Http\Request;

class FaqController extends Controller {
    public function index() { return view('admin.faqs.index', ['faqs'=>Faq::with('category')->orderBy('sort_order')->get(),'categories'=>FaqCategory::all()]); }
    public function create() { return view('admin.faqs.create', ['categories'=>FaqCategory::all()]); }
    public function store(Request $request) {
        $data = $request->validate(['faq_category_id'=>'required|exists:faq_categories,id','question'=>'required','answer'=>'required']);
        $data['is_active']=$request->boolean('is_active',true); $data['sort_order']=$request->sort_order??0;
        Faq::create($data);
        return redirect()->route('admin.faqs.index')->with('success','FAQ added!');
    }
    public function edit($id) { return view('admin.faqs.edit', ['faq'=>Faq::findOrFail($id),'categories'=>FaqCategory::all()]); }
    public function update(Request $request, $id) {
        $faq=Faq::findOrFail($id);
        $data=$request->validate(['faq_category_id'=>'required','question'=>'required','answer'=>'required']);
        $data['is_active']=$request->boolean('is_active',true); $data['sort_order']=$request->sort_order??0;
        $faq->update($data);
        return redirect()->route('admin.faqs.index')->with('success','FAQ updated!');
    }
    public function destroy($id) { Faq::findOrFail($id)->delete(); return redirect()->route('admin.faqs.index')->with('success','Deleted!'); }
}
