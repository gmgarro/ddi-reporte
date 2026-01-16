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
        Schema::create('ajuste_parametros', function (Blueprint $table) {
            $table->id();

            $table->string('nombre');

            $table->string('tipo');

            // Valores numéricos
            $table->decimal('primerValor', 10, 2);
            $table->decimal('segundoValor', 10, 2)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ajuste_parametros');
    }
};
