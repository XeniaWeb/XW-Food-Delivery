<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class RestaurantController extends Controller
{
    public function show(Restaurant $restaurant): Response
    {
        return Inertia::render('Restaurant', [
            'restaurant' => $restaurant->load('categories.products'),
        ]);
    }
}
