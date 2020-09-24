@extends('layouts.app')

@section('stylesheets')
<link rel="stylesheet" href="{{ asset('css/products.css') }}">
@endsection

@section('content')
<div class="container">
	<h1 class="text-center">Our Products</h1>
	<a href="#" data-toggle="modal" data-target="#cart-modal">Cart</a>

	<div class="row">
		@foreach($products as $product)
		<!-- Product  -->
		<div class="col-lg-3 col-md-4 col-sm-6 product-grid product" data-id="{{$product->id}}" data-quantity="{{ $product->quantity }}" data-image="{{ asset('storage/product_images/' . $product->images[0]->image_uri ) }}" data-name="{{ $product->title }}" data-price="{{ $product->price }}" data-description="{{ $product->description }}">
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
         @if(Auth::guard('customers')->check())
			<button class="btn btn-primary buy" data-action="buy"><i class="fa fa-shopping-cart"></i> <span>BUY</span></button>
         @endif
			<button class="btn btn-danger remove d-none"><i class="fa fa-trash"></i></button>
			<span class="badge badge-info product-quantity">{{ $product->quantity }} </span>
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
								<img id="p-image" class="w-100">
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
								<input type="number" class="text-center" style="height: 2.2rem; width: 3rem;" min="1" value="10" max="100">
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

@include('includes/cartModal')

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
	function addProductToCart(product) {
		// const productInput = `
		// 	<div class="row cart-products" id="product-input-${product.id}" data-id="${product.id}">
		// 		<div class="form-group col-md-4">
		// 			<label for="product-${product.id}-${product.name}">Name</label>
		// 			<input type="hidden" type="number" name="product_ids[]" id="product-${product.id}" value="${product.id}">
		// 			<input id="product-${product.id}-${product.name}" readonly type="text" name="product_names[]" class="form-control" value="${product.name}">
		// 		</div>
		// 		<div class="form-group col-md-6">
		// 			<label for="product-${product.id}-quantity">Quantity</label>
		// 			<input type="number" name="product_quantities[]" id="product-${product.id}-quantity" class="form-control" min="1" max="${product.quantity}" value="1">
		// 		</div>
		// 		<div class="form-group col-md-2">
		// 			<label>Remove</label>
		// 			<button type="button" class="btn btn-danger fa fa-trash remove"></button>
		// 		</div>
		// 	</div>
		// `;

		const productInput = `
			<div class="row cart-products" id="product-input-${product.id}" data-id="${product.id}">
				<div class="form-group col-md-6">
					<label for="product-${product.id}-${product.name}">Name</label>
					<input type="hidden" type="number" name="product_ids[]" id="product-${product.id}" value="${product.id}">
					<input id="product-${product.id}-${product.name}" readonly type="text" name="product_names[]" class="form-control" value="${product.name}">
				</div>
				<div class="form-group col-md-6">
					<label for="product-${product.id}-quantity">Quantity</label>
					<input type="number" name="product_quantities[]" id="product-${product.id}-quantity" class="form-control" min="1" max="${product.quantity}" value="1">
				</div>
			</div>
		`;

		$("#cart-form").append(productInput);
	}

	function removeProductFromCart(id) {
		$(`#product-input-${id}`).remove();
	}
</script>
<script>
	$(function() {
		$(".product-link").on('click', function(event) {
			const product = $(event.target).closest('.product');
			$("#name").text(product.data('name'));
			$("#price").text(product.data('price'));
			$("#description").text(product.data('description'));
			$("#p-image").attr('src', product.data('image'));
		});

		// Add product to the cart.
		$(".product .buy").on("click", function(event) {
			const product = $(event.target).closest(".product");
			const buyBtn = product.children(".buy");
			const removeBtn = product.children(".remove");

			if (buyBtn.data().action === "buy") {
				buyBtn.children("span").text("ADDED");
				buyBtn.data("action", "bought");
				removeBtn.removeClass("d-none");

				addProductToCart(product.data());
			} else {
				console.log("Product already added.");
			}
		});

		// Remove product from the cart.
		$(".product .remove").on("click", function(event) {
			const product = $(event.target).closest(".product");
			const buyBtn = product.children(".buy");
			const removeBtn = product.children(".remove");

			if (buyBtn.data().action === "bought") {
				buyBtn.children("span").text("BUY");
				buyBtn.data("action", "buy");
				removeBtn.addClass("d-none");

				removeProductFromCart(product.data().id);
			} else {
				console.log("Product already removed.");
			}
		});

		// $("#cart-form").on("click", ".cart-products .remove", function(event) {
		// 	removeProductFromCart($(event.target).closest('.cart-products').data("id"));
		// });

		$("#submit-cart-form").on("click", function(event) {
			const data = $("#cart-form").serialize();
			const url = $("#cart-form [name='action_url']").val();
			jQuery.ajax({
				url: url,
				method: 'POST',
				data: data,
				success: function(response) {
					if (response.errors !== undefined) {
						toastr.error('Quantity error', 'Error', 2000);
					}
					// console.log(response);
					if (response.product_ids !== undefined) {
						// Success

						toastr.success('Transaction successful.', 'Success', 2000);
						$("button[data-dismiss=\"modal\"]").click();

						$.each(response.product_ids, function(index, id) {
							removeProductFromCart(id);
							const product = $(`.product[data-id="${id}"]`);
							const buyBtn = product.children('.buy');
							const removeBtn = product.children('.remove');

							// UI Specific
							buyBtn.children("span").text("BUY");
							buyBtn.data('action', 'buy');
							removeBtn.addClass('d-none');

							// Change the quantity
							product.data('quantity', product.data("quantity") - response.product_quantities[index]);
							product.children('.product-quantity').text(product.data('quantity'));
						});
					}
				},
				error: function(error) {
					if (error.status === 500) {
						toastr.error('Server down', 'Error', 2000);
					} else {
						toastr.error(error.responseJSON.msg, 'Error', 2000);
					}
				}
			});
		});
	});
</script>
@endsection
