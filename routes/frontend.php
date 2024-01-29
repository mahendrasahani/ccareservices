<?php
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Frontend\UserDashboardController;

// ------------------------ Home page route (start) --------------------------------------------------------
Route::get('/', [HomeController::class, 'homePageView'])->name('frontend.home.view');
// ------------------------ Home page route (end) --------------------------------------------------------

// ------------------------ Cart page route (end) --------------------------------------------------------
Route::get('/cart', [CartController::class, 'cartPageView'])->name('frontend.cart.view');
// ------------------------ Cart page route (end) --------------------------------------------------------

// ------------------------ Checkout page route (end) --------------------------------------------------------
Route::get('/checkout', [CheckoutController::class, 'checkoutPageView'])->name('frontend.checkout.view');
// ------------------------ Checkout page route (end) --------------------------------------------------------

// ------------------------ All Pages route (end) --------------------------------------------------------
Route::get('/about-us', [PageController::class, 'aboutPageView'])->name('frontend.about.view');
Route::get('/privacy-policy', [PageController::class, 'privacyPolicyPageView'])->name('frontend.privacy_policy.view');
Route::get('/terms-and-condition', [PageController::class, 'termsAndConditionPageView'])->name('frontend.terms_and_condition.view');
Route::get('/contact-us', [PageController::class, 'contactUsPageView'])->name('frontend.contact_us.view');
Route::get('/product', [PageController::class, 'viewProductPageView'])->name('frontend.view_product.view');
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