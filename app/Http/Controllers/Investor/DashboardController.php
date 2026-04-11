<?php
namespace App\Http\Controllers\Investor;
use App\Http\Controllers\Controller;
use App\Models\InvestorProfile;

class DashboardController extends Controller {
    public function index() {
        $user = auth()->user();
        $profile = $user->investorProfile()->with(['returns','documents'])->firstOrFail();
        $totalInvested = $profile->returns->sum('amount_invested');
        $totalReturns = $profile->returns->sum('return_amount');
        $activeInvestments = $profile->returns->where('status','active')->count();
        $recentReturns = $profile->returns()->with('property')->latest()->take(5)->get();
        $portfolioByProperty = $profile->returns()->with('property')->get()
            ->groupBy('property.title')
            ->map(fn($group) => $group->sum('amount_invested'));
        return view('investor.dashboard.index', compact('profile','totalInvested','totalReturns','activeInvestments','recentReturns','portfolioByProperty'));
    }
}
