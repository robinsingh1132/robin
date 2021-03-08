<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->mediumText('slug');
            $table->mediumText('page_title')->nullable()->default(null);
            $table->mediumText('seo_keywords')->nullable()->default(null);
            $table->mediumText('seo_description')->nullable()->default(null);
            $table->mediumText('icon')->nullable()->default(null);
            $table->boolean('is_featured')->default(0);
            $table->boolean('status')->default(0);
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
        Schema::dropIfExists('product_categories');
    }
}
