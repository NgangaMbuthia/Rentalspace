<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plots', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('provider_id')->unsigned()->nullable();
            $table->foreign('provider_id')->references('id')->on('agents')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->string('name')->nullable();
            $table->string('country')->nullable();
            $table->string('state')->nullable();
            $table->string('area')->nullable();
            $table->string('city')->nullable();
            $table->string('contact_phone')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('contact_phone_two')->nullable();
            $table->string('contact_email_two')->nullable();
            $table->double('plot_price')->default(0);
            $table->string('plot_id')->nullable()->unique();
            $table->string('plot_size')->nullable();
            $table->text('added_valeu')->nullable();
            $table->string('account_name')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('branch')->nullable();
            $table->string('logitude')->nullable();
            $table->string('latitude')->nullable();
            $table->string('account_number')->nullable();
            $table->enum('plot_status',['Pending','On Sale','Sold'])->nullable();
            $table->text('description')->nullable();
             $table->timestamps();
             $table->softDeletes();
        });

        Schema::create('plot_images', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('plot_id')->unsigned()->nullable();
            $table->integer('image_id')->unsigned()->nullable();
            $table->foreign('plot_id')->references('id')->on('plots')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('image_id')->references('id')->on('uploads')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->timestamps();
            $table->softDeletes();

            });




    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plots');
    }
}
