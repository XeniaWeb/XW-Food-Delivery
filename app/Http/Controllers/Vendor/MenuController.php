<?php

declare(strict_types=1);

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MenuController extends Controller
{
    public function index()
    {
        $this->authorize('category.viewAny');

        // TODO Menu as Model
        // TODO list of restaurants & more Menus for each one

        $restaurant_id = auth()->user()->restaurants()->first()->id;

        return Inertia::render('Vendor/Menu', [
            'categories' => Category::query()
                ->where('restaurant_id', '=', $restaurant_id)
                ->with('products')
                ->get()]);
    }
}
