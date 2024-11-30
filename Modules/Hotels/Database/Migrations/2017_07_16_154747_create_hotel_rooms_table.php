<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHotelRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotel_rooms', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('supplier_id')->unsigned();
            $table->integer('hotel_id')->unsigned();
            $table->string('room_name')->nullable();
            $table->integer('room_code')->nullable();
            $table->string('bed_type')->nullable();
            $table->integer('no_of_bathrooms')->nullable();
            $table->string('room_size')->nullable();
            $table->integer('room_capacity')->nullable();
            $table->enum('occupants',['Adults','Chidren','Both'])->default('Both');
            $table->string('room_start_key')->nullable();
            $table->enum('current_status',['Occupied','Booked','Empty'])->default('Empty');
            $table->string('current_occupant_start_date')->nullable();
            $table->string('current_occupant_end_date')->nullable();
            $table->string('room_number');
            $table->integer('no_of_similar_rooms')->default(1);
            $table->double('local_price_off_peak_night')->nullable();
            $table->double('foreign_price_off_peak_night')->nullable();
            $table->double('local_price_peak_night')->nullable();
            $table->double('foreign_price_peak_night')->nullable();
            $table->string('currency')->default('KES');
            $table->string('room_description')->nullable();
            $table->integer('room_views')->nullable();
            $table->integer('room_likes')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('supplier_id')->references('id')->on('service_suppliers')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('hotel_id')->references('id')->on('hotels')
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
        Schema::dropIfExists('hotel_rooms');
    }
}
