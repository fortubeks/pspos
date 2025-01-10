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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id');
            $table->double('qty');
            $table->double('discount_amount')->nullable();
            $table->double('total_amount');
            $table->double('pos_amount')->nullable();
            $table->double('cash_amount')->nullable();
            $table->double('other_amount')->nullable();
            $table->double('op_me_reading');
            $table->double('cl_me_reading');
            $table->foreignId('pump_id')->nullable();
            $table->foreignId('attendant_id')->nullable();
            $table->string('note')->nullable();
            $table->foreignId('user_id')->nullable();
            $table->foreignId('branch_id');
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
        Schema::dropIfExists('sales');
    }
};
