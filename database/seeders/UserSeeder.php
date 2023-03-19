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
                'name' => "Enfermero 1",
                'email' => "enfermero@enfermero.com",
                'password' => Hash::make('12345678'),
            ],
            [
                'name' => "Médico 1",
                'email' => "medico@medico.com",
                'password' => Hash::make('12345678'),
            ],
            [
                'name' => "Direccion",
                'email' => "direccion@direccion.com",
                'password' => Hash::make('12345678'),
            ],
            [
                'name' => "Jefe de Guardia",
                'email' => "jefeguardia@jefeguardia.com",
                'password' => Hash::make('12345678'), //hasheo las contraseñas, y guardo solo los hashing
            ],
        ]);
    }
}
