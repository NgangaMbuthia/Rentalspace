<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProvidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_providers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unisgned()->nullable();
            $table->string('type')->nullable();
            $table->double('daily_price')->default(0);
            $table->enum('current_rating',['1','2','3','4','5'])->default('1');
            $table->string('nationality')->nullable();
            $table->string('current_nationality')->nullable();
            $table->string('location')->nullable();
            $table->string('town')->nullable();
            $table->string('first_ref')->nullable();
            $table->string('ref_one_phone')->nullable();
            $table->string('second_ref')->nullable();
            $table->string('ref_two_phone')->nullable();
            $table->double('current_balance')->default(0);
            $table->string('service_code')->unique()->nullable();
            $table->string('status')->default("Pending");
            $table->string('institution')->nullable();
            $table->string('qualification')->nullable();
            $table->string('years')->nullable();
            $table->string('scanned_id')->nullable();
            $table->string('good_conduct')->nullable();
            $table->string('payment_frequency')->nullable();
            $table->timestamps();
        });


         DB::table('roles')->insert([
            'name' => 'serviceProvider',
            'display_name'=>'Service Provider',
            'description'=>'Those Providing Services for Repairs',
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s'),
            
            ]);





    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('service_providers');
    }
}
