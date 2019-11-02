<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFlexiblePosSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flexible_pos_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('language', 5)->default('en');
            $table->string('logo_path');
            $table->string('fevicon_path');
            $table->string('company_name');
            $table->text('owner_name')->nullable();
            $table->text('company_address');
            $table->decimal('starting_balance', 12, 2);
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
        Schema::dropIfExists('flexible_pos_settings');
    }
}
