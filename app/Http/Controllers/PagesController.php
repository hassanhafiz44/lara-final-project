<?php

namespace App\Http\Controllers;

use App\Customer;
use App\CustomerFeedback;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PagesController extends Controller
{
	public function __construct()
	{
		// $this->middleware('auth:customers');
	}

	public function index()
	{
		$data = array('title' => 'Home');
		if(Auth::guard('customers')->check()) {
			$data['due_invoices'] = DB::table('invoices')
				->where('customer_id', '=', Auth::guard('customers')->id())
				->where('payment_status','=', 'due')->get();
			$data['paid_invoices'] = DB::table('invoices')
				->where('customer_id', '=', Auth::guard('customers')->id())
				->where('payment_status', '=', 'paid')->get();

			$data['no_canceled_invoices'] = DB::table('invoices')
				->where('customer_id', '=', Auth::guard('customers')->id())
				->where('invoice_status', '=', 'canceled')->count();
				
			$data['no_total_invoices'] = DB::table('invoices')
				->where('customer_id', '=', Auth::guard('customers')->id())->count();

			$data['no_due_invoices'] = count($data['due_invoices']);
			$data['no_paid_invoices'] = count($data['paid_invoices']);

			$paid_total = 0;
			$due_total = 0;

			foreach($data['paid_invoices'] as $invoice) {
				$paid_total += $invoice->retail_price_total;
			}
			foreach($data['due_invoices'] as $invoice) {
				$due_total += $invoice->retail_price_total;
			}

			$data['paid_total'] = $paid_total;
			$data['due_total'] = $due_total;

		}
		// var_dump($data); die();
		return view('pages.home')->with($data);
	}

	function contact()
    {
		$data = array('title' => 'Contract Us');
		$data['customer'] = Auth::guard('customers')->user();
    	return view('pages.contactus')->with($data);
    }

    function products()
    {
		$data = array('title' => 'Products');
		$data['products'] = Product::all();
    	return view('pages.products')->with($data);
	}
	
	public function initialize_products()
	{
		$products = Product::all();
		return response()->json(['products' => $products]);
	}

    function services()
    {
		$data = array('title' => 'Services');
        return view('pages.services')->with($data);
    }

    function about() 
    {
		$data = array('title' => 'About Us');
    	return view('pages.about')->with($data);
	}
	
	function submit_contact_us(Request $request) 
	{
		$result = DB::table('customer_feedbacks')->insert([
			'message' => $request->message,
			'customer_id' => Auth::guard('customers')->id(),
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s')
		]);

		return redirect(route('pages.contact'))->with('message', 'Message sent to admin');
	}
}
