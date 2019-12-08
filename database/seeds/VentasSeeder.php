<?php

use Illuminate\Database\Seeder;
use App\Venta;


class VentasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Venta::class,500)->create();
    }
}
