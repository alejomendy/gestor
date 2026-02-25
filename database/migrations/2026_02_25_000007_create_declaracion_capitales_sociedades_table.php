<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('declaracion_capitales_sociedades', function (Blueprint $table) {
            $table->id();
            $table->foreignId('declaracion_jurada_id')->constrained('declaraciones_juradas')->cascadeOnDelete();
            $table->string('denominacion')->nullable();
            $table->string('ramo_actividad')->nullable();
            $table->string('domicilio')->nullable();
            $table->string('porcentaje_capital')->nullable();
            $table->decimal('ultima_valuacion', 15, 2)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('declaracion_capitales_sociedades');
    }
};
