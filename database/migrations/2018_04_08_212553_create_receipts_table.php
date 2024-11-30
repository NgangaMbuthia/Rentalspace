<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReceiptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receipts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('payment_id')->unsigned();
            $table->string('ref_no')->unique()->nullable();
            $table->string('doc_path')->nullable();
            $table->string('doc_type')->nullable();
            $table->string('mime')->nullable();
            $table->string('original_filename');
            $table->double('doc_size');
            $table->string('document_folder')->nullable();
            $table->text('document_descriptions')->nullable();
            $table->text('other_meta_data')->nullable();
            $table->timestamps();
            $table->foreign('payment_id')->references('id')->on('tenant_payments')
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
        Schema::dropIfExists('receipts');
    }
}
