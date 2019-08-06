<?php

use Illuminate\Database\Seeder;
use App\Prospecto;

class ProspectosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         factory(Prospecto::class,100)->create();
    }
}
