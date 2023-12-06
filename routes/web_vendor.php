<?php

declare(strict_types=1);

use App\Http\Controllers\Vendor\CategoryController;
use App\Http\Controllers\Vendor\MenuController;
use App\Http\Controllers\Vendor\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('menu', [MenuController::class, 'index'])->name('menu');
Route::resource('categories', CategoryController::class);
Route::resource('products', ProductController::class);
