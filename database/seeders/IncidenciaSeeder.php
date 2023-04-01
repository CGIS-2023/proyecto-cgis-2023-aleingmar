<?php

namespace Database\Seeders;

//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IncidenciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('incidencias')->insert([
            [ // 1
                'acceso_id' => 1,
                'sanitario_id'=>1,
                'fechaPresentacion'=> '2021-05-29 04:15:00', 
                'fechaAceptacion'=> '2021-05-30 07:15:00',
                'fechaRechazo'=> Null,
                'motivoIncidencia'=> 'Entré a las xxx',
                'motivoRespuesta'=> Null,
            ],
            
           
        ]);
    }
}
