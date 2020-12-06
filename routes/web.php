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

Route::get('/testing', function() {
    $string = "'active' => 'Active','add_product' => 'Add Product','address' => 'Address','cancelled' => 'Cancelled','cnic' => 'CNIC','customer' => 'Customer','customer_status' => 'Customer Status','delivered' => 'Delivered','due' => 'Due','email' => 'Email','image' => 'Image','inactive' => 'Inactive','invoice_date' => 'Invoice Date','invoice_status' => 'Invoice Status','model' => 'Model','month_invoices' => 'Month Invoices','month_sales' => 'Month Sales','name' => 'Name','paid' => 'Paid','payment_status' => 'Payment Status','phone' => 'Phone','price' => 'Price','processing' => 'Processing','quantity' => 'Quantity','ready' => 'Ready','retail_price' => 'Retail Price','serial_no' => 'Serial No.','serial_no_short' => 'SN','status' => 'Status','title' => 'Title','today_invoices' => 'Today Invoices','today_sales' => 'Today Sales',
    'no_of_products_by_categories' => 'No. of Products by Categories',
    'income_vs_expense_pkr' => 'Income VS Expense (PKR)',
    'income' => 'Income',
    'expense' => 'Expense',
    'recent_buyers' => 'Recent Buyers',
    'summary' => 'Summary',
    'current_stock_worth' => 'Current Stock Worth',
    'current_stock_retail_worth' => 'Current Stock Retail Worth',
    'current_profit_worth' => 'Current Profit Worth',
    'profit' => 'Profit',
    'retail' => 'Retail',
    'category' => 'Category',
    'pkr' => 'PKR',
    'products' => 'Products',
    'set_active' => 'Set Active',
    'set_inactive' => 'Set Inactive',
    'paid_invoices' => 'Paid Invoices',
    'unpaid_invoices' => 'Unpaid Invoices',
    'add_category' => 'Add Category',
    'submit' => 'Submit',
    'description' => 'Description',
    'close' => 'Close',
    'update_invoice' => 'Update Invoice',
    'product_name' => 'Product Name',
    'total_price' => 'Total Price',
    'total_retail_price' => 'Total Retail Price',
    'grand_total' => 'Grand Total',
    'change_invoice_status' => 'Change Invoice Status',
    'company_details' => 'Company Details',
    'customer_details' => 'Customer Details'";
    $chunks = array_map('trim', explode(',', $string));
    sort($chunks);
    $string = implode(",", $chunks);
    return $string;
});

// Customer authentication
Route::prefix('/customers')->name('customers.')->namespace('Customers\Auth')->group(function () {
    Route::get('/login', 'LoginController@showLoginForm')->name('login');
    Route::post('/login', 'LoginController@login')->name('login.attempt');
    Route::post('/logout', 'LoginController@logout')->name('logout');
    Route::get('/register', 'RegisterController@showRegistrationForm')->name('register');
    Route::post('/register', 'RegisterController@register');
});


// Customer password reset
Route::prefix('/customers')->name('customers.')->group(function() {
    Route::get('/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('showResetForm');
    Route::get('/reset/email/{user_type}', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('showResetEmailForm');
    Route::post('/reset', 'Auth\ResetPasswordController@reset')->name('password.update');
});

// Password reset
Route::prefix('/password')->name('password.')->group(function() {
    Route::post('/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('email');
    Route::get('/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('request');
    Route::post('/reset', 'Auth\ResetPasswordController@reset')->name('update');
    Route::get('/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('reset');
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
    Route::get('/contact', 'PagesController@contact')->name('contact');
    Route::resource('invoices', 'InvoicesController')->middleware('auth:customers');
    Route::post('/invoices/change-invoice-status', 'InvoicesController@change_invoice_status')->name('invoices.change.invoice.status')->middleware('auth:customers');
    Route::post('/submit-contact-us', 'PagesController@submit_contact_us')->name('submit.contact.us');
    Route::post('/products/initialize', 'PagesController@initialize_products')->name('products.initialize');
});

// Home when not logged in
Route::get('/', 'PagesController@index')->name('pages.index');

// Admin routes
Route::middleware('auth')->prefix('/admin')->name('admin.')->group(function () {
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
    Route::get('/reports/stock-in-hand', 'ReportsController@stock_in_hand')->name('reports.stock.in.hand');
    Route::get('/reports/low-stock', 'ReportsController@low_stock')->name('reports.low.stock');
    Route::get('/reports/sales-summary', 'ReportsController@sales_summary')->name('reports.sales.summary');
});