<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\EstadoNomina;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('nomina', function (Blueprint $table) {
            $table->id('id_nomina');
            $table->timestamp('periodo');//indica mes y anho de la nomina
            $table->timestamp('fecha_proceso_liquidacion');
            $table->enum('estado_nomina', array_column(EstadoNomina::cases(), 'value'))->default(EstadoNomina::Modificable->value);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nomina');
    }
};
