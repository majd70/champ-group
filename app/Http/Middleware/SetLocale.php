<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Apply the user's chosen locale (from session) before the response runs.
     * Falls back to the configured default if no session locale is set or
     * the stored value isn't in app.available_locales.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $locale = $request->session()->get('locale', config('app.locale'));
        $available = array_keys(config('app.available_locales', []));

        if (in_array($locale, $available, true)) {
            app()->setLocale($locale);
        }

        return $next($request);
    }
}
