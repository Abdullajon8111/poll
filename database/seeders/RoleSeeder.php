<?php

namespace Database\Seeders;

use Backpack\PermissionManager\app\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::query()->where('name', 'admin')->existsOr(function () {
            $role = Role::create(['name' => 'admin', 'guard_name' => 'admin']);
        });

        Role::query()->where('name', 'admin')->existsOr(function () {
            $role = Role::create(['name' => 'operator', 'guard_name' => 'admin']);
        });
    }
}
