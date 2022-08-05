<?php

namespace Database\Seeders;

use Backpack\PermissionManager\app\Models\Role;
use Illuminate\Database\Seeder;

class OrgSurveyManagerRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::query()->where('name', 'org-survey-manager')->existsOr(function () {
            $role = Role::create(['name' => 'org-survey-manager', 'guard_name' => 'admin']);
        });
    }
}
