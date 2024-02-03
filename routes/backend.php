<?php
use App\Http\Controllers\backend\AdminDashboardController;
use App\Http\Controllers\Backend\AttributeController;
use App\Http\Controllers\Backend\AttributeValueController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\MainCategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\SubCategoryController;
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
    Route::get('/admin/main-category/destroy', [MainCategoryController::class, 'destroy'])->name('backend.main_category.destroy');
    Route::get('/admin/main-category/change-status', [MainCategoryController::class, 'changeStatus'])->name('backend.main_category.change_status');
    Route::get('/admin/main-category/search', [MainCategoryController::class, 'search'])->name('backend.main_category.search');
// ------------------------------------Main Category Routes(ends)----------------------------------------------------------------


// ------------------------------------Main Category Routes(start)----------------------------------------------------------------
Route::get('/admin/sub-category', [SubCategoryController::class, 'index'])->name('backend.sub_category.index');
Route::get('/admin/sub-category/create', [SubCategoryController::class, 'create'])->name('backend.sub_category.create');
Route::post('/admin/sub-category/store', [SubCategoryController::class, 'store'])->name('backend.sub_category.store');
Route::get('/admin/sub-category/edit/{id}', [SubCategoryController::class, 'edit'])->name('backend.sub_category.edit');
Route::post('/admin/sub-category/update/{id}', [SubCategoryController::class, 'update'])->name('backend.sub_category.update');
Route::get('/admin/sub-category/destroy', [SubCategoryController::class, 'destroy'])->name('backend.sub_category.destroy');
Route::get('/admin/sub-category/change-status', [SubCategoryController::class, 'changeStatus'])->name('backend.sub_category.change_status');
Route::get('/admin/sub-category/search', [SubCategoryController::class, 'search'])->name('backend.sub_category.search');
// ------------------------------------Main Category Routes(ends)----------------------------------------------------------------


    Route::get('admin/product', [ProductController::class, 'index'])->name('backend.admin.product.index');
    Route::get('/admin/product/create', [ProductController::class, 'create'])->name('backend.product.create');
Route::get('/admin/product/test', [ProductController::class, 'test'])->name('backend.product.test');
Route::post('/admin/product/store', [ProductController::class, 'store'])->name('backend.product.store');
    Route::post('/admin/product/add-attribute', [ProductController::class, 'addAttribute'])->name('backend.product.add_attribute');
Route::post('/admin/product/get-attribte-value', [ProductController::class, 'getAttributeValue'])->name('backend.product.get-attribte-value');
Route::post('/admin/product/get-attribte-value', [ProductController::class, 'getAttributeValue'])->name('backend.product.get-attribte-value');
// Route::get('/admin/product/edit/{id}', [ProductController::class, 'edit'])->name('backend.product.edit');
// Route::post('/admin/product/update/{id}', [ProductController::class, 'update'])->name('backend.product.update');
// Route::get('/admin/product/destroy', [ProductController::class, 'destroy'])->name('backend.product.destroy');
// Route::get('/admin/product/change-status', [ProductController::class, 'changeStatus'])->name('backend.product.change_status');
// Route::get('/admin/product/search', [ProductController::class, 'search'])->name('backend.product.search');
});
// -------------------------After Admin login (end) ------------------------------------------------------------