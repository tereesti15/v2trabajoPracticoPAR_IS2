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
        Schema::create('hijos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('persona_id');
            $table->string('nombre');
            $table->timestamp('fecha_nacimiento');
            $table->string('documento')->unique();
            $table->foreign('persona_id')->references('id')->on('personas')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hijos');
    }
};
