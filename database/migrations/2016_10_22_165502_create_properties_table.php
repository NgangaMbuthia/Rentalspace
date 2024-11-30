<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->integer('provider_id')->unsigned();
            $table->integer('unit_price')->nullable();
            $table->integer('system_price')->nullable();
            $table->string('currency')->nullable();
            $table->string('description')->nullable();
            $table->string('town')->nullable();
            $table->string('location')->nullable();
            $table->string('bathrooms')->nullable();
            $table->string('bedrooms')->nullable();
            $table->string('area')->nullable();
            $table->string('cover_image')->nullable();
            $table->double('latitude')->nullable();
            $table->double('longitude')->nullable();
            $table->enum('type',['For Sale','For Rent'])->nullable();
            $table->text('other_details');
            $table->string('status')->default('Pending');
            $table->timestamps();
            $table->foreign('provider_id')->references('id')->on('agents')
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

         Schema::table('properties',function($table){
            $table->dropForeign(['provider_id']);
             });
        Schema::dropIfExists('properties');
    }
}
