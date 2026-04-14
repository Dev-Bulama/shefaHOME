<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MediaFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MediaController extends Controller
{
    public function index(Request $request)
    {
        $type   = $request->input('type', 'all');
        $search = $request->input('search');

        $query = MediaFile::latest();
        if ($type !== 'all') $query->where('type', $type);
        if ($search) $query->where(function ($q) use ($search) {
            $q->where('original_name', 'like', "%{$search}%")
              ->orWhere('alt_text', 'like', "%{$search}%")
              ->orWhere('caption', 'like', "%{$search}%");
        });

        $files = $query->paginate(24)->withQueryString();

        return view('admin.media.index', compact('files', 'type', 'search'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'files'   => 'required|array|min:1|max:20',
            'files.*' => 'required|file|max:51200|mimes:jpg,jpeg,png,gif,webp,svg,mp4,mov,avi,webm',
        ]);

        $uploaded = 0;
        foreach ($request->file('files') as $file) {
            $mime     = $file->getMimeType();
            $type     = str_starts_with($mime, 'video/') ? 'video' : 'image';
            $folder   = 'media/' . date('Y/m');
            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $path     = $folder . '/' . $filename;

            Storage::disk('public')->putFileAs($folder, $file, $filename);

            MediaFile::create([
                'filename'      => $path,
                'original_name' => $file->getClientOriginalName(),
                'mime_type'     => $mime,
                'type'          => $type,
                'size'          => $file->getSize(),
                'folder'        => $folder,
            ]);
            $uploaded++;
        }

        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'uploaded' => $uploaded]);
        }

        return back()->with('success', "{$uploaded} file(s) uploaded successfully.");
    }

    public function update(Request $request, MediaFile $medium)
    {
        $data = $request->validate([
            'alt_text' => 'nullable|string|max:255',
            'caption'  => 'nullable|string|max:500',
        ]);
        $medium->update($data);

        if ($request->expectsJson()) {
            return response()->json(['success' => true]);
        }
        return back()->with('success', 'Media details updated.');
    }

    public function destroy(MediaFile $medium)
    {
        Storage::disk('public')->delete($medium->filename);
        $medium->delete();

        return back()->with('success', 'File deleted.');
    }

    /** Return media JSON for picker modal */
    public function picker(Request $request)
    {
        $type  = $request->input('type', 'image');
        $files = MediaFile::where('type', $type)->latest()->limit(100)->get()
            ->map(fn($f) => ['id' => $f->id, 'url' => $f->url, 'name' => $f->original_name]);

        return response()->json($files);
    }
}
