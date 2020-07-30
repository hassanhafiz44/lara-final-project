<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EmpPhoneAddressRequired extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
		Schema::table('employees', function($table) {
			$table->string('phone', 20)->nullable(false)->change();
			$table->string('address', 100)->nullable(false)->change();
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
		Schema::table('employees', function($table) {
			$table->string('phone', 20)->nullable()->change();
			$table->string('address', 100)->nullable()->change();
		});
	}
}
