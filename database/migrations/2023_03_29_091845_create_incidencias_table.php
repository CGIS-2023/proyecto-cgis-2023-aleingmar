<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CreateIncidenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incidencias', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('acceso_id')->nullable()->constrained()->onDelete('set null');
            //si borro una incidencia no se borra el acceso al que hace referencia
            $table->foreignId('sanitario_id')->unique()->constrained()->onDelete('set null');
            /////////////////
            $table->dateTime('fechaAceptacion')->nullable();
            $table->dateTime('fechaRechazo')->nullable();
            $table->string('motivoPresentacion')->nullable();
            $table->string('motivoRespuesta')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('incidencias');
    }
};
