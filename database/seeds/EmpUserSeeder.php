<?php

use App\Employee;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class EmpUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
			DB::raw("DELETE FROM `users` WHERE `name` = 'admin'");
			DB::raw("DELETE FROM `employees` WHERE `name` = 'admin'");
			// Save admin employee in database
			$user = new User;
			$user->name = 'admin';
			$user->email = 'admin@admin.com';
			$user->password = Hash::make("123123123");
			$user->save();

			$employee = new Employee;
			$employee->name = 'admin';
			$employee->phone = '12312312312';
			$employee->address = 'Dummy address';
			$employee->cnic = '1233211233211';
			$employee->save();
    }
}
