@extends('layout')

@section('title', trans('titles.invoices_summary'))

@section('content')
<div class="container-xl px-4 mt-4"> 
    <div class="card mb-4">
        <div class="card-header">{{trans('titles.billing_history')}}</div>
        <div class="card-body p-0">
            <div class="table-responsive table-billing-history">
                <table class="table mb-0" aria-describedby="billingtable">
                    <thead>
                        <tr>
                            <th class="border-gray-200" scope="col">{{trans('form.invoice.Transaction ID')}}</th>
                            <th class="border-gray-200" scope="col">{{trans('form.invoice.date')}}</th>
                            <th class="border-gray-200" scope="col">{{trans('form.invoice.total')}}</th>
                            <th class="border-gray-200" scope="col">{{trans('form.invoice.status')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($invoices as $invoice)
                            <tr>
                                <td>{{ Str::upper($invoice->reference) }}</td>
                                <td>{{ $invoice->created_at->format('d-m-Y')}}</td>
                                <td>${{ $invoice->total }}</td>
                                <td>
                                    @if ($invoice->payment_status == 'APPROVED')
                                        <form action="{{route('customer.invoices.pdf', ['reference' => $invoice->reference])}}">
                                            <button class="btn btn-success btn-sm">
                                                <span>
                                                    {{ $invoice->payment_status}}
                                                </span>
                                            </button>
                                        </form>
                                    @elseif ($invoice->payment_status == 'PENDING')
                                        <form action="{{route('customer.invoices.show', ['reference' => $invoice->reference])}}">
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
