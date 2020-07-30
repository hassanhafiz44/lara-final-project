<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use App\User;
use Illuminate\Support\Facades\Hash;

class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
		$data = array('title' => 'Employees');
		$data['employees'] = Employee::all();
        return view('employees.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
		$data = array('title' => 'Create Employee');
		return view('employees.create')->with($data);
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
		$validatedData = $request->validate([
			'name' => 'required',
			'phone' => 'required|min:11|max:11',
			'address' => 'required|max:100',
			'cnic' => 'required|min:13',
			'email' => 'required'
		]);

		//DB::beginTransaction();

		$user = new User;
		$user->name = $request->name;
		$user->email = $request->email;
		$user->password = Hash::make('123123123');
		$is_user_saved = $user->save();

		$employee = new Employee;
		$employee->id = $user->id;
		$employee->name = $request->name;
		$employee->phone = $request->phone;
		$employee->cnic = $request->cnic;
		$employee->address = $request->address;
		$is_employee_saved = $employee->save();

		return redirect(route('employees.index'))->with('success', 'Employee saved');


//		$transaction_ok = ($is_employee_saved && $is_user_saved) ? TRUE : FALSE;
//
//		if($transaction_ok === FALSE){
//			DB::rollBack();
//			return redirect()->with('error', 'Failure');
//		}
//		else {
//			DB::commit();
//			return redirect(route('employees.index'))->with('success', 'Hahaha');
//		}
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
		$employee = Employee::find($id);
		$data = array(
			'title' => 'Employee',
			'employee' => $employee
		);

		return view('employees.show')->with($data);
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
		$data = array(
			'title' => 'Edit Employee'
		);
		$data['employee'] = Employee::find($id);
		$data['user'] = $data['employee']->user;
		return view('employees.edit')->with($data);
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
}
