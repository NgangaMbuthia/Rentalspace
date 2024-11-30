<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTenantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tenants', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('provider_id')->unsigned();
            $table->integer('space_id')->unsigned();
            $table->date('entry_date')->nullable();
            $table->string('status');
            $table->timestamps();
            $table->foreign('space_id')->references('id')->on('spaces')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('provider_id')->references('id')->on('agents')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')
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
          Schema::table('tenants',function($table){
            $table->dropForeign(['user_id']);
            $table->dropForeign(['provider_id']);
            $table->dropForeign(['space_id']);
             });
        Schema::dropIfExists('tenants');
    }
}
