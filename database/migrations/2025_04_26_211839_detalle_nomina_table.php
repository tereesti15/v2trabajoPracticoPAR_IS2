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
        Schema::create('detalle_nomina', function (Blueprint $table) {
            $table->id('id_detalle_nomina');
            $table->unsignedBigInteger('id_nomina');
            $table->unsignedBigInteger('id_empleado');
            $table->unsignedBigInteger('id_concepto');
            $table->string('detalle_concepto')-> nullable();
            $table->integer('monto_concepto');
            $table->foreign('id_nomina')->references('id_nomina')->on('nomina')->onDelete('cascade');
            $table->foreign('id_empleado')->references('id_empleado')->on('empleados')->onDelete('cascade');
            $table->foreign('id_concepto')->references('id_concepto')->on('concepto_salario')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_nomina');
    }
};
