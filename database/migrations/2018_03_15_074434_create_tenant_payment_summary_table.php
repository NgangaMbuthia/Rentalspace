<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTenantPaymentSummaryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tenant_summaries', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('provider_id')->unsigned();
            $table->integer('property_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('space_id')->unsigned();
            $table->integer('tenant_id')->unsigned();
            $table->string('month');
            $table->string('year');
            $table->double('bal_brought_forward');
            $table->double('invoice_amount');
            $table->double('outstanding_balance');
            $table->double('amount_paid');
            $table->double('bal_carried_foward');
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
        Schema::dropIfExists('tenant_summaries');
    }
}
