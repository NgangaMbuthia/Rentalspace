<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoomAmentitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('room_amentities', function (Blueprint $table) {
            $table->increments('id');
              $table->integer('user_id')->unsigned();
            $table->integer('supplier_id')->unsigned();
            $table->integer('hotel_id')->unsigned();
            $table->integer('room_code')->unsigned();
            $table->integer('amentity_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('supplier_id')->references('id')->on('service_suppliers')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('hotel_id')->references('id')->on('hotels')
                ->onUpdate('cascade')->onDelete('cascade');
             $table->foreign('amentity_id')->references('id')->on('supplier_amentities')
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
        Schema::dropIfExists('room_amentities');
    }
}
