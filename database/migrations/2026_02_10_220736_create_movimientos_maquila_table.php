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
        Schema::create('movimientos_maquila', function (Blueprint $table) {
            $table->id();

            $table->foreignId('lote_id')
                ->constrained('lotes')
                ->onDelete('cascade');

            $table->string('maquilador');
            $table->integer('metros_enviados');

            $table->date('fecha_salida');

            $table->enum('autorizacion_salida', [
                'pendiente',
                'autorizado',
                'declinado'
            ])->default('pendiente');

            $table->date('fecha_llegada')->nullable();
            $table->integer('piezas')->nullable();
            $table->string('producto_final')->nullable();

            $table->enum('autorizacion_llegada', [
                'pendiente',
                'autorizado',
                'declinado'
            ])->default('pendiente');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movimientos_maquila');
    }
};
