<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cad_usuario', function (Blueprint $table) {
            $table->integer('id_usuario', true);
            $table->integer('id_unidade');
            $table->string('usuario');
            $table->string('senha');
            $table->string('nome_usuario');
            $table->string('sobrenome')->nullable();
            $table->string('email')->nullable();
            $table->boolean('ativo')->default(false);
            $table->string('uuid', 36)->default(DB::raw('(UUID())'));

            $table->foreign('id_unidade', 'fk_unidade_usuario')->references('id_unidade')->on('cad_unidade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cad_usuario');
    }
};
