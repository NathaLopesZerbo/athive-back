<?php

namespace Padrao\Models\CadGenero\Requests;

use Padrao\Base\PadraoRequest;

class CadGeneroRequest extends PadraoRequest
{
    public function rules()
    {
        return [
            'dsc_genero' => ['required', 'string', 'max:255', 'unique:cad_genero,dsc_genero'],
        ];
    }
}
