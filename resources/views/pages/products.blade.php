@extends('layouts.app')

@section('stylesheets')
		<link rel="stylesheet" href="{{ asset('css/products.css') }}">
@endsection

@section('content')
		<div class="container">
				<h1 class="text-center">Our Products</h1>

				<div class="row">
				@foreach($products as $product)
						<!-- Product  -->
						<div class="col-lg-3 col-md-4 col-sm-6 product-grid product" data-image="{{ asset('storage/product_images/' . $product->images[0]->image_uri ) }}" data-name="{{ $product->title }}" data-price="{{ $product->price }}" data-description="{{ $product->description }}">
								<div class="image">
										<a href="#" class="product-link" data-toggle="modal" data-target="#myModal1">
												<img src="{{ asset('storage/product_images/' . $product->images[0]->image_uri) }}" class="w-100">
												<div class="overlay">
														<div class="detail">View Details</div>
												</div>
										</a>
								</div>
								<h5 class="text-center">{{ $product->title }}</h5>
								<h5 class="text-center">Price: ${{ $product->price }}</h5>
								<a href="#" data-toggle="modal" data-target="#buymodal" class="btn buy"><i class="fa fa-shopping-cart"></i> BUY</a>
						</div>
						<!-- ./Product -->
				@endforeach
				</div>

				<div class="modal fade" id="myModal1">
						<div class="modal-dialog">
								<div class="modal-content">

								<!-- Modal body -->
										<div class="modal-body">
												<div class="container">
														<div class="row">
																<div class="col-lg-4">
																		<img id="p-image" src="{{ asset('storage/product_images/' . $product->images[0]->image_uri) }}" class="w-100">
																</div>
																<div class="col-lg-8">
																		<h2 class="text-center">Details</h2>
																		<p class="font-weight-bold">Name: <span id="name"></span><br>Price: <span id="price"></span><br>Description: <span id="description"></span><br></p>
																</div>
														</div>
												</div>
										</div>

										<!-- Modal footer -->
										<div class="modal-footer">
												<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
										</div>

								</div>
						</div>
				</div>
				<!-- Buy modal --> 

				<div class="modal fade" id="buymodal">
						<div class="modal-dialog">
								<div class="modal-content">

								<!-- Modal body -->
										<div class="modal-body">
												<form>
														<div class="form-row">
																<div class="form-group col-md-6">
																		<label>First Name</label>
																		<input type="email" class="form-control" placeholder="First Name">
																</div>
																<div class="form-group col-md-6">
																		<label>Second Name</label>
																		<input type="password" class="form-control" placeholder="Second Name">
																</div>
														</div>
														<div class="form-group">
																<label>Email</label>
																<input type="text" class="form-control" placeholder="Enter your email address">
														</div>
														<div class="form-group">
																<label>Address</label>
																<input type="text" class="form-control" placeholder="Address for order delivery">
														</div>
														<div class="form-row">
																<div class="form-group col-md-6">
																		<label for="inputCity">City</label>
																		<input type="text" class="form-control">
																</div>
																<div class="form-group col-md-4">
																		<label>Quantity</label><br>
																		<input type="number" class="text-center" style="height: 2.2rem; width: 3rem;" min="1" value="10" max="100"  >
																</div>
														</div>
														<div class="form-group">
																<div class="form-check">
																		<input class="form-check-input" type="checkbox">
																		<label class="form-check-label">Check me out</label>
																</div>
														</div>
														<a href="#" data-toggle="modal" data-target="#vieworder" class="btn btn-primary" data-dismiss="modal">view order</a>
												</form>
										</div>

										<!-- Modal footer -->
										<div class="modal-footer">
												<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
										</div>

								</div>
						</div>
				</div>
		</div>

		<!-- View Order -->

		<div class="modal fade " id="vieworder">
				<div class="modal-dialog">
						<div class="modal-content">

						<!-- Modal body -->
								<div class="modal-body">
										<div class="container">
												<div class="row">
														<div class="col-lg-4">
																<img src="images/apple-watch.jpg" class="w-100">
														</div>
														<div class="col-lg-8">
																<h2 class="text-center">Your order info:</h2>
																<p class="font-weight-bold">ID:<br>
																Product:<br>
																Customer's name:<br>
																Address:<br>
																Contact no:<br>
																Address:<br>
																Quantity:<br>
																Grand total:</p>
														</div>
												</div>
										</div>
								</div>

								<!-- Modal footer -->
								<div class="modal-footer">
										<a href="#" data-toggle="modal" class="btn btn-secondary" data-target="#buymodal" data-dismiss="modal">Edit order</a>
										<button class="btn btn-primary" data-dismiss="modal">Place order</button>
								</div>

						</div>
				</div>
		</div>

		<footer style="margin-top: 50px">

		</footer>
		<script>
			$(function() {
				$(".product-link").on('click', function(event) {
					const product = $(event.target).closest('.product');
					$("#name").text(product.data('name'));
					$("#price").text(product.data('price'));
					$("#description").text(product.data('description'));
					$("#p-image").text(product.data('image'));
				});
			});
		</script>
@endsection
