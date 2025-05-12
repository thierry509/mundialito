<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'email' => 'desirthierry2015@gmail.com',
                'password' => Hash::make('password'),
                'roles' => 'admin',
                'first_name' => 'Thierry',
                'last_name' => 'Desir',
                'phone' => '509 40281374',
            ],
            [
                'email' => 'editor@example.com',
                'password' => Hash::make('password'),
                'roles' => 'editor',
                'first_name' => 'Editor',
                'last_name' => 'User',
                'phone' => '2345678901',
            ],
            [
                'email' => 'reporter@example.com',
                'password' => Hash::make('password'),
                'roles' => 'reporter',
                'first_name' => 'Reporter',
                'last_name' => 'User',
                'phone' => '3456789012',
            ],
            [
                'email' => 'user1@example.com',
                'password' => Hash::make('password'),
                'roles' => 'user',
                'first_name' => 'Regular',
                'last_name' => 'User',
                'phone' => '4567890123',
            ],
            [
                'email' => 'user2@example.com',
                'password' => Hash::make('password'),
                'roles' => 'user',
                'first_name' => 'Another',
                'last_name' => 'User',
                'phone' => '5678901234',
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}