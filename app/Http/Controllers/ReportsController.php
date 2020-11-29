<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportsController extends Controller
{
    //

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

}
