<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbClientRecordServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_client_record_services', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('service_id')->unsigned();
            $table->integer('client_record_id')->unsigned();
            $table->integer('quantity');
            $table->double('service-total', 10, 2);
            $table->timestamps();
        });

        Schema::table('tb_client_record_services', function ( $table) {
            $table->foreign('service_id')->references('id')->on('tb_services');
            $table->foreign('client_record_id')->references('id')->on('tb_client_records');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_client_record_services');
    }
}
