<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRepairsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('repairs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('request_id')->nullable();
            $table->integer('provider_id')->unsigned();
            $table->integer('space_id')->unsigned();
            $table->string('type')->nullable();
            $table->string('job_done_by')->nullable();
            $table->enum('person_responsible',['Landloard','Tenant'])->default('Landloard');
            $table->integer('user_id')->nullable();
            $table->double('technician_fee');
            $table->double('total_cost');
            $table->string('repair_code')->unique();
            $table->date('repair_date')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
            $table->foreign('space_id')->references('id')->on('spaces')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('provider_id')->references('id')->on('agents')
                ->onUpdate('cascade')->onDelete('cascade');
        });
         Schema::create('repair_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('repair_id')->unsigned();
            $table->string('item_name');
            $table->double('unit_price');
            $table->integer('quantity');
            $table->timestamps();
            $table->foreign('repair_id')->references('id')->on('repairs')
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
        Schema::table('repair_items',function($table){
            $table->dropForeign(['repair_id']);
             });
        Schema::dropIfExists('repair_items');
         Schema::table('repairs',function($table){
            $table->dropForeign(['provider_id']);
            $table->dropForeign(['space_id']);
             });

        Schema::dropIfExists('repairs');
    }
}
