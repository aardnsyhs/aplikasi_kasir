<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
})->middleware('guest')->name('login');

Route::middleware(['auth'])->group(function () {

    Route::middleware(['admin'])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('user', UserController::class);
        Route::get('/export-excel', [DashboardController::class, 'exportExcel'])->name('export.excel');
        Route::get('/export-pdf', [DashboardController::class, 'exportPDF'])->name('export.pdf');
    });

    Route::middleware(['petugas'])->group(function () {
        Route::prefix('cart')->name('cart.')->group(function () {
            Route::get('/', [CartController::class, 'index'])->name('index');
            Route::post('/add', [CartController::class, 'add'])->name('add');
            Route::post('/remove', [CartController::class, 'remove'])->name('remove');
            Route::post('/update', [CartController::class, 'update'])->name('update');
        });

        Route::prefix('checkout')->name('checkout.')->group(function () {
            Route::get('/', [CheckoutController::class, 'index'])->name('index');
            Route::post('/', [CheckoutController::class, 'store'])->name('store');
            Route::get('/success', function () {
                return view('checkout.success');
            })->name('success');
        });

        Route::resource('pembelian', PembelianController::class);
        Route::get('/cek-member', [CheckoutController::class, 'cekMember']);
    });

    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
    });

    Route::get('/checkout/success/{id}', [CheckoutController::class, 'show'])->name('checkout.success');
    Route::get('search', [ProdukController::class, 'search'])->name('produk.search');
    Route::resource('produk', ProdukController::class);
    Route::resource('stok', StokController::class);
});

require __DIR__ . '/auth.php';
