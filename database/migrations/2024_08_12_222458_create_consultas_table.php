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
        Schema::create('consultas', function (Blueprint $table) {
            $table->id();
            $table->date('FechaDelIngreso');
            $table->time('HoraEntrada');
            $table->date('FechaSalida')->nullable();
            $table->time('HoraSalida')->nullable();
            $table->text('DetallesTecnicos');
            $table->text('Observacion')->nullable();
            $table->foreignId('Auto_ID')->constrained('autos')->onDelete('cascade');
            $table->foreignId('Mecanico_ID')->constrained('mecanicos')->onDelete('cascade');
            $table->foreignId('Material_ID')->constrained('materiales')->onDelete('cascade');
            $table->foreignId('Servicio_ID')->constrained('servicios')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consultas');
    }
};