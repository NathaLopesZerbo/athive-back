<?php

namespace Padrao\Models\CadMenuPermissao\Requests;

use Padrao\Base\PadraoRequest;

class CadMenuPermissaoRequestFilter extends PadraoRequest
{
    public function rules()
    {
        return [
            'uuid_menu' => ['exists:menu_sistema,uuid'],
        ];
    }
}
