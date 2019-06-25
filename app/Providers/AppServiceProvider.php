<?php

namespace App\Providers;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;
use Laravel\Passport\Passport;

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
        Schema::defaultStringLength(191);
        Carbon::setLocale(session('applocale'));
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Passport::routes();
    }
}
