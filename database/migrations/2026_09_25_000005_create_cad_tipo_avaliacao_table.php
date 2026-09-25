<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cad_tipo_avaliacao', function (Blueprint $table) {
            $table->integer('id_tipo_avaliacao', true);
            $table->string('dsc_tipo_avaliacao');
            $table->string('uuid', 36)->default(DB::raw('(UUID())'));
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cad_tipo_avaliacao');
    }
};
