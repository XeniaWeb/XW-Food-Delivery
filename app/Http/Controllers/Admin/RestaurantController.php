<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Enums\RoleName;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRestaurantRequest;
use App\Http\Requests\UpdateRestaurantRequest;
use App\Models\City;
use App\Models\Restaurant;
use App\Models\Role;
use App\Models\User;
use App\Notifications\RestaurantOwnerInvitation;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Inertia\Response;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     * @throws AuthorizationException
     */
    public function index(): Response
    {
        $this->authorize('restaurant.viewAny');

        return Inertia::render('Admin/Restaurants/Index', [
            'restaurants' => Restaurant::with(['city', 'owner'])->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @throws AuthorizationException
     */
    public function create(): Response
    {
        $this->authorize('restaurant.create');

        return Inertia::render('Admin/Restaurants/Create', [
            'cities' => City::query()->get(['id', 'name']),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRestaurantRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        DB::transaction(function () use ($validated) {
            $user = User::create([
               'name' => $validated['owner_name'],
               'email' => $validated['email'],
               'password' => '',
            ]);

            $user->roles()->sync(Role::where('name', RoleName::VENDOR->value)->first());

            $user->restaurants()->create([
               'city_id' => (int)$validated['city_id'],
               'name' => $validated['restaurant_name'],
               'address' => $validated['address'],
            ]);

            $user->notify(new RestaurantOwnerInvitation($validated['restaurant_name']));
        });

        return to_route('admin.restaurants.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Restaurant $restaurant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * @throws AuthorizationException
     */
    public function edit(Restaurant $restaurant): Response
    {
        $this->authorize('restaurant.update');

        $restaurant->load(['city', 'owner']);

        return Inertia::render('Admin/Restaurants/Edit', [
            'restaurant' => $restaurant,
            'cities' => City::query()->get(['id', 'name']),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRestaurantRequest $request, Restaurant $restaurant)
    {
        $validated = $request->validated();

        $restaurant->update([
            'city_id' => $validated['city_id'],
            'name'    => $validated['restaurant_name'],
            'address' => $validated['address'],
        ]);

        return to_route('admin.restaurants.index')
            ->withStatus('Restaurant updated successfully.');    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Restaurant $restaurant)
    {
        //
    }
}
