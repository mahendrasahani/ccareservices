<?php
use App\Http\Controllers\backend\AdminDashboardController;
use App\Http\Controllers\Backend\ProductController;

// -------------------------After Admin login (start) ------------------------------------------------------------
Route::middleware(['auth', 'admin_check'])->group(function () {
    Route::get('admin/dashboard', [AdminDashboardController::class, 'adminDashboardPageView'])->name('backend.admin.dashboard.view');
    Route::get('admin/product', [ProductController::class, 'index'])->name('backend.admin.product.index');
});
// -------------------------After Admin login (end) ------------------------------------------------------------