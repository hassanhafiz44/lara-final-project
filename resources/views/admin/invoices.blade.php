@extends('layouts.app')

@section('content')
<div ng-app="invoiceApp" ng-controller="InvoicesCtrl">
   <div class="container">
      <form action="{{ route('admin.invoices.index') }}" method="get">
         <div class="row">
            <div class="form-group col-sm-4 col-md-4">
               <select name="customer_id" id="customer-id-filter" class="form-control" ng-model="customerIdFilter">
                  <option value="">Select Customer</option>
                  @foreach ($customers_dropdown_data as $item)
                  <option value="{{ $item->id }}">{{ $item->name }} - {{ $item->email }}</option>
                  @endforeach
               </select>
            </div>
            <div class="form-group col-sm-4 col-md-4">
               <select name="payment_status" id="payment-status-filter" class="form-control" ng-model="paymentStatusFilter">
                  <option value="">Select Payment Status</option>
                  <option value="paid">Paid</option>
                  <option value="due">Due</option>
               </select>
            </div>
            <div class="form-group col-sm-4 col-md-4">
               <select name="invoice_status" id="invoice-status-filter" class="form-control" ng-model="invoiceStatusFilter">
                  <option value="">Select Invoice Status</option>
                  <option value="processing">Processing</option>
                  <option value="ready">Ready</option>
                  <option value="delivered">Delivered</option>
                  <option value="canceled">Canceled</option>
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
      <div class="table-responsive">
         <table id="invoices-table" class="table table-striped">
            <thead>
               <tr>
                  <!-- <th>Product</th> -->
                  <td>SN</td>
                  <th>Customer</th>
                  <th>Retail Price</th>
                  <th>Payment Status</th>
                  <th>Invoice Status</th>
                  <th>Inovoice Date</th>
                  <th></th>
               </tr>
            </thead>
            <tbody>
               @foreach($invoices as $key => $invoice)
               <tr data-id="{{ $invoice->id }}">
                  <td>{{ $key + 1 }}</td>
                  <td>{{ $invoice->customer->name }}</td>
                  <td>{{ $invoice->retail_price_total }}</td>
                  <td>
                     <select data-id="{{ $invoice->id }}" data-value="{{ $invoice->payment_status }}"name="payment_status" id="payment-status-{{ $invoice->id }}" class="form-control form-control-sm payment-status">
                        <option {{ $invoice->payment_status === 'paid' ? "selected" : ""}} value="paid">Paid</option>
                        <option {{ $invoice->payment_status === 'due' ? "selected" : ""}} value="due">Due</option>
                     </select>
                  </td>
                  <td>
                     <select name="invoice_status" data-value="{{$invoice->invoice_status }}" id="invoice-status-{{ $invoice->id }}" class="form-control form-control-sm invoice-status">
                        <option {{ ($invoice->invoice_status === 'ready') ? "selected" : "" }} value="ready">Ready</option>
                        <option {{ ($invoice->invoice_status === 'processing') ? "selected" : "" }} value="processing">Processing</option>
                        <option {!! ($invoice->payment_status !== 'paid') ? "style='display: none;'" : "" !!} {{ ($invoice->invoice_status === 'delivered') ? "selected" : "" }} value="delivered">Delivered</option>
                        <option {!! ($invoice->payment_status === 'paid') ? "style='display: none;'": ""!!} {{ ($invoice->invoice_status === 'canceled') ? "selected" : "" }} value="canceled">Canceled</option>
                     </select>
                  </td>
                  <td>{{ $invoice->created_at }}</td>
                  <td>
                     {{-- <a class="btn btn-sm btn-secondary" href="{{ route('admin.invoices.edit', $invoice->id) }}"><i class="fa fa-edit"></i></a> --}}
                     <a class="btn btn-sm btn-warning" href="{{ route('admin.invoices.show', $invoice->id) }}"><i class="fa fa-eye"></i></a>
                     <!-- <button class="btn btn-sm btn-danger delete-product"><i class="fa fa-trash"></i></button> -->
                  </td>
               </tr>
               @endforeach
            </tbody>
         </table>
      </div>
		{{$invoices->withQueryString()->links()}}
   </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/angular.min.js') }}"></script>
<script>
   const invoiceApp = angular.module('invoiceApp', []);
   invoiceApp.controller('InvoicesCtrl', function($scope) {
      $scope.customerIdFilter = '{{ $customer_id }}';
      $scope.paymentStatusFilter = '{{ $payment_status }}';
      $scope.invoiceStatusFilter = '{{ $invoice_status }}';
      $scope.startDateFilter = new Date('{{ $start_date }}');
      $scope.endDateFilter = new Date('{{ $end_date }}');
   });
   $(function() {
      const _token = "{{ csrf_token() }}";

      $("#invoices-table").on("change", ".payment-status", function(event) {
         const selectedElem = $(this);
         const url = "{{ route('admin.invoice.change.payment.status') }}";
         const invoiceId = $(this).closest('tr').data("id");
         const oldPaymentStatus = $(this).data('value');
         const paymentStatus = $(this).val();
         $('body').LoadingOverlay("show");
         $.ajax({
            method: "POST",
            url: url,
            data: {
               invoice_id: invoiceId,
               payment_status: paymentStatus,
               _token: _token,
            },
            success: function(response) {
               if(response.payment_status === 'paid') {
                  $("#invoice-status-" + invoiceId).find('option[value="canceled"]').hide();
                  $("#invoice-status-" + invoiceId).find('option[value="delivered"]').show();
               } else {
                  $("#invoice-status-" + invoiceId).find('option[value="canceled"]').show();
                  $("#invoice-status-" + invoiceId).find('option[value="delivered"]').hide();
               }
            },
            error: function(error) {
               selectedElem.find('option[value="' + oldPaymentStatus + '"]').prop('selected', true);
            },
            complete: function() {
               $('body').LoadingOverlay("hide");
            }
         });
      });

      $("#invoices-table").on("change", ".invoice-status", function(event) {
         const selectedElem = $(this);
         const url = "{{ route('admin.invoice.change.invoice.status') }}";
         const invoiceId = $(this).closest('tr').data("id");
         const oldInvoiceStatus = $(this).data('value');
         const invoiceStatus = $(this).val();
         $("body").LoadingOverlay('show');
         $.ajax({
            method: "POST",
            url: url,
            data: {
               invoice_id: invoiceId,
               invoice_status: invoiceStatus,
               _token: _token,
            },
            success: function(response) {
               selectedElem.data('value', response.invoice_status);
            },
            error: function(error) {
               selectedElem.find('option[value="' + oldInvoiceStatus + '"]').prop('selected', true);
            },
            complete: function() {
               $("body").LoadingOverlay("hide");
            }
         });
      });
   });
</script>
@endsection