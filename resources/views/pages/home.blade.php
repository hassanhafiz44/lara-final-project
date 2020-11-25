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
  @if(Auth::guard('customers')->check())
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
  @endif
  <section class="text-gray-700 body-font">
	<div class="container mx-auto flex px-5 py-12 flex-col md:flex-row items-center">
		<div class="flex flex-col mb-16 items-center text-center md:w-1/2 md:pr-16 md:items-start md:text-left md:mb-0 lg:flex-grow">
			<p class="title-font text-3xl mb-4 font-medium text-gray-900 sm:text-4xl">Before they sold out
				<br class="hidden lg:inline-block">readymade by gluten
      </p>
			<p class="mb-8 leading-relaxed">Copper mug try-hard pitchfork pour-over freegan heirloom neutra air plant cold-pressed tacos poke beard tote bag. Heirloom echo park mlkshk tote bag selvage hot chicken authentic tumeric truffaut hexagon try-hard chambray</p>
		</div>
		<div class="w-5/6 md:w-1/2 lg:w-full lg:max-w-lg">
			<img class="object-cover object-center rounded" src="{{ asset('storage/static/home/04.jpg') }}">
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
