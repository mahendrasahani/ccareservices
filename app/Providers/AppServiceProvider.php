<?php

namespace App\Providers;

use App\Models\Backend\PaymentMethod;
use Config;
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
        $razorpay_credential = PaymentMethod::where('id', 2)->first();
        if ($razorpay_credential) {
            Config::set('services.razorpay.key', $razorpay_credential->key);
            Config::set('services.razorpay.secret', $razorpay_credential->secret);
        }
        view()->share([
            'main_categories' => $main_categories
        ]);
    }
}
