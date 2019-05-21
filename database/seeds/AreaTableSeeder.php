<?php

use Illuminate\Database\Seeder;

class AreaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('areas')->insert([
            'code' => 'A01',
            'name' =>  'Formación General',
            'state' => 1,
            'created_at' => NOW(),
            'updated_at' => NOW()
        ]);
        \DB::table('areas')->insert([
            'code' => 'A02',
            'name' =>  'Formación Específica',
            'state' => 1,
            'created_at' => NOW(),
            'updated_at' => NOW()
        ]);
        \DB::table('areas')->insert([
            'code' => 'A03',
            'name' =>  'Formación Especializada',
            'state' => 1,
            'created_at' => NOW(),
            'updated_at' => NOW()
        ]);
    }
}
