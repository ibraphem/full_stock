<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReceivingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('receivings', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('supplier_id')->unsigned()->nullable();
			$table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('restrict');
			$table->string('payment_type', 15)->nullable();
			$table->decimal('total', 12, 2);
			$table->decimal('payment', 12, 2);
			$table->decimal('dues', 12, 2);
			$table->integer('user_id')->unsigned();
			$table->foreign('user_id')->references('id')->on('users')->onDelete('restrict');
			$table->tinyInteger('status');//status 1 means close status 0 means open
			$table->string('comments', 255)->nullable();
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
		Schema::drop('receivings');
	}

}
