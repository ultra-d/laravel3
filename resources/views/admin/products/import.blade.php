@extends('layout')

@section('title', trans('titles.import_products'))

@section('content')
<div class="container py-3">
    <div class="row">
        <div class="col-12 col-sm-10 col-lg-6 mx-auto">
            <form id="import" class="bg-white shadow rounded py-3 px-4"
                enctype="multipart/form-data"
                method="POST"
                accept-charset="utf-8"
                action="{{ route('admin.products.import') }}">
                @csrf

                @if (Session::has('message'))
                    <div class="alert alert-success" role="alert">
                        <p>{{ Session::get('message') }}</p>
                    </div>
                @endif

                <div class="row p-2">
                    <h1 class="display-6"> {{trans('titles.import_products')}}</h1>
                    <hr>
                    <div class="form-group row mb-3">
                            <div class="mb-3">
                                <label for="file" class="form-label">{{ trans('form.products.import_file') }}</label>
                                <input name="file" 
                                    class="form-control form-control-sm
                                    @error('file') is-invalid @else border-0
                                    @enderror" 
                                    id="file" 
                                    type="file"
                                    required>
                                    @error('file')
                                        <span>{{$message}}</span>
                                    @enderror
                            </div>
                    </div>
                    <h5 class="mb-4">{{trans('messages.form.import_rules')}}</h5>
                    <table class="table" aria-describedby="mydesc">
                        <thead>
                            <tr>
                            <th scope="col">{{trans('messages.import.field')}}</th>
                            <th scope="col">{{trans('messages.import.requirements')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row"> CATEGORY ID </th>
                                <td>{{trans('messages.import.category_id')}}</td>
                            </tr>
                            <tr>
                                <th scope="row"> CODE </th>
                                <td>{{trans('messages.import.code')}}</td>
                            </tr>
                            <tr>
                                <th scope="row"> TITLE </th>
                                <td>{{trans('messages.import.title')}}</td>
                            </tr>
                            <tr>
                                <th scope="row"> DESCRIPTION </th>
                                <td>{{trans('messages.import.description')}}</td>
                            </tr>
                            <tr>
                                <th scope="row"> SLUG </th>
                                <td>{{trans('messages.import.slug')}}</td>
                            </tr>
                            <tr>
                                <th scope="row"> PRICE </th>
                                <td>{{trans('messages.import.price')}}</td>
                            </tr>
                            <tr>
                                <th scope="row"> QUANTITY </th>
                                <td>{{trans('messages.import.quantity')}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div>
                    <button class="btn btn-primary btn-md w-100"
                    type="submit"
                    id="import_button"
                    form="import">
                    {{ trans('form.products.import') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
