<?php
use App\Http\Controllers\backend\AdminDashboardController;

// -------------------------After Admin login (start) ------------------------------------------------------------
Route::middleware(['auth', 'admin_check'])->group(function () {
    Route::get('admin/dashboard', [AdminDashboardController::class, 'adminDashboardPageView'])->name('backend.admin.dashboard.view');
});
// -------------------------After Admin login (end) ------------------------------------------------------------