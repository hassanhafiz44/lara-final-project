@extends('layouts.app')

@section('stylesheets')
<link rel="stylesheet" type="text/css" href="{{asset('css/home.css')}}">
@endsection

@section('content')
<div class="container" style="height: 80vh;">
  <div class="row">
    <div class="col-lg-3 mt-2 mb-2">
      <div class="card bg-primary">
        <div class="card-body">
          <h5 class="card-title">Due Invoices <span class="pull-right">{{ $no_due_invoices ?? 0 }}</span></h5>
        </div>
      </div>
    </div>
    <div class="col-lg-3 mt-2 mb-2">
      <div class="card bg-info">
        <div class="card-body">
          <h5 class="card-title">Due Amount <span class="pull-right">${{ $due_total ?? 0}}</span></h5>
        </div>
      </div>
    </div>
    <div class="col-lg-3 mt-2 mb-2">
      <div class="card bg-warning">
        <div class="card-body">
          <h5 class="card-title">Paid Invoices<span class="pull-right">{{ $no_paid_invoices ?? 0}}</span></h5>
        </div>
      </div>
    </div>
    <div class="col-lg-3 mt-2 mb-2">
      <div class="card bg-danger">
        <div class="card-body">
          <h5 class="card-title">Paid Amount <span class="pull-right">${{ $paid_total ?? 0}}</span></h5>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-6 mt-2 mb-2">
      <div class="card bg-info">
        <div class="card-body">
          <h5 class="card-title">Canceled Invoices <span class="pull-right">{{ $no_canceled_invoices ?? 0}}</span></h5>
        </div>
      </div>
    </div>
    <div class="col-lg-6 mt-2 mb-2">
      <div class="card bg-warning">
        <div class="card-body">
          <h5 class="card-title">Total Invoices <span class="pull-right">{{ $no_total_invoices ?? 0}}</span></h5>
        </div>
      </div>
    </div>
  </div>
</div>

<footer>
  <div class="footer-container">
    <div class="left-col">
      <div class="social-media">
        <a href="#"><i class="fa fa-facebook-f"></i></a>
        <a href="#"><i class="fa fa-twitter"></i></a>
        <a href="#"><i class="fa fa-instagram"></i></a>
        <a href="#"><i class="fa fa-youtube"></i></a>
        <a href="#"><i class="fa fa-linkedin-in"></i></a>
      </div>
      <p class="rights-text">© 2020 All Rights Reserved.</p>
    </div>

    <div class="right-col">
      <h1>Our Newsletter</h1>
      <div class="border"></div>
      <p>Enter Your Email to get our news and updates.</p>
      <form action="" class="newsletter-form">
        <input type="text" class="txtb" placeholder="Enter Your Email">
        <input type="submit" class="btn" value="submit">
      </form>
    </div>
  </div>
</footer>
@endsection
