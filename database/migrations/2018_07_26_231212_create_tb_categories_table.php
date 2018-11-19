<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 40); 
            $table->timestamps();           
        });
    }

    public function down()
    {
        Schema::dropIfExists('tb_categories');
    }
}
