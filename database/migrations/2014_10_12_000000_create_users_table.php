<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password')->nullable();
            $table->string('avatar')->nullable();
            $table->string('provider')->nullable();
            $table->integer('social')->default(0);
            $table->string('verification_code')->unique();
            $table->datetime('confirmed_at')->nullable();
            $table->enum('status',['Blocked','Active'])->default('Active');
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();
        });

         DB::table('users')->insert([
            'name' => 'System Admin',
            'email'=>'admin@realestate.com',
            'password'=>bcrypt('secret'),
            'provider'=>'manual',
            'verification_code'=>strtoupper(str_random(8)),
             'created_at'=>date('Y-m-d H:i:s'),
             'updated_at'=>date('Y-m-d H:i:s'),
             'confirmed_at'=>date('Y-m-d'),
            ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    
    public function down()
    {
        Schema::drop('users');
    }
}
