<?php

namespace Database\Seeders;

//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccesoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('accesos')->insert([
            [ //no se si es personal_sanitario_id o PersonalSanitario_id
                'sanitario_id' => 2,
                'entrada' => '2021-05-30 07:15:00',
                'salida' => '2021-05-30 15:30:10',
            ],
            [
                'sanitario_id' => 2,
                'entrada' => '2021-05-30 08:15:40',
                'salida' => '2021-05-30 16:30:20',
            ],
            [
                'sanitario_id' => 2,
                'entrada' => '2021-05-30 07:25:00',
                'salida' => '2021-05-30 15:36:10',
            ],

            [
                'sanitario_id' => 3,
                'entrada' => '2021-07-15 08:00:00',
                'salida' => '2021-07-30 14:30:00',
            ],

            [
                'sanitario_id' => 3,
                'entrada' => '2021-08-30 06:30:00',
                'salida' => '2021-08-30 15:15:30',
            ],
            [
                'sanitario_id' => 3,
                'entrada' => '2021-09-10 10:45:00',
                'salida' => '2021-09-27 17:15:00',
            ],
            [
                'sanitario_id' => 3,
                'entrada' => '2021-10-30 17:30:00',
                'salida' => '2021-11-15 21:30:00',
            ],
            [
                'sanitario_id' => 4,
                'entrada' => '2021-03-05 18:15:00',
                'salida' => '2021-03-25 22:30:00',
            ],
            [
                'sanitario_id' => 5,
                'entrada' => '2021-06-01 05:00:00',
                'salida' => '2021-06-22 12:30:00',
            ],
            [
                'sanitario_id' => 5,
                'entrada' => '2021-02-28 18:15:00',
                'salida' => '2021-03-15 23:45:00',
            ],
            [
                'sanitario_id' => 4,
                'entrada' => '2021-11-26 08:00:00',
                'salida' => '2021-11-28 15:35:00',
            ],
            [
                'sanitario_id' => 2,
                'entrada' => '2021-09-30 12:30:00',
                'salida' => '2021-10-30 19:30:00',
            ],
            [
                'sanitario_id' => 3,
                'entrada' => '2021-03-01 06:25:00',
                'salida' => '2021-03-15 13:45:00',
            ],
            [
                'sanitario_id' => 3,
                'entrada' => '2021-12-01 12:15:00',
                'salida' => '2021-12-30 19:44:21',
            ],
            [
                'sanitario_id' => 3,
                'entrada' => '2021-03-12 08:00:00',
                'salida' => '2021-04-30 19:15:20',
            ],
            [
                'sanitario_id' => 3,
                'entrada' => '2021-08-30 02:30:00',
                'salida' => '2021-10-05 09:30:00',
            ],
            [
                'sanitario_id' => 2,
                'entrada' => '2021-05-08 07:55:00',
                'salida' => '2021-09-17 14:35:40',
            ],
            [
                'sanitario_id' => 3,
                'entrada' => '2021-06-30 06:45:00',
                'salida' => '2021-08-30 13:15:00',
            ],
            [
                'sanitario_id' => 6,
                'entrada' => '2021-06-09 06:15:00',
                'salida' => '2021-06-09 22:00:00',
            ],
            [
                'sanitario_id' => 2,
                'entrada' => '2021-09-15 15:30:00',
                'salida' => '2021-11-30 17:45:00',
            ],
            [
                'sanitario_id' => 3,
                'entrada' => '2021-12-03 05:15:00',
                'salida' => '2021-12-16 12:45:00',
            ],
            [
                'sanitario_id' => 6,
                'entrada' => '2021-09-15 12:30:00',
                'salida' => '2021-09-15 23:45:30',
            ],
            [
                'sanitario_id' => 6,
                'entrada' => '2021-02-26 10:30:00',
                'salida' => '2021-02-26 19:30:45',
            ],













        ]);
    }
}
