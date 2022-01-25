<?php

namespace App\Http\Controllers;

//use DB;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\SaveProductRequest;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('products.index', [
            'products' => Product::latest()->paginate()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create', [
            'product' => new Product
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveProductRequest $request)
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
    public function show(Product $product)
    {
        return view('products.show', [
            'product' => $product
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('products.edit', [
            'product' => $product
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Product $product, SaveProductRequest $request)
    {
        if ($request->hasFile('image')) {
            Storage::delete($product->image);

            $product->fill($request->validated());

            $product->image = $request->file('image')->store('images');

            $product->save();
        } else {
            $product->update(array_filter($request->validated()));
        }

        return redirect()->route('products.show', $product)->with('status', 'El producto fue actualizado con exito.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        Storage::delete($product->image);
        
        $product->delete();

        return redirect()->route('products.index')->with('status', 'El producto fue eliminado con exito.');
    }
}
