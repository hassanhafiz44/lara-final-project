<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\Product;
use App\ProductCategory;
use App\Transaction;
use DateTime;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('auth');
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function index()
  {
    // Dates
    
    $data = array('title' => 'Dashboard');
    
    return view('dashboard')->with($data);
  }
  
  function initialize_dashboard()
  {
    $date = new DateTime();
    $last_date_of_month = $date->modify('last day of this month')->format("Y-m-d");
    $first_date_of_month = $date->modify('first day of this month')->format("Y-m-d");
    
    $products = Product::all();
    
    // Invoices
    $data['today_invoices'] = DB::table('invoices')->where(DB::raw('DATE(`created_at`)'), '=', date('Y-m-d'))->get();
    $data['today_sales'] = 0;
    foreach($data['today_invoices'] as $invoice) {
      $data['today_sales'] += $invoice->retail_price_total;
    }
    $data['no_today_invoices'] = count($data['today_invoices']);
    
    $data['month_invoices'] = DB::table('invoices')->where(DB::raw("DATE(`created_at`)"), ">=",  $first_date_of_month)
    ->where(DB::raw("DATE(`created_at`)"), "<=", $last_date_of_month)->get();
    $data['no_month_invoices'] = count($data['month_invoices']);
    $data['month_sales'] = 0;

    foreach($data['month_invoices'] as $invoice) {
      $data['month_sales'] += $invoice->retail_price_total;
    }

    // Charts
    // Category chart
    $categories = ProductCategory::all();
    $products_by_cat = [];
    foreach($categories as $key => $category) {
      $products_by_cat[$key]['name'] = $category->title;
      $products_by_cat[$key]['y'] = 0;
      foreach($category->products as $product) {
        $products_by_cat[$key]['y'] += $product->quantity;
      }
    }
    $data['products_by_cat'] = $products_by_cat;

    // Income vs Expense Chart
    $income = Transaction::where('type', 'income')->sum('amount');
    $expense = Transaction::where('type', 'expense')->sum('amount');

    $data['income_expense'] = [
      ['name' => 'Income', 'y' => $income],
      ['name' => 'Expense', 'y' => $expense]
    ];
    
    // Charts end

    $recent_invoices = Invoice::orderBy('created_at', 'desc')
      ->groupBy('customer_id')->take(10)->get();
    $data['recent_buyers'] = [];
    foreach($recent_invoices as $invoice) {
      $data['recent_buyers'][] = $invoice->customer;
    }

    $current_stock_worth = 0;
    $current_stock_retail_worth = 0;
    
    foreach($products as $product) {
      $current_stock_worth += $product->quantity * $product->price;
      $current_stock_retail_worth += $product->quantity * $product->retail_price;
    }

    $data['current_stock_worth'] = $current_stock_worth;
    $data['current_stock_retail_worth'] = $current_stock_retail_worth;

    $data['products_count'] = count($products);
    //     echo "<pre>";
    //     var_export($data);
    //     echo "</pre>";
    
    // die();
    return response()->json($data, 200);
  }
}
