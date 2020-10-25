<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUnreadColumnToCustomerFeedbacksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customer_feedbacks', function (Blueprint $table) {
            //
            $table->enum('status', ['read', 'unread'])->default('unread')->after('message');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customer_feedbacks', function (Blueprint $table) {
            //
            $table->dropColumn('status');
        });
    }
}
