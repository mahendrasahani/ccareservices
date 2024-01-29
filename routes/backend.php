<?php
use App\Http\Controllers\backend\AdminDashboardController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\ProductController;

// -------------------------After Admin login (start) ------------------------------------------------------------
Route::middleware(['auth', 'web', 'admin_check'])->group(function () {

    Route::get('admin/dashboard', [AdminDashboardController::class, 'adminDashboardPageView'])->name('backend.admin.dashboard.view');


    Route::get('/admin/brand', [BrandController::class, 'index'])->name('backend.brand.index');
    Route::post('/admin/brand', [BrandController::class, 'store'])->name('backend.brand.store');
    Route::get('/admin/brand/edit/{id}', [BrandController::class, 'edit'])->name('backend.brand.edit');
    Route::post('/admin/brand/edit/update', [BrandController::class, 'update'])->name('backend.brand.update');
    Route::get('/admin/brand/destroy', [BrandController::class, 'destroy'])->name('backend.brand.destroy');
    Route::get('/admin/brand/search', [BrandController::class, 'search'])->name('backend.brand.search');


    Route::get('admin/product', [ProductController::class, 'index'])->name('backend.admin.product.index');
});
// -------------------------After Admin login (end) ------------------------------------------------------------