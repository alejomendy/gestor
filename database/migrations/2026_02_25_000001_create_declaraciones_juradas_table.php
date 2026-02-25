<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('declaraciones_juradas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('worker_id')->constrained('workers')->cascadeOnDelete();
            $table->string('legajo')->nullable();
            $table->string('estado_civil')->nullable();
            $table->string('ci_numero')->nullable();
            $table->string('ci_expedida_por')->nullable();
            $table->string('profesion')->nullable();
            $table->string('domicilio')->nullable();
            $table->string('lugar_fecha')->nullable();
            $table->date('fecha_declaracion')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('declaraciones_juradas');
    }
};
