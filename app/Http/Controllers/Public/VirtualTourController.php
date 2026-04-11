<?php
namespace App\Http\Controllers\Public;
use App\Http\Controllers\Controller;
use App\Models\{VirtualTour, Property};
use Illuminate\Http\Request;

class VirtualTourController extends Controller {
    public function index(Request $request) {
        $tours = VirtualTour::where('is_active',true)->with('property')->get();
        $activeTour = $request->tour ? VirtualTour::find($request->tour) : $tours->first();
        $properties = Property::where('is_active',true)->has('virtualTours')->get();
        return view('public.virtual-tour.index', compact('tours','activeTour','properties'));
    }
}
