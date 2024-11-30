<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedHotelPermission extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
           DB::table('permissions')->insert([
            'name' => 'manage-hotels',
             'display_name'=>'Manage Hotels',
             'description'=>'Allow Hotel Suppliers to add Hotels on the platform under his/her account',
            'created_at' =>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d'),
            ]);

            DB::table('permissions')->insert([
            'name' => 'manage-hotel-rooms',
             'display_name'=>'Manage Hotel Rooms',
             'description'=>'Allow Hotel Suppliers and Hotels to add rooms to the platform',
            'created_at' =>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d'),
            ]);


              DB::table('permissions')->insert([
            'name' => 'manage-packages',
             'display_name'=>'Manage Packages',
             'description'=>'Allow To Operators To add Packages on platform',
            'created_at' =>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d'),
            ]);

           DB::table('permissions')->insert([
            'name' => 'view-operator-dashboard',
             'display_name'=>'View Tour Operator Dashboard',
             'description'=>'View Tour Operator Dashboard',
            'created_at' =>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d'),
            ]);

            DB::table('permissions')->insert([
            'name' => 'view-hotel-dashboard',
             'display_name'=>'View Hotel Dashboard',
             'description'=>'View Hotel Dashboard',
            'created_at' =>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d'),
            ]);

             DB::table('permissions')->insert([
            'name' => 'view-supplier-dashboard',
             'display_name'=>'View Supplier Dashboard',
             'description'=>'View Supplier Dashboard',
            'created_at' =>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d'),
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
