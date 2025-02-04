<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('register', [RegisteredUserController::class, 'store']);
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
    Route::post('sendLoginOTP', [AuthenticatedSessionController::class, 'sendLoginOTP'])->name('sendLoginOTP');
    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');
    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
    Route::post('reset-password', [NewPasswordController::class, 'store'])->name('password.store');
    Route::get('otp-verify/{user}', [RegisteredUserController::class, 'verifyOtp'])->name('otp.verify');
    Route::post('edit-phone-number/{user}', [RegisteredUserController::class, 'editPhoneNumber'])->name('otp.edit_phone_number');
    Route::post('otp-verify-submit/{user_id}', [RegisteredUserController::class, 'verifyOtpSubmit'])->name('otp.verify.submit');
    Route::get('check-account_exist', [AuthenticatedSessionController::class, 'checkAccount'])->name('user.check_account_exist');
});

Route::middleware('auth')->group(function () {
    Route::post('re-edit-phone-number/{user}', [RegisteredUserController::class, 'EditPhoneNumber'])->name('otp.re_edit_phone_number');
    Route::get('otp-re-verify/{user}', [RegisteredUserController::class, 'reVerifyOtp'])->name('otp.re_verify');
    Route::post('otp-re-verify-submit/{user_id}', [RegisteredUserController::class, 'reVerifyOtpSubmit'])->name('otp.re_verify.submit');
    Route::get('verify-email', EmailVerificationPromptController::class)->name('verification.notice');
    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)->middleware(['signed', 'throttle:6,1'])->name('verification.verify');
    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])->middleware('throttle:6,1')->name('verification.send');
    // Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])->name('password.confirm'); 
    // Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);
    // Route::put('password', [PasswordController::class, 'update'])->name('password.update');
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});
