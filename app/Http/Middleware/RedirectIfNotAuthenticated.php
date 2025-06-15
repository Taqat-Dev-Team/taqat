<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfNotAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

            $path = $request->path();
            $locale = $this->getLocaleFromPath($path);

            if (str_starts_with($path, "$locale/admin")) {
                return $this->handleAdminRedirect($locale);
            } elseif (str_starts_with($path, "$locale/companies")) {
                return $this->handleCompanyRedirect($locale);
            } else {
                return $this->handleDefaultRedirect();
            }

            return $next($request);
        }

        private function getLocaleFromPath($path)
        {
            // Assuming the locale is always the first segment in the URL
            return explode('/', $path)[0];
        }

        private function handleAdminRedirect($locale)
        {
            if (Auth::guard('admin')->check()) {
                return redirect()->route('admin.index', ['locale' => $locale]);
            } else {
                return redirect()->route('admin.login', ['locale' => $locale]);
            }
        }

        private function handleCompanyRedirect($locale)
        {
            if (Auth::guard('company')->check()) {
                return redirect()->route('companies.index', ['locale' => $locale]);
            } else {
                return redirect()->route('companies.login', ['locale' => $locale]);
            }
        }

        private function handleDefaultRedirect()
        {
            if (auth()->check()) {
                return redirect()->route('front.index');
            } else {
                return redirect()->route('login');
            }
        }
    }

