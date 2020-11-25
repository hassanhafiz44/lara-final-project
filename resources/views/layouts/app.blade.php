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

	<!-- Fonts -->
	<link rel="dns-prefetch" href="//fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
	<link rel="stylesheet" href="{{ asset('font-awesome/css/font-awesome.min.css') }}">

	<!-- Styles -->
	<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ asset('css/datatables.min.css') }}" rel="stylesheet">
	<link href="{{ asset('css/toastr.min.css') }}" rel="stylesheet">
	<style>
		body {
			background-color: #e8e3fd;
			background-image: linear-gradient(225deg, #e8e3fd 0%, #c6d6e2 70%, #bed0de 100%);
			height: 100vH;
		}
	</style>
	@yield('stylesheets')
</head>

<body>
	<div id="app">
		<nav class="navbar navbar-expand-md navbar-dark bg-info shadow-sm mb-4">
			<div class="container">
				<a class="navbar-brand" href="#">
					{{ config('app.name', 'Laravel') }}
				</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
					<span class="navbar-toggler-icon"></span>
				</button>

				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<!-- Showing only if PagesController is serving the request -->
					@if( explode("\\", explode("@", Route::currentRouteAction())[0])[3] === 'PagesController'
					OR explode("\\", explode("@", Route::currentRouteAction())[0])[3] === 'InvoicesController')
					<!-- Left Side Of Navbar -->
					<ul class="navbar-nav mr-auto">
						<li class="nav-item {{ url()->current() === route('pages.index') ? 'active' : ''}}">
							<a class="nav-link" href="{{ route('pages.index') }}">Home</a>
						</li>
						<li class="nav-item {{ url()->current() === route('pages.products') ? 'active' : ''}}">
							<a class="nav-link" href="{{ route('pages.products') }}">Products</a>
						</li>
						<li class="nav-item {{ url()->current() === route('pages.services') ? 'active' : ''}}">
							<a class="nav-link" href="{{ route('pages.services') }}">Services</a>
						</li>
						<li class="nav-item {{ url()->current() === route('pages.about') ? 'active' : ''}}">
							<a class="nav-link" href="{{ route('pages.about') }}">About Us</a>
						</li>
						<li class="nav-item {{ url()->current() === route('pages.contact') ? 'active' : ''}}">
							<a class="nav-link" href="{{ route('pages.contact') }}">Contact Us</a>
						</li>
					</ul>
					@else
					@if(Auth::user())
					<ul class="navbar-nav mr-auto">
						<li class="nav-item {{ url()->current() === route('admin.dashboard.index') ? 'active' : ''}}">
							<a class="nav-link" href="{{ route('admin.dashboard.index') }}">Dashboard</a>
						</li>
						{{-- <li class="nav-item {{ url()->current() === route('admin.employees.index') ? 'active' : ''}}">
							<a class="nav-link" href="{{ route('admin.employees.index') }}">Employees</a>
						</li> --}}
						<li class="nav-item {{ url()->current() === route('admin.crm.index') ? 'active' : ''}}">
							<a class="nav-link" href="{{ route('admin.crm.index') }}">CRM</a>
						</li>
						<li class="nav-item {{ url()->current() === route('admin.products.index') ? 'active' : ''}}">
							<a class="nav-link" href="{{ route('admin.products.index') }}">Products</a>
						</li>
						<li class="nav-item {{ url()->current() === route('admin.invoices.index') ? 'active' : ''}}">
							<a class="nav-link" href="{{ route('admin.invoices.index') }}">Invoices</a>
						</li>
					</ul>
					@endif
					@endif

					<!-- Right Side Of Navbar -->
					<ul class="navbar-nav ml-auto">
						<!-- Authentication Links -->
						<!-- @guest
						<li class="nav-item">
							<a class="nav-link" href="{{ route('customers.login') }}">{{ __('Login') }}</a>
						</li>
						@if (Route::has('customers.register'))
						<li class="nav-item">
							<a class="nav-link" href="{{ route('customers.register') }}">{{ __('Register') }}</a>
						</li>
						@endif
						@else
						<li class="nav-item dropdown">
							<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
								{{ Auth::user()->name }} <span class="caret"></span>
							</a>

							<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
								<a class="dropdown-item" href="{{ route('users.logout') }}" onclick="event.preventDefault();
											document.getElementById('logout-form').submit();">
									{{ __('Logout') }}
								</a>

								<form id="logout-form" action="{{ route('users.logout') }}" method="POST" style="display: none;">@csrf</form>
							</div>
						</li>
						@endguest -->
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
								{{ Auth::user()->name }} <span class="caret"></span>
							</a>

							<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
								<a class="dropdown-item" href="{{ route('users.logout') }}" onclick="event.preventDefault();
											document.getElementById('logout-form').submit();">
									{{ __('Logout') }}
								</a>

								<form id="logout-form" action="{{ route('users.logout') }}" method="POST" style="display: none;">@csrf</form>
							</div>
						</li>
						@elseif(Auth::guard('customers')->check())
						<li class="nav-item dropdown">
							<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
								{{ Auth::guard('customers')->user()->name }} <span class="caret"></span>
							</a>


							<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
								<a href="{{ route('pages.invoices.index') }}" class="dropdown-item">Invoices</a>
								<a class="dropdown-item" href="{{ route('customers.logout') }}" onclick="event.preventDefault();
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

	</div>
	
	<main class="container-fluid" style="min-height:100vh">
		@yield('content')
	</main>
		<footer>
			<div style="background-color: #17a2b8;">
			  <div class="py-4 px-5 flex flex-wrap flex-col flex-sm-row">
				<p class="text-white text-center text-sm-left">© 2020 All Rights Reserved</p>
				<span class="ml-sm-auto mt-sm-0 mt-2 w-sm-auto w-100 text-sm-left text-center text-white">Happy Shopping</span>
			  </div>
			</div>
		  </footer>
	</footer>
	@yield('scripts')
	<script>
		$(function () {
			$('[data-toggle="tooltip"]').tooltip()
		});
	</script>
</body>

</html>
