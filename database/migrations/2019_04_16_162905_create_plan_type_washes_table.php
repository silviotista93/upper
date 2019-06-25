<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlanTypeWashesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plan_type_washes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('type_wash_id');
            $table->foreign('type_wash_id')->references('id')->on('wash_types');
            $table->unsignedInteger('plan_id');
            $table->foreign('plan_id')->references('id')->on('plans');
            $table->integer('quantity')->nullable();
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
        Schema::dropIfExists('plan_type_washes');
    }
}
