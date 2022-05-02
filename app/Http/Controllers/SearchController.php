<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SearchController extends Controller
{
    public function index(): View
    {
        $cart = Cart::content();

        return view('landing-menu', [
            'products' => Product::latest()->with('category')->paginate(8),
            'categories' => Category::pluck('id', 'name'),
            $cart,
        ]);
    }

    public function search(Request $request): View
    {
        $request->validate([
            'title' => 'required|min:3|max:120',
        ]);

        $title = $request->input('title');

        $products = Product::orderBy('id', 'DESC')
            ->title($title)
            ->paginate();

        return view('landing-menu', [
            'products' => $products,
            'categories' => Category::pluck('id', 'name'),
        ]);
    }
}
