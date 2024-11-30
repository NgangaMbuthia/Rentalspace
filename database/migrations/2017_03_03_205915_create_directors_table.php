<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDirectorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('directors', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('supplier_id')->unsigned();
            $table->string('name');
            $table->enum('identification',['National ID','Passport Number'])->nullable();
            $table->string('identifaction_number')->nullable();
            $table->string('country');
            $table->timestamps();
             $table->foreign('supplier_id')->references('id')->on('suppliers')
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
         Schema::table('directors',function($table){
            $table->dropForeign(['supplier_id']);
             });

        Schema::dropIfExists('directors');
    }
}
