<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class CreateUsersSeeder extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {
        $user = [
            [
                'name' => 'Admin',
                'email' => 'admin@mercatodo.com',
                'password' => bcrypt('password'),
            ],
            [
                'name' => 'User',
                'email' => 'user@mercatodo.com',
                'password' => bcrypt('password'),
            ],
        ];
        
        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
