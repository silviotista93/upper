<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->double('latitude');
            $table->double('longitude');
            $table->enum('status', [
                \App\Order::PEDIDO, \App\Order::REALIZADO, \App\Order::CANCELADO
            ])->default(\App\Order::PEDIDO);
            $table->string('sign')->nullable();
            $table->text('description')->nullable();
            $table->unsignedInteger('subscription_cars_id');
            $table->foreign('subscription_cars_id')->references('id')->on('car_subscriptions');
            $table->unsignedInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedInteger('washer_id')->nullable();
            $table->foreign('washer_id')->references('id')->on('washers');
            $table->string('address')->nullable();
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
