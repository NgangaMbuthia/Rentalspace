<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gate_vehicles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('gate_id')->unsigned();
            $table->foreign('gate_id')->references('id')->on('gate_gates')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->integer('property_id')->nullable();
            $table->integer('visitor_id')->unsigned();
            $table->foreign('visitor_id')->references('id')->on('gate_visitors')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->string('make')->nullable();
            $table->string('model')->nullable();
            $table->string('reg_number');
            $table->string('driver_license')->nullable();
            $table->string('type')->nullable();
             $table->time('time_in')->nullable();
            $table->time('time_out')->nullable();
            $table->enum('action1',['INSIDE','OUTSIDE'])->nullable();
            $table->enum('action2',['INSIDE','OUTSIDE'])->nullable();
            $table->enum('status',['Active','Inactive','Booked'])->default('Active');
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
        Schema::dropIfExists('gate_vehicles');
    }
}
