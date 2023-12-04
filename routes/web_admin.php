<?php

declare(strict_types=1);

use App\Http\Controllers\Admin\RestaurantController;
use Illuminate\Support\Facades\Route;

Route::resource('/restaurants', RestaurantController::class);
