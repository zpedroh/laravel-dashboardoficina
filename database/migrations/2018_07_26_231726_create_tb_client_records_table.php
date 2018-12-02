<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbClientRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_client_records', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('client_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->decimal('record_total')->default('0');
            $table->decimal('discount')->default('0');
            $table->integer('status')->default('1');
            $table->string('plaque', 7)->nullable();
            $table->date('prevision')->nullable();
            $table->date('conclusion')->nullable();
            $table->timestamps();
        });

        Schema::table('tb_client_records', function ( $table) {            
            $table->foreign('client_id')->references('id')->on('tb_clients');
            $table->foreign('user_id')->references('id')->on('users');            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_client_records');
    }
}
