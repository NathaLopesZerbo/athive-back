<?php

namespace Database\Seeders;

use Database\Factories\CadProfessorFactory;
use Illuminate\Database\Seeder;

class CadProfessorSeeder extends Seeder
{
    public function run(): void
    {
        CadProfessorFactory::new()
            ->count(20)
            ->create();
    }
}