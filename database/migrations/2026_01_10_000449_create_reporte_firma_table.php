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
        Schema::create('reporte_firma', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reporteId')->constrained('reportes')->cascadeOnDelete();
            $table->string('firmaRuta');
            $table->string('nombreFirmante');
            $table->string('cedulaFirmante');

            $table->timestamp('firmadoEn');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reporte_firma');
    }
};
