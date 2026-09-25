<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cad_menu_permissao', function (Blueprint $table) {
            $table->integer('id_menu');
            $table->enum('perfil', ['ADMIN', 'PROFESSOR', 'ALUNO']);
            $table->boolean('can_view')->nullable()->default(true);
            $table->boolean('can_create')->nullable()->default(false);
            $table->boolean('can_update')->nullable()->default(false);
            $table->boolean('can_delete')->nullable()->default(false);
            $table->string('uuid', 36);

            $table->primary(['id_menu', 'perfil']);
            $table->foreign('id_menu', 'cad_menu_permissao_ibfk_1')->references('id_menu')->on('menu_sistema');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cad_menu_permissao');
    }
};
