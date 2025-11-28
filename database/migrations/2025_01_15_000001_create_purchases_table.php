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
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Cliente
            $table->foreignId('event_id')->constrained()->onDelete('cascade'); // Evento
            $table->integer('quantidade')->default(1); // Quantidade de ingressos
            $table->decimal('valor_total', 10, 2); // Valor total da compra
            $table->enum('status', ['pendente', 'confirmado', 'cancelado'])->default('pendente');
            $table->string('codigo_compra')->unique(); // Código único da compra
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchases');
    }
};
