@extends('layouts.app')

@section('content')
<div ng-app="invoiceApp" ng-controller="InvoicesCtrl">
    <form action="{{ route('pages.invoices.index') }}" method="get">
        <div class="row">
            <div class="form-group col-sm-4 col-md-4">
                <select name="payment_status" id="payment-status-filter" class="form-control" ng-model="paymentStatusFilter">
                    <option value="">@lang('labels.payment_status')</option>
                    <option value="paid">@lang('labels.paid')</option>
                    <option value="due">@lang('labels.due')</option>
                </select>
            </div>
            <div class="form-group col-sm-4 col-md-4">
                <select name="invoice_status" id="invoice-status-filter" class="form-control" ng-model="invoiceStatusFilter">
                    <option value="">@lang('labels.invoice_status')</option>
                    <option value="processing">@lang('labels.processing')</option>
                    <option value="ready">@lang('labels.ready')</option>
                    <option value="delivered">@lang('labels.delivered')</option>
                    <option value="canceled">@lang('labels.cancelled')</option>
                </select>
            </div>
            <div class="form-group col-sm-4 col-md-4">
                <input type="date" class="form-control" name="start_date" id="start-date" ng-model="startDateFilter">
            </div>
            <div class="form-group col-sm-4 col-md-4">
                <input type="date" class="form-control" name="end_date" id="end-date" ng-model="endDateFilter">
            </div>
            <div class="form-group col-sm-2">
                <button class="btn btn-success btn-block" type="submit"><i class="fa fa-filter"></i></button>
            </div>
        </div>
    </form>
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
            @if(count($invoices) === 0)
            <tr>
                <td colspan="5">{{ __('messages.no_records_found') }}</td>
            </tr>
            @endif
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

@section('scripts')
<script src="{{ asset('js/angular.min.js') }}"></script>
<script>
   const invoiceApp = angular.module('invoiceApp', []);
   invoiceApp.controller('InvoicesCtrl', function($scope) {
      $scope.paymentStatusFilter = '{{ $payment_status }}';
      $scope.invoiceStatusFilter = '{{ $invoice_status }}';
      $scope.startDateFilter = new Date('{{ $start_date }}');
      $scope.endDateFilter = new Date('{{ $end_date }}');
   });
</script>
@endsection