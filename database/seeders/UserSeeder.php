<?php

namespace Database\Seeders;

//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            [
                'name' => "Administrador",
                'email' => "administrador@administrador.com",
                'password' => Hash::make('12345678'),
            ],
            [
                'name' => "Jorge Andaluz",
                'email' => "enfermero@enfermero.com",
                'password' => Hash::make('12345678'),
            ],
            [
                'name' => "Cristian Nieto",
                'email' => "medico@medico.com",
                'password' => Hash::make('12345678'),
            ],
            [
                'name' => "Rosa Teamo",
                'email' => "direccion@direccion.com",
                'password' => Hash::make('12345678'),
            ],
            [
                'name' => "María del Monte",
                'email' => "jefeguardia@jefeguardia.com",
                'password' => Hash::make('12345678'), //hasheo las contraseñas, y guardo solo los hashing
            ],

            [
                'name' => "Tayron Power",
                'email' => "tayron@tayron.com",
                'password' => Hash::make('12345678'), //hasheo las contraseñas, y guardo solo los hashing
            ],
        ]);
    }
}
