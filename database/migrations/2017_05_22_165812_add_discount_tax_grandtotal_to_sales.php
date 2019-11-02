<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDiscountTaxGrandtotalToSales extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sales', function($table) {
            $table->decimal('discount', 9, 2);
            $table->decimal('tax', 9, 2);
            $table->decimal('grand_total', 9, 2);
            $table->decimal('payment', 9, 2);
            $table->decimal('dues', 9, 2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sales', function($table) {
            $table->dropColumn('discount');
            $table->dropColumn('tax');
            $table->dropColumn('grand_total');
            $table->dropColumn('payment');
            $table->dropColumn('dues');
        });
    }
}
