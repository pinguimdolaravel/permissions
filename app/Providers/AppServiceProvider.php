<?php

namespace App\Providers;

use App\Models\Permission;
use App\Models\User;
use App\Observers\PermisionObserver;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Permission::observe(PermisionObserver::class);
        Gate::before(function (User $user, $ability) {
            if (Permission::existsOnCache($ability)) {
                return $user->hasPermissionTo($ability);
            }
        });
    }
}
