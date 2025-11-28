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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Curador
            $table->string('titulo');
            $table->string('imagem')->nullable(); // Caminho do arquivo
            $table->dateTime('data');
            $table->string('local');
            $table->decimal('valor', 8, 2)->default(0); // Valor com 2 casas decimais
            $table->string('categoria');
            $table->integer('ingressos')->default(0);
            $table->text('descricao');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
