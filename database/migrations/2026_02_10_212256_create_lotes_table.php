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
        Schema::create('lotes', function (Blueprint $table) {
            $table->id();

            $table->string('lote')->unique();
            $table->string('proveedor');
            $table->string('tela');

            $table->integer('metros_iniciales');
            $table->integer('metros_restantes'); // NO lo llena el usuario

            $table->text('caracteristicas')->nullable();
            $table->date('fecha_entrada');

            $table->enum('autorizacion_entrada', [
                'pendiente',
                'autorizado',
                'declinado'
            ])->default('pendiente');

            $table->enum('ubicacion', [
                'almacen',
                'maquila',
                'terminado'
            ])->default('almacen');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lotes');
    }
};
