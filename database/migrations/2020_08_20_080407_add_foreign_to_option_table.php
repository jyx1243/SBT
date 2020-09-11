<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignToOptionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('option', function (Blueprint $table) {
            $table->foreign('product_id')->references('id')->on('product');
            $table->foreign('default_price_id')->references('id')->on('price');
            $table->foreign('default_location_id')->references('id')->on('location');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('option', function (Blueprint $table) {
            $table->dropForeign(['product_id']);
        });
    }
}
