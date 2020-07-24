<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
	 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
	 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('css/home.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/products.css')}}">
</head>
<body>
	<div class="header">
		@section('header')
			<nav class="navbar  navbar-expand-lg navbar-light" style="background-color: rgba(248,70,129,0.6);">
			  <a class="navbar-brand pl-5" href="#">Logo</a>
			  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
			    <span class="navbar-toggler-icon"></span>
			  </button>
			  <div class="collapse navbar-collapse" id="navbarNav">
			    <ul class="navbar-nav ml-auto font-weight-bold text-center">
			      <li class="nav-item">
			        <a class="nav-link pr-5" href="home">Home</a>
			      </li>
			      <li class="nav-item">
			        <a class="nav-link pr-5" href="products">Products</a>
			      </li>
			      <li class="nav-item">
			        <a class="nav-link pr-5" href="services">Services</a>
			      </li>
			      <li class="nav-item">
			        <a class="nav-link pr-5" href="#">About</a>
			      </li>
			      <li class="nav-item">
			        <a class="nav-link pr-5" href="contact">Contact us</a>
			      </li>
			    </ul>
			  </div>
			</nav>
		@show
	</div>

	<div class="content">
		@section('content')
		@show
	</div>




	  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>