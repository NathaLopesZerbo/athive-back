<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cad_arquivo', function (Blueprint $table) {
            $table->integer('id_arquivo', true);
            $table->string('nome_original');
            $table->string('nome_fisico');
            $table->string('caminho');
            $table->string('uuid', 36)->default(DB::raw('(UUID())'));
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cad_arquivo');
    }
};
