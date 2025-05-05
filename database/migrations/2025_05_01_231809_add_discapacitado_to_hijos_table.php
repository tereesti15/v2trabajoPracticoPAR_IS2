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
        Schema::table('hijos', function (Blueprint $table) {
            $table->boolean('discapacitado')->default(false)->after('documento');
        });
    }

    public function down(): void
    {
        Schema::table('hijos', function (Blueprint $table) {
            $table->dropColumn('discapacitado');
        });
    }

};
