<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\View\Composers\JobFavorite;
use App\View\Composers\PostComposer;
use Illuminate\Support\Facades\View;
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
        View::composer('*', JobFavorite::class);
        View::composer('website.includes.global.news', PostComposer::class);
    }
}
