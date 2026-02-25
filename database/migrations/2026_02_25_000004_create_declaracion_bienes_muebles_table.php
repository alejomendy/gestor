<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('declaracion_bienes_muebles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('declaracion_jurada_id')->constrained('declaraciones_juradas')->cascadeOnDelete();
            $table->string('tipo')->nullable();
            $table->string('descripcion')->nullable();
            $table->string('nro_patente_matricula')->nullable();
            $table->string('porcentaje_propiedad')->nullable();
            $table->date('fecha_ingreso')->nullable();
            $table->decimal('valuacion_actualizada', 15, 2)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('declaracion_bienes_muebles');
    }
};
