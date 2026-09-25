<?php

namespace Database\Seeders;

use Database\Factories\CadAlunoFactory;
use Database\Factories\CadProfessorFactory;
use Database\Factories\CadUsuarioFactory;
use Illuminate\Database\Seeder;
use Padrao\Models\CadUsuario\CadUsuario;

class CadUsuarioSeeder extends Seeder
{
    /**
     * Usuários fixos para login, um por perfil. Senha: CadUsuarioFactory::SENHA_PADRAO.
     * O perfil vem do vínculo: professor => PROFESSOR, aluno => ALUNO, nenhum => ADMIN.
     */
    public function run(): void
    {
        $this->usuario('admin@padrao.com', 'Admin');

        $professor = $this->usuario('professor@padrao.com', 'Professor');
        if (!$professor->professor()->exists()) {
            CadProfessorFactory::new()->create(['id_usuario' => $professor->id_usuario]);
        }

        $aluno = $this->usuario('aluno@padrao.com', 'Aluno');
        if (!$aluno->aluno()->exists()) {
            CadAlunoFactory::new()->create([
                'id_usuario'   => $aluno->id_usuario,
                'id_professor' => $professor->professor()->value('id_professor'),
            ]);
        }
    }

    private function usuario(string $email, string $nome): CadUsuario
    {
        return CadUsuario::where('email', $email)->first()
            ?? CadUsuarioFactory::new()->create([
                'id_unidade'   => 1,
                'nome_usuario' => $nome,
                'sobrenome'    => 'Padrão',
                'email'        => $email,
            ]);
    }
}
