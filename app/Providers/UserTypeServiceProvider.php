<?php

namespace App\Providers;
use Illuminate\Support\Facades\View;

use Illuminate\Support\ServiceProvider;

class UserTypeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Using view composer to share data with all views
        View::composer('*', function ($view) {
            $user_type = auth()->check() ? auth()->user()->user_type : null;
            $view->with('user_type', $user_type);
        });
    }
}
