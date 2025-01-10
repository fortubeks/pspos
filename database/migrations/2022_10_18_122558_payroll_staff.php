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
        Schema::create('payroll_staff', function (Blueprint $table) {
            $table->foreignId('payroll_id');
            $table->foreignId('staff_id');
            $table->double('total_payable');
            $table->double('total_deduction');
            $table->double('total_addition');
            $table->double('base_salary');
            $table->integer('payment_status');
            $table->string('note');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payroll_staff');
    }
};
