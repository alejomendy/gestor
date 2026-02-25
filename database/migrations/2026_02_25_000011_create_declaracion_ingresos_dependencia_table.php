<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('declaracion_ingresos_dependencia', function (Blueprint $table) {
            $table->id();
            $table->foreignId('declaracion_jurada_id')->constrained('declaraciones_juradas')->cascadeOnDelete();
            $table->string('cargo')->nullable();
            $table->string('empleador')->nullable();
            $table->decimal('monto', 15, 2)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('declaracion_ingresos_dependencia');
    }
};
