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

            $table->integer('option_id');
            // $table->foreign('option_id')->references('id')->on('option')->onUpdate('cascade')->onDelete('cascade');

            $table->tinyInteger('zone_id');
            // $table->foreign('zone_id')->references('id')->on('zone')->onUpdate('cascade')->onDelete('cascade');

            $table->enum('layer', ['上', '中', '下'])->nullable()->comment('層');
            $table->tinyInteger('col')->nullable()->comment('直行');
            $table->tinyInteger('row')->nullable()->comment('橫列');

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
