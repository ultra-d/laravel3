<?php

namespace App\Http\Controllers\Admin;

use App\Actions\StoreUpdateProductImagesAction;
use App\Actions\UpdateProductAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Product\SaveProductRequest;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(): View
    {
        return view('admin.products.index', [
            'products' => Product::latest()->paginate(8),
        ]);
    }

    public function create(): View
    {
        return view('admin.products.create', [
            'product' => new Product(),
            'images' => new Image(),
            'categories' => Category::pluck('name', 'id'),
        ]);
    }

    public function store(SaveProductRequest $request, StoreUpdateProductImagesAction $imagesAction): RedirectResponse
    {
        $product = new Product($request->validated());

        $product->slug = Str::slug($request->input('title'));

        $product->save();

        $imagesAction->execute($request->images, $product);

        return redirect()->route('admin.products.index')->with('status', __('messages.success.product_created'));
    }

    public function show(Product $product): View
    {
        return view('admin.products.show', [
            'product' => $product,
        ]);
    }

    public function edit(Product $product): View
    {
        return view('admin.products.edit', [
            'product' => $product,
            'categories' => Category::pluck('name', 'id'),
        ]);
    }

    public function update(Product $product, SaveProductRequest $request, UpdateProductAction $action, StoreUpdateProductImagesAction $imagesAction): RedirectResponse
    {
        if ($request->hasFile('images')) {
            foreach ($product->images as $image) {
                Storage::delete($image->url());
            }

            $imagesAction->execute($request->images, $product);
        }

        $action->execute($product, $request);

        return redirect()->route('admin.products.show', $product)
        ->with('status', __('messages.success.product_updated'));
    }

    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();

        return redirect()->route('admin.products.index')->with('status', __('messages.success.product_deleted'));
    }
}
