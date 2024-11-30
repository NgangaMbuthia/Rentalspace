<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGateGateassignmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gate_gateassignments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('gate_id')->unsigned();
            $table->foreign('gate_id')->references('id')->on('gate_gates')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->integer('guard_id')->unsigned();
            $table->foreign('guard_id')->references('id')->on('gate_guards')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
             $table->integer('assigned_by')->unsigned();
            $table->foreign('assigned_by')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->datetime('next_assignment')->nullable();
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
        Schema::dropIfExists('gate_gateassignments');
    }
}
