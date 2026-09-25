<?php

namespace Padrao\Models\CadUsuario\Requests;

use Padrao\Base\PadraoRequest;
use Illuminate\Validation\Rules\Password;

class CadUsuarioRequest extends PadraoRequest
{
    public function rules()
    {
        return [
            'uuid_unidade' => ['required', 'uuid', 'exists:cad_unidade,uuid'],
            'nome_usuario' => ['required', 'string', 'max:255'],
            'email'        => ['required', 'string', 'email', 'max:255'],
            'senha'        => ['nullable', Password::min(8)->mixedCase()->numbers()->symbols()],
        ];
    }
}
