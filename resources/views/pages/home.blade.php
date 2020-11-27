<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="stylesheet" href="{{ asset('css/tailwind.min.css') }}">

  </head>
  <body>
    <div class="bg-indigo-700 p-4 flex justify-between items-center">
      <div class="flex items-center">

        <img width="50" src="{{ asset('favicon.svg') }}" alt="Logo">
        <a href="#" class="inline-block p-3 text-indigo-200 mr-2 hover:text-indigo-100">Home</a>
        <a href="#" class="inline-block p-3 text-indigo-200 hover:text-indigo-100">About</a>
      </div>
      <div>
        <a href="#" class="inline-block p-2 text-indigo-200 mr-2 hover:text-indigo-100">Login</a>
        <a href="#" class="inline-block py-2 px-4 text-yellow-700 bg-yellow-400 rounded hover:bg-yellow-300 hover:text-yellow-800 transition ease-in duration-150">Signup</a>
      </div>
    </div>

    <div class="md:flex justify-between py-20 px-10 bg-indigo-600 text-indigo-200">
      <div class="md:w-1/2 mb-10 md:mb-0">
        <h2 class="text-2xl md:text-4xl lg:text-6xl text-white mb-5">Welcome to Computers City!</h2>
        <p class="mb-6">There is never a sad day here!</p>
        <a href="#" class="inline-block py-3 px-6 text-lg bg-gray-400 hover:bg-gray-300 text-gray-800 mr-2 rounded">Learn More</a>
        <a href="#" class="inline-block py-3 px-6 text-lg bg-purple-400 text-purple-800 hover:bg-purple-300 rounded">Get Started</a>
      </div>
      <div class="md:w-1/2">
        <img src="https://images.unsplash.com/photo-1485988412941-77a35537dae4?ixlib=rb-1.2.1&ixid=MXwxMjA3fDB8MHxzZWFyY2h8M3x8Y29tcHV0ZXJzfGVufDB8fDB8&auto=format&fit=crop&w=500&q=60" alt="Computer" class="w-full rounded shadow-2xl">	
      </div>
    </div>
    <!-- features -->
    <div class="md:flex py-16 px-10 bg-indigo-800 text-indigo-200 text-center">
      
      <div class="md:mr-2 mb-2">
        <img src="https://images.unsplash.com/photo-1548611635-b6e7827d7d4a?ixlib=rb-1.2.1&ixid=MXwxMjA3fDB8MHxzZWFyY2h8OHx8Y29tcHV0ZXJzfGVufDB8fDB8&auto=format&fit=crop&w=500&q=60" alt="laptop" class="w-full rounded mb-4 border-solid border-2 border-indigo-400">
      </div>
      
      <div class="md:mr-2 mb-2 md:mt-8">
        <img src="https://images.unsplash.com/photo-1497296805880-3b37686c87ea?ixlib=rb-1.2.1&ixid=MXwxMjA3fDB8MHxzZWFyY2h8MTB8fGNvbXB1dGVyc3xlbnwwfHwwfA%3D%3D&auto=format&fit=crop&w=500&q=60" alt="a desktop" class="w-full rounded mb-4 border-solid border-2 border-indigo-400">
      </div>
      
      <div class="md:mr-2 mb-2">
        <img src="https://images.unsplash.com/photo-1527792492728-08d07d011113?ixlib=rb-1.2.1&ixid=MXwxMjA3fDB8MHxzZWFyY2h8Mjl8fGNvbXB1dGVyc3xlbnwwfHwwfA%3D%3D&auto=format&fit=crop&w=500&q=60" alt="a girl working on laptop" class="w-full rounded mb-4 border-solid border-2 border-indigo-400">
      </div>
      
      <div class="md:mr-2 mb-2 md:mt-8">
        <img src="https://images.unsplash.com/photo-1545254930-06c375090cbe?ixlib=rb-1.2.1&ixid=MXwxMjA3fDB8MHxzZWFyY2h8MzR8fGNvbXB1dGVyc3xlbnwwfHwwfA%3D%3D&auto=format&fit=crop&w=500&q=60" alt="video editing on desktop" class="w-full rounded mb-4 border-solid border-2 border-indigo-400">
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