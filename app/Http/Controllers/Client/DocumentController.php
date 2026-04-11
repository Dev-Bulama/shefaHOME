<?php
namespace App\Http\Controllers\Client;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller {
    public function index() {
        $profile = auth()->user()->clientProfile()->firstOrFail();
        $documents = $profile->documents()->latest()->get();
        return view('client.documents.index', compact('profile','documents'));
    }

    public function download(int $id) {
        $profile = auth()->user()->clientProfile()->firstOrFail();
        $document = $profile->documents()->findOrFail($id);
        $path = Storage::disk('public')->path($document->file_path);
        if(!file_exists($path)) abort(404);
        return response()->download($path, $document->title.'.'.pathinfo($document->file_path, PATHINFO_EXTENSION));
    }

    public function upload(Request $request) {
        $profile = auth()->user()->clientProfile()->firstOrFail();
        $request->validate([
            'title' => 'required|string|max:255',
            'document' => 'required|file|mimes:pdf,jpg,jpeg,png|max:10240',
            'type' => 'required|in:offer_letter,receipt,allotment,certificate,id_document,other',
        ]);
        $path = Storage::disk('public')->put('client-documents/'.$profile->id, $request->file('document'));
        $profile->documents()->create([
            'title' => $request->title,
            'file_path' => $path,
            'type' => $request->type,
            'uploaded_by' => auth()->id(),
        ]);
        return back()->with('success','Document uploaded successfully!');
    }
}
