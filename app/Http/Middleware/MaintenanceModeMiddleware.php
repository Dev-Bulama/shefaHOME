<?php
namespace App\Http\Middleware;

use App\Helpers\Settings;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MaintenanceModeMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Always allow: admin routes, login, maintenance page itself, health check
        if ($request->is('admin/*') || $request->is('admin')
            || $request->is('login') || $request->is('maintenance')
            || $request->is('up')) {
            return $next($request);
        }

        // If logged-in admin, pass through
        if (auth()->check() && auth()->user()->hasAnyRole(['super_admin', 'admin', 'staff'])) {
            return $next($request);
        }

        try {
            $on = Settings::get('maintenance_mode', '0');
        } catch (\Throwable $e) {
            $on = '0';
        }

        if ($on === '1') {
            return response(view('maintenance'), 503);
        }

        return $next($request);
    }
}
