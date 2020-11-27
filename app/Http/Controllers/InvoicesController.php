<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\InvoiceProduct;
use App\Invoice;
use App\Product;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class InvoicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $customer_id = auth('customers')->id();
        $invoices = Invoice::where('customer_id', $customer_id)->paginate(10);
        $data = [
            'title' => 'Customer Invoices',
            'invoices' => $invoices
        ];
        return view('customers.invoices.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        if (auth('customers')->check()) {
            $trans_success = TRUE;

            DB::beginTransaction();
            try {

                $products = [];
                $price_total = 0;
                $retail_price_total = 0;

                $quantity_errors = [];

                // Make an invoice
                if ($trans_success === TRUE)
                    $trans_success = Invoice::insert([
                        'customer_id' => auth('customers')->id(),
                        'payment_status' => 'due',
                        'invoice_status' => 'processing',
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    ]);
                        
                if ($trans_success === TRUE)
                    $invoice_id = DB::getPdo()->lastInsertId();

                // Get products from database and prepare data to insert in invoice_products table
                foreach($request->data as $key => $p) {
                    
                    $product = Product::find($p['id']);

                    $products[] = [
                        'product_id' => $product->id,
                        'invoice_id' => $invoice_id,
                        'quantity' => $p['quantity'],
                        'price' => $product->price,
                        'retail_price' => $product->retail_price,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    ];

                    // Prepare total prices to insert in invoices totals
                    $price_total += ($product->price * $p['quantity']);
                    $retail_price_total += ($product->retail_price * $p['quantity']);

                    // over quantity errors
                    if ($product->quantity < $p['quantity']) {
                        $quantity_errors[] = [
                            'product' => $product,
                            'msg' => 'quantity error'
                        ];
                        continue;
                    }

                    // manage inventory
                    $product->quantity = $product->quantity - $p['quantity'];
                    $product->save();
                }

                if (sizeof($quantity_errors) >  0) {
                    DB::rollBack();
                    return response()->json(['errors' => $quantity_errors], 200);
                }

                // add total prices to invoice
                if ($trans_success === TRUE)
                    Invoice::where('id', $invoice_id)->update(['price_total' => $price_total, 'retail_price_total' => $retail_price_total]);

                // insert invoice products
                if ($trans_success === TRUE)
                    $trans_success = InvoiceProduct::insert($products);

                if ($trans_success === TRUE) {
                    DB::commit();
                    return response()->json($request);
                } else {
                    DB::rollBack();
                    return response()->json(['msg' => 'transaction could not be completed.'], 400);
                }
                return response()->json($request);
            } catch (\Exception $e) {
                DB::rollBack();
                return response()->json($e, 500);
            }
        }
        return response()->json(['msg' => 'Customer must be logged in to buy.'], 401);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        try {
            $invoice = Invoice::where('id', '=', $id)->where('customer_id', '=', auth('customers')->id())->first();

            // If 
            if(is_null($invoice))
                throw new ModelNotFoundException("Error Processing Request", 1);
                
            $total_quantity = DB::table('invoice_products')->where('invoice_id', '=', $id)->sum('quantity');
            // retail price included only
            $total_retail_price = DB::table('invoice_products')->where('invoice_id', '=', $id)->sum('retail_price');
            
            $company = DB::table('companies')->first(['title', 'email', 'phone', 'mobile', 'address']);
            $customer = $invoice->customer;
            return view('customers.invoices.show')->with([
                'invoice'                       => $invoice, 
                'total_quantity'                => $total_quantity,
                'total_retail_price'            => $total_retail_price,
                'company'                       => $company,
                'customer'                      => $customer,
            ]);
        } catch(ModelNotFoundException $e){
            abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function change_invoice_status(Request $request)
    {
        try {
            $invoice = Invoice::where('id', '=', $request->invoice_id)->where('customer_id', '=', auth('customers')->id())->first();

            if($invoice->invoice_status === 'canceled') 
                return response()->json([
                    'message' => 'Invoice is already cancelled',
                ], 400);

            if(is_null($invoice))
                throw new ModelNotFoundException("Invoice not found", 1);
            $invoice->invoice_status = $request->invoice_status;
            $invoice->cancelled_by = 'customer';

            $invoice->save();
            return response()->json(['invoice' => $invoice, 'message' => 'Invoice cancelled']);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                    'message' => "Invoice not found"
            ], 404);
        }
    }
}
