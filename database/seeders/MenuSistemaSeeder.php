<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Padrao\Models\MenuSistema\MenuSistema;

class MenuSistemaSeeder extends Seeder
{
    public function run(): void
    {
        $this->menu([
            'nome_menu'      => 'dashboard',
            'nome_exibicao'  => 'Dashboard',
            'descricao_menu' => 'Página inicial do sistema',
            'icone_menu'     => 'fa-solid fa-house',
            'ordem_menu'     => 1,
            'ativo_menu'     => true,
            'parent_id'      => null
        ]);

        $aluno = $this->menu([
            'nome_menu'      => 'aluno',
            'nome_exibicao'  => 'Alunos',
            'descricao_menu' => 'Gestão de alunos do sistema',
            'icone_menu'     => 'fa-solid fa-user-graduate',
            'ordem_menu'     => 2,
            'ativo_menu'     => true,
            'parent_id'      => null
        ]);

        $this->menu([
            'nome_menu'      => 'lista-aluno',
            'nome_exibicao'  => 'Lista de Alunos',
            'descricao_menu' => 'Gestão de alunos do sistema',
            'icone_menu'     => 'fa-solid fa-user-group',
            'ordem_menu'     => 1,
            'ativo_menu'     => true,
            'parent_id'      => $aluno->id_menu
        ]);

        $professor = $this->menu([
            'nome_menu'      => 'professor',
            'nome_exibicao'  => 'Professores',
            'descricao_menu' => 'Gestão de professores do sistema',
            'icone_menu'     => 'fa-solid fa-chalkboard-user',
            'ordem_menu'     => 4,
            'ativo_menu'     => true,
            'parent_id'      => null
        ]);

        $this->menu([
            'nome_menu'      => 'lista-professor',
            'nome_exibicao'  => 'Lista de Professores',
            'descricao_menu' => 'Professores cadastrados',
            'icone_menu'     => 'fa-solid fa-person-chalkboard',
            'ordem_menu'     => 1,
            'ativo_menu'     => true,
            'parent_id'      => $professor->id_menu
        ]);

        $this->menu([
            'nome_menu'      => 'evento',
            'nome_exibicao'  => 'Eventos',
            'descricao_menu' => 'Gestão de eventos do sistema',
            'icone_menu'     => 'fa-solid fa-calendar',
            'ordem_menu'     => 5,
            'ativo_menu'     => true,
            'parent_id'      => null
        ]);

        $this->menu([
            'nome_menu'      => 'unidade',
            'nome_exibicao'  => 'Unidades',
            'descricao_menu' => 'Unidades do sistema',
            'icone_menu'     => 'fa-solid fa-building',
            'ordem_menu'     => 6,
            'ativo_menu'     => true,
            'parent_id'      => null
        ]);

        $this->menu([
            'nome_menu'      => 'tipo-avaliacao',
            'nome_exibicao'  => 'Tipos de Avaliação',
            'descricao_menu' => 'Configuração de avaliações',
            'icone_menu'     => 'fa-solid fa-clipboard-list',
            'ordem_menu'     => 7,
            'ativo_menu'     => true,
            'parent_id'      => null
        ]);

        $this->menu([
            'nome_menu'      => 'camiseta',
            'nome_exibicao'  => 'Camisetas',
            'descricao_menu' => 'Gestão de camisetas',
            'icone_menu'     => 'fa-solid fa-shirt',
            'ordem_menu'     => 8,
            'ativo_menu'     => true,
            'parent_id'      => null
        ]);

        $this->menu([
            'nome_menu'      => 'persona',
            'nome_exibicao'  => 'Persona',
            'descricao_menu' => 'Perfis de acesso do sistema',
            'icone_menu'     => 'fa-solid fa-user-gear',
            'ordem_menu'     => 9,
            'ativo_menu'     => true,
            'parent_id'      => null
        ]);

        $this->menu([
            'nome_menu'      => 'seguranca',
            'nome_exibicao'  => 'Segurança',
            'descricao_menu' => 'Configurações de segurança do sistema',
            'icone_menu'     => 'fa-solid fa-shield-halved',
            'ordem_menu'     => 10,
            'ativo_menu'     => true,
            'parent_id'      => null
        ]);

        $this->menu([
            'nome_menu'      => 'genero',
            'nome_exibicao'  => 'Gêneros',
            'descricao_menu' => 'Gestão de gêneros',
            'icone_menu'     => 'fa-solid fa-venus-mars',
            'ordem_menu'     => 11,
            'ativo_menu'     => true,
            'parent_id'      => null
        ]);
    }

    /**
     * Cria o menu só se ainda não existir, para o seeder poder rodar mais de uma vez.
     * As permissões por perfil são criadas pelo MenuSistemaObserver.
     */
    private function menu(array $dados): MenuSistema
    {
        return MenuSistema::firstOrCreate(['nome_menu' => $dados['nome_menu']], $dados);
    }
}
