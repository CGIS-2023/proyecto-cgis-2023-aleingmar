<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSanitarioEspecialidadTable extends Migration
{

    public function up()
    {
        Schema::create('sanitario__especialidad', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->date('fechaInicio');
            $table->date('fechaFin');
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
