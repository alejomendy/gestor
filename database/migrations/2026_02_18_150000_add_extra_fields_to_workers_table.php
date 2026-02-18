<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration 
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('workers', function (Blueprint $table) {
            $table->string('phone')->nullable()->after('contract_path');
            $table->string('email')->nullable()->after('phone');
            $table->string('address')->nullable()->after('email');
            $table->string('city')->nullable()->after('address');
            $table->date('birth_date')->nullable()->after('city');
            $table->date('hire_date')->nullable()->after('birth_date');
            $table->string('photo_path')->nullable()->after('hire_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('workers', function (Blueprint $table) {
            $table->dropColumn([
                'phone',
                'email',
                'address',
                'city',
                'birth_date',
                'hire_date',
                'photo_path',
            ]);
        });
    }
};
