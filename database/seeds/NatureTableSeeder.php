<?php

use Illuminate\Database\Seeder;

class NatureTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('natures')->insert([
            'code' => 'N01',
            'name' =>  'Téorico',
            'state' => 1,
            'created_at' => NOW(),
            'updated_at' => NOW()
        ]);
        \DB::table('natures')->insert([
            'code' => 'N02',
            'name' =>  'Práctico',
            'state' => 1,
            'created_at' => NOW(),
            'updated_at' => NOW()
        ]);
        \DB::table('natures')->insert([
            'code' => 'N03',
            'name' =>  'Téorico-Práctico',
            'state' => 1,
            'created_at' => NOW(),
            'updated_at' => NOW()
        ]);
    }
}
