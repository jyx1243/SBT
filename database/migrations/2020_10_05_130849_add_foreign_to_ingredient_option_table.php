<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignToIngredientOptionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ingredient_option', function (Blueprint $table) {
            $table->foreign('ingredient_id')->references('id')->on('ingredient')->onDelete('cascade');
            $table->foreign('option_id')->references('id')->on('option')->onDelete('cascade');
            $table->foreign('unit_id')->references('id')->on('unit');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ingredient_option', function (Blueprint $table) {
            //
        });
    }
}
