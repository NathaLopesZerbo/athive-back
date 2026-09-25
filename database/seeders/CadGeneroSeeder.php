<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CadGeneroSeeder extends Seeder
{
    public function run(): void
    {
        $registros = [
            1 => ['dsc_genero' => 'Masculino'],
            2 => ['dsc_genero' => 'Feminino'],
        ];

        foreach ($registros as $id => $dados) {
            DB::table('cad_genero')->updateOrInsert(['id_genero' => $id], $dados);
        }
    }
}
