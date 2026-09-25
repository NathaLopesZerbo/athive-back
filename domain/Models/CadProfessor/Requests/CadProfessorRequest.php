<?php

namespace Padrao\Models\CadProfessor\Requests;

use Padrao\Base\PadraoRequest;
use Padrao\Models\CadUsuario\Requests\ValidarUsuarioTrait;

class CadProfessorRequest extends PadraoRequest
{
    use ValidarUsuarioTrait;

    public function rules()
    {
        return [
            'professor.uuid_genero'     => ['required', 'uuid', 'exists:cad_genero,uuid'],
            'professor.idade'           => ['required', 'string'],
            'professor.telefone'        => ['required', 'string', 'max:40'],
            'professor.data_nascimento' => ['required', 'date'],
            'professor.formacao'        => ['required', 'string', 'max:255'],
        ];
    }
}
