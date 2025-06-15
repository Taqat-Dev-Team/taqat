<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        
        foreach (config('global.permissions') as $ability => $value) { //brands

            foreach ($value as $key=>$val) {

                Gate::define($key, function ($auth) use ($key) {

                    return $auth->hasAbility($key);
                });
            }
        }

    }
}
