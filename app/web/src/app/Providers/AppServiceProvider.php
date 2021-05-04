<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
//use Illuminate\Pagination\Paginator;
//use NascentAfrica\Jetstrap\JetstrapFacade;


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
        //Paginator::useBootstrap();
        //JetstrapFacade::useAdminLte3();
    }
}
