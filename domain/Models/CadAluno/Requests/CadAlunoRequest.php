<?php

namespace Padrao\Models\CadAluno\Requests;

use Padrao\Base\PadraoRequest;
use Padrao\Models\CadUsuario\Requests\ValidarUsuarioTrait;

class CadAlunoRequest extends PadraoRequest
{
    use ValidarUsuarioTrait;

    public function rules()
    {
        return [
            'aluno.uuid_professor'  => ['required', 'exists:cad_professor,uuid'],
            'aluno.uuid_genero'     => ['required', 'exists:cad_genero,uuid'],
            'aluno.uuid_camiseta'   => ['required', 'exists:cad_camiseta,uuid'],
            'aluno.uuid_persona'    => ['required', 'exists:cad_persona,uuid'],
            'aluno.tam_camiseta'    => ['required', 'string'],
            'aluno.idade'           => ['required', 'integer', 'min:1'],
            'aluno.telefone'        => ['required', 'string'],
            'aluno.data_nascimento' => ['required', 'date'],
            'aluno.data_inicio'     => ['required', 'date'],
        ];
    }
}
