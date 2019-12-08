<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use Faker\Generator as Faker;
use App\Venta;

$factory->define(Venta::class, function (Faker $faker) {
    return [
        '_prospectoid'=> $faker->numberBetween(1,100),
        'fecha'=> $faker->dateTimeThisYear(),
        'monto'=> $faker->numberBetween(150,1500),
        'detalle'=> $faker->sentence(6,true)
    ];
});
