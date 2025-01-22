<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
})->middleware('guest');

Route::get('/cart', function () {
    return view('cart.index');
})->middleware(['auth', 'petugas']);

Route::middleware('auth')->group(function () {
    Route::resource('produk', ProdukController::class);
    Route::resource('stok', StokController::class);
    Route::resource('pembelian', PembelianController::class)->middleware('petugas');

    Route::get('search', [ProdukController::class, 'search'])->name('produk.search');

    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    Route::middleware('admin')->group(function () {
        Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('dashboard');
        Route::resource('user', UserController::class);
    });

    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
});

require __DIR__ . '/auth.php';
