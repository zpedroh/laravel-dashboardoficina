<?php

use Illuminate\Database\Seeder;

class movimentseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tb_movements')->insert([
            'mov-type'=>'1',
            'quantity'=>'1',
            'item_id'=>'2',
            'client_record_item_id'=>'4'
        ]);
    }
}