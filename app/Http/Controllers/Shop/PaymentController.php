<?php

namespace App\Http\Controllers\Shop;

use App\Models\Invoice;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use App\Request\CreateSessionRequest;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\RedirectResponse;

class PaymentController extends Controller
{
    public function createSession(Request $request): RedirectResponse
    {
        $invoice = new Invoice();
        $invoice->reference = Str::random(10);
        $invoice->total = Cart::total(2, ".", "");
        $invoice->user_id = auth()->user()->id;
        $invoice->save();

        /* pivot table data */
        foreach (Cart::content() as $product) {
            $invoice->products()->attach($product->id, [
                'quantity' => $product->qty,
                'price' => $product->price,
                'subtotal' => $product->price * $product->qty
            ]);
        }
        
        $data = $request->toArray();
        $data['payment']['total'] = Cart::total(0, ".", "");
        $data['payment']['reference'] = $invoice->reference;
        $data['payment']['redirectUrl'] = route('customer.invoices.show', ['reference' => $invoice->reference]);
        $session = new CreateSessionRequest($data);
        //dd($data);
        $response = Http::post(CreateSessionRequest::url(), $session->toArray());
        //dd($response->json());
        
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
