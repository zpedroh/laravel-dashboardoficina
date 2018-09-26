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
            $table->double('price', 10, 2);
            $table->integer('brand_id')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->integer('item_stock_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('tb_items', function ( $table) {
            $table->foreign('brand_id')->references('id')->on('tb_brands');
            $table->foreign('category_id')->references('id')->on('tb_categories');
            $table->foreign('item_stock_id')->references('id')->on('tb_item_stocks');
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
