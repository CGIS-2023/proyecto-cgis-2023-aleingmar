<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EspecialidadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('especialidads')->insert([
            [
                'nombre' => "Oftalmología",
            ],
            [
                'nombre' => "Neurología",
            ],
            [
                'nombre' => "Cardiología",
            ],
            [
                'nombre' => "Dermatología",
            ],
        ]);

        //seeder tabla intermedia entre medicamento y especialidad

        
        DB::table('especialidad_sanitario')->insert([
            [
                'sanitario_id' => 2,
                'especialidad_id' => 1,
                'fechaInicio' => '2021-05-31',
                'fechaFin' => '2021-06-07',
            ],
            
        ]);
    }
}
