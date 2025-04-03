<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;


Route::get('/', function () {
    return view('store.index');
});


route::get('dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware('guest.custom')->group(function () {
    Route::get('/login', 'AuthController@showLoginForm');
    Route::post('/login', 'AuthController@login');
    Route::get('/register', 'AuthController@showRegistrationForm');
    Route::post('/register', 'AuthController@register');
});


Route::middleware('auth.custom')->group(function () {

});


Route::post('/logout', 'AuthController@logout');

Route::resource('categories', CategoryController::class);
Route::resource('products', ProductController::class);


Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');
