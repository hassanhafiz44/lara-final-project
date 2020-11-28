@extends('layouts.app')

@section('stylesheets')
<link href="{{ asset('css/tailwind.min.css') }}" rel="stylesheet">

<style>
    .carousel img {
      height: 80vh;
      width: 100%;
      object-fit: cover;
    }
</style>
@endsection

@section('content')
<div class="container">
  @auth('customers')
  <div class="row text-white">
    <div class="col-12 col-lg-3 mt-2 mb-2">
      <div class="card bg-primary">
        <div class="card-body d-flex justify-content-between align-items-center">
          <span class="card-text">{{ __('labels.due_invoices') }}</span>
          <span class="card-text">{{ $no_due_invoices ?? 0 }}</span>
        </div>
      </div>
    </div>
    <div class="col-12 col-lg-3 mt-2 mb-2">
      <div class="card bg-primary">
        <div class="card-body d-flex justify-content-between align-items-center">
          <span class="card-text">{{ __('labels.due_amount') }}</span>
          <span class="card-text">{{ convert_to_currency($due_total) ?? 0 }}</span>
        </div>
      </div>
    </div>
    <div class="col-12 col-lg-3 mt-2 mb-2">
      <div class="card bg-primary">
        <div class="card-body d-flex justify-content-between align-items-center">
          <span class="card-text">{{ __('labels.paid_invoices') }}</span>
          <span class="card-text">{{ $no_paid_invoices ?? 0 }}</span>
        </div>
      </div>
    </div>
    <div class="col-12 col-lg-3 mt-2 mb-2">
      <div class="card bg-primary">
        <div class="card-body d-flex justify-content-between align-items-center">
          <span class="card-text">{{ __('labels.paid_amount') }}</span>
          <span class="card-text">{{ convert_to_currency($paid_total) ?? 0 }}</span>
        </div>
      </div>
    </div>
  </div>
  <div class="row text-white">
    <div class="col-lg-6 mt-2 mb-2">
      <div class="card bg-danger">
        <div class="card-body d-flex justify-content-between align-items-center">
          <span class="card-text">{{ __('labels.cancelled_invoices') }}</span>
          <span class="card-text">{{ $no_canceled_invoices ?? 0 }}</span>
        </div>
      </div>
    </div>
    <div class="col-lg-6 mt-2 mb-2">
      <div class="card bg-danger">
        <div class="card-body d-flex justify-content-between align-items-center">
          <span class="card-text">{{ __('labels.total_invoices') }}</span>
          <span class="card-text">{{ $no_total_invoices ?? 0 }}</span>
        </div>
      </div>
    </div>
  </div>
  @endauth
  <section class="text-gray-700 body-font">
	<div class="container mx-auto flex px-5 py-12 flex-col md:flex-row items-center">
		<div class="flex flex-col mb-16 items-center text-center md:w-1/2 md:pr-16 md:items-start md:text-left md:mb-0 lg:flex-grow">
			<p class="title-font text-3xl mb-4 font-medium text-gray-900 sm:text-4xl">Bilal Computers</p>
			<p class="mb-8 leading-relaxed">Selling devices in a low price. Heavy in performance but light on pocket. 
        @guest('customers')
        Login and start shopping. 
        @endguest</p>
		</div>
		<div class="w-5/6 md:w-1/2 lg:w-full lg:max-w-lg">
			<img class="object-cover object-center rounded" src="{{ asset('storage/static/home/hero.jpg') }}">
		</div>
	</div>
</section>

<section class="text-gray-700 body-font">
	<div class="container mx-auto flex px-5 py-12 flex-col md:flex-row items-start">
    <div class="flex flex-col mb-16 items-center text-center md:w-1/2 md:pr-16 md:items-end md:text-right md:mb-0 lg:flex-grow">
      <p class="title-font text-3xl mb-4 font-medium text-gray-900 sm:text-4xl">Gallery</p>
    </div>
    <div id="main-carousel" class="carousel slide" data-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img class="d-block w-100 rounded" src="{{ asset('storage/static/main-carousel/01.jpg') }}" alt="First slide">
        </div>
        <div class="carousel-item">
          <img class="d-block w-100 rounded" src="{{ asset('storage/static/main-carousel/02.jpg') }}" alt="Second slide">
        </div>
        <div class="carousel-item">
          <img class="d-block w-100 rounded" src="{{ asset('storage/static/main-carousel/03.jpg') }}" alt="Third slide">
        </div>
      </div>
    </div>
	</div>
</section>
</div>
@endsection

@section('scripts')
<script>
  $("#main-carousel").carousel();
</script>
@endsection
