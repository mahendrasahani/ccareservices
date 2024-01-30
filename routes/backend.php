<?php
use App\Http\Controllers\backend\AdminDashboardController;
use App\Http\Controllers\Backend\AttributeController;
use App\Http\Controllers\Backend\AttributeValueController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\MainCategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Models\Backend\MainCategory;

// -------------------------After Admin login (start) ------------------------------------------------------------
Route::middleware(['auth', 'web', 'admin_check'])->group(function () {

    Route::get('admin/dashboard', [AdminDashboardController::class, 'adminDashboardPageView'])->name('backend.admin.dashboard.view');

// ------------------------------------Brand Routes(start)----------------------------------------------------------------
    Route::get('/admin/brand', [BrandController::class, 'index'])->name('backend.brand.index');
    Route::post('/admin/brand', [BrandController::class, 'store'])->name('backend.brand.store');
    Route::get('/admin/brand/edit/{id}', [BrandController::class, 'edit'])->name('backend.brand.edit');
    Route::post('/admin/brand/edit/update', [BrandController::class, 'update'])->name('backend.brand.update');
    Route::get('/admin/brand/destroy', [BrandController::class, 'destroy'])->name('backend.brand.destroy');
    Route::get('/admin/brand/search', [BrandController::class, 'search'])->name('backend.brand.search');
// ------------------------------------Brand Routes(end)----------------------------------------------------------------

// ------------------------------------Attribute Routes(start)----------------------------------------------------------------
    Route::get('/admin/attribute', [AttributeController::class, 'index'])->name('backend.attribute.index');
    Route::post('/admin/attribute/store', [AttributeController::class, 'store'])->name('backend.attribute.store');
    Route::get('/admin/attribute/edit/{id}', [AttributeController::class, 'edit'])->name('backend.attribute.edit');
    Route::post('/admin/attribute/update/{id}', [AttributeController::class, 'update'])->name('backend.attribute.update');
// ------------------------------------Attribute Routes(end)----------------------------------------------------------------

// ------------------------------------Attribute Value Routes(start)----------------------------------------------------------------
    Route::get('/admin/attribute-value/{id}', [AttributeValueController::class, 'index'])->name('backend.attribute_value.index');
    Route::post('/admin/attribute-value/store', [AttributeValueController::class, 'store'])->name('backend.attribute_value.store');
    Route::get('/admin/attribute-value/edit/{id}', [AttributeValueController::class, 'edit'])->name('backend.attribute_value.edit');
    Route::post('/admin/attribute-value/update/{id}/{attribute_id}', [AttributeValueController::class, 'update'])->name('backend.attribute_value.update');
// ------------------------------------Attribute Value Routes(end)----------------------------------------------------------------

// ------------------------------------Main Category Routes(start)----------------------------------------------------------------
    Route::get('/admin/main-category', [MainCategoryController::class, 'index'])->name('backend.main_category.index');
    Route::get('/admin/main-category/create', [MainCategoryController::class, 'create'])->name('backend.main_category.create');
    Route::post('/admin/main-category/store', [MainCategoryController::class, 'store'])->name('backend.main_category.store');
    Route::get('/admin/main-category/edit/{id}', [MainCategoryController::class, 'edit'])->name('backend.main_category.edit');
    Route::post('/admin/main-category/update/{id}', [MainCategoryController::class, 'update'])->name('backend.main_category.update');
    Route::get('/admin/main-category/change-status', [MainCategoryController::class, 'changeStatus'])->name('backend.main_category.change_status');
// ------------------------------------Main Category Routes(ends)----------------------------------------------------------------


    Route::get('admin/product', [ProductController::class, 'index'])->name('backend.admin.product.index');
});
// -------------------------After Admin login (end) ------------------------------------------------------------