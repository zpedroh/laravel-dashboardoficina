<?php

use Illuminate\Database\Seeder;

class clientrecordseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tb_client_records')->insert([
            'client_id'=>'1',
            'user_id'=>'1',
            'record-total'=>'1',
            'status'=>'1',
            'plaque'=>'1'
        ]);
    }
}
