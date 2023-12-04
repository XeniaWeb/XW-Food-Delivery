<?php

namespace Database\Seeders;

use App\Enums\RoleName;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run(): void
    {
        $this->createAdminRole();
        $this->createVendorRole();
    }

    /**
     * @param RoleName $role
     * @param Collection $permissions
     * @return void
     */
    protected function createRole(RoleName $role, Collection $permissions): void
    {
        $newRole = Role::create(['name' => $role->value]);
        $newRole->permissions()->sync($permissions);
    }

    /**
     * @return void
     */
    protected function createAdminRole(): void
    {
        $permissions = Permission::query()
            ->where('name', 'like', 'user.%')
            ->orWhere('name', 'like', 'restaurant.%')
            ->pluck('id');

        $this->createRole(RoleName::ADMIN, $permissions);
    }

    /**
     * @return void
     */
    protected function createVendorRole(): void
    {
        $this->createRole(RoleName::VENDOR, collect());
    }
}
