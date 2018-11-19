<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 20);
            $table->string('location', 8);
            $table->decimal('price', 10, 2);
            $table->integer('brand_id')->unsigned();
            $table->foreign('brand_id')->references('id')->on('tb_brands');
            $table->integer('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('tb_categories');
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
        Schema::dropIfExists('tb_items');
    }
}
