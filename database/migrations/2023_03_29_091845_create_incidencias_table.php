<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


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
            //si borro un acceso se borran sus incidencias
            $table->foreignId('acceso_id')->nullable()->constrained()->onDelete('cascade');
            //si borro un sanitario borro la incidencia  no se borra el acceso al que hace referencia
            $table->foreignId('sanitario_id')->unique()->constrained()->onDelete('cascade');
            /////////////////
            
            $table->dateTime('fechaPresentacion');
            $table->dateTime('fechaAceptacion')->nullable();
            $table->dateTime('fechaRechazo')->nullable();
            $table->string('motivoIncidencia')->nullable();
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
