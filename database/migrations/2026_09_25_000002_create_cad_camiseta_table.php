<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cad_camiseta', function (Blueprint $table) {
            $table->integer('id_camiseta', true);
            $table->string('dsc_camiseta');
            $table->string('cor', 40);
            $table->string('uuid', 36)->default(DB::raw('(UUID())'));
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cad_camiseta');
    }
};
