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
        Schema::create('mediciones_reporte', function (Blueprint $table) {
            $table->id();
            $table->decimal('medicionInicial', 10, 2);
            $table->decimal('medicionFinal', 10, 2);

            $table->foreignId('reporteId')->constrained('reportes')->cascadeOnDelete();
            $table->foreignId('ajusteParametroId')->constrained('ajuste_parametros')->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mediciones_reporte');
    }
};
