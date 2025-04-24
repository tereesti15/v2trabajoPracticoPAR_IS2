<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\EstadoEmpleado;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('empleados', function (Blueprint $table) {
            $table->id('id_empleado');
            $table->unsignedBigInteger('id_persona');
            $table->unsignedBigInteger('id_cargo');
            $table->unsignedBigInteger('id_departamento');
            $table->timestamp('fecha_ingreso');
            $table->integer('salario_base');
            $table->enum('estado_empleado', array_column(EstadoEmpleado::cases(), 'value'))->default(EstadoEmpleado::Activo->value);
            $table->timestamp('fecha_egreso')-> nullable();
            $table->foreign('id_persona')->references('id')->on('personas')->onDelete('cascade');
            $table->foreign('id_cargo')->references('id_cargo')->on('cargos')->onDelete('cascade');
            $table->foreign('id_departamento')->references('id')->on('departamentos')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empleados');
    }
};

