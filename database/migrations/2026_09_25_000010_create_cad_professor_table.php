<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cad_professor', function (Blueprint $table) {
            $table->integer('id_professor', true);
            $table->integer('id_usuario');
            $table->integer('id_genero');
            $table->string('idade', 40)->nullable();
            $table->string('telefone', 100);
            $table->dateTime('data_nascimento');
            $table->string('formacao')->nullable();
            $table->string('uuid', 36)->default(DB::raw('(UUID())'));

            $table->foreign('id_genero', 'fk_professor_genero')->references('id_genero')->on('cad_genero');
            $table->foreign('id_usuario', 'fk_professor_usuario')->references('id_usuario')->on('cad_usuario');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cad_professor');
    }
};
