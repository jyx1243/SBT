<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIngredientOptionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingredient_option', function (Blueprint $table) {
            $table->integer('ingredient_id')->unsigned();
            $table->integer('option_id')->unsigned();
            $table->tinyInteger('unit_id')->unsigned();
            $table->smallInteger('quantity')->unsigned()->comment('數量');
            $table->timestamps();

            $table->primary(['ingredient_id', 'option_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ingredient_option');
    }
}
