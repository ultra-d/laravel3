<?php

namespace App\Http\Controllers\Customer;

use App\Models\Invoice;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Actions\GetInvoiceInformation;

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

    public function index(): View
    {
        return view('customer.summary', [
            'invoices' => Invoice::latest()->paginate(8),
        ]);
    }

    public function pdf(string $reference)
    {
        $invoice = Invoice::where('reference', $reference)
            ->where('user_id', auth()->id())
            ->with('products')
            ->first();
   
        $pdf = PDF::loadView('customer.pdf', ['invoice' => $invoice]);

        return $pdf->stream();
    }
}
