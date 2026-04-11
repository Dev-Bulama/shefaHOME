<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class InvestorMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return redirect()->route('investor.login')->with('error', 'Please login to access the investor portal.');
        }

        if (!auth()->user()->hasRole('investor')) {
            abort(403, 'Unauthorized. Investor access required.');
        }

        if (!auth()->user()->is_active) {
            auth()->logout();
            return redirect()->route('investor.login')->with('error', 'Your account has been deactivated.');
        }

        return $next($request);
    }
}
