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
        // Raise limits at runtime for environments where .htaccess doesn't apply
        @ini_set('upload_max_filesize', '50M');
        @ini_set('post_max_size', '55M');

        // Validate each file individually so one bad file doesn't kill the batch
        $files = $request->file('files', []);

        if (empty($files)) {
            return response()->json([
                'success' => false,
                'error'   => 'No files received. The file may exceed the server upload limit (max 50 MB per file).',
            ], 422);
        }

        $allowedMimes = ['image/jpeg','image/png','image/gif','image/webp','image/svg+xml','video/mp4','video/quicktime','video/x-msvideo','video/webm'];
        $maxBytes     = 50 * 1024 * 1024; // 50 MB

        $uploaded = 0;
        $errors   = [];

        foreach ($files as $file) {
            // PHP-level upload error (e.g. file too large for php.ini)
            if ($file->getError() !== UPLOAD_ERR_OK) {
                $phpErrors = [
                    UPLOAD_ERR_INI_SIZE   => 'File exceeds server upload_max_filesize limit.',
                    UPLOAD_ERR_FORM_SIZE  => 'File exceeds form MAX_FILE_SIZE.',
                    UPLOAD_ERR_PARTIAL    => 'File was only partially uploaded.',
                    UPLOAD_ERR_NO_FILE    => 'No file was uploaded.',
                    UPLOAD_ERR_NO_TMP_DIR => 'Missing temporary folder.',
                    UPLOAD_ERR_CANT_WRITE => 'Failed to write file to disk.',
                    UPLOAD_ERR_EXTENSION  => 'Upload blocked by a PHP extension.',
                ];
                $errors[] = ($phpErrors[$file->getError()] ?? 'Unknown upload error (code '.$file->getError().')');
                continue;
            }

            // Size check
            if ($file->getSize() > $maxBytes) {
                $errors[] = $file->getClientOriginalName() . ' is too large (' . round($file->getSize() / 1048576, 1) . ' MB). Max is 50 MB.';
                continue;
            }

            // MIME check
            $mime = $file->getMimeType();
            if (!in_array($mime, $allowedMimes, true)) {
                $errors[] = $file->getClientOriginalName() . ' has an unsupported type (' . $mime . ').';
                continue;
            }

            try {
                $type     = str_starts_with($mime, 'video/') ? 'video' : 'image';
                $folder   = 'media/' . date('Y/m');
                $ext      = strtolower($file->getClientOriginalExtension());
                // Handle double extensions like IMG.JPG.jpeg → keep last part
                $ext      = $ext ?: pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
                $filename = Str::uuid() . '.' . $ext;
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
            } catch (\Throwable $e) {
                $errors[] = $file->getClientOriginalName() . ': storage error — ' . $e->getMessage();
            }
        }

        if ($request->expectsJson()) {
            return response()->json([
                'success'  => $uploaded > 0,
                'uploaded' => $uploaded,
                'errors'   => $errors,
                'error'    => $errors ? implode(' | ', $errors) : null,
            ]);
        }

        $msg = "{$uploaded} file(s) uploaded.";
        if ($errors) $msg .= ' Errors: ' . implode(', ', $errors);
        return back()->with('success', $msg);
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
