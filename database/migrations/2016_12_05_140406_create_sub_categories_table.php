<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->unsigned();
            $table->string('name')->unique();
            $table->text('description')->nullable();
             $table->timestamps();
             $table->softDeletes();
            
        });

        DB::table('sub_categories')->insert([
            'name' => 'Bungalow',
            'category_id'=>1,
             'created_at'=>date('Y-m-d H:i:s'),
             'updated_at'=>date('Y-m-d H:i:s'),
            ]);

        DB::table('sub_categories')->insert([
            'name' => 'massionate',
            'category_id'=>1,
             'created_at'=>date('Y-m-d H:i:s'),
             'updated_at'=>date('Y-m-d H:i:s'),
            ]);

        DB::table('sub_categories')->insert([
            'name' => 'Apartments',
            'category_id'=>2,
             'created_at'=>date('Y-m-d H:i:s'),
             'updated_at'=>date('Y-m-d H:i:s'),
            ]);

        DB::table('sub_categories')->insert([
            'name' => 'Malls',
            'category_id'=>3,
             'created_at'=>date('Y-m-d H:i:s'),
             'updated_at'=>date('Y-m-d H:i:s'),
            ]);

         DB::table('sub_categories')->insert([
            'name' => 'Office Spaces',
            'category_id'=>3,
             'created_at'=>date('Y-m-d H:i:s'),
             'updated_at'=>date('Y-m-d H:i:s'),
            ]);

          DB::table('sub_categories')->insert([
            'name' => 'Retail stores',
            'category_id'=>3,
             'created_at'=>date('Y-m-d H:i:s'),
             'updated_at'=>date('Y-m-d H:i:s'),
            ]);


          DB::table('sub_categories')->insert([
            'name' => 'Farm Land',
            'category_id'=>3,
             'created_at'=>date('Y-m-d H:i:s'),
             'updated_at'=>date('Y-m-d H:i:s'),
            ]);

          DB::table('sub_categories')->insert([
            'name' => 'Medical Centers',
            'category_id'=>3,
             'created_at'=>date('Y-m-d H:i:s'),
             'updated_at'=>date('Y-m-d H:i:s'),
            ]);


            DB::table('sub_categories')->insert([
            'name' => 'Garages',
            'category_id'=>3,
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
        Schema::dropIfExists('sub_categories');
    }
}
