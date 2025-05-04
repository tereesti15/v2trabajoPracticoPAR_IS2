<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\TipoConceptoNomina;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('nomina_detalle_cuotas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_concepto');
            $table->unsignedBigInteger('id_nomina');
            $table->string('detalle_concepto');
            $table->integer('cant_cuota');
            $table->integer('nro_cuota')->default(1);
            $table->integer('monto_concepto');
            $table->enum('tipo', array_column(TipoConceptoNomina::cases(), 'value'))->default(TipoConceptoNomina::ACREDITACION->value);
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
        Schema::dropIfExists('nomina_detalle_cuotas');
    }
};
