<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->unsignedInteger('brand_id');
            $table->string('sku');
            $table->text('product_details');
            $table->text('additional_details')->nullable();
            $table->text('term_and_condition')->nullable();
            $table->integer('minimum_quantity');
            $table->integer('order_amount');
            $table->integer('handling_fee')->default(0);
            $table->tinyInteger('is_featured')->default(0);
            $table->tinyInteger('is_free_shipping')->default(0);
            $table->tinyInteger('is_review_allowed')->default(0);
            $table->mediumText('page_title')->nullable();
            $table->mediumText('seo_keywords')->nullable();
            $table->mediumText('seo_description')->nullable();
            $table->string('product_page_slug')->nullable();
            $table->string('attribute_set_value')->nullable();
            $table->unsignedInteger('tax_product_type_id'); 
            $table->string('top_selling_count')->default(0);           
            $table->tinyInteger('status');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
