<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ClientProfile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller {
    public function showAdminLogin() { return view('auth.login', ['portal' => 'admin']); }
    public function showInvestorLogin() { return view('auth.login', ['portal' => 'investor']); }
    public function showClientLogin() { return view('auth.login', ['portal' => 'client']); }

    // Standard Fortify handles the actual /login POST and /register POST
    // These are just for the custom portal-specific GET login views
}
