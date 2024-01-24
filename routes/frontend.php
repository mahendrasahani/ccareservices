<?php
use App\Http\Controllers\Frontend\HomeController;

Route::get('/', [HomeController::class, 'homePage'])->name('frontend.home');