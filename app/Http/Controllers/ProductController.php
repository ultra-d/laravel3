<?php

namespace App\Http\Controllers;

//use DB;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\SaveProductRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    public function index(): View    
    {
        return view('products.index', [
            'products' => Product::latest()->paginate(8)
        ]);
    }

    public function create(): View
    {
        return view('products.create', [
            'product' => new Product
        ]);
    }

    public function store(SaveProductRequest $request): RedirectResponse
    {
        $product = new Product($request->validated());

        $product->image = $request->file('image')->store('images');

        $product->save();
        
        return redirect()->route('products.index')->with('status', 'El producto fue creado con exito.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product): View
    {
        return view('products.show', [
            'product' => $product
        ]);
    }

    public function edit(Product $product): View
    {
        return view('products.edit', [
            'product' => $product
        ]);
    }

    public function update(Product $product, SaveProductRequest $request): RedirectResponse
    {
        if ($request->hasFile('image')) {
            Storage::delete($product->image);

            $product->status = $request->has('disable') ? 0 : 1;

            $product->fill($request->validated());

            $product->image = $request->file('image')->store('images');

            $product->save();
        } else {
            $product->status = $request->has('disable') ? 0 : 1;
            $product->update(array_filter($request->validated()));
        }

        return redirect()->route('products.show', $product)->with('status', 'El producto fue actualizado con exito.');
    }

    public function destroy(Product $product): RedirectResponse
    {
        Storage::delete($product->image);
        
        $product->delete();

        return redirect()->route('products.index')->with('status', 'El producto fue eliminado con exito.');
    }
}
