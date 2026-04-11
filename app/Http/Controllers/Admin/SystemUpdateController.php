<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Storage, Artisan, File};
use ZipArchive;

class SystemUpdateController extends Controller {
    public function index() {
        $updateHistory = Storage::disk('local')->exists('updates/history.json')
            ? json_decode(Storage::disk('local')->get('updates/history.json'), true)
            : [];
        return view('admin.system-update.index', compact('updateHistory'));
    }

    public function upload(Request $request) {
        $request->validate(['update_zip' => 'required|file|mimes:zip|max:102400']); // 100MB

        $zipFile = $request->file('update_zip');
        $zipPath = $zipFile->store('updates/uploads', 'local');
        $fullPath = storage_path('app/'.$zipPath);

        $zip = new ZipArchive();
        if($zip->open($fullPath) !== true) {
            return back()->with('error', 'Invalid ZIP file. Could not open archive.');
        }

        $extractPath = storage_path('app/updates/extract_'.now()->format('YmdHis'));
        File::ensureDirectoryExists($extractPath);
        $zip->extractTo($extractPath);
        $zip->close();

        // Copy files to app root (exclude .env, storage, vendor, node_modules)
        $appRoot = base_path();
        $excluded = ['.env','storage','vendor','node_modules','.git'];
        $this->copyDirectory($extractPath, $appRoot, $excluded);

        // Run migrations and clear caches
        Artisan::call('migrate', ['--force' => true]);
        Artisan::call('config:clear');
        Artisan::call('view:clear');
        Artisan::call('route:clear');
        Artisan::call('cache:clear');

        // Log update
        $history = Storage::disk('local')->exists('updates/history.json')
            ? json_decode(Storage::disk('local')->get('updates/history.json'), true)
            : [];
        $history[] = ['filename'=>$zipFile->getClientOriginalName(),'applied_at'=>now()->toDateTimeString(),'applied_by'=>auth()->user()->name];
        Storage::disk('local')->put('updates/history.json', json_encode($history, JSON_PRETTY_PRINT));

        // Cleanup
        File::deleteDirectory($extractPath);
        Storage::disk('local')->delete($zipPath);

        return back()->with('success', 'Update applied successfully! Migrations ran and caches cleared.');
    }

    private function copyDirectory(string $source, string $destination, array $excluded = []): void {
        $items = File::allFiles($source);
        foreach($items as $file) {
            $relativePath = str_replace($source.DIRECTORY_SEPARATOR, '', $file->getPathname());
            $parts = explode(DIRECTORY_SEPARATOR, $relativePath);
            if(in_array($parts[0], $excluded)) continue;
            $destPath = $destination.DIRECTORY_SEPARATOR.$relativePath;
            File::ensureDirectoryExists(dirname($destPath));
            File::copy($file->getPathname(), $destPath);
        }
    }
}
