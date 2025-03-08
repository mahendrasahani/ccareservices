<?php
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\PaymentController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\RazorpayController;
use App\Http\Controllers\Backend\ReviewController;
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
Route::post('/contact-us', [PageController::class, 'submitContactPage'])->name('frontend.contact_us.submit_contact_form');
// Route::get('/product', [PageController::class, 'viewProductPageView'])->name('frontend.view_product.view');
Route::get('/single-product', [PageController::class, 'viewSingleProductView'])->name('frontend.single_product.view');
Route::get('/return', [PageController::class, 'returnView'])->name('frontend.return.view');
// ------------------------ All Pages route (end) --------------------------------------------------------

// -------------------------After user login (start) ------------------------------------------------------------
Route::middleware(['auth', 'verified', 'user_check', 'customer_otp_verification'])->group(function () {
    Route::get('/dashboard', [UserDashboardController::class, 'userDashboardPageView'])->name('frontend.user.dashboar.view');
    Route::get('/manage-profile', [UserDashboardController::class, 'manageProfilePageView'])->name('frontend.user.manage_profile.view');
    Route::post('/update-profile', [UserDashboardController::class, 'updateUserProfile'])->name('frontend.user.update_profile');
    Route::get('/discount', [UserDashboardController::class, 'discountPageView'])->name('frontend.user.discount.view');
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
 // -------------------------add to cart page (end) --------------------------------------------------------------

Route::middleware(['auth', 'verified', 'customer_otp_verification'])->group(function () {
// -------------------------After Both User and Admin login (start) --------------------------------------------------------------
   
// ------------------------ Checkout page route (end) ---------------------------------------------------------------------
        Route::get('/checkout', [CheckoutController::class, 'checkoutPageView'])->name('frontend.checkout.view');
        Route::get('/checkout-product-list', [ProductController::class, 'productToCheckout'])->name('frontend.checkout.product_list');
        Route::get('/get-tax-list', [ProductController::class, 'getTaxList'])->name('frontend.checkout.get_tax_list');

        Route::post('/payment-method', [CheckoutController::class, 'submitCheckoutAddress'])->name('submit_checkout_address');
        Route::get('/payment-method', [CheckoutController::class, 'redirectOnCart'])->name('redirect_on_cart');
       
        Route::get('/create-order', [RazorpayController::class, 'createOrder']);
        Route::get('/payment-success', [RazorpayController::class, 'paymentSuccess']);

     
    // Route::get('/payment-method', [PaymentController::class, 'paymentMethodShow'])->name('payment_method'); 
       Route::get('/get-address-payment-detail', [PaymentController::class, 'getAddressDetail'])->name('get_address_payment_detail');
      
       Route::post('/place-order', [OrderController::class, 'placeOrder'])->name('place_order');
       Route::get('/purchase-history', [OrderController::class, 'purchaseHistory'])->name('frontend.user.purchase_history.view');
       Route::get('/order-detail/{id}', [OrderController::class, 'orderDetail'])->name('frontend.user.view_order_detail');
 
    // ------------------------ Checkout page route (end) ----------------------------------------------------------------------


    Route::post('/submit-review', [ReviewController::class, 'submitReview'])->name('frontend.submit_review'); 

// -------------------------After Both User and Admin login (end) --------------------------------------------------------------
});

 
 
Route::get('/test-command', [HomeController::class, 'testCommand']);

