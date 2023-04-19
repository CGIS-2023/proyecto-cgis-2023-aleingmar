<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEspecialidadSanitarioTable extends Migration
{

    public function up()
    {
        Schema::create('especialidad_sanitario', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->date('fechaInicio')->nullable();
            $table->date('fechaFin')->nullable();
            $table->foreignId('especialidad_id')->constrained()->onDelete('cascade');
            $table->foreignId('sanitario_id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('especialidad_sanitario');
    }
};
