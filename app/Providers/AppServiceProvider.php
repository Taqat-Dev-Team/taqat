<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        View::composer('*', function ($view) {
            $user = auth()->user();
            $showSurveyModal = false;

            if (!auth('admin')->check() && !auth('restaurant')->check()) {

                if ($user && !$user->surveys()->exists()) {
                    $showSurveyModal = true;
                }


                $view->with('showSurveyModal', $showSurveyModal);
            }
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Carbon::setLocale(config('app.locale'));
    }
}
