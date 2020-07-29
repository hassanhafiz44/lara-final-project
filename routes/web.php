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

// Route::get('/', function () {
//     return view('home');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// });






Route::get('/','PagesController@index')->name('pages.index');
Route::get('contact','PagesController@contact')->name('pages.contact');
Route::get('products','PagesController@products')->name('pages.products');
Route::get('services','PagesController@services')->name('pages.services');
Route::get('about','PagesController@about')->name('pages.about');
// Route::get('profile','Employees@profile');
// Route::post('loginsubmit','Employees@loginaction');
// Route::get('login','Employees@adminlogin');
// Route::get('inventory','Employees@inventory');
// Route::get('dashboard','Employees@dashboard');
// Route::get('orders','Employees@orders');



Auth::routes();

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
