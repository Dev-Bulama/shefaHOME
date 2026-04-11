<?php
namespace App\Http\Controllers\Investor;
use App\Http\Controllers\Controller;
use App\Models\InvestorReturn;

class PortfolioController extends Controller {
    public function index() {
        $profile = auth()->user()->investorProfile()->firstOrFail();
        $investments = $profile->returns()->with('property')->latest()->paginate(10);
        return view('investor.portfolio.index', compact('profile','investments'));
    }

    public function show(int $id) {
        $profile = auth()->user()->investorProfile()->firstOrFail();
        $investment = $profile->returns()->with('property')->findOrFail($id);
        return view('investor.portfolio.show', compact('profile','investment'));
    }
}
