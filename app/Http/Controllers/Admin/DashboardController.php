<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\{Property, Inquiry, BlogPost, Career, CareerApplication, User, ClientProfile, InvestorProfile, ClientPayment};
use App\Models\VisitorLog;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DashboardController extends Controller {
    public function index() {
        $stats = [
            'total_properties'  => Property::where('is_active',true)->count(),
            'active_clients'    => ClientProfile::count(),
            'active_investors'  => InvestorProfile::count(),
            'open_inquiries'    => Inquiry::where('status','new')->count(),
            'blog_posts'        => BlogPost::where('is_published',true)->count(),
            'applications'      => CareerApplication::where('status','new')->count(),
        ];

        $recentInquiries     = Inquiry::with('property')->latest()->take(5)->get();
        $recentRegistrations = User::latest()->take(5)->get();

        // Chart: monthly inquiries (last 6 months)
        $monthlyInquiries = [];
        for($i = 5; $i >= 0; $i--) {
            $month = now()->subMonths($i);
            $monthlyInquiries[] = [
                'month' => $month->format('M Y'),
                'count' => Inquiry::whereYear('created_at', $month->year)->whereMonth('created_at', $month->month)->count()
            ];
        }

        // Chart: properties by state
        $propertiesByState = Property::select('state', DB::raw('count(*) as count'))
            ->groupBy('state')->orderByDesc('count')->take(8)->get();

        // Visitor stats
        $visitorStats = ['today' => 0, 'month' => 0, 'total' => 0];
        $visitorsByState   = collect();
        $dailyVisitors     = [];
        $recentVisitors    = collect();

        if (Schema::hasTable('visitor_logs')) {
            $visitorStats = [
                'today' => VisitorLog::notBot()->today()->distinct('session_id')->count('session_id'),
                'month' => VisitorLog::notBot()->thisMonth()->distinct('session_id')->count('session_id'),
                'total' => VisitorLog::notBot()->distinct('session_id')->count('session_id'),
            ];

            $visitorsByState = VisitorLog::notBot()
                ->select('state', DB::raw('count(*) as count'))
                ->whereNotNull('state')
                ->where('state', '!=', 'Local')
                ->groupBy('state')
                ->orderByDesc('count')
                ->take(10)
                ->get();

            for($i = 6; $i >= 0; $i--) {
                $day = now()->subDays($i);
                $dailyVisitors[] = [
                    'day'   => $day->format('D d'),
                    'count' => VisitorLog::notBot()->whereDate('created_at', $day)->distinct('session_id')->count('session_id'),
                ];
            }

            $recentVisitors = VisitorLog::notBot()
                ->latest()
                ->take(10)
                ->get(['ip','page','browser','device','state','created_at']);
        }

        return view('admin.dashboard.index', compact(
            'stats','recentInquiries','recentRegistrations','monthlyInquiries','propertiesByState',
            'visitorStats','visitorsByState','dailyVisitors','recentVisitors'
        ));
    }
}
