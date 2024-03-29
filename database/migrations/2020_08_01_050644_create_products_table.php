<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
			$table->bigInteger('category_id',false, true);
			$table->string('title', 64);
			$table->string('model', 64);
			$table->string('description');
			$table->decimal('price');
			$table->integer('quantity',false, false);
			$table->foreign('category_id')
				->references('id')
				->on('product_categories')
				->onDelete('restrict')
				->onUpdate('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
