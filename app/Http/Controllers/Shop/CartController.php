<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\User;
use App\Request\CreateSessionRequest;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Illuminate\View\View;

class CartController extends Controller
{
    public function index(): View
    {
        foreach (Cart::content() as $product) {
            if ($product->qty > $product->options->max) {
                echo('There are just ' . $product->options->max . ' of ' . $product->name . ' availables');
                Cart::update($product->rowId, $product->options->max);
            }
        }

        return view('cart-checkout', [
            'cart' => Cart::content(),
            'user' => User::pluck('name'),
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $product = Product::findOrFail($request->input('product_id'));
        $cartItem = Cart::add(
            $product->id,
            $product->title,
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

    public function checkoutSession(Request $request): RedirectResponse
    {
        $invoice = new Invoice();
        $invoice->reference = Str::random(10);
        $invoice->total = Cart::total(2, ".", "");
        $invoice->user_id = auth()->user()->id;
        $invoice->save();

        //pivot table data
        foreach (Cart::content() as $product) {
            $invoice->products()->attach($product->id, [
                'quantity' => $product->qty,
                'price' => $product->price,
                'subtotal' => $product->price * $product->qty,
            ]);
        }

        $data = $request->toArray();
        $data['payment']['total'] = Cart::total(0, ".", "");
        $data['payment']['reference'] = $invoice->reference;
        $data['payment']['redirectUrl'] = route('customer.invoices.show', ['reference' => $invoice->reference]);
        $session = new CreateSessionRequest($data);

        $response = Http::post(CreateSessionRequest::url(), $session->toArray());

        if ($response->ok()) {
            Cart::destroy();
            $responseData = $response->json();
            if (isset($responseData['requestId'])) {
                $invoice->payment_reference = $responseData['requestId'];
                $invoice->payment_url = $responseData['processUrl'];
                $invoice->save();

                return redirect()->away($responseData['processUrl']);
            }
        }

        return redirect()->route('shop.cart.index')->with('message', 'algo salió mal');
    }
}
