<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_clients', function ( $table) {
            $table->increments('id');
            $table->string('name', 45);
            $table->string('cpf', 11);
            //endereço
            $table->string('country',30);
            $table->string('state', 30);
            $table->string('zipcode', 10);
            $table->string('city', 11);
            $table->string('district', 11);//bairro
            $table->string('street', 11);
            //$table->string('adress', 11);//endereço            
            $table->integer('number');
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
        Schema::dropIfExists('tb_clients');
    }
}
