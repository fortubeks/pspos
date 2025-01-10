<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tank_readings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tank_id');
            $table->double('op_dip_reading');
            $table->double('cl_dip_reading');
            $table->double('total_sales_amount');
            $table->double('total_sales_qty');
            $table->foreignId('user_id');
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
        Schema::dropIfExists('tank_readings');
    }
};
