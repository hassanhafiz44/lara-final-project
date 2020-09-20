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
                $total = 0;

                $quantity_errors = [];

                for ($i = 0; $i < $count_products; $i++) {
                    $products[] = [
                        'product_id' => $request->product_ids[$i],
                        'quantity' => $request->product_quantities[$i]
                    ];

                    $product = Product::find($request->product_ids[$i]);
                    $total += $product->price;

                    if ($product->quantity < $request->product_quantities[$i]) {
                        $quantity_errors[] = [
                            'product' => $product,
                            'msg' => 'quantity error'
                        ];
                        continue;
                    }
                    $product->quantity = $product->quantity - $request->product_quantities[$i];

                    $product->save();
                }
                if (sizeof($quantity_errors) > 0)
                    return response()->json(['errors' => $quantity_errors], 200);

                $trans_success = InvoiceProduct::insert($products);
                if ($trans_success === TRUE)
                    $trans_success = Invoice::insert([
                        'customer_id' => auth('customers')->id(),
                        'payment_status' => 'due',
                        'invoice_status' => 'processing',
                        'total' => $total
                    ]);
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
