<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;

class Employees extends Controller
{

	function loginaction(Request $r){
		
	}


	function contact()
    {
    	return view('contactus');
    }

     function home()
    {
    	return view('home');
    }

    function products()
    {
    	return view('products');
    }

    function services()
    {
        return view('services');
    }

    function adminlogin(){
        return view('loginform');
    }

    function inventory(){
        return view('inventory');
    }    

    function dashboard()
    {
        return view('dashboard');
    }

    function profile(){
        return view('admin/profile');
    }

    function orders(){
        return view('orders');
    }

    function sign_in(){

    }

    function sign_out(){
    	
    }
}
