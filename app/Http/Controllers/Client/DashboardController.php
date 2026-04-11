<?php
namespace App\Http\Controllers\Client;
use App\Http\Controllers\Controller;

class DashboardController extends Controller {
    public function index() {
        $user = auth()->user();
        $profile = $user->clientProfile()->with(['properties.property','payments','documents'])->firstOrFail();
        $activePayment = $profile->payments()->where('status','active')->with('property')->first();
        $recentPayments = $profile->payments()->with('property')->latest()->take(5)->get();
        return view('client.dashboard.index', compact('profile','activePayment','recentPayments'));
    }
}
