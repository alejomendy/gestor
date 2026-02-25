<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('declaracion_familiares', function (Blueprint $table) {
            $table->id();
            $table->foreignId('declaracion_jurada_id')->constrained('declaraciones_juradas')->cascadeOnDelete();
            $table->string('apellido_nombres')->nullable();
            $table->string('parentesco')->nullable();
            $table->string('doc_tipo')->nullable();
            $table->string('doc_numero')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('declaracion_familiares');
    }
};
