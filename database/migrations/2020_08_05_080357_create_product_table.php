<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('subname')->nullable()->comment('別名');

            $table->tinyInteger('category_id');
            // $table->foreign('category_id')->references('id')->on('category')->onUpdate('cascade')->onDelete('cascade');
            
            $table->timestamp('searched_at')->nullable()->comment('最後搜尋時間');
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
        Schema::dropIfExists('product');
    }
}
