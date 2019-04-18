<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('car_subscriptions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('subscription_id');
            $table->foreign('subscription_id')->references('id')->on('subscriptions');
            $table->unsignedInteger('cars_id');
            $table->foreign('cars_id')->references('id')->on('cars');
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
        Schema::dropIfExists('car_subscriptions');
    }
}
