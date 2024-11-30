<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class EntrustSetupTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return  void
     */
    public function up()
    {
        // Create table for storing roles
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('display_name')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();
        });

          DB::table('roles')->insert([
            'name' => 'Admin',
            'display_name'=>'Adminstartor',
            'description'=>'In charge of the system administration',
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s'),
            
            ]);



           DB::table('roles')->insert([
            'name' => 'Renter',
            'display_name'=>'Tenant',
            'description'=>'Tenants are those hiring spaces or houses.',
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s'),
            
            ]);


           DB::table('roles')->insert([
            'name' => 'Provider',
            'display_name'=>'Landloads/Providers',
            'description'=>'A provider will be the person who will be providing houses(s) to be hired. A provider can be 
                         Individual person or a company with many houses A provider must have one or more houses',
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s'),
            
            ]);


            DB::table('roles')->insert([
            'name' => 'Agents',
            'display_name'=>'Agents',
            'description'=>'Those who can act in case of provider',
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s'),
            
            ]);




        // Create table for associating roles to users (Many-to-Many)
        Schema::create('role_user', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->integer('role_id')->unsigned();

            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('roles')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['user_id', 'role_id']);
        });

        DB::table('role_user')->insert([
            'user_id' => 1,
            'role_id'=>1,
             ]);





        // Create table for storing permissions
        Schema::create('permissions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('display_name')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();
        });


           DB::table('permissions')->insert([
            'name' => 'access-backend',
             'display_name'=>'Access application Backend',
             'description'=>'Allow Users to loginto the application and perform various activitie',
            'created_at' =>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d'),
            ]);

        // Create table for associating permissions to roles (Many-to-Many)
        Schema::create('permission_role', function (Blueprint $table) {
            $table->integer('permission_id')->unsigned();
            $table->integer('role_id')->unsigned();

            $table->foreign('permission_id')->references('id')->on('permissions')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('roles')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['permission_id', 'role_id']);
        });

           DB::table('permission_role')->insert([
            'role_id' => 1,
            'permission_id'=>1,
            ]);

             DB::table('permission_role')->insert([
            'role_id' => 3,
            'permission_id'=>1,
            ]);

             DB::table('permission_role')->insert([
            'role_id' => 4,
            'permission_id'=>1,
            ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return  void
     */
    public function down()
    {
        Schema::drop('permission_role');
        Schema::drop('permissions');
        Schema::drop('role_user');
        Schema::drop('roles');
    }
}
