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

// Customer authentication
Route::prefix('/customers')->name('customers.')->namespace('Customers\Auth')->group(function () {
    Route::get('/login', 'LoginController@showLoginForm')->name('login');
    Route::post('/login', 'LoginController@login')->name('login.attempt');
    Route::post('/logout', 'LoginController@logout')->name('logout');
    Route::get('/register', 'RegisterController@showRegistrationForm')->name('register');
    Route::post('/register', 'RegisterController@register');
});

// User authentication
Route::prefix('/users')->name('users.')->namespace('Auth')->group(function () {
    Route::get('/login', 'LoginController@showLoginForm')->name('login');
    Route::post('/login', 'LoginController@login')->name('login.attempt');
    Route::post('/logout', 'LoginController@logout')->name('logout');
    Route::get('/password/confirm', "ConfirmPasswordController@showConfirmForm")->name('password.confirm');
    Route::post('/password/confirm', "ConfirmPasswordController@confirm");
});

// Pages Routes
Route::prefix('/pages')->name('pages.')->group(function () {
    Route::get('/products', 'PagesController@products')->name('products');
    Route::get('/services', 'PagesController@services')->name('services');
    Route::get('/about', 'PagesController@about')->name('about');
    Route::get('/contact', 'PagesController@contact')->name('contact')->middleware('auth:customers');
    Route::resource('invoices', 'InvoicesController')->middleware('auth:customers');
    Route::post('/submit-contact-us', 'PagesController@submit_contact_us')->name('submit.contact.us');
});

// Home when not logged in
Route::get('/', 'PagesController@index')->name('pages.index');

// Admin routes
Route::prefix('/admin')->name('admin.')->group(function () {
    Route::resource('employees', 'EmployeesController');
    Route::resource('crm', 'CrmController');
    Route::resource('product_categories', 'ProductCategoriesController');
    Route::resource('products', 'ProductsController');
    Route::resource('invoices', 'AdminInvoicesController');
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard.index');
    Route::post('/dashboard/initialize', 'DashboardController@initialize_dashboard')->name('dashboard.initialize');
    Route::post('/invoices/change-payment-status', 'AdminInvoicesController@change_payment_status')->name('invoice.change.payment.status');
    Route::post('/invoices/change-invoice-status', 'AdminInvoicesController@change_invoice_status')->name('invoice.change.invoice.status');
    Route::post('/crm/set_inactive', 'CrmController@set_inactive')->name('crm.set.inactive');
    Route::post('/crm/set_active', 'CrmController@set_active')->name('crm.set.active');
});
