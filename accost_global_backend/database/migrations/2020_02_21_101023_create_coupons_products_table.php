<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponsProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('coupons_id');
            $table->unsignedInteger('products_id');
            $table->boolean('status')->default(0);
            $table->timestamps();
        });
        Schema::table('coupons_subcategories', function (Blueprint $table) {
           /* $table->foreign('coupons_id')->references('id')->on('coupons');
           $table->foreign('product_id')->references('id')->on('products');*/
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coupons_products');
    }
}
