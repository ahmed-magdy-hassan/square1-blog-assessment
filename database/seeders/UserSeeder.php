<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminUser = User::create([
            'name' => 'Admin',
            'email' => 'admin@square1.com',
            'password' => bcrypt('password'),
            'role' => User::ROLE_ADMIN
        ]);
    }
}
