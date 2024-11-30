<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAgencyFieds extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::table('properties', function (Blueprint $table) {
            $table->string('agency')->default('Personal Assistant');
            $table->string('agent_id')->nullable();
            $table->string('agency_id')->nullable();
            $table->integer('no_of_Garages')->nullable();
            
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
