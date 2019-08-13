<?php

use Illuminate\Database\Seeder;
use App\Tipoact;
use Faker\Generator as Faker;

class TipoactsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        //
        $tipos = ['Llamada','Correo','Visita','Cotización'];
        foreach ($tipos as $key => $tipo){
        	Tipoact::create([
        	'tipo'=>$tipo,
        	'orden'=>($key+1),
        	'color'=>$faker->hexcolor,
            'color_realizada'=>$faker->hexcolor
        ]);
        }
        
    }
}
