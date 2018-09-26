<?php

use Illuminate\Database\Seeder;

class clientseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tb_clients')->insert([
            'name'=>'Teste',
            'cpf'=>'1',
            'country'=>'1',
            'state'=>'1',
            'zipcode'=>'1',
            'city'=>'1',
            'district'=>'1',
            'street'=>'1',
            'number'=>'1',
        ]);
    }
}