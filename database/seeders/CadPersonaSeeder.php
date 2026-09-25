<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CadPersonaSeeder extends Seeder
{
    public function run(): void
    {
        $registros = [
            1 => ['dsc_persona' => 'Iniciante'],
            2 => ['dsc_persona' => 'Intermediário'],
            3 => ['dsc_persona' => 'Avançado'],
        ];

        foreach ($registros as $id => $dados) {
            DB::table('cad_persona')->updateOrInsert(['id_persona' => $id], $dados);
        }
    }
}
