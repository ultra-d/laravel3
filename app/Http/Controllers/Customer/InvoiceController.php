<?php

namespace App\Http\Controllers\Customer;

use App\Actions\GetInvoiceInformation;
use App\Models\Invoice;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use App\Request\GetInformationRequest;
use Gloudemans\Shoppingcart\Facades\Cart;

class InvoiceController extends Controller
{
    public function show(string $reference, GetInvoiceInformation $invoiceConnect): View
    {
        $invoice = Invoice::where('reference', $reference)
            ->where('user_id', auth()->id())
            ->with('products')
            ->first();
        $invoiceConnect->execute($invoice);
        
        return view('customer.invoice')->with(['invoice' => $invoice]);
    }
}
