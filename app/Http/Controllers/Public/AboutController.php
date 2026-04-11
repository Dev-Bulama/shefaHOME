<?php
namespace App\Http\Controllers\Public;
use App\Http\Controllers\Controller;
use App\Models\{TeamMember, Award, Partner, Stat};

class AboutController extends Controller {
    public function index() {
        $team = TeamMember::active()->get();
        $awards = Award::orderBy('sort_order')->get();
        $partners = Partner::where('is_active',true)->orderBy('sort_order')->get();
        $stats = Stat::orderBy('sort_order')->get();
        return view('public.about.index', compact('team','awards','partners','stats'));
    }
}
