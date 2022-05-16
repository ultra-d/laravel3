<?php

namespace App\Http\Controllers\Admin;

use App\Actions\ExportProductAction;
use App\Actions\ImportProductAction;
use App\Actions\StoreUpdateProductImagesAction;
use App\Actions\UpdateProductAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ExportProductRequest;
use App\Http\Requests\Product\SaveProductRequest;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(): View
    {
        if (request()->page) {
            $key = 'products' . request()->page;
        } else {
            $key = 'products';
        }

        if (Cache::has($key)) {
            $products = Cache::get($key);
        } else {
            $products = Product::withCount('invoices')->latest()->paginate(8);
            Cache::put($key, $products);
        }

        return view('admin.products.index', [
            'products' => $products,
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

        Cache::flush();

        Log::channel('custom')->info('Product Created by ' . auth()->user());

        return redirect()->route('admin.products.index')->with('status', trans('messages.success.product_created'));
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

        Cache::flush();

        return redirect()->route('admin.products.show', $product)
        ->with('status', trans('messages.success.product_updated'));
    }

    public function destroy(Product $product): RedirectResponse
    {
        if ($product->loadCount('invoices') !== 0) {
            return redirect()->route('admin.products.index')->with('message', $product->title . ' ' .
                trans('messages.alert.cannotdelete'));
        } else {
            Storage::disk('image')->deleteDirectory($product->id);
            $product->delete();

            Cache::flush();
            Log::channel('custom')->info('Product Deleted by ' . auth()->user());

            return redirect()->route('admin.products.index')->with('status', trans('messages.success.product_deleted'));
        }
    }

    public function export(ExportProductRequest $request, ExportProductAction $action): RedirectResponse
    {
        $action->execute($request);

        return back()->withSuccess(trans('messages.export.message'));
    }

    public function import(Request $request, ImportProductAction $action)
    {
        $action->execute($request);

        return back()->with('message', trans('messages.import.message'));
    }
}
