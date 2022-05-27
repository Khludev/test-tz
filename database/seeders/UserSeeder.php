<?php

namespace Database\Seeders;

use App\Classes\CustomRoles;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pass = bcrypt('admin123'); // Pass admin123
        $manager = User::create([
            'name' => 'Manager Petro',
            'email' => 'manager@gmail.com',
            'email_verified_at' => now(),
            'password' => $pass,
            'remember_token' => Str::random(10),
        ]);

        $client = User::create([
            'name' => 'Client Igor',
            'email' => 'client@gmail.com',
            'email_verified_at' => now(),
            'password' => $pass,
            'remember_token' => Str::random(10),
        ]);

        $manager->assignRole(CustomRoles::ROLE_MANAGER);
        $client->assignRole(CustomRoles::ROLE_CLIENT);

    }
}
