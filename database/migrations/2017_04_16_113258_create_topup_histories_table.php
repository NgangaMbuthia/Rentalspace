<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTopupHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('topup_histories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('owner_type')->defualt('Provider');
            $table->integer('owner_id')->unsigned();
            $table->double('amount');
            $table->string('gateway');
            $table->string('transaction_code')->unique();
            $table->enum('status',['Pending','Accepted','Rejected'])->defualt('Pending');
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
        Schema::dropIfExists('topup_histories');
    }
}
