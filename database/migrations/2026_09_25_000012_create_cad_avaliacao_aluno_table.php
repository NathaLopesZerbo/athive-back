<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cad_avaliacao_aluno', function (Blueprint $table) {
            $table->integer('id_avaliacao_aluno', true);
            $table->integer('id_aluno');
            $table->integer('id_tipo_avaliacao');
            $table->integer('id_arquivo')->nullable();
            $table->string('dsc_avaliacao_aluno');
            $table->string('uuid', 36)->default(DB::raw('(UUID())'));

            $table->foreign('id_aluno', 'fk_avaliacao_aluno_aluno')->references('id_aluno')->on('cad_aluno');
            $table->foreign('id_arquivo', 'fk_avaliacao_aluno_arquivo')->references('id_arquivo')->on('cad_arquivo');
            $table->foreign('id_tipo_avaliacao', 'fk_avaliacao_aluno_tipo')->references('id_tipo_avaliacao')->on('cad_tipo_avaliacao');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cad_avaliacao_aluno');
    }
};
