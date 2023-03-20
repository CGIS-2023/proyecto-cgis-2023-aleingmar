<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProfesionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('profesions')->insert([
            [ // 1
                'name' => "Administrador",
            ],
            [ // 2
                'name' => "Enfermero",
            ],
            [ //3
                'name' => "Médico",
            ],
           
        ]);
    }
}
