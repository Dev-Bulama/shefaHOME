<?php
namespace App\Http\Controllers\Investor;
use App\Http\Controllers\Controller;
use App\Models\InvestorDocument;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller {
    public function index() {
        $profile = auth()->user()->investorProfile()->firstOrFail();
        $documents = $profile->documents()->latest()->get();
        return view('investor.documents.index', compact('profile','documents'));
    }

    public function download(int $id) {
        $profile = auth()->user()->investorProfile()->firstOrFail();
        $document = $profile->documents()->findOrFail($id);
        $path = Storage::disk('public')->path($document->file_path);
        if(!file_exists($path)) abort(404);
        return response()->download($path, $document->title.'.'.pathinfo($document->file_path, PATHINFO_EXTENSION));
    }
}
