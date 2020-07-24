<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Route::get('/dashboard', function () {
    return view('dashboard');
});






Route::get('profile','Employees@profile');
Route::post('loginsubmit','Employees@loginaction');
Route::get('contact','Employees@contact');
Route::get('home','Employees@home');
Route::get('products','Employees@products');
Route::get('services','Employees@services');
Route::get('login','Employees@adminlogin');
Route::get('inventory','Employees@inventory');
Route::get('dashboard','Employees@dashboard');
Route::get('orders','Employees@orders');


