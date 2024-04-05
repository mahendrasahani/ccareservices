<?php

use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\PaymentController;
use App\Http\Controllers\Backend\ReviewController;
use App\Models\Backend\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user(); 
// });

Route::middleware('auth:sanctum')->group(function () {
    Route::post ('/review/update-status', [ReviewController::class, 'updateStatus'])->name('backend.review.update_status');
    Route::post ('/chart/monthly_sales', [OrderController::class, 'monthlySales'])->name('backend.chart.monthly_sales');
});

Route::get('/payment-methods', [PaymentController::class, 'paymentMethods'])->name('frontend.payment_methods');
Route::post ('/payment-methods/update-status', [PaymentController::class, 'updateStatus'])->name('frontend.update_status');




