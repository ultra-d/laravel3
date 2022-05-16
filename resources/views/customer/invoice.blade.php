@extends('layout')

@section('title', trans('titles.invoice_status'))

@section('content')

<div class="container-xl px-4 mt-4">
    @if($invoice->payment_status == 'APPROVED') 
        <div class="alert alert-success d-flex align-items-center" role="alert">
            <div>
            {{trans('messages.invoice_status.approved')}}
            </div>
        </div>
        @include('partials.invoice-data')
        @include('customer.__button')
        
    @elseif ($invoice->payment_status == 'PENDING')
        <div class="alert alert-warning d-flex align-items-center" role="alert">
            <div>
                {{trans('messages.invoice_status.pending')}}
            </div>
        </div>
        @include('partials.invoice-data')
        @include('customer.__button') 
    @else 
        <div class="alert alert-danger d-flex align-items-center" role="alert">
            <div>
                {{trans('messages.invoice_status.failed')}}
            </div>
        </div>
        @include('partials.invoice-data')
        @include('customer.__button')
    @endif
</div>
@endsection
