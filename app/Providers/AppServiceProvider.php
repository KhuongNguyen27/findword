<?php

namespace App\Providers;

use App\View\homeShares\HomeShare;
use Illuminate\Support\ServiceProvider;
use App\View\Composers\JobFavorite;
use App\View\Composers\PostComposer;
use App\View\Composers\AppliedJobCountComposer;
use App\View\Composers\PopupComposer;
use Illuminate\Support\Facades\View;
use App\View\Composers\MetricsComposer;

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
        View::composer('*', AppliedJobCountComposer::class);

        View::composer(['website.homes.index','website.homes.home-sub-index'], HomeShare::class);
        View::composer('*', PopupComposer::class);
        View::composer('*', MetricsComposer::class);


    }
}
