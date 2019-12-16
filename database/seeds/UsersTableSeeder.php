<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'=>'Admin Demo',
            'email'=>'admin@uno.uno',
            'password'=>bcrypt('12341234'),
            'admin'=>true,
            'meta'=>0,
        ]);
        User::create([
        	'name'=>'Consultor Demo',
        	'email'=>'consultor@uno.uno',
        	'password'=>bcrypt('12341234'),
            'consultor'=>true,
            'meta'=>0,
        ]);
        User::create([
            'name'=>'Director Demo',
            'email'=>'director@uno.uno',
            'password'=>bcrypt('12341234'),
            'director'=>true,
            'meta'=>0,
        ]);
        User::create([
            'name'=>'Vendedor Demo',
            'email'=>'vendedor@uno.uno',
            'password'=>bcrypt('12341234'),
            'vendedor'=>true,
            'meta'=>0,
        ]);

        //Si quisiera crear 5 usuarios aparte de Juan
        factory(User::class, 4)->create();
    }
}
