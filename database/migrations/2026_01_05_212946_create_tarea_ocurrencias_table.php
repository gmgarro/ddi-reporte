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
        Schema::create('tarea_ocurrencias', function (Blueprint $table) {
            $table->id();
           

            $table->date('fecha');

            $table->enum('estado', [
                'pendiente',
                'en_progreso',
                'pausada',
                'completada',
                'cancelada'
            ])->default('pendiente');

            $table->dateTime('inicio_real')->nullable();
            $table->dateTime('fin_real')->nullable();
            $table->integer('duracion_minutos')->nullable();

            $table->foreignId('tareaId')->constrained('tareas')->cascadeOnDelete();
            $table->timestamps();

            $table->unique(['tareaId', 'fecha']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tarea_ocurrencias');
    }
};
