<?php

use Illuminate\Database\Seeder;

class brandsseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tb_brands')->insert([
        	'name'=>'teste'
        ]);
    }
}