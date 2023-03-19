<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{


    //MUY IMPORTANTE HAY QUE SE LLAMAN A LOS SEEDERS


    /**
     * Seed the application's database.
     *
     * @return void
     */

     //hay que poner el orden correcto de migraciones
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            //HAY QUE PONERLAS EN ORDEN CORRECTO COMO LAS MIGRACIONES

            UserSeeder::class,
            SanitarioSeeder::class,
            AccesoSeeder::class,

        ]);
    }
}
