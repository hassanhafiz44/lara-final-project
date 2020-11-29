<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Invoice;
use App\Transaction;
use App\Product;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AdminInvoicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $data['customer_id'] = "";
        $data['payment_status'] = "";
        $data['invoice_status'] = "";
        $data['start_date'] = date('Y-m-01');
        $data['end_date'] = date('Y-m-t');

        // To select customer for filteration
        $customers_dropdown_data = Customer::select(['id', 'name', 'email'])->get();
        
        $invoices = Invoice::orderByDesc('created_at');
        if($request->filled('customer_id')) {
            $invoices = $invoices->where('customer_id', '=', $request->customer_id);
            $data['customer_id'] = $request->customer_id;
        }
        
        // Filteration
        if($request->filled('payment_status')) {
            $invoices = $invoices->where('payment_status', '=', $request->payment_status);
            $data['payment_status'] = $request->payment_status;
        }

        if($request->filled('start_date') && $request->filled('end_date')) {
            $data['start_date'] = $request->start_date;
            $data['end_date'] = $request->end_date;
        }

        if($request->filled('invoice_status')) {
            $data['invoice_status'] = $request->invoice_status;
            $invoices = $invoices->where('invoice_status', '=', $request->invoice_status);
        }

        // must include date filter in query
        $invoices = $invoices->whereBetween(DB::raw('DATE(created_at)'), [$data['start_date'], $data['end_date']]);

        $invoices = $invoices->paginate(10);

        $data['title'] = 'Invoices';
        $data['invoices'] = $invoices;
        $data['customers_dropdown_data'] = $customers_dropdown_data;

        return view('admin.invoices.index')->with($data);
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
        try {
            $invoice = Invoice::findOrFail($id);
            $total_quantity = DB::table('invoice_products')->where('invoice_id', '=', $id)->sum('quantity');
            $total_price = DB::table('invoice_products')->where('invoice_id', '=', $id)->sum('price');
            $total_retail_price = DB::table('invoice_products')->where('invoice_id', '=', $id)->sum('retail_price');
            
            $company = DB::table('companies')->first(['title', 'email', 'phone', 'mobile', 'address']);
            $customer = $invoice->customer;
            return view('admin.invoices.show')->with([
                'invoice'                       => $invoice, 
                'total_quantity'                => $total_quantity,
                'total_price'                   => $total_price,
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

    public function change_payment_status(Request $request)
    {
        try {
            $invoice = Invoice::findOrFail($request->invoice_id);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                    'message' => "Invoice not found"
            ], 404);
        }

        try {

            if($invoice->invoice_status === 'canceled') {
                if($request->payment_status === 'paid') {
                    return response()->json([
                        'message' => 'Invoice is cancelled cannot set payment status to paid',
                    ], 400);
                }
            }

            if($invoice->invoice_status === "delivered") {
                if($request->payment_status === "due") {
                    return response()->json([
                            'message' => "Cannot change status to due. Products are delivered."
                    ], 400);
                }
            }

            DB::beginTransaction();
            // Change invoice payment status
            $invoice->payment_status = $request->payment_status;
            $invoice->save();

            if($invoice->payment_status === "paid")
            {
                $transaction = Transaction::create([
                    'type' => 'income',
                    'description' => 'customer_payment',
                    'invoice_id' => $invoice->id,
                    'amount' => $invoice->price_total,
                    'retail_amount' => $invoice->retail_price_total,
                ]);
            } else {
                $deltedRows = Transaction::where('invoice_id', $invoice->id)->delete();
            }

            DB::commit();

            return response()->json([
                'payment_status' => $invoice->payment_status,
                'message' => 'Changed payment status',
            ], 200);
        } catch(Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => "Something went wrong"
            ], 500);
        }
    }

    public function change_invoice_status(Request $request) 
    {
        try {
            $invoice = Invoice::findOrFail($request->invoice_id);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                    'message' => "Invoice not found"
            ], 404);
        }

        try {

            if($invoice->invoice_status === 'canceled') {
                return response()->json([
                    'message' => 'Invoice is cancelled, cannot change its status',
                ], 400);
            }

            if($invoice->payment_status === 'due') {
                if($request->invoice_status === 'delivered')
                    return response()->json([
                            'message' => "Cannot changed status to delivered. Make payment first"
                    ], 400);
            }

            $invoice->invoice_status = $request->invoice_status;
            $invoice->cancelled_by = NULL;

            if($request->invoice_status === 'canceled') {
                $invoice->cancelled_by = 'user';

                // Return stock to the inventory
                foreach($invoice->products as $product) {
                    $original_product = Product::find($product->product_id);
                    $original_product->quantity += $product->quantity;
                    $original_product->save();
                }
            }

            $invoice->save();
            return response()->json([
                'invoice_status' => $invoice->invoice_status,
                'message' => 'Changed invoice status',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => "Something went wrong"
            ],500);
        }
    }
}
