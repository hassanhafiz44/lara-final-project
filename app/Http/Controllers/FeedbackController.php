<?php

namespace App\Http\Controllers;

use App\Customer;
use App\CustomerFeedbacks;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FeedbackController extends Controller
{
    //
    /**
     * @param Illuminate\Http\Request
     * 
     * @return Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = ['title' => 'Customer Feedbacks'];

        // Filters data
        $data['status'] = "";
        $data['start_date'] = date('Y-m-01');
        $data['end_date'] = date('Y-m-t');

        $feedbacks = CustomerFeedbacks::orderByDesc('created_at');

        if($request->filled('status')) {
            $feedbacks = $feedbacks->where('status', '=', $request->status);
            $data['status'] = $request->status;
        }

        if($request->filled('start_date') && $request->filled('end_date')) {
            $data['start_date'] = $request->start_date;
            $data['end_date'] = $request->end_date;
        }

        $feedbacks = $feedbacks->whereBetween(DB::raw('DATE(created_at)'), [$data['start_date'], $data['end_date']]);

        $data['feedbacks'] = $feedbacks->get();

        return view('admin.feedbacks.index')->with($data);
    }

    /**
     * @param int $id
     * 
     * @return Illuminate\Http\Request
     */
    public function get_customer_feedbacks($id)
    {
        try {
            $customer = Customer::findOrFail($id);

            // Marks all feedbacks as read
            CustomerFeedbacks::where('customer_id', '=', $id)
                ->update(['status' => 'read']);
            
            $data = ['title' => "$customer->name's Feedbacks"];
            $data['customer'] = $customer;
            $data['feedbacks'] = CustomerFeedbacks::where('customer_id', '=', $id)
                ->orderByDesc('created_at')
                ->get();

            return view('admin.feedbacks.customer')->with($data);
        } catch(ModelNotFoundException $e) {
            abort(404, $e->getMessage());
        }
    }

    public function mark_unread_by_customer($id) 
    {
        try {
            $customer = Customer::findOrFail($id);
            CustomerFeedbacks::where('customer_id', '=', $id)
                ->update(['status' => 'unread']);

            return redirect()->route('admin.feedback.index')->with('message', "Marked all feedbacks unread for $customer->email");
        } catch (ModelNotFoundException $e) {
            abort(404, $e->getMessage());
        }
    }
}
