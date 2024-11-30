<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHotelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotels', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('supplier_id')->unsigned();
            $table->string('hotel_name')->nullable();
            $table->string('hotel_code')->unique()->nullable();
            $table->string('hotel_type')->nullable();
            $table->string('hotel_email')->nullable();
            $table->string('hotel_telephone')->nullable();
            $table->double('hotel_logitude')->nullable();
            $table->double('hotel_latitude')->nullable();
            $table->string('hotel_logo')->nullable();
            $table->string('hotel_city')->nullable();
            $table->string('hotel_state')->nullable();
            $table->string('hotel_country')->nullable();
            $table->string('postal_address')->nullable();
            $table->time('hotel_check_in_time')->nullable();
            $table->time('hotel_check_out_time')->nullable();
            $table->string('cover_image')->nullable();
            $table->string('hotel_start')->nullable();
            $table->string('tra_reg_no')->nullable();
            $table->integer('hotel_views')->default(0);
            $table->integer('hotel_likes')->default(0);
            $table->enum('hotel_profile',['Incomplete','Complete'])->default('Incomplete');
            $table->string('hotel_status')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('supplier_id')->references('id')->on('service_suppliers')
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
        Schema::dropIfExists('hotels');
    }
}
