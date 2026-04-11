<?php
namespace App\Http\Controllers\Investor;
use App\Http\Controllers\Controller;

class ReturnsController extends Controller {
    public function index() {
        $profile = auth()->user()->investorProfile()->firstOrFail();
        $returns = $profile->returns()->with('property')->orderByDesc('investment_date')->paginate(15);
        $totalReturnsEarned = $returns->sum('return_amount');
        $pendingReturns = $profile->returns()->where('status','active')->sum('return_amount');
        $avgROI = $profile->returns()->avg('return_percentage') ?? 0;
        return view('investor.returns.index', compact('profile','returns','totalReturnsEarned','pendingReturns','avgROI'));
    }

    public function statement() {
        $profile = auth()->user()->investorProfile()->with(['returns.property'])->firstOrFail();
        return view('investor.returns.statement', compact('profile'));
    }
}
