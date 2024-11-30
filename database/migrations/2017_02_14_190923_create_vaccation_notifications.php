<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVaccationNotifications extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vaccation_notifications', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tenant_id')->unsigned();
            $table->date('date_reported')->nullable();
            $table->date('vaccation_date')->nullable();
            $table->text('reason')->nullable();$table->enum('status',['Approved','Rejected','Pending'])->default('Pending');
            
            $table->timestamps();
            $table->foreign('tenant_id')->references('id')->on('tenants')
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
         Schema::table('vacation_notifications',function($table){
            $table->dropForeign(['tenant_id']);
             });
        Schema::dropIfExists('vacation_notifications');
    }
}
