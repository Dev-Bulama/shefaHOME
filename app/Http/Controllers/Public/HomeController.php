<?php
namespace App\Http\Controllers\Public;
use App\Http\Controllers\Controller;
use App\Models\{Slider, Property, Stat, Testimonial, BlogPost, Partner, Award};

class HomeController extends Controller {
    public function index() {
        $sliders = Slider::active()->get();
        $featuredProperties = Property::featured()->with('propertyType','estate')->take(6)->get();
        $stats = Stat::orderBy('sort_order')->get();
        $testimonials = Testimonial::featured()->take(6)->get();
        $latestPosts = BlogPost::published()->latest('published_at')->take(3)->get();
        $partners = Partner::where('is_active',true)->orderBy('sort_order')->get();
        $awards = Award::orderBy('sort_order')->take(4)->get();
        return view('public.home.index', compact('sliders','featuredProperties','stats','testimonials','latestPosts','partners','awards'));
    }
}
