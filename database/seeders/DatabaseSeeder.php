<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
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
            AccesoSeeder::class,

        ]);
    }
}
