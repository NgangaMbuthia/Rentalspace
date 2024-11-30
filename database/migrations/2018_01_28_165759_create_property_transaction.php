<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertyTransaction extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('provider_id')->unsigned();
            $table->integer('property_id')->unsigned();
            $table->integer('account_id')->unsigned();
            $table->double('credit')->nullable();
            $table->double('debit')->nullable();
            $table->double('balance')->nullable();
            $table->string('ref_no')->nullable();
            $table->string('year')->nullable();
            $table->string('month')->nullable();
            $table->date('tran_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('provider_id')->references('id')->on('agents')
                ->onUpdate('cascade')->onDelete('cascade');
             $table->foreign('property_id')->references('id')->on('properties')
                ->onUpdate('cascade')->onDelete('cascade');
              $table->foreign('account_id')->references('id')->on('properties_accounts')
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
        Schema::dropIfExists('property_transactions');
    }
}
