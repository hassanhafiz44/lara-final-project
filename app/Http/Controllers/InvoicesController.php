<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\InvoiceProduct;
use App\Invoice;
use App\Product;

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
        $invoices = Invoice::where('customer_id', $customer_id)->get();
        $data = [
            'title' => 'Customer Invoices',
            'invoices' => $invoices
        ];
        return view('customers.invoices')->with($data);
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
                $count_products = sizeof($request->product_ids);

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
                        for ($i = 0; $i < $count_products; $i++) {
                    
                            $product = Product::find($request->product_ids[$i]);

                            $products[] = [
                        'product_id' => $product->id,
                        'invoice_id' => $invoice_id,
                        'quantity' => $request->product_quantities[$i],
                        'price' => $product->price,
                        'retail_price' => $product->retail_price,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    ];

                    // Prepare total prices to insert in invoices totals
                    $price_total += ($product->price * $request->product_quantities[$i]);
                    $retail_price_total += ($product->retail_price * $request->product_quantities[$i]);

                    // over quantity errors
                    if ($product->quantity < $request->product_quantities[$i]) {
                        $quantity_errors[] = [
                            'product' => $product,
                            'msg' => 'quantity error'
                        ];
                        continue;
                    }

                    // manage inventory
                    $product->quantity = $product->quantity - $request->product_quantities[$i];
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
}
