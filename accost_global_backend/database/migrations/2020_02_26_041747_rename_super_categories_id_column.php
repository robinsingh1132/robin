<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameSuperCategoriesIdColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*Schema::table('coupons_categories', function (Blueprint $table) {
            $table->renameColumn('super_categories_id', 'categories_id');
        });*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       /* Schema::table('coupons_categories', function (Blueprint $table) {
            $table->renameColumn('categories_id', 'super_categories_id');
        });*/
    }
}
