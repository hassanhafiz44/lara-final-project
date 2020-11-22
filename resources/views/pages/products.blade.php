@extends('layouts.app')

@section('stylesheets')
{{-- <link rel="stylesheet" href="{{ asset('css/products.css') }}"> --}}
@endsection

@section('content')
<div class="container">
	<h1 class="text-center">{{ __('labels.buy_products') }}</h1>
	<a href="#" data-toggle="modal" data-target="#cart-modal">{{ __('labels.cart') }}</a>

	<div class="row">
		@foreach($products as $product)
		<!-- Product  -->
		<div class="col-lg-3">
			<div class="card">
				<img src="{{ asset('storage/product_images/' . $product->image_url) }}" class="card-img-top">
					<div class="product card-body" data-id="{{$product->id}}" data-quantity="{{ $product->quantity }}" data-image="{{ asset('storage/product_images/' . $product->image_url) }}" data-name="{{ $product->title }}" data-price="{{ $product->price }}" data-description="{{ $product->description }}">
						<h5 class="card-title">{{ $product->title }}</h5>
						<p class="card-text">Price: ${{ $product->retail_price }}</p>
						@if(Auth::guard('customers')->check())
						<button class="btn btn-primary btn-block btn-sm mb-2 buy" data-action="buy"><i class="fa fa-shopping-cart"></i> <span>{{ __('labels.add_to_cart') }}</span></button>
						@endif
						<span class="badge badge-info product-quantity">{{ $product->quantity }} </span>
						<a href="#" class="product-link btn btn-sm btn-primary" data-toggle="modal" data-target="#myModal1">{{ __('labels.view_details') }}</a>
						<button class="btn btn-danger btn-sm remove d-none"><i class="fa fa-trash"></i></button>
					</div>
			</div>
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
								<h2 class="text-center">{{ __('labels.details') }}</h2>
								<p class="font-weight-bold">{{ __('labels.name') }}: <span id="name"></span><br>{{ __('labels.details') }}: <span id="price"></span><br>{{ __('labels.description') }}: <span id="description"></span><br></p>
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
</div>

<!-- View Order -->

@include('includes/cartModal')

<footer style="margin-top: 50px">

</footer>
<script>
	function addProductToCart(product) {

		const productInput = `
			<div class="row cart-products" id="product-input-${product.id}" data-id="${product.id}">
				<div class="form-group col-md-6">
					<label for="product-${product.id}-${product.name}">{{ __('labels.name') }}</label>
					<input type="hidden" type="number" name="product_ids[]" id="product-${product.id}" value="${product.id}">
					<input id="product-${product.id}-${product.name}" readonly type="text" name="product_names[]" class="form-control" value="${product.name}">
				</div>
				<div class="form-group col-md-6">
					<label for="product-${product.id}-quantity">{{ __('labels.quantity') }}</label>
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
				buyBtn.children("span").text("{{ __('labels.added_to_cart') }}");
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
				buyBtn.children("span").text("{{ __('labels.add_to_cart') }}");
				buyBtn.data("action", "buy");
				removeBtn.addClass("d-none");

				removeProductFromCart(product.data().id);
			} else {
				console.log("Product already removed.");
			}
		});

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
