<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>{{ config('app.name', 'Laravel') }}</title>

	<!-- Scripts -->
	<script src="{{ asset('js/jquery-3.4.1.js') }}"></script>
	<script src="{{ asset('js/popper.min.js') }}"></script>
	<script src="{{ asset('js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('js/datatables.min.js') }}"></script>
	<script src="{{ asset('js/toastr.min.js') }}"></script>
	<script src="{{ asset('js/loadingoverlay.min.js') }}"></script>
	<script src="{{ asset('js/highcharts.js') }}"></script>

	<script>
		toastr.options = {
			"stack": 10,
			"debug": false,
			"positionClass": "toast-bottom-right",
			"onclick": null,
			"fadeIn": 300,
			"fadeOut": 1000,
			"timeOut": 5000,
			"extendedTimeOut": 1000,
			"closeButton": true,
			"progressBar": true,
		}

		function showNotification(message, heading, type) {
			if(type === "error") {
				toastr.error(message, heading);
			} else if(type === 'success') {
				toastr.success(message, heading);
			} else if(type === "warning") {
				toastr.warning(message, heading);
			} else if(type === "info") {
				toastr.info(message, heading);
			}
		}
	</script>

	<!-- Icon -->
	<link rel="icon" href="{{ asset('favicon.svg') }}">
	<!-- Fonts -->
	<link rel="dns-prefetch" href="//fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
	<link rel="stylesheet" href="{{ asset('font-awesome/css/font-awesome.min.css') }}">

	<!-- Styles -->
	<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ asset('css/datatables.min.css') }}" rel="stylesheet">
	<link href="{{ asset('css/toastr.min.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="{{ asset('css/aos.css') }}">

	<style>
		body {
			background-color: #e8e3fd;
			background-image: linear-gradient(225deg, #e8e3fd 0%, #c6d6e2 70%, #054575 100%);
			min-height: 100vH;
		}
	</style>
	@yield('stylesheets')
</head>

<body>
	<nav class="navbar navbar-expand-md navbar-dark bg-info shadow-sm mb-4">
		<div class="container-fluid">
			@auth
			<a class="navbar-brand d-flex justify-content-center align-items-center" href="{{ route('admin.dashboard.index') }}">
				<img height="50" width="50" src="{{ asset('favicon.svg') }}">
				<span class="ml-2">{{ config('app.name', 'Laravel') }}</span>
			</a>
			@endauth
			@guest
			<a class="navbar-brand d-flex justify-content-center align-items-center" href="{{ route('pages.index') }}">
				<img height="50" width="50" src="{{ asset('favicon.svg') }}">
				<span class="ml-2">{{ config('app.name', 'Laravel') }}</span>
			</a>
			@endguest
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<!-- Showing only if PagesController is serving the request -->
				@if(request()->routeIs('pages.*'))
				<!-- Left Side Of Navbar -->
				<ul class="navbar-nav mr-auto">
					<li class="nav-item {{ request()->routeIs('pages.index') ? 'active' : ''}}">
						<a class="nav-link" href="{{ route('pages.index') }}">Home</a>
					</li>
					<li class="nav-item {{ request()->routeIs('pages.products') ? 'active' : ''}}">
						<a class="nav-link" href="{{ route('pages.products') }}">Products</a>
					</li>
					<li class="nav-item {{ request()->routeIs('pages.services') ? 'active' : ''}}">
						<a class="nav-link" href="{{ route('pages.services') }}">Services</a>
					</li>
					<li class="nav-item {{ request()->routeIs('pages.about') ? 'active' : ''}}">
						<a class="nav-link" href="{{ route('pages.about') }}">About Us</a>
					</li>
					<li class="nav-item {{ request()->routeIs('pages.contact') ? 'active' : ''}}">
						<a class="nav-link" href="{{ route('pages.contact') }}">Contact Us</a>
					</li>
				</ul>
				@else
				@if(Auth::user())
				<ul class="navbar-nav mr-auto">
					<li class="nav-item {{ request()->routeIs('admin.dashboard.*') ? 'active' : ''}}">
						<a class="nav-link" href="{{ route('admin.dashboard.index') }}">Dashboard</a>
					</li>
					<li class="nav-item {{ request()->routeIs('admin.crm.*') ? 'active' : ''}}">
						<a class="nav-link" href="{{ route('admin.crm.index') }}">CRM</a>
					</li>
					<li class="nav-item {{ request()->routeIs('admin.products.*') ? 'active' : ''}}">
						<a class="nav-link" href="{{ route('admin.products.index') }}">Products</a>
					</li>
					<li class="nav-item {{ request()->routeIs('admin.invoices.*') ? 'active' : ''}}">
						<a class="nav-link" href="{{ route('admin.invoices.index') }}">Invoices</a>
					</li>
					<li class="nav-item dropdown">
						<a href="#" id="reports-dropdown" class="nav-link dropdown-toggle {{ request()->routeIs('admin.reports.*') ? 'active' : '' }}" data-toggle="dropdown">Reports</a>
						<div class="dropdown-menu" aria-labelledby="reports-dropdown">
							<a href="{{ route('admin.reports.stock.in.hand') }}" class="dropdown-item {{ request()->routeIs('admin.reports.stock.in.hand') ? 'active' : '' }}">Stock In Hand</a>
							<a href="{{ route('admin.reports.low.stock') }}" class="dropdown-item {{ request()->routeIs('admin.reports.low.stock') ? 'active' : '' }}">Low Stock</a>
							<a href="{{ route('admin.reports.sales.summary') }}" class="dropdown-item {{ request()->routeIs('admin.reports.sales.summary') ? 'active' : '' }}">Sales Summary</a>
						</div>
					</li>
				</ul>
				@endif
				@endif

				<!-- Right Side Of Navbar -->
				<ul class="navbar-nav ml-auto">
					<!-- Authentication Links -->
					@if(!Auth::guard('web')->check() && !Auth::guard('customers')->check())
					<li class="nav-item">
						<a class="nav-link" href="{{ route('customers.login') }}">{{ __('Login') }}</a>
					</li>
						@if (Route::has('customers.register'))
						<li class="nav-item">
							<a class="nav-link" href="{{ route('customers.register') }}">{{ __('Register') }}</a>
						</li>
						@endif
					@elseif(Auth::guard('web')->check())
					<li class="nav-item">
						<a href="#" data-toggle="tooltip" data-placement="bottom" title="{{ is_unread_message() ? "You have unread messages" : "Customer feedback"}}" class="nav-link {{ is_unread_message() ? 'text-warning' : ''}}"><i class="fa fa-envelope"></i></a>
					</li>
					<li class="nav-item dropdown">
						<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
							Welcome {{ ucwords(Auth::user()->name) }} <span class="caret"></span>
						</a>

						<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
							<a class="dropdown-item" href="{{ route('users.logout') }}" onclick="
								event.preventDefault();
								if(window.confirm('Are you sure to logout?')) 
									document.getElementById('logout-form').submit();">
								{{ __('Logout') }}
							</a>

							<form id="logout-form" action="{{ route('users.logout') }}" method="POST" style="display: none;">@csrf</form>
						</div>
					</li>
					@elseif(Auth::guard('customers')->check())
					<li class="nav-item dropdown">
						<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
							Welcome {{ ucwords(Auth::guard('customers')->user()->name) }} <span class="caret"></span>
						</a>


						<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
							<a href="{{ route('pages.invoices.index') }}" class="dropdown-item">Invoices</a>
							<a class="dropdown-item" href="{{ route('customers.logout') }}" onclick="
								event.preventDefault();
								if(window.confirm('Are you sure to logout?'))
									document.getElementById('logout-form').submit();">
								{{ __('Logout') }}
							</a>

							<form id="logout-form" action="{{ route('customers.logout') }}" method="POST" style="display: none;">@csrf</form>
						</div>
					</li>
					@endif
				</ul>
			</div>
		</div>
	</nav>
	<main style="min-height: 100vh" class="container">
		@yield('content')
	</main>
	<footer class="mt-4 bg-info p-4">
		<div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center text-white">
			<span>&copy; 2020 All Rights Reserved</span>
			<span>Happy Shopping</span>
		</div>
	</footer>
	@yield('scripts')
	<script src="{{ asset('js/aos.js') }}"></script>
	<script>
		$(function () {
			AOS.init({
				duration: 1000,
			});
			$('[data-toggle="tooltip"]').tooltip();
		});
	</script>
</body>

</html>
