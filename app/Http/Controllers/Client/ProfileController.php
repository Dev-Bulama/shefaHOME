<?php
namespace App\Http\Controllers\Client;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ImageService;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller {
    public function index() {
        $user = auth()->user();
        $profile = $user->clientProfile()->firstOrFail();
        return view('client.profile.index', compact('user','profile'));
    }

    public function update(Request $request) {
        $user = auth()->user();
        $profile = $user->clientProfile()->firstOrFail();

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'state' => 'nullable|string|max:100',
            'occupation' => 'nullable|string|max:255',
            'nok_name' => 'nullable|string|max:255',
            'nok_phone' => 'nullable|string|max:20',
            'nok_relationship' => 'nullable|string|max:100',
            'current_password' => 'nullable|string',
            'password' => 'nullable|string|min:8|confirmed',
            'avatar' => 'nullable|image|max:2048',
        ]);

        if($request->hasFile('avatar')) {
            $avatarPath = ImageService::upload($request->file('avatar'), 'avatars');
            $user->update(['avatar'=>$avatarPath]);
        }

        $user->update(['name'=>$data['name'],'phone'=>$data['phone']??$user->phone]);
        $profile->update([
            'address'=>$data['address']??null,'state'=>$data['state']??null,
            'occupation'=>$data['occupation']??null,'nok_name'=>$data['nok_name']??null,
            'nok_phone'=>$data['nok_phone']??null,'nok_relationship'=>$data['nok_relationship']??null,
        ]);

        if($request->filled('password') && $request->filled('current_password')) {
            if(!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password'=>'Current password is incorrect.']);
            }
            $user->update(['password'=>Hash::make($request->password)]);
        }

        return back()->with('success','Profile updated successfully!');
    }
}
