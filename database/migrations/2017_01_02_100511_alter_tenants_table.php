<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTenantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tenants', function (Blueprint $table) {
            $table->string('has_smokers')->default('No')->nullable();
            $table->integer('smoker_number')->nullable();
            $table->enum('type',['Student','Self Employed','Employed'])->nullable();
            $table->string('stay_duration')->nullable();
            $table->string('has_requirement')->default('No')->nullable();
            $table->text('requirement')->nullable();
            $table->string('scanned_id')->nullable();
            
            
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
