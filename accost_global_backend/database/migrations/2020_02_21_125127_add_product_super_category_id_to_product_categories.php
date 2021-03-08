<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProductSuperCategoryIdToProductCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*Schema::table('product_categories', function (Blueprint $table) {            
            $table->unsignedInteger('product_super_category_id');
        });
        Schema::table('product_categories', function(Blueprint $table){
            $table->foreign('product_super_category_id')->references('id')->on('product_super_categories');            
        });*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        /*Schema::table('product_categories', function (Blueprint $table) {
            $table->dropColumn('product_super_category_id');
        });
*/    }
}
