@extends('layout')

@section('title', 'invoice')

@section('content')
<div class="container-xl px-4 mt-4"> 
    <!-- Billing history card-->
    <div class="card mb-4">
        <div class="card-header">Billing History</div>
        <div class="card-body p-0">
            <!-- Billing history table-->
            <div class="table-responsive table-billing-history">
                <table class="table mb-0" aria-describedby="billingtable">
                    <thead>
                        <tr>
                            <th class="border-gray-200" scope="col">Transaction ID</th>
                            <th class="border-gray-200" scope="col">Date</th>
                            <th class="border-gray-200" scope="col">Amount</th>
                            <th class="border-gray-200" scope="col">Url</th>
                            <th class="border-gray-200" scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($invoices as $invoice)
                            <tr>
                                <td>{{ Str::upper($invoice->reference) }}</td>
                                <td>{{ $invoice->created_at->format('d-m-Y')}}</td>
                                <td>${{ $invoice->total }}</td>
                                <td>{{ $invoice->payment_url }}</td>
                                <td>
                                    @if ($invoice->payment_status == 'APPROVED')
                                        <button class="btn btn-success btn-sm">
                                            <span>
                                                {{ $invoice->payment_status}}
                                            </span>
                                        </button>
                                    @elseif ($invoice->payment_status == 'PENDING')
                                        <form action="{{ $invoice->payment_url }}">
                                            <button type="submit" 
                                            class="btn btn-warning btn-sm"
                                            value="{{ $invoice->payment_status}}">
                                            {{ $invoice->payment_status}}
                                            </button>
                                        </form>
                                    @else
                                        <form action="{{ $invoice->payment_url }}">
                                            <button type="submit" 
                                            class="btn btn-danger btn-sm"
                                            value="{{ $invoice->payment_status}}">
                                            {{ $invoice->payment_status}}
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table> 
            </div>
        </div>
    </div>
</div>
@endsection
