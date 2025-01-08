<?php

namespace App\Providers;

use Illuminate\Support\Facades\Vite;
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
        Vite::prefetch(concurrency: 3);
        
        View::share('appName', 'Laravel Example App');

        View::composer('partials.navbar', WelcomeComposer::class);
        
        view()->composer('partials.navbar', function ($view) {
            $view->with('pageTitle', 'Welcome');
        });
    }
}
