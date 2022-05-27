<?php

namespace Database\Seeders;

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
        User::create([
            'name' => 'admin',
            'email' => 'khludev@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$QJpfNKBkWfLA8bol1SbIb.lHFbFZKq0UruWPDL50i0Ibjj4HAVbAK', // password
            'remember_token' => Str::random(10),
        ]);
    }
}
