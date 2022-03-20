<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\Facades\Cart;

class SearchController extends Controller
{
    public function index(): View
    {
        $cart = Cart::content();
        return view('landing-menu', [
            'products' => Product::latest()->with('category')->paginate(8),
            'categories' => Category::pluck('id', 'name'),
            $cart
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
            'categories' => Category::pluck('id', 'name')
        ]);
    }
}
