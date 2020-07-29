<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
	public function index()
	{
		return view('pages.home');
	}

	function contact()
    {
    	return view('pages.contactus');
    }

    function products()
    {
    	return view('pages.products');
    }

    function services()
    {
        return view('pages.services');
    }

    function about() 
    {
    	return view('pages.about');
    }
}
