<?php

namespace Padrao\Models\CadUsuario\Requests;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

trait ValidarUsuarioTrait
{
    public function withValidator(): void
    {
        $usuarioData = $this->input('usuario') ?? [];

        $usuarioValidator = Validator::make(
            $usuarioData,
            (new CadUsuarioRequest())->rules()
        );

        throw_if(
            $usuarioValidator->fails(),
            ValidationException::withMessages(
                $usuarioValidator->errors()->toArray()
            )
        );
    }
}