@extends('layouts.app')

@section('content')
<div ng-app="myApp" ng-controller="InvoiceCtrl">
    <div class="invoice-header mb-2">
        <div class="btn-group" role="group" aria-label="Change Statuses">
            <button ng-disabled="invoice_status === 'delivered' && payment_status === 'paid'" class="btn btn-primary btn-sm mr-2" data-toggle="modal" data-target="#invoice-statuses-modal">Update Invoice</button>
        </div>
    </div>
    <div class="pritable">
        <div class="row">
            <div class="col-sm-6">
                <table>
                    <tbody>
                        @foreach($company as $key => $value)
                        <tr>
                            <td><b>{{ucwords($key)}}:</b></td>
                            <td>{{$value}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-sm-6">
                <table>
                    <tbody>
                        <tr>
                            <td><b>Name:</b></td>
                            <td>{{$customer->name}}</td>
                        </tr>
                        <tr>
                            <td><b>Email:</b></td>
                            <td>{{$customer->email}}</td>
                        </tr>
                        <tr>
                            <td><b>Phone:</b></td>
                            <td>{{$customer->phone}}</td>
                        </tr>
                        <tr>
                            <td><b>Address:</b></td>
                            <td>{{$customer->address}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-sm-6"></div>
        </div>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th class="text-right">SL</th>
                        <th class="text-right">Image</th>
                        <th class="text-right">Product Name</th>
                        <th class="text-right">Model</th>
                        <th class="text-right">Qnty</th>
                        <th class="text-right">Retail Price</th>
                        <th class="text-right">Total Retail Price</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- $invoice->products refers to an array on invoice_products --}}
                    {{-- each of those invoice_products->product refers to original product --}}
                    {{-- which is used to get title, model and image --}}
                    @foreach($invoice->products as $key => $product)
                    <td class="text-right">{{ $key + 1 }}</td>
                    <td class="text-right"><img width="100px" height="100px" src="{{ asset('storage/product_images/' . $product->product->image_url) }}"></td>
                    <td class="text-right">{{ $product->product->title }}</td>
                    <td class="text-right">{{ $product->product->model }}</td>
                    <td class="text-right">{{ $product->quantity }}</td>
                    <td class="text-right">{{ number_format($product->retail_price, 2) }}</td>
                    <td class="text-right">{{ number_format(($product->retail_price * $product->quantity), 2) }}</td>
                    @endforeach
                </tbody>
                <tfoot>
                    <td colspan="4" class="text-right"><b>Grand Total</b></td>
                    <td class="text-right"><b>{{ number_format($total_quantity, 2) }}</b></td>
                    <td class="text-right"><b>{{ number_format($total_retail_price, 2) }}</b></td>
                    <td class="text-right"><b>{{ number_format($grand_retail_price, 2) }}</b></td>
                </tfoot>
            </table>
        </div>
        <div class="row">
            <div class="col-sm-6 col-md-8"></div>
            <div class="col-sm-6 col-md-4" class="text-right">
                <table class="table table-striped table-bordered">
                    <thead></thead>
                    <tbody>
                        <tr>
                            <td><b>Payment Status</b></td>
                            <td><%= payment_status %></td>
                        </tr>
                        <tr>
                            <td><b>ٰInvoice Status</b></td>
                            <td><%= invoice_status %></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @include('includes.invoiceStatusesModal', ['invoice' => $invoice])

</div>
@endsection

@section('scripts')
<script src="{{ asset('js/angular.min.js') }}"></script>
<script>
    const app = angular.module('myApp', []);
	app.config(function($interpolateProvider){
		$interpolateProvider.startSymbol('<%=');
		$interpolateProvider.endSymbol('%>');
	});
    app.controller("InvoiceCtrl", function($scope, $http) {
        const _token = "{{ csrf_token() }}";
        const invoiceId = "{{ $invoice->id }}";
        
        $scope.invoice_status = '{{ $invoice->invoice_status }}';
        $scope.payment_status = '{{ $invoice->payment_status }}';

        $scope.onPaymentStatusChange = function() {
            const data = {
                invoice_id: invoiceId,
                payment_status: $scope.payment_status,
            }
            $http.post("{{ route('admin.invoice.change.payment.status') }}", data).then(function(success) {
                console.log(success);
            }, function(error) {
                $scope.payment_status = error.data.error.payment_status;
            });
        }

        $scope.onInvoiceStatusChange = function() {
            const data = {
                invoice_id: invoiceId,
                invoice_status: $scope.invoice_status,
            }
            $http.post("{{ route('admin.invoice.change.invoice.status') }}", data).then(function(success) {
                console.log(success);

            }, function(error) {
                console.log(error);
            });
        }
    });
</script>
@endsection