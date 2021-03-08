<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHighlightsSubcategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('highlights_subcategories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('highlight_id');
            $table->unsignedInteger('product_subcategories_id');
            $table->unsignedInteger('product_categories_id');
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
        Schema::dropIfExists('highlights_subcategories');
    }
}
