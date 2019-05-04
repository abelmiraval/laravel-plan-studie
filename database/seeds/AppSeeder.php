<?php

use Illuminate\Database\Seeder;

class AppSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(App\Area::class, 10)->create();
        factory(App\Nature::class, 10)->create();
        factory(App\Term::class, 10)->create();
        factory(App\Capacity::class, 10)->create();
        factory(App\Content::class, 10)->create();


    }
}
