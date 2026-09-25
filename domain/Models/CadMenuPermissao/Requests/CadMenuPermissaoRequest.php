<?php

namespace Padrao\Models\CadMenuPermissao\Requests;

use Padrao\Base\PadraoRequest;

class CadMenuPermissaoRequest extends PadraoRequest
{
    public function rules()
    {
        return [
            'uuid_menu'  => ['required', 'exists:menu_sistema,uuid'],
            'permissao'  => [
                'perfil'     => ['required', 'in:ADMIN,USUARIO,PROFESSOR'],
                'can_view'   => ['required','boolean'],
                'can_create' => ['required','boolean'],
                'can_update' => ['required','boolean'],
                'can_delete' => ['required','boolean'],
            ]
        ];
    }
}
