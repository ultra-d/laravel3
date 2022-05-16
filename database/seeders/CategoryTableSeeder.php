<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('categories')->insert([
            'id' => 1,
            'name' => 'Home',
            'slug' => 'home-category',
        ]);

        DB::table('categories')->insert([
            'id' => 2,
            'name' => 'Beauty',
            'slug' => 'beauty-category',
        ]);
    }
}
