<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (env("APP_ENV") == "production") {
            URL::forceScheme("https");
        }

        Paginator::defaultView('vendor.pagination.bootstrap-4');

        Paginator::defaultSimpleView('vendor.pagination.bootstrap-5');
    }
}
