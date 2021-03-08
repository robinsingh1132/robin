<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductCategoryDiscountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons_subcategories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('coupons_id');
            $table->unsignedInteger('subcategories_id');
            $table->boolean('status')->default(0);
            $table->timestamps();
        });
        Schema::table('coupons_subcategories', function (Blueprint $table) {
           /* $table->foreign('coupons_id')->references('id')->on('coupons');
            $table->foreign('subcategories_id')->references('id')->on('product_subcategories');*/
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coupons_subcategories');
    }
}
