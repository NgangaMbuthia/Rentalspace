<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type')->default('Provider');
            $table->integer('type_id')->nullable();
            $table->text('message')->nullable();
            $table->enum('delvery_status',['DELIVERED','EXPIRED','HANDSET_ERRORS','OK','OPERATOR_ERRORS','PENDING','REJECTED','UNDELIVERABLE','USER_ERRORS'])->default('DELIVERED');
            $table->string('phone');
            $table->integer('mesage_size');
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
        Schema::dropIfExists('messages');
    }
}
