<?php

namespace App\Http\Controllers\Shop;

use App\Models\Invoice;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use App\Request\CreateSessionRequest;
use Gloudemans\Shoppingcart\Facades\Cart;

class PaymentController extends Controller
{
    public function createSession(Request $request)
    {
        $data = $request->toArray();
        $data['payment']['total'] = Cart::total(0, ".", "");
        $data['payment']['reference'] = Str::random(10);

        $session = new CreateSessionRequest($data);

        $response = Http::post(CreateSessionRequest::url(), $session->toArray());

        if ($response->ok()) {
            $responseData = $response->json();
            if (isset($responseData['requestId'])) {
                return redirect()->away($responseData['processUrl']);
            }
        }
    }
}
