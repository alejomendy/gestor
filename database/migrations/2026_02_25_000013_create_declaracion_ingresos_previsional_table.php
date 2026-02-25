<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('declaracion_ingresos_previsional', function (Blueprint $table) {
            $table->id();
            $table->foreignId('declaracion_jurada_id')->constrained('declaraciones_juradas')->cascadeOnDelete();
            $table->string('tipo_beneficio')->nullable();
            $table->string('caja_prevision')->nullable();
            $table->string('nro_beneficiario')->nullable();
            $table->decimal('monto', 15, 2)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('declaracion_ingresos_previsional');
    }
};
