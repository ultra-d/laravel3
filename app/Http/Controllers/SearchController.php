<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(): View
    {
        return view('landing-menu', [
            'products' => Product::latest()->paginate(8)
        ]);
    }

    public function search(Request $request): View
    {
        $request->validate([
            'query' => 'required|min:3|max:120'
        ]);
        $query = $request->input('query');
        
        $products = Product::where('title', 'like', "%$query%")
            ->orWhere('description', 'like', "%$query%")
            ->with('category')
            ->paginate();

        return view('landing-menu')->with('products', $products);
    }
}
