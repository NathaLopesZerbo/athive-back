<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CadUnidadeSeeder extends Seeder
{
    public function run(): void
    {
        $registros = [
            1 => ['nome_unidade' => 'Unidade Centro'],
            2 => ['nome_unidade' => 'Unidade Norte'],
        ];

        foreach ($registros as $id => $dados) {
            DB::table('cad_unidade')->updateOrInsert(['id_unidade' => $id], $dados);
        }
    }
}
