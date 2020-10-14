<?php

use Illuminate\Support\Facades\Auth;
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



Route::prefix('/customers')->name('customers.')->namespace('Customers\Auth')->group(function () {
    Route::get('/login', 'LoginController@showLoginForm')->name('login');
    Route::post('/login', 'LoginController@login')->name('login.attempt');
    Route::post('/logout', 'LoginController@logout')->name('logout');
    Route::get('/register', 'RegisterController@showRegistrationForm')->name('register');
    Route::post('/register', 'RegisterController@register');
});

Route::prefix('/users')->name('users.')->namespace('Auth')->group(function () {
    Route::get('/login', 'LoginController@showLoginForm')->name('login');
    Route::post('/login', 'LoginController@login')->name('login.attempt');
    Route::post('/logout', 'LoginController@logout')->name('logout');
    Route::get('/register', 'RegisterController@showRegistrationForm')->name('register');
    Route::post('/register', 'RegisterController@register');
});

// Pages Routes
Route::prefix('/pages')->name('pages.')->group(function () {
    Route::get('/products', 'PagesController@products')->name('products');
    Route::get('/services', 'PagesController@services')->name('services');
    Route::get('/about', 'PagesController@about')->name('about');
    Route::get('/contact', 'PagesController@contact')->name('contact');
    Route::resource('invoices', 'InvoicesController');
});

Route::get('/', 'PagesController@index')->name('pages.index');

// Route::get('pages/contact', 'PagesController@contact')->name('pages.contact');
// Route::get('pages/products', 'PagesController@products')->name('pages.products');
// Route::get('pages/services', 'PagesController@services')->name('pages.services');
// Route::get('pages/about', 'PagesController@about')->name('pages.about');

// Route::get('/', 'HomeController')->name('home');
// Route::get('/', 'PagesController@index')->name('pages.index');
// Route::get('contact', 'PagesController@contact')->name('pages.contact');
// Route::get('products', 'PagesController@products')->name('pages.products');
// Route::get('services', 'PagesController@services')->name('pages.services');
// Route::get('about', 'PagesController@about')->name('pages.about');

// Route::get('profile','Employees@profile');
// Route::post('loginsubmit','Employees@loginaction');
// Route::get('login','Employees@adminlogin');
// Route::get('inventory','Employees@inventory');
// Route::get('dashboard','Employees@dashboard');
// Route::get('orders','Employees@orders');



//Auth::routes();

Route::prefix('/admin')->name('admin.')->group(function () {

    Route::resource('employees', 'EmployeesController');
    Route::resource('product_categories', 'ProductCategoriesController');
    Route::resource('products', 'ProductsController');
    Route::resource('invoices', 'AdminInvoicesController');
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard.index');
    Route::post('/invoices/change-payment-status', 'AdminInvoicesController@change_payment_status')->name('invoice.change.payment.status');
});
