<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProviderTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('provider_transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('provider_id')->unsigned();
            $table->integer('account_id')->unsigned();
            $table->double('amount')->nullable();
            $table->double('balance')->nullable();
            $table->string('ref_no')->nullable();
            $table->string('year')->nullable();
            $table->string('month')->nullable();
            $table->date('tran_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('provider_id')->references('id')->on('agents')
                ->onUpdate('cascade')->onDelete('cascade');
              $table->foreign('account_id')->references('id')->on('provider_accounts')
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
        Schema::dropIfExists('provider_transactions');
    }
}
