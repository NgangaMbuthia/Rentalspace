<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobRequests extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('property_id')->unisgned();
            $table->integer('client_user_id')->unisgned();
            $table->integer('provider_id')->unisgned()->nullable();
            $table->date('job_start_date')->nullable();
            $table->string('type');
            $table->string('service_number')->unique()->nullable();
            $table->enum('status',['Pending','Approved','Rejected','Suspended','Completed','OnGoing'])->default('Pending');
            $table->date('request_close_date')->nullable();
            $table->text('reason')->nullable();
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
        Schema::dropIfExists('job_requests');
    }
}
