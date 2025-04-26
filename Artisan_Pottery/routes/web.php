<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\ProductReviewController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;

// Store Front-end Routes
Route::get('/', [StoreController::class, 'index'])->name('home');
Route::get('/about', function () {
    return view('store.about');
})->name('about');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

// Shop Routes
Route::get('/shop', [ProductController::class, 'indexStore'])->name('shop');
Route::get('/shop/{product}', [ProductController::class, 'show'])->name('store.products.show'); 

// Order Confirmation Route
Route::get('/order-confirmation', function () {
    return view('store.order-confirmation');
})->name('order.confirmation');

// User Orders Route
Route::get('/my-orders', function () {
    return view('store.orders');
})->middleware(['auth'])->name('store.orders');

// User Profile Routes
Route::get('/profile', function () {
    return view('store.profile');
})->middleware(['auth'])->name('store.profile');
Route::put('/profile', [ProfileController::class, 'update'])->middleware(['auth'])->name('profile.update');

// Cart Routes
Route::get('/cart', [CartController::class, 'show'])->name('cart.show');
Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

// Checkout Routes
Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout');
Route::get('/checkout/success', [CartController::class, 'success'])->name('checkout.success');
Route::get('/checkout/cancel', [CartController::class, 'cancel'])->name('checkout.cancel');

// Wishlist Routes
Route::get('/wishlist', [WishlistController::class, 'show'])->name('wishlist.show');
Route::post('/wishlist/toggle/{id}', [WishlistController::class, 'toggle'])->name('wishlist.toggle');
Route::post('/wishlist/remove/{id}', [WishlistController::class, 'remove'])->name('wishlist.remove');
Route::post('/wishlist/clear', [WishlistController::class, 'clear'])->name('wishlist.clear');

// Authentication Routes
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Password Reset Routes
Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');

// Admin Routes
Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    
    // Admin Resource Routes
    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);
    
    // Order Management Routes
    Route::get('orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::patch('orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.update-status');
    Route::get('orders-export', [OrderController::class, 'export'])->name('orders.export');
});


// Product Review Routes
// Review routes
Route::middleware('auth')->group(function () {
});
Route::get('products/{product}/reviews/create', [ProductReviewController::class, 'create'])->name('reviews.create');
Route::post('products/{productId}/reviews', [ProductReviewController::class, 'store'])->name('reviews.store');

Route::get('products/{productId}/reviews', [ProductReviewController::class, 'index'])->name('reviews.index');    