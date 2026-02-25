<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('declaraciones_juradas', function (Blueprint $table) {
            $table->decimal('dinero_efectivo_pesos', 15, 2)->nullable()->after('fecha_declaracion');
            $table->decimal('dinero_efectivo_moneda_extranjera', 15, 2)->nullable()->after('dinero_efectivo_pesos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('declaraciones_juradas', function (Blueprint $table) {
            $table->dropColumn(['dinero_efectivo_pesos', 'dinero_efectivo_moneda_extranjera']);
        });
    }
};
