<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_expenses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('provider_id')->unsigned();
            $table->integer('property_id')->unsigned();
            $table->string('expense_name')->nullable();
            $table->double('amount');
            $table->date('expense_date')->nullable();
            $table->string('month')->nullable();
            $table->string('year')->nullable();
            $table->string('ref_no')->unique()->nullable();
            $table->text('other_descriptions')->nullable();
            $table->timestamps();
             $table->softDeletes();
            $table->foreign('provider_id')->references('id')->on('agents')
                ->onUpdate('cascade')->onDelete('cascade');
             $table->foreign('property_id')->references('id')->on('properties')
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
        Schema::dropIfExists('property_expenses');
    }
}
