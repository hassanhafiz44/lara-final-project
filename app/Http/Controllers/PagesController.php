<?php

namespace App\Http\Controllers;

use App\Product;

class PagesController extends Controller
{
	public function index()
	{
		$data = array('title' => 'Home');
		return view('pages.home')->with($data);
	}

	function contact()
    {
		$data = array('title' => 'Contract Us');
    	return view('pages.contactus')->with($data);
    }

    function products()
    {
		$data = array('title' => 'Products');
		$data['products'] = Product::all();
    	return view('pages.products')->with($data);
    }

    function services()
    {
		$data = array('title' => 'Services');
        return view('pages.services')->with($data);
    }

    function about() 
    {
		$data = array('title' => 'About Us');
    	return view('pages.about')->with($data);
    }
}
