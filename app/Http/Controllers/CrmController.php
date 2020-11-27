<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Invoice;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CrmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $data = array('title' => 'CRM');
        $customers = DB::table('customers as c')
            ->leftJoin('invoices as i', 'c.id' , '=', 'i.customer_id')
            ->select(['c.id', 'c.name', 'c.email', 'c.cnic', 'c.address', 'c.phone', 'c.status', 'i.payment_status']);

        $data['is_active'] = "";
        $data['payment_status'] = "";
        
        if($request->filled('is_active')) {
            $customers = $customers->where('c.status', '=', $request->is_active);
            $data['is_active'] = $request->is_active;
        }
        if($request->filled('payment_status')) {
            $customers = $customers->where('i.payment_status', '=', $request->payment_status);
            $data['payment_status'] = $request->payment_status;
        }
        $customers = $customers->groupByRaw('c.id')->paginate(10);

        $data['customers'] = $customers;
        return view('crm.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        abort(404);
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
        abort(404);
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
        try{
            $customer = Customer::findOrFail($id);
            $paid_invoices = $customer->paid_invoices;
            $unpaid_invoices = $customer->unpaid_invoices;
            $amount_due = $unpaid_invoices->sum('retail_price_total');
            $amount_paid = $paid_invoices->sum('retail_price_total');

            $data['customer'] = $customer;
            $data['paid_invoices'] = $paid_invoices;
            $data['unpaid_invoices'] = $unpaid_invoices;
            $data['amount_due'] = $amount_due;
            $data['amount_paid'] = $amount_paid;


            return view('crm.show', $data);
        } catch (ModelNotFoundException $e) {
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
        abort(404);
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
        abort(404);
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
        abort(404);
    }

    public function set_inactive(Request $request)
    {
       try {
          $customer = Customer::findOrFail($request->id);
          $customer->status = 'inactive';
          $customer->save();
          return response()->json(['message' => 'Status changed to inactive',
             'status' => $customer->status
          ], 200);
       } catch (ModelNotFoundException $e) {
          return response()->json([
                'message' => 'Customer not found'
          ],404);
       }
    }

    public function set_active(Request $request)
    {
       try {
          $customer = Customer::findOrFail($request->id);
          $customer->status = 'active';
          $customer->save();
          return response()->json(['message' => 'Status changed to active',
             'status' => $customer->status
          ], 200);
       } catch (ModelNotFoundException $e) {
          return response()->json([
                'message' => 'Customer not found'
          ],404);
       }
    }
}
