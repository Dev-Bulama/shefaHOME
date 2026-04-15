<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Helpers\Settings;
use App\Services\ImageService;
use Illuminate\Http\Request;

class SettingsController extends Controller {
    public function index() {
        $settings = \App\Models\SiteSetting::all()->pluck('value','key');
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request) {
        $group = $request->group ?? 'general';
        $skip = ['_token','_method','group'];
        foreach($request->all() as $key => $value) {
            if(in_array($key, $skip)) continue;
            if($request->hasFile($key)) {
                $value = ImageService::upload($request->file($key), 'settings');
            } elseif($value === null) {
                // Empty file input — do not overwrite existing value
                continue;
            }
            Settings::set($key, $value, $group);
        }
        return back()->with('success','Settings saved successfully!');
    }
}
