<?php
namespace App\Http\Controllers\Public;
use App\Http\Controllers\Controller;
use App\Models\FaqCategory;

class FaqController extends Controller {
    public function index() {
        $categories = FaqCategory::with('faqs')->orderBy('sort_order')->get();
        return view('public.faqs.index', compact('categories'));
    }
}
