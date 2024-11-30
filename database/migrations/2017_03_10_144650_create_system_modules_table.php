<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSystemModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('system_modules', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->double('standard_charges')->default(4500);
            $table->integer('no_of_clients')->default(0);
            $table->timestamps();
        });
        $modules=array('properties and Spaces Management','Tenants/Lease Management','Invoice Management','Maintanance Module','Users and Gate Module','SMS and Bulk Emails Module','Advertising Module');


        foreach($modules as $key){
            DB::table('system_modules')->insert([
            'name' => $key,
             'created_at'=>date('Y-m-d H:i:s'),
             'updated_at'=>date('Y-m-d H:i:s'),
             
            ]);

          }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('system_modules');
    }
}
