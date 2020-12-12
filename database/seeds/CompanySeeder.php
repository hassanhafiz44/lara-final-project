<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('companies')->delete();
        DB::table('companies')->insert([
            ['title' => 'Computer City', 'email' => 'owner@hotmail.com', 'phone' => '0553231231', 'mobile' => '03001212121', 'address' => 'Sialkot', 'created_at' => now(), 'updated_at' => now()]
        ]);
        
    }
}
