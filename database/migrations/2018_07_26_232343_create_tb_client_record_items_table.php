<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbClientRecordItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_client_record_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('item_id')->unsigned();
            $table->integer('client_record_id')->unsigned();
            $table->integer('quantity', 2);
            $table->double('item_total', 10, 2);
            $table->timestamps();
        });

        Schema::table('tb_client_record_items', function ( $table) {            
            $table->foreign('item_id')->references('id')->on('tb_items');
            $table->foreign('client_record_id')->references('id')->on('tb_client_records')->onDelete('cascade');            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_client_record_items');
    }
}
