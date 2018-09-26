<?php

use Illuminate\Database\Seeder;

class itemstockseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tb_item_stocks')->insert([
        	'quantity'=>'10'
        ]);
    }
}