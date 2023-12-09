<?php

declare(strict_types=1);

use App\Http\Controllers\Customer\CartController;
use App\Http\Controllers\Customer\OrderController;
use Illuminate\Support\Facades\Route;

Route::get('cart', [CartController::class, 'index'])->name('cart.index');
Route::post('cart/{product}/add', [CartController::class, 'add'])->name('cart.add');
Route::post('cart/{uuid}/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::delete('cart', [CartController::class, 'destroy'])->name('cart.destroy');

Route::get('orders', [OrderController::class, 'index'])->name('orders.index');
Route::post('orders', [OrderController::class, 'store'])->name('orders.store');
