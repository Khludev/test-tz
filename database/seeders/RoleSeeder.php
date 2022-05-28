<?php

namespace Database\Seeders;

use App\Classes\CustomRoles;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class RoleSeeder extends Seeder
{
    public $dashboard_permissions = [
        ['name' => 'dashboard', 'guard_name' => 'web'],
    ];

    public $client_permissions = [
        ['name' => 'clientPanel', 'guard_name' => 'web'],
        ['name' => 'clintCreate', 'guard_name' => 'web'],
    ];

    public $manager_permissions = [
        ['name' => 'managerPanel', 'guard_name' => 'web'],
        ['name' => 'managerReply', 'guard_name' => 'web'],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create(['name' => 'clientPanel']);
        Permission::create(['name' => 'clintCreate']);
        Permission::create(['name' => 'managerPanel']);
        Permission::create(['name' => 'managerReply']);

        $manager = Role::create(['name' => CustomRoles::ROLE_MANAGER]);
        $manager->givePermissionTo('managerReply');
        $manager->givePermissionTo('managerPanel');

        $client = Role::create(['name' => CustomRoles::ROLE_CLIENT]);
        $client->givePermissionTo('clintCreate');
        $client->givePermissionTo('clientPanel');

    }
}
