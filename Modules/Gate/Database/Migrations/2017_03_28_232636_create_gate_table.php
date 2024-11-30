<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gate_gates', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('telephone')->nullable();
            $table->string('alt_telephone')->nullable();
            $table->integer('min_guards')->default(1);
            $table->integer('max_guards')->nullable();
            $table->integer('current_guards')->nullable();
            $table->integer('property_id')->nullable();

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
        Schema::dropIfExists('gate');
    }
}
