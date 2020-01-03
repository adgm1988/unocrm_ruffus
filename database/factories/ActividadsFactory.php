<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use Faker\Generator as Faker;
use App\Actividad;

$factory->define(Actividad::class, function (Faker $faker) {
   
    return [
        '_prospectoid'=> $faker->numberBetween(1,100),
        '_tipoactid'=> $faker->numberBetween(1,4),
        'fecha'=> $faker->dateTimeThisYear(),
        'hora'=> str_pad($faker->numberBetween(0,23),2,0,STR_PAD_LEFT).":00",
        'duracion'=> '00:30',
        'descripcion'=> $faker->sentence(6,true),
        'resultado'=> $faker->sentence(9,true),
        'realizada'=>$faker->boolean(),
        'created_by'=> $faker->numberBetween(1,4),
        'edited_by'=> $faker->numberBetween(1,4)
    ];
});
