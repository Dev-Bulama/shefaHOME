<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\{Property, Inquiry, BlogPost, Career, CareerApplication, User, ClientProfile, InvestorProfile, ClientPayment};

class DashboardController extends Controller {
    public function index() {
        $stats = [
            'properties' => Property::where('is_active',true)->count(),
            'clients' => ClientProfile::count(),
            'investors' => InvestorProfile::count(),
            'inquiries' => Inquiry::where('status','new')->count(),
            'blog_posts' => BlogPost::where('is_published',true)->count(),
            'applications' => CareerApplication::where('status','new')->count(),
        ];
        $recentInquiries = Inquiry::with('property')->latest()->take(5)->get();
        $recentClients = User::role('client')->latest()->take(5)->get();
        $recentInvestors = User::role('investor')->latest()->take(5)->get();

        // Chart data
        $monthlyInquiries = [];
        for($i = 5; $i >= 0; $i--) {
            $month = now()->subMonths($i);
            $monthlyInquiries[] = [
                'month' => $month->format('M Y'),
                'count' => Inquiry::whereYear('created_at', $month->year)->whereMonth('created_at', $month->month)->count()
            ];
        }

        $propertiesByState = Property::select('state', \DB::raw('count(*) as total'))
            ->groupBy('state')->orderByDesc('total')->take(8)->get();

        return view('admin.dashboard.index', compact('stats','recentInquiries','recentClients','recentInvestors','monthlyInquiries','propertiesByState'));
    }
}
