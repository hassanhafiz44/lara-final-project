@extends('layouts.app')

@section('content')
<div class="container">
	<div class="d-flex justify-content-between align-items-center">
		<h1 class="text-center">{{ __('labels.invoices') }}</h1>
        <a href="{{ route('pages.products') }}" class="btn btn-primary btn-sm">Add</a>
	</div>
    <table id="invoices-table" class="table table-striped">
        <thead>
            <tr>
                <!-- <th>Product</th> -->
                <th>{{ __('labels.serial_no_short')}}</th>
                <th>{{ __('labels.retail_price')}}</th>
                <th>{{ __('labels.payment_status')}}</th>
                <th>{{ __('labels.invoice_status')}}</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($invoices as $key => $invoice)
            <tr data-id="{{ $invoice->id }}">
                <td>{{ $key + 1 }}</td>
                <td>{{ convert_to_currency($invoice->retail_price_total) }}</td>
                <td class="text-capitalize">{{ $invoice->payment_status }}</td>
                <td class="text-capitalize">{{ $invoice->invoice_status }}</td>
                <td>
                    {{-- <a class="btn btn-sm btn-secondary" href="{{ route('pages.invoices.edit', $invoice->id) }}"><i class="fa fa-edit"></i></a> --}}
                    <a class="btn btn-sm btn-warning" href="{{ route('pages.invoices.show', $invoice->id) }}"><i class="fa fa-eye"></i></a>
                    <!-- <button class="btn btn-sm btn-danger delete-product"><i class="fa fa-trash"></i></button> -->
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $invoices->withQueryString()->links() }}
</div>
@endsection