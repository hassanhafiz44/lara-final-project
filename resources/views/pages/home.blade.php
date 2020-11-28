<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="stylesheet" href="{{ asset('css/tailwind.min.css') }}">

  </head>
  <body>
    <div class="bg-indigo-700 p-4 flex flex-col md:flex-row justify-between items-center">
      <div class="flex items-center">
        <img width="50" src="{{ asset('favicon.svg') }}" alt="Logo">
        <a href="{{ route('pages.index') }}" class="inline-block p-2 text-indigo-100 mr-1 text-xs sm:text-base">Home</a>
        <a href="{{ route('pages.products') }}" class="inline-block p-2 text-indigo-200 mr-1 text-xs sm:text-base hover:text-indigo-100">Products</a>
        <a href="{{ route('pages.services') }}" class="inline-block p-2 text-indigo-200 mr-1 text-xs sm:text-base hover:text-indigo-100">Services</a>
        <a href="{{ route('pages.about') }}" class="inline-block p-2 text-indigo-200 mr-1 text-xs sm:text-base hover:text-indigo-100">About Us</a>
        <a href="{{ route('pages.contact') }}" class="inline-block p-2 text-indigo-200 mr-1 text-xs sm:text-base hover:text-indigo-100">Contact Us</a>
      </div>
      @auth('customers')
      <div class="flex items-center">
        <a href="{{ route('pages.invoices.index') }}" class="inline-block p-2 text-indigo-200 mr-1 text-xs sm:text-base hover:text-indigo-100">{{ __('labels.invoices') }}</a>
        <a class="inline-block p-2 text-indigo-200 mr-1 text-xs sm:text-base hover:text-indigo-100" href="{{ route('customers.logout') }}" onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">
          {{ __('Logout') }}
        </a>

        <form id="logout-form" action="{{ route('customers.logout') }}" method="POST" style="display: none;">@csrf</form>
      </div>
      @endauth
    </div>

    <div class="md:flex justify-between py-20 px-10 bg-indigo-600 text-indigo-200">
      <div class="md:w-1/2 mb-10 md:mb-0">
        <h2 class="text-2xl md:text-4xl lg:text-6xl text-white mb-5">Welcome to {{ ucwords($company->title) }}</h2>
        <p class="mb-6">{{ ucwords( $company->slogan ?? "This is company slogan") }}</p>
        @guest('customers')
        <a href="{{ route('customers.login') }}" class="inline-block py-3 px-6 text-lg bg-gray-400 hover:bg-gray-300 text-gray-800 mr-2 rounded transition ease-in duration-150">Login</a>
        <a href="{{ route('customers.register') }}" class="inline-block py-3 px-6 text-lg bg-purple-400 text-purple-800 hover:bg-purple-300 rounded transition ease-in duration-150">Signup</a>
        @endguest
        @auth('customers')
        <a href="{{ route('pages.products') }}" class="inline-block py-3 px-6 text-lg bg-pink-400 text-pink-800 hover:bg-pink-300 rounded transition ease-in duration-150">Go Shopping</a>
        @endauth
      </div>
      <div class="md:w-1/2">
        <img src="{{ asset('storage/static/home/hero.jpg') }}" alt="Computer" class="w-full rounded shadow-2xl">	
      </div>
    </div>
    <!-- features -->
    <div class="md:flex py-16 px-10 bg-indigo-800 text-indigo-200 text-center">
      
      <div class="md:mr-2 mb-2">
      <img src="{{ asset('storage/static/home/feature-01.jpg') }}" alt="laptop" class="w-full rounded mb-4 border-solid border-2 border-indigo-400">
      </div>
      
      <div class="md:mr-2 mb-2 md:mt-8">
        <img src="{{ asset('storage/static/home/feature-02.jpg') }}" alt="a keyboard" class="w-full rounded mb-4 border-solid border-2 border-indigo-400">
      </div>
      
      <div class="md:mr-2 mb-2">
        <img src="{{ asset('storage/static/home/feature-03.jpg') }}" alt="a ram" class="w-full rounded mb-4 border-solid border-2 border-indigo-400">
      </div>
      
      <div class="md:mr-2 mb-2 md:mt-8">
        <img src="{{ asset('storage/static/home/feature-04.jpg') }}" alt="a processor" class="w-full rounded mb-4 border-solid border-2 border-indigo-400">
      </div>
    </div>

    <!-- footer -->
    <div class="p-10 bg-indigo-900 text-indigo-400 flex justify-end items-center">
      <!-- right -->
      <div>
        Copyright &copy; Computers 2020 - infinity
      </div>
    </div>
  </body>
</html>