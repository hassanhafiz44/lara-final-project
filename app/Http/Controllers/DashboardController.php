<?php

namespace App\Http\Controllers;

use App\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Product;
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
    $date = new DateTime();
    $last_date_of_month = $date->modify('last day of this month')->format("Y-m-d");
    $first_date_of_month = $date->modify('first day of this month')->format("Y-m-d");
    
    $data = array('title' => 'Dashboard');
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
    
    $data['products_count'] = count($products);
//     echo "<pre>";
//     var_export($data);
//     echo "</pre>";

// die();
    return view('dashboard')->with($data);
  }
}
