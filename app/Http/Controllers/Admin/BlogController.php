<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\{BlogPost, BlogCategory};
use App\Services\ImageService;
use Illuminate\Http\Request;

class BlogController extends Controller {
    public function index() { return view('admin.blog.index', ['posts' => BlogPost::with('category','author')->withTrashed()->latest()->paginate(20)]); }
    public function create() { return view('admin.blog.create', ['categories' => BlogCategory::all()]); }

    public function store(Request $request) {
        $data = $request->validate(['title'=>'required','blog_category_id'=>'required|exists:blog_categories,id','excerpt'=>'required|string|max:500','body'=>'required','featured_image'=>'required|image|max:5120']);
        $data['featured_image'] = ImageService::upload($request->file('featured_image'), 'blog');
        $data['author_id'] = auth()->id();
        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_published'] = $request->boolean('is_published');
        $data['published_at'] = $request->boolean('is_published') ? ($request->published_at ?? now()) : null;
        $data['meta_title'] = $request->meta_title; $data['meta_description'] = $request->meta_description;
        BlogPost::create($data);
        return redirect()->route('admin.blog.index')->with('success','Blog post created!');
    }

    public function edit($id) { return view('admin.blog.edit', ['post'=>BlogPost::findOrFail($id),'categories'=>BlogCategory::all()]); }

    public function update(Request $request, $id) {
        $post = BlogPost::findOrFail($id);
        $data = $request->validate(['title'=>'required','blog_category_id'=>'required|exists:blog_categories,id','excerpt'=>'required|string|max:500','body'=>'required','featured_image'=>'nullable|image|max:5120']);
        if($request->hasFile('featured_image')) { ImageService::delete($post->featured_image); $data['featured_image'] = ImageService::upload($request->file('featured_image'), 'blog'); } else { unset($data['featured_image']); }
        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_published'] = $request->boolean('is_published');
        $data['published_at'] = $request->boolean('is_published') ? ($post->published_at ?? now()) : null;
        $data['meta_title'] = $request->meta_title; $data['meta_description'] = $request->meta_description;
        $post->update($data);
        return redirect()->route('admin.blog.index')->with('success','Post updated!');
    }

    public function destroy($id) { BlogPost::findOrFail($id)->delete(); return redirect()->route('admin.blog.index')->with('success','Post deleted!'); }
}
