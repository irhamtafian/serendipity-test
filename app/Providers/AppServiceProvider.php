<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;

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
        Schema::defaultStringLength(191);
        View::composer('frontend.pages.articles*', 'App\Http\View\CategoryComposer');
        View::composer('frontend.pages.articles*', 'App\Http\View\RandomComposer');
        View::composer('frontend.pages.articles*', 'App\Http\View\LatestComposer');
    }
}