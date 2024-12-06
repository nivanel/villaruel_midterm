<?php

use App\Models\Product;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $product = Product::all();
    return view('dashboard', compact('product'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('/product/store', [ProductController::class, 'store']) -> name ('product.store');
Route::delete('/product/{product}', [ProductController::class, 'destroy']) -> name ('product.destroy');

Route::get('/product/{product}edit', [ProductController::class, 'edit']) -> name ('product.edit');

Route::put('/product/{product}', [ProductController::class, 'update']) -> name ('product.update');

require __DIR__.'/auth.php';
