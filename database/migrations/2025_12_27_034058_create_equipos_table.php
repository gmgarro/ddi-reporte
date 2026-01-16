<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('equipos', function (Blueprint $table) {
            $table->id();

            $table->string('nombre');
            $table->text('descripcion')->nullable();

            // Estado: mejor como string fijo (select)
            $table->string('estado');

            $table->datetime('fechaCambio');

            // Relaciones
            $table->foreignId('tipoEquipoId')
                  ->constrained('tipos_equipos')
                  ->cascadeOnDelete();

            $table->foreignId('usuarioId')
                  ->constrained('users')
                  ->cascadeOnDelete();

            $table->foreignId('puntoVentaId')
                  ->nullable()
                  ->constrained('puntos_venta')
                  ->nullOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('equipos');
    }
};
