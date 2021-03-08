<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscountCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('coupon_type')->comment('0:Amount, 1:Percentage');
            $table->string('name')->unique();
            $table->string('coupon_code')->unique();
            $table->text('coupon_description');
            $table->integer('value')->comment('in % or amount');
            /*$table->string('currency');*/
            $table->string('duration');
            $table->integer('repeating_days')->nullable();
            $table->mediumInteger('minimum_quantity');
            $table->mediumInteger('maximum_quantity');
            $table->mediumInteger('maximum_redemption')->nullable();
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->tinyInteger('status')->comment('0:Inactive, 1:Active')->default(1);
            $table->tinyInteger('coupon_available_on')->comment('0:all, 1:category,2:product');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coupons');
    }
}
