<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryDiscountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('coupon_id');
            $table->unsignedInteger('super_category_id');
            $table->unsignedInteger('product_category_id');
            $table->unsignedInteger('sub_category_id');
            $table->boolean('status')->default(0);
            $table->timestamps();
        });
        Schema::table('coupons_categories', function (Blueprint $table) {
            /*$table->foreign('coupons_id')->references('id')->on('coupons');
           $table->foreign('product_category_id')->references('id')->on('product_super_categories');*/
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coupons_categories');
    }
}
