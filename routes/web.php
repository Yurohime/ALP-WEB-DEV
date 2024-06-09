<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('home');
});


Route::get('/register', function () {
    return view('register');
})->name('register');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('loginActual');
Route::post('/forgot', function () {
    return view('forgot');
})->name('forgot');

Route::post('/forgot', function () {
    return view('forgot');
})->name('forgot');

use App\Http\Controllers\ForgotPasswordController;

Route::get('forgot-password', [ForgotPasswordController::class, 'showForgotForm'])->name('forgot.password.form');
Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLink'])->name('forgot.password.link');
Route::get('reset-password/{token}/{email}', [ForgotPasswordController::class, 'showResetForm'])->name('reset.password');
Route::post('reset-password', [ForgotPasswordController::class, 'resetPassword'])->name('reset.password.post');




Route::post('/login', [AuthController::class, 'login'])->name('loginActual');

Route::get('/customer/home', [HomeController::class, 'customerHome'])->name('home');
Route::get('/admin/home', [HomeController::class, 'adminHome'])->name('admin.home');

Route::get('/', 'HomeController@index')->name('home');


Route::get('/admin/home', [HomeController::class, 'adminHome'])->name('admin.home');



Route::get('/admin/products', [ProductController::class, 'index'])->name('admin.products.index');
Route::post('/update-product/{id}', [ProductController::class, 'update'])->name('admin.products.update');




Route::get('/product/{id}', [ProductController::class, 'show'])->name('product');
Route::post('/product/{id}/add-to-cart', [ProductController::class, 'addToCart'])->name('product.addToCart');
Route::post('/product/{id}/add-to-wishlist', [ProductController::class, 'addToWishlist'])->name('product.addToWishlist');


Route::get('/home', [HomeController::class, 'customerHome'])->name('home');

use App\Http\Controllers\CartController;

Route::get('/cart', [CartController::class, 'index'])->name('cart.show');
Route::post('/cart/update-quantity', [CartController::class, 'updateQuantity'])->name('cart.updateQuantity');


use App\Http\Controllers\CheckoutController;

Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::post('/checkout/submit', [CheckoutController::class, 'submit'])->name('checkout.submit');


Route::get('/admin/login', function () {
    return view('admin.login');
})->name('admin.login');

use App\Http\Controllers\AdminTransactionController;


Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');


use App\Http\Controllers\TransactionController;

Route::get('/admin/transactions', [TransactionController::class, 'index'])->name('admin.transactions.index');
Route::get('/admin/transactions/yearly', [TransactionController::class, 'yearly'])->name('admin.transactions.yearly');
Route::get('/admin/transactions/monthly', [TransactionController::class, 'monthly'])->name('admin.transactions.monthly');
Route::get('/admin/transactions/{id}', [TransactionController::class, 'show'])->name('admin.transactions.show');


Route::get('/', [HomeController::class, 'index']);

use App\Http\Controllers\WishlistController;

Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist');
Route::post('/wishlist/add', [WishlistController::class, 'add'])->name('wishlist.add');
Route::delete('/wishlist/remove', [WishlistController::class, 'remove'])->name('wishlist.remove');


Route::get('/guest/home', [HomeController::class, 'index'])->name('guest.home');

Route::get('/', [HomeController::class, 'index']);

use App\Http\Controllers\AdminController;

Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');


use App\Http\Controllers\Auth\RegisterController;

Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

