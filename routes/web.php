<?php

use App\Http\Controllers\ProductsController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProductsController::class, 'index'])->name('products.index');
Route::get('/create', [ProductsController::class, 'create'])->name('products.create');
Route::post('/store', [ProductsController::class, 'store'])->name('products.store');
Route::get('/{id}', [ProductsController::class, 'show'])->name('products.show');
Route::get('/{id}/edit', [ProductsController::class, 'edit'])->name('products.edit');
Route::put('/{id}', [ProductsController::class, 'update'])->name('products.update');
Route::delete('/{id}', [ProductsController::class, 'destroy'])->name('products.destroy');

