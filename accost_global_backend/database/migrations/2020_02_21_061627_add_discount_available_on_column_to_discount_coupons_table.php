<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDiscountAvailableOnColumnToDiscountCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    /*public function up()
    {
        Schema::table('coupons', function (Blueprint $table) {
           $table->boolean('discount_available_on')->comment('0:all, 1:category,2:product');
        });
    }*/

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    /*public function down()
    {
        Schema::table('coupons', function (Blueprint $table) {
            //
        });
    }*/
}
