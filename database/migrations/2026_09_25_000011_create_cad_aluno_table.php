<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cad_aluno', function (Blueprint $table) {
            $table->integer('id_aluno', true);
            $table->integer('id_usuario');
            $table->integer('id_professor');
            $table->integer('id_genero')->nullable();
            $table->integer('id_camiseta');
            $table->integer('id_persona');
            $table->string('tam_camiseta', 40);
            $table->string('idade', 40)->nullable();
            $table->string('telefone', 100);
            $table->dateTime('data_nascimento');
            $table->dateTime('data_inicio');
            $table->string('uuid', 36)->default(DB::raw('(UUID())'));

            $table->foreign('id_camiseta', 'fk_aluno_camiseta')->references('id_camiseta')->on('cad_camiseta');
            $table->foreign('id_genero', 'fk_aluno_genero')->references('id_genero')->on('cad_genero');
            $table->foreign('id_persona', 'fk_aluno_persona')->references('id_persona')->on('cad_persona');
            $table->foreign('id_professor', 'fk_aluno_professor')->references('id_professor')->on('cad_professor');
            $table->foreign('id_usuario', 'fk_aluno_usuario')->references('id_usuario')->on('cad_usuario');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cad_aluno');
    }
};
