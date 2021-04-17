<?php

namespace Database\Seeders;

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
        // Create admin users
        \App\Models\User::create([
            'name' => 'admin',
            'email' => 'admin@earlyaccess.htb',
            'password' => bcrypt(env('ADMIN_PW')),
            'role' => 'admin',
        ]);

        // Test user
        \App\Models\User::create([
                'name' => 'chronos',
                'email' => 'chronos@earlyaccess.htb',
                'password' => bcrypt('chronos'),
        ]);

        // Test user
        \App\Models\User::create([
            'name' => 'dummy',
            'email' => 'dummy@earlyaccess.htb',
            'password' => bcrypt('dummy'),
        ]);
    }
}
