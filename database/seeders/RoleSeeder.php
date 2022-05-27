<?php

namespace Database\Seeders;

use App\Classes\CustomRoles;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    public $dashboard_permissions = [
        ['name' => 'dashboard', 'guard_name' => 'web'],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::insert($this->dashboard_permissions);

        $manager = Role::create(['name' => CustomRoles::ROLE_MANAGER]);
        Role::create(['name' => CustomRoles::ROLE_CLIENT]);

        $manager->syncPermissions(['dashboard']);

    }
}
