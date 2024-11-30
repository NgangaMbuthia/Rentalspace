<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProviderModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('provider_modules', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type')->default('Provider');
            $table->integer('type_id');
            $table->integer('module_id')->unsigned();
            $table->double('amount')->default();
            $table->integer('no_of_users')->nullable();
            $table->date('date_subscribed');
            $table->enum('status',['Active','Expired'])->default('Active');
            $table->date('last_renewed_on')->nullable();
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
        Schema::dropIfExists('provider_modules');
    }
}
