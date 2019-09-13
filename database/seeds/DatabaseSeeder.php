<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(TipoactsSeeder::class);
        $this->call(EtapasSeeder::class);
        $this->call(ProcedenciasSeeder::class);
        $this->call(RechazoSeeder::class);
        $this->call(ProspectosSeeder::class);
        $this->call(ActividadsSeeder::class);
        $this->call(IndustriesSeeder::class);
    }
}
