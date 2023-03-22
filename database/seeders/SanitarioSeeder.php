<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;

//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SanitarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
         //las tablas se llaman como los modelos pero con una s mas 
         DB::table('sanitarios')->insert([
            [   //administrador

                'profesion_id' => 1,
                'cargo_id' => 1,
                'user_id' => 1
            ],
            [ //enfermero

                'profesion_id' => 2,
                'cargo_id' => 4, 
                'user_id' => 2
            ],
            [ //medico
                 'profesion_id' => 2,
                'cargo_id' => 4, 
                'user_id' => 3
            ],
            [ //direccion
                 'profesion_id' => 3,
                'cargo_id' => 2, 
                'user_id' => 4
            ],
            [ //jefe de guardia
                'profesion_id' => 2,
                'cargo_id' => 3, 
                'user_id' => 5
            ],



            [ //tayron medico
                'profesion_id' => 2,
                'cargo_id' => 4, 
                'user_id' => 6
            ],

        ]);
    }
}
