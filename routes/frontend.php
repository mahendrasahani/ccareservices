<?php
use App\Http\Controllers\Backend\PaymentController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Frontend\UserDashboardController;
use App\Http\Controllers\UserController;

// ------------------------ Home page route (start) --------------------------------------------------------
Route::get('/', [HomeController::class, 'homePageView'])->name('frontend.home.view');
// ------------------------ Home page route (end) --------------------------------------------------------

// ------------------------ Cart page route (end) --------------------------------------------------------
Route::get('/cart', [CartController::class, 'showCart'])->name('frontend.show.cart');
// ------------------------ Cart page route (end) --------------------------------------------------------


// ------------------------ All Pages route (end) --------------------------------------------------------
Route::get('/about-us', [PageController::class, 'aboutPageView'])->name('frontend.about.view');
Route::get('/privacy-policy', [PageController::class, 'privacyPolicyPageView'])->name('frontend.privacy_policy.view');
Route::get('/terms-and-condition', [PageController::class, 'termsAndConditionPageView'])->name('frontend.terms_and_condition.view');
Route::get('/contact-us', [PageController::class, 'contactUsPageView'])->name('frontend.contact_us.view');
// Route::get('/product', [PageController::class, 'viewProductPageView'])->name('frontend.view_product.view');
Route::get('/single-product', [PageController::class, 'viewSingleProductView'])->name('frontend.single_product.view');
// ------------------------ All Pages route (end) --------------------------------------------------------

// -------------------------After user login (start) ------------------------------------------------------------
Route::middleware(['auth', 'user_check'])->group(function () {
    Route::get('/dashboard', [UserDashboardController::class, 'userDashboardPageView'])->name('frontend.user.dashboar.view');
    Route::get('/manage-profile', [UserDashboardController::class, 'manageProfilePageView'])->name('frontend.user.manage_profile.view');
    Route::get('/discount', [UserDashboardController::class, 'discountPageView'])->name('frontend.user.discount.view');
    Route::get('/purchase-history', [UserDashboardController::class, 'purchaseHistoryPageView'])->name('frontend.user.purchase_history.view');
    Route::get('/product-detail', [UserDashboardController::class, 'viewProductDetailPageView'])->name('frontend.user.view_product_detail.view');
});
// -------------------------After user login (end) ------------------------------------------------------------

// -------------------------product page (start) ------------------------------------------------------------
Route::get('/category/{main_category}/{sub_category?}', [ProductController::class, 'productListFrontView'])->name('frontend.product.product_list');
Route::get('/product/{product_slug}', [ProductController::class, 'singleProductFrontView'])->name('frontend.product.single_product');
// -------------------------product page (end) --------------------------------------------------------------

// -------------------------single product page (start) --------------------------------------------------------------
Route::get('/single-product/get-month-price', [ProductController::class, 'getMonthPrice'])->name('frontend.product.single_product.get_month_price');
// -------------------------single product page (end) --------------------------------------------------------------

// -------------------------add to cart page (start) --------------------------------------------------------------
Route::get('/verify-user', [UserController::class, 'verifyUser'])->name('verify_user');
Route::get('/add-to-cart', [CartController::class, 'addToCart'])->name('add_to_cart');
Route::get('/update-cart-on-load', [CartController::class, 'updateCartOnLoad'])->name('update_cart_on_load');
Route::get('/check-product-in-cart', [CartController::class, 'checkProductInCart'])->name('check_product_in_cart');
Route::get('/get-product-id', [ProductController::class, 'decryptProductId'])->name('decrypt_product_id');
Route::get('/check-stock', [ProductController::class, 'checkStock'])->name('check_stock');
Route::get('/remove-from-cart', [ProductController::class, 'removeFromCart'])->name('remove_from_cart');
Route::get('/testing-flush-cart', [CartController::class, 'testingFlushCart'])->name('testing_flush_cart');
// -------------------------add to cart page (end) --------------------------------------------------------------


Route::middleware(['auth'])->group(function () {
// -------------------------After Both User and Admin login (start) --------------------------------------------------------------

    // ------------------------ Checkout page route (end) ---------------------------------------------------------------------
       Route::get('/checkout', [CheckoutController::class, 'checkoutPageView'])->name('frontend.checkout.view');
       Route::get('/checkout-product-list', [ProductController::class, 'productToCheckout'])->name('frontend.checkout.product_list');

       Route::post('/payment-method', [CheckoutController::class, 'submitCheckoutAddress'])->name('submit_checkout_address');
    //    Route::get('/payment-method', [PaymentController::class, 'paymentMethodShow'])->name('payment_method'); 
       Route::get('/get-address-payment-detail', [PaymentController::class, 'getAddressDetail'])->name('get_address_payment_detail');
 
    // ------------------------ Checkout page route (end) ----------------------------------------------------------------------



// -------------------------After Both User and Admin login (end) --------------------------------------------------------------
});