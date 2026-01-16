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
        Schema::create('reporte_usuarios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reporteId')->constrained('reportes')->cascadeOnDelete();
            $table->foreignId('userId')->constrained('users')->cascadeOnDelete();

            $table->unique(['reporteId', 'userId']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reporte_usuarios');
    }
};
