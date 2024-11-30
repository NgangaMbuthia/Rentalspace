<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddintionChargesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addition_charges', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tenant_id')->unsigned();
            $table->integer('space_id')->unsigned();
            $table->integer('property_id')->unsigned();
            $table->string('charge_code')->nullable();
            $table->string('charge_name')->nullable();
            $table->double('charge_amount')->nullable();
            $table->integer('provider_id')->unsigned()->nullable();
            $table->string('charge_status')->default('Active');
            $table->text('charge_description')->nullable();
            $table->date('charge_date')->nullable();
            $table->string('year')->nullable();
            $table->string('month')->nullable();
            $table->integer('notification')->default(1);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('tenant_id')->references('id')->on('tenants')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('provider_id')->references('id')->on('agents')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('property_id')->references('id')->on('properties')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('space_id')->references('id')->on('spaces')
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
        Schema::dropIfExists('addintion_charges');
    }
}
