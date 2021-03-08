<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_addresses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id');
            $table->integer('pincode');
            $table->string('locality');
            $table->string('address');
            $table->string('city_district_town');
            $table->string('state');
            $table->string('landmark');
            $table->string('contact_number',15)->nullable();
            $table->string('alternate_contact_number',15)->nullable();
            $table->tinyInteger('address_type')->comment('0:home, 1:office,')->default(0);
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
        Schema::dropIfExists('user_addresses');
    }
}
