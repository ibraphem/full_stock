<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReceivingPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receiving_payments', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('payment', 12, 2);
            $table->string('payment_type');
            $table->string('comments')->nullable();
            $table->decimal('dues', 12, 2);
            $table->integer('receiving_id')->unsigned();
            $table->foreign('receiving_id')->references('id')->on('receivings');
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
        Schema::dropIfExists('receiving_payments');
    }
}
