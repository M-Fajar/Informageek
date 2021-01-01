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
            'role' => 'admin',
            'foto' => 'admin.png',
            'cover'=> 'admin.png'
        
        ]);

        $user = User::create([
            'name' => 'User',
            'email' => 'user@informageek.tech',
            'password' => bcrypt('123456'),
            'username' => 'user',
            'role' => 'user.png',
            'foto' => 'user.png',
            'cover'=> 'user.png'

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
