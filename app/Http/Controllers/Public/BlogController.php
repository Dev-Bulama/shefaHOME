<?php
namespace App\Http\Controllers\Public;
use App\Http\Controllers\Controller;
use App\Models\{BlogPost, BlogCategory};
use Illuminate\Http\Request;

class BlogController extends Controller {
    public function index() {
        $posts = BlogPost::published()->with('category','author')->latest('published_at')->paginate(9);
        $categories = BlogCategory::withCount(['posts' => fn($q) => $q->published()])->get();
        $featured = BlogPost::published()->where('is_featured',true)->latest('published_at')->first();
        return view('public.blog.index', compact('posts','categories','featured'));
    }

    public function show(string $slug) {
        $post = BlogPost::published()->where('slug',$slug)->with('category','author')->firstOrFail();
        $post->increment('views');
        $related = BlogPost::published()->where('blog_category_id',$post->blog_category_id)->where('id','!=',$post->id)->take(3)->get();
        $categories = BlogCategory::withCount(['posts' => fn($q) => $q->published()])->get();
        return view('public.blog.show', compact('post','related','categories'));
    }

    public function category(string $slug) {
        $category = BlogCategory::where('slug',$slug)->firstOrFail();
        $posts = BlogPost::published()->where('blog_category_id',$category->id)->latest('published_at')->paginate(9);
        $categories = BlogCategory::withCount(['posts' => fn($q) => $q->published()])->get();
        return view('public.blog.category', compact('category','posts','categories'));
    }
}
