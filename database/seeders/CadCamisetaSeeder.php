<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CadCamisetaSeeder extends Seeder
{
    public function run(): void
    {
        $registros = [
            1 => ['dsc_camiseta' => 'Camiseta Treino', 'cor' => 'Preta'],
            2 => ['dsc_camiseta' => 'Camiseta Treino', 'cor' => 'Branca'],
            3 => ['dsc_camiseta' => 'Camiseta Evento', 'cor' => 'Azul'],
            4 => ['dsc_camiseta' => 'Camiseta Evento', 'cor' => 'Vermelha'],
            5 => ['dsc_camiseta' => 'Regata', 'cor' => 'Cinza'],
        ];

        foreach ($registros as $id => $dados) {
            DB::table('cad_camiseta')->updateOrInsert(['id_camiseta' => $id], $dados);
        }
    }
}
