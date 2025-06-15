<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class SetLocaleByIP
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        // Check if the locale is already set in the session
        if (!Session::has('locale')) {
            $client = new Client();
            $response = $client->get('http://ipinfo.io/' . $request->ip() . '/json');
            $locationData = json_decode($response->getBody(), true);

            // Set the locale based on the country
            if (isset($locationData['country']) && $locationData['country'] === 'SA') { // Example: Saudi Arabia
                Session::put('locale', 'ar');
            } else {
                Session::put('locale', 'en');
            }
        }

        App::setLocale(Session::get('locale', 'en'));

        return $next($request);
    }

}
