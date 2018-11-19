<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbParcelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_parcels', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('client_record_id')->unsigned();
            $table->foreign('client_record_id')->references('id')->on('tb_client_records')->onDelete('cascade');
            $table->integer('payment_method_id')->unsigned();
            $table->foreign('payment_method_id')->references('id')->on('tb_payment_methods');//->onDelete('cascade');
            $table->integer('status');
            $table->decimal('value');
            $table->integer('number');
            $table->date('date');
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
        Schema::dropIfExists('tb_parcels');
    }
}
