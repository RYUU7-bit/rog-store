<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\BakongController;
use App\Http\Controllers\AdminController;

// Home
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');

// Shop
Route::get('/shop', [ShopController::class, 'index'])->name('shop');
Route::get('/shop/product/{slug}', [ProductController::class, 'show'])->name('product.show');

// Cart
Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::put('/cart/{cart}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/{cart}', [CartController::class, 'remove'])->name('cart.remove');
Route::delete('/cart', [CartController::class, 'clear'])->name('cart.clear');

// Checkout
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
Route::get('/checkout/success/{orderNumber}', [CheckoutController::class, 'success'])->name('checkout.success');

// BAKONG KHQR Payment
Route::post('/bakong/generate', [BakongController::class, 'generate'])->name('bakong.generate');
Route::post('/bakong/check',    [BakongController::class, 'check'])->name('bakong.check');

// Admin Dashboard
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/',               [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/orders',         [AdminController::class, 'orders'])->name('orders');
    Route::get('/orders/{order}', [AdminController::class, 'orderShow'])->name('orders.show');
    Route::patch('/orders/{order}/status', [AdminController::class, 'orderStatus'])->name('orders.status');

    // Products
    Route::get('/products',              [AdminController::class, 'products'])->name('products');
    Route::get('/products/{product}/edit',[AdminController::class, 'productEdit'])->name('products.edit');
    Route::put('/products/{product}',    [AdminController::class, 'productUpdate'])->name('products.update');
    Route::patch('/products/{product}/toggle', [AdminController::class, 'productToggle'])->name('products.toggle');
});
