<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'code' => Str::random(10),
            'category_id' => random_int(1, 2),
            'title' => $title = $this->faker->words(2, true),
            'price' => $this->faker->randomDigitNotZero(),
            'slug' => Str::slug($title),
            'quantity' => $this->faker->randomDigitNotZero(),
            'description' => $this->faker->words(5, true),
        ];
    }

    public function enabled()
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => true,
            ];
        });
    }
}
