<?php

namespace App\Http\Controllers\Shop;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class CartController extends Controller
{
    public function index(): View
    {
        return view('cart-checkout', [
            'cart' => Cart::content(),
            'user' => User::pluck('name')
        ]);
    }
    public function store(Request $request): JsonResponse
    {
        $product = Product::findOrFail($request->input('product_id'));
        $name = $product->title;
        $cartItem = Cart::add(
            $product->id,
            $name,
            $request->input('quantity'),
            $product->price,
            '0',
            ['max' => $product->quantity]
        );
        
        return response()->json(['cartItem' => $cartItem]);
    }

    public function destroy($rowId): RedirectResponse
    {
        Cart::remove($rowId);
        return redirect()->route('shop.cart.index')->with('status', __('messages.success.product_deleted'));
    }
}
