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
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('js/datatables.min.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('font-awesome/css/font-awesome.min.css') }}">

    <!-- Styles -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ asset('css/datatables.min.css') }}" rel="stylesheet">
    @yield('stylesheets')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="#">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Showing only if PagesController is serving the request -->
                    @if( explode("\\", explode("@", Route::currentRouteAction())[0])[3] === 'PagesController')
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
                                <li class="nav-item {{ url()->current() === route('dashboard.index') ? 'active' : ''}}">
                                    <a class="nav-link" href="{{ route('dashboard.index') }}">Dashboard</a>
                                </li>
                                <li class="nav-item {{ url()->current() === route('employees.index') ? 'active' : ''}}">
                                    <a class="nav-link" href="{{ route('employees.index') }}">Employees</a>
                                </li>
                            </ul>
                        @endif
                    @endif

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="container-fluid">
			<div class="jumbotron">
				<h1>{{ $title }}</h1>
			</div>
            @yield('content')
        </main>
    </div>
</body>
</html>
