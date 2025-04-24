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
        Schema::create('cargos', function (Blueprint $table) {
            $table->id('id_cargo');
            $table->string('nombre_cargo');
            $table->string('descripcion_cargo');
            $table->integer('salario_base');
            $table->timestamps();
        });

        Schema::create('parametros', function (Blueprint $table) {
            $table->id('id_parametro');
            $table->integer('salario_minimo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cargos');
        Schema::dropIfExists('parametros');
    }
};
