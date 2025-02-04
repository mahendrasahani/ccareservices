<?php
use App\Http\Controllers\Backend\AdminDashboardController;
use App\Http\Controllers\Backend\AttributeController;
use App\Http\Controllers\Backend\AttributeValueController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CustomerController;
use App\Http\Controllers\Backend\DeliveryBoyController;
use App\Http\Controllers\Backend\InvoiceController;
use App\Http\Controllers\Backend\MainCategoryController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\PaymentController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ProductReturnController;
use App\Http\Controllers\Backend\RecentActivityController;
use App\Http\Controllers\Backend\ReturnController;
use App\Http\Controllers\Backend\ReviewController;
use App\Http\Controllers\Backend\ShippingChargeController;
use App\Http\Controllers\Backend\ShippingMethodCntroller;
use App\Http\Controllers\Backend\StockController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\TaxController;
use App\Http\Controllers\Backend\VendorController;
use App\Models\Backend\MainCategory;
use App\Models\Backend\Review;


Route::middleware('guest')->group(function () {
    Route::get('admin', [AdminDashboardController::class, 'adminLogin'])->name('backend.admin_login');
});

// -------------------------After Admin login (start) ------------------------------------------------------------
Route::middleware(['auth', 'web', 'admin_check'])->group(function () { 
    Route::get('admin/dashboard', [AdminDashboardController::class, 'adminDashboardPageView'])->name('backend.admin.dashboard.view');
    Route::get('admin/profile/edit', [AdminDashboardController::class, 'editAdminProfile'])->name('backend.admin.edit_admin_profile');
    Route::post('admin/profile-update', [AdminDashboardController::class, 'updateAdminProfile'])->name('backend.admin.update_admin_profile');

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
    Route::post('/admin/product/store', [ProductController::class, 'store'])->name('backend.product.store');
    Route::post('/admin/product/add-attribute', [ProductController::class, 'addAttribute'])->name('backend.product.add_attribute');
    Route::post('/admin/product/get-attribte-value', [ProductController::class, 'getAttributeValue'])->name('backend.product.get-attribte-value');
    Route::post('/admin/product/get-attribte-value', [ProductController::class, 'getAttributeValue'])->name('backend.product.get-attribte-value');
    Route::get('/admin/product/get-option-list', [ProductController::class, 'getOptionList'])->name('backend.product.get_option_list');
    Route::get('/admin/product/get-option-value-list', [ProductController::class, 'getOptionValueList'])->name('backend.product.get_option_value_list');


    Route::get('/admin/product/edit/{id}', [ProductController::class, 'edit'])->name('backend.product.edit');
    Route::post('/admin/product/update/{id}', [ProductController::class, 'update'])->name('backend.product.update');
    Route::get('admin/product/view/{id}', [ProductController::class, 'view'])->name('backend.product.view');
    Route::post('admin/product/clone/', [ProductController::class, 'clone'])->name('backend.product.clone');
    Route::get('/admin/product/destroy', [ProductController::class, 'destroy'])->name('backend.product.destroy');
    Route::get('/admin/product/change-status', [ProductController::class, 'changeStatus'])->name('backend.product.change_status');
    Route::get('/admin/product/multi-destroy', [ProductController::class, 'multiDestroy'])->name('backend.product.multi_destroy');
    Route::get('/admin/product/search', [ProductController::class, 'search'])->name('backend.product.search');

    Route::get('/admin/shipping-charge', [ShippingChargeController::class, 'index'])->name('backend.shipping_charge.index');
    Route::post('/admin/shipping-charge/store', [ShippingChargeController::class, 'store'])->name('backend.shipping_charge.store');
    Route::get('/admin/shipping-method/change_status', [ShippingChargeController::class, 'changeStatus'])->name('backend.shipping_charge.change_status');
    Route::get('/admin/shipping-method/edit/{id}', [ShippingChargeController::class, 'edit'])->name('backend.shipping_charge.edit');
    Route::post('/admin/shipping-method/update/{id}', [ShippingChargeController::class, 'update'])->name('backend.shipping_charge.update');
    Route::get('/admin/shipping-method/destroy', [ShippingChargeController::class, 'destroy'])->name('backend.shipping_charge.destroy');

    Route::get('/admin/vendor', [VendorController::class, 'index'])->name('backend.vendor.index');
    Route::get('/admin/vendor/create', [VendorController::class, 'create'])->name('backend.vendor.create');
    Route::post('/admin/vendor/store', [VendorController::class, 'store'])->name('backend.vendor.store');
    Route::get('/admin/vendor/edit/{id}', [VendorController::class, 'edit'])->name('backend.vendor.edit');
    Route::post('/admin/vendor/update/{id}', [VendorController::class, 'update'])->name('backend.vendor.update');
    Route::get('/admin/vendor/destroy', [VendorController::class, 'destroy'])->name('backend.vendor.destroy');
    Route::get('/admin/vendor/search', [VendorController::class, 'search'])->name('backend.vendor.search');


    Route::get('/admin/stock', [StockController::class, 'index'])->name('backend.stock.index');
    Route::get('/admin/stock/create', [StockController::class, 'create'])->name('backend.stock.create');
    Route::post('/admin/stock/store', [StockController::class, 'store'])->name('backend.stock.store');
    Route::get('/admin/stock/edit/{id}', [StockController::class, 'edit'])->name('backend.stock.edit');
    Route::post('/admin/stock/update/{id}', [StockController::class, 'update'])->name('backend.stock.update');
    Route::get('/admin/stock/variant-value-list', [StockController::class, 'getVariantValueList'])->name('backend.stock.get_variant_value_list');
    Route::get('/admin/stock/destroy', [StockController::class, 'destroy'])->name('backend.stock.destroy');
    Route::get('/admin/stock/search', [StockController::class, 'search'])->name('backend.stock.search');
    


    Route::get('/admin/order', [OrderController::class, 'index'])->name('backend.order.index');
    Route::get('/admin/order/edit/{id}', [OrderController::class, 'edit'])->name('backend.order.edit');
    Route::post('/admin/order/update/{id}', [OrderController::class, 'update'])->name('backend.order.update');
    Route::get('/admin/order/destroy', [OrderController::class, 'destroy'])->name('backend.order.destroy');
    Route::get('/admin/order/search', [OrderController::class, 'search'])->name('backend.product.search');
    Route::get('/admin/order/send-invoice-to-customer/{order_id}', [OrderController::class, 'sendInvoiceToCustomer'])->name('backend.order.send_invoice_to_customer');


    Route::get('/admin/invoice/{id}', [InvoiceController::class, 'index'])->name('backend.invoice.index');


    Route::get('/admin/delivery-boy', [DeliveryBoyController::class, 'index'])->name('backend.delivery_boy.index');
    Route::get('/admin/delivery-boy/create', [DeliveryBoyController::class, 'create'])->name('backend.delivery_boy.create');
    Route::post('/admin/delivery-boy/store', [DeliveryBoyController::class, 'store'])->name('backend.delivery_boy.store');
    Route::get('/admin/delivery-boy/edit/{id}', [DeliveryBoyController::class, 'edit'])->name('backend.delivery_boy.edit');
    Route::post('/admin/delivery-boy/update/{id}', [DeliveryBoyController::class, 'update'])->name('backend.delivery_boy.update');
    Route::get('/admin/delivery-boy/search', [DeliveryBoyController::class, 'search'])->name('backend.delivery_boy.search');


    Route::get('/admin/customers', [CustomerController::class, 'index'])->name('backend.customer.index'); 
    Route::get('/admin/customers/create', [CustomerController::class, 'create'])->name('backend.customer.create'); 
    Route::post('/admin/customers/store', [CustomerController::class, 'store'])->name('backend.customer.store'); 
    Route::get('/admin/customers/view/{id}', [CustomerController::class, 'view'])->name('backend.customer.view'); 
    Route::get('/admin/customers/search', [CustomerController::class, 'search'])->name('backend.customer.search');


    Route::get('/admin/payment-method/', [PaymentController::class, 'index'])->name('backend.payment_method.index'); 
    Route::post('/admin/payment-method/update-razorpay-credentials/{id}', [PaymentController::class, 'updateRazorpayCredentials'])->name('backend.update_razorpya_credentials'); 
     
    Route::get('/admin/review', [ReviewController::class, 'index'])->name('backend.review.index');

     Route::get('/admin/return', [ProductReturnController::class, 'index'])->name('backend.return.index');
     Route::get('/admin/return/edit/{id}', [ProductReturnController::class, 'edit'])->name('backend.return.edit');
     Route::get('/admin/return/view', [ProductReturnController::class, 'view'])->name('backend.return.view');
     Route::get('/admin/return/create', [ProductReturnController::class, 'create'])->name('backend.return.create');
     Route::post('/admin/return/store', [ProductReturnController::class, 'store'])->name('backend.return.store');
     Route::post('/admin/return/update/{id}', [ProductReturnController::class, 'update'])->name('backend.return.update');
    Route::get('/admin/return/search', [ProductReturnController::class, 'search'])->name('backend.return.search');

     
     
     Route::get('/admin/tax', [TaxController::class, 'index'])->name('backend.tax'); 
     Route::get('/admin/tax/create', [TaxController::class, 'create'])->name('backend.tax.create');
     Route::post('/admin/tax/store', [TaxController::class, 'store'])->name('backend.tax.store');
     Route::get('/admin/tax/edit/{id}', [TaxController::class, 'edit'])->name('backend.tax.edit');
     Route::post('/admin/tax/update/{id}', [TaxController::class, 'update'])->name('backend.tax.update');
     Route::get('/admin/tax/change-status', [TaxController::class, 'changeStatus'])->name('backend.tax.change_status');


     Route::get('/admin/recent-activity', [RecentActivityController::class, 'index'])->name('backend.recent_activity');
    Route::get('/admin/recent-activity/search', [RecentActivityController::class, 'search'])->name('backend.recent_activity.search');


});
// -------------------------After Admin login (end) ------------------------------------------------------------

