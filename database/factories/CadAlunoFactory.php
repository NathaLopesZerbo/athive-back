<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Padrao\Models\CadAluno\CadAluno;

class CadAlunoFactory extends Factory
{
    protected $model = CadAluno::class;

    public function definition(): array
    {
        return [

            'id_usuario'      => CadUsuarioFactory::new(),
            'id_professor'    => fake()->numberBetween(1, 20),
            'id_genero'       => fake()->randomElement([1, 2]),
            'id_camiseta'     => fake()->randomElement([1, 4, 5]),
            'id_persona'      => fake()->randomElement([1, 2]),
            'tam_camiseta'    => fake()->randomElement(['P','M','G','GG']),
            'idade'           => fake()->numberBetween(18, 80),
            'telefone'        => fake()->numerify('199########'),
            'data_nascimento' => fake()->date(),
            'data_inicio'     => fake()->date(),
        ];
    }
}