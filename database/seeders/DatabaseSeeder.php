<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            CadUnidadeSeeder::class,
            CadGeneroSeeder::class,
            CadCamisetaSeeder::class,
            CadPersonaSeeder::class,
            CadTipoAvaliacaoSeeder::class,
            MenuSistemaSeeder::class,
            CadUsuarioSeeder::class,
            CadProfessorSeeder::class,
            CadAlunoSeeder::class,
        ]);
    }
}
