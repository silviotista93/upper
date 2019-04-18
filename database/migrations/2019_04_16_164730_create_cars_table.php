<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->increments('id');
            $table->string('board');
            $table->string('picture');
            $table->unsignedInteger('car_type_id');
            $table->foreign('car_type_id')->references('id')->on('car_types');
            $table->unsignedInteger('cilindraje_id');
            $table->foreign('cilindraje_id')->references('id')->on('cilindrajes');
            $table->unsignedInteger('brand_id');
            $table->foreign('brand_id')->references('id')->on('brands');
            $table->unsignedInteger('color_id');
            $table->foreign('color_id')->references('id')->on('colors');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('cars');
    }
}
