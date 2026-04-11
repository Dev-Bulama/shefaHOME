<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ClientMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return redirect()->route('client.login')->with('error', 'Please login to access the client portal.');
        }

        if (!auth()->user()->hasRole('client')) {
            abort(403, 'Unauthorized. Client access required.');
        }

        if (!auth()->user()->is_active) {
            auth()->logout();
            return redirect()->route('client.login')->with('error', 'Your account has been deactivated.');
        }

        return $next($request);
    }
}
