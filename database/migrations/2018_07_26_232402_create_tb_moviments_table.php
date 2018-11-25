<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbMovimentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_moviments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('mov_type');
            $table->integer('quantity');
            $table->decimal('price')->nullable();
            $table->integer('item_id')->unsigned();
            $table->foreign('item_id')->references('id')->on('tb_items');
            $table->integer('client_record_id')->unsigned()->nullable();
            $table->foreign('client_record_id')->references('id')->on('tb_client_records')->onDelete('cascade');
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
        Schema::dropIfExists('tb_movements');
    }
}