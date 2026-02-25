<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('declaracion_capitales_titulos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('declaracion_jurada_id')->constrained('declaraciones_juradas')->cascadeOnDelete();
            $table->string('tipo')->nullable();
            $table->string('entidad_emisora')->nullable();
            $table->string('cantidad')->nullable();
            $table->decimal('valor_unitario_cotiz', 15, 2)->nullable();
            $table->decimal('valor_total', 15, 2)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('declaracion_capitales_titulos');
    }
};
