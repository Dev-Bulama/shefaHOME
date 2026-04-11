<?php
namespace App\Http\Controllers\Public;
use App\Http\Controllers\Controller;
use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;

class NewsletterController extends Controller {
    public function subscribe(Request $request) {
        $request->validate(['email' => 'required|email']);
        NewsletterSubscriber::firstOrCreate(
            ['email' => $request->email],
            ['name' => $request->name, 'subscribed_at' => now(), 'is_active' => true]
        );
        return response()->json(['success'=>true,'message'=>'Subscribed successfully! Welcome to SHEFAHOMES newsletter.']);
    }
}
