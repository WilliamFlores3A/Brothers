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
        Schema::create('autos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_modelo')->constrained('modelos')->onDelete('cascade');
            $table->foreignId('id_version')->constrained('versiones')->onDelete('cascade');
            $table->foreignId('id_marca')->constrained('marcas')->onDelete('cascade');
            $table->foreignId('id_color')->constrained('colores')->onDelete('cascade');
            $table->foreignId('id_year')->constrained('years')->onDelete('cascade');
            $table->string('placa')->unique();
            $table->foreignId('cliente_id')->constrained('clientes')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('autos');
    }
};
