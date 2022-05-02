<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\View\View;

class CustomerController extends Controller
{
    public function index(): View
    {
        return view('customer.profile', [
            'invoices' => Invoice::latest()->paginate(8),
        ]);
    }
}
