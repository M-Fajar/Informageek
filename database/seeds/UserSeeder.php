<?php

use App\User;
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
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@informageek.tech',
            'password' => bcrypt('123456'),
            'username' => 'admin',
            'role' => 'admin'
        
        ]);

        $user = User::create([
            'name' => 'User',
            'email' => 'user@informageek.tech',
            'password' => bcrypt('123456'),
            'username' => 'user',
            'role' => 'user'
        ]);
        
        $user = User::create([
            'name' => 'UserPlus',
            'email' => 'userplus@informageek.tech',
            'password' => bcrypt('123456'),
            'username' => 'userplus',
            'role' => 'userplus'
        ]);

    }
    
}
