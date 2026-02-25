<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('declaracion_depositos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('declaracion_jurada_id')->constrained('declaraciones_juradas')->cascadeOnDelete();
            $table->string('tipo')->nullable();
            $table->string('entidad')->nullable();
            $table->string('localidad_pais')->nullable();
            $table->decimal('monto_pesos', 15, 2)->nullable();
            $table->decimal('monto_moneda_extranjera', 15, 2)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('declaracion_depositos');
    }
};
