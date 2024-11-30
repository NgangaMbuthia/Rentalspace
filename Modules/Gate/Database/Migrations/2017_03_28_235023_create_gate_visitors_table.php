<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGateVisitorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gate_visitors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email_address')->nullable();
            $table->string('mobile')->nullable();
            $table->string('alt_mobile')->nullable();
            $table->string('id_number')->nullable();
            $table->integer('host_id')->unsigned();
            $table->foreign('host_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->integer('gate_id')->unsigned();
            $table->foreign('gate_id')->references('id')->on('gate_gates')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->integer('property_id')->nullable();
            $table->datetime('time_in')->nullable();
            $table->datetime('time_out')->nullable();
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
        Schema::dropIfExists('gate_visitors');
    }
}
