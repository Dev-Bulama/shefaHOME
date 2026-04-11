<?php
namespace App\Http\Controllers\Public;
use App\Http\Controllers\Controller;
use App\Models\Testimonial;

class TestimonialController extends Controller {
    public function index() {
        $testimonials = Testimonial::where('is_active',true)->orderBy('sort_order')->paginate(12);
        $videoTestimonials = Testimonial::where('is_active',true)->whereNotNull('video_url')->get();
        return view('public.testimonials.index', compact('testimonials','videoTestimonials'));
    }
}
