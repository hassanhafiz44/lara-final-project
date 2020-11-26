<?php

use Illuminate\Support\Facades\DB;

if( ! function_exists('get_unread_messages')) {
    function get_unread_messages() {
        return DB::table('customer_feedbacks as cf')
            ->join('customers as c', 'cf.customer_id', '=', 'c.id')
            ->select(['cf.status', 'c.name', 'c.email', 'c.phone', 'cf.message', 'cf.id as mid', 'c.id as cid'])
            ->where('cf.status', '=', 'unread')
            ->groupBy('c.email')
            ->orderBy('cf.created_at', 'desc')
            ->get();
    }
}

if( ! function_exists('is_unread_message')) {
    function is_unread_message() {
        $count = DB::table('customer_feedbacks')->where('status', '=', 'unread')->count();
        if($count > 0)
            return true;
        return false;
    }
}

if( ! function_exists('convert_to_currency')) {
    /**
     * @param double Number to convert to currency string
     * 
     * @return string Number converted to string
     */
    function convert_to_currency($number) : string {
        $fmt = new NumberFormatter('en_PK ', NumberFormatter::CURRENCY );
        return $fmt->formatCurrency($number, 'PKR');
    }
}