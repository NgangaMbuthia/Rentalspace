<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpacePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spaces_payments', function (Blueprint $table) {
            $table->increments('id');
             $table->integer('property_id')->unsigned();
            $table->integer('space_id')->unsigned();
            $table->integer('charge_id')->unsigned()->nullable();
            $table->double('amount')->unsigned();
            $table->string('month')->nullable();
            $table->string('year')->nullable();
             $table->index(['property_id','charge_id','space_id']);
            $table->timestamps();
            $table->foreign('charge_id')->references('id')->on('invoice_componets')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('property_id')->references('id')->on('properties')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('space_id')->references('id')->on('spaces')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('spaces_payments');
    }
}
