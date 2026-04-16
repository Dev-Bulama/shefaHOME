<?php
namespace App\Http\Controllers\Public;
use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use Illuminate\Http\Request;

class ContactController extends Controller {
    public function index() { return view('public.contact.index'); }

    public function send(Request $request) {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:2000',
        ]);
        Inquiry::create($data);
        if($request->wantsJson()) return response()->json(['success'=>true,'message'=>'Message sent successfully! We will get back to you soon.']);
        return back()->with('success', 'Your message has been sent. We will get back to you shortly!');
    }
}
