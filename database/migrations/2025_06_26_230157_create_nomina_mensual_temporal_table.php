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
        Schema::create('nomina_mensual_temporal', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_concepto');
            $table->unsignedBigInteger('id_empleado');
            $table->string('detalle_concepto');
            $table->integer('mes_proceso');
            $table->integer('anho_proceso');
            $table->boolean('procesado')->default(false);
            $table->integer('monto_concepto');
            $table->foreign('id_concepto')->references('id_concepto')->on('concepto_salario')->onDelete('cascade');
            $table->foreign('id_empleado')->references('id_empleado')->on('empleados')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nomina_mensual_temporal');
    }
};
