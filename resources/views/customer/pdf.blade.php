<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <title>{{ $invoice->reference }}</title>
    
    <style type="text/css">
        * {
            font-family: Verdana, Arial, sans-serif;
        }
        table{
            font-size: x-small;
        }
        tfoot tr td{
            font-weight: bold;
            font-size: x-small;
        }
        .gray {
            background-color: lightgray
        }
    </style>
    
</head>
<body>
    
    <h1>{{ Str::upper($invoice->reference) }}</h1>
    
    <table width="100%" aria-describedby="mypdfinvoice">
        <thead class="mb-3"  style="background-color: lightgray;">
            <tr>
                <th scope="col">{{ trans('form.products.name')}}</th>
                <th scope="col">{{ trans('form.products.price')}}</th>
                <th scope="col">{{ trans('form.products.short_qty')}}</th>
                <th scope="col">{{ trans('form.products.total')}}</th>
            </tr>
        </thead>
        <hr>
        <tbody>
            @foreach ($invoice->products as $product)
            <tr>
                <th scope="row">{{ $product->title }}</th>
                <td>{{ $product->pivot->price }}</td>
                <td>{{ $product->pivot->quantity }}</td>
                <td>{{ $product->pivot->price * $product->pivot->quantity }}</td>
            </tr> 
            @endforeach
            <td>--</td>
            <td>--</td>
            <td>{{ trans('form.products.total')}} -> </td>
            <td>{{ $invoice->total}}</td>
            
        </tbody>
    </table>
    
</body>
