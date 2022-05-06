@extends('layout')

@section('title', 'Customer Profile')

@section('content')

<div class="container-xl px-4 mt-4">
    @if($invoice->payment_status == 'APPROVED')
    @include('partials.invoice-data')    
        <div class="alert alert-success d-flex align-items-center" role="alert">
            <div>
            Su transacción fue realizada con éxito
            </div>
        </div>       
        <td><a href="{{ url('/profile')}}" class="viewPopLink btn btn-default1" 
            role="button" 
            data-toggle="modal" 
            data-target="#myModal">
            ir a mi perfil
            <a>
        </td>

    @elseif ($invoice->payment_status == 'PENDING')
        <div class="alert alert-warning d-flex align-items-center" role="alert">
            <div>
            Alerta: tu transacción quedó pendiente.
            </div>
        </div>
        <td><a href="{{ url('/profile')}}" class="viewPopLink btn btn-default1" 
            role="button" 
            data-toggle="modal" 
            data-target="#myModal">
            ir a mi perfil
            <a>
        </td> 
    @else 
        <div class="alert alert-danger d-flex align-items-center" role="alert">
            <div>
            Tu pago no pudo ser completado.
            </div>
        </div>
        <td><a href="{{ url('/profile')}}" class="viewPopLink btn btn-default1" 
            role="button" 
            data-toggle="modal" 
            data-target="#myModal">
            ir a mi perfil
            <a>
        </td>
        
    @endif
</div>
@endsection
