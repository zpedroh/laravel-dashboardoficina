<?php

use Illuminate\Database\Seeder;

class categoryseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tb_categories')->insert([
        	'name'=>'teste'
        ]);
    }
}
  