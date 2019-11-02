<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('qty');
            $table->decimal('unit_price', 12, 2);
            $table->text('description');
            $table->decimal('payment', 12, 2);
            $table->decimal('dues', 12, 2);
            $table->decimal('total', 12, 2);
            $table->string('payment_type');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('expense_category_id')->unsigned();
            $table->foreign('expense_category_id')->references('id')->on('expense_categories');
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
        Schema::dropIfExists('expenses');
    }
}
