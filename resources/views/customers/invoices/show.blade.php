@extends('layouts.app')

@section('content')
<div ng-app="myApp" ng-controller="InvoiceCtrl">
    <div class="invoice-header mb-2">
        <div class="btn-group" role="group" aria-label="Change Statuses">
            <button ng-hide="shouldDisplayUpdate()" class="btn btn-primary btn-sm mr-2" data-toggle="modal" data-target="#invoice-statuses-modal">{{ __('labels.update_invoice') }}</button>
            <button ng-show="shouldDisplayCancelled()" disabled class="btn btn-danger btn-sm mr-2">{{ __('labels.invoice_cancelled') }}</button>
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
                            <td><b>{{ __('labels.name') }}:</b></td>
                            <td>{{ ucwords($customer->name) }}</td>
                        </tr>
                        <tr>
                            <td><b>{{ __('labels.email') }}:</b></td>
                            <td>{{$customer->email}}</td>
                        </tr>
                        <tr>
                            <td><b>{{ __('labels.phone') }}:</b></td>
                            <td>{{$customer->phone}}</td>
                        </tr>
                        <tr>
                            <td><b>{{ __('labels.address') }}:</b></td>
                            <td>{{ ucwords($customer->address) }}</td>
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
                        <th class="text-right">{{ __('labels.serial_no_short') }}</th>
                        <th class="text-right">{{ __('labels.image') }}</th>
                        <th class="text-right">{{ __('labels.product_name') }}</th>
                        <th class="text-right">{{ __('labels.model') }}</th>
                        <th class="text-right">{{ __('labels.quantity') }}</th>
                        <th class="text-right">{{ __('labels.retail_price') }}</th>
                        <th class="text-right">{{ __('labels.total_retail_price') }}</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- $invoice->products refers to an array on invoice_products --}}
                    {{-- each of those invoice_products->product refers to original product --}}
                    {{-- which is used to get title, model and image --}}
                    @foreach($invoice->products as $key => $product)
                    <tr>
                        <td class="text-right">{{ $key + 1 }}</td>
                        <td class="text-right"><img width="100px" height="100px" src="{{ asset('storage/product_images/' . $product->product->image_url) }}"></td>
                        <td class="text-right">{{ ucwords($product->product->title) }}</td>
                        <td class="text-right">{{ $product->product->model }}</td>
                        <td class="text-right">{{ $product->quantity }}</td>
                        <td class="text-right">{{ number_format($product->retail_price, 2) }}</td>
                        <td class="text-right">{{ number_format(($product->retail_price * $product->quantity), 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4" class="text-right"><b>{{ __('labels.grand_total') }}</b></td>
                        <td class="text-right"><b>{{ $total_quantity }}</b></td>
                        <td class="text-right"><b>{{ convert_to_currency($total_retail_price) }}</b></td>
                        <td class="text-right"><b>{{ convert_to_currency($invoice->retail_price_total) }}</b></td>
                    <tr>
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
                            <td><b>{{ __('labels.payment_status') }}</b></td>
                            <td class="text-capitalize"><%= payment_status %></td>
                        </tr>
                        <tr>
                            <td><b>{{ __('labels.invoice_status') }}</b></td>
                            <td class="text-capitalize"><%= invoice_status %></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @include('includes.customers.invoiceStatusModal', ['invoice' => $invoice])

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
        $scope.cancelled_by = '{{ $invoice->cancelled_by }}';

        
        $scope.invoice_status_input = ($scope.invoice_status === 'canceled') ? 'canceled' : '';

        $scope.shouldDisplayUpdate = function () 
        {
            if($scope.invoice_status === 'canceled')
                return true;

            if($scope.payment_status === 'paid')
                return true
        }

        $scope.shouldDisplayCancelled = function()
        {
            return ($scope.invoice_status === 'canceled') ? true : false;
        }


        $scope.onStatusChangeSubmit = function() {
            const data = {
                invoice_id: invoiceId,
                invoice_status: $scope.invoice_status_input,
                _token: _token,
            };

			$("body").LoadingOverlay('show');
            $http.post("{{route('pages.invoices.change.invoice.status') }}", data)
                .then(function(response) {
                    // Set statues
                    $scope.invoice_status = response.data.invoice.invoice_status;
                    $scope.invoice_status_input = $scope.invoice_status;
                    // update UI
                    $scope.shouldDisplayCancelled();
                    $scope.shouldDisplayUpdate();
                    showNotification(response.data.message, 'Success', 'success');
                    $("#invoice-statuses-modal").modal('hide');
                }).catch(function(error) {
                    $scope.invoice_status_input = '';
                    showNotification(error.data.message, 'Error', 'error');
                }).finally(function() {
                    $("body").LoadingOverlay('hide');
                });
        }
    });
</script>
@endsection