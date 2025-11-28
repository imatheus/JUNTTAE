<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Coluna para CPF/CNPJ (nullable = pode ser nula)
            $table->string('cpf_cnpj', 18)->nullable()->after('email');
            
            // Coluna para o tipo de usuário com valores fixos
            $table->enum('tipo_usuario', ['usuario', 'curador'])->default('usuario')->after('cpf_cnpj');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['cpf_cnpj', 'tipo_usuario']);
        });
    }
};
