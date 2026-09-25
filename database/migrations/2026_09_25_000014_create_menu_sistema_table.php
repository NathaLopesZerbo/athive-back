<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('menu_sistema', function (Blueprint $table) {
            $table->integer('id_menu', true);
            $table->string('nome_menu', 100);
            $table->string('nome_exibicao');
            $table->string('descricao_menu');
            $table->string('icone_menu', 100)->nullable();
            $table->integer('ordem_menu')->nullable();
            $table->boolean('ativo_menu')->nullable()->default(true);
            $table->integer('parent_id')->nullable()->index('parent_id');
            $table->string('uuid', 36)->default(DB::raw('(UUID())'));

            $table->foreign('parent_id', 'menu_sistema_ibfk_1')->references('id_menu')->on('menu_sistema');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('menu_sistema');
    }
};
