<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTenantPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tenant_payments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tenant_id')->unsigned();
            $table->enum('payment_mode',['Bankslip','Cheque','Cash','MPesa','Paybal','Others']);
            $table->string('reference_number')->unique();
            $table->string('type')->default('Rent');
            $table->integer('space_id')->unsigned();
            $table->integer('provider_id')->unsigned();
            $table->double('debit');
            $table->double('credit');
            $table->double('fee_charges')->nullable();
            $table->date('transaction_date');
            $table->string('year')->nullable();
            $table->string('month')->nullable();
            $table->string('system_transaction_number')->unique();
            $table->text('description')->nullable();
            $table->timestamps();
            $table->foreign('space_id')->references('id')->on('spaces')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('provider_id')->references('id')->on('agents')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('tenant_id')->references('id')->on('tenants')
                ->onUpdate('cascade')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tenant_payments',function($table){
            $table->dropForeign(['tenant_id']);
            $table->dropForeign(['provider_id']);
            $table->dropForeign(['space_id']);
             });
        Schema::dropIfExists('tenant_payments');
    }
}
