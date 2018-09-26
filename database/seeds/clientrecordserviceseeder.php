<?php

use Illuminate\Database\Seeder;

class clientrecordserviceseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tb_client_record_services')->insert([
            'service_id'=>'1',
            'client_record_id'=>'1',
            'quantity'=>'1',
            'service-total'=>'1'
        ]);
    }
}
