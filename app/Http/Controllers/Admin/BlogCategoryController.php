<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use Illuminate\Http\Request;

class BlogCategoryController extends Controller {
    public function index() { return view('admin.blog.categories', ['categories' => BlogCategory::withCount('posts')->get()]); }
    public function store(Request $request) {
        BlogCategory::create($request->validate(['name'=>'required|unique:blog_categories,name']));
        return back()->with('success','Category created!');
    }
    public function update(Request $request, $id) {
        BlogCategory::findOrFail($id)->update($request->validate(['name'=>'required']));
        return back()->with('success','Updated!');
    }
    public function destroy($id) { BlogCategory::findOrFail($id)->delete(); return back()->with('success','Deleted!'); }
}
