<?php

use Illuminate\Database\Seeder;

class TermTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('terms')->insert([
            'code' => 'T01',
            'name' =>  'Obligatorio',
            'state' => 1,
            'created_at' => NOW(),
            'updated_at' => NOW()
        ]);
        \DB::table('terms')->insert([
            'code' => 'T02',
            'name' =>  'Electivo',
            'state' => 1,
            'created_at' => NOW(),
            'updated_at' => NOW()
        ]);
    }
}
