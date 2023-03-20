<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CargoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('cargos')->insert([
            [ //este será el id=1
                'name' => "Administrador",
            ],
            [
                'name' => "Dirección",
            ],//id= 3
            [ 
                'name' => "Jefe de Guardia",
            ],
            [ 
                'name' => "Profesional Normal",
            ],
            
           
        ]);
    }
}
