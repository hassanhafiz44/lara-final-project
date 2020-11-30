@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h2>{{ __('labels.stock_in_hand') }}</h2>
    <div class="d-md-flex my-3">
        <div class="card bg-primary text-white w-100 mr-2 mb-2 mb-md-0">
            <div class="card-body">
                <h5 class="card-title">{{ __('labels.quantity') }}</h5>
                <span>{{ $stock_quantity }}</span>
            </div>
        </div>
        <div class="card bg-primary text-white w-100 mr-2 mb-2 mb-md-0">
            <div class="card-body">
                <h5 class="card-title">{{ __('labels.price') }}</h5>
                <span>{{ convert_to_currency($stock_worth) }}</span>
            </div>
        </div>
        <div class="card bg-primary text-white w-100 mr-2 mb-2 mb-md-0">
            <div class="card-body">
                <h5 class="card-title">{{ __('labels.retail') }}</h5>
                <span>{{ convert_to_currency($stock_retail_worth) }}</span>
            </div>
        </div>
        <div class="card bg-primary text-white w-100 mb-2 mb-md-0">
            <div class="card-body">
                <h5 class="card-title">{{ __('labels.profit') }}</h5>
                <span>{{ convert_to_currency($stock_profit) }}</span>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table id="products-table" class="table table-striped">
            <thead>
                <tr>
                    <th>@lang('labels.serial_no_short')</th>
                    <th>@lang('labels.image')</th>
                    <th>@lang('labels.title')</th>
                    <th>@lang('labels.category')</th>
                    <th>@lang('labels.model')</th>
                    <th>@lang('labels.price')</th>
                    <th>@lang('labels.retail_price')</th>
                    <th>@lang('labels.quantity')</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @if (count($products) === 0)
                    <tr>
                        <td colspan="8">@lang('messages.no_records_found')</td>
                    </tr>
                @endif
                @foreach($products as $key => $product)
                <tr data-pid="{{ $product->id }}">
                    <td>{{ $key + 1}}</td>
                    <td><img width="100px" height="100px" src="{{ asset('storage/product_images/' . $product->image_url) }}"></td>
                    <td>{{ ucwords($product->title) }}</td>
                    <td>{{ ucwords($product->category->title) }}</td>
                    <td>{{ $product->model }}</td>
                    <td>{{ convert_to_currency($product->price) }}</td>
                    <td>{{ convert_to_currency($product->retail_price) }}</td>
                    <td>{{ $product->quantity }}</td>
                    <td>
                        <a class="btn btn-sm btn-secondary" href="{{ route('admin.products.edit', $product->id) }}"><i class="fa fa-edit"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{$products->withQueryString()->links()}}
</div>
@endsection