<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Padrao\Models\CadUsuario\CadUsuario;

class CadUsuarioFactory extends Factory
{
    public const SENHA_PADRAO = 'Senha@123';

    protected $model = CadUsuario::class;

    public function definition(): array
    {
        return [
            'id_unidade'   => fake()->randomElement([1,2]),
            'senha'        => '',
            'nome_usuario' => fake()->firstName(),
            'sobrenome'    => fake()->lastName(),
            'email'        => fake()->unique()->safeEmail(),
        ];
    }

    /**
     * A senha depende do id_usuario, que só é gerado no evento creating do model.
     * Por isso a senha é criptografada e o usuário ativado depois de criado.
     */
    public function configure(): static
    {
        return $this->afterCreating(function (CadUsuario $usuario) {
            $usuario->senha = CriptoSenha($usuario->id_usuario, self::SENHA_PADRAO);
            $usuario->ativo = true;
            $usuario->saveQuietly();
        });
    }
}
