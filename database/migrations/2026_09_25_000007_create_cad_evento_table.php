<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cad_evento', function (Blueprint $table) {
            $table->integer('id_evento', true);
            $table->integer('id_arquivo')->nullable();
            $table->string('titulo_evento');
            $table->text('dsc_evento');
            $table->date('data_evento');
            $table->string('hora_inicio', 40)->nullable();
            $table->string('hora_fim', 40)->nullable();
            $table->string('local_evento')->nullable();
            $table->string('uuid', 36)->default(DB::raw('(UUID())'));

            $table->foreign('id_arquivo', 'fk_evento_arquivo')
                ->references('id_arquivo')->on('cad_arquivo')
                ->cascadeOnUpdate()->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cad_evento');
    }
};
