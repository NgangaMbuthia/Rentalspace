<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddExtraColumnProperty extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::table('properties', function (Blueprint $table) {
            $table->integer('category_id')->unsigned()->nullable();
            $table->string('postal_address')->nullable();
            $table->integer('subcategory_id')->unsigned()->nullable();
            $table->foreign('category_id')->references('id')->on('categories')
                ->onUpdate('cascade')->onDelete('cascade');
             $table->foreign('subcategory_id')->references('id')->on('sub_categories')
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
         Schema::table('properties',function($table){
            $table->dropForeign(['category_id']);
             $table->dropForeign(['subcategory_id']);
             $table->dropColumn('category_id');
             $table->dropColumn('subcategory_id');
             $table->dropColumn('postal_address');
             });

       
    }
}
