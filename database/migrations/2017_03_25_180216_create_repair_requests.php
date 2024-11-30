<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRepairRequests extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('repair_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('space_id')->unsigned();
            $table->enum('priorty',['High','Medium','Low','Urgent'])->default('High');
            $table->enum('level',['Emergency Repair','Urgent Repair','Routine Repair'])->default('Routine Repair');
            $table->string('type')->nullable();
            $table->text('description')->nullable();
            $table->date('expected_repair_date')->nullable();
            $table->date('expected_investination_date')->nullable();
            $table->string('repair_ticket')->unique();
            $table->enum('status', ['Pending', 'Closed', 'Open', 'Processed', 'Others'])->default('Pending');
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
        Schema::dropIfExists('repair_requests');
    }
}
