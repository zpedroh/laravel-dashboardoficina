<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbItemStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_item_stocks', function ( $table) {
            $table->increments('id');            
            $table->integer('quantity');
            $table->integer('quantity_min');
            $table->integer('item_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('tb_item_stocks', function ( $table) {
            $table->foreign('item_id')->references('id')->on('tb_items')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_item_stocks');
    }
}
