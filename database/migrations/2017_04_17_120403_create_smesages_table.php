<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmesagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('smessages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('owner_type')->defualt('Provider');
            $table->integer('owner_id')->unsigned();
            $table->json('group_ids')->nullable();
            $table->text('message');
            $table->enum('type',['Sms','Email','Both'])->default('Email');
            $table->date('send_date');
            $table->time('send_time');
            $table->enum('send_day',['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday']);

            $table->enum('status',['Pending','Active','Sent'])->default('Active');
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
        Schema::dropIfExists('smessages');
    }
}
