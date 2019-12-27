<?php

use Illuminate\Database\Seeder;
use App\Industry;

class IndustriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $industrias = ['Hospedaje','Entrenamiento','Estética','Veterinaria','Day-Care'];
        foreach ($industrias as $key => $industria){
        	Industry::create([
        	'industria'=>$industria,
        	'orden'=>($key+1)
        ]);
        }
    }
}
