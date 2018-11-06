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
            $table->double('quantity', 10, 2);
            $table->integer('item_id')->unsigned();
            $table->integer('client_record_item_id')->unsigned()->nullable();
            $table->timestamps();
        });

        Schema::table('tb_moviments', function ($table) {            
            $table->foreign('item_id')->references('id')->on('tb_items');
            $table->foreign('client_record_item_id')->references('id')->on('tb_client_record_items');           
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