<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WifiPlanController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Auth\LoginController;

// Landing page
Route::get('/', [WifiPlanController::class, 'index'])->name('welcome');

// Authentication routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Wi-Fi plan selection page
Route::get('/plans', [WifiPlanController::class, 'index'])->name('plans');

// Payment routes
Route::post('/payment', [PaymentController::class, 'handlePayment'])->name('payment.handlePayment');
Route::get('/payment', [PaymentController::class, 'showPaymentPage'])->name('payment.show');
Route::post('/payment/callback', [PaymentController::class, 'handlePaymentCallback'])->name('payment.callback');
Route::get('/thank-you', [PaymentController::class, 'thankYou'])->name('thankyou');
