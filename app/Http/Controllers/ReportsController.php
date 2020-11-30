<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\Product;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportsController extends Controller
{
    //
    public function stock_in_hand()
    {
        $products = Product::paginate(10);
        $stock_quantity = Product::sum('quantity');
        $stock_retail_worth = Product::sum('retail_price');
        $stock_worth = Product::sum('price');
        $stock_profit = Product::sum(DB::raw('retail_price - price'));


        $data = [
            'products' => $products,
            'stock_quantity' => $stock_quantity,
            'stock_worth' => $stock_worth,
            'stock_retail_worth' => $stock_retail_worth,
            'stock_profit' => $stock_profit,
        ];

        return view('admin.reports.stockinhand', $data);
    }


    public function low_stock()
    {
        $products = Product::where('quantity', '<=', 10)->paginate(10);
        $no_of_low_products = Product::where('quantity', '<=', 10)->count();
        $stock_worth = Product::where('quantity', '<=', 10)->sum('price');

        $data = [
            'products' => $products,
            'no_of_low_products' => $no_of_low_products,
            'stock_worth' => $stock_worth,
        ];

        return view('admin.reports.lowstock', $data);
    }


    public function sales_summary(Request $request)
    {
        // Filter data
        $data['start_date'] = date('Y-m-01');
        $data['end_date'] = date('Y-m-t');
        $data['pre_start_date'] = date('Y-m-01', strtotime('-1 months'));
        $data['pre_end_date'] = date('Y-m-t', strtotime('-1 months'));

        $this->start = $data['start_date'];
        $this->end = $data['end_date'];
        $this->pre_start = $data['pre_start_date'];
        $this->pre_end = $data['pre_end_date'];

        // Current stats
        // Get number of invoices by different statuses
        $data['no_invoices'] = $this->filter_applied($this->date_filter_applied())->count();
        $data['no_cancelled_invoices'] = $this->filter_applied($this->date_filter_applied(), 'canceled')->count();
        $data['no_delivered_invoices'] = $this->filter_applied($this->date_filter_applied(), 'delivered')->count();
        $data['no_other_invoices'] = $this->filter_applied($this->date_filter_applied(), 'not delivered not canceled', 'due')->count();

        // // amounts
        $data['amount_received'] = $this->filter_applied($this->date_filter_applied(), 'not canceled', 'paid')->sum('retail_price_total');
        $data['amount_to_receive'] = $this->filter_applied($this->date_filter_applied(), 'not canceled', 'due')->sum('retail_price_total');
        $data['profit_received'] = $this->filter_applied($this->date_filter_applied(), 'delivered')->sum(DB::raw('retail_price_total - price_total'));
        $data['profit_to_receive'] = $this->filter_applied($this->date_filter_applied(), 'not canceled', 'due')->sum(DB::raw('retail_price_total - price_total'));
        $data['amount_used'] = $this->filter_applied($this->date_filter_applied(), 'not canceled')->sum('price_total');

        // Previous Stats
        // Get number of invoices by different statuses
        $data['pre_no_invoices'] = $this->filter_applied($this->pre_date_filter_applied())->count();
        $data['pre_no_cancelled_invoices'] = $this->filter_applied($this->pre_date_filter_applied(), 'canceled')->count();
        $data['pre_no_delivered_invoices'] = $this->filter_applied($this->pre_date_filter_applied(), 'delivered')->count();
        $data['pre_no_other_invoices'] = $this->filter_applied($this->pre_date_filter_applied(), 'not delivered not canceled', 'due')->count();

        // // amounts
        $data['pre_amount_received'] = $this->filter_applied($this->pre_date_filter_applied(), 'not canceled', 'paid')->sum('retail_price_total');
        $data['pre_amount_to_receive'] = $this->filter_applied($this->pre_date_filter_applied(), 'not canceled', 'due')->sum('retail_price_total');
        $data['pre_profit_received'] = $this->filter_applied($this->pre_date_filter_applied(), 'delivered')->sum(DB::raw('retail_price_total - price_total'));
        $data['pre_profit_to_receive'] = $this->filter_applied($this->pre_date_filter_applied(), 'not canceled', 'due')->sum(DB::raw('retail_price_total - price_total'));
        $data['pre_amount_used'] = $this->filter_applied($this->pre_date_filter_applied(), 'not canceled')->sum('price_total');

        // Difference of previous month to current month
        $data['diff_no_invoices'] =             $data['no_invoices'] - $data['pre_no_invoices'];
        $data['diff_no_cancelled_invoices'] =   $data['no_cancelled_invoices'] - $data['pre_no_cancelled_invoices'];
        $data['diff_no_delivered_invoices'] =   $data['no_delivered_invoices'] - $data['pre_no_delivered_invoices'];
        $data['diff_no_other_invoices'] =       $data['no_other_invoices'] - $data['pre_no_other_invoices'];
        $data['diff_amount_received'] =         $data['amount_received'] - $data['pre_amount_received'];
        $data['diff_amount_to_receive'] =       $data['amount_to_receive'] - $data['pre_amount_to_receive'];
        $data['diff_profit_received'] =         $data['profit_received'] - $data['pre_profit_received'];
        $data['diff_profit_to_receive'] =       $data['profit_to_receive'] - $data['pre_profit_to_receive'];
        $data['diff_amount_used'] =             $data['amount_used'] - $data['pre_amount_used'];

        // Remarks
        $data['no_invoices_remark'] = ($data['diff_no_invoices'] > 0) ? __('messages.sale_increased') : __('messages.sale_decreased');
        $data['no_cancelled_invoices_remark'] = ($data['diff_no_cancelled_invoices'] > 0) ? __('messages.invoice_cancel_increased') : __('messages.invoice_cancel_decreased');
        $data['no_delivered_invoices_remark'] = ($data['diff_no_delivered_invoices'] > 0) ? __('messages.delivery_increased') : __('messages.delivery_decreased');
        $data['no_other_invoices_remark'] = ($data['diff_no_other_invoices'] > 0) ? __('messages.invoice_others_increased') : __('messages.invoice_others_decreased');
        $data['amount_received_remark'] = ($data['diff_amount_received'] > 0) ? __('messages.amount_received_increased') : __('messages.amount_received_decreased');
        $data['amount_to_receive_remark'] = ($data['diff_amount_to_receive'] > 0) ? __('messages.amount_to_receive_increased') : __('messages.amount_to_receive_decreased');
        $data['profit_received_remark'] = ($data['diff_profit_received'] > 0) ? __('messages.profit_received_increased') : __('messages.profit_received_decreased');
        $data['profit_to_receive_remark'] = ($data['diff_profit_to_receive'] > 0) ? __('messages.profit_to_receive_increased') : __('messages.profit_to_receive_decreased');
        $data['amount_used_remark'] = ($data['diff_amount_used'] > 0) ? __('messages.amount_used_increased') : __('messages.amount_used_decreased');

        return view('admin.reports.salessummary', $data);
    }


    private function date_filter_applied() 
    {
        return Invoice::whereBetween(DB::raw('DATE(created_at)'), [$this->start, $this->end]);
    }

    private function pre_date_filter_applied()
    {
        return Invoice::whereBetween(DB::raw('DATE(created_at)'), [$this->pre_start, $this->pre_end]);
    }

    private function filter_applied($query, string $invoice_status = NULL, string $payment_status = NULL)
    {
        if(!is_null($invoice_status)) {
            switch ($invoice_status) {
                case 'not canceled':
                    $query = $query->where('invoice_status', '!=', 'canceled');
                    break;
                case 'not delivered':
                    $query = $query->where('invoice_status', '!=', 'delivered');
                    break;
                case 'canceled':
                    $query = $query->where('invoice_status', '=', 'canceled');
                    break;
                case 'processing':
                    $query = $query->where('invoice_status', '=', 'processing');
                    break;
                case 'ready':
                    $query = $query->where('invoice_status', '=', 'ready');
                    break;
                case 'delivered':
                    $query = $query->where('invoice_status', '=', 'delivered');
                    break;
                case 'not delivered not canceled':
                    $query = $query->where('invoice_status', '!=', 'delivered')
                        ->where('invoice_status', '!=', 'canceled');
                    break;
            }
        }

        if(!is_null($payment_status)) {
            switch ($payment_status) {
                case 'paid':
                    $query = $query->where('payment_status', '=', 'paid');
                    break;
                case 'due':
                    $query = $query->where('payment_status', '=', 'due');
                    break;
            }
        }

        return $query;
    }
}
