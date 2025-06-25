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
                'email' => 'desirthierry2017@hotmail.com',
                'password' => Hash::make('Qwertyu1234@'),
                'roles' => 'admin',
                'first_name' => 'Thierry',
                'last_name' => 'Desir',
                'phone' => '50940281374',
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}