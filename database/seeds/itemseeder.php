<?php

use Illuminate\Database\Seeder;

class itemseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tb_items')->insert([
        	'name'=>'teste',
            'price'=>'10',
            'brand_id' => '1',
            'category_id' => '1',
            'item_stock_id' => '1'
        ]);
    }
}