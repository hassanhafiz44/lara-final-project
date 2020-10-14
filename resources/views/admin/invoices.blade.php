@extends('layouts.app')

@section('content')
<div>
   <div class="container">
      <table id="invoices-table" class="table table-striped">
         <thead>
            <tr>
               <!-- <th>Product</th> -->
               <th>Customer</th>
               <th>Retail Price</th>
               <th>Payment Status</th>
               <th>Invoice Status</th>
               <!-- <th>Quantity</th> -->
               <th></th>
            </tr>
         </thead>
         <tbody>
            @foreach($invoices as $invoice)
            <tr data-id="{{ $invoice->id }}">
               <td>{{ $invoice->customer->name }}</td>
               <td>{{ $invoice->retail_price_total }}</td>
               <!--<td>{{ $invoice->payment_status }}</td>-->
               <!--<td>{{ $invoice->invoice_status }}</td>-->
               <td>
                  <select data-id="{{ $invoice->id }}" name="payment_status" id="payment-status-{{ $invoice->id }}" class="form-control form-control-sm payment-status">
                     <option {{ $invoice->payment_status === 'paid' ? "selected" : ""}} value="paid">Paid</option>
                     <option {{ $invoice->payment_status === 'due' ? "selected" : ""}} value="due">Due</option>
                  </select>
               </td>
               <td>
                  <select name="invoice_status" id="invoice-status-{{ $invoice->id }}" class="form-control form-control-sm invoice-status">
                     <option {{ ($invoice->invoice_status === 'ready') ? "selected" : "" }} value="ready">Ready</option>
                     <option {{ ($invoice->invoice_status === 'processing') ? "selected" : "" }} value="processing">Processing</option>
                     @if($invoice->payment_status === 'paid')
                     <option {{ ($invoice->invoice_status === 'processing') ? "delivered" : "" }} value="delivered">Delivered</option>
                     @endif
                     @if($invoice->payment_status !== 'paid')
                     <option {{ ($invoice->invoice_status === 'processing') ? "canceled" : "" }} value="canceled">Canceled</option>
                     @endif
                  </select>
               </td>
               <!-- <td>{{ $invoice->quantity }}</td> -->
               <td>
                  <a class="btn btn-sm btn-secondary" href="{{ route('admin.invoices.edit', $invoice->id) }}"><i class="fa fa-edit"></i></a>
                  <a class="btn btn-sm btn-warning" href="{{ route('admin.invoices.show', $invoice->id) }}"><i class="fa fa-eye"></i></a>
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
      const _token = "{{ csrf_token() }}";
      $("#invoices-table").DataTable();

      $("#invoices-table").on("change", ".payment-status", function(event) {
         const url = "{{ route('admin.invoice.change.payment.status') }}";
         const invoiceId = $(this).data("id");
         const paymentStatus = $(this).val();
         $.ajax({
            method: "POST",
            url: url,
            data: {
               invoice_id: invoiceId,
               payment_status: paymentStatus,
               _token: _token,
            },
            success: function(response) {
               console.log(response);
            },
            error: function(error) {
               console.log(error);
            }
         });
      });
   });
</script>
<!-- <script src="{{ asset('js/products/products.js')}}"></script> -->
@endsection