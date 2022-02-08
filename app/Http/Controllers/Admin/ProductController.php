<?php

namespace App\Http\Controllers\Admin;

//use DB;
use App\Models\Product;
use App\Models\Category;
use App\Actions\UpdateProductAction;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Http\Requests\Product\SaveProductRequest;
use Illuminate\Support\Str;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    public function index(): View
    {
        return view('admin.products.index', [
            'products' => Product::latest()->paginate(8)
        ]);
    }

    public function create(): View
    {
        return view('admin.products.create', [
            'product' => new Product,
            'categories' => Category::pluck('name', 'id')
        ]);
    }

    public function store(SaveProductRequest $request): RedirectResponse
    {
        $product = new Product($request->validated());

        $product->url = Str::slug($request->input('title'));

        $product->image = $request->file('image')->store('images');

        $product->save();
        
        return redirect()->route('admin.products.index')->with('status', __('messages.success.product_created'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product): View
    {
        return view('admin.products.show', [
            'product' => $product
        ]);
    }

    public function edit(Product $product): View
    {
        return view('admin.products.edit', [
            'product' => $product,
            'categories' => Category::pluck('name', 'id')
        ]);
    }

    public function update(Product $product, SaveProductRequest $request, UpdateProductAction $action): RedirectResponse
    {
        if ($request->hasFile('image')) {
            Storage::delete($product->image);

            $product->image = $request->file('image')->store('images');
        }
    
        $action->execute($product, $request);

        return redirect()->route('admin.products.show', $product)
        ->with('status', __('messages.success.product_updated'));
    }

    public function destroy(Product $product): RedirectResponse
    {
        Storage::delete($product->image);
        
        $product->delete();

        return redirect()->route('admin.products.index')->with('status', __('messages.success.product_deleted'));
    }
}
