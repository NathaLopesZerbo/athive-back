<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cad_usuario_convite', function (Blueprint $table) {
            $table->integer('id_convite', true);
            $table->integer('id_usuario');
            $table->string('token');
            $table->dateTime('expiracao');
            $table->boolean('usado')->default(false);
            $table->string('uuid', 36)->default(DB::raw('(UUID())'));

            $table->foreign('id_usuario', 'fk_convite_usuario')->references('id_usuario')->on('cad_usuario');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cad_usuario_convite');
    }
};
