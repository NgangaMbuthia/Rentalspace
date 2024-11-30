<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_suppliers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('name')->nullable();
            $table->string('tra_reg_no')->unique()->nullable();
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->string('supplier_code')->unique()->nullable();
            $table->string('email')->nullable();
            $table->string('telephone')->nullable();
            $table->string('type')->nullable();
            $table->string('box')->nullable();
            $table->string('postal_address')->nullable();
            $table->enum('supplier_status',['Pending','Approved','Rejected','Suspended'])->nullable();
            $table->text('reason')->nullable();
            $table->integer('rating')->nullable();
            $table->text('website')->nullable();
            $table->string('extranet')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('user_id')->references('id')->on('users')
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
        Schema::dropIfExists('suppliers');
    }
}
