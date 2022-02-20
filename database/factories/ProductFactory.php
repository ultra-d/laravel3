<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            //'image' => UploadedFile::fake()->image('public/storage/product.jpg', 500, 250)->size(50),
            'image' => $this->faker->imageUrl($width = 500, $height = 400),
            'code' => Str::random(10),
            'title' => $title = $this->faker->words(2, true),
            'price' => $this->faker->randomDigitNotZero(),
            'slug' => Str::slug($title),
            'quantity' => $this->faker->randomDigitNotZero(),
            'description' => $this->faker->words(5, true),
            'status' => true,
        ];
    }
}
