<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agents', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();;
            $table->string('auth_key')->unique()->nullable();
            $table->string('validity_in_months')->default(12);
            $table->date('expiry_date')->nullable();
            $table->string('building')->nullable();
            $table->string('sms_provider')->nullable();
            $table->string('sms_sender_name')->nullable();
            $table->string('sms_api_url')->nullable();
            $table->string('passkey')->nullable();
            $table->string('has_api')->default("No");
            $table->string('altenative_email')->nullable();
            $table->string('reply_email')->nullable();
            $table->integer('invoice_send_day')->default(1);
            $table->string('invoice_send_time')->default("7:00:00");
            $table->string('encrypt_invoice')->default("Yes");
            $table->string('method')->default('System');
            $table->enum('status',['Pending','Approved','Suspended','Expired'])->default('Pending');
            $table->timestamps();
            $table->softDeletes();
           /* $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');*/
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::table('agents',function($table){
            $table->dropForeign(['user_id']);
             });
        Schema::dropIfExists('agents');
    }
}
