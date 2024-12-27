<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Http\View\Composers\WelcomeComposer;

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
        View::share('appName', 'Laravel Example App');

        View::composer('partials.navbar', WelcomeComposer::class);
        
        view()->composer('partials.navbar', function ($view) {
            $view->with('pageTitle', 'Welcome');
        });
    }
}
