<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Midtrans\Config; 

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
Config::$serverKey = config('midtrans.serverKey');
Config::$isProduction = config('midtrans.isProduction');
Config::$isSanitized = true;
Config::$is3ds = true;
        Paginator::useBootstrapFive();
    }
}
