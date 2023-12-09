<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;
use Inertia\Response;

class CartController extends Controller
{
    /**
     * @return Response
     */
    public function index(): Response
    {
        return Inertia::render('Customer/Cart');
    }

    /**
     * @param string $uuid
     * @return RedirectResponse
     */
    public function remove(string $uuid): RedirectResponse
    {
        $items = collect(session('cart.items'))
            ->reject(function ($item) use ($uuid) {
               return $item['uuid'] == $uuid;
            });

        session(['cart.items' => $items->values()->toArray()]);

        $this->updateTotal();

        return back();
    }

    /**
     * @param Product $product
     * @return RedirectResponse
     * @throws AuthorizationException
     */

    public function add(Product $product): RedirectResponse
    {
        $this->authorize('cart.add');

        $restaurant = $product->category->restaurant;

        $cart = session('cart', [
            'items'           => [],
            'total'           => 0,
            'restaurant_name' => '',
            'restaurant_id'   => '',
        ]);

        $validator = Validator::make($cart, [
            'items'                 => ['array'],
            'items.*.restaurant_id' => ['required', 'in:' . $restaurant->id],
        ]);

        if ($validator->fails()) {
            return back()->withErrors(['message' => 'Can\'t add product from different vendor.']);
        }

        $item                  = $product->toArray();
        $item['uuid']          = (string) str()->uuid();
        $item['restaurant_id'] = $restaurant->id;

        session()->push('cart.items', $item);
        session()->put('cart.restaurant_name', $restaurant->name);
        session()->put('cart.restaurant_id', $restaurant->id);

        $this->updateTotal();

        return back();
    }

    /**
     * @return RedirectResponse
     */
    public function destroy(): RedirectResponse
    {
        session()->forget('cart');

        return back();
    }

    /**
     * @return void
     */
    protected function updateTotal(): void
    {
        $items = collect(session('cart.items'));

        session()->put('cart.total', $items->sum('price'));
    }
}
