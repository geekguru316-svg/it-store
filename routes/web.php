<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\AdminController;

use App\Http\Controllers\DashboardController;

Route::get('/', [ProductController::class, 'home'])->name('home');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::resource('products', ProductController::class);
Route::get('/categories', [ProductController::class, 'categories'])->name('categories.index');
Route::get('/category/{category}', [ProductController::class, 'category'])->name('products.category');
Route::get('/sitemap.xml', [ProductController::class, 'sitemapIndex'])->name('sitemap.index');
Route::get('/sitemap-en.xml', [ProductController::class, 'sitemap'])->name('sitemap.en');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');

Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
Route::post('/checkout-direct', [CheckoutController::class, 'store'])->name('checkout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/admin/products', [AdminController::class, 'products'])->name('admin.products.index');
    Route::get('/admin/analytics', [AdminController::class, 'analytics'])->name('admin.analytics');
    Route::post('/admin/products', [AdminController::class, 'store'])->name('admin.products.store');
    Route::delete('/admin/products/{id}', [AdminController::class, 'destroy'])->name('admin.products.destroy');
    Route::put('/admin/products/{product}', [AdminController::class, 'update'])
        ->name('admin.products.update');
    Route::get('/admin/orders', [AdminController::class, 'orders'])
        ->name('admin.orders.index');
    Route::get('/admin/products/{product}/edit', [AdminController::class, 'edit'])
        ->name('admin.products.edit');
    Route::put('/admin/orders/{order}/status', [AdminController::class, 'updateOrderStatus'])
        ->name('admin.orders.updateStatus');
    Route::get('/invoice/{id}', [AdminController::class, 'invoice'])
        ->name('invoice');
});

Route::post('/reviews', [\App\Http\Controllers\ReviewController::class, 'store'])->name('reviews.store');

Route::get('/track-order', function () {
    return view('track-order');
})->name('track-order');


Route::get('/run-seeder', function () {
    try {
        // Force recreate storage link on Render
        $storagePath = public_path('storage');
        if (file_exists($storagePath)) {
            // Remove if it's a directory or a broken link
            if (is_link($storagePath)) {
                unlink($storagePath);
            } else {
                \Illuminate\Support\Facades\File::deleteDirectory($storagePath);
            }
        }
        
        \Illuminate\Support\Facades\Artisan::call('storage:link');
        
        // Seed the products
        \Illuminate\Support\Facades\Artisan::call('db:seed', ['--class' => 'ProductSeeder', '--force' => true]);
        
        return 'Storage link recreated and Seeder executed successfully!';
    } catch (\Exception $e) {
        return 'Error: ' . $e->getMessage() . ' at line ' . $e->getLine();
    }
});
