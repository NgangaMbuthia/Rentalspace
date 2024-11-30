<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedHotelRoles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('roles')->insert([
            'name' => 'Hotel-Supplier',
            'display_name'=>'Hotel Supplier',
            'description'=>'This is an individual who can supplier hotels and other tour operator packages',
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s'),
            
            ]);

        DB::table('roles')->insert([
            'name' => 'Hotel',
            'display_name'=>'Hotel',
            'description'=>'These are hotels,only offering hotel services',
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s'),
            
            ]);

         DB::table('roles')->insert([
            'name' => 'Tour Operators',
            'display_name'=>'Tour Operators',
            'description'=>'These are Tour Operators',
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s'),
            
            ]);
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
