<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use Illuminate\Support\Facades\DB;

class Employees extends Controller
{

	function loginaction(Request $r){
		$table = 'emp_users';

		// hash the password

		$sql = "SELECT * FROM `$table` WHERE `email` = '$r->email' AND `password` 
			= '$r->password'";

		$user = DB::select($sql);

		if(sizeof($user) === 0){
			return response()->json(['message' => 'Email or password is incorrect'], 404);
		}

		return response()->json($user, 200);
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
