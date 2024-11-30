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
         Schema::create('suppliers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('legal_name')->unique()->nullable();
            $table->string('trading_name')->nullable();
            $table->string('reg_number')->unique();
            $table->string('country_of_origin')->nullable();
            $table->string('service_type')->nullable();
            $table->string('vat')->unique()->nullable();
            $table->string('core_commodity')->nullable();
            $table->string('supplier_type')->nullable();
            $table->text('website')->nullable();
            $table->string('email')->nullable();
            $table->string('telephone')->nullable();
            $table->string('alt_phone')->nullable();
            $table->string('address_line')->nullable();
            $table->string('physical_address')->nullable();
            $table->string('city')->nullable();
            $table->string('street')->nullable();
            $table->string('location')->nullable();
            $table->string('bulding')->nullable();
            $table->string('contact_name')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('contact_phone')->nullable();
            $table->string('contact_position')->nullable();
            $table->string('contact_postal_address')->nullable();
            $table->string('sector')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('account_name')->nullable();
            $table->string('account_number')->unique()->nullable();
            $table->string('branch')->nullable();
            $table->text('others_details')->nullable();
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
        Schema::dropIfExists('suppliers');
    }
}
