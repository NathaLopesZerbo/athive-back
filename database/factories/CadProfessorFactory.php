<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Padrao\Models\CadProfessor\CadProfessor;

class CadProfessorFactory extends Factory
{
    protected $model = CadProfessor::class;

    public function definition(): array
    {
        return [
            'id_usuario'      => CadUsuarioFactory::new(),
            'id_genero'       => fake()->randomElement([1,2]),
            'idade'           => fake()->numberBetween(25, 60),
            'telefone'        => fake()->numerify('199########'),
            'data_nascimento' => fake()->date(),
            'formacao'        => fake()->randomElement([
                'Matemática',
                'Engenharia',
                'História',
                'ADS',
                'Educação Física'
            ]),
        ];
    }
}