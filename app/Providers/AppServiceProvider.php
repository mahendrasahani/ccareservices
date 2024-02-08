<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Backend\MainCategory;

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
        $main_categories = MainCategory::with('subCategory')->where('status', 1)->get();

        view()->share([
            'main_categories' => $main_categories
        ]);
    }
}
