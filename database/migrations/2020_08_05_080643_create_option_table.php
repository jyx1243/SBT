<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOptionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('option', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->string('name')->nullable();
            $table->string('image')->nullable();
            $table->integer('default_price_id')->unsigned()->nullable()->comment('默認價格');
            $table->integer('default_location_id')->unsigned()->nullable()->comment('默認位置');
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
        Schema::dropIfExists('option');
    }
}
