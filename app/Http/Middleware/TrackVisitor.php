<?php

namespace App\Http\Middleware;

use App\Models\VisitorLog;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackVisitor
{
    /**
     * Bot signatures to match against the User-Agent string (case-insensitive).
     */
    private const BOT_PATTERNS = [
        'bot',
        'crawl',
        'spider',
        'slurp',
        'mediapartners',
        'AhrefsBot',
        'SemrushBot',
    ];

    public function handle(Request $request, Closure $next): Response
    {
        // Only track GET requests
        if (! $request->isMethod('GET')) {
            return $next($request);
        }

        // Skip admin routes
        if ($request->is('admin/*')) {
            return $next($request);
        }

        try {
            $userAgent = $request->userAgent() ?? '';

            // ── Bot detection ────────────────────────────────────────────────
            $isBot = false;
            foreach (self::BOT_PATTERNS as $pattern) {
                if (stripos($userAgent, $pattern) !== false) {
                    $isBot = true;
                    break;
                }
            }

            // ── Browser detection ────────────────────────────────────────────
            $browser = 'Other';
            if (stripos($userAgent, 'Edg') !== false) {
                $browser = 'Edge';
            } elseif (stripos($userAgent, 'OPR') !== false || stripos($userAgent, 'Opera') !== false) {
                $browser = 'Opera';
            } elseif (stripos($userAgent, 'Chrome') !== false) {
                $browser = 'Chrome';
            } elseif (stripos($userAgent, 'Firefox') !== false) {
                $browser = 'Firefox';
            } elseif (stripos($userAgent, 'Safari') !== false) {
                $browser = 'Safari';
            }

            // ── Device detection ─────────────────────────────────────────────
            $device = 'desktop';
            if (preg_match('/Android|iPhone|iPad|Mobile/i', $userAgent)) {
                $device = 'mobile';
            }

            // ── IP & state detection ─────────────────────────────────────────
            $ip    = $request->ip();
            $state = null;

            if ($this->isPrivateOrLocalIp($ip)) {
                $state = 'Local';
            }
            // For real public IPs we cannot detect state without a GeoIP database,
            // so state stays null.

            // ── Session-based deduplication ──────────────────────────────────
            // Generate a stable session ID once per session.
            if (! $request->session()->has('visitor_session_id')) {
                $request->session()->put(
                    'visitor_session_id',
                    bin2hex(random_bytes(32)) // 64-char hex string
                );
            }
            $sessionId = $request->session()->get('visitor_session_id');

            // Build a per-page dedup key so repeated loads of the same page
            // within the same session are not double-counted.
            $pageKey = 'tracked_page_' . md5($request->path());

            if ($request->session()->has($pageKey)) {
                return $next($request);
            }

            $request->session()->put($pageKey, true);

            // ── Persist the log entry ────────────────────────────────────────
            VisitorLog::create([
                'session_id' => $sessionId,
                'ip'         => $ip,
                'country'    => 'Nigeria',
                'state'      => $state,
                'city'       => null,
                'page'       => $request->path(),
                'page_title' => null,
                'referrer'   => $request->header('referer'),
                'browser'    => $browser,
                'device'     => $device,
                'is_bot'     => $isBot,
            ]);
        } catch (\Throwable $e) {
            // Never break the request pipeline due to tracking errors.
            // Optionally log: \Log::warning('TrackVisitor: ' . $e->getMessage());
        }

        return $next($request);
    }

    /**
     * Determine whether an IP address is localhost or within a private range.
     */
    private function isPrivateOrLocalIp(string $ip): bool
    {
        if ($ip === '127.0.0.1' || $ip === '::1') {
            return true;
        }

        // filter_var returns false for public IPs when FILTER_FLAG_NO_PRIV_RANGE
        // and FILTER_FLAG_NO_RES_RANGE are both set.
        return filter_var(
            $ip,
            FILTER_VALIDATE_IP,
            FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE
        ) === false;
    }
}
