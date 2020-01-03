<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use Faker\Generator as Faker;
use App\Prospecto;

$factory->define(Prospecto::class, function (Faker $faker) {

    return [
		'contacto'=> $faker->name,
		'instagram'=> '@'.$faker->userName,
		'dogname'=> $faker->name,
		'dogsize'=> $faker->randomElement($array = array ('XS','S','M','L','XL')),
		'telefono'=> $faker->phoneNumber,
		'correo'=> $faker->email,
		'procedencia'=> $faker->numberBetween(1,4),
		'industria'=> $faker->numberBetween(1,5),
		'valor'=>$faker->randomFloat(2,0,100000),
		'etapa_id'=>$faker->numberBetween(1,5),
		'estatus'=>$faker->randomElement(['prospecto', 'perdido','cliente']),
		'userid'=>$faker->numberBetween(4,7),
    ];
});

