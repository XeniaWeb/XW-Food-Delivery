<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Enums\RoleName;
use App\Models\City;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $this->createAdminUser();
        $this->createVendorUser();
    }

    /**
     * @return void
     */
    public function createAdminUser(): void
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
        ])->roles()->sync(Role::where('name', RoleName::ADMIN->value)->first());
    }

    public function createVendorUser(): void
    {
        $vendor = User::create([
           'name' => 'Restaurant owner',
           'email' => 'vendor@admin.com',
           'password' => bcrypt('password'),
        ]);

        $vendor->roles()->sync(Role::where('name', RoleName::VENDOR->value)->first());

        $vendor->restaurants()->create([
            'city_id' => City::where('name', 'Schwyz')->value('id'),
            'name'    => 'Restaurant 001',
            'address' => 'Address DLKS22',
            ]);
    }
}
