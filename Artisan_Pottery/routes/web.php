<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CartController;


Route::get('/', function () {
    return view('store.index');
})->name('home');
// Route::get('/shop', function () {
//     return view('store.shop ');
// });


route::get('dashboard', function () {
    return view('dashboard');
})->name('dashboard');

route::get('about', function () {
    return view('store.about');
})->name('about');

route::get('contact', function () {
    return view('store.contact');
})->name('contact');


Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

route::get('/shop', [ProductController::class, 'indexStore'])->name('shop');
Route::get('/cart', [CartController::class, 'show'])->name('cart.show');
Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');


Route::post('/logout', 'AuthController@logout');

Route::resource('categories', CategoryController::class);
Route::resource('products', ProductController::class);