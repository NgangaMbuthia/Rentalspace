<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('messagings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('receiver_id');
            $table->integer('sender_id');
            $table->string('subject')->nullable();
            $table->text('content')->nullable();
            $table->enum('status',['Read','Unread','Draft'])->default('Unread');
            $table->dateTime('viewed_at')->nullable();
            $table->enum('flag',['notification','message'])->default('notification');
            $table->string('key')->nullable();
            $table->enum('sender_delete',['No','Yes'])->default('No');
            $table->enum('receiver_delete',['No','Yes'])->default('No');
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
        Schema::dropIfExists('messagings');
    }
}
