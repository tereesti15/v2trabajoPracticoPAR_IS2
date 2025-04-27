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
        Schema::create('concepto_salario', function (Blueprint $table) {
            $table->id('id_concepto');
            $table->string('nombre_concepto');
           // $table->enum('tipo', array_column(TipoConceptoNomina::cases(), 'value'));
            $table->enum('tipo', array_column(TipoConceptoNomina::cases(), 'value'))->default(TipoConceptoNomina::ACREDITACION->value);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('concepto_salario');
    }
};
