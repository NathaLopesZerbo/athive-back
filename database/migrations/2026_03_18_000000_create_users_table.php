<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id(); 
            $table->uuid('uuid')->unique()->default(DB::raw('(UUID())')); 
            $table->string('nome_usuario');
            $table->string('sobrenome')->nullable();
            $table->string('email')->unique();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};