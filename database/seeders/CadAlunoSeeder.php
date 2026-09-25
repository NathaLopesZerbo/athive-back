<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Factories\CadAlunoFactory;

class CadAlunoSeeder extends Seeder
{
    public function run(): void
    {
        CadAlunoFactory::new()
            ->count(50)
            ->create();
    }
}