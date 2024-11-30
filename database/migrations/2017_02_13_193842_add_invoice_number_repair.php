<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddInvoiceNumberRepair extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('repairs', function (Blueprint $table) {
          $table->string('invoice_number')->nullable();
           });

        Schema::table('repair_items', function (Blueprint $table) {
          $table->string('receit_number')->nullable();
          $table->string('supplier_id')->nullable();
          $table->date('date_supplied')->nullable();
          $table->enum('is_paid',['Yes','No'])->Default('Yes');
           });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
