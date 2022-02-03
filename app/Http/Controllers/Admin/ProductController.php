<?php

namespace App\Http\Controllers\Admin;

//use DB;
use App\Models\Product;
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
            'product' => new Product
        ]);
    }

    public function store(SaveProductRequest $request): RedirectResponse
    {
        $product = new Product($request->validated());

        $product->url = Str::slug($request->input('title'));

        dd($product->image = $request->file('image')->store('images'));

        $product->save();
        
        return redirect()->route('admin.products.index')->with('status', 'El producto fue creado con exito.');
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
            'product' => $product
        ]);
    }

    public function update(Product $product, SaveProductRequest $request): RedirectResponse
    {
        if ($request->hasFile('image')) {
            Storage::delete($product->image);

            $product->image = $request->file('image')->store('images');
        }
        $product->code = $request->input('code');
        $product->title = $request->input('title');
        $product->url = Str::slug($request->input('title'));
        $product->price = $request->input('price');
        $product->quantity = $request->input('quantity');
        $product->description = $request->input('description');
        $product->status = $request->has('disable') ? 0 : 1;
        $product->save();

        return redirect()->route('admin.products.show', $product)->with('status', 'El producto fue actualizado con exito.');
    }

    public function destroy(Product $product): RedirectResponse
    {
        Storage::delete($product->image);
        
        $product->delete();

        return redirect()->route('admin.products.index')->with('status', 'El producto fue eliminado con exito.');
    }
}
