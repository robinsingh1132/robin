<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('item_detail_id');
            $table->bigInteger('invoice_id');
            $table->bigInteger('user_id');
            $table->bigInteger('user_multi_address_id');
            $table->bigInteger('payment_id');
            $table->date('order_date');
            $table->date('shipped_date');
            $table->integer('total_amount');
            $table->string('currency');
            $table->text('remark');
            $table->tinyInteger('status')->comment('0:Reject, 1:Approved, 2:Pending')->default(2);
            $table->string('payment_mode',100);           
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
        Schema::dropIfExists('orders');
    }
}
