@extends('layout')

@section('title', trans('titles.export_products'))

@section('content')
<div class="container py-3">
    <div class="row">
        <div class="col-12 col-sm-10 col-lg-6 mx-auto">
            <form id="export" class="bg-white shadow rounded py-3 px-4"
                action="{{ route('admin.products.export') }}">
                @csrf
                <div class="row p-2">
                    @if (Session::has('success'))
                        <div class="alert alert-success" role="alert">
                            <p>{{ Session::get('success') }}</p>
                        </div>
                    @endif
                    <h1 class="display-6"> {{ trans('titles.export_products') }}</h1>
                    <hr>
                    <div class="form-group row mb-3">
                        <h5 class="mb-4">{{ trans('form.products.custom_date') }}</h5>
                            <div class="d-flex justify-content-between align-items-center ">
                                <label>{{ trans('form.products.from') }}</label>
                                <input class="border-0 bg-light shadow-sm
                                    @error('dateFrom') is-invalid @else border-0
                                    @enderror"
                                    type="date"
                                    name="dateFrom"
                                    id="dateFrom"/>
                                    @error('dateFrom')
                                        <span class="invalid-feedback" role="alert">
                                            <strong> {{$message}} </strong>
                                        </span>
                                    @enderror
                                <label>{{ trans('form.products.to') }}</label>
                                <input class="border-0 bg-light shadow-sm
                                    @error('dateTo') is-invalid @else border-0
                                    @enderror"
                                    type="date"
                                    name="dateTo"
                                    id="dateTo"/>
                                    @error('dateTo')
                                        <span class="invalid-feedback" role="alert">
                                            <strong> {{$message}} </strong>
                                        </span>
                                    @enderror
                            </div>
                            
                            <div class="d-flex mt-3 justify-content-between align-items-center">
                                <label class="mx-auto">{{ trans('form.products.status') }}</label>
                                <br>
                                <select class="form-control border-0 bg-light shadow-sm ms-3" name="status" 
                                id="status" 
                                aria-label="product_status">
                                <option selected value="status">{{ trans('form.products.enable_disable') }}</option>
                                <option value="1">{{ trans('form.products.enable_status') }}</option>
                                <option value="0">{{ trans('form.products.disable_status') }}</option>
                                </select>
                            </div>
                    </div>
                </div>
                <div>
                    <button class="btn btn-primary btn-md w-100"
                    type="submit"
                    id="export_button"
                    form="export">
                    {{ trans('form.products.export') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
