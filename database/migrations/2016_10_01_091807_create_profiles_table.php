<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->enum('gender',['Male','Female'])->nullable();
            $table->date('dob')->nullable();
            $table->string('telephone')->nullable();
            $table->string('country')->nullable();
            $table->string('postal_address')->nullable();
            $table->string('city')->nullable();
            $table->string('street')->nullable();
            $table->string('id_number')->nullable();
            $table->string('timezone')->nullable();
            $table->enum('status',['Compelete','Incomplete'])->default('Incomplete');
            $table->timestamps();
             $table->softDeletes();
            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
        });

         DB::table('profiles')->insert([
            'user_id' => 1,
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
        Schema::dropIfExists('profiles');
    }
}
