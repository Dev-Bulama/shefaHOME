<?php
namespace App\Http\Controllers\Public;
use App\Http\Controllers\Controller;
use App\Models\{Career, CareerApplication};
use Illuminate\Http\Request;
use App\Services\ImageService;
use Illuminate\Support\Facades\Storage;

class CareerController extends Controller {
    public function index() {
        $careers = Career::where('is_active',true)->latest()->get();
        $departments = Career::where('is_active',true)->distinct()->pluck('department');
        return view('public.career.index', compact('careers','departments'));
    }

    public function show(string $slug) {
        $career = Career::where('slug',$slug)->where('is_active',true)->firstOrFail();
        return view('public.career.show', compact('career'));
    }

    public function apply(Request $request, string $slug) {
        $career = Career::where('slug',$slug)->where('is_active',true)->firstOrFail();
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'nullable|string|max:20',
            'cover_letter' => 'nullable|string|max:3000',
            'cv' => 'required|file|mimes:pdf,doc,docx|max:5120',
        ]);

        $cvPath = Storage::disk('public')->put('applications/cvs', $request->file('cv'));
        CareerApplication::create([
            'career_id' => $career->id,
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'] ?? null,
            'cv_path' => $cvPath,
            'cover_letter' => $data['cover_letter'] ?? null,
        ]);

        return back()->with('success', 'Your application has been submitted. We will review and contact you soon!');
    }
}
