<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cad_genero', function (Blueprint $table) {
            $table->integer('id_genero', true);
            $table->string('dsc_genero');
            $table->string('uuid', 36)->default(DB::raw('(UUID())'));
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cad_genero');
    }
};
