@extends('layouts.app')

@section('stylesheets')
{{-- <link rel="stylesheet" type="text/css" href="{{asset('css/home.css')}}"> --}}
@endsection

@section('content')
<div class="container">
  <div class="row text-white">
    <div class="col-lg-3 mt-2 mb-2">
      <div class="card bg-primary">
        <div class="card-body">
          <h5 class="card-title">{{ __('labels.due_invoices') }} <span class="pull-right">{{ $no_due_invoices ?? 0 }}</span></h5>
        </div>
      </div>
    </div>
    <div class="col-lg-3 mt-2 mb-2">
      <div class="card bg-primary">
        <div class="card-body">
          <h5 class="card-title">{{ __('labels.due_amount') }} <span class="pull-right">${{ $due_total ?? 0}}</span></h5>
        </div>
      </div>
    </div>
    <div class="col-lg-3 mt-2 mb-2">
      <div class="card bg-primary">
        <div class="card-body">
          <h5 class="card-title">{{ __('labels.paid_invoices') }}<span class="pull-right">{{ $no_paid_invoices ?? 0}}</span></h5>
        </div>
      </div>
    </div>
    <div class="col-lg-3 mt-2 mb-2">
      <div class="card bg-primary">
        <div class="card-body">
          <h5 class="card-title">{{ __('labels.paid_amount') }} <span class="pull-right">${{ $paid_total ?? 0}}</span></h5>
        </div>
      </div>
    </div>
  </div>
  <div class="row text-white">
    <div class="col-lg-6 mt-2 mb-2">
      <div class="card bg-danger">
        <div class="card-body">
          <h5 class="card-title">{{ __('labels.cancelled_invoices') }} <span class="pull-right">{{ $no_canceled_invoices ?? 0}}</span></h5>
        </div>
      </div>
    </div>
    <div class="col-lg-6 mt-2 mb-2">
      <div class="card bg-danger">
        <div class="card-body">
          <h5 class="card-title">{{ __('labels.total_invoices') }} <span class="pull-right">{{ $no_total_invoices ?? 0}}</span></h5>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
