<?php
namespace App\Http\Controllers\Investor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ImageService;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller {
    public function index() {
        $user = auth()->user();
        $profile = $user->investorProfile()->firstOrFail();
        return view('investor.profile.index', compact('user','profile'));
    }

    public function update(Request $request) {
        $user = auth()->user();
        $profile = $user->investorProfile()->firstOrFail();

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'company_name' => 'nullable|string|max:255',
            'current_password' => 'nullable|string',
            'password' => 'nullable|string|min:8|confirmed',
            'avatar' => 'nullable|image|max:2048',
        ]);

        if($request->hasFile('avatar')) {
            $data['avatar'] = ImageService::upload($request->file('avatar'), 'avatars');
        }

        $user->update(['name'=>$data['name'], 'phone'=>$data['phone']??$user->phone, 'avatar'=>$data['avatar']??$user->avatar]);
        $profile->update(['company_name'=>$data['company_name']??$profile->company_name]);

        if($request->filled('password') && $request->filled('current_password')) {
            if(!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password'=>'Current password is incorrect.']);
            }
            $user->update(['password'=>Hash::make($request->password)]);
        }

        return back()->with('success','Profile updated successfully!');
    }
}
