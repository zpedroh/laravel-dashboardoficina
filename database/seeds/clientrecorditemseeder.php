<?php

use Illuminate\Database\Seeder;

class clientrecorditemseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tb_client_record_items')->insert([
            'item_id'=>'2',
            'client_record_id'=>'1',
            'quantity'=>'1',
            'item-total'=>'1'
        ]);
    }
}