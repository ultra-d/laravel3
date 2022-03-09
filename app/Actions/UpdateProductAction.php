<?php

namespace App\Actions;

use Illuminate\Database\Eloquent\Model;
use App\Actions\ActionContract;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UpdateProductAction implements ActionContract
{
    public function execute(Model $product, Request $request): Model
    {
        $product->category_id = $request->input('category_id');
        $product->code = $request->input('code');
        $product->title = $request->input('title');
        $product->slug = Str::slug($request->input('title'));
        $product->price = $request->input('price');
        $product->quantity = $request->input('quantity');
        $product->description = $request->input('description');
        $product->status = $request->has('disable') ? 0 : 1;
        $product->save();

        return $product;
    }
}
