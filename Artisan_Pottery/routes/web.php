<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\ProductReviewController;
use App\Http\Controllers\WishlistController;

// Store Front-end Routes
Route::get('/', [StoreController::class, 'index'])->name('home');
Route::get('/about', function () {
    return view('store.about');
})->name('about');
Route::get('/contact', function () {
    return view('store.contact');
})->name('contact');

// Shop Routes
Route::get('/shop', [ProductController::class, 'indexStore'])->name('shop');
Route::get('/shop/{product}', [ProductController::class, 'show'])->name('store.products.show'); 

// Cart Routes
Route::get('/cart', [CartController::class, 'show'])->name('cart.show');
Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

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

// Admin Routes
Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    
    // Admin Resource Routes
    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);
});


// Product Review Routes
// Review routes
Route::middleware('auth')->group(function () {
});
Route::get('products/{product}/reviews/create', [ProductReviewController::class, 'create'])->name('reviews.create');
Route::post('products/{productId}/reviews', [ProductReviewController::class, 'store'])->name('reviews.store');

Route::get('products/{productId}/reviews', [ProductReviewController::class, 'index'])->name('reviews.index');    