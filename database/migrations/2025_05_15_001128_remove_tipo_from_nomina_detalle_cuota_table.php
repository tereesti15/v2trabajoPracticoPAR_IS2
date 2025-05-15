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
        Schema::table('nomina_detalle_cuotas', function (Blueprint $table) {
            $table->dropColumn('tipo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('nomina_detalle_cuotas', function (Blueprint $table) {
            $table->enum('tipo', array_column(TipoConceptoNomina::cases(), 'value'))->default(TipoConceptoNomina::ACREDITACION->value);
        });
    }
};
