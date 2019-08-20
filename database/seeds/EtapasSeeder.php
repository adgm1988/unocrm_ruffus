<?php

use Illuminate\Database\Seeder;
use App\Etapa;
use Faker\Generator as Faker;

class EtapasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $etapas = ['Prospecto','Contactado','Necesidad','Propuesta','Cierre'];
        foreach ($etapas as $key => $etapa){
        	Etapa::create([
        	'etapa'=>$etapa,
        	'orden'=>($key+1),
            'dias'=>$faker->numberBetween(2,25),
        	'color'=>$faker->hexcolor
        ]);
        }
    }
}
