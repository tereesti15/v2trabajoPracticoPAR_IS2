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
        Schema::table('parametros', function (Blueprint $table) {
            $table->unsignedBigInteger('id_salario_base');
            $table->unsignedBigInteger('id_bonificacion_familiar');
            $table->unsignedBigInteger('id_ips');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('parametros', function (Blueprint $table) {
            $table->dropColumn('id_salario_base');
            $table->dropColumn('id_bonificacion_familiar');
            $table->dropColumn('id_ips');
        });
    }
};
