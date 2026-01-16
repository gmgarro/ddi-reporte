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
        Schema::create('reportes', function (Blueprint $table) {
            $table->id();

            //Departamento de mantenimiento
            $table->string('contrato');
            $table->date('fecha');

            //Datos generales
            $table->foreignId('tipoMantenimientoId')->constrained('tipos_mantenimientos')->cascadeOnDelete();
            $table->text('descripcion');
                //del equipo
                $table->string('marca');
                $table->string('modelo');
                $table->string('serie');
            $table->string('tipoPlanta');

            //checks
            $table->json('checks')->nullable();

            $table->dateTime('horaInicial');
            $table->dateTime('horaFinal');

            $table->string('referencia')->nullable();
            $table->decimal('costoTotal')->default(0);

            $table->text('recomendaciones');

            $table->text('observaciones')->nullable();

            $table->foreignId('puntoVentaId')->constrained('puntos_venta')->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reportes');
    }
};
