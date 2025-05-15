<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Contiene calculos porcentuales sobre salario minimo, por ejemplo
     * bonificacion familiar
     */
    public function up(): void
    {
        Schema::create('nomina_porcentual_minimo', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_concepto');
            $table->unsignedBigInteger('id_nomina');
            $table->string('detalle_concepto');
            $table->float('porcentaje');
            $table->foreign('id_concepto')->references('id_concepto')->on('concepto_salario')->onDelete('cascade');
            $table->foreign('id_nomina')->references('id_empleado')->on('empleados')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nomina_porcentual_minimo');
    }
};
