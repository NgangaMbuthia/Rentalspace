<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTopupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('topups', function (Blueprint $table) {
            $table->increments('id');
            $table->string('owner_type')->defualt('Provider');
            $table->integer('owner_id')->unsigned();
            $table->double('active_balance');
            $table->date('last_topup');
            $table->double('amount');
            $table->integer('histrory_id')->unsigned();
            $table->foreign('histrory_id')->references('id')->on('topup_histories')
                ->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('topups');
    }
}
