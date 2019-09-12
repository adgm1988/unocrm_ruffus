<?php

use Illuminate\Database\Seeder;
use App\Rechazos;
use Faker\Generator as Faker;

class RechazoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
   public function run()
    {
        $motivos = ['Precio','Competencia','Calidad','Otro'];
        foreach ($motivos as $key => $motivo){
        	Rechazos::create([
        	'motivo'=>$motivo,
        	'orden'=>($key+1),
        ]);
        }
    }
}
