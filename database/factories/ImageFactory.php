<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\Factory;

class ImageFactory extends Factory
{
    public function definition()
    {
        $product = Product::factory()->create();
        $image = $this->faker->image();
        $fileName = Str::random(32) . '.png';
        $path = $product->id . '/' . $fileName;
        Storage::disk('image')->put($path, fopen($image, 'r'));
       
        return [
            'product_id' => $product->id,
            'file_name' => $fileName,
        ];
    }
}
