<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('location', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('option_id')->unsigned();
            $table->tinyInteger('zone_id')->unsigned();
            
            $table->enum('layer', ['上', '中', '下'])->nullable()->comment('層');
            $table->tinyInteger('col')->unsigned()->nullable()->comment('直行');
            $table->tinyInteger('row')->unsigned()->nullable()->comment('橫列');

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
        Schema::dropIfExists('location');
    }
}
