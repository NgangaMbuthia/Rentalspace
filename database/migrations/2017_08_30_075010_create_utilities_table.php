<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUtilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('utility_bills', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('provider_id')->unsigned()->nullable();
            $table->integer('space_id')->unsigned();
            $table->integer('property_id')->unsigned();
            $table->string('water_meter_number')->nullable();
            $table->string('electricity_meter_number')->nullable();
            $table->double('old_w_reading')->default(0);
            $table->double('current_w_reading')->default(0);
            $table->double('old_e_reading')->default(0);
            $table->double('current_e_reading')->default(0);
            $table->string('w_payment_status')->nullable();
            $table->string('e_payment_status')->nullable();
            $table->string('w_payment_ref')->nullable()->unique();
            $table->string('e_payment_ref')->nullable()->unique();
            $table->double('e_payment_amount')->default(0);
            $table->double('w_payment_amount')->default(0);
            $table->string('year')->nullable();
            $table->string('month')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('provider_id')->references('id')->on('agents')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('space_id')->references('id')->on('spaces')
                ->onUpdate('cascade')->onDelete('cascade');
           $table->foreign('property_id')->references('id')->on('properties')
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
        Schema::dropIfExists('utilities');
    }
}
