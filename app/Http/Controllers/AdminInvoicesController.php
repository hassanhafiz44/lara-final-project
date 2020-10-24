<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Invoice;
use App\Transaction;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AdminInvoicesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $invoices = Invoice::all();
        $data = [
            'title' => 'Invoices',
            'invoices' => $invoices
        ];

        return view('admin.invoices')->with($data);
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

    public function change_payment_status(Request $request)
    {
        try {
            $invoice = Invoice::findOrFail($request->invoice_id);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => [
                    'message' => "Invoice not found"
                ]
            ], 404);
        }

        try {
            if($invoice->invoice_status === "delivered") {
                if($request->payment_status === "due") {
                    return response()->json([
                        'error' => [
                            'message' => "Cannot change status to due. Products are delivered."
                        ]
                    ], 400);
                }
            }

            DB::beginTransaction();
            // Change invoice payment status
            $invoice->payment_status = $request->payment_status;
            $invoice->save();

            $transaction = new Transaction();
            if($invoice->payment_status === "paid")
            {
                $transaction->type = 'income';
                $transaction->description = 'customer_payment';
                $transaction->invoice_id = $invoice->id;
                $transaction->amount = $invoice->retail_price_total;
                $transaction->save();
            } else {
                $transaction->type = 'expense';
                $transaction->description = 'customer_payment';
                $transaction->invoice_id = $invoice->id;
                $transaction->amount = $invoice->retail_price_total;
                $transaction->save();
            }
            DB::commit();

            return response()->json([
                'type' => $transaction->type,
                'payment_status' => $invoice->payment_status
            ], 200);
        } catch(Exception $e) {
            DB::rollBack();
            return response()->json([
                'error' => [
                    'message' => "Something went wrong"
                ]
            ],500);
        }
    }

    public function change_invoice_status(Request $request) 
    {
        try {
            $invoice = Invoice::findOrFail($request->invoice_id);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => [
                    'message' => "Invoice not found"
                ]
            ], 404);
        }

        try {
            if($invoice->payment_status === 'due') {
                if($request->invoice_status === 'delivered')
                    return response()->json([
                        'error' => [
                            'message' => "Cannot changed status to delivered. Make payment first"
                        ]
                    ], 400);
            }

            $invoice->invoice_status = $request->invoice_status;
            $invoice->save();
            return response()->json([
                'invoice_status' => $invoice->invoice_status
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => [
                    'message' => "Something went wrong"
                ]
            ],500);
        }
    }
}
