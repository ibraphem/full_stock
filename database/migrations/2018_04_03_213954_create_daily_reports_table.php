<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDailyReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daily_reports', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('prev_balance', 12, 2);
            //sales
            $table->decimal('total_sales', 12, 2);
            $table->decimal('total_payment', 12, 2);
            $table->decimal('total_dues', 12, 2);
            $table->decimal('sale_profit', 12, 2);
            $table->decimal('total_income', 12, 2);
            $table->decimal('total_expense', 12, 2);
            $table->decimal('total_receivings', 12, 2);
            $table->decimal('total_receivings_payment', 12, 2);
            $table->decimal('total_receivings_dues', 12, 2);
            $table->decimal('total_supplier_payment', 12, 2);
            $table->decimal('total_costing', 12, 2);
            $table->decimal('net_balance', 12, 2);
            $table->decimal('total_profit', 12, 2);
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('daily_reports');
    }
}
