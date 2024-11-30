<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubmiteddPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('submitted_payments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('provider_id')->unsigned();
            $table->integer('property_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('space_id')->unsigned();
            $table->double('invoice_amount')->nullable();
            $table->double('amount_paid')->nullable();
            $table->double('balance');
            $table->string('method')->nullable();
            $table->string('ref_no')->unique()->nullable();
            $table->string('approve_status')->default('Pending');
            $table->integer('invoice_id')->unsigned();
            $table->string('file_name')->nullable();
            $table->string('month');
            $table->string('year');
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
        Schema::dropIfExists('submitted_payments');
    }
}
