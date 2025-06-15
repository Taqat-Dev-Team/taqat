<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Symfony\Component\HttpFoundation\Response;

class ClearXsrfTokenMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $cookiesToClear = ['XSRF-TOKEN', 'other_cookie_name']; // Replace with your cookies

        foreach ($cookiesToClear as $cookie) {
            // Queue the cookie to be forgotten
            Cookie::queue(Cookie::forget($cookie));
        }

        return $next($request);
    }
}
