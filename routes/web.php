<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Route untuk halaman login (guest)
Route::get('/', function () {
    return view('auth.login');
})->middleware('guest');

// Route untuk halaman cart dengan nama 'cart.index'
Route::get('/cart', [CartController::class, 'index'])->name('cart.index')->middleware(['auth', 'petugas']);

// Route untuk halaman checkout dengan middleware
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index')->middleware(['auth', 'petugas']);

// Grouping middleware untuk autentikasi
Route::middleware('auth')->group(function () {
    // Resource routes untuk produk
    Route::resource('produk', ProdukController::class);

    // Resource routes untuk stok
    Route::resource('stok', StokController::class);

    // Resource routes untuk pembelian dengan middleware tambahan
    Route::resource('pembelian', PembelianController::class)->middleware('petugas');

    // Route untuk pencarian produk
    Route::get('search', [ProdukController::class, 'search'])->name('produk.search');

    // Grouping untuk profile pengguna
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    // Middleware untuk admin
    Route::middleware('admin')->group(function () {
        Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('dashboard');
        Route::resource('user', UserController::class);
    });

    // Routes untuk manajemen keranjang
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');

    // Routes untuk checkout
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

    // Halaman sukses setelah checkout
    Route::get('/checkout/success', function () {
        return view('checkout.success');
    })->name('checkout.success');
});

// Include routes untuk autentikasi bawaan Laravel
require __DIR__ . '/auth.php';
