<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaxProductTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tax_product_type', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type')->unique()->comment('product type');
            $table->integer('default_tax')->comment('in %');
            $table->timestamps();
        });

        Schema::table('products', function(Blueprint $table){
            $table->foreign('tax_product_type_id')->references('id')->on('tax_product_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tax_product_type');
    }
}
