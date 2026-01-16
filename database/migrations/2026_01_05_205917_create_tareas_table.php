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
        Schema::create('tareas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->text('descripcion')->nullable();


            $table->enum('frecuencia', [
                'unica',
                'diaria',
                'semanal',
                'quincenal',
                'mensual'
            ]);
            $table->json('dias_semana')->nullable(); // [1,3,5]
            $table->date('fecha_inicio');
            $table->date('fecha_fin')->nullable();

            $table->foreignId('puntoVentaId')
                  ->constrained('puntos_venta')
                  ->cascadeOnDelete();

            $table->foreignId('proyecto_id')
            ->nullable() 
            ->constrained('proyectos')
            ->cascadeOnDelete();


            $table->boolean('activa')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tareas');
    }
};
