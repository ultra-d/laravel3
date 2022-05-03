<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);
        $this->call(CreateUsersSeeder::class);
        $this->call(RoleUserSeeder::class);
        $this->call(CategoryTableSeeder::class);
        $this->call(ProductSeeder::class);
    }
}
