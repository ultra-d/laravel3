<?php

namespace App\Actions;

use Illuminate\Database\Eloquent\Model;
use App\Models\Image;
use Illuminate\Support\Str;

class StoreUpdateProductImagesAction
{
    public function execute(array $files, Model $product): void
    {
        $productImages = collect();
        
        foreach ($files as $file) {
            $image = new Image;

            $image->file_name = Str::random(20) . '.' . $file->getClientOriginalExtension();

            $file -> storeAs($product->id, $image->file_name, config('filesystems.images_disk'));

            $image->product_id = $product->id;
           
            $productImages->push($image);
        }

        $product->images()->saveMany($productImages);
    }
}
