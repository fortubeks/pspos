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
            $table->decimal('qty', 10, 2);
            $table->decimal('unit_price');
            $table->decimal('total_amount', 15, 2);
            $table->decimal('op_me_reading', 10, 2);
            $table->decimal('cl_me_reading', 10, 2);
            $table->foreignId('pump_id')->nullable();
            $table->foreignId('bank_account_id')->nullable();
            $table->string('payment_method')->nullable();
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
