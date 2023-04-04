<?php

namespace App\Providers;

use App\Models\Theme;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\View;
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
//        Get themes list and send it to the main view
        View::composer(['layouts.app'], function($view){
            $currentThemeId = Cookie::get('theme') ?? 1;

            $view->with('themes', Theme::all())
                ->with('selectedTheme', Theme::find($currentThemeId));
        });
    }
}
