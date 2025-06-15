<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLanguageForGuest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $language = substr($request->server('HTTP_ACCEPT_LANGUAGE'), 0, 2);

        // You may need to adjust this logic based on your application's requirements

        // Check if the detected language is supported
        if (in_array($language, ['en', 'ar'])) {
            app()->setLocale($language);
        }
        return $next($request);
    }
}
