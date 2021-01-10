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
            'foto' => 'default.png',
            'cover'=> 'default.jpg'
        
        ]);

        $user = User::create([
            'name' => 'User',
            'email' => 'user1@informageek.tech',
            'password' => bcrypt('123456'),
            'username' => 'user',
            'role' => 'user',
            'foto' => 'default.png',
            'cover'=> 'default.jpg'

        ]);
        
        $user = User::create([
            'name' => 'User2',
            'email' => 'userp2@informageek.tech',
            'password' => bcrypt('123456'),
            'username' => 'user2',
            'role' => 'user',
            'foto' => 'default.png',
            'cover'=> 'default.jpg'
        ]);

    }
    
}
