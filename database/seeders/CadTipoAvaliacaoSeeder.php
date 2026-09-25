<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CadTipoAvaliacaoSeeder extends Seeder
{
    public function run(): void
    {
        $registros = [
            1 => ['dsc_tipo_avaliacao' => 'Avaliação Física'],
            2 => ['dsc_tipo_avaliacao' => 'Bioimpedância'],
            3 => ['dsc_tipo_avaliacao' => 'Anamnese'],
        ];

        foreach ($registros as $id => $dados) {
            DB::table('cad_tipo_avaliacao')->updateOrInsert(['id_tipo_avaliacao' => $id], $dados);
        }
    }
}
