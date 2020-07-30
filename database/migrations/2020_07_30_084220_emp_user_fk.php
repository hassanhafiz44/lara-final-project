<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EmpUserFk extends Migration
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
			$table->foreign('id')
				->references('id')
				->on('users')
				->onDelete('cascade')
				->onUpdate('cascade');
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
			$table->dropForeign('employees_id_foreign');
		});
	}
}
