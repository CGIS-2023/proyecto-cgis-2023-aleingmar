<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSanitarioEspecialidadTable extends Migration
{

    public function up()
    {
        Schema::create('sanitario_especialidad', function (Blueprint $table) {
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
        Schema::dropIfExists('sanitario__especialidad');
    }
};
