@extends('layouts.app')

@section('content')
<div class="container" ng-app="productsApp" ng-controller="productsCtrl" ng-init="initializeProducts()">
	<div class="d-flex justify-content-between align-items-center">
		<h1 class="text-center">{{ __('labels.buy_products') }}</h1>
		<a href="#" class="btn btn-success" ng-if="cartProducts.length" data-toggle="modal" data-target="#cart-modal"><i class="fa fa-shopping-cart"></i> {{ __('labels.cart') }}</a>
	</div>
	
	<div class="row mt-2">
		<div class="col-lg-3" ng-repeat="product in products">
			<div class="card">
				<img ng-src="<%= product.imageLink %>" alt="Product image" class="card-img-top" width="200" height="200">
				<div class="card-body">
					<h5 class="card-title"><%= product.title %></h5>
					<p class="card-text">{{ __('labels.price') }}: <%= product.retail_price | currency:"PKR"  %></p>
					@if(Auth::guard('customers')->check())
					<button ng-if="product.quantity > 0" ng-click="addProductToCart(product)" ng-disabled="product.isAddedToCart" class="btn btn-primary btn-block btn-sm mb-2"><i class="fa fa-shopping-cart"> <span><%= product.isAddedToCart ? "{{ __('labels.added_to_cart') }}" : "{{ __('labels.add_to_cart') }}" %></span></i></button>
					@endif
					<span class="badge badge-info"><%= product.quantity %> </span>
					<span class="text-danger" ng-if="product. quantity === 0">Out of Stock</span>
					<button ng-click="deleteProductFromCart(product.id)" class="btn btn-danger btn-sm" ng-if="product.isAddedToCart"><i class="fa fa-trash"></i></button>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="myModal1">
		<div class="modal-dialog">
			<div class="modal-content">

				<!-- Modal body -->
				<div class="modal-body">
					<div class="container">
						<h2>{{ __('labels.details') }}</h2>
						<div class="row">
							<div class="col-lg-4">
								<img id="p-image" class="w-100">
							</div>
							<div class="col-lg-8">
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
	@include('includes/cartModal')
</div>

<footer style="margin-top: 50px">

</footer>
@endsection

@section('scripts')
<script src="{{ asset('js/angular.min.js') }}"></script>
<script>
	const app = angular.module('productsApp', []);
	app.config(function($interpolateProvider){

		$interpolateProvider.startSymbol('<%=');
		$interpolateProvider.endSymbol('%>');
	});

	app.controller('productsCtrl', function($scope, $http) {
		const images_path = "{{ asset('storage/product_images') }}/";
		$scope.products = [];
		// for backup
		$scope.originalProducts = [];
		$scope.cartProducts = [];

		$scope.initializeProducts = function() {
			const initialization_url = '{{ route('pages.products.initialize') }}';
			$("body").LoadingOverlay('show');
			$http.post(initialization_url, {_token: '{{ Session::token() }}'}).then(
				function(response) {
					const data = response.data;
					// console.log(data.products);
					$scope.products = data.products.map(product => {
						return {
							...product,
							imageLink: `${images_path}${product.image_url}`,
							isAddedToCart: false,
						}
					});
					$scope.originalProducts = angular.copy($scope.products);
					$scope.cartProducts = [];
					$('#cart-modal').modal('hide');
				}
			).catch(function(error) {

			}).finally(function() {
				$("body").LoadingOverlay('hide');
			});
		}

		$scope.addProductToCart = function(product) {
			if(!product.isAddedToCart) {
				const originalProduct = {...$scope.originalProducts.filter(p => p.id === product.id)[0]};
				product.isAddedToCart = true;
				product.quantity--;
				$scope.cartProducts.push({
					id: product.id,
					name: product.title,
					quantity: 1,
					total_quantity: originalProduct.quantity,
					image_link: product.imageLink,
					description: product.description,
				});
			}
		}

		$scope.deleteProductFromCart = function(id) {
			// Replace the product element with original element
			const originalProduct = {...$scope.originalProducts.filter(p => p.id === id)[0]};
			const index = $scope.products.findIndex(p => p.id === id);
			$scope.products[index] = originalProduct;

			// Remove product from the cart
			$scope.cartProducts = $scope.cartProducts.filter(p => p.id !== id);

			// Hide cart modal
			if($scope.cartProducts.length === 0)
				$('#cart-modal').modal('hide');
		}

		$scope.onCompleteOrder = function() {
			$("body").LoadingOverlay('show');
			$http.post("{{ route('pages.invoices.store') }}", {_token: '{{ Session::token() }}', data: $scope.cartProducts}).then(
				function(response) {
					const data = response.data;
					console.log(data);
					toastr.success('Success', 'Invoice created', 'success');
					$scope.initializeProducts();
				}
			).catch(function(error) {

			}).finally(function() {
				$("body").LoadingOverlay('hide');
			});
		}
	});
</script>
@endsection