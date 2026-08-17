<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\BakongController;
use App\Http\Controllers\AdminController;

// Diagnostic debug route
Route::get('/debug-error', function () {
    $results = [];

    // 1. App key & env
    $results['app_env'] = config('app.env');
    $results['app_key_set'] = !empty(config('app.key'));
    $results['db_connection_default'] = config('database.default');

    // 2. Test DB
    try {
        \DB::connection()->getPdo();
        $results['db'] = 'Connected: ' . \DB::connection()->getDatabaseName();
        $results['categories_count'] = \App\Models\Category::count();
        $results['products_count'] = \App\Models\Product::count();
    } catch (\Throwable $e) {
        $results['db_error'] = $e->getMessage();
    }

    // 3. Test Session
    try {
        \Session::put('test_key', 'test_val');
        $results['session'] = 'Session working: ' . \Session::get('test_key');
    } catch (\Throwable $e) {
        $results['session_error'] = $e->getMessage();
    }

    // 4. Test View Render
    try {
        $view = view('about')->render();
        $results['view_about_render'] = 'Success (length: ' . strlen($view) . ')';
    } catch (\Throwable $e) {
        $results['view_about_error'] = $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine();
    }

    return response()->json($results, 200, [], JSON_PRETTY_PRINT);
});

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
Route::post('/checkout/confirm-bakong', [CheckoutController::class, 'confirmBakong'])->name('checkout.confirm_bakong');
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
