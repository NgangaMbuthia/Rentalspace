<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->string('invoice_number')->unique()->nullable();
            $table->integer('issued_to')->unsigned();
            $table->date('issue_date')->nullable();
            $table->date('due_date')->nullable();
            $table->integer('space_id')->unsigned()->nullable();
            $table->integer('provider_id')->unsigned()->nullable();
            $table->double('amount');
            $table->text('description')->nullable();
            $table->text('reason')->nullable();
            $table->enum('status',['Overdue','Pending','Paid','On Hold','InValid','Cancelled'])->default('Pending');
            $table->string('month')->nullable();
            $table->string('year')->nullable();
            $table->string('type')->default("Rent");
            $table->string('invoice_email')->default('No');
            $table->string('secret_key')->nullable();

            $table->timestamps();
            $table->foreign('issued_to')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('space_id')->references('id')->on('spaces')
                ->onUpdate('cascade')->onDelete('cascade');
             $table->foreign('provider_id')->references('id')->on('agents')
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
        Schema::dropIfExists('invoices');
    }
}
