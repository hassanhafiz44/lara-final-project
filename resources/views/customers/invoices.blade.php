@extends('layouts.app')

@section('content')
<div>
    <div class="container">
        <a href="{{ route('pages.products') }}" class="float-right btn btn-primary btn-sm">Add</a>
        <table id="invoices-table" class="table table-striped">
            <thead>
                <tr>
                    <!-- <th>Product</th> -->
                    <th>Retail Price</th>
                    <th>Payment Status</th>
                    <th>Invoice Status</th>
                    <!-- <th>Quantity</th> -->
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($invoices as $invoice)
                <tr data-iid="{{ $invoice->id }}">
                    <td>{{ $invoice->retail_price_total }}</td>
                    <td>{{ $invoice->payment_status }}</td>
                    <td>{{ $invoice->invoice_status }}</td>
                    <!-- <td>{{ $invoice->quantity }}</td> -->
                    <td>
                        <a class="btn btn-sm btn-secondary" href="{{ route('pages.invoices.edit', $invoice->id) }}"><i class="fa fa-edit"></i></a>
                        <a class="btn btn-sm btn-warning" href="{{ route('pages.invoices.show', $invoice->id) }}"><i class="fa fa-eye"></i></a>
                        <!-- <button class="btn btn-sm btn-danger delete-product"><i class="fa fa-trash"></i></button> -->
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


@endsection

@section('scripts')
<script>
    $(function() {
        $("#invoices-table").DataTable();
    });
</script>
<!-- <script src="{{ asset('js/products/products.js')}}"></script> -->
@endsection