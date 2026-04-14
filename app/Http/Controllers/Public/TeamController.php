<?php
namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\TeamMember;

class TeamController extends Controller
{
    public function index()
    {
        $team     = TeamMember::active()->get();
        $featured = $team->where('is_featured', true);
        $others   = $team->where('is_featured', false);

        return view('public.team.index', compact('team', 'featured', 'others'));
    }
}
